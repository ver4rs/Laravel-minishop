<?php
namespace App\Helper\Cart;

use App\Repositories\Carts\CartsRepository;
use App\Repositories\Orders\OrdersRepository;
use App\Repositories\Products\ProductsRepository;
use Illuminate\Support\Facades\Auth;
use Webpatser\Uuid\Uuid;

class CartLogic
{
	protected $productsRepository;
	protected $cartsRepository;
	protected $ordersRepository;

	public function __construct(ProductsRepository $productsRepository, CartsRepository $cartsRepository, OrdersRepository $ordersRepository)
	{
		$this->productsRepository = $productsRepository;
		$this->cartsRepository = $cartsRepository;
		$this->ordersRepository = $ordersRepository;
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

		$cart = $this->cartsRepository->getCartByUser($userId);
		return $cart;
	}

	/**
	 * Verification correct items inside basket
	 * @param $items
	 * @param $userId
	 */
	private function verificationItems(&$items, $userId)
	{
		foreach ($items as $key => $item) {
			if (!$item->product) {
				$this->cartItemDestroy($item->id, $userId);
				$items->forget($key);
			}
		}
	}

	/**
	 * Get cart items by user
	 * @param $userId
	 * @return null
	 */
	public function getCartItems($userId)
	{
		$cart = $this->getCartByUser($userId);

		$items = $cart->items ?? null;

		if ($items) {
			$this->verificationItems($items, $userId);
		}

		return $items ?? null;
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
	 * @return \App\Cart
	 */
	private function makeCart($userId)
	{
		if ($cart = $this->getCartByUser($userId)) {
			return $cart;
		}

		$uuid = Uuid::generate(4)->string;

		// save cart instance
		$cart = $this->cartsRepository->save([
			'user_id' => $userId,
			'token' => $uuid
		]);

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
		return $item;
	}

	/**
	 * Has item id into Shopping cart
	 * @param int $id item id
	 */
	public function hasItemCart($userId, $id)
	{
		$cartItems = $this->cartsRepository->getCartItemByUser($id, $userId);

		return $cartItems ? true : false;
	}

	/**
	 * Add item to Cart 'Shopping list'
	 * @param $userId
	 * @param $attributes
	 */
	public function addItemToCart($userId, $attributes)
	{
		$cart = $this->makeCart($userId);

		if (!$this->hasItemCart($userId, $attributes['id'])) {

			//	Add item to Shopping cart
			$this->cartsRepository->saveCartItem($cart->id, $attributes);

		} else {
			$this->cartsRepository->updateCartItemByProductId($userId, $attributes['id'], $attributes['count']);
		}
	}


	/**
	 * Get all orders
	 * @param bool $isAdmin
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 */
	public function getOrders($isAdmin = false)
	{
		if ($isAdmin) {
			$orders = $this->ordersRepository->getAll();
		} else {
			$orders = Auth::user()->orders;
		}

		return $orders;
	}

	private function makeOrder($userId, $attributes)
	{
		// Save instance order
		$order = $this->ordersRepository->save([
			'user_id' => $userId,
			'name' => $attributes['name'],
			'city' => $attributes['city'],
			'address' => $attributes['address'],
			'price' => $this->getTotalPriceFromCart($userId)
		]);

		return $order;
	}

	/**
	 * Store item into order
	 * @param int $orderId
	 * @param int $item
	 * @param int $userId
	 */
	public function makeItemIntoOrder($orderId, $item, $userId)
	{
		// Create item of order instance
		$this->ordersRepository->saveOrderItem($orderId, [
			'product_id' => $item->product->id,
			'count' => $item->count
		]);

		// Update count product after made order
		$this->productsRepository->updateById($item->product->id, ['count' => $item->product->count - $item->count]);

		// Remove item of cart
		$this->cartItemDestroy($item->id, $userId);
	}

	/**
	 * Get Product
	 * @param $id
	 * @return mixed
	 */
	private function getProduct($id)
	{
		return $this->productsRepository->getById($id);
	}

	/**
	 * Destroy cart
	 * @param $id
	 */
	private function cartDestroy($id)
	{
		$this->cartsRepository->delete($id);
	}

	/**
	 * Delete item of cart
	 * @param int $id
	 * @param int $userId
	 */
	public function cartItemDestroy($id, $userId)
	{
		$this->cartsRepository->deleteCartItem($userId, $id);
	}

	/**
	 * Get Cart id
	 * @param $token
	 * @return mixed
	 */
	private function getCartId($token = false)
	{
		//TODO:: implement token, when user is not logged

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
			$this->makeItemIntoOrder($order->id, $item, $userId);
		}

//		$this->cartDestroy($this->getCartId());
	}

	/**
	 * Get order
	 * @param $id
	 * @return mixed
	 */
	public function getOrder($id)
	{
		return Auth::user()->orders()->findOrFail($id);
	}

	/**
	 * Change status order
	 * @param $id
	 * @param $status
	 */
	public function changeStatusOrder($id, $status)
	{
		// Change attribute status on Order model
		$this->ordersRepository->updateById($id, ['status' => $status]);
	}
}