@extends('layouts.app')

@section('title', 'Product')

@section('content')
{!! ''; $method = $product ? 'PATCH' : 'POST'; !!}
{!! ''; $route = $product ? array('product.update', $product->id) : 'product.store'; !!}
{!! ''; $readonly = isset($readonly) ? "readonly" : null; !!}
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading bg-info"><strong>@if(!$readonly) {!! $product ? 'Edit product' : 'Add product' !!} @endif</strong></div>
                    <div class="panel-body">

                        {!! Form::model($product, ['method' => $method, 'route' => $route, 'class' => 'form-horizontal', 'role' => 'form', 'files' => 'true', $readonly]) !!}

                        <div class="form-group">
                            {!! Form::label('name', 'Name', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('name', null, ['class' => 'form-control ', 'placeholder' => 'name', 'id' => 'name', $readonly]) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('description', 'Description', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Description for item', 'rows' => 4, $readonly ]) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('count', 'Count', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::number('count', null, ['class' => 'form-control ', 'min' => '0', 'id' => 'count', $readonly]) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('price', 'Price', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('price', null, ['class' => 'form-control ', 'min' => '0.00', 'step' => '0.00', $readonly]) !!}
                            </div>
                        </div>


                        <div class="form-group">
                            {!! Form::label('image1', 'Image 1', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::file('image1', ['class' => 'form-control ', $readonly]) !!}
                                @if($product && $product->image1)
                                    <img src="{{ url(env('PRODUCT_IMAGE'), $product->image1) }}" alt="" style="height: 70px">
                                    {{ link_to(route('product.destroyImage', ['id' => $product->id, 'key' => 'image1']), 'X') }}
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('image2', 'Image 2', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::file('image2', ['class' => 'form-control ', $readonly]) !!}
                                @if($product && $product->image2)
                                    <img src="{{ url(env('PRODUCT_IMAGE'), $product->image2) }}" alt="" style="height: 70px">
                                    {{ link_to(route('product.destroyImage', ['id' => $product->id, 'key' => 'image2']), 'X') }}
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('image3', 'Image 3', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::file('image3', ['class' => 'form-control ', $readonly]) !!}
                                @if($product && $product->image3)
                                    <img src="{{ url(env('PRODUCT_IMAGE'), $product->image3) }}" alt="" style="height: 70px">
                                    {{ link_to(route('product.destroyImage', ['id' => $product->id, 'key' => 'image3']), 'X') }}
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-9 col-sm-offset-3">
                                {!! Form::button('Change', ['type' => 'submit', 'class' => 'btn btn-warning  btn-block']) !!}
                            </div>
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection