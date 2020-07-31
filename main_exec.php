<?php
include_once "./include/autoload.php";

switch ($_REQUEST['exec'])
{
	case "insert_cat_data" :
		$mnv_f          = new mnv_function();
		$my_db          = $mnv_f->Connect_MySQL();
		$gubun          = $mnv_f->MobileCheck();

		$mb_cat_name		= $_REQUEST['cat-name'];
		$mb_cat_birth		= $_REQUEST['cat-age'];
		$mb_visit_hospital	= $_REQUEST['cat-visit'];
		$mb_serial			= $_REQUEST['cat-serial'];

		$query 		= "INSERT INTO member_info(mb_ipaddr, mb_gubun, mb_cat_name, mb_cat_birth, mb_visit_hospital, mb_serial, mb_mms, mb_checkdate) values('".$_SERVER['REMOTE_ADDR']."','".$gubun."','".$mb_cat_name."','".$mb_cat_birth."','".$mb_visit_hospital."','".$mb_serial."','".$_SESSION['ss_MMS']."','".date('Y-m-d H:i:s')."')";
		$result 	= mysqli_query($my_db, $query);

		if ($result)
			$flag ="Y"; 
		else
			$flag ="N";

		echo $flag;

	break;
	case "update_member_data" :
		$mnv_f          = new mnv_function();
		$my_db          = $mnv_f->Connect_MySQL();
		$gubun          = $mnv_f->MobileCheck();

		$sudoYN			= $_REQUEST['sudoYN'];
		$hospiName		= $_REQUEST['hospiName'];
		$hospiAddr		= $_REQUEST['hospiAddr'];
		$hospiCode		= $_REQUEST['hospiCode'];
		$userName		= $_REQUEST['userName'];
		$phoneNumber	= $_REQUEST['phoneNumber'];
		$mb_serial		= $_REQUEST['serial'];

		$query 		= "UPDATE member_info SET mb_sudo='".$sudoYN."', mb_select_hospital_code='".$hospiCode."', mb_select_hospital_name='".$hospiName."', mb_select_hospital_addr='".$hospiAddr."', mb_name='".$userName."', mb_phone='".$phoneNumber."', mb_regdate='".date('Y-m-d H:i:s')."' WHERE mb_serial='".$mb_serial."' ";
		$result 	= mysqli_query($my_db, $query);

		if ($result)
			$flag ="Y"; 
		else
			$flag ="N";

		echo $flag;

	break;
	case "insert_check_data" :
		$mnv_f          = new mnv_function();
		$my_db          = $mnv_f->Connect_MySQL();
		$gubun          = $mnv_f->MobileCheck();

		$mb_check		= $_REQUEST['mb_check'];
		$mb_urinary		= $_REQUEST['mb_urinary'];
		$mb_result		= $_REQUEST['mb_result'];
		$mb_serial		= $_REQUEST['mb_serial'];

		$query 		= "UPDATE member_info SET mb_check='".$mb_check."', mb_urinary='".$mb_urinary."', mb_result='".$mb_result."' WHERE mb_serial='".$mb_serial."'";
		$result 	= mysqli_query($my_db, $query);

		if ($result)
			$flag ="Y"; 
		else
			$flag ="N";

		echo $flag;
	break;
}

?>
