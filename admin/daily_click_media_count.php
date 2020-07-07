<?php
// 설정파일
include_once "../include/autoload.php";

$mnv_f = new mnv_function();
$my_db         = $mnv_f->Connect_MySQL();
/*
	if (isset($_SESSION['ss_mb_id']) == false)
	{
		//header('Location: index.php');
		echo "<script>location.href='index.php'</script>";
		exit;
	}
*/
include "./head.php";

?>

<div id="page-wrapper">
	<div class="container-fluid">
		<!-- Page Heading -->
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">매체별 이벤트 참여 버튼 클릭 수 PC / Mobile</h1>
			</div>
		</div>
		<!-- /.row -->
		<div class="row">
			<div class="col">
				<div class="table-responsive">
					<div id="daily_applicant_count_div1" style="display:block">
						<table class="table table-hover">
							<thead>
								<tr><th>날짜</th><th>매체</th><th>PC</th><th>Mobile</th><th>unique(IP)</th><!--<th>PC unique(IP)</th><th>MOBILE unique(IP)</th>--><th>Total</th></tr>
							</thead>
							<tbody>
								<?php
								$daily_date_query	= "SELECT click_date FROM click_info Group by substr(click_date,1,10) ORDER BY click_date DESC";
								$date_res			= mysqli_query($my_db, $daily_date_query);
								while($date_daily_data = mysqli_fetch_array($date_res))
								{
									$daily_date		= substr($date_daily_data['click_date'],0,10);
									$click_query	= "SELECT click_media, COUNT( click_media ) click_media_cnt FROM click_info WHERE 1 AND click_date LIKE  '%".$daily_date."%' GROUP BY click_media";
									$click_res		= mysqli_query($my_db, $click_query);

									unset($click_media);
									unset($click_name_cnt);
									unset($click_cnt);
									unset($pc_cnt);
									unset($mobile_cnt);
									unset($unique_cnt);
									// unset($mobile_unique_cnt);
									// unset($click_unique_cnt);
									// unset($daily_unique_click_count);
									// unset($total_unique_click_cnt);
									$total_click_cnt = 0;
									$total_mobile_cnt = 0;
									$total_pc_cnt = 0;
									// $total_unique_mobile_cnt = 0;
									$total_unique_cnt = 0;
									// $daily_unique_click_query = "SELECT * FROM ".$_gl['click_info_table']." WHERE 1 AND click_date LIKE '%".$daily_date."%' GROUP BY click_ipaddr";
									// $daily_unique_click_res = mysqli_query($my_db, $daily_unique_click_query);
									// $daily_unique_click_count = mysqli_num_rows($daily_unique_click_res);
									while ($click_daily_data = mysqli_fetch_array($click_res))
									{
										$click_media[]	= $click_daily_data['click_media'];
										$click_cnt[]	= $click_daily_data['click_media_cnt'];
										$pc_query		= "SELECT * FROM click_info WHERE 1 AND click_date LIKE  '%".$daily_date."%' AND click_media='".$click_daily_data['click_media']."' AND click_gubun='PC' ";
										$pc_count		= mysqli_num_rows(mysqli_query($my_db, $pc_query));
										$mobile_query	= "SELECT * FROM click_info WHERE 1 AND click_date LIKE  '%".$daily_date."%' AND click_media='".$click_daily_data['click_media']."' AND click_gubun='MOBILE'";
										$mobile_count	= mysqli_num_rows(mysqli_query($my_db, $mobile_query));
										$unique_query		= "SELECT * FROM click_info WHERE 1 AND click_date LIKE  '%".$daily_date."%' AND click_media='".$click_daily_data['click_media']."' GROUP BY click_ipaddr";
										$unique_count		= mysqli_num_rows(mysqli_query($my_db, $unique_query));
										// $mobile_unique_query	= "SELECT * FROM ".$_gl['click_info_table']." WHERE 1 AND click_date LIKE  '%".$daily_date."%' AND click_name='".$click_daily_data['click_name']."' AND click_gubun='MOBILE' GROUP BY click_ipaddr";
										// $mobile_unique_count	= mysqli_num_rows(mysqli_query($my_db, $mobile_unique_query));
										$pc_cnt[]		= $pc_count;
										$mobile_cnt[]	= $mobile_count;
										$unique_cnt[]		= $unique_count;
										// $mobile_unique_cnt[]	= $mobile_unique_count;
										// $click_unique_cnt[]	= $pc_unique_count + $mobile_unique_count ;
									}
									$rowspan_cnt =  count($click_media);
									$i = 0;
									foreach($click_media as $key => $val)
									{
								?>
								<tr>
									<?
										if ($i == 0)
										{
									?>
									<td rowspan="<?=$rowspan_cnt?>">
										<?php echo $daily_date?>
										<!-- <a id="excelDown" href="excel_download_click.php?date=<?=$daily_date?>">
<span>엑셀 다운로드</span>
</a> -->
									</td>
									<?
										}
									?>
									<td><?=$val?></td>
									<td><?=number_format($pc_cnt[$i])?></td>
									<td><?=number_format($mobile_cnt[$i])?></td>
									<td><?=number_format($unique_cnt[$i])?></td>
									<!-- <td><?=number_format($mobile_unique_cnt[$i])?></td> -->
									<!-- <td><?=number_format($click_cnt[$i])?> / <?=number_format($click_unique_cnt[$i])?></td> -->
									<td><?=number_format($click_cnt[$i])?></td>
								</tr>
								<?php
										$total_click_cnt += $click_cnt[$i];
										// $total_unique_click_cnt += $click_unique_cnt[$i];
										$total_mobile_cnt += $mobile_cnt[$i];
										$total_pc_cnt += $pc_cnt[$i];
										// $total_unique_mobile_cnt += $mobile_unique_cnt[$i];
										$total_unique_cnt += $unique_cnt[$i];
										$i++;
									}
								?>
								<tr bgcolor="skyblue">
									<td colspan="2">합계</td>
									<td><?php echo number_format($total_pc_cnt)?></td>
									<td><?php echo number_format($total_mobile_cnt)?></td>
									<td><?php echo number_format($total_unique_cnt)?></td>
									<!-- <td><?php echo number_format($total_unique_mobile_cnt)?></td> -->
									<!-- <td><?php echo number_format($total_click_cnt)." / IP기준 유니크 : ".$total_unique_click_cnt ?></td> -->
									<td><?php echo number_format($total_click_cnt)?></td>
								</tr>

								<?
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
