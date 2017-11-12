<?php

namespace App\Http\Controllers;


use App\Cart;
use App\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

	/**
	 * Display a cart with all items
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$cart = Cart::getCartUser(Auth::user()->id)->first();

		$cartItems = $cart ? $cart->items : null;

		$total = 0;
		foreach ($cartItems as $item) {
			$total += $item->count * $item->product->price;
		}


		return view('orders.list')->with(['cartItems' => $cartItems, 'total' => $total]);
	}

	/**
	 * Store the specified resource in storage
	 * @param Request $request
	 */
	public function store(Request $request)
	{
		//TODO:: create request for validation product ID with count

		$cart = Cart::getCartUser(Auth::user()->id)->first();


		if (!$cart) {
			$cart = new Cart;
			$cart->user_id = Auth::user()->id;
			$cart->token = sha1(microtime());
			$cart->save();
		}



		//	Add item to basket
		$cartItem = new CartItem;
		$cartItem->product_id = $request->id;
		$cartItem->count = $request->count;
		$cartItem->cart_id = $cart->id;
		$cartItem->save();


		return redirect()->route('shopping.index')->with('status', 'Item added to shopping list.');
	}



	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		//TODO:: Validate correct count of product

//		$item = CartItem::findOrFail($id);
		$item = Auth::user()->cart->items()->findOrFail($id);
//		dd($item);

		if ($item) {
			$item->count = $request->count;
			$item->update();
		}


		return redirect()->route('shopping.index')->with('status', 'Product updated');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		CartItem::destroy($id);

		return redirect()->route('shopping.index')->with('status', 'Product deleted');
	}
}
