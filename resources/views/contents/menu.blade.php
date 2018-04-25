@extends('layouts.base')


@section('style')

@stop

@section('script')
<script>

var x = document.getElementById("clickme");

x.addEventListener("click", function(){

  var input = document.createElement('input');
  input.type="text";
  input.name="link";

  var input = document.createElement('input');
  input.type="text";
  input.name="url";

  var label = document.createElement('label');
  label.textContent="Link";
  label.htmlFor="link";

  var label = document.createElement('label');
  label.textContent="URL";
  label.htmlFor="url";

  var field = document.createElement('div');
  field.classList.add("input-field");
  field.classList.add("col");
  field.classList.add("s12");

  field.appendChild(input);
  field.appendChild(label);

  var row = document.createElement('div');
  row.classList.add("row");
  row.appendChild(field);

  var links = document.getElementById("links");
  links.appendChild(row);

});

</script>
@stop


@section('content')

<div class="row blue-text">
  <div class="col m10 offset-m1">
    <h2> Edit your menu </h2>
  </div>
</div>

<div class="row">
  <div class="col s12 m10 offset-m1">

    <div class="col s12 m10 offset-m1 l8 offset-l2">
      <div class="card-panel">

        <div class="row">
          <form class="col s12" action="{{route('content.fill.post',$content->id)}}" method="post" enctype="multipart/form-data">
          {!! csrf_field() !!}

        <input type='color' name="bg_color"/>
          <p class="blue-text">Header picture</p>
          <div class="row">

            <div class="input-field col s6 offset-s1">
              <div class="file-field input-field">

                <input class="file-path validate" name="imagename" type="text">
                <div class="btn">
                  <span>File</span>
                  <input name="image" type="file">
                </div>

              </div>
            </div>

            <div class="col s5 ">
              <!-- replace this src with current menu picture -->
              <img src="{{$content->html}}" alt="default picture" width="100%" height="180px">
            </div>

          </div>


          <p class="blue-text">Menu Options</p>
          <div id="links">

            <div class="row">
              <div class="input-field col s12">
                <input type="text" name="link1" >
                <label for="link1">Link</label>
              </div>
            </div>
            <div id="links">

              <div class="row">
                <div class="input-field col s12">
                  <input type="text" name="url1" >
                  <label for="link1">URL</label>
                </div>
              </div>

            <div class="row">
              <div class="input-field col s12">
                <input type="text" name="link2" >
                <label for="link2">Link</label>
              </div>
            </div>
            <div id="links">

              <div class="row">
                <div class="input-field col s12">
                  <input type="text" name="url2" >
                  <label for="link1">URL</label>
                </div>
              </div>

            <div class="row">
              <div class="input-field col s12">
                <input class ="form-control" type="text" name="link3" >
                <label for="link3">Link</label>
              </div>
            </div>
            <div id="links">

              <div class="row">
                <div class="input-field col s12">
                  <input type="text" name="url3" >
                  <label for="link1">URL</label>
                </div>
              </div>

          </div>

          <div id="clickme" class="btn-floating"> <i class="mdi-content-add">add</i></div>

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
