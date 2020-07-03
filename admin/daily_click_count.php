<?php
	// 설정파일
	include_once "../include/autoload.php";

	$mnv_f = new mnv_function();
	$my_db         = $mnv_f->Connect_MySQL();

	include "./head.php";

	if(isset($_REQUEST['targetmedia']) == false)
		//		$eDate = "";
		$media = "";
	else
		$media = $_REQUEST['targetmedia'];

	$media_list_query = "SELECT click_media FROM click_info WHERE 1 Group by click_media ORDER BY click_media DESC";
	$media_query_res = mysqli_query($my_db, $media_list_query);
	

//	$options = array( 'jw', 'test' );
	$options = array();
	$i = 0;
	$output = '';
	while($media_array = mysqli_fetch_array($media_query_res)) {
		if($media_array['click_media'] == '') {
			$options[$i] = "----";
		} else {
			$options[$i] = $media_array['click_media'];
		}
		
		$output .= '<option ' 
			. ( $media == $options[$i] ? 'selected="selected"' : '' ) . '>' 
			. $options[$i] 
			. '</option>';
		$i++;
	}
	print_r($options);

//	$output = '';
//	for( $i=0; $i<count($options); $i++ ) {
//		$output .= '<option ' 
//			. ( $media == $options[$i] ? 'selected="selected"' : '' ) . '>' 
//			. $options[$i] 
//			. '</option>';
//	}
?>
	<div id="page-wrapper">
		<div class="container-fluid">
			<!-- Page Heading -->
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">캠페인 사이트 내 클릭 수 PC / Mobile</h1>
				</div>
			</div>
			<!-- /.row -->
			<div class="row">
				<div class="col">
					<div class="table-responsive">
						<div id="daily_applicant_count_div1" style="display:block">
							<form id="frm_execute" name="frm_execute" method="POST" onsubmit="">
								<span>미디어별 소팅 : </span>
								<select name="targetmedia" id="targetmedia">
									<option value="">전체</option>
									<? echo $output; ?>
								</select>
							</form>
							<table class="table table-hover">
								<thead>
									<tr>
										<th>날짜</th>
										<th>클릭명</th>
										<th>PC</th>
										<th>Mobile</th>
										<!--<th>PC unique(IP)</th><th>MOBILE unique(IP)</th>-->
										<th>Total</th>
									</tr>
								</thead>
								<tbody>
									<?php
	$mediaWhere = "";
	if($media != "") {
		$mediaWhere = " AND click_media LIKE '".$media."'";
	}
		
	$daily_date_query	= "SELECT click_date FROM click_info WHERE 1 ".$mediaWhere." Group by substr(click_date,1,10) ORDER BY click_date DESC";
//	$daily_date_query	= "SELECT click_date FROM click_info Group by substr(click_date,1,10) ORDER BY click_date DESC";
	$date_res			= mysqli_query($my_db, $daily_date_query);
	while($date_daily_data = mysqli_fetch_array($date_res))
	{
		$daily_date		= substr($date_daily_data['click_date'],0,10);
		$click_query	= "SELECT click_name, COUNT( click_name ) click_name_cnt FROM click_info WHERE 1 ".$mediaWhere." AND click_date LIKE  '%".$daily_date."%' GROUP BY click_name";
		$click_res		= mysqli_query($my_db, $click_query);

		unset($click_name);
		unset($click_name_cnt);
		unset($click_cnt);
		unset($pc_cnt);
		unset($mobile_cnt);
		// unset($pc_unique_cnt);
		// unset($mobile_unique_cnt);
		// unset($click_unique_cnt);
		// unset($daily_unique_click_count);
		// unset($total_unique_click_cnt);
		$total_click_cnt = 0;
		$total_mobile_cnt = 0;
		$total_pc_cnt = 0;
		// $total_unique_mobile_cnt = 0;
		// $total_unique_pc_cnt = 0;
		// $daily_unique_click_query = "SELECT * FROM ".$_gl['click_info_table']." WHERE 1 AND click_date LIKE '%".$daily_date."%' GROUP BY click_ipaddr";
		// $daily_unique_click_res = mysqli_query($my_db, $daily_unique_click_query);
		// $daily_unique_click_count = mysqli_num_rows($daily_unique_click_res);
		while ($click_daily_data = mysqli_fetch_array($click_res))
		{
			$click_name[]	= $click_daily_data['click_name'];
			$click_cnt[]	= $click_daily_data['click_name_cnt'];
			$pc_query		= "SELECT * FROM click_info WHERE 1 ".$mediaWhere." AND click_date LIKE '%".$daily_date."%' AND click_name='".$click_daily_data['click_name']."' AND click_gubun='PC' ";
			$pc_count		= mysqli_num_rows(mysqli_query($my_db, $pc_query));
			$mobile_query	= "SELECT * FROM click_info WHERE 1 ".$mediaWhere." AND click_date LIKE '%".$daily_date."%' AND click_name='".$click_daily_data['click_name']."' AND click_gubun='MOBILE'";
			$mobile_count	= mysqli_num_rows(mysqli_query($my_db, $mobile_query));
			// $pc_unique_query		= "SELECT * FROM ".$_gl['click_info_table']." WHERE 1 AND click_date LIKE  '%".$daily_date."%' AND click_name='".$click_daily_data['click_name']."' AND click_gubun='PC' GROUP BY click_ipaddr";
			// $pc_unique_count		= mysqli_num_rows(mysqli_query($my_db, $pc_unique_query));
			// $mobile_unique_query	= "SELECT * FROM ".$_gl['click_info_table']." WHERE 1 AND click_date LIKE  '%".$daily_date."%' AND click_name='".$click_daily_data['click_name']."' AND click_gubun='MOBILE' GROUP BY click_ipaddr";
			// $mobile_unique_count	= mysqli_num_rows(mysqli_query($my_db, $mobile_unique_query));
			$pc_cnt[]		= $pc_count;
			$mobile_cnt[]	= $mobile_count;
			// $pc_unique_cnt[]		= $pc_unique_count;
			// $mobile_unique_cnt[]	= $mobile_unique_count;
			// $click_unique_cnt[]	= $pc_unique_count + $mobile_unique_count ;
		}
		$rowspan_cnt =  count($click_name);
		$i = 0;
		foreach($click_name as $key => $val)
		{
				// $val = str_replace("AppDirect","앱바로가기",$val);
				// $val = str_replace("FB","페이스북공유",$val);
				// $val = str_replace("KS","페이스북공유",$val);
				// $val = str_replace("TW","페이스북공유",$val);
				// $val = str_replace("KT","페이스북공유",$val);
				// $val = str_replace("AppInstall","앱설치하기",$val);
				// $val = str_replace("DETAIL","자세히보기",$val);
				// $val = str_replace("VIDEO","영상클릭",$val);
				// $val = str_replace("REQUEST","신청하기",$val);
				// $val = str_replace("FB","페이스북공유",$val);
				// $val = str_replace("JOIN","가입하기",$val);
				// $val = str_replace("AppDownload_Andro","안드로이드 다운로드",$val);
				// $val = str_replace("AppDownload_Ios","아이폰 다운로드",$val);
				// $val = str_replace("EventBanner","이벤트 배너",$val);
				// $val = str_replace("MAIN_buddy_banner","메인 버디 배너",$val);
?>
										<tr>
											<?
			if ($i == 0)
			{
?>
												<td rowspan="<?=$rowspan_cnt?>">
													<?php echo $daily_date?>				
													<a id="excelDown" href="excel_download_click.php?date=<?=$daily_date?>&sort=<?=$_REQUEST["targetmedia"]?>">
														<span>엑셀 다운로드</span>
													</a>
												</td>
												<?
			}
?>
													<td>
														<?=$val?>
													</td>
													<td>
														<?=number_format($pc_cnt[$i])?>
													</td>
													<td>
														<?=number_format($mobile_cnt[$i])?>
													</td>
													<!-- <td><?=number_format($pc_unique_cnt[$i])?></td>
                    <td><?=number_format($mobile_unique_cnt[$i])?></td> -->
													<!-- <td><?=number_format($click_cnt[$i])?> / <?=number_format($click_unique_cnt[$i])?></td> -->
													<td>
														<?=number_format($click_cnt[$i])?>
													</td>
										</tr>
										<?php
			$total_click_cnt += $click_cnt[$i];
			// $total_unique_click_cnt += $click_unique_cnt[$i];
			$total_mobile_cnt += $mobile_cnt[$i];
			$total_pc_cnt += $pc_cnt[$i];
			// $total_unique_mobile_cnt += $mobile_unique_cnt[$i];
			// $total_unique_pc_cnt += $pc_unique_cnt[$i];
			$i++;
		}
		$pc_total_all += $total_pc_cnt;
		$mobile_total_all += $total_mobile_cnt;
		$all_total += $total_pc_cnt+$total_mobile_cnt;
?>
											<tr bgcolor="skyblue">
												<td colspan="2">합계</td>
												<td>
													<?php echo number_format($total_pc_cnt)?>
												</td>
												<td>
													<?php echo number_format($total_mobile_cnt)?>
												</td>
												<!-- <td><?php echo number_format($total_unique_pc_cnt)?></td>
                    <td><?php echo number_format($total_unique_mobile_cnt)?></td> -->
												<!-- <td><?php echo number_format($total_click_cnt)." / IP기준 유니크 : ".$total_unique_click_cnt ?></td> -->
												<td>
													<?php echo number_format($total_click_cnt)?>
												</td>
											</tr>

											<?
	}
?>
								</tbody>
								<div class="total-wrap" style="float: right; background: lightgrey; padding: 20px; margin-bottom: 10px;">
									<?
					  echo "<span style='display:inline-block; margin-right:10px;'>PC: ".$pc_total_all."</span>";
					  echo "<span style='display:inline-block; margin-right:10px;'>MOBILE: ".$mobile_total_all."</span>";
					  echo "<span style='display:inline-block;'>TOTAL: ".$all_total."</span>";
					  ?>
								</div>
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
	<script>
		$('#targetmedia').on('change', function() {
			$('#frm_execute').submit();
		});
	</script>
	</body>

	</html>