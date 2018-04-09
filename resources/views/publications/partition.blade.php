<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title> Manage your content</title>

  <!-- Favicons>
  <link rel="icon" href="images/favicon/favicon-32x32.png" sizes="32x32">
  < Favicons>
  <link rel="apple-touch-icon-precomposed" href="images/favicon/apple-touch-icon-152x152.png">
  < For iPhone >
  <meta name="msapplication-TileColor" content="#00bcd4">
  <meta name="msapplication-TileImage" content="images/favicon/mstile-144x144.png">
  < For Windows Phone -->

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
  <!--link href="{{ asset ('css/partition.css') }}" rel="stylesheet"-->
  <link href="/partition.css" rel="stylesheet">

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

  <!-- Contents data array -->

  <script type="text/javascript">
    @if ($selected)
    var selected_content={{$selected}};
    @else
    var selected_content;
    @endif
    var current_scroll={{$scroll}};
    var grid_rows={{$rows}};
    var create_url="{{route('content.create',$publication)}}";

    var contents = {
      @foreach($contents as $content)
      "{{$content->id}}":{
        "title":"{{$content->title}}",
        "description":"{{$content->description}}",
        "type":"{{$content->type}}",
        "publication":"{{$content->publication}}",
        "creator":"{{$content->creator}}",
        "owner":"{{$content->owner}}",
        "top":{{$content->top}},
        "left":{{$content->left}},
        "height":{{$content->height}},
        "width":{{$content->width}},
        "center-h":{{$content->hcenter}},
        "center-v":{{$content->vcenter}},
        "displayed":{{$content->displayed}},
      },
      @endforeach
    };

  </script>

  <!-- //////////////////////////////////////////////////////////////////////////// -->



  <!-- Content add button -->
  <div class="add-content">
    <a class="modal-trigger modal-close btn waves-effect waves-light deep-orange darken-3 white-text" href="#content-form">
       new content <i class="mdi-content-add-box right"></i>
    </a>
  </div>

  <!-- Content modal form -->
  <div class="modal" id="content-form">

    <form class="col s12" method="post" action="{{route('content.create',$publication)}}">
    {!! csrf_field() !!}
      <div class="card-panel">

        <h4 class="header2">Define The Content</h4>

        <div class="row">
          <div class="input-field col s12">
            <input id="content-title" type="text" name="title">
            <label for="content-title" id="content-title-label">Title</label>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s12">
            <select id="content-type" name="type">
              <option value = "0" disabled selected class="dark-text">Content Type</option>
              <option value = "text">Text</option>
              <option value = "image">Image</option>
              <option value = "audio">Audio</option>
              <option value = "video">Video</option>
            </select>
            <label for="content-type" id="content-type-label">Type</label>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s12">
            <textarea id="content-description" name="description" class="materialize-textarea"></textarea>
            <label for="content-description" id="content-description-label">Description</label>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s3 offset-s9">
            <button class="btn teal waves-effect waves-light right" type="submit" name="action">
              Submit
              <i class="mdi-content-send right"></i>
            </button>
          </div>
        </div>

      </div>
    </form>

  </div>


  <!-- //////////////////////////////////////////////////////////////////////////// -->


  <!-- Content List -->
  <div class="card-panel teal panel-right contents-basket">

    @foreach ($contents as $content)
    <div class="card-panel white teal-text waves-effect" id="c-{{$content->id}}">
      <h5 class=""> {{ $content->title }} </h5>
      <span class=""> {{ $content->description }} </span>

      @if ($content->displayed == 0)
      <a class="add-to-board btn-floating teal">
        <i class="mdi-content-reply white-text"></i>
      </a>
      @endif

    </div>
    @endforeach

  </div>


  <!-- //////////////////////////////////////////////////////////////////////////// -->


  <!-- Bottom Panel  -->
  <div class="card-panel teal panel-bottom">

    <!-- Currently selected content infos card   -->
    <div class="target-inf card-panel deep-orange accent-2 white-text">
      <h5> / </h5>
      <span> / </span>

      <a class="edit-content btn-floating white modal-trigger" href="#content-form">
        <i class="mdi-editor-border-color"></i>
      </a>
      <div class="delete-content btn-floating white">
        <i class="mdi-action-delete"></i>
      </div>
    </div>


    <!-- Movement buttons -->
    <div class="move-controls">
      <div class="white-text move-title"> Position </div>

      <div class="btn-floating waves-effect waves-light white move-top" style="top:5%; left:40%;">
        <i class="mdi-navigation-expand-less teal-text"></i>
      </div>
      <div class="btn-floating waves-effect waves-light white move-bot" style="bottom:5%; left:40%;">
        <i class="mdi-navigation-expand-more teal-text"></i>
      </div>
      <div class="btn-floating waves-effect waves-light white move-left" style="top:35%; left:10%;">
        <i class="mdi-navigation-chevron-left teal-text"></i>
      </div>
      <div class="btn-floating waves-effect waves-light white move-right" style="top:35%; right:10%;">
        <i class="mdi-navigation-chevron-right teal-text"></i>
      </div>

    </div>


    <!-- Size buttons -->
    <div class="size-controls">
      <div class="white-text size-title"> Size </div>

      <!--div class="btn-floating waves-effect waves-light yellow accent-4 tooltipped less-height"-->
      <div class="btn-floating waves-effect waves-light white tooltipped less-height"
      style="top:5%; left:40%;" data-position="top" data-delay="50" data-tooltip="Less height">
        <i class="mdi-navigation-unfold-less teal-text"></i>
      </div>
      <div class="btn-floating waves-effect waves-light white tooltipped more-height"
      style="bottom:5%; left:40%;"data-position="top" data-delay="50" data-tooltip="more height">
        <i class="mdi-navigation-unfold-more teal-text"></i>
      </div>
      <div class="btn-floating waves-effect waves-light white tooltipped less-width"
      style="top:35%; left:10%;"data-position="left" data-delay="50" data-tooltip="Less width">
        <i class="mdi-editor-vertical-align-top teal-text" style="transform:rotate(-90deg)"></i>
      </div>
      <div class="btn-floating waves-effect waves-light white tooltipped more-width"
      style="top:35%; right:10%;"data-position="right" data-delay="50" data-tooltip="more width">
        <i class="mdi-editor-vertical-align-top teal-text" style="transform:rotate(90deg)"></i>
      </div>

    </div>


    <!-- Currently selected content Settings -->
    <div class="properties-basket teal darken-2 white-text">
      <!-- col 1 -->
      <p style="grid-column:1; grid-row:1;">Owner</p>
      <p style="grid-column:1; grid-row:2;">Creator</p>
      <p style="grid-column:1; grid-row:3;">Publication</p>
      <p style="grid-column:1; grid-row:4;">Type</p>

      <!-- col 2 -->
      <p style="grid-column:2; grid-row:1; text-align:left;">/</p>
      <p style="grid-column:2; grid-row:2; text-align:left;">/</p>
      <p style="grid-column:2; grid-row:3; text-align:left;">/</p>
      <p style="grid-column:2; grid-row:4; text-align:left;">/</p>

      <!-- col 3 -->
      <p style="grid-column:3; grid-row:1;">Top</p>
      <p style="grid-column:3; grid-row:2;">Left</p>
      <p style="grid-column:3; grid-row:3;">Width</p>
      <p style="grid-column:3; grid-row:4;">Height</p>

      <!-- col 4 -->
      <input type="number" value="0" style="grid-column:4; grid-row:1; text-align:left;" class="fix-input inf-top">
      <input type="number" value="0" style="grid-column:4; grid-row:2; text-align:left;" class="fix-input inf-left">
      <input type="number" value="0" style="grid-column:4; grid-row:3; text-align:left;" class="fix-input inf-width">
      <input type="number" value="0" style="grid-column:4; grid-row:4; text-align:left;" class="fix-input inf-height">
      <!--p style="grid-column:4; grid-row:4; text-align:left;">4</p-->

      <!-- col 5 -->
      <p style="grid-column:5; grid-row:1;">Center V</p>
      <p class="input-field" style="grid-column:5; grid-row:2;">
        <input type="checkbox" id="vertical-center">
        <label for="vertical-center"></label>
      </p>
      <p style="grid-column:5; grid-row:3; ">Center H</p>
      <p class="input-field white-text" style="grid-column:5; grid-row:4;">
        <input type="checkbox" id="horizontal-center">
        <label for="horizontal-center"></label>
      </p>

    </div>

  </div>


  <!-- //////////////////////////////////////////////////////////////////////////// -->

  <!-- content managment board -->
  <div class="grid-container">
    <div class="grid-board">

      @foreach ($contents as $content)
      @if($content->displayed)
      <div class="content-space" id="cs-{{$content->id}}" style="grid-area:
        {{$content->top}} /
        {{$content->left}} / span
        {{$content->height}} / span
        {{$content->width}} ;">
        <div class="content-itself card-panel deep-orange-text">
          <h5> {{$content->title}} </h5>
          <span> {{$content->description}} </span>
        </div>
      </div>
      @endif
      @endforeach

    </div>
  </div>

  <!-- 12 vertical lines -->
  <div class="vertical-lines">
    <div class="teal darken-4" style="left:0%; width:3px;"></div>
    <div class="teal" style="left:8.33%;"></div>
    <div class="teal" style="left:16.66%;"></div>
    <div class="teal" style="left:25%;"></div>
    <div class="teal" style="left:33.33%;"></div>
    <div class="teal" style="left:41.66%;"></div>
    <div class="teal" style="left:50%;"></div>
    <div class="teal" style="left:58.33%;"></div>
    <div class="teal" style="left:66.66%;"></div>
    <div class="teal" style="left:75%;"></div>
    <div class="teal" style="left:83.33%;"></div>
    <div class="teal" style="left:91.66%;"></div>
    <div class="teal darken-4" style="left:100%; width:3px;"></div>
  </div>

  <!-- dynamic horizontal lines -->
  <div class="horizontal-lines">
    <div class="horizontal-line teal" style="margin-top:0;"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
    <div class="horizontal-line teal"></div>
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
    <script type="text/javascript" src="/partition.js"></script>

</body>
</html>
