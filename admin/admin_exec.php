<?php
	// 설정파일
	include_once "../include/autoload.php";

	switch ($_REQUEST['exec'])
	{
		case "login" :
			$mb_id = $_REQUEST['mb_id'];
			$mb_pw = $_REQUEST['mb_pw'];

			//$query = "SELECT * FROM ".$_gl['game_info_table']." WHERE game_name='".$mb_id."' AND game_phone='".$mb_pw."'";
			//$result 		= mysqli_query($my_db, $query);
			//$member_info	= mysqli_fetch_array($result);
			// if ($mb_id == "admin" && $mb_pw == "miniver_2018")
			if ($mb_id == "admin" && $mb_pw == "alslqj~1")
			{
				// 회원아이디 세션 생성
				$_SESSION['ss_mb_name'] = "admin";
				echo "<script>location.href='./entry_list.php';</script>";
			}else{
				echo "<script>alert('로그인에 실패하였습니다.');</script>";
				echo "<script>history.back();</script>";
			}
		break;

		case "logout" :
			session_destroy();
			echo "<script>location.href='./index.php';</script>";
		break;

		case "send_sms" :
			$phone			= $_REQUEST['phone'];
			$phone_arr		= explode("-",$phone);
			$cel				= $phone_arr[0].$phone_arr[1].$phone_arr[2];

			/*
			$httpmethod = "POST";
			$url = "http://api.openapi.io/ppurio_test/1/message_test/lms/minivertising";
			$clientKey = "MS0xMzY1NjY2MTAyNDk0LTA2MWE4ZDgyLTZhZmMtNGU5OS05YThkLTgyNmFmYzVlOTkzZQ==";
			$contentType = "Content-Type: application/x-www-form-urlencoded";
			*/
			$httpmethod = "POST";
			$url = "http://api.openapi.io/ppurio/1/message/lms/minivertising";
			$clientKey = "MTAyMC0xMzg3MzUwNzE3NTQ3LWNlMTU4OTRiLTc4MGItNDQ4MS05NTg5LTRiNzgwYjM0ODEyYw==";
			$contentType = "Content-Type: application/x-www-form-urlencoded";

			$response = sendRequest($httpmethod, $url, $parameters, $clientKey, $contentType, $phone);

			//echo("<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />");
			$json_data = json_decode($response, true);

			//print_r($json_data);
			/*
			받아온 결과값을 DB에 저장 및 Variation
			*/
			$query = "INSERT INTO ".$_gl['sms_info_table']."(send_phone, send_status, cmid, send_regdate) values('".$phone."','".$json_data['result_code']."','".$json_data['cmid']."','".date("Y-m-d H:i:s")."')";
			$result 		= mysqli_query($my_db, $query);

			$query2 = "UPDATE ".$_gl['member_info_table']." SET mb_lms='Y' WHERE mb_phone='".$phone."'";
			$result2 		= mysqli_query($my_db, $query2);


			$flag = "N";
			if ($result)
				echo $flag = "Y";
			else
				echo $flag = "N";
		break;

		case "all_send_sms" :
			$query = "SELECT mb_phone, mb_serial FROM activator_info_re";
			$result 		= mysqli_query($my_db, $query);

			$httpmethod = "POST";
			$url = "http://api.openapi.io/ppurio/1/message/lms/minivertising";
			$clientKey = "MTAyMC0xMzg3MzUwNzE3NTQ3LWNlMTU4OTRiLTc4MGItNDQ4MS05NTg5LTRiNzgwYjM0ODEyYw==";
			$contentType = "Content-Type: application/x-www-form-urlencoded";

			while ($data = @mysqli_fetch_array($result))
			{
				$phone			= $data['mb_phone'];
				$serial			= $data['mb_serial'];
				$s_url		= "http://mydream.compassion.or.kr/MOBILE/current_state.php?used=".$serial."_act";

				$response = sendRequest_re($httpmethod, $url, $clientKey, $contentType, $phone, $s_url);

				echo("<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />");
				$json_data = json_decode($response, true);

				//print_r($json_data);
				/*
				받아온 결과값을 DB에 저장 및 Variation
				*/
				$query3 = "INSERT INTO ".$_gl['sms_info_table']."(send_phone, send_status, cmid, send_regdate) values('".$phone."','".$json_data['result_code']."','".$json_data['cmid']."','".date("Y-m-d H:i:s")."')";
				$result3 		= mysqli_query($my_db, $query3);
			}

			$flag = "N";
			if ($result)
				echo $flag = "Y";
			else
				echo $flag = "N";
		break;

		case "all_use" :
			$query = "SELECT send_phone FROM ".$_gl['sms_info_table']."";
			$result 		= mysqli_query($my_db, $query);

			while ($data = @mysqli_fetch_array($result))
			{
				$phone			= $data['send_phone'];
				$query2 = "UPDATE ".$_gl['member_info_table']." SET mb_use='Y' WHERE mb_phone='".$phone."'";
				$result2 		= mysqli_query($my_db, $query2);
			}

			$flag = "N";
			if ($result)
				echo $flag = "Y";
			else
				echo $flag = "N";
		break;

		case "view_comment" :
			$idx		= $_REQUEST['idx'];
			$viewYN	= $_REQUEST['viewYN'];

			if ($viewYN == "Y")
			{
				$query	= "UPDATE ".$_gl['comment_info_table']." SET viewYN='N' WHERE idx='".$idx."'";
				$result		= mysqli_query($my_db, $query);
			}else{
				$query	= "UPDATE ".$_gl['comment_info_table']." SET viewYN='Y' WHERE idx='".$idx."'";
				$result		= mysqli_query($my_db, $query);
			}

			$flag = "N";
			if ($result)
				$flag = "Y";
			else
				$flag = "N";

			echo $flag;
		break;

		case "change_family_show" :
			$idx			= $_REQUEST['idx'];
			$family_show	= $_REQUEST['family_show'];

			$query	= "UPDATE ".$_gl['family_info_table']." SET family_show='".$family_show."' WHERE idx='".$idx."'";
			$result		= mysqli_query($my_db, $query);

			if ($result)
				$flag = "Y";
			else
				$flag = "N";

			echo $flag;
		break;
			
		case "image_display_edit" :
			$mnv_f          = new mnv_function();
			$my_db          = $mnv_f->Connect_MySQL();
			
			$idx			= $_REQUEST['mb_idx'];
			$show_val		= $_REQUEST['mb_show'];
				
			$query	= "UPDATE member_info_9 SET mb_show='".$show_val."' WHERE idx='".$idx."'";
			$result		= mysqli_query($my_db, $query);
			
			if($result)
				$flag = "Y";
			else 
				$flag = "N";
			
			echo $flag;
		break;
		case "delete_data" :
			$mnv_f          = new mnv_function();
			$my_db          = $mnv_f->Connect_MySQL();
			
			$idx			= $_REQUEST['idx'];
				
			$data_sql = "SELECT data_serial FROM data_info WHERE 1 AND idx='".$idx."'";
			$res    = mysqli_query($my_db, $data_sql);
			$data   = mysqli_fetch_array($res);
			
			$query	= "DELETE FROM data_info WHERE idx='".$idx."'";
			$result		= mysqli_query($my_db, $query);
			
			$serial = $data['data_serial'];
			$dir = "../uploads/".$serial;
			// 디렉토리 삭제해야함 - 준우
			$dir_del_flag = $mnv_f->rmdir_all($dir);


			if($result)
				$flag = "Y";
			else 
				$flag = "N";
			
			echo $flag;
		break;
		case "update_order_data" :
			$mnv_f          = new mnv_function();
			$my_db          = $mnv_f->Connect_MySQL();
			
			$id_array 		= $_REQUEST['id_array'];
			$order_array 	= $_REQUEST['order_array'];
			$data_category 	= $_REQUEST['data_category'];
			
			if ($data_category == "OVERVIEW")
				$common_query = "UPDATE data_info SET data_cate_order_all = CASE ";
			else if ($data_category == "SHORT VIDEO")
				$common_query = "UPDATE data_info SET data_cate_order1 = CASE ";
			else if ($data_category == "IMAGE")
				$common_query = "UPDATE data_info SET data_cate_order2 = CASE ";
			else if ($data_category == "FOOD")
				$common_query = "UPDATE data_info SET data_cate_order3 = CASE ";
			else if ($data_category == "COSMETICS")
				$common_query = "UPDATE data_info SET data_cate_order4 = CASE ";
			
			$query_str = "";
			for($i=0; $i<count($id_array); $i++) {
				$query_str .= "WHEN idx = $id_array[$i] THEN $order_array[$i] ";
			}
			$query = $common_query.$query_str."END WHERE idx IN(".implode(',',$id_array).")";
			
			$result = mysqli_query($my_db, $query);
			
			if($result)
				$flag = "Y";
			else 
				$flag = "N";
			
			echo $flag;
		break;
	}
?>
