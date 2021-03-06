<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	if($dbc->HasRecord("slide","name = '".$_REQUEST['txtname']."'")){
		echo json_encode(array(
			'success'=>false,
			'msg'=>'videoname is already exist.'
		));
	}else{
		
		$data = array(
			'#id' => "DEFAULT",
			'name' => $_REQUEST['txtname'],
			'data' => $_REQUEST['txtphoto'],
			'status' => 1,
			'#created' => "NOW()",
			'#updated' => "NOW()"
		);
		
		if($dbc->Insert("slide",$data)){
			echo json_encode(array(
				'success'=>true,
				'msg'=> $dbc->GetID()
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