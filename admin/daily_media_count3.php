<?php
	// 설정파일
	include_once "../config.do";
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
          <h1 class="page-header">캠페인 사이트(변 인증) 참여자 수 PC / Mobile</h1>
        </div>
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-lg-6">
          <div class="table-responsive">
            <!-- 필리핀 -->
            <div id="daily_applicant_count_div1" style="display:block">
              <table class="table table-hover">
                <thead>
                  <tr><th>날짜</th><th>유입매체</th><th>PC</th><th>Mobile</th><th>Total</th></tr>
                </thead>
                <tbody>
<?php
	$daily_date_query	= "SELECT certify_regdate FROM ".$_gl['certify_info_table']." Group by substr(certify_regdate,1,10) ORDER BY certify_regdate DESC";
	$date_res			= mysqli_query($my_db, $daily_date_query);
	while($date_daily_data = mysqli_fetch_array($date_res))
	{
		$daily_date		= substr($date_daily_data['certify_regdate'],0,10);
		$media_query	= "SELECT certify_media, COUNT( certify_media ) media_cnt FROM ".$_gl['certify_info_table']." WHERE 1 AND certify_regdate LIKE  '%".$daily_date."%' GROUP BY certify_media";
		$media_res		= mysqli_query($my_db, $media_query);

		unset($media_name);
		unset($media_cnt);
		unset($pc_cnt);
		unset($mobile_cnt);
		$total_media_cnt = 0;
		$total_mobile_cnt = 0;
		$total_pc_cnt = 0;
		while ($media_daily_data = mysqli_fetch_array($media_res))
		{
			$media_name[]	= $media_daily_data['certify_media'];
			$media_cnt[]	= $media_daily_data['media_cnt'];
			$pc_query		= "SELECT * FROM ".$_gl['certify_info_table']." WHERE 1 AND certify_regdate LIKE  '%".$daily_date."%' AND certify_media='".$media_daily_data['certify_media']."' AND certify_gubun='PC'";
			$pc_count		= mysqli_num_rows(mysqli_query($my_db, $pc_query));
			$mobile_query	= "SELECT * FROM ".$_gl['certify_info_table']." WHERE 1 AND certify_regdate LIKE  '%".$daily_date."%' AND certify_media='".$media_daily_data['certify_media']."' AND certify_gubun='MOBILE'";
			$mobile_count	= mysqli_num_rows(mysqli_query($my_db, $mobile_query));
			$pc_cnt[]		= $pc_count;
			$mobile_cnt[]	= $mobile_count;

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
                    <td rowspan="<?=$rowspan_cnt?>"><?php echo $daily_date?></td>
<?
			}
?>
                    <td><?=$val?></td>
                    <td><?=number_format($pc_cnt[$i])?></td>
                    <td><?=number_format($mobile_cnt[$i])?></td>
                    <td><?=number_format($media_cnt[$i])?></td>
                  </tr>
<?php
			$total_media_cnt += $media_cnt[$i];
			$total_mobile_cnt += $mobile_cnt[$i];
			$total_pc_cnt += $pc_cnt[$i];
			$i++;
		}
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
