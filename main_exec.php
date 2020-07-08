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
	case "insert_checked_data" :
		$mnv_f          = new mnv_function();
		$my_db          = $mnv_f->Connect_MySQL();
		$gubun          = $mnv_f->MobileCheck();

		$check_data		= $_REQUEST['check-data'];

		$query 		= "INSERT INTO check_info(check_ipaddr, check_media, check_gubun, check_data, check_date) values('".$_SERVER['REMOTE_ADDR']."','".$_SESSION['ss_media']."','".$gubun."','".$check_data."','".date("Y-m-d H:i:s")."')";
		$result 	= mysqli_query($my_db, $query);

		if ($result)
			$flag ="Y"; 
		else
			$flag ="N";

		echo $query;

	break;
}

?>
