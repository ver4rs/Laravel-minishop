@extends('layouts.app')

@section('title', 'Edit user')

@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading bg-info"><strong>User edit</strong></div>
                    <div class="panel-body">

                        {!! Form::model($user, ['method' => 'PATCH', 'route' => array('user.update', $user->id), 'class' => 'form-horizontal', 'role' => 'form']) !!}

                        <div class="form-group">
                            {!! Form::label('name', 'Name', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('name', null, ['class' => 'form-control ', 'placeholder' => 'name', 'id' => 'name']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('email', 'Email', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('email', null, ['class' => 'form-control email', 'placeholder' => 'email', 'id' => 'email']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('role', 'Role', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::select('role', ['basic' => 'basic', 'admin' => 'admin'], null, ['class' => 'form-control role', 'id' => 'role']) !!}
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