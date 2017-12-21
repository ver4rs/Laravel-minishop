<?php

namespace App\Http\Controllers;

use App\Helper\Cart\Fasades\CartLogic;
use App\Http\Requests\ItemRequest;
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
		$userId = Auth::user()->id;
		$cartItems = CartLogic::getCartItems($userId) ?? [];
		$total = CartLogic::getTotalPriceFromCart($userId);

		return view('orders.list')->with(['cartItems' => $cartItems, 'total' => $total]);
	}

	/**
	 * Store the specified resource in storage
	 * @param ItemRequest $request
	 */
	public function store(ItemRequest $request)
	{
		CartLogic::addItemToCart(Auth::user()->id, $request->all());

		return redirect()->route('shopping.index')->with('status', 'Item added to shopping list.');
	}


	/**
	 * Update the specified resource in storage
	 * @param ItemRequest $request
	 * @param $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update(ItemRequest $request, $id)
	{
		CartLogic::updateCountItem($id, $request->count);

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
		$userId = Auth::user()->id;
		CartLogic::cartItemDestroy($id, $userId);

		return redirect()->route('shopping.index')->with('status', 'Product deleted');
	}
}
