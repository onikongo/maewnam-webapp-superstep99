<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../include/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$sale_team = $dbc->GetRecord("sales_team","*",'id='.$_REQUEST['id']);
	$dbc->Update("sales_team",array("#icon" => "NULL"),'id='.$_REQUEST['id']);
	unlink("../../../".$sale_team['icon']);
	
	echo json_encode(array(
		'success'=>true
	));

	$dbc->Close();
?>