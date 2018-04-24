@section('script')
<script>

var x = document.getElementById("clickme");
x.addEventListener("click", function(){
  var newLink = document.createElement('input');
  var newLabel = document.createElement('label');

  newLink.class="form-control";
  newLink.type="text";
  newLabel.class="center-align";
  newLabel.text="link"
  document.getElementById("links").appendChild(newLink);
  document.getElementById("links").appendChild(newLabel);

});

</script>
@stop

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
  <div id="links">


  <input class ="form-control" type="text" name="link1" >
  <label for="link1" class="center-align">Link</label>
  <input class ="form-control" type="text" name="link2" >
  <label for="link2" class="center-align">Link</label>
  <input class ="form-control" type="text" name="link3" >
  <label for="link3" class="center-align">Link</label>
</div>

<button id="clickme"> add </button>

@stop
