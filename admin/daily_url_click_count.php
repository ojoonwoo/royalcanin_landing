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
          <h1 class="page-header">공유된 URL 클릭수</h1>
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
                  <tr><th>날짜</th><th>Total</th></tr>
                </thead>
                <tbody>
<?php
	$cnt_query	= "SELECT substr(cnt_date,1,10) cnt_date, count(cnt_date) cnt_num FROM ".$_gl['share_cnt_info_table']." WHERE 1 Group by substr(cnt_date,1,10) ORDER BY cnt_date DESC";
	$cnt_res			= mysqli_query($my_db, $cnt_query);
	while($cnt_data = mysqli_fetch_array($cnt_res))
	{
?>
                  <tr>
                    <td><?=$cnt_data['cnt_date']?></td>
                    <td><?=number_format($cnt_data['cnt_num'])?></td>
                  </tr>
<?php
	}
?>
                  <tr>
                    <td>2016-07-17</td>
                    <td>76</td>
                  </tr>
                  <tr>
                    <td>2016-07-16</td>
                    <td>303</td>
                  </tr>
                  <tr>
                    <td>2016-07-15</td>
                    <td>120</td>
                  </tr>
                  <tr>
                    <td>2016-07-14</td>
                    <td>448</td>
                  </tr>
                  <tr>
                    <td>2016-07-13</td>
                    <td>2495</td>
                  </tr>

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