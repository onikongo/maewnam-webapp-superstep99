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
	
	if($dbc->HasRecord("units","name = '".$_REQUEST['txtName']."'")){
		echo json_encode(array(
			'success'=>false,
			'msg'=>'unit Name is already exist.'
		));
	}else{
		$data = array(
			'#id' => "DEFAULT",
			'name' => $_REQUEST['txtName'],
			'scale' => $_REQUEST['txtScale']
		);
		
		if($dbc->Insert("units",$data)){
			$unit_id = $dbc->GetID();
			echo json_encode(array(
				'success'=>true,
				'msg'=> $unit_id
			));
			
			$unit = $dbc->GetRecord("units","*","id=".$unit_id);
			$os->save_log(0,$_SESSION['auth']['user_id'],"unit-add",$unit_id,array("units" => $unit));
		}else{
			echo json_encode(array(
				'success'=>false,
				'msg' => "Insert Error"
			));
		}
	}
	
	$dbc->Close();
?>