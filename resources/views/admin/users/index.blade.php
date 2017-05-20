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

  <h1>Users</h1>
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
          @if($users)
            @foreach ($users as $user)
              <tr>
                <td>{{ $user->id }}</td>
                <td><img width="50" src="{{ $user->photo ? $user->photo->path: 'http://placehold.it/50x50' }}" alt="" class="img-responsive img-rounded"></td>
                <td><a href="{{ route('admin.users.edit', ['id' => $user->id]) }}">{{ $user->name }}</a></td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role->name }}</td>
                <td>{{ $user->is_active == 1 ?'Active': 'Not Active' }}</td>
                <td>{{ $user->created_at ? $user->created_at->diffForHumans(): "" }}</td>
                <td>{{ $user->updated_at ? $user->updated_at->diffForHumans(): "" }}</td>
              </tr>
            @endforeach
          @endif
        </tbody>
      </table>
  </div>
@endsection
