@extends('layouts.admin_app')

@section('content')

  @if (Session::has('delete_post_msg'))
    <div class="alert-danger">
        <p>{{ Session::get('delete_post_msg') }}</p>
    </div>
  @elseif (Session::has('update_post_msg'))
    <div class="alert-success">
        <p>{{ Session::get('update_post_msg') }}</p>
    </div>
  @endif

  <h1>Post</h1>
  <div class="">
      <table class="table">
        <thead>
          <tr>
            <th>Id</th>
            <th>Photo</th>
            <th>Owner</th>
            <th>Category</th>
            <th>Title</th>
            <th>Body</th>
            <th>Created</th>
            <th>Updated</th>
          </tr>
        </thead>
        <tbody>
          @if ($posts)
            @foreach ($posts as $post)
              <tr>
                <td>{{ $post->id }}</td>
                <td><img width=50 src="{{ $post->photo ? $post->photo->path: "" }}" alt=""></td>
                <td>{{ $post->user->name }}</td>
                <td>{{ $post->category_id }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->body }}</td>
                <td>{{ $post->created_at->diffForHumans() }}</td>
                <td>{{ $post->updated_at->diffForHumans() }}</td>
              </tr>
            @endforeach
          @endif
        </tbody>
      </table>
  </div>
@endsection
