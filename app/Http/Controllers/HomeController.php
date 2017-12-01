<?php

namespace App\Http\Controllers;

use App\Repositories\Products\ProductsRepository;

class HomeController extends Controller
{
    private $productRepository;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ProductsRepository $productRepository)
    {
//        $this->middleware('auth');
        $this->productRepository = $productRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->productRepository->inStock();

        return view('home')->with('products', $products);
    }
}
