<?php
require '../core/init.php';
$general->logged_out_protect();
$displayname = $_SESSION['username'];
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Thermacians >> Year Book</title>

<!-- jQuery - http://jquery.com/ -->
<script type="text/javascript" src="../js/jquery-1.10.2.min.js"></script>

<!-- Adds Support for HTML5 on IE6 - IE9 -->
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!-- Font Awesome by Dave Gandy - http://fontawesome.io/ -->
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">

<!-- Google Fonts -->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Rokkitt:700' rel='stylesheet' type='text/css'>

<!-- FlexSlider by wooThemes - http://www.woothemes.com/flexslider/ -->
<link rel="stylesheet" href="css/flexslider.css" type="text/css">

<!-- Main Stylesheets -->
<link rel="stylesheet" href="../css/main_stylesheet.css" type="text/css">
<link rel="stylesheet" href="../css/responsive_stylesheet.css" type="text/css">

<!-- Favicon -->
<link rel="shortcut icon" href="../images/favicon.ico">

</head>

<body>

<!-- Header -->
<header id="header">

    <div id="header_wrap">

        <!-- Logo (LEFT) -->
        <div id="logo" style="color: #FFF; font: 20px bold; font-family: "><h3>Thermacians</h3></div>

        <!-- Navigation (RIGHT) -->
        <div id="navigation">

            <!-- Responsive Layout Only -->
            <div class="navigation_title"><i class="fa fa-bars"></i> MENU</div>

            <!-- Nav Bar (LEFT) -->
            <nav>
                <ul>
                    <li><a href="../index.php" class="nav_link" title="Home">Home</a></li>
                    <li><a href="index.php" class="nav_link" id="nav_current" title="Admin">Admin</a></li>
                    <li><a href="../contact.php" class="nav_link" title="Contact">Contact</a></li>
                </ul>
            </nav>

            <!-- Search Box (RIGHT) -->
            <div id="search">

                <!-- Responsive Layout Only -->
                <div class="navigation_title"><i class="fa fa-search"></i> Search</div>

                <div id="search_box">
                    <form>
                        <input type="text" id="search_textbox" placeholder="Find a Thermacian...">
                        <input type="submit" id="search_button" value="">
                    </form>
                </div>

            </div>

        </div>

    </div>

</header>

<!-- Subheader -->
<header id="subheader">

    <div id="subheader_wrap">

        <!-- Icon Background -->
        <div id="icon_border"></div>

    </div>

</header>

<!-- Main Content -->
<section id="content">

<!-- Icon -->
<div id="icon_wrap">

    <!-- Icon Image can be modified in #Icon CSS Rule -->
    <div id="icon">
        <a href="#" title="Thermac Logo"><div id="icon_link"></div></a>
    </div>

</div>

<div id="adminlogin">
    <div id="loginheader">
        <h4>Admin - <span id="title">Select Task To Accomplish<span> <span style="float: right; margin-right: -90px;">Welcome, <b><i>Zimustan</i></b><span></h4>
    </div>
    <div id="loginmain">
        <a href="create.php" style="text-decoration: none; color: #72879c;"><div style="float: left; margin: 40px auto 40px 40px;">
            <img src="../images/create.png" style="width: 60px; height: 60px;" /><br />
            <span style="margin-left: 6px;">Create</span>
        </div></a>
        <a href="list.php" style="text-decoration: none; color: #72879c;"><div style="float: right; margin: 40px 50px 40px auto;" >
            <img src="../images/view.png" style=" width: 60px; height: 60px;" /><br />
            <span style="margin-left: -10px;">View & Edit</span>
        </div></a>
    </div>
    <div id="loginbottom">
        <h4><span id="title">Click on <b>View & Edit</b> to View, Edit and Delete<span> <span style="float: right; margin-right: -90px;"><b><a href="logout.php" style="text-decoration: none; color: #72879c;">Logout</a></b><span></h4>
    </div>
</div>

<footer id="footer_banner">

    <div id="footer_banner_wrap">&#169; Copyright - <a style="text-decoration: none; color: #5B6D8A;" target="_blank" href="http://ng.linkedin.com/in/gondy/">Okwara Godswill</a> - 2014</div>

</footer>

</section>

<!-- Blur.js - https://github.com/jakiestfu/Blur.js -->
<script type="text/javascript" src="../js/blur.min.js"></script>

<!-- FlexSlider -->
<script src="../js/jquery.flexslider-min.js"></script>

<!-- Custom Javascript -->
<script src="../js/custom.js"></script>
</body>
</html>
