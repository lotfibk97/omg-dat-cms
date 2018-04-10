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

    #contents_grid {
      display: grid;
      grid-template-columns:repeat(12,1fr);
    }

  </style>

</head>

<body class="cyan lighten-4">


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

  <div id="contents_grid" style="grid-template-rows: repeat({{$rows}},50px);">


    @foreach($contents as $content)

    @if($content->type=="text")
    <div style="grid-area:{{$content->top}} / {{$content->left}} / span {{$content->height}} / span {{ $content->width}};">
      Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris bibendum
      vestibulum est nec varius. Nullam finibus et odio eget efficitur. Ut vel nibh
      pellentesque, bibendum metus a, finibus mi. Morbi feugiat fringilla ante, vitae
      dapibus libero facilisis id. Mauris at nisi et magna tempor efficitur.
      Pellentesque sapien orci, faucibus nec tellus et, maximus posuere nisl. Nam ac augue enim.
    </div>
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

</body>
</html>
