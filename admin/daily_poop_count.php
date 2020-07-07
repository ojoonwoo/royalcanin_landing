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
          <h1 class="page-header">이벤트3 각 변별 참여자 수 PC / Mobile</h1>
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
                  <tr><th>날짜</th><th>변 종류</th><th>PC</th><th>Mobile</th><th>Total</th></tr>
                </thead>
                <tbody>
<?php
	$daily_date_query	= "SELECT certify_regdate FROM ".$_gl['certify_info_table']." Group by substr(certify_regdate,1,10) ORDER BY certify_regdate DESC";
	$date_res			= mysqli_query($my_db, $daily_date_query);
	while($date_daily_data = mysqli_fetch_array($date_res))
	{
		$daily_date		= substr($date_daily_data['certify_regdate'],0,10);
		$poop_query	= "SELECT certify_poop, COUNT( certify_poop ) poop_cnt FROM ".$_gl['certify_info_table']." WHERE 1 AND certify_regdate LIKE  '%".$daily_date."%' GROUP BY certify_poop";
		$poop_res		= mysqli_query($my_db, $poop_query);

		unset($poop_name);
		unset($poop_cnt);
		unset($pc_cnt);
		unset($mobile_cnt);
		$total_poop_cnt = 0;
		$total_mobile_cnt = 0;
		$total_pc_cnt = 0;
		while ($poop_daily_data = mysqli_fetch_array($poop_res))
		{
			$poop_name[]	= $poop_daily_data['certify_poop'];
			$poop_cnt[]	= $poop_daily_data['poop_cnt'];
			$pc_query		= "SELECT * FROM ".$_gl['certify_info_table']." WHERE 1 AND certify_regdate LIKE  '%".$daily_date."%' AND certify_poop='".$poop_daily_data['certify_poop']."' AND certify_gubun='PC'";
			$pc_count		= mysqli_num_rows(mysqli_query($my_db, $pc_query));
			$mobile_query	= "SELECT * FROM ".$_gl['certify_info_table']." WHERE 1 AND certify_regdate LIKE  '%".$daily_date."%' AND certify_poop='".$poop_daily_data['certify_poop']."' AND certify_gubun='MOBILE'";
			$mobile_count	= mysqli_num_rows(mysqli_query($my_db, $mobile_query));
			$pc_cnt[]		= $pc_count;
			$mobile_cnt[]	= $mobile_count;

		}
		$rowspan_cnt =  count($poop_name);
		$i = 0;
		foreach($poop_name as $key => $val)
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
                    <td><?=number_format($poop_cnt[$i])?></td>
                  </tr>
<?php
			$total_poop_cnt += $poop_cnt[$i];
			$total_mobile_cnt += $mobile_cnt[$i];
			$total_pc_cnt += $pc_cnt[$i];
			$i++;
		}
?>
                  <tr bgcolor="skyblue">
                    <td colspan="2">합계</td>
                    <td><?php echo number_format($total_pc_cnt)?></td>
                    <td><?php echo number_format($total_mobile_cnt)?></td>
                    <td><?php echo number_format($total_poop_cnt)?></td>
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
