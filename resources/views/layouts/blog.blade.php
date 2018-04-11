<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>  {{ $title }}</title>

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

    .card.medium {
      height: 200px;
    }

    .card.medium .desc {
      height: 140px;
      overflow: hidden;
      padding-left: 10%;
      padding-right: 10%;
      padding-top: 10px;
    }
    .desc h4 {
      color: #ff4081;
    }
  </style>

</head>

<body class="cyan lighten-4 row">


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

 <header id="header" class="page-topbar">
  <!-- start header nav-->
  <div class="navbar-fixed">
      <nav class="cyan">
          <div class="nav-wrapper">
              <ul class="left">
                <li style="display:hidden;" class="no-hover"><a href="#" class="menu-sidebar-collapse btn-floating btn-flat btn-medium waves-effect waves-light cyan"></a></li>
                <li><h1 class="logo-wrapper "><a href="{{route('welcome')}}" class="brand-logo darken-1"><img src="{{ asset ('images/custom_logo.png') }}" alt="materialize logo"></a> <span class="logo-text">Materialize</span></h1></li>
              </ul>
          </div>
      </nav>
    </div>
    <!-- end header nav-->
  </header>


  <!--h3 class="center" style="color:#ff4081;">Welcome in {{$blog->name}}'s blog</h3-->
  <h3 class="center orange-text">Welcome in {{$blog->name}}'s blog</h3>

  <div class="col s12 m5 l3">

    <div class="col s12">
      <div id="profile-card" class="card">
          <div class="card-image waves-effect waves-block waves-light">
              <img class="activator" src="/images/user-bg.jpg" alt="user background">
          </div>
          <div class="card-content">
              <img src="{{$blog->picture}}" alt="" class="circle responsive-img activator card-profile-image">

              <span class="card-title activator grey-text text-darken-4">{{$blog->name}}</span>
              <p><i class="mdi-action-perm-identity cyan-text text-darken-2"></i> Publications: {{count($publications)}}</p>
              <p><i class="mdi-action-perm-phone-msg cyan-text text-darken-2"></i> Collaborators: {{count($collabs)}}</p>
              <p><i class="mdi-communication-email cyan-text text-darken-2"></i> {{$blog->email}}</p>

          </div>
      </div>
    </div>

  </div>

  <div class="col s12 m7 l9">
    <div class="row">

      @foreach($publications as $publication)

      <div class="col s12 card medium">
        <div class="desc">
          <h4>{{$publication->title}}</h4>
          <p>{{$publication->description}}</p>
        </div>
        <div class="card-action">
          <a href="/publications/view/{{$publication->id}}" class="right">Read more &gt;</a>
        </div>
      </div>

      @endforeach

    </div>
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
