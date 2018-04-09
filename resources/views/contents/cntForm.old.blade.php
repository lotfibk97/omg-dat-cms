@extends('layouts.base')

@section('style')


@stop

@section('content')

<div class="row blue-text">
  <div class="col m10 offset-m1">
    <h2> Edit your content </h2>
  </div>
</div>

<div class="row">
  <div class="col s12 m10 offset-m1">

    <div class="col s12 l10 offset-l1">
      <div class="card-panel">

        <div class="row">
          <form class="col s12" action="#" method="post" enctype="multipart/form-data">
          {!! csrf_field() !!}

            <div class="row">
              <div class="input-field col s12">
                <input id="title" type="text" name="title">
                <label for="title">Title</label>
              </div>
            </div>

            <div class="row">
              <div class="input-field col s12">
                <textarea id="description" name="description" class="materialize-textarea"></textarea>
                <label for="description">Description</label>
              </div>
            </div>

            @section('media-input')
              <p>Awesome input will be here</p>
            @show

            <div class="row">
              <div class="input-field col s12">
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
