@extends('contents.cntForm')

@section('media-input')

            <div class="row">
              <div class="input-field col s12" style="margin-top:5vh;">

                <input id="url" type="text" name="url" value="{{$content->html}}" autofocus>
                <label for="url">URL</label>

                <script type="text/javascript">
                window.setTimeout( function() {
                  document.querySelector('form .row label').classList.add("active");
                },50);
                </script>

              </div>
            </div>

@stop
