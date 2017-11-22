@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        @include('common.top')

        @each('products.article', $products, 'product')

    </div>
</div>
@endsection
