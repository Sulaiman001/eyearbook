<?php
require '../core/init.php';
$general->logged_in_protect();

if (empty($_POST) === false) {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) === true || empty($password) === true) {
        $errors[] = 'Sorry, but we need your email and password.';
    } else if ($users->user_exists($email) === false) {
        $errors[] = 'Sorry that email doesn\'t exists.';
    } else {
        if (strlen($password) > 30) {
            $errors[] = 'The password should be less than 30 characters, without spacing.';
        }
        $login = $users->login($email, $password);
        if ($login === false) {
            $errors[] = 'Sorry, that email/password is invalid';
        }else {
            session_regenerate_id(true);// destroying the old session id and creating a new one
            $_SESSION['id'] =  $login;
            header('Location: task.php');
            exit();
        }
    }
} 
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
<div style="margin: 0 auto 0 540px; color: #72879c; font-size: 10px;">
<?php 
        if(empty($errors) === false){
            echo '<p><i>' . implode('</p><p>', $errors) . '</i></p>';  
        }
?>
</div> 
<div id="adminlogin">
    <div id="loginheader">
        <h4>ADMIN LOGIN</h4>
    </div>
    <div id="loginmain">
        <form method="post" action="#" class="basic-form">
            <label for="email">E-mail address</label>
            <input type="text" name="email" id="email" placeholder="Enter your e-mail" />
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Enter your password" />
            <input type="submit" id="loginbutton" name="loginbutton" value="Login" />
        </form>
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
