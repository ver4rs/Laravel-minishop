@extends('layouts.app')

@section('title', 'Products')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading bg-info"><strong>Products</strong> <a href="{{ route('product.create') }}">Add item</a></div>
                <div class="panel-body">
                    <!-- Table -->
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Count</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $item)
                            <tr @if($item->deleted_at) class="bg-danger"  @endif>
                                <td>{{ $loop->iteration }}</td>
                                <td><img src="{{ url(env('PRODUCT_IMAGE'), $item->image1) }}" alt="{{ $item->name }}" class="img-rounded" style="height: 100px;"></td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->price }}</td>
                                <td>{{ $item->count }}</td>
                                <td>
                                    @if($item->deleted_at)
                                        {!! Form::open(['method'=> 'POST', 'route'=> array('product.restoreProduct'), 'id' => 'delete-form', 'style' => '']) !!}
                                        {{ csrf_field() }}
                                        {!! Form::hidden('id', $item->id) !!}
                                        {!! Form::button('restore', ['type' => 'submit', 'class' => 'btn btn-small btn-warning', 'title' => 'restore']) !!}
                                        {!! Form::close() !!}
                                    @else
                                        <a href="{{ route('product.edit', $item->id) }}">edit</a>
                                        {{--<a href="javascript:void(0)" onclick="--}}
                                        {{--document.getElementById('delete-form').submit();">delete</a>--}}

                                        {!! Form::open(['route'=> array('product.destroy', $item->id), 'id' => 'delete-form', 'style' => '']) !!}
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            {!! Form::button('delete', ['type' => 'submit', 'class' => 'btn btn-small btn-danger', 'title' => 'delete']) !!}
                                        {!! Form::close() !!}
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection