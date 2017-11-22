<?php

namespace App\Repositories\Products;

use App\Product;

class ProductRepository implements ProductRepositoryInterface
{
	private $model;
	/**
	 * ProductRepository constructor.
	 */
	public function __construct(Product $model)
	{
		$this->model = $model;
	}

	/**
	 * In stock products
	 * @return mixed
	 */
	public function inStock()
	{
		return $this->model->where('count', '>', 0)->get();
	}
}