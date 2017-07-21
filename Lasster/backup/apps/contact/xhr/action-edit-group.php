<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	if($dbc->HasRecord("customer_groups","name = '".$_REQUEST['txtName']."' AND id != ".$_REQUEST['txtID'])){
		echo json_encode(array(
			'success'=>false,
			'msg'=>'Customer Group is already exist.'
		));
	}else{
		$data = array(
			'name' => $_REQUEST['txtName']
		);
		
		if($dbc->Update("customer_groups",$data,"id=".$_REQUEST['txtID'])){
			echo json_encode(array(
				'success'=>true
			));
		}else{
			echo json_encode(array(
				'success'=>false,
				'msg' => "Update Error"
			));
		}
		
		
	}
	
	$dbc->Close();
?>