<?php
	// 설정파일
	include_once "../include/autoload.php";

	$mnv_f = new mnv_function();
	$my_db         = $mnv_f->Connect_MySQL();

	include "./head.php";

//	$beforeDay = date("Y-m-d", strtotime($day." -6 day"));
//	print_r($beforeDay);
	if($_REQUEST['searchDate'] == "") {
		$searchDate = date("Y-m-d");
	} else {
		$searchDate = $_REQUEST['searchDate'];
	}
?>
	<script type="text/javascript">
		$(function() {
			$("#searchDate").datepicker();
		});

		// function outputExcel() {
		// 	location.href = "excel_download_tracking.php?sDate=" + $("#sDate").val() + "&eDate=" + $("#eDate").val();
		// }
	</script>

	<div id="page-wrapper" style="width:2000px">
		<div class="container-fluid">
			<!-- Page Heading -->
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">데일리 리포트</h1>
				</div>
			</div>
			<!-- /.row -->
			<div class="row">
				<div class="col-lg-12">
					<div class="table-responsive">
						<ol class="breadcrumb">
							<form name="frm_execute" method="POST">
								<input type="hidden" name="pg" value="<?=$pg?>">
								<!--
					  <select name="search_type">
						  <option value="mb_name" <?php if($search_type == "mb_name"){?>selected<?php }?>>이름</option>
						  <option value="mb_phone" <?php if($search_type == "mb_phone"){?>selected<?php }?>>전화번호</option>
					  </select>
-->
								<!--					  <input type="text" name="search_txt" value="<?php echo $search_txt?>">-->
								<input type="text" id="searchDate" class="date-input" name="searchDate" value="<?=$searchDate?>">
								<input type="submit" value="검색">
								<!-- <button type="button" onclick="resetDate()">기간 초기화</button> -->
								<!-- <button type="button" onclick="outputExcel()">엑셀로 내보내기</button> -->
								<!--
					  <a href="javascript:void(0)" id="excel_download_list">
						  <span>엑셀 다운로드</span>
					  </a> 
-->
							</form>
						</ol>
						<div id="daily_applicant_count_div1" style="display:block">
							<table class="table table-hover" style="position: relative;">
								<thead>
									<tr>
										<th colspan="3">광고구분</th>
										<th rowspan="2">디바이스</th>
										<th colspan="3">페이지 공유</th>
										<th colspan="7">테스트 영상 플레이</th>
										<th colspan="3">이벤트 참여</th>
										<th colspan="3">앱 다운로드</th>
										<th colspan="4">정신바짝 테스트</th>
										<th colspan="4">눈치코치 테스트</th>
										<th colspan="4">세척능력 테스트</th>
										<th colspan="4">위기대처 테스트</th>
										<th colspan="4">순간포착 테스트</th>
										<th colspan="4">시선집중 테스트</th>
									</tr>
									<tr>
										<th>세부채널</th>
										<th>광고상품</th>
										<th>소재</th>
										<!-- <th>PC</th>
										<th>MOBILE</th> -->
										<th>Total</th>
										<th>페이스북</th>
										<th>카카오톡</th>
										<th>Total</th>
										<th>정신바짝</th>
										<th>눈치코치</th>
										<th>세척능력</th>
										<th>위기대처</th>
										<th>순간포착</th>
										<th>시선집중</th>
										<th>Total</th>
										<th>시세조회</th>
										<th>공유</th>
										<th>Total</th>
										<th>iOS</th>
										<th>안드로이드</th>
										<th>영상 play</th>
										<th>페북 공유</th>
										<th>카카오 공유</th>
										<th>종료(돌아가기)</th>
										<th>영상 play</th>
										<th>페북 공유</th>
										<th>카카오 공유</th>
										<th>종료(돌아가기)</th>
										<th>영상 play</th>
										<th>페북 공유</th>
										<th>카카오 공유</th>
										<th>종료(돌아가기)</th>
										<th>영상 play</th>
										<th>페북 공유</th>
										<th>카카오 공유</th>
										<th>종료(돌아가기)</th>
										<th>영상 play</th>
										<th>페북 공유</th>
										<th>카카오 공유</th>
										<th>종료(돌아가기)</th>
										<th>영상 play</th>
										<th>페북 공유</th>
										<th>카카오 공유</th>
										<th>종료(돌아가기)</th>
									</tr>
								</thead>
								<tbody>
<?php
    include_once "daily_report_array.php";

    $where = "";

	if ($searchDate != "")
        $where	.= " AND click_date like '%".$searchDate."%'";

    // 메인 페이스북 공유(PC)
    $mainPCShareFBQuery = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='메인 공유 페이스북' AND click_gubun='PC' ".$where." GROUP BY click_media";
    $mainPCShareFBResult = mysqli_query($my_db, $mainPCShareFBQuery);
    while ($mainPCShareFBData = mysqli_fetch_array($mainPCShareFBResult))
    {
        if ($my_array[0][$mainPCShareFBData["click_media"]]["mainPCFBShare"] == "0")
            $my_array[0][$mainPCShareFBData["click_media"]]["mainPCFBShare"] = $mainPCShareFBData["cnt"];
    }
    // 메인 페이스북 공유(MOBILE)
    $mainMShareFBQuery = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='메인 공유 페이스북' AND click_gubun='MOBILE' ".$where." GROUP BY click_media";
    $mainMShareFBResult = mysqli_query($my_db, $mainMShareFBQuery);
    while ($mainMShareFBData = mysqli_fetch_array($mainMShareFBResult))
    {
        if ($my_array[0][$mainMShareFBData["click_media"]]["mainMFBShare"] == "0")
            $my_array[0][$mainMShareFBData["click_media"]]["mainMFBShare"] = $mainMShareFBData["cnt"];
    }

    // 메인 카카오톡 공유(PC)
    $mainPCShareKTQuery = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='메인 공유 카카오톡' AND click_gubun='PC' ".$where." GROUP BY click_media";
    $mainPCShareKTResult = mysqli_query($my_db, $mainPCShareKTQuery);
    while ($mainPCShareKTData = mysqli_fetch_array($mainPCShareKTResult))
    {
        if ($my_array[0][$mainPCShareKTData["click_media"]]["mainPCKTShare"] == "0")
            $my_array[0][$mainPCShareKTData["click_media"]]["mainPCKTShare"] = $mainPCShareKTData["cnt"];
    }
    // 메인 카카오톡 공유(MOBILE)
    $mainMShareKTQuery = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='메인 공유 카카오톡' AND click_gubun='MOBILE' ".$where." GROUP BY click_media";
    $mainMShareKTResult = mysqli_query($my_db, $mainMShareKTQuery);
    while ($mainMShareKTData = mysqli_fetch_array($mainMShareKTResult))
    {
        if ($my_array[0][$mainMShareKTData["click_media"]]["mainMKTShare"] == "0")
            $my_array[0][$mainMShareKTData["click_media"]]["mainMKTShare"] = $mainMShareKTData["cnt"];
    }

    // 정신바짝 테스트 클릭(PC)
    $mainPCClickTest1Query = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='정신바짝 테스트' AND click_gubun='PC' ".$where." GROUP BY click_media";
    $mainPCClickTest1Result = mysqli_query($my_db, $mainPCClickTest1Query);
    while ($mainPCClickTest1Data = mysqli_fetch_array($mainPCClickTest1Result))
    {
        if ($my_array[0][$mainPCClickTest1Data["click_media"]]["mainPCTest1Click"] == "0")
            $my_array[0][$mainPCClickTest1Data["click_media"]]["mainPCTest1Click"] = $mainPCClickTest1Data["cnt"];
    }

    // 정신바짝 테스트 클릭(MOBILE)
    $mainMClickTest1Query = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='정신바짝 테스트' AND click_gubun='MOBILE' ".$where." GROUP BY click_media";
    $mainMClickTest1Result = mysqli_query($my_db, $mainMClickTest1Query);
    while ($mainMClickTest1Data = mysqli_fetch_array($mainMClickTest1Result))
    {
        if ($my_array[0][$mainMClickTest1Data["click_media"]]["mainMTest1Click"] == "0")
            $my_array[0][$mainMClickTest1Data["click_media"]]["mainMTest1Click"] = $mainMClickTest1Data["cnt"];
    }

    // 눈치코치 테스트 클릭(PC)
    $mainPCClickTest2Query = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='눈치코치 테스트' AND click_gubun='PC' ".$where." GROUP BY click_media";
    $mainPCClickTest2Result = mysqli_query($my_db, $mainPCClickTest2Query);
    while ($mainPCClickTest2Data = mysqli_fetch_array($mainPCClickTest2Result))
    {
        if ($my_array[0][$mainPCClickTest2Data["click_media"]]["mainPCTest2Click"] == "0")
            $my_array[0][$mainPCClickTest2Data["click_media"]]["mainPCTest2Click"] = $mainPCClickTest2Data["cnt"];
    }

    // 눈치코치 테스트 클릭(MOBILE)
    $mainMClickTest2Query = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='눈치코치 테스트' AND click_gubun='MOBILE' ".$where." GROUP BY click_media";
    $mainMClickTest2Result = mysqli_query($my_db, $mainMClickTest2Query);
    while ($mainMClickTest2Data = mysqli_fetch_array($mainMClickTest2Result))
    {
        if ($my_array[0][$mainMClickTest2Data["click_media"]]["mainMTest2Click"] == "0")
            $my_array[0][$mainMClickTest2Data["click_media"]]["mainMTest2Click"] = $mainMClickTest2Data["cnt"];
    }

    // 세척능력 테스트 클릭(PC)
    $mainPCClickTest3Query = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='세척능력 테스트' AND click_gubun='PC' ".$where." GROUP BY click_media";
    $mainPCClickTest3Result = mysqli_query($my_db, $mainPCClickTest3Query);
    while ($mainPCClickTest3Data = mysqli_fetch_array($mainPCClickTest3Result))
    {
        if ($my_array[0][$mainPCClickTest3Data["click_media"]]["mainPCTest3Click"] == "0")
            $my_array[0][$mainPCClickTest3Data["click_media"]]["mainPCTest3Click"] = $mainPCClickTest3Data["cnt"];
    }

    // 세척능력 테스트 클릭(MOBILE)
    $mainMClickTest3Query = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='세척능력 테스트' AND click_gubun='MOBILE' ".$where." GROUP BY click_media";
    $mainMClickTest3Result = mysqli_query($my_db, $mainMClickTest3Query);
    while ($mainMClickTest3Data = mysqli_fetch_array($mainMClickTest3Result))
    {
        if ($my_array[0][$mainMClickTest3Data["click_media"]]["mainMTest3Click"] == "0")
            $my_array[0][$mainMClickTest3Data["click_media"]]["mainMTest3Click"] = $mainMClickTest3Data["cnt"];
    }

    // 위기대처 테스트 클릭(PC)
    $mainPCClickTest4Query = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='위기대처 테스트' AND click_gubun='PC' ".$where." GROUP BY click_media";
    $mainPCClickTest4Result = mysqli_query($my_db, $mainPCClickTest4Query);
    while ($mainPCClickTest4Data = mysqli_fetch_array($mainPCClickTest4Result))
    {
        if ($my_array[0][$mainPCClickTest4Data["click_media"]]["mainPCTest4Click"] == "0")
            $my_array[0][$mainPCClickTest4Data["click_media"]]["mainPCTest4Click"] = $mainPCClickTest4Data["cnt"];
    }

    // 위기대처 테스트 클릭(MOBILE)
    $mainMClickTest4Query = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='위기대처 테스트' AND click_gubun='MOBILE' ".$where." GROUP BY click_media";
    $mainMClickTest4Result = mysqli_query($my_db, $mainMClickTest4Query);
    while ($mainMClickTest4Data = mysqli_fetch_array($mainMClickTest4Result))
    {
        if ($my_array[0][$mainMClickTest4Data["click_media"]]["mainMTest4Click"] == "0")
            $my_array[0][$mainMClickTest4Data["click_media"]]["mainMTest4Click"] = $mainMClickTest4Data["cnt"];
    }

    // 순간포착 테스트 클릭(PC)
    $mainPCClickTest5Query = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='순간포착 테스트' AND click_gubun='PC' ".$where." GROUP BY click_media";
    $mainPCClickTest5Result = mysqli_query($my_db, $mainPCClickTest5Query);
    while ($mainPCClickTest5Data = mysqli_fetch_array($mainPCClickTest5Result))
    {
        if ($my_array[0][$mainPCClickTest5Data["click_media"]]["mainPCTest5Click"] == "0")
            $my_array[0][$mainPCClickTest5Data["click_media"]]["mainPCTest5Click"] = $mainPCClickTest5Data["cnt"];
    }

    // 순간포착 테스트 클릭(MOBILE)
    $mainMClickTest5Query = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='순간포착 테스트' AND click_gubun='MOBILE' ".$where." GROUP BY click_media";
    $mainMClickTest5Result = mysqli_query($my_db, $mainMClickTest5Query);
    while ($mainMClickTest5Data = mysqli_fetch_array($mainMClickTest5Result))
    {
        if ($my_array[0][$mainMClickTest5Data["click_media"]]["mainMTest5Click"] == "0")
            $my_array[0][$mainMClickTest5Data["click_media"]]["mainMTest5Click"] = $mainMClickTest5Data["cnt"];
    }

    // 시선집중 테스트 클릭(PC)
    $mainPCClickTest6Query = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='시선집중 테스트' AND click_gubun='PC' ".$where." GROUP BY click_media";
    $mainPCClickTest6Result = mysqli_query($my_db, $mainPCClickTest6Query);
    while ($mainPCClickTest6Data = mysqli_fetch_array($mainPCClickTest6Result))
    {
        if ($my_array[0][$mainPCClickTest6Data["click_media"]]["mainPCTest6Click"] == "0")
            $my_array[0][$mainPCClickTest6Data["click_media"]]["mainPCTest6Click"] = $mainPCClickTest6Data["cnt"];
    }

    // 시선집중 테스트 클릭(MOBILE)
    $mainMClickTest6Query = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='시선집중 테스트' AND click_gubun='MOBILE' ".$where." GROUP BY click_media";
    $mainMClickTest6Result = mysqli_query($my_db, $mainMClickTest6Query);
    while ($mainMClickTest6Data = mysqli_fetch_array($mainMClickTest6Result))
    {
        if ($my_array[0][$mainMClickTest6Data["click_media"]]["mainMTest6Click"] == "0")
            $my_array[0][$mainMClickTest6Data["click_media"]]["mainMTest6Click"] = $mainMClickTest6Data["cnt"];
    }

    // 이벤트 시세조회 참여(PC) 
    $mainPCClickEvent1Query = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='이벤트 참여하기1' AND click_gubun='PC' ".$where." GROUP BY click_media";
    $mainPCClickEvent1Result = mysqli_query($my_db, $mainPCClickEvent1Query);
    while ($mainPCClickEvent1Data = mysqli_fetch_array($mainPCClickEvent1Result))
    {
        if ($my_array[0][$mainPCClickEvent1Data["click_media"]]["mainPCEvent1Click"] == "0")
            $my_array[0][$mainPCClickEvent1Data["click_media"]]["mainPCEvent1Click"] = $mainPCClickEvent1Data["cnt"];
    }

    // 이벤트 시세조회 참여(MOBILE) 
    $mainMClickEvent1Query = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='이벤트 참여하기1' AND click_gubun='MOBILE' ".$where." GROUP BY click_media";
    $mainMClickEvent1Result = mysqli_query($my_db, $mainMClickEvent1Query);
    while ($mainMClickEvent1Data = mysqli_fetch_array($mainMClickEvent1Result))
    {
        if ($my_array[0][$mainMClickEvent1Data["click_media"]]["mainMEvent1Click"] == "0")
            $my_array[0][$mainMClickEvent1Data["click_media"]]["mainMEvent1Click"] = $mainMClickEvent1Data["cnt"];
    }

    // 이벤트 공유 참여(PC) 
    $mainPCClickEvent2Query = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='이벤트 참여하기2' AND click_gubun='PC' ".$where." GROUP BY click_media";
    $mainPCClickEvent2Result = mysqli_query($my_db, $mainPCClickEvent2Query);
    while ($mainPCClickEvent2Data = mysqli_fetch_array($mainPCClickEvent2Result))
    {
        if ($my_array[0][$mainPCClickEvent2Data["click_media"]]["mainPCEvent2Click"] == "0")
            $my_array[0][$mainPCClickEvent2Data["click_media"]]["mainPCEvent2Click"] = $mainPCClickEvent2Data["cnt"];
    }

    // 이벤트 공유 참여(MOBILE) 
    $mainMClickEvent2Query = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='이벤트 참여하기2' AND click_gubun='MOBILE' ".$where." GROUP BY click_media";
    $mainMClickEvent2Result = mysqli_query($my_db, $mainMClickEvent2Query);
    while ($mainMClickEvent2Data = mysqli_fetch_array($mainMClickEvent2Result))
    {
        if ($my_array[0][$mainMClickEvent2Data["click_media"]]["mainMEvent2Click"] == "0")
            $my_array[0][$mainMClickEvent2Data["click_media"]]["mainMEvent2Click"] = $mainMClickEvent2Data["cnt"];
    }

    // 앱 iOS 다운로드(PC) 
    $mainPCClickIosDownloadQuery = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='앱다운로드 아이폰' AND click_gubun='PC' ".$where." GROUP BY click_media";
    $mainPCClickIosDownloadResult = mysqli_query($my_db, $mainPCClickIosDownloadQuery);
    while ($mainPCClickIosDownloadData = mysqli_fetch_array($mainPCClickIosDownloadResult))
    {
        if ($my_array[0][$mainPCClickIosDownloadData["click_media"]]["mainPCIosDownloadClick"] == "0")
            $my_array[0][$mainPCClickIosDownloadData["click_media"]]["mainPCIosDownloadClick"] = $mainPCClickIosDownloadData["cnt"];
    }

    // 앱 iOS 다운로드(MOBILE) 
    $mainMClickIosDownloadQuery = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='앱다운로드 아이폰' AND click_gubun='MOBILE' ".$where." GROUP BY click_media";
    $mainMClickIosDownloadResult = mysqli_query($my_db, $mainMClickIosDownloadQuery);
    while ($mainMClickIosDownloadData = mysqli_fetch_array($mainMClickIosDownloadResult))
    {
        if ($my_array[0][$mainMClickIosDownloadData["click_media"]]["mainMIosDownloadClick"] == "0")
            $my_array[0][$mainMClickIosDownloadData["click_media"]]["mainMIosDownloadClick"] = $mainMClickIosDownloadData["cnt"];
    }

    // 앱 안드로이드 다운로드(PC) 
    $mainPCClickAndroidDownloadQuery = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='앱다운로드 안드로이드' AND click_gubun='PC' ".$where." GROUP BY click_media";
    $mainPCClickAndroidDownloadResult = mysqli_query($my_db, $mainPCClickAndroidDownloadQuery);
    while ($mainPCClickAndroidDownloadData = mysqli_fetch_array($mainPCClickAndroidDownloadResult))
    {
        if ($my_array[0][$mainPCClickAndroidDownloadData["click_media"]]["mainPCAndroidDownloadClick"] == "0")
            $my_array[0][$mainPCClickAndroidDownloadData["click_media"]]["mainPCAndroidDownloadClick"] = $mainPCClickAndroidDownloadData["cnt"];
    }

    // 앱 안드로이드 다운로드(MOBILE) 
    $mainMClickAndroidDownloadQuery = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='앱다운로드 안드로이드' AND click_gubun='MOBILE' ".$where." GROUP BY click_media";
    $mainMClickAndroidDownloadResult = mysqli_query($my_db, $mainMClickAndroidDownloadQuery);
    while ($mainMClickAndroidDownloadData = mysqli_fetch_array($mainMClickAndroidDownloadResult))
    {
        if ($my_array[0][$mainMClickAndroidDownloadData["click_media"]]["mainMAndroidDownloadClick"] == "0")
            $my_array[0][$mainMClickAndroidDownloadData["click_media"]]["mainMAndroidDownloadClick"] = $mainMClickAndroidDownloadData["cnt"];
    }

    // 정신바짝 테스트 - 영상 플레이 (PC) 
    $popupPCTest1PlayQuery = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='정신바짝 테스트 플레이' AND click_gubun='PC' ".$where." GROUP BY click_media";
    $popupPCTest1PlayResult = mysqli_query($my_db, $popupPCTest1PlayQuery);
    while ($popupPCTest1PlayData = mysqli_fetch_array($popupPCTest1PlayResult))
    {
        if ($my_array[0][$popupPCTest1PlayData["click_media"]]["popupPCTest1PlayClick"] == "0")
            $my_array[0][$popupPCTest1PlayData["click_media"]]["popupPCTest1PlayClick"] = $popupPCTest1PlayData["cnt"];
    }

    // 정신바짝 테스트 - 영상 플레이 (MOBILE) 
    $popupMTest1PlayQuery = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='정신바짝 테스트 플레이' AND click_gubun='MOBILE' ".$where." GROUP BY click_media";
    $popupMTest1PlayResult = mysqli_query($my_db, $popupMTest1PlayQuery);
    while ($popupMTest1PlayData = mysqli_fetch_array($popupMTest1PlayResult))
    {
        if ($my_array[0][$popupMTest1PlayData["click_media"]]["popupMTest1PlayClick"] == "0")
            $my_array[0][$popupMTest1PlayData["click_media"]]["popupMTest1PlayClick"] = $popupMTest1PlayData["cnt"];
    }

    // 정신바짝 테스트 - 페이스북 공유 (PC) 
    $popupPCTest1FBShareQuery = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='페이스북 공유 정신바짝' AND click_gubun='PC' ".$where." GROUP BY click_media";
    $popupPCTest1FBShareResult = mysqli_query($my_db, $popupPCTest1FBShareQuery);
    while ($popupPCTest1FBShareData = mysqli_fetch_array($popupPCTest1FBShareResult))
    {
        if ($my_array[0][$popupPCTest1FBShareData["click_media"]]["popupPCTest1FBShare"] == "0")
            $my_array[0][$popupPCTest1FBShareData["click_media"]]["popupPCTest1FBShare"] = $popupPCTest1FBShareData["cnt"];
    }

    // 정신바짝 테스트 - 페이스북 공유 (MOBILE) 
    $popupMTest1FBShareQuery = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='페이스북 공유 정신바짝' AND click_gubun='MOBILE' ".$where." GROUP BY click_media";
    $popupMTest1FBShareResult = mysqli_query($my_db, $popupMTest1FBShareQuery);
    while ($popupMTest1FBShareData = mysqli_fetch_array($popupMTest1FBShareResult))
    {
        if ($my_array[0][$popupMTest1FBShareData["click_media"]]["popupMTest1FBShare"] == "0")
            $my_array[0][$popupMTest1FBShareData["click_media"]]["popupMTest1FBShare"] = $popupMTest1FBShareData["cnt"];
    }

    // 정신바짝 테스트 - 카카오톡 공유 (PC) 
    $popupPCTest1KTShareQuery = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='카카오톡 공유 정신바짝' AND click_gubun='PC' ".$where." GROUP BY click_media";
    $popupPCTest1KTShareResult = mysqli_query($my_db, $popupPCTest1KTShareQuery);
    while ($popupPCTest1KTShareData = mysqli_fetch_array($popupPCTest1KTShareResult))
    {
        if ($my_array[0][$popupPCTest1KTShareData["click_media"]]["popupPCTest1KTShare"] == "0")
            $my_array[0][$popupPCTest1KTShareData["click_media"]]["popupPCTest1KTShare"] = $popupPCTest1KTShareData["cnt"];
    }

    // 정신바짝 테스트 - 카카오톡 공유 (MOBILE) 
    $popupPCTest1KTShareQuery = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='카카오톡 공유 정신바짝' AND click_gubun='MOBILE' ".$where." GROUP BY click_media";
    $popupPCTest1KTShareResult = mysqli_query($my_db, $popupPCTest1KTShareQuery);
    while ($popupPCTest1KTShareData = mysqli_fetch_array($popupPCTest1KTShareResult))
    {
        if ($my_array[0][$popupPCTest1KTShareData["click_media"]]["popupPCTest1KTShare"] == "0")
            $my_array[0][$popupPCTest1KTShareData["click_media"]]["popupPCTest1KTShare"] = $popupPCTest1KTShareData["cnt"];
    }

    // 정신바짝 테스트 - 팝업 클로즈 (PC) 
    $popupPCTest1CloseQuery = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='정신바짝 테스트 팝업 클로즈' AND click_gubun='PC' ".$where." GROUP BY click_media";
    $popupPCTest1CloseResult = mysqli_query($my_db, $popupPCTest1CloseQuery);
    while ($popupPCTest1CloseData = mysqli_fetch_array($popupPCTest1CloseResult))
    {
        if ($my_array[0][$popupPCTest1CloseData["click_media"]]["popupPCTest1Close"] == "0")
            $my_array[0][$popupPCTest1CloseData["click_media"]]["popupPCTest1Close"] = $popupPCTest1CloseData["cnt"];
    }

    // 정신바짝 테스트 - 팝업 클로즈 (MOBILE) 
    $popupMTest1CloseQuery = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='정신바짝 테스트 팝업 클로즈' AND click_gubun='MOBILE' ".$where." GROUP BY click_media";
    $popupMTest1CloseResult = mysqli_query($my_db, $popupMTest1CloseQuery);
    while ($popupMTest1CloseData = mysqli_fetch_array($popupMTest1CloseResult))
    {
        if ($my_array[0][$popupMTest1CloseData["click_media"]]["popupMTest1Close"] == "0")
            $my_array[0][$popupMTest1CloseData["click_media"]]["popupMTest1Close"] = $popupMTest1CloseData["cnt"];
    }

    // 눈치코치 테스트 - 영상 플레이 (PC) 
    $popupPCTest2PlayQuery = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='눈치코치 테스트 플레이' AND click_gubun='PC' ".$where." GROUP BY click_media";
    $popupPCTest2PlayResult = mysqli_query($my_db, $popupPCTest2PlayQuery);
    while ($popupPCTest2PlayData = mysqli_fetch_array($popupPCTest2PlayResult))
    {
        if ($my_array[0][$popupPCTest2PlayData["click_media"]]["popupPCTest2PlayClick"] == "0")
            $my_array[0][$popupPCTest2PlayData["click_media"]]["popupPCTest2PlayClick"] = $popupPCTest2PlayData["cnt"];
    }

    // 눈치코치 테스트 - 영상 플레이 (MOBILE) 
    $popupMTest2PlayQuery = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='눈치코치 테스트 플레이' AND click_gubun='MOBILE' ".$where." GROUP BY click_media";
    $popupMTest2PlayResult = mysqli_query($my_db, $popupMTest2PlayQuery);
    while ($popupMTest2PlayData = mysqli_fetch_array($popupMTest2PlayResult))
    {
        if ($my_array[0][$popupMTest2PlayData["click_media"]]["popupMTest2PlayClick"] == "0")
            $my_array[0][$popupMTest2PlayData["click_media"]]["popupMTest2PlayClick"] = $popupMTest2PlayData["cnt"];
    }

    // 눈치코치 테스트 - 페이스북 공유 (PC) 
    $popupPCTest2FBShareQuery = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='페이스북 공유 눈치코치' AND click_gubun='PC' ".$where." GROUP BY click_media";
    $popupPCTest2FBShareResult = mysqli_query($my_db, $popupPCTest2FBShareQuery);
    while ($popupPCTest2FBShareData = mysqli_fetch_array($popupPCTest2FBShareResult))
    {
        if ($my_array[0][$popupPCTest2FBShareData["click_media"]]["popupPCTest2FBShare"] == "0")
            $my_array[0][$popupPCTest2FBShareData["click_media"]]["popupPCTest2FBShare"] = $popupPCTest2FBShareData["cnt"];
    }

    // 눈치코치 테스트 - 페이스북 공유 (MOBILE) 
    $popupMTest2FBShareQuery = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='페이스북 공유 눈치코치' AND click_gubun='MOBILE' ".$where." GROUP BY click_media";
    $popupMTest2FBShareResult = mysqli_query($my_db, $popupMTest2FBShareQuery);
    while ($popupMTest2FBShareData = mysqli_fetch_array($popupMTest2FBShareResult))
    {
        if ($my_array[0][$popupMTest2FBShareData["click_media"]]["popupMTest2FBShare"] == "0")
            $my_array[0][$popupMTest2FBShareData["click_media"]]["popupMTest2FBShare"] = $popupMTest2FBShareData["cnt"];
    }

    // 눈치코치 테스트 - 카카오톡 공유 (PC) 
    $popupPCTest2KTShareQuery = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='카카오톡 공유 눈치코치' AND click_gubun='PC' ".$where." GROUP BY click_media";
    $popupPCTest2KTShareResult = mysqli_query($my_db, $popupPCTest2KTShareQuery);
    while ($popupPCTest2KTShareData = mysqli_fetch_array($popupPCTest2KTShareResult))
    {
        if ($my_array[0][$popupPCTest2KTShareData["click_media"]]["popupPCTest2KTShare"] == "0")
            $my_array[0][$popupPCTest2KTShareData["click_media"]]["popupPCTest2KTShare"] = $popupPCTest2KTShareData["cnt"];
    }

    // 눈치코치 테스트 - 카카오톡 공유 (MOBILE) 
    $popupPCTest2KTShareQuery = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='카카오톡 공유 눈치코치' AND click_gubun='MOBILE' ".$where." GROUP BY click_media";
    $popupPCTest2KTShareResult = mysqli_query($my_db, $popupPCTest2KTShareQuery);
    while ($popupPCTest2KTShareData = mysqli_fetch_array($popupPCTest2KTShareResult))
    {
        if ($my_array[0][$popupPCTest2KTShareData["click_media"]]["popupPCTest2KTShare"] == "0")
            $my_array[0][$popupPCTest2KTShareData["click_media"]]["popupPCTest2KTShare"] = $popupPCTest2KTShareData["cnt"];
    }

    // 눈치코치 테스트 - 팝업 클로즈 (PC) 
    $popupPCTest2CloseQuery = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='눈치코치 테스트 팝업 클로즈' AND click_gubun='PC' ".$where." GROUP BY click_media";
    $popupPCTest2CloseResult = mysqli_query($my_db, $popupPCTest2CloseQuery);
    while ($popupPCTest2CloseData = mysqli_fetch_array($popupPCTest2CloseResult))
    {
        if ($my_array[0][$popupPCTest2CloseData["click_media"]]["popupPCTest2Close"] == "0")
            $my_array[0][$popupPCTest2CloseData["click_media"]]["popupPCTest2Close"] = $popupPCTest2CloseData["cnt"];
    }

    // 눈치코치 테스트 - 팝업 클로즈 (MOBILE) 
    $popupMTest2CloseQuery = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='눈치코치 테스트 팝업 클로즈' AND click_gubun='MOBILE' ".$where." GROUP BY click_media";
    $popupMTest2CloseResult = mysqli_query($my_db, $popupMTest2CloseQuery);
    while ($popupMTest2CloseData = mysqli_fetch_array($popupMTest2CloseResult))
    {
        if ($my_array[0][$popupMTest2CloseData["click_media"]]["popupMTest2Close"] == "0")
            $my_array[0][$popupMTest2CloseData["click_media"]]["popupMTest2Close"] = $popupMTest2CloseData["cnt"];
    }

    // 세척능력 테스트 - 영상 플레이 (PC) 
    $popupPCTest3PlayQuery = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='세척능력 테스트 플레이' AND click_gubun='PC' ".$where." GROUP BY click_media";
    $popupPCTest3PlayResult = mysqli_query($my_db, $popupPCTest3PlayQuery);
    while ($popupPCTest3PlayData = mysqli_fetch_array($popupPCTest3PlayResult))
    {
        if ($my_array[0][$popupPCTest3PlayData["click_media"]]["popupPCTest3PlayClick"] == "0")
            $my_array[0][$popupPCTest3PlayData["click_media"]]["popupPCTest3PlayClick"] = $popupPCTest3PlayData["cnt"];
    }

    // 세척능력 테스트 - 영상 플레이 (MOBILE) 
    $popupMTest3PlayQuery = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='세척능력 테스트 플레이' AND click_gubun='MOBILE' ".$where." GROUP BY click_media";
    $popupMTest3PlayResult = mysqli_query($my_db, $popupMTest3PlayQuery);
    while ($popupMTest3PlayData = mysqli_fetch_array($popupMTest3PlayResult))
    {
        if ($my_array[0][$popupMTest3PlayData["click_media"]]["popupMTest3PlayClick"] == "0")
            $my_array[0][$popupMTest3PlayData["click_media"]]["popupMTest3PlayClick"] = $popupMTest3PlayData["cnt"];
    }

    // 세척능력 테스트 - 페이스북 공유 (PC) 
    $popupPCTest3FBShareQuery = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='페이스북 공유 세척능력' AND click_gubun='PC' ".$where." GROUP BY click_media";
    $popupPCTest3FBShareResult = mysqli_query($my_db, $popupPCTest3FBShareQuery);
    while ($popupPCTest3FBShareData = mysqli_fetch_array($popupPCTest3FBShareResult))
    {
        if ($my_array[0][$popupPCTest3FBShareData["click_media"]]["popupPCTest3FBShare"] == "0")
            $my_array[0][$popupPCTest3FBShareData["click_media"]]["popupPCTest3FBShare"] = $popupPCTest3FBShareData["cnt"];
    }

    // 세척능력 테스트 - 페이스북 공유 (MOBILE) 
    $popupMTest3FBShareQuery = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='페이스북 공유 세척능력' AND click_gubun='MOBILE' ".$where." GROUP BY click_media";
    $popupMTest3FBShareResult = mysqli_query($my_db, $popupMTest3FBShareQuery);
    while ($popupMTest3FBShareData = mysqli_fetch_array($popupMTest3FBShareResult))
    {
        if ($my_array[0][$popupMTest3FBShareData["click_media"]]["popupMTest3FBShare"] == "0")
            $my_array[0][$popupMTest3FBShareData["click_media"]]["popupMTest3FBShare"] = $popupMTest3FBShareData["cnt"];
    }

    // 세척능력 테스트 - 카카오톡 공유 (PC) 
    $popupPCTest3KTShareQuery = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='카카오톡 공유 세척능력' AND click_gubun='PC' ".$where." GROUP BY click_media";
    $popupPCTest3KTShareResult = mysqli_query($my_db, $popupPCTest3KTShareQuery);
    while ($popupPCTest3KTShareData = mysqli_fetch_array($popupPCTest3KTShareResult))
    {
        if ($my_array[0][$popupPCTest3KTShareData["click_media"]]["popupPCTest3KTShare"] == "0")
            $my_array[0][$popupPCTest3KTShareData["click_media"]]["popupPCTest3KTShare"] = $popupPCTest3KTShareData["cnt"];
    }

    // 세척능력 테스트 - 카카오톡 공유 (MOBILE) 
    $popupPCTest3KTShareQuery = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='카카오톡 공유 세척능력' AND click_gubun='MOBILE' ".$where." GROUP BY click_media";
    $popupPCTest3KTShareResult = mysqli_query($my_db, $popupPCTest3KTShareQuery);
    while ($popupPCTest3KTShareData = mysqli_fetch_array($popupPCTest3KTShareResult))
    {
        if ($my_array[0][$popupPCTest3KTShareData["click_media"]]["popupPCTest3KTShare"] == "0")
            $my_array[0][$popupPCTest3KTShareData["click_media"]]["popupPCTest3KTShare"] = $popupPCTest3KTShareData["cnt"];
    }

    // 세척능력 테스트 - 팝업 클로즈 (PC) 
    $popupPCTest3CloseQuery = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='세척능력 테스트 팝업 클로즈' AND click_gubun='PC' ".$where." GROUP BY click_media";
    $popupPCTest3CloseResult = mysqli_query($my_db, $popupPCTest3CloseQuery);
    while ($popupPCTest3CloseData = mysqli_fetch_array($popupPCTest3CloseResult))
    {
        if ($my_array[0][$popupPCTest3CloseData["click_media"]]["popupPCTest3Close"] == "0")
            $my_array[0][$popupPCTest3CloseData["click_media"]]["popupPCTest3Close"] = $popupPCTest3CloseData["cnt"];
    }

    // 세척능력 테스트 - 팝업 클로즈 (MOBILE) 
    $popupMTest3CloseQuery = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='세척능력 테스트 팝업 클로즈' AND click_gubun='MOBILE' ".$where." GROUP BY click_media";
    $popupMTest3CloseResult = mysqli_query($my_db, $popupMTest3CloseQuery);
    while ($popupMTest3CloseData = mysqli_fetch_array($popupMTest3CloseResult))
    {
        if ($my_array[0][$popupMTest3CloseData["click_media"]]["popupMTest3Close"] == "0")
            $my_array[0][$popupMTest3CloseData["click_media"]]["popupMTest3Close"] = $popupMTest3CloseData["cnt"];
    }

    // 위기대처 테스트 - 영상 플레이 (PC) 
    $popupPCTest4PlayQuery = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='위기대처 테스트 플레이' AND click_gubun='PC' ".$where." GROUP BY click_media";
    $popupPCTest4PlayResult = mysqli_query($my_db, $popupPCTest4PlayQuery);
    while ($popupPCTest4PlayData = mysqli_fetch_array($popupPCTest4PlayResult))
    {
        if ($my_array[0][$popupPCTest4PlayData["click_media"]]["popupPCTest4PlayClick"] == "0")
            $my_array[0][$popupPCTest4PlayData["click_media"]]["popupPCTest4PlayClick"] = $popupPCTest4PlayData["cnt"];
    }

    // 위기대처 테스트 - 영상 플레이 (MOBILE) 
    $popupMTest4PlayQuery = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='위기대처 테스트 플레이' AND click_gubun='MOBILE' ".$where." GROUP BY click_media";
    $popupMTest4PlayResult = mysqli_query($my_db, $popupMTest4PlayQuery);
    while ($popupMTest4PlayData = mysqli_fetch_array($popupMTest4PlayResult))
    {
        if ($my_array[0][$popupMTest4PlayData["click_media"]]["popupMTest4PlayClick"] == "0")
            $my_array[0][$popupMTest4PlayData["click_media"]]["popupMTest4PlayClick"] = $popupMTest4PlayData["cnt"];
    }

    // 위기대처 테스트 - 페이스북 공유 (PC) 
    $popupPCTest4FBShareQuery = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='페이스북 공유 위기대처' AND click_gubun='PC' ".$where." GROUP BY click_media";
    $popupPCTest4FBShareResult = mysqli_query($my_db, $popupPCTest4FBShareQuery);
    while ($popupPCTest4FBShareData = mysqli_fetch_array($popupPCTest4FBShareResult))
    {
        if ($my_array[0][$popupPCTest4FBShareData["click_media"]]["popupPCTest4FBShare"] == "0")
            $my_array[0][$popupPCTest4FBShareData["click_media"]]["popupPCTest4FBShare"] = $popupPCTest4FBShareData["cnt"];
    }

    // 위기대처 테스트 - 페이스북 공유 (MOBILE) 
    $popupMTest4FBShareQuery = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='페이스북 공유 위기대처' AND click_gubun='MOBILE' ".$where." GROUP BY click_media";
    $popupMTest4FBShareResult = mysqli_query($my_db, $popupMTest4FBShareQuery);
    while ($popupMTest4FBShareData = mysqli_fetch_array($popupMTest4FBShareResult))
    {
        if ($my_array[0][$popupMTest4FBShareData["click_media"]]["popupMTest4FBShare"] == "0")
            $my_array[0][$popupMTest4FBShareData["click_media"]]["popupMTest4FBShare"] = $popupMTest4FBShareData["cnt"];
    }

    // 위기대처 테스트 - 카카오톡 공유 (PC) 
    $popupPCTest4KTShareQuery = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='카카오톡 공유 위기대처' AND click_gubun='PC' ".$where." GROUP BY click_media";
    $popupPCTest4KTShareResult = mysqli_query($my_db, $popupPCTest4KTShareQuery);
    while ($popupPCTest4KTShareData = mysqli_fetch_array($popupPCTest4KTShareResult))
    {
        if ($my_array[0][$popupPCTest4KTShareData["click_media"]]["popupPCTest4KTShare"] == "0")
            $my_array[0][$popupPCTest4KTShareData["click_media"]]["popupPCTest4KTShare"] = $popupPCTest4KTShareData["cnt"];
    }

    // 위기대처 테스트 - 카카오톡 공유 (MOBILE) 
    $popupPCTest4KTShareQuery = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='카카오톡 공유 위기대처' AND click_gubun='MOBILE' ".$where." GROUP BY click_media";
    $popupPCTest4KTShareResult = mysqli_query($my_db, $popupPCTest4KTShareQuery);
    while ($popupPCTest4KTShareData = mysqli_fetch_array($popupPCTest4KTShareResult))
    {
        if ($my_array[0][$popupPCTest4KTShareData["click_media"]]["popupPCTest4KTShare"] == "0")
            $my_array[0][$popupPCTest4KTShareData["click_media"]]["popupPCTest4KTShare"] = $popupPCTest4KTShareData["cnt"];
    }

    // 위기대처 테스트 - 팝업 클로즈 (PC) 
    $popupPCTest4CloseQuery = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='위기대처 테스트 팝업 클로즈' AND click_gubun='PC' ".$where." GROUP BY click_media";
    $popupPCTest4CloseResult = mysqli_query($my_db, $popupPCTest4CloseQuery);
    while ($popupPCTest4CloseData = mysqli_fetch_array($popupPCTest4CloseResult))
    {
        if ($my_array[0][$popupPCTest4CloseData["click_media"]]["popupPCTest4Close"] == "0")
            $my_array[0][$popupPCTest4CloseData["click_media"]]["popupPCTest4Close"] = $popupPCTest4CloseData["cnt"];
    }

    // 위기대처 테스트 - 팝업 클로즈 (MOBILE) 
    $popupMTest4CloseQuery = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='위기대처 테스트 팝업 클로즈' AND click_gubun='MOBILE' ".$where." GROUP BY click_media";
    $popupMTest4CloseResult = mysqli_query($my_db, $popupMTest4CloseQuery);
    while ($popupMTest4CloseData = mysqli_fetch_array($popupMTest4CloseResult))
    {
        if ($my_array[0][$popupMTest4CloseData["click_media"]]["popupMTest4Close"] == "0")
            $my_array[0][$popupMTest4CloseData["click_media"]]["popupMTest4Close"] = $popupMTest4CloseData["cnt"];
    }

    // 순간포착 테스트 - 영상 플레이 (PC) 
    $popupPCTest5PlayQuery = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='순간포착 테스트 플레이' AND click_gubun='PC' ".$where." GROUP BY click_media";
    $popupPCTest5PlayResult = mysqli_query($my_db, $popupPCTest5PlayQuery);
    while ($popupPCTest5PlayData = mysqli_fetch_array($popupPCTest5PlayResult))
    {
        if ($my_array[0][$popupPCTest5PlayData["click_media"]]["popupPCTest5PlayClick"] == "0")
            $my_array[0][$popupPCTest5PlayData["click_media"]]["popupPCTest5PlayClick"] = $popupPCTest5PlayData["cnt"];
    }

    // 순간포착 테스트 - 영상 플레이 (MOBILE) 
    $popupMTest5PlayQuery = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='순간포착 테스트 플레이' AND click_gubun='MOBILE' ".$where." GROUP BY click_media";
    $popupMTest5PlayResult = mysqli_query($my_db, $popupMTest5PlayQuery);
    while ($popupMTest5PlayData = mysqli_fetch_array($popupMTest5PlayResult))
    {
        if ($my_array[0][$popupMTest5PlayData["click_media"]]["popupMTest5PlayClick"] == "0")
            $my_array[0][$popupMTest5PlayData["click_media"]]["popupMTest5PlayClick"] = $popupMTest5PlayData["cnt"];
    }

    // 순간포착 테스트 - 페이스북 공유 (PC) 
    $popupPCTest5FBShareQuery = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='페이스북 공유 순간포착' AND click_gubun='PC' ".$where." GROUP BY click_media";
    $popupPCTest5FBShareResult = mysqli_query($my_db, $popupPCTest5FBShareQuery);
    while ($popupPCTest5FBShareData = mysqli_fetch_array($popupPCTest5FBShareResult))
    {
        if ($my_array[0][$popupPCTest5FBShareData["click_media"]]["popupPCTest5FBShare"] == "0")
            $my_array[0][$popupPCTest5FBShareData["click_media"]]["popupPCTest5FBShare"] = $popupPCTest5FBShareData["cnt"];
    }

    // 순간포착 테스트 - 페이스북 공유 (MOBILE) 
    $popupMTest5FBShareQuery = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='페이스북 공유 순간포착' AND click_gubun='MOBILE' ".$where." GROUP BY click_media";
    $popupMTest5FBShareResult = mysqli_query($my_db, $popupMTest5FBShareQuery);
    while ($popupMTest5FBShareData = mysqli_fetch_array($popupMTest5FBShareResult))
    {
        if ($my_array[0][$popupMTest5FBShareData["click_media"]]["popupMTest5FBShare"] == "0")
            $my_array[0][$popupMTest5FBShareData["click_media"]]["popupMTest5FBShare"] = $popupMTest5FBShareData["cnt"];
    }

    // 순간포착 테스트 - 카카오톡 공유 (PC) 
    $popupPCTest5KTShareQuery = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='카카오톡 공유 순간포착' AND click_gubun='PC' ".$where." GROUP BY click_media";
    $popupPCTest5KTShareResult = mysqli_query($my_db, $popupPCTest5KTShareQuery);
    while ($popupPCTest5KTShareData = mysqli_fetch_array($popupPCTest5KTShareResult))
    {
        if ($my_array[0][$popupPCTest5KTShareData["click_media"]]["popupPCTest5KTShare"] == "0")
            $my_array[0][$popupPCTest5KTShareData["click_media"]]["popupPCTest5KTShare"] = $popupPCTest5KTShareData["cnt"];
    }

    // 순간포착 테스트 - 카카오톡 공유 (MOBILE) 
    $popupPCTest5KTShareQuery = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='카카오톡 공유 순간포착' AND click_gubun='MOBILE' ".$where." GROUP BY click_media";
    $popupPCTest5KTShareResult = mysqli_query($my_db, $popupPCTest5KTShareQuery);
    while ($popupPCTest5KTShareData = mysqli_fetch_array($popupPCTest5KTShareResult))
    {
        if ($my_array[0][$popupPCTest5KTShareData["click_media"]]["popupPCTest5KTShare"] == "0")
            $my_array[0][$popupPCTest5KTShareData["click_media"]]["popupPCTest5KTShare"] = $popupPCTest5KTShareData["cnt"];
    }

    // 순간포착 테스트 - 팝업 클로즈 (PC) 
    $popupPCTest5CloseQuery = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='순간포착 테스트 팝업 클로즈' AND click_gubun='PC' ".$where." GROUP BY click_media";
    $popupPCTest5CloseResult = mysqli_query($my_db, $popupPCTest5CloseQuery);
    while ($popupPCTest5CloseData = mysqli_fetch_array($popupPCTest5CloseResult))
    {
        if ($my_array[0][$popupPCTest5CloseData["click_media"]]["popupPCTest5Close"] == "0")
            $my_array[0][$popupPCTest5CloseData["click_media"]]["popupPCTest5Close"] = $popupPCTest5CloseData["cnt"];
    }

    // 순간포착 테스트 - 팝업 클로즈 (MOBILE) 
    $popupMTest5CloseQuery = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='순간포착 테스트 팝업 클로즈' AND click_gubun='MOBILE' ".$where." GROUP BY click_media";
    $popupMTest5CloseResult = mysqli_query($my_db, $popupMTest5CloseQuery);
    while ($popupMTest5CloseData = mysqli_fetch_array($popupMTest5CloseResult))
    {
        if ($my_array[0][$popupMTest5CloseData["click_media"]]["popupMTest5Close"] == "0")
            $my_array[0][$popupMTest5CloseData["click_media"]]["popupMTest5Close"] = $popupMTest5CloseData["cnt"];
    }

    // 시선집중 테스트 - 영상 플레이 (PC) 
    $popupPCTest6PlayQuery = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='시선집중 테스트 플레이' AND click_gubun='PC' ".$where." GROUP BY click_media";
    $popupPCTest6PlayResult = mysqli_query($my_db, $popupPCTest6PlayQuery);
    while ($popupPCTest6PlayData = mysqli_fetch_array($popupPCTest6PlayResult))
    {
        if ($my_array[0][$popupPCTest6PlayData["click_media"]]["popupPCTest6PlayClick"] == "0")
            $my_array[0][$popupPCTest6PlayData["click_media"]]["popupPCTest6PlayClick"] = $popupPCTest6PlayData["cnt"];
    }

    // 시선집중 테스트 - 영상 플레이 (MOBILE) 
    $popupMTest6PlayQuery = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='시선집중 테스트 플레이' AND click_gubun='MOBILE' ".$where." GROUP BY click_media";
    $popupMTest6PlayResult = mysqli_query($my_db, $popupMTest6PlayQuery);
    while ($popupMTest6PlayData = mysqli_fetch_array($popupMTest6PlayResult))
    {
        if ($my_array[0][$popupMTest6PlayData["click_media"]]["popupMTest6PlayClick"] == "0")
            $my_array[0][$popupMTest6PlayData["click_media"]]["popupMTest6PlayClick"] = $popupMTest6PlayData["cnt"];
    }

    // 시선집중 테스트 - 페이스북 공유 (PC) 
    $popupPCTest6FBShareQuery = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='페이스북 공유 시선집중' AND click_gubun='PC' ".$where." GROUP BY click_media";
    $popupPCTest6FBShareResult = mysqli_query($my_db, $popupPCTest6FBShareQuery);
    while ($popupPCTest6FBShareData = mysqli_fetch_array($popupPCTest6FBShareResult))
    {
        if ($my_array[0][$popupPCTest6FBShareData["click_media"]]["popupPCTest6FBShare"] == "0")
            $my_array[0][$popupPCTest6FBShareData["click_media"]]["popupPCTest6FBShare"] = $popupPCTest6FBShareData["cnt"];
    }

    // 시선집중 테스트 - 페이스북 공유 (MOBILE) 
    $popupMTest6FBShareQuery = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='페이스북 공유 시선집중' AND click_gubun='MOBILE' ".$where." GROUP BY click_media";
    $popupMTest6FBShareResult = mysqli_query($my_db, $popupMTest6FBShareQuery);
    while ($popupMTest6FBShareData = mysqli_fetch_array($popupMTest6FBShareResult))
    {
        if ($my_array[0][$popupMTest6FBShareData["click_media"]]["popupMTest6FBShare"] == "0")
            $my_array[0][$popupMTest6FBShareData["click_media"]]["popupMTest6FBShare"] = $popupMTest6FBShareData["cnt"];
    }

    // 시선집중 테스트 - 카카오톡 공유 (PC) 
    $popupPCTest6KTShareQuery = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='카카오톡 공유 시선집중' AND click_gubun='PC' ".$where." GROUP BY click_media";
    $popupPCTest6KTShareResult = mysqli_query($my_db, $popupPCTest6KTShareQuery);
    while ($popupPCTest6KTShareData = mysqli_fetch_array($popupPCTest6KTShareResult))
    {
        if ($my_array[0][$popupPCTest6KTShareData["click_media"]]["popupPCTest6KTShare"] == "0")
            $my_array[0][$popupPCTest6KTShareData["click_media"]]["popupPCTest6KTShare"] = $popupPCTest6KTShareData["cnt"];
    }

    // 시선집중 테스트 - 카카오톡 공유 (MOBILE) 
    $popupPCTest6KTShareQuery = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='카카오톡 공유 시선집중' AND click_gubun='MOBILE' ".$where." GROUP BY click_media";
    $popupPCTest6KTShareResult = mysqli_query($my_db, $popupPCTest6KTShareQuery);
    while ($popupPCTest6KTShareData = mysqli_fetch_array($popupPCTest6KTShareResult))
    {
        if ($my_array[0][$popupPCTest6KTShareData["click_media"]]["popupPCTest6KTShare"] == "0")
            $my_array[0][$popupPCTest6KTShareData["click_media"]]["popupPCTest6KTShare"] = $popupPCTest6KTShareData["cnt"];
    }

    // 시선집중 테스트 - 팝업 클로즈 (PC) 
    $popupPCTest6CloseQuery = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='시선집중 테스트 팝업 클로즈' AND click_gubun='PC' ".$where." GROUP BY click_media";
    $popupPCTest6CloseResult = mysqli_query($my_db, $popupPCTest6CloseQuery);
    while ($popupPCTest6CloseData = mysqli_fetch_array($popupPCTest6CloseResult))
    {
        if ($my_array[0][$popupPCTest6CloseData["click_media"]]["popupPCTest6Close"] == "0")
            $my_array[0][$popupPCTest6CloseData["click_media"]]["popupPCTest6Close"] = $popupPCTest6CloseData["cnt"];
    }

    // 시선집중 테스트 - 팝업 클로즈 (MOBILE) 
    $popupMTest6CloseQuery = "SELECT click_media, COUNT(click_media) cnt FROM click_info WHERE 1 AND click_name='시선집중 테스트 팝업 클로즈' AND click_gubun='MOBILE' ".$where." GROUP BY click_media";
    $popupMTest6CloseResult = mysqli_query($my_db, $popupMTest6CloseQuery);
    while ($popupMTest6CloseData = mysqli_fetch_array($popupMTest6CloseResult))
    {
        if ($my_array[0][$popupMTest6CloseData["click_media"]]["popupMTest6Close"] == "0")
            $my_array[0][$popupMTest6CloseData["click_media"]]["popupMTest6Close"] = $popupMTest6CloseData["cnt"];
    }


    $i = 0;
    foreach ($my_array as $key => $val)
    {
        foreach ($val as $key2 => $val2)
        {
            // 페이지 공유 Total
            $mainPCShareCnt   = $val2["mainPCFBShare"] + $val2["mainPCKTShare"];
            $mainMShareCnt   = $val2["mainMFBShare"] + $val2["mainMKTShare"];
            // 테스트 영상 플레이 Total
            $mainPCTestCnt      = $val2["mainPCTest1Click"] + $val2["mainPCTest2Click"] + $val2["mainPCTest3Click"] + $val2["mainPCTest4Click"] + $val2["mainPCTest5Click"] + $val2["mainPCTest6Click"];
            $mainMTestCnt      = $val2["mainMTest1Click"] + $val2["mainMTest2Click"] + $val2["mainMTest3Click"] + $val2["mainMTest4Click"] + $val2["mainMTest5Click"] + $val2["mainMTest6Click"];
            // 이벤트 참여 Total
            $mainPCEventCnt     = $val2["mainPCEvent1Click"] + $val2["mainPCEvent2Click"];
            $mainMEventCnt     = $val2["mainMEvent1Click"] + $val2["mainMEvent2Click"];
            // 다운로드 Total
            $mainPCDownloadCnt  = $val2["mainPCIosDownloadClick"] + $val2["mainPCAndroidDownloadClick"];
            $mainMDownloadCnt  = $val2["mainMIosDownloadClick"] + $val2["mainMAndroidDownloadClick"];
?>					
									<tr class="target _1">
										<td rowspan="2"><?=$val2["mediaName"]?></td>
										<td rowspan="2"><?=$val2["mediaGoods"]?></td>
										<td rowspan="2"><?=$val2["mediaSubject"]?></td>
										<td>PC</td>
										<td><?=$mainPCShareCnt?></td>
										<td><?=$val2["mainPCFBShare"]?></td>
										<td><?=$val2["mainPCKTShare"]?></td>
										<td><?=$mainPCTestCnt?></td>
										<td><?=$val2["mainPCTest1Click"]?></td>
										<td><?=$val2["mainPCTest2Click"]?></td>
										<td><?=$val2["mainPCTest3Click"]?></td>
										<td><?=$val2["mainPCTest4Click"]?></td>
										<td><?=$val2["mainPCTest5Click"]?></td>
										<td><?=$val2["mainPCTest6Click"]?></td>
										<td><?=$mainPCEventCnt?></td>
										<td><?=$val2["mainPCEvent1Click"]?></td>
										<td><?=$val2["mainPCEvent2Click"]?></td>
										<td><?=$mainPCDownloadCnt?></td>
										<td><?=$val2["mainPCIosDownloadClick"]?></td>
										<td><?=$val2["mainPCAndroidDownloadClick"]?></td>
										<td><?=$val2["popupPCTest1PlayClick"]?></td>
										<td><?=$val2["popupPCTest1FBShare"]?></td>
										<td><?=$val2["popupPCTest1KTShare"]?></td>
										<td><?=$val2["popupPCTest1Close"]?></td>
										<td><?=$val2["popupPCTest2PlayClick"]?></td>
										<td><?=$val2["popupPCTest2FBShare"]?></td>
										<td><?=$val2["popupPCTest2KTShare"]?></td>
										<td><?=$val2["popupPCTest2Close"]?></td>
										<td><?=$val2["popupPCTest3PlayClick"]?></td>
										<td><?=$val2["popupPCTest3FBShare"]?></td>
										<td><?=$val2["popupPCTest3KTShare"]?></td>
										<td><?=$val2["popupPCTest3Close"]?></td>
										<td><?=$val2["popupPCTest4PlayClick"]?></td>
										<td><?=$val2["popupPCTest4FBShare"]?></td>
										<td><?=$val2["popupPCTest4KTShare"]?></td>
										<td><?=$val2["popupPCTest4Close"]?></td>
										<td><?=$val2["popupPCTest5PlayClick"]?></td>
										<td><?=$val2["popupPCTest5FBShare"]?></td>
										<td><?=$val2["popupPCTest5KTShare"]?></td>
										<td><?=$val2["popupPCTest5Close"]?></td>
										<td><?=$val2["popupPCTest6PlayClick"]?></td>
										<td><?=$val2["popupPCTest6FBShare"]?></td>
										<td><?=$val2["popupPCTest6KTShare"]?></td>
										<td><?=$val2["popupPCTest6Close"]?></td>
                                    </tr>
									<tr class="target _1">
										<td>MOBILE</td>
										<td><?=$mainMShareCnt?></td>
										<td><?=$val2["mainMFBShare"]?></td>
										<td><?=$val2["mainMKTShare"]?></td>
										<td><?=$mainMTestCnt?></td>
										<td><?=$val2["mainMTest1Click"]?></td>
										<td><?=$val2["mainMTest2Click"]?></td>
										<td><?=$val2["mainMTest3Click"]?></td>
										<td><?=$val2["mainMTest4Click"]?></td>
										<td><?=$val2["mainMTest5Click"]?></td>
										<td><?=$val2["mainMTest6Click"]?></td>
										<td><?=$mainMEventCnt?></td>
										<td><?=$val2["mainMEvent1Click"]?></td>
										<td><?=$val2["mainMEvent2Click"]?></td>
										<td><?=$mainMDownloadCnt?></td>
										<td><?=$val2["mainMIosDownloadClick"]?></td>
										<td><?=$val2["mainMAndroidDownloadClick"]?></td>
										<td><?=$val2["popupMTest1PlayClick"]?></td>
										<td><?=$val2["popupMTest1FBShare"]?></td>
										<td><?=$val2["popupMTest1KTShare"]?></td>
										<td><?=$val2["popupMTest1Close"]?></td>
										<td><?=$val2["popupMTest2PlayClick"]?></td>
										<td><?=$val2["popupMTest2FBShare"]?></td>
										<td><?=$val2["popupMTest2KTShare"]?></td>
										<td><?=$val2["popupMTest2Close"]?></td>
										<td><?=$val2["popupMTest3PlayClick"]?></td>
										<td><?=$val2["popupMTest3FBShare"]?></td>
										<td><?=$val2["popupMTest3KTShare"]?></td>
										<td><?=$val2["popupMTest3Close"]?></td>
										<td><?=$val2["popupMTest4PlayClick"]?></td>
										<td><?=$val2["popupMTest4FBShare"]?></td>
										<td><?=$val2["popupMTest4KTShare"]?></td>
										<td><?=$val2["popupMTest4Close"]?></td>
										<td><?=$val2["popupMTest5PlayClick"]?></td>
										<td><?=$val2["popupMTest5FBShare"]?></td>
										<td><?=$val2["popupMTest5KTShare"]?></td>
										<td><?=$val2["popupMTest5Close"]?></td>
										<td><?=$val2["popupMTest6PlayClick"]?></td>
										<td><?=$val2["popupMTest6FBShare"]?></td>
										<td><?=$val2["popupMTest6KTShare"]?></td>
										<td><?=$val2["popupMTest6Close"]?></td>
                                    </tr>
<?
        $i++;
        }
    }
?>                                    
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<!-- /.row -->
			</div>
			<!-- /.container-fluid -->
		</div>
		<!-- /#page-wrapper -->
	</div>
	<!-- /#wrapper -->
	</body>

	</html>