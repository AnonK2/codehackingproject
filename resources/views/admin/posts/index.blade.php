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
                <td><a href="{{ route('admin.posts.edit', ['id' => $post->id]) }}">{{ $post->user->name }}</a></td>
                <td>{{ $post->category->name }}</td>
                <td>{{ str_limit($post->title, 25) }}</td>
                <td>{{ str_limit($post->body, 25) }}</td>
                <td>{{ $post->created_at->diffForHumans() }}</td>
                <td>{{ $post->updated_at->diffForHumans() }}</td>
              </tr>
            @endforeach
          @endif
        </tbody>
      </table>
  </div>
@endsection
