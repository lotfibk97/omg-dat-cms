@extends('contents.cntForm')

@section('media-input')

            <div class="row">
              <div class="input-field col s12" style="margin-top:5vh;">

                <textarea id="url" name="url" class="materialize-textarea">{{$content->html}}</textarea>
                <label for="url">Description</label>

              </div>
            </div>

@stop
