<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
  <title> {{$title}}</title>

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

  @section('style')
    <style>

    </style>
  @show

</head>

<body style="background:#e9f8df;">
  <!-- Start Page Loading -->
  <div id="loader-wrapper">
      <div id="loader"></div>
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
  </div>
  <!-- End Page Loading -->

  <!-- //////////////////////////////////////////////////////////////////////////// -->

     <!-- START HEADER -->
     <header id="header" class="page-topbar">
        <!-- start header nav-->
        <div class="navbar-fixed">
            <nav class="cyan">
                <div class="nav-wrapper">
                    <ul class="left">
                      <li class="no-hover"><a href="#" data-activates="slide-out" class="menu-sidebar-collapse btn-floating btn-flat btn-medium waves-effect waves-light cyan"><i class="mdi-navigation-menu" ></i></a></li>
                      <li><h1 class="logo-wrapper "><a href="{{route('welcome')}}" class="brand-logo darken-1"><img src="{{ asset ('images/custom_logo.png') }}" alt="materialize logo"></a> <span class="logo-text">Materialize</span></h1></li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- end header nav-->
  </header>
  <!-- END HEADER -->

  <!-- //////////////////////////////////////////////////////////////////////////// -->

  <!-- START MAIN -->
  <div id="main">
    <!-- START WRAPPER -->
    <div class="wrapper">

      <!-- START LEFT SIDEBAR NAV-->
      <aside id="left-sidebar-nav">
        <ul id="slide-out" class="side-nav leftside-navigation">
            <li class="user-details cyan darken-2">
                <div class="row">
                    <div class="col col s4 m4 l4">
                        <img src="{{Auth::user()->picture}}" alt="" class="circle responsive-img valign profile-image" style="height:50px !important;">
                    </div>
                    <div class="col col s8 m8 l8">
                        <ul id="profile-dropdown" class="dropdown-content">
                            <li><a href="{{route('profile.update')}}"><i class="mdi-action-face-unlock"></i> Profile</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="{{route('logout')}}"><i class="mdi-hardware-keyboard-tab"></i> Logout</a>
                            </li>
                        </ul>
                        <a class="btn-flat dropdown-button waves-effect waves-light white-text profile-btn" href="#" data-activates="profile-dropdown">{{Auth::user()->name}}<i class="mdi-navigation-arrow-drop-down right"></i></a>
                        @if( Auth::user()->type == 'admin')
                        <p class="user-roal">Admin<p>
                        @else
                        <p class="user-roal">Collaborator<p>
                        @endif
                    </div>
                </div>
            </li>
            <li class="bold">
              <a href="{{route('blog',Auth::id())}}" class="waves-effect waves-cyan">
              <i class="mdi-action-dashboard"></i>Blog</a>
            </li>
            <li class="bold">
              <a href="{{route('publication.list')}}" class="waves-effect waves-cyan"><i class="mdi-editor-mode-edit">
              </i>Publications</span></a>
            </li>
            <li class="no-padding">
                <ul class="collapsible collapsible-accordion">
                    <li class="bold"><a class="collapsible-header waves-effect waves-cyan active"><i class="mdi-content-content-copy"></i>Contents</a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="{{route('content.text')}}">Texts</a>
                                </li>
                                <li><a href="{{route('content.image')}}">Images</a>
                                </li>
                                <li><a href="{{route('content.audio')}}">Audio</a>
                                </li>
                                <li><a href="{{route('content.video')}}">Video</a>
                                </li>
                                <li><a href="{{route('content.menu')}}">Menu</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="bold">
                      <a href="{{route('collaborator.list')}}" class="waves-effect waves-cyan">
                      <i class="mdi-image-timer-auto"></i>Collaborators</span></a>
                    </li>
                    <li class="bold">
                      <a href="{{route('content.manage')}}" class="waves-effect waves-cyan">
                        <i class="mdi-editor-insert-drive-file"></i>Static Files</span></a>
                    </li>
                </ul>
            </li>
        </ul>

      </aside>
      <!-- END LEFT SIDEBAR NAV-->

      <!-- //////////////////////////////////////////////////////////////////////////// -->

      <!-- START CONTENT -->
      <section id="content">

        <!--start container-->
        <div class="container">

          @section('content')
            <p>Page content must be here</p>
          @show

        </div>
        <!--end container-->

      </section>
      <!-- END CONTENT -->

      <!-- //////////////////////////////////////////////////////////////////////////// -->
      <!-- START RIGHT SIDEBAR NAV-->
      <aside id="right-sidebar-nav">
      </aside>
      <!-- LEFT RIGHT SIDEBAR NAV-->

    </div>
    <!-- END WRAPPER -->

  </div>
  <!-- END MAIN -->



  <!-- //////////////////////////////////////////////////////////////////////////// -->

  <!-- START FOOTER -->
  <footer class="page-footer">

  </footer>
    <!-- END FOOTER -->



    <!-- ================================================
    Scripts
    ================================================ -->

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

    @section('script')
      <script type="text/javascript">

      </script>
    @show

</body>
</html>
