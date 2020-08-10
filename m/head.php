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
		<meta property="og:url" content="http://www.royalcaninevent2020.com/cathealth/" />
		<meta property="og:image" content="http://www.royalcaninevent2020.com/cathealth/images/share_image.jpg" />
		<meta property="og:description" content="[RoyalCanin] 고양이 주치의 프로젝트" />
		<title>RoyalCanin</title>
		<link type="image/icon" rel="shortcut icon" href="http://www.royalcaninevent2020.com/ccn/images/favicon.ico" />
		<link rel="stylesheet" href="./css/reset.css">
		<link rel="stylesheet" href="./css/font.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css">
		<link rel="stylesheet" href="./css/style.css?ver=200806">
		<script src="../js/jquery-3.3.1.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.3.1/gsap.min.js"></script>
		<script src="../js/m_main.js"></script>
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-173400319-1"></script>
		<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-173400319-1');
		</script>
		<!-- Lightning Bolt Begins -->
		<script type="text/javascript">
		var lbTrans = '[TRANSACTION ID]';
		var lbValue = '[TRANSACTION VALUE]';
		var lbData = '[Attribute/Value Pairs for Custom Data]';
		</script>
		<script type="text/javascript" id="lightning_bolt" src="//cdn-akamai.mookie1.com/LB/LightningBolt.js"></script>
		<!-- Lightning Bolt Ends -->
		<!-- kakao pixel -->
		<script type="text/javascript" charset="UTF-8" src="//t1.daumcdn.net/adfit/static/kp.js"></script>
		<script type="text/javascript">
			kakaoPixel('3706581044973187383').pageView();
		</script>
		<!-- end kakao pixel -->
		<!-- Facebook Pixel Code -->
		<script>
		!function(f,b,e,v,n,t,s)
		{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
		n.callMethod.apply(n,arguments):n.queue.push(arguments)};
		if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
		n.queue=[];t=b.createElement(e);t.async=!0;
		t.src=v;s=b.getElementsByTagName(e)[0];
		s.parentNode.insertBefore(t,s)}(window, document,'script',
		'https://connect.facebook.net/en_US/fbevents.js');
		fbq('init', '627869591465101');
		fbq('track', 'PageView');
		</script>
		<noscript><img height="1" width="1" style="display:none"
		src="https://www.facebook.com/tr?id=627869591465101&ev=PageView&noscript=1"
		/></noscript>
		<!-- End Facebook Pixel Code -->
	</head>
