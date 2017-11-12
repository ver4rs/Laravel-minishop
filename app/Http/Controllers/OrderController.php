<?php

namespace App\Http\Controllers;

use App\Cart;
use App\CartItem;
use App\Http\Requests\OrderRequest;
use App\Order;
use App\OrderItem;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->can('isAdmin', Auth::user())) {
            $orders = Order::all();
        } else {
            $orders = Auth::user()->orders;
        }

        return view('orders.index')->with(['orders' => $orders]);
    }

    /**
     * Display with items and shipping form
     * @return $this
     */
    public function checkout()
    {
        $cart = Cart::getCartUser(Auth::user()->id)->first();

        $cartItems = $cart ? $cart->items : null;

        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item->count * $item->product->price;
        }

        return view('orders.checkout')->with(['cartItems' => $cartItems, 'total' => $total]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createOrder(OrderRequest $request)
    {
        $cart = Cart::getCartUser(Auth::user()->id)->first();

        if (!$cart) {
            return redirect()->route('shopping.list');
        }

        $cartItems = $cart ? $cart->items : null;

        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item->count * $item->product->price;
        }


        $order = new Order;
        $order->user_id = Auth::user()->id;
        $order->name = $request->name;
        $order->city = $request->city;
        $order->address = $request->address;
        $order->price = $total;
        $order->save();

        foreach ($cartItems as $item) {
            $orderItem = new OrderItem;
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $item->product->id;
            $orderItem->count = $item->count;
            $orderItem->save();

            // update product
            Product::updateCount($item->product->id, $item->product->count, $item->count);

            CartItem::destroy($item->id);
        }

        Cart::destroy($cart->id);


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
        $order = Auth::user()->orders()->findOrFail($id);


        return view('orders.show')->with(['order' => $order]);
    }

    public function changeStatus(Request $request)
    {
        if (!Auth::user()->can('isAdmin', Auth::user())) {
            return redirect()->route('order.index');
        }

        Order::findOrFail($request->id)
            ->update(['status' => $request->status]);

        return redirect()->route('order.index')->with('status', 'Status changed');
    }
}
