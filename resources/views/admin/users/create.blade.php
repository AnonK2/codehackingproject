@extends('layouts.admin_app')

@section('content')
    <h1>Create Users</h1>
    <div class="">
        {!! Form::open(['method' => 'POST', 'action' => 'AdminUsersController@store', 'files' => true]) !!}

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
              {!! Form::select('is_active', [0 => 'Not Activate', 1 => 'Activated'], ['class' => 'form-control']) !!}
          </div>

          <div class="form-group">
              {!! Form::submit('Create User', ['class' => 'btn btn-primary']) !!}
          </div>

        {!! Form::close() !!}

        @include('includes.form-error')
    </div>
@endsection
