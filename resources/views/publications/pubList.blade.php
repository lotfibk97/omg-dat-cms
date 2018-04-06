@extends('layouts.base')


@section('style')

@stop


@section('content')

<div class="row blue-text">
  <div class="col m10 offset-m1">
    <h2>List of all your articles </h2>
  </div>
</div>

<a href="{{ route('publication.create')}}" class="waves-effect waves-light btn-floating btn-large raised"
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
            <th>Description</th>
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
            <td>{{ str_limit($publication->description, $limit = 25, $end = '...') }}</td>
            <td><a class="waves-effect waves-light btn-floating blue" href="{{route('publication.manage',$publication->id)}}"><i class="mdi-action-view-quilt"></i></a></td>
            <td><a class="waves-effect waves-light btn-floating cyan" href="{{$publication->url}}"><i class="mdi-action-visibility"></i></a></td>
            <td><a class="waves-effect waves-light btn-floating orange" href="{{route('publication.update',$publication->id)}}"><i class="mdi-editor-mode-edit"></i></a></td>
            <td>
              <form action="{{route('publication.delete',$publication->id)}}" method="post">
                  {!! csrf_field() !!}
              <button class="waves-effect waves-light btn-floating red" type="submit"><i class="mdi-action-delete"></i></button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>

  </div>
</div>

@stop
