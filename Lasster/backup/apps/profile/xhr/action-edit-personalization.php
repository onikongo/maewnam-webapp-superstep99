<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$user = $dbc->GetRecord("users","setting","id=".$_REQUEST['txtID']);
	$setting = json_decode($user['setting'],true);
	
	$setting['personalization'] = base64_encode($_REQUEST['txtComment']);
	
		$data = array(
			'setting' => json_encode($setting),
			'#updated' => 'NOW()'
		);
		$dbc->Update("users",$data,"id=".$_REQUEST['txtID']);
		
		echo json_encode(array(
				'success'=>true,
				'msg'=> $dbc->GetID()
		));
		
	
	
	$dbc->Close();
?>