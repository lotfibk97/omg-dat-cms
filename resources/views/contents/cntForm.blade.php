@extends('layouts.base')

@section('style')


@stop
@section('script')

@stop
@section('content')

<div class="row blue-text">
  <div class="col m10 offset-m1">
    <h2> Edit your {{$content->type}} content </h2>
  </div>
</div>

<div class="row">
  <div class="col s12 m10 offset-m1">

    <div class="col s12 l10 offset-l1">
      <div class="card-panel">

        <div class="row">
          <form class="col s12" action="{{route('content.fill.post',$content->id)}}" method="post" enctype="multipart/form-data">
          {!! csrf_field() !!}
            <div class="row">
              <div class="col s4"><p class="center pink-text">title</p></div>
              <div class="col s8"><h4>{{$content->title}}</h4></div>
            </div>

            <div class="row">
              <div class="col s4"><p class="center pink-text">Description</p></div>
              <div class="col s8"><h5>{{$content->description}}</h5></div>
            </div>

            <div class="divider" style="margin-top:5vh;"></div>

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
