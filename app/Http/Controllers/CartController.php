<?php

namespace App\Http\Controllers;


use App\Cart;
use App\CartItem;
use App\Helper\CartLogic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
	private $cartLogic;
	private $userId;
	
	public function __construct(CartLogic $cartLogic)
	{
		$this->cartLogic = $cartLogic;
		$this->userId = Auth::user()->id ?? null;
	}

	/**
	 * Display a cart with all items
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$cartItems = $this->cartLogic->getCartItems($this->userId);
		$total = $this->cartLogic->getTotalPriceFromCart($this->userId);

		return view('orders.list')->with(['cartItems' => $cartItems, 'total' => $total]);
	}

	/**
	 * Store the specified resource in storage
	 * @param Request $request
	 */
	public function store(Request $request)
	{
		//TODO:: create request for validation product ID with count

		$this->cartLogic->addItemToCart($this->userId, $request->all());

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

		$this->cartLogic->updateCountItem($id, $request->count);


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
		$this->cartLogic->cartItemDestroy($id);

		return redirect()->route('shopping.index')->with('status', 'Product deleted');
	}
}
