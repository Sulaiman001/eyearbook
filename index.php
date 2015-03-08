<?php
require 'core/init.php';

$set = '2013/2014';
$data = $users->retrieve_all($set);
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Thermacians >> Year Book</title>

<!-- jQuery - http://jquery.com/ -->
<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>

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
<link rel="stylesheet" href="css/main_stylesheet.css" type="text/css">
<link rel="stylesheet" href="css/responsive_stylesheet.css" type="text/css">

<!-- Favicon -->
<link rel="shortcut icon" href="images/favicon.ico">

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
                    <li><a href="index.php" class="nav_link"  id="nav_current" title="Home">Home</a></li>
                    <li><a href="admin/" class="nav_link" title="Admin">Admin</a></li>
                    <li><a href="contact.php" class="nav_link" title="Contact">Contact</a></li>
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

<!-- Content Wrap -->
<div id="content_wrap">

<!-- Top Categories -->
<div class="categories">
    <nav>
        <ul>
            <li><a href="#" class="categories_link" id="current_categories" title="See All" style="background-color: #465772; color: #FFF;">All</a></li>
            <li><a href="#" class="categories_link" title="2013/2014 Set" style="background-color: #465772; color: #FFF;">2013/2014</a></li>
            <li><span class="categories_link">2014/2015</span></li>
            <li><span class="categories_link">2015/2016</span></li>
            <li><span class="categories_link">2016/2017</span></li>
            <li><span class="categories_link">2017/2018</span></li>
            <li><span class="categories_link">2018/2019</span></li>
            <li><span class="categories_link">2019/2020</span></li>
            <li><span class="categories_link">2020/2021</span></li>
            <li><a class="categories_link" id="more" style="background-color: #465772; color: #FFF;"><i class="fa fa-angle-double-down fa-lg" id="sort_down"></i></a></li>
        </ul>
    </nav>
</div>

<!-- Unlisted Categories - Press "#more" to show -->
<div id="categories_unlisted" class="categories">
    <nav>
        <ul>
            <li><span class="categories_link">2021/2022</span></li>
            <li><span class="categories_link">2022/2023</span></li>
            <li><span class="categories_link">2023/2024</span></li>
            <li><span class="categories_link">2024/2025</span></li>
        </ul>
    </nav>
</div>
</div>
<div id="thumbnails">
    <ul class="img-list" style="list-style-type: none;">
        <?php
            foreach ($data as $row) {

                echo '<li id="thumbs"><a href="admin/view.php?id='.$row[0].'"><img src="admin/'.$row[18].'" /><span class="text-content"><span>'.$row[1].', '.$row[2].'</span></a></li>';
            }
        ?>
    </ul>
</div>

<!-- Pagination/Social Media -->
<footer id="page_footer">

    <nav id="pagination" style="padding-top: 50px;">

        <!-- Footer Navigation -->
        <ul>
            <li><a href="#" class="pagination_link" id="left"><i class="fa fa-angle-double-left"></i> Previous</a></li>
        </ul>
        <ul>
            <li><a href="#" class="pagination_link">A-D</a></li>
            <li><a href="#" class="pagination_link" id="current_page">E-G</a></li>
            <li><a href="#" class="pagination_link">H-J</a></li>
            <li>...</li>
            <li><a href="#" class="pagination_link">W-Z</a></li>
        </ul>
        <ul>
            <li><a href="#" class="pagination_link">Next <i class="fa fa-angle-double-right"></i></a></li>
        </ul>

    </nav>

</footer>

<footer id="footer_banner">

    <div id="footer_banner_wrap">&#169; Copyright - <a style="text-decoration: none; color: #5B6D8A;" target="_blank" href="http://ng.linkedin.com/in/gondy/">Okwara Godswill</a> - 2014</div>

</footer>

</section>

<!-- Blur.js - https://github.com/jakiestfu/Blur.js -->
<script type="text/javascript" src="js/blur.min.js"></script>

<!-- FlexSlider -->
<script src="js/jquery.flexslider-min.js"></script>

<!-- Custom Javascript -->
<script src="js/custom.js"></script>
</body>
</html>
