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
        <h1 class="page-header">일자별 SNS 공유 버튼 클릭 수</h1>
      </div>
    </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-lg-6">
          <div class="table-responsive">
            <div id="daily_topgirl_vote_count_div1" style="display:block">
              <table class="table table-hover">
                <thead>
                  <tr><th>날짜</th><th>공유위치</th><th>PC</th><th>Mobile</th><th>Total</th></tr>
                </thead>
                <tbody>
<?php
	$daily_date_query	= "SELECT sns_regdate FROM share_info Group by substr(sns_regdate,1,10) order by sns_regdate desc";
	$date_res			= mysqli_query($my_db, $daily_date_query);
	while($date_daily_data = mysqli_fetch_array($date_res))
	{
		$daily_date		= substr($date_daily_data['sns_regdate'],0,10);
		$media_query	= "SELECT sns_media, COUNT( sns_media ) media_cnt FROM share_info WHERE sns_regdate LIKE  '%".$daily_date."%' GROUP BY sns_media";
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
			$media_name[]	= $media_daily_data['sns_media'];
			$media_cnt[]	= $media_daily_data['media_cnt'];
			$pc_query		= "SELECT * FROM share_info WHERE sns_regdate LIKE  '%".$daily_date."%' AND sns_media='".$media_daily_data['sns_media']."' AND sns_gubun='PC'";
			$pc_count		= mysqli_num_rows(mysqli_query($my_db, $pc_query));
			$mobile_query	= "SELECT * FROM share_info WHERE sns_regdate LIKE  '%".$daily_date."%' AND sns_media='".$media_daily_data['sns_media']."' AND sns_gubun='MOBILE'";
			$mobile_count	= mysqli_num_rows(mysqli_query($my_db, $mobile_query));
			$pc_cnt[]		= $pc_count;
			$mobile_cnt[]	= $mobile_count;
			$total_cnt[]		= $pc_count + $mobile_count;
		}

		$rowspan_cnt =  count($media_name);
		$i = 0;
		foreach($media_name as $key => $val)
		{
?>
                  <tr>
<?
			if ($i == 0)
			{
?>
                    <td rowspan="<?=$rowspan_cnt?>">
                    	<?php echo $daily_date?>
						<a id="excelDown" href="excel_download_share.php?date=<?=$daily_date?>">
							<span>엑셀 다운로드</span>
						</a>
					</td>
<?
			}
?>
                    <td><?=$val?></td>
                    <td><?=number_format($pc_cnt[$i])?></td>
                    <td><?=number_format($mobile_cnt[$i])?></td>
                    <td><?=number_format($total_cnt[$i])?></td>
                  </tr>
<?php
			$total_media_cnt += $media_cnt[$i];
			$total_mobile_cnt += $mobile_cnt[$i];
			$total_pc_cnt += $pc_cnt[$i];                  
			$i++;
		}
		$pc_total_all += $total_pc_cnt;
		$mobile_total_all += $total_mobile_cnt;
		$media1_total += $media_cnt[0];
		$media2_total += $media_cnt[1];
		$all_total += $total_pc_cnt+$total_mobile_cnt;
?>
                  <tr bgcolor="skyblue">
                    <td colspan="2">합계</td>
                    <td><?php echo number_format($total_pc_cnt)?></td>
                    <td><?php echo number_format($total_mobile_cnt)?></td>
                    <td><?php echo number_format($total_media_cnt)?></td>
                  </tr>

<?
	}
?>
                </tbody>
				<div class="total-wrap" style="float: right; background: lightgrey; padding: 20px; margin-bottom: 10px;">
					  <?
					  echo "<span style='display:inline-block; margin-right:10px;'>PC: ".$pc_total_all."</span>";
					  echo "<span style='display:inline-block; margin-right:10px;'>MOBILE: ".$mobile_total_all."</span>";
					  echo "<span style='display:inline-block; margin-right:10px;'>FB: ".$media1_total."</span>";
					  echo "<span style='display:inline-block; margin-right:10px;'>KT: ".$media2_total."</span>";
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