<?php
require '../core/init.php';
$general->logged_out_protect();

if (empty($_POST) === false && isset($_POST['updatebutton'])) {

    $id = $_GET['id'];
    $othername = mysql_real_escape_string(trim($_POST['othername']));
    $nickname = mysql_real_escape_string(trim($_POST['nickname']));
    $email = mysql_real_escape_string(trim($_POST['email']));
    $phonenumber = mysql_real_escape_string(trim($_POST['phonenumber']));
    $resaddr = mysql_real_escape_string(trim($_POST['resaddr']));
    $hobbies = mysql_real_escape_string(trim($_POST['hobbies']));
    $ambition = mysql_real_escape_string(trim($_POST['ambition']));
    $twitter = mysql_real_escape_string(trim($_POST['twhandle']));
    $facebook = mysql_real_escape_string(trim($_POST['fblink']));

    if (empty($email) === false && empty($phonenumber) === false && empty($resaddr) === false) {

        $execute = $users->update($othername, $nickname, $email, $phonenumber, $resaddr, $hobbies, $ambition, $twitter, $facebook, $id);
        if ($execute === true) {

            $success = "Year Book Entry Updated Successfully";
        }

        else {

            $errors[] = "Year Book Entry Update was not Successful";
        }
    }

    else {

        $errors[] = "Fields marked in red(".'<span style="color: red;">*</span>'.") are compulsory to fill fields.";
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
        elseif (empty($success) === false) {
            echo '<p><i>' .$success. '</i></p>';
        }
?>
</div> 
<div id="adminlogin">
    <div id="loginheader">
        <?php
                $id = $_GET['id'];
                $retrieve = $users->get_user($id);

                foreach ($retrieve as $userdata) {
            ?>
        <h4>Admin - <span id="title">Update This Year Book Entry.<span> <span style="float: right; margin-right: -90px;"><b><i><?php echo $userdata[1]; ?>'s </i></b>Profile<span></h4>
    </div>
    <div id="loginmain">
        <form method="post" action="#" name="createform" class="basic-form">
            <label for="othername">Othername</label>
            <input type="text" name="othername" id="othername" value="<?php echo $userdata[3]; ?>" placeholder="Brown" />
            <label for="nickname">Nickname</label>
            <input type="text" name="nickname" id="nickname" value="<?php echo $userdata[4]; ?>" placeholder="2Face" />
            <label for="email">E-mail address <span style="color: red;">*</span></label>
            <input type="text" name="email" id="email" value="<?php echo $userdata[5]; ?>" placeholder="john.doe@mail.com" />
            <label for="phonenumber">Phone Number <span style="color: red;">*</span></label>
            <input type="text" name="phonenumber" id="phonenumber" value="<?php echo $userdata[6]; ?>"placeholder="+2348031234567" />
            <label for="residentialaddress">Residential Address <span style="color: red;">*</span></label>
            <input type="text" name="resaddr" id="resaddr" value="<?php echo $userdata[8]; ?>" placeholder="No 21 Ojukwu close, Aba, Abia state." />
            <label for="hobbies">Hobbies</label>
            <input type="text" name="hobbies" id="hobbies" value="<?php echo $userdata[9]; ?> "placeholder="Football, Cooking, Skating" />
            <label for="ambition">Ambition</label>
            <input type="text" name="ambition" id="ambition" value="<?php echo $userdata[13]; ?>" placeholder="Want to be an Astronaut" />
            <label for="fblink">Facebook Profile Link</label>
            <input type="text" name="fblink" id="fblink" value="<?php echo $userdata[15]; ?>" placeholder="https://facebook.com/john.doe" />
            <label for="twlink">Twitter Handle</label>
            <input type="text" name="twhandle" id="twhandle" value="<?php echo $userdata[14]; ?>" placeholder="@jDoeOfficial" />
            <input type="submit" id="createbutton" name="updatebutton" value="Update" />

            <?php
        }
        ?>
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
