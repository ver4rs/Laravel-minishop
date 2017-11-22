@extends('layouts.app')

@section('title', 'Product' . $product->name)

@section('content')
<div class="container">
    <div class="row">
        @include('common.top')
        <div class="col-sm-6">
            <img src="{{ url(env('PRODUCT_IMAGE'), $product->image1) }}" alt="" style="height: auto" class="img-responsive">
            <img src="{{ url(env('PRODUCT_IMAGE'), $product->image2) }}" alt="" style="height: 100px; display: inline-block;" class="img-responsive">
            <img src="{{ url(env('PRODUCT_IMAGE'), $product->image3) }}" alt="" style="height: 100px; display: inline-block;" class="img-responsive">
        </div>
        <div class="col-sm-6">
            <h1>{{ $product->name }}</h1>
            <p>{{ $product->description }}</p>
            <p><strong>Price: </strong> {{ $product->price }}</p>
            <p><strong>Count:</strong>&nbsp; {{ $product->count }}</p>

            {!! Form::open(['method' => 'POST', 'route' => array('shopping.store'), 'class' => 'form']) !!}
            {{ csrf_field() }}
            <div class="form-group">
                {!! Form::label('count', 'Count', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-9">
                    {!! Form::hidden('id', $product->id) !!}
                    {!! Form::number('count', 1, ['class' => 'form-control ', 'min' => '1', 'max' => $product->count, 'value' => '1']) !!}
                    {!! Form::button('Buy', ['type' => 'submit', 'class' => 'btn btn-success  btn-block']) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection