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
        <h1 class="page-header">1차 일자별 경품 당첨자 수</h1>
      </div>
    </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-lg-6">
          <div class="table-responsive">
            <div id="daily_topgirl_vote_count_div1" style="display:block">
              <table class="table table-hover">
                <thead>
                  <tr><th>날짜</th><th>정품(6명)</th><th>투고키트(7000명)</th><th>꽝</th></tr>
                </thead>
                <tbody>
<?php
	$daily_date_query	= "SELECT mb_regdate FROM member_info WHERE mb_regdate < '2018-04-09' Group by substr(mb_regdate,1,10) order by mb_regdate desc";
	$date_res			= mysqli_query($my_db, $daily_date_query);
	while($date_daily_data = mysqli_fetch_array($date_res))
	{
		$daily_date		= substr($date_daily_data['mb_regdate'],0,10);
		$winner_query	= "SELECT mb_winner, COUNT( mb_winner ) winner_cnt FROM member_info WHERE mb_regdate LIKE  '%".$daily_date."%' GROUP BY mb_winner";
		$winner_res		= mysqli_query($my_db, $winner_query);
		
		unset($winner_cnt);
		// $total_goods_cnt = 0;
		// $total_kit_cnt = 0;
    // $total_blank_cnt = 0;
    $winner_goods   = 0;
    $winner_kit     = 0;
    $winner_blank   = 0;
		while ($winner_daily_data = mysqli_fetch_array($winner_res))
		{
			if ($winner_daily_data['mb_winner'] == "goods")
			{
				$winner_goods	= $winner_daily_data['winner_cnt'];
			}else if ($winner_daily_data['mb_winner'] == "kit"){
				$winner_kit	= $winner_daily_data['winner_cnt'];
			}else{
				$winner_blank	= $winner_daily_data['winner_cnt'];
			}
		}
	
		$total_goods_cnt 	= $total_goods_cnt + $winner_goods;
		$total_kit_cnt 		= $total_kit_cnt + $winner_kit;
		$total_blank_cnt 	= $total_blank_cnt + $winner_blank;
?>
                  <tr>
                    <td><?=$daily_date?></td>
                    <td><?=number_format($winner_goods)?></td>
                    <td><?=number_format($winner_kit)?></td>
                    <td><?=number_format($winner_blank)?></td>
                  </tr>
<?
	}
?>
                  <tr>
                    <td>합 계</td>
                    <td><?=number_format($total_goods_cnt)?></td>
                    <td><?=number_format($total_kit_cnt)?></td>
                    <td><?=number_format($total_blank_cnt)?></td>
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