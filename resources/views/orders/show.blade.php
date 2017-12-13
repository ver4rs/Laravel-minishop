@extends('layouts.app')

@section('title', 'Order show')

@section('content')
<div class="container">
    <div class="row">
        @include('common.top')
        <div class="col-sm-12">
            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading bg-info"><strong>Order show</strong> </div>
                <div class="panel-body">
                    <!-- Shopping list -->
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Count</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($order->items as $item)
                            @if($item->product)
                            <tr>
                                <td><img src="{{ url(env('PRODUCT_IMAGE'), $item->product->image1) }}" style="width: 100px;" alt=""></td>
                                <td><a href="{{ route('product.show', $item->product->id) }}">{{ $item->product->name }}</a></td>
                                <td>{{ $item->count }}</td>
                                <td>{{ $item->count * $item->product->price }}</td>
                            </tr>
                            @else
                                <tr>
                                    <td>Deleted products</td>
                                </tr>
                            @endif
                        @empty
                            <tr>
                                <th>Shopping list is empty</th>
                            </tr>
                        @endforelse
                            <tr>
                                <td colspan="4"><strong>Total</strong>&nbsp;<strong>{{ $order->price . 'E' }}</strong></td>
                            </tr>
                        </tbody>
                    </table>

                    <h3>Shipping adddres and infromation</h3>
                    <br>

                    <table class="table table-responsive">
                        <tr>
                            <td><strong>Name:</strong></td>
                            <td>{{ $order->user->name }}</td>
                        </tr>
                        <tr>
                            <td><strong>City:</strong></td>
                            <td>{{ $order->city }}</td>
                        </tr>
                        <tr>
                            <td><strong>Address:</strong></td>
                            <td>{{ $order->address }}</td>
                        </tr>
                        <tr>
                            <td><strong>Status:</strong></td>
                            <td>{{ $order->status }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection