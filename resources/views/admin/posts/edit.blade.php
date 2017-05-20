@extends('layouts.admin_app')

@section('content')

  @if (Session::has('delete_user_msg'))
    <div class="alert-danger">
        <p>{{ Session::get('delete_user_msg') }}</p>
    </div>
  @elseif (Session::has('update_user_msg'))
    <div class="alert-success">
        <p>{{ Session::get('update_user_msg') }}</p>
    </div>
  @endif

  <h1>Edit Post</h1>
  <div class="">
      <table class="table">
        <thead>
          <tr>
            <th>Id</th>
            <th>Photo</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Created</th>
            <th>Updated</th>
          </tr>
        </thead>
        <tbody>

        </tbody>
      </table>
  </div>

  @include('includes.form-error')
@endsection
