<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$id = $_REQUEST['txtID'];
	
		$data = array(
			'#status' => '1',
			'#user' => $_SESSION['auth']['user_id']
		);
		
		if($dbc->Update("contactus",$data,"id='".$id."'")){
			echo json_encode(array(
				'success'=>true,
				'msg'=> $id
			));
			
			$contact_message = $dbc->GetRecord("contactus","*","id=".$id);
	
		}else{
			echo json_encode(array(
				'success'=>false,
				'msg' => "Insert Error"
			));
		}
	
	$dbc->Close();
?>