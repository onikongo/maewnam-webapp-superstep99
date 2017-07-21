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
	
	if($_REQUEST['txtName']==""){
		echo json_encode(array(
			'success'=>false,
			'msg'=>'Please insert username!'
		));
	}else if($dbc->HasRecord("sales_team","name = '".$_REQUEST['txtName']."'")){
		echo json_encode(array(
			'success'=>false,
			'msg'=>'Username is already exist.'
		));
	}else{
		
		$data = array(
			'#id' => "DEFAULT",
			'name' => $_REQUEST['txtName'],
			'#icon' => "NULL",
			'setting' => json_encode(array())
		);
		
		if($dbc->Insert("sales_team",$data)){
			$user_id = $dbc->GetID();
			echo json_encode(array(
				'success'=>true,
				'msg'=> $user_id
			));
			
			
		}else{
			echo json_encode(array(
				'success'=>false,
				'msg' => "Insert Error"
			));
		}
	}
	
	$dbc->Close();
?>