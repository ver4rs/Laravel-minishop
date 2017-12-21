<?php

namespace App\Repositories\Carts;

use App\Repositories\Base\BaseRepository;

class CartsRepository extends BaseRepository
{
	protected $modelClass = \App\Cart::class;

	/**
	 * CartsRepository constructor.
	 * @param string $modelClass
	 */
	public function __construct()
	{
		//
	}

	/**
	 * Get cart by user id
	 * @param int $userId
	 * @return mixed
	 */
	public function getCartByUser($userId)
	{
		return $this->modelClass::where('user_id', $userId)->first();
	}

	/**
	 * Get item of cart by user id
	 * @param int $productId
	 * @param int $userId
	 * @return mixed
	 */
	public function getCartItemByUser($productId, $userId)
	{
		return $this->getCartByUser($userId)
			->whereHas('items', function ($query) use ($productId) {
				$query->where('product_id', $productId);
			})
			->first();
	}

	/**
	 * Store item of cart with attributes
	 * @param $cartId
	 * @param $attributes
	 * @return mixed
	 */
	public function saveCartItem($cartId, $attributes)
	{
		return $this->getById($cartId)->items()->create([
			'product_id' => $attributes['id'],
			'count' => $attributes['count'],
		]);
	}

	/**
	 * Update item of cart by product id
	 * @param int $userId
	 * @param int $productId
	 * @param int $count
	 * @return mixed
	 */
	public function updateCartItemByProductId($userId, $productId, $count)
	{
		return $this->getCartItemByUser($productId, $userId)
			->update(['count' => $count]);
	}

	/**
	 * Delete item of cart
	 * @param int $userId
	 * @param int $itemId
	 * @return mixed
	 */
	public function deleteCartItem($userId, $itemId)
	{
		return $this->getCartByUser($userId)
			->items()->delete($itemId);
	}
}
