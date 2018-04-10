@extends('layouts/base')

@section('style')


@stop

@section('content')

<div class="row blue-text">
  <div class="col m10 offset-m1">
    <h2> Edit your profile </h2>
  </div>
</div>

<div class="row">
  <div class="col s12 m10 offset-m1">

    <div class="col s12 l10 offset-l1">
      <div class="card-panel">

        <div class="row">
          <form class="col s12" action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
{!! csrf_field() !!}
            <div class="row">
              <div class="input-field col s12">
                <i class="mdi-social-person-outline prefix"></i>
                <input id="username" type="text" name="name" value="{{$user->name}}">
                  {!! $errors->first('username', '<span class="text-danger">:message</span>') !!}
                <label for="username" class="active">Name</label>
              </div>
            </div>

            <div class="row">
              <div class="input-field col s12">
                <i class="mdi-communication-email prefix"></i>
                <input id="email" name="email" type="email" value="{{$user->email}}"></input>
                  {!! $errors->first('email', '<span class="text-danger">:message</span>') !!}
                <label for="email" class="active">Email</label>
              </div>
            </div>

            <div class="row">
              <div class="input-field col s12">
                <i class="mdi-action-lock-outline prefix"></i>
                <input id="password" name="password" type="password"></input>
                  {!! $errors->first('password', '<span class="text-danger">:message</span>') !!}
                <label for="password" class="active">New Password</label>
              </div>
            </div>

            <div class="row">
              <div class="input-field col s12">
                <i class="mdi-action-lock-outline prefix"></i>
                <input id="password2" name="password2" type="password"></input>
                <label for="password2" class="active">New Password Again</label>
              </div>
            </div>

            <div class="row">
              <div class="input-field col s12">
                <i class="mdi-action-lock-outline prefix"></i>
                <input id="password3" name="password3" type="password"></input>
                {!! $errors->first('password', '<span class="text-danger">:message</span>') !!}
                <label for="password3" class="active">Old password</label>
              </div>
            </div>

            <div class="row">
              <div class="input-field col s12">

                <div class="card-panel col s3" style="height:25vmin; padding:0;">
                  <img src="/static/images/aaa.jpg" alt="Profile" width="100%" height="100%">
                </div>

                <div class="file-field col s8 offset-s1">
                  <input class="file-path validate" type="text" name="image_name">
                  {!! $errors->first('image', '<span class="text-danger">:message</span>') !!}
                  <div class="btn">
                    <span>File</span>
                    <input type="file" name="image">
                  </div>
                </div>

              </div>
            </div>

            <div class="row">
              <div class="input-field col s12" style="margin-top:-10vh;">
                <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Submit
                  <i class="mdi-content-send right"></i>
                </button>
              </div>
            </div>

          </form>

        </div>
      </div>
    </div>

  </div>
</div>

@stop
