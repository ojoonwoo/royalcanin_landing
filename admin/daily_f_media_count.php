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
          <h1 class="page-header">팔로워 캠페인 사이트 참여자 수(팔로워)</h1>
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
                  <tr><th>날짜</th><th>PC</th><th>Mobile</th><th>Total</th></tr>
                </thead>
                <tbody>
<?php
	$daily_date_query	= "SELECT mb_regdate FROM ".$_gl['follower_info_table']." WHERE 1 Group by substr(mb_regdate,1,10) ORDER BY mb_regdate DESC";
	$date_res			= mysqli_query($my_db, $daily_date_query);
	while($date_daily_data = mysqli_fetch_array($date_res))
	{
		$daily_date		= substr($date_daily_data['mb_regdate'],0,10);

		$pc_query		= "SELECT * FROM ".$_gl['follower_info_table']." WHERE 1 AND shareYN='Y' AND mb_regdate LIKE  '%".$daily_date."%' AND mb_gubun='PC'";
		$pc_count		= mysqli_num_rows(mysqli_query($my_db, $pc_query));
		$mobile_query	= "SELECT * FROM ".$_gl['follower_info_table']." WHERE 1 AND shareYN='Y' AND mb_regdate LIKE  '%".$daily_date."%' AND mb_gubun='MOBILE'";
		$mobile_count	= mysqli_num_rows(mysqli_query($my_db, $mobile_query));
		$total_count	= $pc_count + $mobile_count;
?>
                  <tr>
                    <td><?php echo $daily_date?></td>
                    <td><?=number_format($pc_count)?></td>
                    <td><?=number_format($mobile_count)?></td>
                    <td><?=number_format($total_count)?></td>
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