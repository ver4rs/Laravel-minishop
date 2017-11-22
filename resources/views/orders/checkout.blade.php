@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="container">
    <div class="row">
        @include('common.top')
        <div class="col-sm-12">
            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading bg-info"><strong>Checkout</strong> </div>
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
                        @forelse($cartItems as $item)
                            <tr>
                                <td><img src="{{ url(env('PRODUCT_IMAGE'), $item->product->image1) }}" style="width: 100px;" alt=""></td>
                                <td><a href="{{ route('product.show', $item->product->id) }}">{{ $item->product->name }}</a></td>
                                <td>{{ $item->count }}</td>
                                <td>{{ $item->getTotal }}</td>
                            </tr>
                        @empty
                            <tr>
                                <th>Shopping list is empty</th>
                            </tr>
                        @endforelse
                            <tr>
                                <td></td>
                                <td></td>
                                <td><strong>Total</strong></td>
                                <td><strong>{{ $total . 'E' }}</strong></td>
                            </tr>
                        </tbody>
                    </table>

                    <h3>Shipping adddres and infromation</h3>
                    <br>

                    {!! Form::open(['method' => 'POST', 'route' => array('order.store'), 'class' => 'form-horizontal', 'role' => 'form']) !!}

                    <div class="form-group">
                        {!! Form::label('name', 'Name', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-9">
                            {!! Form::text('name', null, ['class' => 'form-control ', 'placeholder' => 'name', 'id' => 'name']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('city', 'City', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-9">
                            {!! Form::text('city', null, ['class' => 'form-control ', 'placeholder' => 'name', 'id' => 'name']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('address', 'Address', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-9">
                            {!! Form::text('address', null, ['class' => 'form-control ', 'placeholder' => 'name', 'id' => 'name']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-9 col-sm-offset-3">
                            {!! Form::button('Create order', ['type' => 'submit', 'class' => 'btn btn-success  btn-block']) !!}
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection