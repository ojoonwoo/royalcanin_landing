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
          <h1 class="page-header">캠페인 사이트(체험팩) 레벨별 참여자 수</h1>
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
                  <tr><th>날짜</th><th>2레벨</th><th>3레벨</th><th>Total</th></tr>
                </thead>
                <tbody>
<?php
	$daily_date_query	= "SELECT exp_regdate FROM ".$_gl['exp_info_table']." Group by substr(exp_regdate,1,10) ORDER BY exp_regdate DESC";
	$date_res			= mysqli_query($my_db, $daily_date_query);
	while($date_daily_data = mysqli_fetch_array($date_res))
	{
		$daily_date		= substr($date_daily_data['exp_regdate'],0,10);
		unset($media_name);
		unset($media_cnt);
		unset($pc_cnt);
		unset($mobile_cnt);
		$total_media_cnt = 0;
		$total_mobile_cnt = 0;
		$total_pc_cnt = 0;

		$exp2_query		= "SELECT * FROM ".$_gl['exp_info_table']." WHERE 1 AND exp_level='2' AND exp_regdate LIKE  '%".$daily_date."%'";
		$exp2_count		= mysqli_num_rows(mysqli_query($my_db, $exp2_query));
		$exp3_query		= "SELECT * FROM ".$_gl['exp_info_table']." WHERE 1 AND exp_level='3' AND exp_regdate LIKE  '%".$daily_date."%'";
		$exp3_count		= mysqli_num_rows(mysqli_query($my_db, $exp3_query));
		$daily_total_count	= $exp2_count + $exp3_count;
?>
                  <tr>
                    <td><?php echo $daily_date?></td>
                    <td><?=number_format($exp2_count)?></td>
                    <td><?=number_format($exp3_count)?></td>
                    <td><?=number_format($daily_total_count)?></td>
                  </tr>
<?php
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