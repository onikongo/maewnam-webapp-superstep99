<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$id = $_REQUEST['id'];
	if($dbc->HasRecord("category","id='".$id."'and status=1"))
	{
		$dbc->Update("category",array('#status' => '0'),"id='".$id."'");
	}
	else
	{
		$dbc->Update("category",array('#status' => '1'),"id='".$id."'");
	}
	
	echo json_encode(true);
	
	$dbc->Close();
?>