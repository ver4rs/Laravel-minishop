@extends('layouts.app')

@section('title', 'Users')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading bg-info"><strong>Users</strong></div>
                <div class="panel-body">
                    <!-- Table -->
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>email</th>
                                <th>Account created</th>
                                <th>Role</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ date('d.m Y H:i:s', strtotime($item->created_at)) }}</td>
                                <td>{{ $item->role }}</td>
                                <td>
                                    <a href="{{ route('user.edit', $item->id) }}">edit</a>
                                    {{--<a href="javascript:void(0)" onclick="--}}
                                                     {{--document.getElementById('delete-form').submit();">delete</a>--}}

                                    {!! Form::open(['route'=> array('user.destroy', $item->id), 'id' => 'delete-form', 'style' => '']) !!}
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        {!! Form::button('delete', ['type' => 'submit', 'class' => 'btn btn-small btn-danger', 'title' => 'delete']) !!}

                                    {!! Form::close() !!}
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