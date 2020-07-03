<?php
	include_once "../include/autoload.php";

	$mnv_f = new mnv_function();
	$my_db         = $mnv_f->Connect_MySQL();

	include "./head.php";

	if(isset($_REQUEST['search_type']) == false)
		$search_type = "";
	else
		$search_type = $_REQUEST['search_type'];

	if(isset($_REQUEST['search_txt']) == false)
		$search_txt	= "";
	else
		$search_txt	= $_REQUEST['search_txt'];

	if(isset($_REQUEST['sDate']) == false)
		$sDate = "";
	else
		$sDate = $_REQUEST['sDate'];

	if(isset($_REQUEST['eDate']) == false)
		$eDate = "";
	else
		$eDate = $_REQUEST['eDate'];


	if(isset($_REQUEST['pg']) == false)
		$pg = "1";
	else
		$pg = $_REQUEST['pg'];

	if (!$pg)
		$pg = "1";
	if(isset($pg) == false) $pg = 1;	// $pg가 없으면 1로 생성
	$page_size = 10;	// 한 페이지에 나타날 개수
	$block_size = 10;	// 한 화면에 나타낼 페이지 번호 개수

	//if (isset($search_type) == false)
	//	$search_type = "search_by_name";
?>
<script type="text/javascript">
	$(function() {
		$( "#sDate" ).datepicker();
		$( "#eDate" ).datepicker();
	});

	function checkfrm()
	{
		if ($("#sDate").val() > $("#eDate").val())
		{
			alert("검색 시작일은 종료일보다 작아야 합니다.");
			return false;
		}
	}
</script>
<div id="page-wrapper">
  <div class="container-fluid">
  <!-- Page Heading -->
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">등록된 데이터 리스트</h1>
      </div>
    </div>
    <!-- /.row -->
    <div class="row">
      <div class="col-lg-12">
        <div class="table-responsive">
          <ol class="breadcrumb">
            <form name="frm_execute" method="POST" onsubmit="return checkfrm()">
              <input type="hidden" name="pg" value="<?=$pg?>">
			  <li align="right";>
			  <?
					$member = "SELECT count(idx) FROM data_info WHERE 1";
					$res3 = mysqli_query($my_db, $member);
					list($total_count)	= @mysqli_fetch_array($res3);
					$uniqueMember = "SELECT count(*) FROM data_info WHERE 1 AND showYN='Y'";
					$resUnique = mysqli_query($my_db, $uniqueMember);
					// $show_total_count	= mysqli_num_rows($resUnique);
					list($show_total_count)	= @mysqli_fetch_array($resUnique);
					echo  "전체 등록된 데이터 수 : $total_count / 노출 설정된 데이터 수 : $show_total_count";
				?>
			</li>
            </form>
          </ol>
          <table id="entry_list" class="table table-hover">
            <thead>
              <tr>
                <th>순번</th>
                <th>제목</th>
                <th>브랜드</th>
                <th>카테고리1</th>
                <th>카테고리2</th>
                <th>카테고리3</th>
                <th>카테고리4</th>
                <th>영상설명</th>
                <th>제작일자</th>
                <th>노출여부</th>
                <th>등록일자</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
<?php
	$where = "";

	if ($sDate != "")
		$where	.= " AND reg_date >= '".$sDate."' AND reg_date <= '".$eDate." 23:59:59'";

	if ($search_txt != "")
	{
		$where	.= " AND ".$search_type." like '%".$search_txt."%'";
	}
	$buyer_count_query = "SELECT count(*) FROM data_info WHERE  1 ".$where."";
	list($buyer_count) = @mysqli_fetch_array(mysqli_query($my_db, $buyer_count_query));
	// print_r($buyer_count);
	$PAGE_CLASS = new mnv_page($pg,$buyer_count,$page_size,$block_size);
	$BLOCK_LIST = $PAGE_CLASS->blockList();
	$PAGE_UNCOUNT = $PAGE_CLASS->page_uncount;
	$buyer_list_query = "SELECT * FROM data_info WHERE 1 ".$where." Order by idx DESC LIMIT $PAGE_CLASS->page_start, $page_size";
	$res = mysqli_query($my_db, $buyer_list_query);
//print_r($buyer_list_query);
	while ($buyer_data = @mysqli_fetch_array($res))
	{
		$buyer_info[] = $buyer_data;
	}

	foreach($buyer_info as $key => $val)
	{
		$data_category_arr = explode(",",$buyer_info[$key]['data_category']);
		$data_file_arr = explode(".",$buyer_info[$key]['data_file_name']);
?>
              <tr>
                <td><?php echo $PAGE_UNCOUNT-- ?></td>
                <td>
<?php
		if ($data_file_arr[1] == "mp4") {
?>					
					<video autoplay loop muted playsinline class="video-autoplay" style="width:100px;vertical-align: middle;margin-right: 3px;">
						<source src="../uploads/<?php echo $buyer_info[$key]['data_serial']?>/<?php echo $buyer_info[$key]['data_file_name']?>?v=<?php echo time()?>" type="video/mp4">
					</video>					
<?php
		}else{
?>			
					<img style="width:100px;height:100px;margin-right: 3px;" src="../uploads/<?php echo $buyer_info[$key]['data_serial']?>/<?php echo $buyer_info[$key]['data_file_name']?>?v=<?php echo time()?>" alt="<?php echo $buyer_info[$key]['data_title']?>">
<?php
		}
?>		
					<?php echo $buyer_info[$key]['data_title']?>
				</td>
                <td><?php echo $buyer_info[$key]['data_brand']?></td>
                <td><?php echo $data_category_arr[0]?></td>
                <td><?php echo $data_category_arr[1]?></td>
                <td><?php echo $data_category_arr[2]?></td>
                <td><?php echo $data_category_arr[3]?></td>
                <td style="text-align: center"><?php echo $buyer_info[$key]['data_desc']?></td>
                <td><?php echo $buyer_info[$key]['data_date']?></td>
                <td><?php echo $buyer_info[$key]['showYN']?></td>
                <td><?php echo $buyer_info[$key]['reg_date']?></td>
                <td>
					<a href="./input_data.php?view=u&idx=<?php echo $buyer_info[$key]['idx']?>"><button type="button">수정</button></a>
					<button type="button" onclick="del_data(<?php echo $buyer_info[$key]['idx']?>)">삭제</button>
				</td>
              </tr>
<?php
	}
?>
              <tr><td colspan="12"><div class="pageing"><?php echo $BLOCK_LIST?></div></td></tr>
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
	$('.date-input').on('click', function() {
		$(this).css({
			boxShadow: 'none'
		})
	})
	$('#excel_download_list').on('click', function() {
		if($('#sDate').val() == '' || $('#eDate').val() == '') {
			alert('추출할 날짜를 입력해주세요!');
			$('#sDate').css({
				boxShadow: '0px 0px 5px 1px rgba(255, 0, 0, 0.3)',
				border: 0
			})
			$('#eDate').css({
				boxShadow: '0px 0px 5px 1px rgba(255, 0, 0, 0.3)',
				border: 0
			})
			return false;
		}
		var $sDate = $('#sDate').val();
		var $eDate = $('#eDate').val();
		location.href="excel_download_list.php?sDate="+$sDate+"&eDate="+$eDate;
	});
	
	function del_data(idx) {
		if (confirm("정말 삭제하시겠습니까?")) {
			$.ajax({
				type   : "POST",
				async  : false,
				url    : "admin_exec.php",
				data:{
					"exec"				: "delete_data",
					"idx"				: idx
				},
				success: function(response){
					if(response == 'Y') {
						alert('데이터가 삭제 되었습니다.');
						location.reload();
					} else {
						alert('삭제 실패');
						// console.log(response);
						// location.reload();
					}
				}
			});
		}
	}


</script>
