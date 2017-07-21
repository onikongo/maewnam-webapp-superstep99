<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../include/db.php";
	include_once "../../../include/oceanos.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	$os = new oceanos($dbc);
	
	if($dbc->HasRecord("sales_team","name = '".$_REQUEST['txtName']."' AND id != ".$_REQUEST['txtID'])){
		echo json_encode(array(
			'success'=>false,
			'msg'=>'Team name is already exist.'
		));
	}else{
		$data = array(
			'name' => $_REQUEST['txtName']
		);
		if($dbc->Update("sales_team", $data,"id=".$_REQUEST['txtID'])){
			echo json_encode(array(
				'success'=>true,
				'msg'=> "Passed"
			));
		}else{
			echo json_encode(array(
				'success'=>false,
				'msg'=> "Update Error"
			));
		}
	}
	
	$dbc->Close();
?>