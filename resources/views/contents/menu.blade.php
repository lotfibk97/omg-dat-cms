@extends('layouts.base')


@section('style')

@stop

@section('script')
<script>

function getCountLinks(){
    var a = document.getElementsByTagName("input").length;
    b=document.getElementsByTagName("input");
    var i=0;
    var v=0;
    while(i < b.length){
      if(b.item(i).name.startsWith("link")){
        v++;
      }
      i++;
    }
    return v;
}

function getCountUrls(){
    var a = document.getElementsByTagName("input").length;
    b=document.getElementsByTagName("input");
    var i=0;
    var v=0;
    while(i < b.length){
      if(b.item(i).name.startsWith("url")){
        v++;
      }
      i++;
    }
    return v;
}

var x = document.getElementById("clickme");

x.addEventListener("click", function(){

  var y=getCountLinks()+1;
  var z=getCountUrls()+1;
  var input = document.createElement('input');
  input.type="text";
  input.name="link"+y;

  var input2 = document.createElement('input');
  input2.type="text";
  input2.name="url"+z;

  var label = document.createElement('label');
  label.textContent="Link";
  label.htmlFor="link"+y;

  var label2 = document.createElement('label');
  label2.textContent="URL";
  label2.htmlFor="url"+z;

  var field = document.createElement('div');
  field.classList.add("input-field");
  field.classList.add("col");
  field.classList.add("s4");

  var field2 = document.createElement('div');
  field2.classList.add("input-field");
  field2.classList.add("col");
  field2.classList.add("s8");

  field.appendChild(input);
  field2.appendChild(input2);
  field.appendChild(label);
  field2.appendChild(label2);

  var row = document.createElement('div');
  row.classList.add("row");
  row.appendChild(field);
  row.appendChild(field2);

  var links = document.getElementById("links");
  links.appendChild(row);

  var submit = document.getElementById("submit");
  form.removeChild(submit);
  form.appendChild(submit);
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
          <form class="col s12" action="{{route('content.fillMenu.post')}}" method="post" enctype="multipart/form-data">
          {!! csrf_field() !!}


          <!-- Header Image Input -->
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
              <img src="{{$menu->image}}" alt="default picture" width="100%" height="180px">
            </div>

          </div>

          <!-- Menu Type Select -->
          <select name="types">
            @if($menu->type == "Normal")
            <option value="Normal" selected>Normal</option>
            <option value="Hamburger">Hamburger</option>
            @else
            <option value="Normal">Normal</option>
            <option value="Hamburger" selected>Hamburger</option>
            @endif
          </select>
          <label for="types">Type of the menu</label>
          <p class="blue-text">Menu Options</p>



          <!-- Menu Option -->
          <div id="links">

            <?php $i=1; ?>
            @foreach( $links as $link)
            <div class="row">
              <div class="input-field col s4">
                <input type="text" name="link{{$i}}" value="{{$link->name}}" >
                <label for="link{{$i}}">Link</label>
              </div>

              <div class="input-field col s8">
                <input type="text" name="url{{$i}}" value="{{$link->url}}">
                <label for="url{{$i}}">URL</label>
              </div>
            </div>
            <?php $i=$i+1; ?>
            @endforeach

          </div>

          <div id="clickme" class="btn-floating"> <i class="mdi-content-add">add</i></div>

          <div class="row">
            <div class="input-field col s12">
              <button class="btn cyan waves-effect waves-light right" type="submit" name="action" id="submit">Submit
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
