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
        <h1 class="page-header">좋아요 다득점(상위 100) 목록</h1>
      </div>
    </div>
    <!-- /.row -->
    <div class="row">
      <div class="col-lg-12">
        <div class="table-responsive">
          <ol class="breadcrumb">
          </ol>
          <table id="entry_list" class="table table-hover">
            <thead>
              <tr>
                <th>순번</th>
                <th>이름</th>
                <th>전화번호</th>
                <th>제품이름</th>
                <th>제품이름 이유</th>
                <th>좋아요 갯수</th>
                <th>참여일자</th>
              </tr>
            </thead>
            <tbody>
<?php
	$buyer_list_query = "SELECT * FROM ".$_gl['member_info_table']." WHERE 1 Order by mb_vote DESC LIMIT 100";
	$res = mysqli_query($my_db, $buyer_list_query);

	while ($buyer_data = @mysqli_fetch_array($res))
	{
		$buyer_info[] = $buyer_data;
	}

	$i = 1;
	foreach($buyer_info as $key => $val)
	{
?>
              <tr>
                <td><?php echo $i?></td>
                <td><?php echo $buyer_info[$key]['mb_name']?></td>
                <td><?php echo $buyer_info[$key]['mb_phone']?></td>
                <td><?php echo $buyer_info[$key]['goods_name']?></td>
                <td><?php echo $buyer_info[$key]['goods_desc']?></td>
                <td><?php echo $buyer_info[$key]['mb_vote']?></td>
                <td><?php echo $buyer_info[$key]['mb_regdate']?></td>
              </tr>
<?php
		$i++;
	}
?>
              <tr><td colspan="13"><div class="pageing"><?php echo $BLOCK_LIST?></div></td></tr>
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
