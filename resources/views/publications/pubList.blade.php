@extends('layouts.base')

@section('style')


@stop

@section('content')

<div class="row blue-text">
  <div class="col m10 offset-m1">
    <h2>Your published articles </h2>
  </div>
</div>

<div class="row">
  <div class="col s12 m10 offset-m1">

    <table class="striped centered">
        <thead>
          <tr>
            <th>Ref</th>
            <th>Title</th>
            <th>Contents</th>
            <th>Contribs</th>
            <th>Owner</th>
            <th>Pub date</th>
            <th>Manage</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td>1</td>
            <td>Mont Fuji</td>
            <td>5</td>
            <td>3</td>
            <td>Lotfi BK</td>
            <td>02/04/2018</td>
            <td><a class="waves-effect waves-light btn-floating blue" href="#"><i class="mdi-action-view-quilt"></i></a></td>
            <td><a class="waves-effect waves-light btn-floating orange" href="#"><i class="mdi-editor-mode-edit"></i></a></td>
            <td><a class="waves-effect waves-light btn-floating red"><i class="mdi-action-delete"></i></a></td>
          </tr>
          <tr>
            <td>1</td>
            <td>Mont Fuji</td>
            <td>5</td>
            <td>3</td>
            <td>Lotfi BK</td>
            <td>02/04/2018</td>
            <td><a class="waves-effect waves-light btn-floating blue" href="#"><i class="mdi-action-view-quilt"></i></a></td>
            <td><a class="waves-effect waves-light btn-floating orange" href="#"><i class="mdi-editor-mode-edit"></i></a></td>
            <td><a class="waves-effect waves-light btn-floating red"><i class="mdi-action-delete"></i></a></td>
          </tr>
          <tr>
            <td>1</td>
            <td>Mont Fuji</td>
            <td>5</td>
            <td>3</td>
            <td>Lotfi BK</td>
            <td>02/04/2018</td>
            <td><a class="waves-effect waves-light btn-floating blue" href="#"><i class="mdi-action-view-quilt"></i></a></td>
            <td><a class="waves-effect waves-light btn-floating orange" href="#"><i class="mdi-editor-mode-edit"></i></a></td>
            <td><a class="waves-effect waves-light btn-floating red"><i class="mdi-action-delete"></i></a></td>
          </tr>
        </tbody>
      </table>

  </div>
</div>

@stop
