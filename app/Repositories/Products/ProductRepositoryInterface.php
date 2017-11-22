<?php

namespace App\Repositories\Products;

interface ProductRepositoryInterface
{
	/**
	 * In stock products
	 * @return mixed
	 */
	public function inStock();
}