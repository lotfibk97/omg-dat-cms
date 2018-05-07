<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>  {{ $publication->title }}</title>

  <!-- Favicons -->
  <link rel="icon" href="/images/favicon/puzzle.png" sizes="32x32">
  <link rel="apple-touch-icon-precomposed" href="images/favicon/apple-touch-icon-152x152.png">
  <meta name="msapplication-TileColor" content="#00bcd4">
  <meta name="msapplication-TileImage" content="images/favicon/mstile-144x144.png">


  <!-- CORE CSS-->
  <link href="{{ asset ('css/materialize.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="{{ asset ('css/style.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
  <!-- Custome CSS-->
  <link href=" {{ asset ('css/custom-style.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
  <!-- CSS for full screen (Layout-2)-->
  <link href=" {{ asset ('css/style-fullscreen.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
  <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
  <link href="{{ asset ('css/prism.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="{{ asset ('js/plugins/perfect-scrollbar/perfect-scrollbar.css') }}" type="text/css" rel="stylesheet" media="screen,projection">

  <!-- //////////////////////////////////////////////////////////////////////////// -->

  <!-- jump to #style-->
  <style media="screen">

    /* Contents Grid Display */
    #contents_grid {
      display: grid;
      grid-template-columns:repeat(12,1fr);
    }

    /* Hamburger Menu Style */
    #menu {
      visibility: hidden;
      transition: opacity 0.7s;
      position: absolute;
      top: 0; left: 0;
      width: 100vw; height: 100vh;
      z-index: 100;
      background: rgba(33, 150, 243, 0.8);
      overflow: hidden;
    }

    #menu a {
      display: block;
      font-size: 4em;
      color: white;
      width: 100%;
      text-align: center;
      margin: auto;
      transition:color 0.5s;
      min-height: 15vh;
    }

    #menu .scroller {
      position: absolute;
      width: 100%; height: 100%;
      overflow: auto;
      display: flex;
      flex-direction: column;
    }

    #menu a:hover {
      color: #ff4081;
    }

    /* Header Menu Style */
    body {
      overflow-x: hidden;
    }

    #header {
      position: relative;
      width: 100%; height: 50vh;
      box-shadow: 0px 0px 10px 0px black;
    }

    #gradient {
      position: absolute;
      top: 0; left: 0;
      width: 100%; height:100%;

      z-index: 100;
      background: linear-gradient(to top,rgba(33, 150, 243,0.9) 15%, transparent 50%);
    }

    #toolbar {
      position: absolute;
      bottom: 0; left: 0;
      width: 100%; height: 15%;

      display: flex;
      justify-content: flex-end;
    }

    #toolbar a{
      color: white;
      font-size: 1.7em;
      margin: auto;
      transition: 0.5s;
    }

    #toolbar a:hover {
      color: #ff4081;
      transform: translateY(-5px);
    }

  </style>

</head>

<body>


  <!-- //////////////////////////////////////////////////////////////////////////// -->

  <!-- Start Page Loading -->
  <div id="loader-wrapper">
    <div id="loader"></div>
    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>
  </div>
  <!-- End Page Loading -->

  <!-- //////////////////////////////////////////////////////////////////////////// -->


  <!-- jump to #script-->
  <script type="text/javascript">
  </script>

  <!-- //////////////////////////////////////////////////////////////////////////// -->


  <!-- BEGIN IF MENU.TYPE == Hambuger -->
  <!-- Hamburger menu button -->
  @if($menu->type == 'Hamburger')
  <div style="position:fixed; top:5vh; left:5vh;" id="open">
    <button class="btn-floating btn-large waves-effect waves-light blue">
      <i class="mdi-navigation-menu white-text"></i></button>
  </div>

  <!-- Hamburger menu  -->
  <div id="menu">
    <div style="position:fixed; top:5vh; left:5vh; z-index:100; cursor:pointer;"
      id="close">
      <i class="mdi-navigation-close medium white-text"></i>
    </div>

    <div class="scroller">
    @foreach($links as $link)
    <a href="{{$link->url}}">{{$link->name}}</a>
    @endforeach
    </div>
  </div>

  <!-- END IF MENU.TYPE == Hambuger -->
@else
  <!-- BEGIN IF MENU.TYPE == TopHeader -->
  <div id="header" class="">
    <img id="picture" src="{{$menu->image}}" width="100%" height="100%"></img>
    <div id="gradient">
      <div id="toolbar">
        @foreach($links as $link)
        <a href="{{$link->url}}">{{$link->name}}</a>
        @endforeach
      </div>
    </div>
  </div>
  <!-- END IF MENU.TYPE == TopHeader -->
@endif

  <div id="contents_grid" style="grid-template-rows: repeat({{$rows}},50px);">


    @foreach($contents as $content)
    @if($content->displayed)

      @if($content->type=="text")
      <div style="grid-area:{{$content->top}} / {{$content->left}} / span {{$content->height}} / span {{ $content->width}};
        padding:3px;" @if($content->hcenter) class="center" @endif>
        {!! $content->html !!}
      </div>
      @endif

      @if($content->type=="image")
      <div class="card-panel"
      style="grid-area:{{$content->top}} / {{$content->left}} / span {{$content->height}} / span {{ $content->width}};
      padding:1px; margin-top:0;">
        <img src="{{$content->html}}" alt="{{$content->title}}" width="100%;" height="100%">
      </div>
      @endif

      @if($content->type=="video")
      <div class=""
      style="grid-area:{{$content->top}} / {{$content->left}} / span {{$content->height}} / span {{ $content->width}};
      padding:0px; margin-top:0;">
      {!! $content->html !!}
      </div>
      @endif

      @if($content->type=="audio")
      <div class="card-panel"
      style="grid-area:{{$content->top}} / {{$content->left}} / span {{$content->height}} / span {{ $content->width}};
      padding:0px; margin-top:0;">
        <audio src="{{$content->html}}" controls width="100%" height="100%"></audio>
      </div>
      @endif

    @endif
    @endforeach

  </div>

  <!-- //////////////////////////////////////////////////////////////////////////// -->
    <!-- ============================= Scripts ============================ -->

    <!-- jQuery Library -->
    <script type="text/javascript" src="{{ asset ('js/jquery-1.11.2.min.js') }}"></script>
    <!--materialize js-->
    <script type="text/javascript" src="{{ asset ('js/materialize.js') }}"></script>
    <!--prism-->
    <script type="text/javascript" src="{{ asset ('js/prism.js') }}"></script>
    <!--scrollbar-->
    <script type="text/javascript" src="{{ asset ('js/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="{{ asset ('js/plugins.js') }}"></script>
    <!--customJs-->

    @if($menu->type=="Hamburger")
    <!-- Hamburger menu script -->
    <script type="text/javascript">
      $("#open").click(function(){
        document.querySelector("#menu").style.visibility="visible";
        document.querySelector("#open").style.visibility="hidden";
      });
      $("#close").click(function(){
        document.querySelector("#menu").style.visibility="hidden";
        document.querySelector("#open").style.visibility="visible";
      });
    </script>
    @endif

</body>
</html>
