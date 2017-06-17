<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Game Store - Project</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{ URL::to('assets/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{ URL::to('assets/plugins/node-waves/waves.css') }}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{ URL::to('assets/plugins/animate-css/animate.css') }}" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{ URL::to('assets/css/style.css') }}" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{ URL::to('assets/css/themes/all-themes.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ URL::to('assets/css/SimpleStarRating.css') }}">
        <style>
            body {
                background-color: #999;
                font-family: sans-serif;
                margin: 0;
            }

            main {
                background-color: white;
                width: 80%;
                margin: 0 auto;
                padding: 50px;
                text-align: center;
            }

            table {
                display: inline-block;
            }

            td {
                padding: 1em;
            }

            .golden {
                color: #ee0;
                background-color: #444;
            }

            .big-red {
                color: #f11;
                font-size: 50px;
            }
        </style>
</head>

<body class="theme-red">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>

    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="{{ url('/') }}">GAME STORE Project</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Call Search -->
                    <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li>
                    <li><a href="{{ url('/login') }}"><i class="material-icons">person</i></a></li>
                    <!-- #END# Call Search -->
                    <!-- Notifications -->
                    
                    <!-- #END# Tasks -->
                    <li class="pull-right"><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="material-icons">more_vert</i></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- Menu -->
                      @if(Auth::user())
              <div class="user-info">
                <div class="image">
                    <img src="{{ asset(Auth::user()->img) }}" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ (Auth::user()->name) }}</div>
                    <div class="email">{{ (Auth::user()->email) }}</div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="{{ url('/logout') }}"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            @endif

            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="active">
                        <a href="{{ url('/') }}">
                            <i class="material-icons">select_all</i>
                            <span>All</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/action') }}">
                            <i class="material-icons">videogame_asset</i>
                            <span>Action</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/casino') }}">
                            <i class="material-icons">videogame_asset</i>
                            <span>Casino</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/adventure') }}">
                            <i class="material-icons">videogame_asset</i>
                            <span>Adventure</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/puzzle') }}">
                            <i class="material-icons">videogame_asset</i>
                            <span>Puzzle</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/sports') }}">
                            <i class="material-icons">videogame_asset</i>
                            <span>Sports</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2017 <a href="javascript:void(0);">Game Store</a>.
                </div>
                <div class="version">
                    <b>Version: </b> 1.0.4
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
        <!-- #END# Right Sidebar -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <!-- Media Alignment -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                    @foreach($master_datas as $master_datum)
                        <div class="header">
                            <h1>
                                {{ $master_datum->name }}
                            </h1>
                        </div>
                        <div class="body">
                            <div class="bs-example" data-example-id="media-alignment">
                                <div class="media">
                                    <div class="media-left">
                                        <a href="javascript:void(0);">
                                            <img class="media-object" src="{{ asset($master_datum->img) }}" width="200" height="200">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="media-heading">Category : {{ $master_datum->category }}</h4>
                                        <p>
                                           {{ $master_datum->desc }} 
                                        </p>
                                        <?php if($master_datum->user_rate==0){ ?>
                                        <p> No Review </p>
                                        <?php }else{ ?>
                                        <p>
                                            <span class="rating" data-default-rating="{{ $master_datum->avg_rate }}" disabled></span> {{ $master_datum->avg_rate }}/5.00<br/>
                                            Based on {{ $master_datum->user_rate }} votes & user reviews.
                                        </p>
                                        <?php } ?>
                                        <p>
                                           <span class="col-red" >IDR{{ number_format($master_datum->price,0) }}</span><br/>
                                           <a href="{{ url('/play') }}">
                                                <img class="media-object" src="{{ asset('/img_game/play.png') }}" width="50" height="50">
                                           </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @if (1==1) @break; @endif
                    @endforeach
                    </div>
                </div>
            </div>
            <!-- #END# Media Alignment -->

            <!-- Custom Content -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                User Reviews
                            </h2>
                        </div>
                        <div class="body">
                            @foreach($master_datas as $master_datum)
                                    <?php if($master_datum->user_rate==0){ ?>
                                        <p> No Review </p>
                                    <?php }else{ ?>
                                    <span class="rating" data-default-rating="{{ $master_datum->rate }}" disabled></span><br/>
                                    by <i class="font-italic col-orange">{{ $master_datum->user_name }}</i> - {{ $master_datum->created_at }} <br/>
                                    {{ $master_datum->comment }} <br/>
                                    <hr>
                                    <?php } ?> 
                            @endforeach   
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Custom Content -->
        </div>
    </section>

    <!-- Jquery Core Js -->
    <script src="{{ URL::to('assets/plugins/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{ URL::to('assets/plugins/bootstrap/js/bootstrap.js') }}"></script>

    <!-- Select Plugin Js -->
    <script src="{{ URL::to('assets/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="{{ URL::to('assets/plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{ URL::to('assets/plugins/node-waves/waves.js') }}"></script>

    <!-- Custom Js -->
    <script src="{{ URL::to('assets/js/admin.js') }}"></script>

    <!-- Demo Js -->
    <script src="{{ URL::to('assets/js/demo.js') }}"></script>

    <script src="{{ URL::to('assets/js/SimpleStarRating.js') }}"></script>
        <script>
            var ratings = document.getElementsByClassName('rating');

            for (var i = 0; i < ratings.length; i++) {
                var r = new SimpleStarRating(ratings[i]);

                ratings[i].addEventListener('rate', function(e) {
                    console.log('Rating: ' + e.detail);
                });
            }
        </script>
</body>

</html>