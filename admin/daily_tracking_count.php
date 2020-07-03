<?php
	// 설정파일
	include_once "../include/autoload.php";

	$mnv_f = new mnv_function();
	$my_db         = $mnv_f->Connect_MySQL();

	include "./head.php";

//	$beforeDay = date("Y-m-d", strtotime($day." -6 day"));
//	print_r($beforeDay);
	if(isset($_REQUEST['sDate']) == false) {
		$sDate = date("Y-m-d", strtotime($day." -6 day"));
	} else {
		$sDate = $_REQUEST['sDate'];
	}

	if(isset($_REQUEST['eDate']) == false)
//		$eDate = "";
		$eDate = date("Y-m-d");
	else
		$eDate = $_REQUEST['eDate'];

?>
	<script type="text/javascript">
		$(function() {
			$("#sDate").datepicker();
			$("#eDate").datepicker();
		});

		function checkfrm() {
			if ($("#sDate").val() > $("#eDate").val()) {
				alert("검색 시작일은 종료일보다 작아야 합니다.");
				return false;
			}
		}
		function resetDate() {
			$('#sDate').val('<?=date("Y-m-d", strtotime($day." -6 day"))?>');
			$('#eDate').val('<?=date("Y-m-d")?>');
		}
		function outputExcel() {
			location.href = "excel_download_tracking.php?sDate=" + $("#sDate").val() + "&eDate=" + $("#eDate").val();
		}
	</script>

	<div id="page-wrapper">
		<div class="container-fluid">
			<!-- Page Heading -->
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">캠페인 사이트 유입자 수 PC / Mobile</h1>
				</div>
			</div>
			<!-- /.row -->
			<div class="row">
				<div class="col-lg-12">
					<div class="table-responsive">
						<ol class="breadcrumb">
							<form name="frm_execute" method="POST" onsubmit="return checkfrm()">
								<input type="hidden" name="pg" value="<?=$pg?>">
								<!--
					  <select name="search_type">
						  <option value="mb_name" <?php if($search_type == "mb_name"){?>selected<?php }?>>이름</option>
						  <option value="mb_phone" <?php if($search_type == "mb_phone"){?>selected<?php }?>>전화번호</option>
					  </select>
-->
								<!--					  <input type="text" name="search_txt" value="<?php echo $search_txt?>">-->
								<input type="text" id="sDate" class="date-input" name="sDate" value="<?=$sDate?>"> - <input type="text" id="eDate" class="date-input" name="eDate" value="<?=$eDate?>">
								<input type="submit" value="검색">
								<button type="button" onclick="resetDate()">기간 초기화</button>
								<!-- <button type="button" onclick="outputExcel()">엑셀로 내보내기</button> -->
								<!--
					  <a href="javascript:void(0)" id="excel_download_list">
						  <span>엑셀 다운로드</span>
					  </a> 
-->
							</form>
						</ol>
						<!-- 필리핀 -->
						<div id="daily_applicant_count_div1" style="display:block">
							<table class="table table-hover" style="position: relative;">
								<thead>
									<tr>
										<th>날짜</th>
										<th>유입매체</th>
										<th>PC</th>
										<th>Mobile</th>
										<th>Total</th>
									</tr>
								</thead>
								<tbody>
									<?php
	
	$where = "";

	if ($sDate != "")
		$where	.= " AND tracking_date BETWEEN '".$sDate." 00:00:00' AND '".$eDate." 23:59:59'";
								

					  
					  
	$daily_date_query	= "SELECT tracking_date FROM tracking_info WHERE 1 ".$where." Group by substr(tracking_date,1,10) ORDER BY tracking_date DESC";
	// print_r($daily_date_query);
	$date_res			= mysqli_query($my_db, $daily_date_query);
	while($date_daily_data = mysqli_fetch_array($date_res))
	{
		$daily_date		= substr($date_daily_data['tracking_date'],0,10);
		$media_query	= "SELECT tracking_media, COUNT( tracking_media ) media_cnt FROM tracking_info WHERE 1 AND tracking_date LIKE  '%".$daily_date."%' GROUP BY tracking_media";
		$media_res		= mysqli_query($my_db, $media_query);

		unset($media_name);
		unset($media_cnt);
		unset($pc_cnt);
		unset($mobile_cnt);
		unset($total_cnt);

		$total_media_cnt = 0;
		$total_mobile_cnt = 0;
		$total_pc_cnt = 0;

		while ($media_daily_data = mysqli_fetch_array($media_res))
		{
			$media_name[]	= $media_daily_data['tracking_media'];
			$media_cnt[]	= $media_daily_data['media_cnt'];
			$pc_query		= "SELECT * FROM tracking_info WHERE 1 AND tracking_date LIKE  '%".$daily_date."%' AND tracking_media='".$media_daily_data['tracking_media']."' AND tracking_gubun='PC' ";
			$pc_count		= mysqli_num_rows(mysqli_query($my_db, $pc_query));
			$mobile_query	= "SELECT * FROM tracking_info WHERE 1 AND tracking_date LIKE  '%".$daily_date."%' AND tracking_media='".$media_daily_data['tracking_media']."' AND tracking_gubun='MOBILE'";
			$mobile_count	= mysqli_num_rows(mysqli_query($my_db, $mobile_query));

			$pc_cnt[]		= $pc_count;
			$mobile_cnt[]	= $mobile_count;
			$total_cnt[]	= $pc_count + $mobile_count;
		}

		$rowspan_cnt =  count($media_name);
		$i = 0;
		foreach($media_name as $key => $val)
		{
?>
										<tr class="target">
											<?
			if ($i == 0)
			{
?>
												<td rowspan="<?=$rowspan_cnt?>">
													<?php echo $daily_date?>
													
													<a id="excelDown" href="excel_download_tracking.php?date=<?=$daily_date?>">
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
													<td>
														<?=number_format($total_cnt[$i])?>
													</td>
													<!-- <?=number_format($media_unique_cnt[$i])?></td> -->
										</tr>
										<?php
			$total_media_cnt += $total_cnt[$i];
			// $total_unique_media_cnt += $media_unique_cnt[$i];
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
											<tr bgcolor="skyblue" class="date-end">
												<td colspan="2">합계</td>
												<td>
													<?php echo number_format($total_pc_cnt)?>
												</td>
												<td>
													<?php echo number_format($total_mobile_cnt)?>
												</td>
												<!-- <td><?php echo number_format($total_unique_pc_cnt)?></td> -->
												<!-- <td><?php echo number_format($total_unique_mobile_cnt)?></td> -->
												<td>
													<?php echo number_format($total_media_cnt)?>
												</td>
												<!-- ." / IP기준 유니크 : ".$total_unique_media_cnt  -->
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
	</body>

	</html>