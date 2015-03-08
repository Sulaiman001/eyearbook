<?php
require '../core/init.php';
if (isset($_GET['id'])) {

    $id = $_GET['id'];
    $retrieve = $users->get_user($id);

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
<span style="margin: 5px 527px 1px; color: #5B6D8A; margin-top: -40px;">Complete Details of Thermacian</span>
<div id="adminlogin" style="width: 50%;">
    <?php
        foreach ($retrieve as $userdata) {
    ?>
    <div id="picture">
        <img src="<?php echo $userdata[19]; ?>" style="width: 300px; height: 300px; border: 1px solid #5B6D8A; margin: 10px 180px 20px;" />
    </div>
    <div id="details" style="height: 250px;">
        <div id="personal" style="float: left; height: inherit; width: 220px; border-right: 1px dotted #5B6D8A; border-top: 1px dotted #5B6D8A;">
            <h4 style="margin: 5px 45px 10px;">Personal Details</h4>
            <label style="font-weight: bold; font-size: 15px; color: #72879c; margin-left: 5px;">Full Name: </label>
            <label style="font-weight: bold; font-size: 12px; margin-left: 5px;"><i><?php echo $userdata[1].', '. $userdata[2]; ?></i></label><br/>
            <label style="font-weight: bold; font-size: 15px; color: #72879c; margin-left: 5px;">Nick Name: </label>
            <label style="font-weight: bold; font-size: 12px; margin-left: 5px;"><i><?php echo $userdata[4]; ?></i></label><br/>
            <label style="font-weight: bold; font-size: 15px; color: #72879c; margin-left: 5px;">Birthday: </label>
            <label style="font-weight: bold; font-size: 12px; margin-left: 5px;"><i><?php echo $userdata[7]; ?></i></label>
        </div>
        <div id="contact" style="float: left; height: inherit; width: 220px; border-right: 1px dotted #5B6D8A; border-top: 1px dotted #5B6D8A;">
            <h4 style="margin: 5px 45px 10px;">Contact Details</h4>
            <label style="font-weight: bold; font-size: 15px; color: #72879c; margin-left: 5px;">Phone Number: </label>
            <label style="font-weight: bold; font-size: 12px; margin-left: 5px;"><i><?php echo $userdata[6]; ?></i></label><br/>
            <label style="font-weight: bold; font-size: 15px; color: #72879c; margin-left: 5px;">Email: </label>
            <label style="font-weight: bold; font-size: 12px; margin-left: 5px;"><i><?php echo $userdata[5]; ?></i></label><br/>
            <label style="font-weight: bold; font-size: 15px; color: #72879c; margin-left: 5px;">State: </label>
            <label style="font-weight: bold; font-size: 12px; margin-left: 5px;"><i><?php echo $userdata[10]; ?></i></label><br/>
            <label style="font-weight: bold; font-size: 15px; color: #72879c; margin-left: 5px;">LGA: </label>
            <label style="font-weight: bold; font-size: 12px; margin-left: 5px;"><i><?php echo $userdata[11]; ?></i></label><br/>
            <label style="font-weight: bold; font-size: 15px; color: #72879c; margin-left: 5px;">R-Address: </label>
            <label style="font-weight: bold; font-size: 12px; margin-left: 5px;"><i><?php echo $userdata[8]; ?></i></label><br/>
            <label style="font-weight: bold; font-size: 15px; color: #72879c; margin-left: 5px;">P-Address: </label>
            <label style="font-weight: bold; font-size: 12px; margin-left: 5px;"><i><?php echo $userdata[9]; ?></i></label><br/>
            <label style="font-weight: bold; font-size: 15px; color: #72879c; margin-left: 5px;">Twitter Handle: </label>
            <label style="font-weight: bold; font-size: 12px; margin-left: 5px;"><i><?php echo $userdata[14]; ?></i></label><br/>
            <label style="font-weight: bold; font-size: 15px; color: #72879c; margin-left: 5px;">Facebook Link: </label>
            <label style="font-weight: bold; font-size: 12px; margin-left: 5px;"><i><?php echo $userdata[15]; ?></i></label>
        </div>
        <div id="bio" style="float: left; height: inherit; width: 208px; border-top: 1px dotted #5B6D8A;">
            <h4 style="margin: 5px 85px 10px;">Bio</h4>
            <label style="font-weight: bold; font-size: 15px; color: #72879c; margin-left: 5px;">Ambition: </label>
            <label style="font-weight: bold; font-size: 12px; margin-left: 5px;"><i><?php echo $userdata[13]; ?></i></label><br/>
            <label style="font-weight: bold; font-size: 15px; color: #72879c; margin-left: 5px;">Hobbies: </label>
            <label style="font-weight: bold; font-size: 12px; margin-left: 5px;"><i><?php echo $userdata[12]; ?></i></label><br/>
            <label style="font-weight: bold; font-size: 15px; color: #72879c; margin-left: 5px;">About: </label>
            <label style="font-weight: bold; font-size: 12px; margin-left: 5px;"><i><?php echo $userdata[17]; ?></i></label><br/>
        </div>
    </div>
    <?php
    }
    ?>
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
