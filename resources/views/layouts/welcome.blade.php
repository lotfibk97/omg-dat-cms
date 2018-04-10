<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title> Manage your content</title>

  <!-- Favicons -->
  <link rel="icon" href="images/favicon/puzzle.png" sizes="32x32">
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

  <style media="screen">

    @font-face {
      font-family: "hand";
      src: url("/font/youmurdererbb_reg.ttf");
    }

    @font-face {
      font-family: "hand2";
      src: url("/font/kalam.bold.ttf");
    }

    body {
      height: 100vh;
      width: 100vw;
      margin: 0;
      background: url('/images/welcome2.jpg') no-repeat;
      background-size: 100% 100%;
    }

    .shadow {
      z-index: -1;
      background: rgba(0,0,0,0.3);
      position: absolute;
      top: 0; left: 0; width: 100%; height: 100%;
    }

    .title {
      font-family: "hand2";
      font-size: 5vw;
      /*font-style: italic;*/
      margin: 3vh;
    }

    .wow {
      position: absolute;
      top:10vh; left:35vw;
      z-index: -1;
      font-size: 5vw;
      font-family: "hand";
      color: white;
      transform: rotate(10deg);
    }

    .amazing {
      position: absolute;
      bottom: :10vh; left:35vw;
      z-index: -1;
      font-family: "hand";
      font-size: 5vw;
      color: white;
      transform: rotate(-10deg);
    }

    .menu {
      position: absolute;
      right: 0; top: 0;
      width: 50vw; height: 100vh;
      background: rgba(0,0,0,0.8);
    }

    .description {
      position: relative;
      width: 100%;
      height: 40%;
      margin: 0;
      padding: 15%;
      font-size: 2vw;
      text-align: center;
    }

    .options {
      width: 100%;
      max-height: 60%;
    }

    .option {
      color:white;
      text-align: center;
      padding: 0 !important;
    }



  </style>

</head>

<body>

  <div class="shadow"></div>

  <div class="menu">

    <div class="description white-text">
      Manage your content and monitor your editors with ease and efficiency !
    </div>

    <div class="options">
      <div class="row">
        <div class="col s2 offset-s1 option">
          Sign Up and Create your own blog
        </div>
        <div class="col s2 offset-s2 option">
          Administrate and manage your content
        </div>
        <div class="col s2 offset-s2 option">
          Write and design your assigned content
        </div>
      </div>

      <div class="row">
        <a class="waves-effect waves-light btn col s2 offset-s1" href="{{route('register.get')}}">
          Sign up
        </a>
        <a class="waves-effect waves-light btn col s2 offset-s2" href="{{route('login_admin')}}">
          Login
        </a>
        <a class="waves-effect waves-light btn col s2 offset-s2" href="{{route('login_collab')}}">
          Login
        </a>
      </div>
    </div>

  </div>

  <div class="row" style="margin-bottom:0;">
    <div class="col s6">
      <div class="row"><div class="col offset-s1 title bold-talic">OMG!!!</div></div>
      <div class="row"><div class="col title bold-talic">THAT</div></div>
      <div class="row"><div class="col offset-s2 title bold-talic">CMS &lt3</div></div>
    </div>
  </div>

  <div class="wow">WOW</div>
  <div class="amazing">Amazing !!!!</div>

</body>
</html>
