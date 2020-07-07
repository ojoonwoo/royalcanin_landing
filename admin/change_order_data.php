<?php
	include_once "../include/autoload.php";

	$mnv_f = new mnv_function();
	$my_db         = $mnv_f->Connect_MySQL();

	include "./head.php";

	$search_category = $_REQUEST['cate'];

?>
<link rel="stylesheet" href="../js/jquery-ui-1.12.1/jquery-ui.min.css">
<script src="../js/jquery-ui-1.12.1/jquery-ui.min.js"></script>
<div id="page-wrapper">
  <div class="container-fluid">
  <!-- Page Heading -->
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">데이터 순서 변경</h1>
      </div>
    </div>
    <!-- /.row -->
    <div class="row">
      <div class="col-lg-12">
        <div class="table-responsive">
          <ol class="breadcrumb">
            <form name="frm_execute" method="POST">
              <input type="hidden" name="pg" value="<?=$pg?>">
			  <li align="left";>
				<select name="search_category" id="search_category">
					<option value="OVERVIEW" <?php if($search_category == "OVERVIEW"){?>selected<?php }?>>OVERVIEW</option>
					<option value="SHORT VIDEO" <?php if($search_category == "SHORT VIDEO"){?>selected<?php }?>>SHORT VIDEO</option>
					<option value="IMAGE" <?php if($search_category == "IMAGE"){?>selected<?php }?>>IMAGE</option>
					<option value="FOOD" <?php if($search_category == "FOOD"){?>selected<?php }?>>FOOD &amp; DRINKS</option>
					<option value="COSMETICS" <?php if($search_category == "COSMETICS"){?>selected<?php }?>>COSMETICS</option>
				</select>
			  </li>
			  <li align="right";>
				<button type="button" id="confirm_order">변경된 순서 적용</button>
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
              </tr>
            </thead>
            <tbody id="order_area">
<?php
	$where = "";

	if ($sDate != "")
		$where	.= " AND reg_date >= '".$sDate."' AND reg_date <= '".$eDate." 23:59:59'";

	if ($search_category != "" && $search_category != "OVERVIEW")
	{
		$where	.= " AND data_category like '%".$search_category."%'";
	}
	// $buyer_count_query = "SELECT count(*) FROM data_info WHERE  1 ".$where."";
	// list($buyer_count) = @mysqli_fetch_array(mysqli_query($my_db, $buyer_count_query));
	// $PAGE_CLASS = new mnv_page($pg,$buyer_count,$page_size,$block_size);
	// $PAGE_UNCOUNT = $PAGE_CLASS->page_uncount;
	if ($search_category == "SHORT VIDEO")
		$buyer_list_query = "SELECT *, data_cate_order1 as cate_order FROM data_info WHERE 1 ".$where." Order by data_cate_order1 ASC";
	else if ($search_category == "IMAGE")
		$buyer_list_query = "SELECT *, data_cate_order2 as cate_order FROM data_info WHERE 1 ".$where." Order by data_cate_order2 ASC";
	else if ($search_category == "FOOD")
		$buyer_list_query = "SELECT *, data_cate_order3 as cate_order FROM data_info WHERE 1 ".$where." Order by data_cate_order3 ASC";
	else if ($search_category == "COSMETICS")
		$buyer_list_query = "SELECT *, data_cate_order4 as cate_order FROM data_info WHERE 1 ".$where." Order by data_cate_order4 ASC";
	else
		$buyer_list_query = "SELECT *, data_cate_order_all as cate_order FROM data_info WHERE 1 ".$where." Order by data_cate_order_all ASC";

	$res = mysqli_query($my_db, $buyer_list_query);
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
				<input type="hidden" name="cate_idx[]" value="<?php echo $buyer_info[$key]['idx']; ?>" >
				<input type="hidden" name="cate_order[]" id="cate_order_<?php echo $key; ?>" class="cate_order_value" readonly value="<?php echo $buyer_info[$key]['cate_order']; ?>" >
                <td><?php echo $buyer_info[$key]['cate_order'] ?></td>
                <td>
<?php
		if ($data_file_arr[1] == "mp4") {
?>					
					<video autoplay loop muted playsinline class="video-autoplay" style="width:20px">
						<source src="../uploads/<?php echo $buyer_info[$key]['data_serial']?>/<?php echo $buyer_info[$key]['data_file_name']?>?v=<?php echo time()?>" type="video/mp4">
					</video>					
<?php
		}else{
?>			
					<img style="width:20px;height:20px" src="../uploads/<?php echo $buyer_info[$key]['data_serial']?>/<?php echo $buyer_info[$key]['data_file_name']?>?v=<?php echo time()?>" alt="<?php echo $buyer_info[$key]['data_title']?>">
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
	
	// 수정시작, sortable on, 버튼명 바꿔주기
	$( "#order_area" ).sortable({
		update: function( event, ui ) {
			$('#order_area tr').each(function(idx, el) {
				var cate_idx = idx + 1;
				$(el).find('.cate_order_value').attr('value', cate_idx);


			});
		}
	});
	$( "#order_area" ).disableSelection();

	$("#search_category").on("change", function(){
		location.href = "change_order_data.php?cate=" + $(this).val();
	});

	$("#confirm_order").on("click", function(){
		if(confirm("데이터 노출순서를 재정렬하시겠습니까?")) {
			// ajax update call
			var idArray = [];
			var orderArray = [];
			$("input[name='cate_idx[]']").each(function(idx, el) {
				idArray.push($(this).val());
				orderArray.push($(this).siblings("input[name^='cate_order']").val());
			});

			$.ajax({
				type   : "POST",
				async  : false,
				url    : "admin_exec.php",
				data:{
					"exec"				   : "update_order_data",
					"id_array"             : idArray,
					"order_array"          : orderArray,
					"data_category"        : $("#search_category").val()
				},
				success: function(response){
					// console.log(response);
					if(response == 'Y') {
						alert('데이터가 정렬되었습니다.');
					} else {
						alert('개발팀에 문의해 주세요.');
					}
					location.reload();
				}
			});
		}		
	});
</script>
