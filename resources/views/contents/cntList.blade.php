@extends('layouts.base')

@section('style')


@stop

@section('content')

<div class="row blue-text">
  <div class="col m10 offset-m1">
    <h2>List of all your {{ $type }} contents </h2>
  </div>
</div>

<div class="row">
  <div class="col s12 m10 offset-m1">

    <table class="striped centered table-responsive">
        <thead>
          <tr>
            <th>Publication</th>
            <th>Content</th>
            <th>Description</th>
            <th>Creator</th>
            <th>Last update</th>
            <th>Edit</th>
          </tr>
        </thead>

        <tbody>
          @foreach ($contents as $content)
          <tr>
            <td>{{ $content->publication}}</td>
            <td>{{ $content->title}}</td>
            <td>{{ $content->description}}</td>
            <td>{{ $content->creator}}</td>
            <td>{{ $content->updated_at}}</td>
            <td><a class="waves-effect waves-light btn-floating orange"
              href="/contents/{{$type}}/{{$content->id}}">
              <i class="mdi-editor-mode-edit"></i>
            </a></td>
          </tr>
          @endforeach
        </tbody>
      </table>

  </div>
</div>

@stop
