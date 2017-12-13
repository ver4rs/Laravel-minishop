<?php

namespace App\Http\Controllers;

use App\Helper\Cart\Fasades\CartLogic;
use App\Http\Requests\OrderRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct()
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = CartLogic::getOrders(Auth::user()->can('isAdmin', Auth::user()) ? true : false);

        return view('orders.index')->with(['orders' => $orders]);
    }

    /**
     * Display with items and shipping form
     * @return $this
     */
    public function checkout()
    {
        $userId = Auth::user()->id;
        $cartItems = CartLogic::getCartItems($userId);

        if (!$cartItems) {
        	return redirect()->route('shopping.index');
		}

        $total = CartLogic::getTotalPriceFromCart($userId);

        return view('orders.checkout')->with(['cartItems' => $cartItems, 'total' => $total]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createOrder(OrderRequest $request)
    {
        CartLogic::migrationOrder(Auth::user()->id, $request->all());

        return redirect()->route('home.index')->with('status', 'Order created');
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = CartLogic::getOrder($id);

        return view('orders.show')->with(['order' => $order]);
    }

    /**
     * Change status order
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeStatus(Request $request)
    {
        if (!Auth::user()->can('isAdmin', Auth::user())) {
            return redirect()->route('order.index');
        }

        CartLogic::changeStatusOrder($request->id, $request->status);

        return redirect()->route('order.index')->with('status', 'Status changed');
    }
}
