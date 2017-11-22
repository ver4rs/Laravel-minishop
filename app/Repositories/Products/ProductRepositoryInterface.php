<?php

namespace App\Repositories\Products;

interface ProductRepositoryInterface
{
	/**
	 * In stock products
	 * @return mixed
	 */
	public function inStock();

	/**
	 * Get product by id
	 * @param $id
	 * @return mixed
	 */
	public function getById($id);

	/**
	 * Get all products
	 * @return mixed
	 */
	public function getAll();

	/**
	 * Update instance by id with attributes
	 * @param $id
	 * @param $attributes
	 * @return mixed
	 */
	public function update($id, $attributes);

	/**
	 * Save product
	 * @param array $attributes
	 * @return mixed
	 */
	public function save($attributes);

	/**
	 * Delete instance product by param id
	 * @param $id
	 * @return mixed
	 */
	public function delete($id);
}