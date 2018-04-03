@extends('contents.cntForm')

@section('media-input')

            <div class="row">
              <div class="input-field col s12">
                <textarea class="form-control" id="summary-ckeditor" name="html"></textarea>
                <script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
                <script>
                  CKEDITOR.replace( 'summary-ckeditor' );
                </script>
              </div>
            </div>

@stop
