@extends('layouts/base')

@section('style')
<style media="screen">
  .pl {
    padding-left:15%;
  }

  .pr {
    padding-right: 15%;
  }

  .nop {
    padding: 0;
  }

  .mt {
    margin-top:5vh;
  }

  .offset-col {
    padding-left: 5px;
    padding-right: 5px;
  }
</style>
@stop

@section('script')
<script type="text/javascript">

$(".use").click(function () {
  var link=this.parentElement.querySelector(".col input");
  link.select();
  document.execCommand("Copy");
  Materialize.toast("LINK COPIED\n"+link.value,3000);
});

</script>
@stop

@section('content')

<h3 class="blue-text center" >Mange your static files</h3>

<div class="row">

  <div class="col s12 m10 offset-m1 l5 offset-l1 offset-col">
    <div class="card-panel">
      <h5 class="blue-text pl">Images</h5>
      @if(count($images)==0)
        <p class="pl">You don't have any image file</p>
      @endif
      @foreach($images as $image)
        <div class="row mt">
          <!-- image view -->
          <div class="col s4"><img src="{{$image}}" alt="img" width="90%" height="100px"></div>
          <div class="col s8">
            <!-- image url -->
            <div class="col s12 url"><input type="text" name="url" value="{{$image}}"></div>
            <!-- copy button -->
            <button type="button" name="button" class="use col s3 offset-s7 btn waves-effect waves-light orange">use</button>
            <!-- remove button -->
            <form class="col s2 nop" action="#" method="post">
              <button type="submit" name="button" class="btn waves-effect waves-light btn-floating red"><i class="mdi-action-delete"></i></button>
            </form>
          </div>
        </div>
      @endforeach
    </div>
  </div>

  <div class="col s12 m10 offset-m1 l5 offset-col">
    <div class="card-panel">
      <h5 class="blue-text pl">Audios</h5>
      @if(count($audios)==0)
      <p class="pl">You don't have any audio file</p>
      @endif
      @foreach($audios as $audio)
        <div class="row">
          <p>{{$audio->title}}</p>
        </div>
      @endforeach
    </div>
  </div>

</div>

@stop
