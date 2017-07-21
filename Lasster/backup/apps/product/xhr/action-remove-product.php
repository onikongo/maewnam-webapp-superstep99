<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	foreach($_REQUEST['items'] as $item){
		$dbc->Delete("products","id=".$item);
	/* 	$del_dis = $dbc->Delete("discount","product = ".$item);
		$del_reward = $dbc->Delete("reward","product = ".$item);
		$del_metatag = $dbc->Delete("metatag","product = ".$item); */
	}
	
	$dbc->Close();
?>