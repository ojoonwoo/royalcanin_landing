<?php
//session_start();
// if (isset($_SESSION['ss_mb_name']) == false)
// 	echo "<script>location.href='index.php'</script>";

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>현대해상 - 어서와 마음봇!</title>
	<!-- jQuery Version 1.11.0 -->
	<script src="js/jquery-1.11.0.js"></script>
	<script src="js/jquery-ui.min.js"></script>

	<!-- Bootstrap Core JavaScript -->
	<script src="js/bootstrap.min.js"></script>

    <link href="css/jquery-ui.min.css" rel="stylesheet">
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
      #excelDown {
        margin-left: 30px;
        display: inline-block;
        padding: 8px 5px;
        background: lightgrey;
        font-size: 12px;
        color: #444444;
      }
      #excel_download_list {
        display: block;
        position: absolute;
        top: 5px;
        right: 23px;
        background: lightgrey;
        color: #444444;
        padding: 3px 6px 2px;
        font-size: 13px;
        border-radius: 4px;
      }
    </style>
  </head>
  <body>
    <div id="wrapper">
      <!-- Navigation -->
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="entry_list.php">현대해상 - 어서와 마음봇!</a>
        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['ss_mb_name']?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li>
                <a  href="admin_exec.php?exec=logout"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
              </li>
            </ul>
          </li>
        </ul>
          <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
          <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
              <li class="active">
                <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Daily Count<i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="demo" class="collapse">
                  <li>
                    <a href="daily_tracking_count.php">일자별 사이트 유입자 수</a>
                  </li>
                  <li>
                    <a href="daily_media_count.php">마음봇 받기 참여자 수</a>
                  </li>
                  <li>
                    <a href="daily_media_count2.php">마음봇 사진 업로드 참여자 수</a>
                  </li>
                  <!-- <li>
                    <a href="daily_outlink_count.php">일자별 아웃링크 클릭 수</a>
                  </li> -->
                  <!--<li>
                    <a href="daily_exp_count.php">사이트(체험팩) 레벨별 참여자 수</a>
                  </li>-->
                  <!-- <li>
                    <a href="daily_share_count.php">일자별 SNS 공유 버튼 클릭 수</a>
                  </li> -->
                  <li>
                    <a href="daily_click_count.php">일자별 각 버튼 클릭 수</a>
                  </li>
                </ul>
              </li>
              <li>
                <a href="entry_list.php"><i class="fa fa-fw fa-table"></i> 마음봇 받기 참여자 목록</a>
              </li>
              <li>
                <a href="entry_list2.php"><i class="fa fa-fw fa-table"></i> 마음봇 사진 업로드 참여자 목록</a>
              </li>
              <!--<li>
                <a href="entry_list2.php"><i class="fa fa-fw fa-table"></i> 이름짓기 투표 참여자 목록</a>
              </li>
              <li>
                <a href="view_list.php"><i class="fa fa-fw fa-table"></i> 투표 다득점순(상위 100) 목록</a>
              </li>
              <li>
                <a href="entry_list3.php"><i class="fa fa-fw fa-table"></i> 변 인증 이벤트 참여자 목록</a>
              </li>
              <li>
                <a href="exp_cancel_list.php"><i class="fa fa-fw fa-table"></i> 체험팩 이벤트 취소자 목록</a>
              </li>
              <li>
                <a href="winner_count.php"><i class="fa fa-fw fa-table"></i> 경품별 당첨자 수</a>
              </li>-->
            </ul>
          </div>
        <!-- /.navbar-collapse -->
        </nav>
