<?php

namespace App\Http\Controllers;

use App\Cart;
use App\CartItem;
use App\Helper\CartLogic;
use App\Http\Requests\OrderRequest;
use App\Order;
use App\OrderItem;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    private $cartLogic;
    private $userId;

    public function __construct(CartLogic $cartLogic)
    {
        $this->cartLogic = $cartLogic;
        $this->userId = Auth::user()->id ?? null;
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
        $cartItems = $this->cartLogic->getCartItems($this->userId);
        $total = $this->cartLogic->getTotalPriceFromCart($this->userId);

        return view('orders.checkout')->with(['cartItems' => $cartItems, 'total' => $total]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createOrder(OrderRequest $request)
    {
        $this->cartLogic->migrationOrder($this->userId, $request->all());

        return redirect()->route('home.index');
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

    public function changeStatus(Request $request)
    {
        if (!Auth::user()->can('isAdmin', Auth::user())) {
            return redirect()->route('order.index');
        }

        $this->cartLogic->changeStatusOrder($request->id, $request->status);

        return redirect()->route('order.index')->with('status', 'Status changed');
    }
}
