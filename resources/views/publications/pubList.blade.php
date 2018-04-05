@extends('layouts.base')


@section('style')

@stop


@section('content')

<div class="row blue-text">
  <div class="col m10 offset-m1">
    <h2>List of all your articles </h2>
  </div>
</div>

<a href="#" class="waves-effect waves-light btn-floating btn-large raised"
  style="position:fixed; right:3vw; top:15vh;">
  <i class="mdi-content-add"></i>
</a>

<div class="row">
  <div class="col s12 m10 offset-m1">

    <table class="striped centered table-responsive">
        <thead>
          <tr>
            <th>Ref</th>
            <th>Title</th>
            <th>Status</th>
            <th>Manage</th>
            <th>View</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
        </thead>

        <tbody>
          @foreach ( $publications as $publication )
          <tr>
            <td>{{ $publication->id }}</td>
            <td>{{ $publication->title }}</td>
            @if($publication->status == 'published')
            <td>{{ published }}</td>
            @else
            <td><button class="waves-effect waves-light btn teal" href="publications/publish/{{$publication->id}}">publish</button></td>
            @endif
            <td><a class="waves-effect waves-light btn-floating blue" href="publications/manage/{{$publication->id}}"><i class="mdi-action-view-quilt"></i></a></td>
            <td><a class="waves-effect waves-light btn-floating cyan" href="{{$publication->link}}"><i class="mdi-action-visibility"></i></a></td>
            <td><a class="waves-effect waves-light btn-floating orange" href="publications/{{$publication->id}}"><i class="mdi-editor-mode-edit"></i></a></td>
            <td><a class="waves-effect waves-light btn-floating red" href="publications/delete/{{$publication->id}}"><i class="mdi-action-delete"></i></a></td>
          </tr>
          @endforeach
        </tbody>
      </table>

  </div>
</div>

@stop
