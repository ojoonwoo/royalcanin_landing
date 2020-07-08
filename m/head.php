<?php
    include_once "../include/autoload.php";
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
		<meta property="og:url" content="http://www.royalcaninevent2020.com/ccn/" />
		<meta property="og:image" content="http://www.royalcaninevent2020.com/ccn/images/share_image.jpg" />
		<meta property="og:description" content="[RoyalCanin] 고양이 주치의 프로젝트" />
		<title>RoyalCanin</title>
		<link type="image/icon" rel="shortcut icon" href="http://www.royalcaninevent2020.com/ccn/images/favicon.ico" />
		<link rel="stylesheet" href="./css/reset.css">
		<link rel="stylesheet" href="./css/font.css">
		<!-- <link rel="stylesheet" href="./css/slick.css"> -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css">
		<!-- <link href="https://vjs.zencdn.net/7.8.2/video-js.css" rel="stylesheet" /> -->
		<!-- <link href="https://vjs.zencdn.net/7.6.0/video-js.css" rel="stylesheet" /> -->
		<link rel="stylesheet" href="./css/style.css?ver=2006291519">
		<script src="../js/jquery-3.3.1.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.3.1/gsap.min.js"></script>
		<script src="../js/m_main.js"></script>
		<!-- Lightning Bolt Begins -->
		<!-- <script type="text/javascript">
		        var lbTrans = '[TRANSACTION ID]';
		        var lbValue = '[TRANSACTION VALUE]';
		        var lbData = '[Attribute/Value Pairs for Custom Data]';
		</script> -->
		<!-- <script type="text/javascript" id="lightning_bolt" src="//cdn-akamai.mookie1.com/LB/LightningBolt.js"></script> -->
		<!-- Lightning Bolt Ends -->
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<!-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-170920036-1"></script> -->
		<script>
		// window.dataLayer = window.dataLayer || [];
		// function gtag(){dataLayer.push(arguments);}
		// gtag('js', new Date());
		// gtag('config', 'UA-170920036-1');
		</script>
		<!-- Google Tag Manager -->
		<script>
		// (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','GTM-5TSHTM5');
		</script>
		<!-- End Google Tag Manager -->
	</head>
