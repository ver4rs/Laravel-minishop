<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

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
            $data[$key] = $this->saveImage($file);
        }


        $product = new Product($data);
        $product->save();

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
        $product = Product::findOrFail($id);
        
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
        $product = Product::findOrFail($id);

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
        $product = Product::findOrFail($id);

        foreach ($request->allFiles() as $key => $file) {

            if ($product->$key) {
                $this->deleteImage($product->$key);
            }

            $data[$key] = $this->saveImage($file);
        }

        $product->update($data);


        return redirect()->route('product.index')->with('status', 'Product updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        //  Delete image
        if (!is_null($product->image1)) {
            $this->deleteImage($product->image1, 'products');
        }
        if (!is_null($product->image2)) {
            $this->deleteImage($product->image2, 'products');
        }
        if (!is_null($product->image3)) {
            $this->deleteImage($product->image3, 'products');
        }

        $product->delete();

        return redirect()->route('product.index')->with('status', 'Product deleted');
    }

    /**
     * Delete image from storage
     * @param string $name
     * @param string $path default products
     */
    private function deleteImage($name, $path = 'products')
    {
        Storage::disk('images')->delete(($path ? $path . '/' : '') . $name);
    }

    /**
     * Save image
     * @param $file
     * @param string $disk
     * @param string $path
     * @return string
     */
    private function saveImage($file, $disk = 'images', $path = 'products')
    {
        $name = sha1(microtime()) . '.jpg';
        Storage::disk($disk)->putFileAs($path, $file, $name);

        return $name;
    }
}
