<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	if($dbc->HasRecord("job","name = '".$_REQUEST['txtname']."'")){
		echo json_encode(array(
			'success'=>false,
			'msg'=>'name is already exist.'
		));
	}else{
		
		$data = array(
			'#id' => "DEFAULT",
			'name' => $_REQUEST['txtname'],
			'property' => $_REQUEST['txtproperty'],
			'detail'  => $_REQUEST['txtjob'],
			'image'	  => $_REQUEST['txtphoto'],
			'salary'	  => $_REQUEST['tx_price'],
			'place' => $_REQUEST['city'],
			'#created' => "NOW()",
			'status' => 1,
			
		);
		
		if($dbc->Insert("job",$data)){
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