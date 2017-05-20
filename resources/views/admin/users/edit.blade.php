@extends('layouts.admin_app')

@section('content')
    <h1>Edit User</h1>
    <div class="">
      <div class="col-sm-3">
          <img src="{{ $user->photo ? $user->photo->path: 'http://placehold.it/400x400' }}" alt="" class="img-responsive img-rounded">
      </div>

      <div class="col-sm-9">
          {!! Form::model($user, ['method' => 'PATCH', 'action' => ['AdminUsersController@update', $user->id], 'files' => true]) !!}

            <div class="form-group">
                {!! Form::label('name', 'Name : ', ['class' => 'form-control-label']) !!}
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('email', 'Email: ', ['class' => 'form-control-label']) !!}
                {!! Form::text('email', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('path', 'File: ', ['class' => 'form-control-label']) !!}
                {!! Form::file('path', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('password', 'Password : ', ['class' => 'form-control-label']) !!}
                {!! Form::password('password', ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('role_id', 'Role: ', ['class' => 'form-control-label']) !!}
                {!! Form::select('role_id', ['' => 'Choose Options'] + $roles, null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('is_active', 'Status: ', ['class' => 'form-control-label']) !!}
                {!! Form::select('is_active', [0 => 'Not Activate', 1 => 'Activated'], null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Update User', ['class' => 'btn btn-primary col-sm-5 pull-left']) !!}
            </div>

          {!! Form::close() !!}

          {!! Form::open(['method' => 'DELETE', 'action' => ['AdminUsersController@destroy', $user->id]]) !!}
            <div class="form-group">
                {!! Form::submit('Delete User', ['class' => 'btn btn-danger col-sm-5 col-sm-offset-1 pull-right']) !!}
            </div>
          {!! Form::close() !!}
      </div>

      @include('includes.form-error')
    </div>
@endsection
