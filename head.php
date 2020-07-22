<?php
    include_once "./include/autoload.php";
    $mnv_f 		= new mnv_function();
    $my_db      = $mnv_f->Connect_MySQL();
    $mobileYN   = $mnv_f->MobileCheck();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	    <meta http-equiv="X-UA-Compatible" content="ie=edge">
		<meta property="og:type" content="website" />
		<meta property="og:title" content="RoyalCanin" />
		<meta property="og:url" content="http://www.royalcaninevent2020.com/cathealth/" />
		<meta property="og:image" content="http://www.royalcaninevent2020.com/cathealth/images/share_image.jpg" />
		<meta property="og:description" content="[RoyalCanin] 고양이 주치의 프로젝트" />
		<title>RoyalCanin</title>
		<link type="image/icon" rel="shortcut icon" href="http://www.royalcaninevent2020.com/ccn/images/favicon.ico" />
		<link rel="stylesheet" href="./css/reset.css">
		<link rel="stylesheet" href="./css/font.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css">
		<link rel="stylesheet" href="./css/style.css?ver=200720">
		<script src="./js/widget_api.js"></script>
		<script src="./js/player_api.js"></script>
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.3.1/gsap.min.js"></script>
		<script src="./js/main.js"></script>
	</head>
