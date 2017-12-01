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

	/**
	 * Get all products
	 * @return mixed
	 */
	public function getAll()
	{
		return $this->model->withTrashed()->get();
	}

	/**
	 * Save product
	 * @param array $attributes
	 * @return mixed
	 */
	public function save($attributes)
	{
		$product = new $this->model($attributes);
		$product->save();
		return $product;
	}

	/**
	 * Get product by id
	 * @param $id
	 * @return mixed
	 */
	public function getById($id)
	{
		return $this->model->findOrFail($id);
	}

	/**
	 * Update instance by id with attributes
	 * @param $id
	 * @param $attributes
	 * @return mixed
	 */
	public function update($id, $attributes)
	{
		return $this->getById($id)->update($attributes);
	}

	/**
	 * Delete instance product by param id
	 * @param $id
	 * @return mixed
	 */
	public function delete($id)
	{
		return $this->getById($id)->delete();
	}

	/**
	 * Restore product
	 * @param $id
	 * @return mixed
	 */
	public function restoreProduct($id)
	{
		return $this->model->where('id', $id)->withTrashed()->restore();
	}
}
