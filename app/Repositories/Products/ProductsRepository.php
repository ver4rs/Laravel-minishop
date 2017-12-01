<?php

namespace App\Repositories\Products;

use App\Repositories\Base\BaseRepository;

class ProductsRepository extends BaseRepository
{
	protected $modelClass = \App\Product::class;

	/**
	 * ProductRepository constructor.
	 */
	public function __construct()
	{
		//
	}

	/**
	 * Get all products with deleted products "trashed"
	 * @return mixed
	 */
	public function getAllWithTrashed()
	{
		return $this->modelClass::withTrashed()->get();
	}

	/**
	 * In stock products
	 * @return mixed
	 */
	public function inStock()
	{
		return $this->modelClass::where('count', '>', 0)->get();
	}

	/**
	 * Restore product
	 * @param $id
	 * @return mixed
	 */
	public function restoreProduct($id)
	{
		return $this->modelClass::where('id', $id)->withTrashed()->restore();
	}
}
