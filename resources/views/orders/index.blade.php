@extends('layouts.app')

@section('title', 'Orders')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading bg-info"><strong>Orders</strong></div>
                <div class="panel-body">
                    <!-- Table -->
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>email</th>
                            <th>city</th>
                            <th>address</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $order->user->name or $order->name }}</td>
                                <td>{{ $order->user->email or null }}</td>
                                <td>{{ $order->city }}</td>
                                <td>{{ $order->address }}</td>
                                <td>{{ $order->status }}</td>
                                <td>{{ date('d.m Y H:i:s', strtotime($order->created_at)) }}</td>
                                <td>
                                    <a href="{{ route('order.show', $order->id) }}">Show</a>

                                    @can('isAdmin', App\User::class)
                                        {!! Form::open(['method' => 'post', 'route' => array('order.changeStatus'), 'id' => 'form' . $loop->iteration, 'onChange' => 'document.getElementById("form'. $loop->iteration .'").submit();']) !!}
                                        {!! Form::select('status', ['created' => 'created', 'shipped' => 'shipped'] , $order->status, ['id' => 'selectStatus']) !!}
                                        {!! Form::hidden('id', $order->id) !!}
                                        {!! Form::close() !!}
                                    @endcan
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