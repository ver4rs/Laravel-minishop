<?php

namespace App\Http\Controllers;

use App\Helper\CartLogic;
use App\Http\Requests\OrderRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    private $cartLogic;

    public function __construct(CartLogic $cartLogic)
    {
        $this->cartLogic = $cartLogic;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = $this->cartLogic->getOrders(Auth::user()->can('isAdmin', Auth::user()) ? true : false);

        return view('orders.index')->with(['orders' => $orders]);
    }

    /**
     * Display with items and shipping form
     * @return $this
     */
    public function checkout()
    {
        $userId = Auth::user()->id;
        $cartItems = $this->cartLogic->getCartItems($userId);
        $total = $this->cartLogic->getTotalPriceFromCart($userId);

        return view('orders.checkout')->with(['cartItems' => $cartItems, 'total' => $total]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createOrder(OrderRequest $request)
    {
        $this->cartLogic->migrationOrder(Auth::user()->id, $request->all());

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
        $order = $this->cartLogic->getOrder($id);

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

        $this->cartLogic->changeStatusOrder($request->id, $request->status);

        return redirect()->route('order.index')->with('status', 'Status changed');
    }
}
