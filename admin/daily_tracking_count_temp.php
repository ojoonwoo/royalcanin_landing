<?php
	// 설정파일
	include_once "../config.php";
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
          <h1 class="page-header">캠페인 사이트 유입자 수 PC / Mobile</h1>
        </div>
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-lg-12">
          <div class="table-responsive">
            <!-- 필리핀 -->
            <div id="daily_applicant_count_div1" style="display:block">
            <div><span>날짜</span><span>유입매체</span><span>PC</span><span>Mobile</span><span>Total</span></div>
<?php
	$daily_date_query	= "SELECT tracking_date FROM ".$_gl['tracking_info_table']." Group by substr(tracking_date,1,10) ORDER BY tracking_date DESC";
	$date_res			= mysqli_query($my_db, $daily_date_query);
	while($date_daily_data = mysqli_fetch_array($date_res))
	{
		$daily_date		= substr($date_daily_data['tracking_date'],0,10);
		$media_query	= "SELECT tracking_media, COUNT( tracking_media ) media_cnt FROM ".$_gl['tracking_info_table']." WHERE 1 AND tracking_date LIKE  '%".$daily_date."%' GROUP BY tracking_media";
		$media_res		= mysqli_query($my_db, $media_query);

		unset($media_name);
		unset($media_cnt);
		unset($pc_cnt);
		unset($mobile_cnt);
		// unset($pc_unique_cnt);
		// unset($mobile_unique_cnt);
		// unset($media_unique_cnt);
		// unset($daily_unique_tracking_count);
		// unset($total_unique_media_cnt);
		$total_media_cnt = 0;
		$total_mobile_cnt = 0;
		$total_pc_cnt = 0;
		// $total_unique_media_cnt = 0;
		// $total_unique_mobile_cnt = 0;
		// $total_unique_pc_cnt = 0;
		// $daily_unique_tracking_query = "SELECT * FROM ".$_gl['tracking_info_table']." WHERE 1 AND tracking_date LIKE '%".$daily_date."%' GROUP BY tracking_ipaddr";
		// $daily_unique_tracking_res = mysqli_query($my_db, $daily_unique_tracking_query);
        // $daily_unique_tracking_count = mysqli_num_rows($daily_unique_tracking_res);
?>
        <table class="table table-hover">
        <thead>
          <!-- <tr><th>날짜</th><th>유입매체</th><th>PC</th><th>Mobile</th><th>Total</th></tr> -->
        </thead>
        <tbody>
<?php
		while ($media_daily_data = mysqli_fetch_array($media_res))
		{
			$media_name[]	= $media_daily_data['tracking_media'];
			$media_cnt[]	= $media_daily_data['media_cnt'];
			$pc_query		= "SELECT * FROM ".$_gl['tracking_info_table']." WHERE 1 AND tracking_date LIKE  '%".$daily_date."%' AND tracking_media='".$media_daily_data['tracking_media']."' AND tracking_gubun='PC' ";
			$pc_count		= mysqli_num_rows(mysqli_query($my_db, $pc_query));
			$mobile_query	= "SELECT * FROM ".$_gl['tracking_info_table']." WHERE 1 AND tracking_date LIKE  '%".$daily_date."%' AND tracking_media='".$media_daily_data['tracking_media']."' AND tracking_gubun='MOBILE'";
			$mobile_count	= mysqli_num_rows(mysqli_query($my_db, $mobile_query));
			// $pc_unique_query		= "SELECT * FROM ".$_gl['tracking_info_table']." WHERE 1 AND tracking_date LIKE  '%".$daily_date."%' AND tracking_media='".$media_daily_data['tracking_media']."' AND tracking_gubun='PC' GROUP BY tracking_ipaddr";
			// $pc_unique_count		= mysqli_num_rows(mysqli_query($my_db, $pc_unique_query));
			// $mobile_unique_query	= "SELECT * FROM ".$_gl['tracking_info_table']." WHERE 1 AND tracking_date LIKE  '%".$daily_date."%' AND tracking_media='".$media_daily_data['tracking_media']."' AND tracking_gubun='MOBILE' GROUP BY tracking_ipaddr";
			// $mobile_unique_count	= mysqli_num_rows(mysqli_query($my_db, $mobile_unique_query));
			$pc_cnt[]		= $pc_count;
			$mobile_cnt[]	= $mobile_count;
			// $pc_unique_cnt[]		= $pc_unique_count;
			// $mobile_unique_cnt[]	= $mobile_unique_count;
			// $media_unique_cnt[]	= $pc_unique_count + $mobile_unique_count;


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
                    <td rowspan="<?=$rowspan_cnt?>"><?php echo $daily_date?></td>
<?
			}
?>
                    <td><?=$val?></td>
                    <td><?=number_format($pc_cnt[$i])?></td>
                    <td><?=number_format($mobile_cnt[$i])?></td>
                    <!-- <td><?=number_format($pc_unique_cnt[$i])?></td>
                    <td><?=number_format($mobile_unique_cnt[$i])?></td> -->
										<td><?=number_format($media_cnt[$i])?></td>
										<!-- <?=number_format($media_unique_cnt[$i])?></td> -->
                  </tr>
<?php
			$total_media_cnt += $media_cnt[$i];
			// $total_unique_media_cnt += $media_unique_cnt[$i];
			$total_mobile_cnt += $mobile_cnt[$i];
			$total_pc_cnt += $pc_cnt[$i];
			// $total_unique_mobile_cnt += $mobile_unique_cnt[$i];
			// $total_unique_pc_cnt += $pc_unique_cnt[$i];
			$i++;
		}
?>
                  <tr bgcolor="skyblue" class="date-end">
                    <td colspan="2">합계</td>
                    <td><?php echo number_format($total_pc_cnt)?></td>
                    <td><?php echo number_format($total_mobile_cnt)?></td>
                    <!-- <td><?php echo number_format($total_unique_pc_cnt)?></td> -->
                    <!-- <td><?php echo number_format($total_unique_mobile_cnt)?></td> -->
										<td><?php echo number_format($total_media_cnt)?></td>
										<!-- ." / IP기준 유니크 : ".$total_unique_media_cnt  -->
                  </tr>

                </tbody>
            </table>
<?
	}
?>
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
