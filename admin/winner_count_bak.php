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

	if(isset($_REQUEST['pg']) == false)
		$pg = "1";
	else
		$pg = $_REQUEST['pg'];
	
	if (!$pg)
		$pg = "1";
	//if(isset($pg) == false) $pg = 1;	// $pg가 없으면 1로 생성
	$page_size = 10;	// 한 페이지에 나타날 개수
	$block_size = 10;	// 한 화면에 나타낼 페이지 번호 개수

	//if (isset($search_type) == false)
	//	$search_type = "search_by_name";
?>
<div id="page-wrapper">
  <div class="container-fluid">
  <!-- Page Heading -->
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">경품별 당첨자 수</h1>
      </div>
    </div>
    <!-- /.row -->
    <div class="row">
      <div class="col-lg-12">
        <div class="table-responsive">
          <table id="entry_list" class="table table-hover">
            <thead>
              <tr>
                <th>정품(6명)</th>
                <th>투고키트(7000명)</th>
                <th>꽝</th>
              </tr>
            </thead>
            <tbody>
<?php 
	$buyer_count_query = "SELECT count(*) FROM member_info WHERE 1";

	$buyer_list_query = "SELECT mb_winner, count(mb_winner) cnt FROM member_info WHERE 1 GROUP BY mb_winner";
	$res = mysqli_query($my_db, $buyer_list_query);

	while ($b_data = @mysqli_fetch_array($res))
	{
		if ($b_data['mb_winner'] == "goods")
		{
			$winner_goods	= $b_data['cnt'];
		}else if ($b_data['mb_winner'] == "kit"){
			$winner_kit	= $b_data['cnt'];
		}else{
			$winner_blank	= $b_data['cnt'];
		}
	}
?>
              <tr>
                <td><?php echo $winner_goods?></td>	<!-- No. 하나씩 감소 -->
                <td><?php echo $winner_kit?></td>	<!-- No. 하나씩 감소 -->
                <td><?php echo $winner_blank?></td>	<!-- No. 하나씩 감소 -->
              </tr>
            </tbody>
          </table>
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



<script type="text/javascript">
 
	function pageRun(num)
	{
		f = document.frm_execute;
		f.pg.value = num;
		f.submit();
	}
</script>