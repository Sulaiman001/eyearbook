<?php
require '../core/init.php';
$general->logged_out_protect();

if (empty($_POST) === false && isset($_POST['createbutton'])) {

    $firstname = mysql_real_escape_string(trim($_POST['firstname']));
    $lastname = mysql_real_escape_string(trim($_POST['lastname']));
    $othername = mysql_real_escape_string(trim($_POST['othername']));
    $nickname = mysql_real_escape_string(trim($_POST['nickname']));
    $email = mysql_real_escape_string(trim($_POST['email']));
    $phonenumber = mysql_real_escape_string(trim($_POST['phonenumber']));
    $birthday = mysql_real_escape_string(trim($_POST['dob']));
    $resaddr = mysql_real_escape_string(trim($_POST['resaddr']));
    $permaddr = mysql_real_escape_string(trim($_POST['permaddr']));
    $state = mysql_real_escape_string(trim($_POST['state']));
    $lga = mysql_real_escape_string(trim($_POST['lga']));
    $hobbies = mysql_real_escape_string(trim($_POST['hobbies']));
    $ambition = mysql_real_escape_string(trim($_POST['ambition']));
    $twitter = mysql_real_escape_string(trim($_POST['twhandle']));
    $facebook = mysql_real_escape_string(trim($_POST['fblink']));
    $set = mysql_real_escape_string(trim($_POST['set']));
    $about = mysql_real_escape_string(trim($_POST['about']));
    $image = $_FILES['image'];

    if (empty($firstname) === false && empty($lastname) === false && empty($email) === false && empty($phonenumber) === false && empty($birthday) === false && empty($resaddr) === false && empty($permaddr) === false && empty($state) === false && empty($lga) === false && empty($set) === false && empty($about) === false && empty($image) === false) {

        $image['name'] = mysql_real_escape_string($image['name']);
        $imagelink = "processed_photos/main/".date('Y_m_d_H_i_s').$_FILES['image']['name'];
        $tmpname = $_FILES['image']['tmp_name'];
        $filetype = $_FILES['image']['type'];
        $filesize = $_FILES['image']['size'];

        if ($filetype == "image/jpeg" OR $filetype == "image/gif") {

            if (!($filesize/1024 > '2048')) {

                if(move_uploaded_file ($tmpname, $imagelink)){

                    chmod("$imagelink",0777);

                    $thumbwidth = 100;
                    $thumbheight = 100;
                    $thumblink = "processed_photos/thumbs/".date('Y_m_d_H_i_s').$_FILES['image']['name'];

                    if ($filetype == "image/jpeg") {

                        $mainimage = imagecreatefromjpeg($imagelink);
                        $imagewidth = imagesx($mainimage);
                        $imageheight = imagesy($mainimage);
                        $thumb=imagecreatetruecolor($thumbwidth,$thumbheight);
                        imageCopyResized($thumb, $mainimage, 0, 0, 0, 0, $thumbwidth, $thumbheight, $imagewidth, $imageheight);
                        imagejpeg($thumb, $thumblink);
                        chmod("$thumblink", 0777);
                    }

                    if ($filetype == "image/gif") {

                        $mainimage = imagecreatefromgif($imagelink);
                        $imagewidth = imagesx($mainimage);
                        $imageheight = imagesy($mainimage);
                        $thumb=imagecreatetruecolor($thumbwidth,$thumbheight);
                        imageCopyResized($thumb, $mainimage, 0, 0, 0, 0, $thumbwidth, $thumbheight, $imagewidth, $imageheight);
                        imagegif($thumb, $thumblink);
                        chmod("$thumblink", 0777);
                    }

                    $newentry = $users->new_entry($firstname, $lastname, $othername, $nickname, $email, $phonenumber, $birthday, $resaddr, $permaddr, $state, $lga, $hobbies, $ambition, $twitter, $facebook, $set, $about, $thumblink, $imagelink);
                    if ($newentry === true) {

                        $success = "New Thermacian successfully added to Year Book.";
                    }

                    else {

                        $errors[] = "Could not add Thermacian to Year Book.";
                    }

                }

                else {

                    $errors[] = "Thermacians image could not be uploaded";
                }
            }

            else {

                $errors[] = "Image File size must be 2mb or less.";
            }
        }

        else {

            $errors[] = "Please upload an image of type JPEG or GIF.";
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
        <h4>Admin - <span id="title">Create a New Year Book Entry.<span></h4>
    </div>
    <div id="loginmain">
        <form enctype="multipart/form-data" method="post" action="#" name="createform" class="basic-form">
            <label for="set">Set <span style="color: red;">*</span></label>
            <select id="dropdown" name="set">
                <option selected="selected" value="2013/2014">2013/2014</option>
            </select>
            <label for="firstname">Firstname <span style="color: red;">*</span></label>
            <input type="text" name="firstname" id="firstname" placeholder="John" />
            <label for="lastname">Lastname <span style="color: red;">*</span></label>
            <input type="text" name="lastname" id="lastname" placeholder="Doe" />
            <label for="othername">Othername</label>
            <input type="text" name="othername" id="othername" placeholder="Brown" />
            <label for="nickname">Nickname</label>
            <input type="text" name="nickname" id="nickname" placeholder="2Face" />
            <label for="email">E-mail address <span style="color: red;">*</span></label>
            <input type="text" name="email" id="email" placeholder="john.doe@mail.com" />
            <label for="phonenumber">Phone Number <span style="color: red;">*</span></label>
            <input type="text" name="phonenumber" id="phonenumber" placeholder="+2348031234567" />
            <label for="residentialaddress">Residential Address <span style="color: red;">*</span></label>
            <input type="text" name="resaddr" id="resaddr" placeholder="No 21 Ojukwu close, Aba, Abia state." />
            <label for="permanentaddress">Permanent Address <span style="color: red;">*</span></label>
            <input type="text" name="permaddr" id="permaddr" placeholder="Uguta Village, Aba, Abia state." />
            <label for="hobbies">Hobbies</label>
            <input type="text" name="hobbies" id="hobbies" placeholder="Football, Cooking, Skating" />
            <label for="birthday">Date of Birth <span style="color: red;">*</span></label>
            <input type="text" name="dob" id="dob" placeholder="2014/08/23/" >
            <label for="state">State of Origin <span style="color: red;">*</span></label>
            <select id="dropdown" name="state">
                <option selected="selected" value="abia">Abia</option>
                <option value="anambra">Anambra</option>
                <option value="bauchi">Bauchi</option>
                <option value="not nigerian">Not Nigerian</option>
            </select>
            <label for="lga">Local Government Area <span style="color: red;">*</span></label>
            <input type="text" name="lga" id="lga" placeholder="Nsukka" >
            <label for="aboutme">About Me <span style="color: red;">*</span></label>
            <textarea name="about" id="about" placeholder="I am tall, and i am creative..."></textarea>
            <label for="ambition">Ambition</label>
            <input type="text" name="ambition" id="ambition" placeholder="Want to be an Astronaut" />
            <label for="fblink">Facebook Profile Link</label>
            <input type="text" name="fblink" id="fblink" placeholder="https://facebook.com/john.doe" />
            <label for="twlink">Twitter Handle</label>
            <input type="text" name="twhandle" id="twhandle" placeholder="@jDoeOfficial" />
            <label for="image">Select Image to Upload <span style="color: red;">*</span></label>
            <input type="file" name="image" id="image" />
            <input type="submit" id="createbutton" name="createbutton" value="Create" />
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
