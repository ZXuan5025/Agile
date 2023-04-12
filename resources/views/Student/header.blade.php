<!DOCTYPE html>
<html lang="en">
<head>
<!-- Basic -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Site Metas -->
<title>SmartEDU - Education Responsive HTML5 Template</title>
<meta name="keywords" content="">
<meta name="description" content="">
<meta name="author" content="">

<!-- Site Icons -->
<link rel="shortcut icon" href="Student/images/favicon.ico" type="image/x-icon" />
<link rel="apple-touch-icon" href="Student/images/apple-touch-icon.png">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="Student/css/bootstrap.min.css">
<!-- Site CSS -->
<link rel="stylesheet" href="Student/css/style.css">
<!-- ALL VERSION CSS -->
<link rel="stylesheet" href="Student/css/versions.css">
<!-- Responsive CSS -->
<link rel="stylesheet" href="Student/css/responsive.css">
<!-- Custom CSS -->
<link rel="stylesheet" href="Student/css/custom.css">



<!-- Modernizer for Portfolio -->
<script src="Student/js/modernizer.js"></script>

<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->



</head>

<body class="host_version">



    <!-- LOADER -->
    <div id="preloader">
        <div class="loader-container">
            <div class="progress-br float shadow">
                <div class="progress__item"></div>
            </div>
        </div>
    </div>
    <!-- END LOADER -->

    <!-- Start header -->
    <header class="top-navbar">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.html">
                    <img src="Student/images/logo.png" alt="" />
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbars-host"
                    aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbars-host">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active"><a class="nav-link" href="index.html">Home</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown-a"
                                data-toggle="dropdown">About Us </a>
                            <div class="dropdown-menu" aria-labelledby="dropdown-a">
                                <a class="dropdown-item" href="#">Teacher </a>
                                <a class="dropdown-item" href="#">Blog </a>
                                <a class="dropdown-item" href="#">Contact </a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown-a"
                                data-toggle="dropdown">Course </a>
                            <div class="dropdown-menu" aria-labelledby="dropdown-a">
                                <a class="dropdown-item" href="course-grid-2.html">Course Grid 2 </a>
                                <a class="dropdown-item" href="course-grid-3.html">Course Grid 3 </a>
                                <a class="dropdown-item" href="course-grid-4.html">Course Grid 4 </a>
                            </div>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="/homepageadmin">Announcements</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Profile</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a class="hover-btn-new log orange" href="#" data-toggle="modal"
                                data-target="#login"><span>Book Now</span></a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <!-- End header -->

    <!-- ALL JS FILES -->
    <script src="Student/js/all.js"></script>
    <!-- ALL PLUGINS -->
    <script src="Student/js/custom.js"></script>
    <script src="Student/js/timeline.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        timeline(document.querySelectorAll('.timeline'), {
            forceVerticalMode: 700,
            mode: 'horizontal',
            verticalStartPosition: 'left',
            visibleItems: 4
        });
    </script>
