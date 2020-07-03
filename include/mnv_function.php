<?php
/*
*
*	php function
*
*/
class mnv_function extends mnv_dbi
{
	var $winner_flag;

	var $script; //-- 페이지관련 자바스크립트

	
	public function InsertTrackingInfo($gubun)
	{
		global $my_db;
		$log_query	= "INSERT INTO tracking_info(tracking_media, tracking_refferer, tracking_agent, tracking_ipaddr, tracking_date, tracking_gubun) values('".$_SESSION['ss_media']."','".$_SERVER['HTTP_REFERER']."','".$_SERVER['HTTP_USER_AGENT']."','".$_SERVER['REMOTE_ADDR']."',now(),'".$gubun."')";
		$q_result 	= mysqli_query($my_db, $log_query);

		return $log_query;
	}

	public function MobileCheck()
	{
//		$mobile_agent = array("iPhone","iPod","iPad","Android","Blackberry","SymbianOS|SCH-M\d+","Opera Mini", "Windows ce", "Nokia", "sony" );
		$mobile_agent = array("iPhone","iPod","Android","Blackberry","SymbianOS|SCH-M\d+","Opera Mini", "Windows ce", "Nokia", "sony" );
		$check_mobile = "PC";

		for($i=0; $i<sizeof($mobile_agent); $i++){
			if(stripos( $_SERVER['HTTP_USER_AGENT'], $mobile_agent[$i] )){
				$check_mobile = "MOBILE";
				break;
			}
		}
		return $check_mobile;
	}

	public function IPhoneCheck()
	{
		if(stripos( $_SERVER['HTTP_USER_AGENT'], "iPhone" ))
			$iPhone	= "Y";
		else
			$iPhone	= "N";
		return $iPhone;
	}
	public function BrowserCheck()
	{
		if(stripos( $_SERVER['HTTP_USER_AGENT'], "MSIE 8" ) || stripos( $_SERVER['HTTP_USER_AGENT'], "MSIE 9" ))
			$OB	    = "Y";
		else
			$OB	= "N";
		return $OB;
	}
	public function IECheck()
	{
		if(stripos( $_SERVER['HTTP_USER_AGENT'], "MSIE" ) || stripos( $_SERVER['HTTP_USER_AGENT'], "Trident" ))
			$IE	    = "Y";
		else
			$IE	= "N";
		return $IE;
	}
	public function SafariCheck()
	{
		if(stripos( $_SERVER['HTTP_USER_AGENT'], "MSIE" ) || stripos( $_SERVER['HTTP_USER_AGENT'], "Chrome" ) || stripos( $_SERVER['HTTP_USER_AGENT'], "Trident" ))
			$Safari	    = "N";
		else
			$Safari	= "Y";
		return $Safari;
	}

	public function SaveMedia()
	{
		$_SESSION['ss_media']		= $_REQUEST['media'];
		// $_SESSION['ss_utm_medium']		= $_REQUEST['utm_medium'];
		// $_SESSION['ss_utm_source']		= $_REQUEST['utm_source'];
		// $_SESSION['ss_utm_campaign']	= $_REQUEST['utm_campaign'];
		// $_SESSION['ss_utm_content']		= $_REQUEST['utm_content'];
	}

	public function siteURL() {
		$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || 
					 $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
		$domainName = $_SERVER['HTTP_HOST'];
		$uri = $_SERVER['REQUEST_URI'];
		return $protocol.$domainName.$uri;
	}
	public function create_serial()
	{
		global $my_db;

		// $i = 0;
		// while($i < 200000) {
		// 	$serial = sprintf('%12d',rand(100000000000,999999999999));
		// 	$query		= "INSERT INTO serial_info(serial_code) values('".$serial."')";
		// 	$result 	= mysqli_query($my_db, $query);
		// 	$i++;
		// }

		$query		= "SELECT serial_code FROM serial_info WHERE 1 AND useYN='N' ORDER BY idx ASC LIMIT 1";
		$result 	= mysqli_query($my_db, $query);
		$data		= mysqli_fetch_array($result);

		$query		= "UPDATE serial_info SET useYN='Y', use_date='".date('Y-m-d H:i:s')."' WHERE 1 AND serial_code='".$data['serial_code']."'";
		$result 	= mysqli_query($my_db, $query);

		return $data['serial_code'];
	}

}
