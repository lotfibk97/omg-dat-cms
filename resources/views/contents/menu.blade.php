@extends('contents.cntForm')

@section('media-input')

            <div class="row">

              <div class="input-field col s8 offset-s1">

                <div class="file-field input-field">
                  <input class="form-control" type="color" name="bg_color">
                  <label for="bg_color" class="center-align">Color</label>
                  </div>
                </div>

              </div>

              <div class="col s3 ">
                <img width="100%" height="180px"src="{{$content->html}}" alt="default picture">
              </div>

            </div>

@stop
