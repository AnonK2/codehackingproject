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

  <h1>Edit Post</h1>
  <div class="">
    <div class="col-sm-3">
        <img src="{{ $post->photo ? $post->photo->path: 'http://placehold.it/400x400' }}" alt="" class="img-responsive img-rounded">
    </div>

    <div class="col-sm-9">
        {!! Form::model($post, ['method' => 'PATCH', 'action' => ['AdminPostsController@update', $post->id], 'files' => true]) !!}

          <div class="form-group">
              {!! Form::label('title', 'Title : ', ['class' => 'form-control-label']) !!}
              {!! Form::text('title', null, ['class' => 'form-control']) !!}
          </div>

          <div class="form-group">
              {!! Form::label('body', 'Body: ', ['class' => 'form-control-label']) !!}
              {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
          </div>

          <div class="form-group">
              {!! Form::label('photo_id', 'Photo: ', ['class' => 'form-control-label']) !!}
              {!! Form::file('photo_id', null, ['class' => 'form-control']) !!}
          </div>

          <div class="form-group">
              {!! Form::label('category_id', 'Category: ', ['class' => 'form-control-label']) !!}
              {!! Form::select('category_id', ['' => 'Choose Options'] + $category, null, ['class' => 'form-control']) !!}
          </div>

          <div class="form-group">
              {!! Form::submit('Update Post', ['class' => 'btn btn-primary col-sm-5 pull-left']) !!}
          </div>

        {!! Form::close() !!}

        {!! Form::open(['method' => 'DELETE', 'action' => ['AdminPostsController@destroy', $post->id]]) !!}
          <div class="form-group">
              {!! Form::submit('Delete Post', ['class' => 'btn btn-danger col-sm-5 col-sm-offset-1 pull-right']) !!}
          </div>
        {!! Form::close() !!}
    </div>

    @include('includes.form-error')
  </div>
@endsection
