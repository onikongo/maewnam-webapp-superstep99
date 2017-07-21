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
	
	if($dbc->HasRecord("industries","name = '".$_REQUEST['txtName']."'")){
		echo json_encode(array(
			'success'=>false,
			'msg'=>'industry Name is already exist.'
		));
	}else{
		$data = array(
			'#id' => "DEFAULT",
			'code' => $_REQUEST['txtCode'],
			'name' => $_REQUEST['txtName']
		);
		
		if($dbc->Insert("industries",$data)){
			$industry_id = $dbc->GetID();
			echo json_encode(array(
				'success'=>true,
				'msg'=> $industry_id
			));
			
			$industry = $dbc->GetRecord("industries","*","id=".$industry_id);
			$os->save_log(0,$_SESSION['auth']['user_id'],"industry-add",$industry_id,array("industries" => $industry));
		}else{
			echo json_encode(array(
				'success'=>false,
				'msg' => "Insert Error"
			));
		}
	}
	
	$dbc->Close();
?>