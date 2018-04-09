@extends('layouts/base')

@section('style')
@stop


@section('script')
@stop


@section('content')
<div class="row">

  <!-- Add collaborator account form-->
  <div class="col s12 l3">
    <h4 class="blue-text">New Collaborator</h4>
    <form class="card-panel col s12" action="{{route('collab.register.create')}}" method="post">
          {!! csrf_field() !!}

      <div class="input-field col s12 {{ $errors->has('username') ? 'has-error' : '' }}">
        <i class="mdi-social-person-outline prefix"></i>
        <input type="text" name="name" value="{{ old('name') }}" id="name" class="form-control" required="required">
        {!! $errors->first('username', '<span class="text-danger">:message</span>') !!}
        <label for="username" class="center-align">Username</label>
      </div>
      <div class="input-field col s12 {{ $errors->has('email') ? 'has-error' : '' }}">
        <i class="mdi-communication-email prefix"></i>
        <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control" required="required">
        {!! $errors->first('email', '<span class="text-danger">:message</span>') !!}
        <label for="email" class="center-align">Email</label>
      </div>
      <div class="input-field col s12 {{ $errors->has('password') ? 'has-error' : '' }}">
        <i class="mdi-action-lock-outline prefix"></i>
        <input type="password" name="password" id="password" class="form-control" required="required">
        {!! $errors->first('password', '<span class="text-danger">:message</span>') !!}
        <label for="password">Password</label>
      </div>
      <div class="input-field col s12 {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
        <i class="mdi-action-lock-outline prefix"></i>
        <input type="password" required="required" name="password_confirmation" id="password_confirmation" class="form-control">
        {!! $errors->first('password_confirmation', '<span class="text-danger">:message</span>') !!}
        <label for="password-again">Password again</label>
      </div>
      <div class="input-field col s6 offset-s3" style="margin-bottom:5px;">
         <button type="submit" class="col s12 btn btn-default">Register</button>
      </div>

    </form>
  </div>
  <!-- /Add collaborator account form-->

  <!-- collaborators List-->
  <div class="col s12 l9">

    <div class="col m10 offset-m1 blue-text">
      <h2>All Collaborators </h2>
    </div>

    <div class="col s12 m10 offset-m1">
      <table class="striped centered table-responsive">

        <thead>
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Hiring date</th>
            <th>delete</th>
          </tr>
        </thead>

        <tbody>
          @foreach($collabs as $collab)
          <tr>
            <td>{{$collab->name}}</td>
            <td>{{$collab->email}}</td>
            <td>{{$collab->created_at}}</td>
            <form action="{{route('collaborator.delete',$collab->id)}}" method="post">
              {!! csrf_field() !!}
            <td><button type="submit" class="waves-effect waves-light btn-floating red">
              <i class="mdi-action-delete"></i></button></td>
            </form>
          </tr>
          @endforeach
        </tbody>

      </table>
    </div>

  </div>
  <!--  /collaborators List-->

</div>
@stop
