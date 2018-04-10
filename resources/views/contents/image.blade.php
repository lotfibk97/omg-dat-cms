@extends('contents.cntForm')

@section('media-input')

            <div class="row">

              <div class="input-field col s8 offset-s1">

                <div class="file-field input-field">
                  <input class="file-path validate" type="text" name="image">
                  <div class="btn">
                    <span>File</span>
                    <input type="file">
                  </div>
                </div>

              </div>

              <div class="col s3 ">
                <img width="100%" height="180px"src="{{$content->html}}" alt="default picture">
              </div>

            </div>

@stop
