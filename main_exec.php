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

		$query 		= "INSERT INTO member_info(mb_ipaddr, mb_gubun, mb_cat_name, mb_cat_birth, mb_visit_hospital, mb_serial) values('".$_SERVER['REMOTE_ADDR']."','".$gubun."','".$mb_cat_name."','".$mb_cat_birth."','".$mb_visit_hospital."','".$mb_serial."')";
		$result 	= mysqli_query($my_db, $query);

		if ($result)
			$flag ="Y"; 
		else
			$flag ="N";

		echo $flag;

	break;
	case "insert_member_data" :
		$mnv_f          = new mnv_function();
		$my_db          = $mnv_f->Connect_MySQL();
		$gubun          = $mnv_f->MobileCheck();

		$sudoYN			= $_REQUEST['sudoYN'];
		$hospiName		= $_REQUEST['hospiName'];
		$hospiAddr		= $_REQUEST['hospiAddr'];
		$userName		= $_REQUEST['userName'];
		$phoneNumber	= $_REQUEST['phoneNumber'];
		$mb_serial		= $_REQUEST['serial'];

		$query 		= "INSERT INTO member_info(mb_ipaddr, mb_gubun, mb_cat_name, mb_cat_birth, mb_visit_hospital, mb_serial) values('".$_SERVER['REMOTE_ADDR']."','".$gubun."','".$mb_cat_name."','".$mb_cat_birth."','".$mb_visit_hospital."','".$mb_serial."')";
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
		$mb_serial		= $_REQUEST['mb_serial'];

		$query 		= "UPDATE member_info SET mb_check='".$mb_check."' WHERE mb_serial='".$mb_serial."'";
		$result 	= mysqli_query($my_db, $query);

		if ($result)
			$flag ="Y"; 
		else
			$flag ="N";

		echo $flag;
	break;
	case "insert_member_date" :
		// $mnv_f          = new mnv_function();
		// $my_db          = $mnv_f->Connect_MySQL();
		// $gubun          = $mnv_f->MobileCheck();
	
		// $mb_serial		= $_REQUEST['mb_serial'];

		// $query 		= "UPDATE member_info SET mb_check='".$mb_check."' WHERE mb_serial='".$mb_serial."'";
		// $result 	= mysqli_query($my_db, $query);
	
		// if ($result)
		// 	$flag ="Y"; 
		// else
		// 	$flag ="N";
	
		// echo $flag;
	break;
}

?>
