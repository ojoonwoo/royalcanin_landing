<?php
	include_once "../include/autoload.php";

	$mnv_f = new mnv_function();
	$my_db         = $mnv_f->Connect_MySQL();

	include "./head.php";

    $query  = "SELECT * FROM request_info WHERE 1 AND idx='".$_REQUEST['idx']."'";
    $res    = mysqli_query($my_db, $query);
    $data   = mysqli_fetch_array($res);
?>
<script src="../lib/jquery-ui.js"></script>
<script src="../lib/jQuery-File-Upload/js/vendor/jquery.ui.widget.js"></script>
<script src="../lib/jQuery-File-Upload/js/jquery.iframe-transport.js"></script>
<script src="../lib/jQuery-File-Upload/js/jquery.fileupload.js"></script>
<!-- <script src="./lib/jquery.fileDownload-master/src/Scripts/jquery.fileDownload.js"></script> -->

<!-- 합쳐지고 최소화된 최신 CSS -->
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css"> -->
<!-- 부가적인 테마 -->
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css"> -->
<style>
    .ui-state-default, .ui-widget-content .ui-state-default {
        border : 1px solid #c5c5c5;
    }
</style>
<div id="page-wrapper">
  <div class="container-fluid">
  <!-- Page Heading -->
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">[CONTACT] <?php echo $data['request_name']?>님의 작성 내용입니다.</h1>
      </div>
    </div>
    <!-- /.row -->
    <div class="row">
      <div class="col-lg-12">
        <div class="table-responsive">
    <table class="table table-bordered" style="width:80%">
        <tr>
            <td>요청자 이름</td>
            <td><?php echo $data['request_name']?></td>
        </tr>
        <tr>
            <td>요청자 회사명</td>
            <td><?php echo $data['request_company']?></td>
        </tr>
        <tr>
            <td>요청자 직위</td>
            <td><?php echo $data['request_position']?></td>
        </tr>
        <tr>
            <td>요청자 이메일</td>
            <td><?php echo $data['request_email']?></td>
        </tr>
        <tr>
            <td>요청자 전화번호</td>
            <td><?php echo $data['request_phone']?></td>
        </tr>
        <tr>
            <td>상세내용</td>
            <td><?php echo $data['request_text']?></td>
        </tr>
        <tr>
            <td>요청일자</td>
            <td><?php echo $data['request_date']?></td>
        </tr>
        <tr>
            <td colspan="2">
                <a href="request_list.php"><button type="button" class="btn btn-success">확인</button></a>
            </td>
        </tr>
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