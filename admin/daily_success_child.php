<?php
	// 설정파일
	include_once "../config.php";

	include "./head.php";
?>

<div id="page-wrapper">
  <div class="container-fluid">
  <!-- Page Heading -->
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">일자별 결연된 아이 수</h1>
      </div>
    </div>
    <!-- /.row -->
    <div class="row">
      <div class="col-lg-12">
        <div class="table-responsive">
          <table id="entry_list" class="table table-hover">
            <thead>
              <tr>
                <th rowspan="2">날짜</th>
                <th>합계</th>
              </tr>
            </thead>
            <tbody>
<?php 
	$date_query = "SELECT substr(mb_regdate,1,10) mb_date FROM ".$_gl['activator_info_table']." WHERE 1 Group by substr(mb_regdate,1,10) order by mb_regdate desc";
	$res = mysqli_query($my_db, $date_query);
	
	while ($date_data = @mysqli_fetch_array($res))
	{		
		$daily_date		= substr($date_data['mb_date'],0,10);
		$ch_query		= "SELECT * FROM ".$_gl['child_info_table']." WHERE 1 AND ch_choice='Y' AND ch_choice_date LIKE  '%".$daily_date."%'";
		$ch_count		= mysqli_num_rows(mysqli_query($my_db, $ch_query));
?>
              <tr>
                <td><?php echo $date_data['mb_date']?></td>
                <td><?php echo number_format($ch_count)?></td>
              </tr>
<?php 
	}
?>
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