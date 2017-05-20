@extends('layouts.admin_app')

@section('content')
    <div class="">
        {!! Form::open(['method' => 'POST', 'action' => ['AdminPostsController@store', $user->id], 'files' => true]) !!}

          <div class="form-group">
              {!! Form::label('title', 'Title: ', ['class' => 'form-control-label']) !!}
              {!! Form::text('title', null, ['class' => 'form-control']) !!}
          </div>

          <div class="form-group">
              {!! Form::label('category_id', 'Category: ', ['class' => 'form-control-label']) !!}
              {!! Form::select('category_id', [1 => 'Choose Options'], null, ['class' => 'form-control']) !!}
          </div>

          <div class="form-group">
              {!! Form::label('body', 'Description: ', ['class' => 'form-control-label', 'rows' => 3]) !!}
              {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
          </div>

          <div class="form-group">
              {!! Form::label('photo_id', 'Photo: ', ['class' => 'form-control-label']) !!}
              {!! Form::file('photo_id', null, ['class' => 'form-control']) !!}
          </div>

          <div class="form-group">
              {!! Form::submit('Create Post', ['class' => 'btn btn-primary']) !!}
          </div>

        {!! Form::close() !!}

        @include('includes.form-error')
    </div>
@endsection
