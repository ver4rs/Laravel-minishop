@extends('layouts.app')

@section('title', 'Shopping list')

@section('content')
<div class="container">
    <div class="row">
        @include('common.top')
        <div class="col-sm-12">
            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading bg-info"><strong>Shopping list</strong> </div>
                <div class="panel-body">
                    <!-- Table -->
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Count</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($cartItems as $item)
                            <tr>
                                <td><img src="{{ url(env('PRODUCT_IMAGE'), $item->product->image1) }}" style="width: 100px;" alt=""></td>
                                <td><a href="{{ route('product.show', $item->product->id) }}">{{ $item->product->name }}</a></td>
                                <td>{{ $item->count }}</td>
                                <td>{{ $item->getTotal }}</td>
                                <td>
                                    {!! Form::open(['method' => 'PATCH', 'route'=> array('shopping.update', $item->id), 'id' => 'delete-form', 'style' => 'display: inline;']) !!}
                                    {{ csrf_field() }}
                                    {!! Form::hidden('id', $item->product->id) !!}
                                    {!! Form::number('count', $item->count, ['class' => '', 'min' => '1', 'max' => $item->product->count]) !!}

                                    {!! Form::button('update', ['type' => 'submit', 'class' => 'btn btn-small btn-warning', 'title' => 'delete']) !!}
                                    {!! Form::close() !!}

                                    {!! Form::open(['route'=> array('shopping.destroy', $item->id), 'id' => 'delete-form', 'style' => 'display: inline;']) !!}
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    {!! Form::button('delete', ['type' => 'submit', 'class' => 'btn btn-small btn-danger', 'title' => 'delete']) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <th>Shopping list is empty</th>
                            </tr>
                        @endforelse

                        @if($cartItems)
                            <tr>
                                <td></td>
                                <td></td>
                                <td><strong>Total</strong></td>
                                <td><strong>{{ $total . 'E' }}</strong></td>
                                <td></td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                    @if($cartItems)
                        <div class="col-sm-offset-8">
                            <h4><a href="{{ route('order.checkout') }}">Make order</a></h4>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection