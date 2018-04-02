<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
  <meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google. ">
  <meta name="keywords" content="materialize, admin template, dashboard template, flat admin template, responsive admin template,">
  <title>OMG DAT CMS Registration</title>

  <!-- Favicons>
  <link rel="icon" href="images/favicon/favicon-32x32.png" sizes="32x32">
  <!-- Favicons>
  <link rel="apple-touch-icon-precomposed" href="images/favicon/apple-touch-icon-152x152.png">
  <!-- For iPhone >
  <meta name="msapplication-TileColor" content="#00bcd4">
  <meta name="msapplication-TileImage" content="images/favicon/mstile-144x144.png">
  <!-- For Windows Phone -->


  <!-- CORE CSS-->
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection">
    <!-- Custome CSS-->
    <link href="css/custom-style.css" type="text/css" rel="stylesheet" media="screen,projection">
  <!-- CSS for full screen (Layout-2)-->
  <link href="css/style-fullscreen.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="css/page-center.css" type="text/css" rel="stylesheet" media="screen,projection">

  <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
  <link href="css/prism.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">

</head>

<body class="cyan">
  <!-- Start Page Loading -->
  <div id="loader-wrapper">
      <div id="loader"></div>
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
  </div>
  <!-- End Page Loading -->



  <div id="login-page" class="row">
    <div class="col s12 z-depth-4 card-panel">
      <form action="{{ route('register.create') }}"  method="POST" >
                             {!! csrf_field() !!}
        <div class="row">
          <div class="input-field col s12 center">
            <h4>Register</h4>
            <p class="center">Manage your content now !</p>
          </div>
        </div>

        <div class="row margin">
          <div class="input-field col s12 {{ $errors->has('username') ? 'has-error' : '' }}">
            <i class="mdi-social-person-outline prefix"></i>
            <input type="text" name="name" value="{{ old('name') }}" id="name" class="form-control" required="required">
            {!! $errors->first('username', '<span class="text-danger">:message</span>') !!}
            <label for="username" class="center-align">Username</label>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12 {{ $errors->has('email') ? 'has-error' : '' }}">
            <i class="mdi-communication-email prefix"></i>
            <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control" required="required">
            {!! $errors->first('email', '<span class="text-danger">:message</span>') !!}
            <label for="email" class="center-align">Email</label>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12 {{ $errors->has('password') ? 'has-error' : '' }}">
            <i class="mdi-action-lock-outline prefix"></i>
            <input type="password" name="password" id="password" class="form-control" required="required">
            {!! $errors->first('password', '<span class="text-danger">:message</span>') !!}
            <label for="password">Password</label>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12 {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
            <i class="mdi-action-lock-outline prefix"></i>
            <input type="password" required="required" name="password_confirmation" id="password_confirmation" class="form-control">
            {!! $errors->first('password_confirmation', '<span class="text-danger">:message</span>') !!}
            <label for="password-again">Password again</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
             <button type="submit" class="btn btn-default">Register</button>
          </div>
          <div class="input-field col s12">
            <p class="margin center medium-small sign-up">Already have an account? <a href="login.html">Login</a></p>
          </div>
        </div>
    </form>
    </div>
  </div>



  <!-- ================================================
    Scripts
    ================================================ -->

  <!-- jQuery Library -->
  <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
  <!--materialize js-->
  <script type="text/javascript" src="js/materialize.js"></script>
  <!--prism-->
  <script type="text/javascript" src="js/prism.js"></script>
  <!--scrollbar-->
  <script type="text/javascript" src="js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>

  <!--plugins.js - Some Specific JS codes for Plugin Settings-->
  <script type="text/javascript" src="js/plugins.js"></script>

</body>


<!-- Mirrored from demo.geekslabs.com/materialize/v2.1/layout02/user-register.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 25 Feb 2018 23:22:43 GMT -->
</html>
