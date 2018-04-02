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
            <th>Title</th>
            <th>Description</th>
            <th>Publication</th>
            <th>Owner</th>
            <th>Creator</th>
            <th>Edit</th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td>History</td>
            <td>Mountain History</td>
            <td>Mont Fuji</td>
            <td>Lotfi BK</td>
            <td>Mounir</td>
            <td><a class="waves-effect waves-light btn-floating orange" href="#"><i class="mdi-editor-mode-edit"></i></a></td>
          </tr>
          <tr>
            <td>History</td>
            <td>Mountain History</td>
            <td>Mont Fuji</td>
            <td>Lotfi BK</td>
            <td>Mounir</td>
            <td><a class="waves-effect waves-light btn-floating orange" href="#"><i class="mdi-editor-mode-edit"></i></a></td>
          </tr>
          <tr>
            <td>History</td>
            <td>Mountain History</td>
            <td>Mont Fuji</td>
            <td>Lotfi BK</td>
            <td>Mounir</td>
            <td><a class="waves-effect waves-light btn-floating orange" href="#"><i class="mdi-editor-mode-edit"></i></a></td>
          </tr>
        </tbody>
      </table>

  </div>
</div>

@stop
