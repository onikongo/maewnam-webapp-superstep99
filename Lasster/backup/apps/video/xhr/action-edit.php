<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	
	
		$data = array(
			'name' => $_REQUEST['txtname'],
			'data' => trim($_REQUEST['linkvideo']),
			'status' => 1,
			'#updated' => "NOW()"
		);
	if($dbc->HasRecord("video","id = '".$_REQUEST['txtVideoID']."'")){
		$dbc->Update("video", $data,"id=".$_REQUEST['txtVideoID']);
		
		echo json_encode(array(
			'success'=>true,
			'msg'=> "Passed"
		));
	}
	
	$dbc->Close();
?>