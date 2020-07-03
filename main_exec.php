<?php
include_once "./include/autoload.php";

switch ($_REQUEST['exec'])
{
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
