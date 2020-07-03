<?php
include_once "../include/autoload.php";
$mnv_f = new mnv_function();
$my_db = $mnv_f->Connect_MySQL();
$mobileYN = $mnv_f->MobileCheck();
$IEYN = $mnv_f->IECheck();
$IOSYN = $mnv_f->IPhoneCheck();

$cate = $_REQUEST['cate'];
if ($mobileYN == "PC")
{
	echo "<script>location.href='../index.php?media=".$_REQUEST["media"]."';</script>";
//	header( "Location: ./m/index.php?media=".$_REQUEST["media"] ); 
}else{
	$saveMedia     = $mnv_f->SaveMedia();
	$rs_tracking   = $mnv_f->InsertTrackingInfo($mobileYN);
}
	include_once "./head.php";
?>
	<body>
		<div id="container">
			<div class="content main">
<?php
	include_once "./header_dev.php";
?>				
				<div class="content-wrap">
					<div class="inner main">
<?php
	// include_once "./navi.php";
?>				
						<div class="box-area">
<?php
    if ($cate == "OVERVIEW" || $cate == "") {
        $where = "";
    }else{
        $where = " AND data_category like '%$cate%'";
    }


	// if ($cate == "OVERVIEW" || $cate == "")
	// 	$query 	= "SELECT * FROM data_info WHERE 1 AND showYN='Y' $where ORDER BY data_cate_order_all ASC, idx ASC";
	// else if ($cate == "SHORT VIDEO")
	// 	$query 	= "SELECT * FROM data_info WHERE 1 AND showYN='Y' $where ORDER BY data_cate_order1 ASC, idx ASC";
	// else if ($cate == "IMAGE")
	// 	$query 	= "SELECT * FROM data_info WHERE 1 AND showYN='Y' $where ORDER BY data_cate_order2 ASC, idx ASC";
	// else if ($cate == "FOOD")
	// 	$query 	= "SELECT * FROM data_info WHERE 1 AND showYN='Y' $where ORDER BY data_cate_order3 ASC, idx ASC";
	// else if ($cate == "COSMETICS")
	// 	$query 	= "SELECT * FROM data_info WHERE 1 AND showYN='Y' $where ORDER BY data_cate_order4 ASC, idx ASC";

	// $result = mysqli_query($my_db, $query);

	// while ($data = mysqli_fetch_array($result)) {
?>							
							<div class="box">
								<div class="img">
									<!-- <img src="../uploads/<?php echo $data['data_serial']?>/<?php echo $data['data_file_name']?>?v=<?php echo time()?>" alt="<?php echo $data['data_title']?>"> -->
									<video autoplay loop muted playsinline class="video-autoplay" style="width:100%">
										<source src="../video_test.mp4" type="video/mp4">
									</video>
								</div>
							</div>
							<div class="box">
								<div class="img">
									<!-- <img src="../uploads/<?php echo $data['data_serial']?>/<?php echo $data['data_file_name']?>?v=<?php echo time()?>" alt="<?php echo $data['data_title']?>"> -->
									<video autoplay loop muted playsinline class="video-autoplay" style="width:100%">
										<source src="../video_test.mp4" type="video/mp4">
									</video>
								</div>
							</div>
							<div class="box">
								<div class="img">
									<!-- <img src="../uploads/<?php echo $data['data_serial']?>/<?php echo $data['data_file_name']?>?v=<?php echo time()?>" alt="<?php echo $data['data_title']?>"> -->
									<video autoplay loop muted playsinline class="video-autoplay" style="width:100%">
										<source src="../video_test.mp4" type="video/mp4">
									</video>
								</div>
							</div>
							<div class="box">
								<div class="img">
									<!-- <img src="../uploads/<?php echo $data['data_serial']?>/<?php echo $data['data_file_name']?>?v=<?php echo time()?>" alt="<?php echo $data['data_title']?>"> -->
									<video autoplay loop muted playsinline class="video-autoplay" style="width:100%">
										<source src="../video_test.mp4" type="video/mp4">
									</video>
								</div>
							</div>
							<div class="box">
								<div class="img">
									<!-- <img src="../uploads/<?php echo $data['data_serial']?>/<?php echo $data['data_file_name']?>?v=<?php echo time()?>" alt="<?php echo $data['data_title']?>"> -->
									<video autoplay loop muted playsinline class="video-autoplay" style="width:100%">
										<source src="../video_test.mp4" type="video/mp4">
									</video>
								</div>
							</div>
							<div class="box">
								<div class="img">
									<!-- <img src="../uploads/<?php echo $data['data_serial']?>/<?php echo $data['data_file_name']?>?v=<?php echo time()?>" alt="<?php echo $data['data_title']?>"> -->
									<video autoplay loop muted playsinline class="video-autoplay" style="width:100%">
										<source src="../video_test.mp4" type="video/mp4">
									</video>
								</div>
							</div>
							<div class="box">
								<div class="img">
									<!-- <img src="../uploads/<?php echo $data['data_serial']?>/<?php echo $data['data_file_name']?>?v=<?php echo time()?>" alt="<?php echo $data['data_title']?>"> -->
									<video autoplay loop muted playsinline class="video-autoplay" style="width:100%">
										<source src="../video_test.mp4" type="video/mp4">
									</video>
								</div>
							</div>
							<div class="box">
								<div class="img">
									<!-- <img src="../uploads/<?php echo $data['data_serial']?>/<?php echo $data['data_file_name']?>?v=<?php echo time()?>" alt="<?php echo $data['data_title']?>"> -->
									<video autoplay loop muted playsinline class="video-autoplay" style="width:100%">
										<source src="../video_test.mp4" type="video/mp4">
									</video>
								</div>
							</div>
							<div class="box">
								<div class="img">
									<!-- <img src="../uploads/<?php echo $data['data_serial']?>/<?php echo $data['data_file_name']?>?v=<?php echo time()?>" alt="<?php echo $data['data_title']?>"> -->
									<video autoplay loop muted playsinline class="video-autoplay" style="width:100%">
										<source src="../video_test.mp4" type="video/mp4">
									</video>
								</div>
							</div>
							<div class="box">
								<div class="img">
									<!-- <img src="../uploads/<?php echo $data['data_serial']?>/<?php echo $data['data_file_name']?>?v=<?php echo time()?>" alt="<?php echo $data['data_title']?>"> -->
									<video autoplay loop muted playsinline class="video-autoplay" style="width:100%">
										<source src="../video_test.mp4" type="video/mp4">
									</video>
								</div>
							</div>
<?php
	// }
?>							
						</div>
					</div>
				</div>
<?php
	include_once "./footer.php";
?>				
			</div>
		</div>
		<script>
			// $(function(){
			// 	$(".navi ul li a").on("click", function(){
			// 		console.log($(this).text());
			// 		$(".navi ul li a").removeClass('active');
			// 		$(this).addClass('active');
			// 	});
			// });
		</script>
	</body>
</html>