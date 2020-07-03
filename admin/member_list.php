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
				<h1 class="page-header">이벤트 참여자 목록 / 관리 화면</h1>
			</div>
		</div>
		<!-- /.row -->
		<div class="row">
			<div class="col-lg-12">
				<div class="table-responsive">
					<ol class="breadcrumb">
						<form name="frm_execute" method="POST" onsubmit="return checkfrm()">
							<input type="hidden" name="pg" value="<?=$pg?>">
							<select name="search_type">
								<option value="mb_name" <?php if($search_type == "mb_name"){?>selected<?php }?>>이름</option>
								<option value="mb_phone" <?php if($search_type == "mb_phone"){?>selected<?php }?>>전화번호</option>
							</select>
							<input type="text" name="search_txt" value="<?php echo $search_txt?>">
							<input type="text" id="sDate" class="date-input" name="sDate" value="<?=$sDate?>"> - <input type="text" id="eDate" class="date-input" name="eDate" value="<?=$eDate?>">
							<input type="submit" value="검색">
							<a href="javascript:void(0)" id="excel_download_list">
								<span>엑셀 다운로드</span>
							</a> 
							<li align="right";>
								<?
	$member = "SELECT count(idx) FROM member_info_9 WHERE 1";
								   $res3 = mysqli_query($my_db, $member);
								   list($total_count)	= @mysqli_fetch_array($res3);
								   $uniqueMember = "SELECT count(*) FROM member_info_9 WHERE 1 GROUP BY mb_phone";
								   $resUnique = mysqli_query($my_db, $uniqueMember);
								   $unique_total_count	= mysqli_num_rows($resUnique);
								   echo  "전체 참여자수 : $total_count / 유니크 : $unique_total_count";
								?>
							</li>
						</form>
					</ol>
					<table id="entry_list" class="table table-hover">
						<thead>
							<tr>
								<th>순번</th>
								<th>이름</th>
								<th>전화번호</th>
								<th>타입</th>
								<th>사이즈</th>
								<th>주소</th>
								<th>메시지내용</th>
								<th>유입구분</th>
								<th>유입매체</th>
								<th>참여일자</th>
								<th>노출여부</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$where = "";

							if ($sDate != "")
								$where	.= " AND mb_regdate >= '".$sDate."' AND mb_regdate <= '".$eDate." 23:59:59'";

							if ($search_txt != "")
							{
								$where	.= " AND ".$search_type." like '%".$search_txt."%'";
							}
							$buyer_count_query = "SELECT count(*) FROM member_info_9 WHERE  1 ".$where."";
							list($buyer_count) = @mysqli_fetch_array(mysqli_query($my_db, $buyer_count_query));
							// print_r($buyer_count);
							$PAGE_CLASS = new mnv_page($pg,$buyer_count,$page_size,$block_size);
							$BLOCK_LIST = $PAGE_CLASS->blockList();
							$PAGE_UNCOUNT = $PAGE_CLASS->page_uncount;
							$buyer_list_query = "SELECT * FROM member_info_9 WHERE 1 ".$where." Order by idx DESC LIMIT $PAGE_CLASS->page_start, $page_size";
							$res = mysqli_query($my_db, $buyer_list_query);
							//print_r($buyer_list_query);
							while ($buyer_data = @mysqli_fetch_array($res))
							{
								$buyer_info[] = $buyer_data;
							}

							foreach($buyer_info as $key => $val)
							{
								$address = $buyer_info[$key]['mb_addr1'].' '.$buyer_info[$key]['mb_addr2'];
							?>
							<tr>
								<td><?php echo $PAGE_UNCOUNT-- ?></td>
								<td><?php echo $buyer_info[$key]['mb_name']?></td>
								<td><?php echo $buyer_info[$key]['mb_phone']?></td>
								<td><?php echo $buyer_info[$key]['mb_type']?></td>
								<td><?php echo $buyer_info[$key]['mb_size']?></td>
								<td><?php echo $address?></td>
								<td style="text-align: center"><?php echo $buyer_info[$key]['mb_message']?></td>
								<td><?php echo $buyer_info[$key]['mb_gubun']?></td>
								<td><?php echo $buyer_info[$key]['mb_media']?></td>
								<td><?php echo $buyer_info[$key]['mb_regdate']?></td>
								<td>
									<select name="display-manage" data-idx="<? echo $buyer_info[$key]['idx']?>">
										<option value="Y" <?php if($buyer_info[$key]['mb_show'] == "Y") echo 'selected' ?>>Y</option>
										<option value="N" <?php if($buyer_info[$key]['mb_show'] == "N") echo 'selected' ?>>N</option>
									</select>
								</td>
							</tr>
							<?php
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


	$("select[name='display-manage']").on('change', function() {
		var $this = $(this);
		var changedVal = $this.val();
		var idx = $this.data('idx');
		
		if(changedVal) {
			$.ajax({
				type:"POST",
				data:{
					"exec"				: "image_display_edit",
					"mb_idx"			: idx,
					"mb_show"			: changedVal
				},
				url: "./admin_exec.php",
				success: function(response){
					console.log(response);
					if (response == "Y")
					{
						alert("변경완료!");
					}else{
						alert("변경 실패... 개발팀에 문의주세요");
					}
				}
			});
		}
	});

</script>
