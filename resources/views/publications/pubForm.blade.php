@extends('layouts.base')


@section('style')

@stop

@section('script')

@stop


@section('content')

<div class="row blue-text">
  <div class="col m10 offset-m1">
    <h2> Edit your publication </h2>
  </div>
</div>

<div class="row">
  <div class="col s12 m10 offset-m1">

    <div class="col l8 offset-l2">
      <div class="card-panel">

        <div class="row">
          @if($create)
          <form class="col s12" method="post" action="{{ route('publication.create')}}">
          @else
          <form class="col s12" method="post" action="{{ route('publication.update',$pub)}}">
          @endif
          {!! csrf_field() !!}
            <div class="row">
              <div class="input-field col s12">
                @if($create)
                <input id="title" type="text" name="title">
                @else
                <input id="title" type="text" name="title" value="{{$publication->title}}" class="active">
                @endif
                <label for="title">Title</label>
              </div>
            </div>

            <div class="row">
              <div class="input-field col s12">
                @if($create)
                <textarea id="description" name="description" class="materialize-textarea"></textarea>
                @else
                <textarea id="description" name="description" class="materialize-textarea active">{{$publication->description}}</textarea>
                @endif
                <label for="description">Description</label>
              </div>
            </div>

            <div class="container">
              <div class="input-field col s12">

                @foreach ( $collaborators as $collaborator)
                <div class="col s6 l4">
                  <p>{{$collaborator->name}}</p>
                  <p style="margin:0;">
                    @if( $create || $collaborator->role === 'any')
                    <input name="collab{{$collaborator->id}}" value="any" type="radio" id="any{{$collaborator->id}}" checked="checked"></input>
                    @else
                    <input name="collab{{$collaborator->id}}" value="any" type="radio" id="any{{$collaborator->id}}"></input>
                    @endif
                    <label for="any{{$collaborator->id}}" style="top:0;">Any</label>
                  </p>
                  <p style="margin:0;">
                    @if( !$create && $collaborator->role === 'publicator')
                    <input name="collab{{$collaborator->id}}" type="radio" value="publicator" id="publicator{{$collaborator->id}}" checked="checked"></input>
                    @else
                    <input name="collab{{$collaborator->id}}" type="radio" value="publicator" id="publicator{{$collaborator->id}}"></input>
                    @endif
                    <label for="publicator{{$collaborator->id}}" style="top:0;">Publicator</label>
                  </p>
                  <p style="margin:0;">
                    @if( !$create && $collaborator->role === 'editor')
                    <input name="collab{{$collaborator->id}}" type="radio" value="editor" id="editor{{$collaborator->id}}" checked="checked"></input>
                    @else
                    <input name="collab{{$collaborator->id}}" type="radio" value="editor" id="editor{{$collaborator->id}}"></input>
                    @endif
                    <label for="editor{{$collaborator->id}}" style="top:0;">Editor</label>
                  </p>
                  <p style="margin:0;">
                    @if( !$create && $collaborator->role === 'media-manager')
                    <input name="collab{{$collaborator->id}}" type="radio" value="media-manager" id="mediamanager{{$collaborator->id}}" checked="checked"></input>
                    @else
                    <input name="collab{{$collaborator->id}}" type="radio" value="media-manager" id="mediamanager{{$collaborator->id}}"></input>
                    @endif
                    <label for="mediamanager{{$collaborator->id}}" style="top:0;">Media Manager</label>
                  </p>
                </div>
                @endforeach

              </div>
            </div>

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
