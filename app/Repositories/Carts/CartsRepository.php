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
	 * @param int $itemId
	 * @param int $userId
	 * @return mixed
	 */
	public function getCartItemByUser($itemId, $userId)
	{
		$this->changeSubModelClass(\App\CartItem::class);

		return $this->modelClass::where('product_id', $itemId)
			->whereHas('cart', function ($query) use($userId) {
				$query->where('user_id', $userId);
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
		$this->changeSubModelClass(\App\CartItem::class);

		return $this->save([
			'product_id' => $attributes['id'],
			'count' => $attributes['count'],
			'cart_id' => $cartId
		]);
	}

	/**
	 * Update item of cart by product id
	 * @param int $productId
	 * @param int $count
	 * @return mixed
	 */
	public function updateCartItemByProductId($productId, $count)
	{
		$this->changeSubModelClass(\App\CartItem::class);

		return $this->modelClass::where('product_id', $productId)
			->update(['count' => $count]);
	}

	/**
	 * Delete item of cart
	 * @param int $itemId
	 * @return mixed
	 */
	public function deleteCartItem($itemId)
	{
		$this->changeSubModelClass(\App\CartItem::class);

		return $this->delete($itemId);
	}
}