<?php

namespace App\Http\Controllers;

use App\Helper\StorageImages\StorageImages;
use App\Http\Requests\ProductRequest;
use App\Repositories\Products\ProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productRepository;

    /**
     * ProductController constructor.
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->productRepository->getAll();

        return view('products.index')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.form')->with('product', null);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $data = $request->all();

        $data['image1'] = null;
        $data['image2'] = null;
        $data['image3'] = null;

        //  Save images
        foreach ($request->allFiles() as $key => $file) {
            $data[$key] = StorageImages::saveImage($file);
        }

        $this->productRepository->save($data);

        return redirect()->route('product.index')->with('status', 'Product added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->productRepository->getById($id);

        return view('products.show')->with('product', $product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = $this->productRepository->getById($id);

        return view('products.form')->with('product', $product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ProductRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $data = $request->all();
        $product = $this->productRepository->getById($id);

        foreach ($request->allFiles() as $key => $file) {

            if ($product->$key) {
                StorageImages::deleteImage($product->$key);
            }

            $data[$key] = StorageImages::saveImage($file);
        }

        $this->productRepository->update($id, $data);


        return redirect()->route('product.index')->with('status', 'Product updated');
    }

    /**
     * Destroy image from product
     * @param $productId
     * @param $image
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyImage($productId, $image)
    {
        $this->productRepository->update($productId, [$image => null]);

        StorageImages::deleteImage($image);

        return redirect()->route('product.edit', $productId)->with('status', 'Image deleted');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = $this->productRepository->getById($id);

        //  Delete image
        if (!is_null($product->image1)) {
            StorageImages::deleteImage($product->image1, 'products');
        }
        if (!is_null($product->image2)) {
            StorageImages::deleteImage($product->image2, 'products');
        }
        if (!is_null($product->image3)) {
            StorageImages::deleteImage($product->image3, 'products');
        }

        $this->productRepository->delete($id);

        return redirect()->route('product.index')->with('status', 'Product deleted');
    }

    public function restoreProduct(Request $request)
    {
        $this->productRepository->restoreProduct($request->id ?? null);

        return redirect()->route('product.index')->with('status', 'Product restored');
    }
}
