<?php
namespace App\Helper;


use App\Cart;
use App\CartItem;
use App\Order;
use App\OrderItem;
use App\Product;
use Illuminate\Support\Facades\Auth;

class CartLogic
{



	public function test()
	{
		return true;
	}


	/**
	 * Get cart by user
	 * @param $userId
	 * @return mixed
	 */
	public function getCartByUser($userId)
	{
		if (!$userId) {
			return null;
		}

		$cart = Cart::getCartUser($userId)->first();
		return $cart;
	}

	/**
	 * Get cart items by user
	 * @param $userId
	 * @return null
	 */
	public function getCartItems($userId)
	{
		$cart = $this->getCartByUser($userId);

		return $cart->items ?? [];
	}

	/**
	 * Get total price for cart 'shopping list|basket'
	 * @param $userId
	 * @return int
	 */
	public function getTotalPriceFromCart($userId)
	{
		$cartItems = $this->getCartItems($userId);

		if (!$cartItems) {
			return null;
		}
		
		$total = 0;
		foreach ($cartItems as $item) {
			$total += $item->count * $item->product->price;
		}
		return $total;
	}

	/**
	 * Make object Cart
	 * @param $userId
	 * @return Cart
	 */
	private function makeCart($userId)
	{
		if ($cart = $this->getCartByUser($userId)) {
			return $cart;
		}

		$cart = new Cart;
		$cart->user_id = $userId;
		$cart->token = sha1(microtime());
		$cart->save();

		return $cart;
	}

	/**
	 * Update count item 'product' in shopping list
	 * @param $id
	 * @param $count
	 */
	public function updateCountItem($id, $count)
	{
		$item = Auth::user()->cart->items()->findOrFail($id);

		if ($item) {
			$item->count = $count;
			$item->update();
		}
	}

	/**
	 * Add item to Cart 'Shopping list'
	 * @param $userId
	 * @param $attributes
	 */
	public function addItemToCart($userId, $attributes)
	{
		$cart = $this->makeCart($userId);

		//	Add item to basket
		$cartItem = new CartItem;
		$cartItem->product_id = $attributes['id'];
		$cartItem->count = $attributes['count'];
		$cartItem->cart_id = $cart->id;
		$cartItem->save();
	}


	/**
	 * Get all orders
	 * @param bool $isAdmin
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 */
	public function getOrders($isAdmin = false)
	{
		if ($isAdmin) {
			$orders = Order::all();
		} else {
			$orders = Auth::user()->orders;
		}

		return $orders;
	}

	private function makeOrder($userId, $attributes)
	{
		$order = new Order;
		$order->user_id = $userId;
		$order->name = $attributes['name'];
		$order->city = $attributes['city'];
		$order->address = $attributes['address'];
		$order->price = $this->getTotalPriceFromCart($userId);
		$order->save();

		return $order;
	}

	public function makeItemIntoOrder($orderId, $item)
	{
		$orderItem = new OrderItem;
		$orderItem->order_id = $orderId;
		$orderItem->product_id = $item->product->id;
		$orderItem->count = $item->count;
		$orderItem->save();

		// update product
		Product::updateCount($item->product->id, $item->product->count, $item->count);

		CartItem::destroy($item->id);

	}

	/**
	 * Get Product
	 * @param $id
	 * @return mixed
	 */
	private function getProduct($id)
	{
		return Product::findOrFail($id);
	}

	/**
	 * Destroy cart
	 * @param $id
	 */
	private function cartDestroy($id)
	{
		Cart::destroy($id);
	}
	
	public function cartItemDestroy($id)
	{
		CartItem::destroy($id);
	}

	/**
	 * Get Cart id
	 * @param $userId
	 * @return mixed
	 */
	private function getCartId($userId)
	{
		return Auth::user()->cart->id ?? null;
	}

	/**
	 * Migration cart into order
	 * @param $userId
	 * @param $attributes
	 */
	public function migrationOrder($userId, $attributes)
	{
		$cartItems = $this->getCartItems($userId);

		$order = $this->makeOrder($userId, $attributes);

		foreach ($cartItems as $item) {
			$this->makeItemIntoOrder($order->id, $item);
		}

		$this->cartDestroy($this->getCartId($userId));
	}

	/**
	 * Get order
	 * @param $id
	 * @return mixed
	 */
	public function getOrder($id)
	{
		return Auth::user()->orders()->findOrFail($id);;
	}

	/**
	 * Change status order
	 * @param $id
	 * @param $status
	 */
	public function changeStatusOrder($id, $status)
	{
		Order::findOrFail($id)
			->update(['status' => $status]);
	}
}