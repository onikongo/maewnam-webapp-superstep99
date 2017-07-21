<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	if($dbc->HasRecord("video","status='100'"))
	{
		$old = $dbc->GetRecord("video","*","status='100'");
		
		$data_old = array(
			'#status' => 0
		);
		$up_old = $dbc->Update("video",$data_old,"id=".$old['id']);
		
		$data_new = array(
			'#status' => 100
		);
		$up_new = $dbc->Update("video",$data_new,"id=".$_REQUEST['id']);
		echo json_encode(true);
	}
	else
	{
		echo json_encode(false);
	}
	
	
	$dbc->Close();
?>