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
			'property' => trim($_REQUEST['txtproperty']),
			'detail'  => trim($_REQUEST['txtjob']),
			'image'	  => $_REQUEST['txtphotoEdit'],
			'salary'	  => $_REQUEST['tx_price'],
			'place' => $_REQUEST['city'],
			'#updated' => "NOW()",
			'status' => 1,
		);
	if($dbc->HasRecord("job","id = '".$_REQUEST['txtID']."'")){
		$dbc->Update("job", $data,"id=".$_REQUEST['txtID']);
		
		echo json_encode(array(
			'success'=>true,
			'msg'=> "Passed"
		));
	}
	
	$dbc->Close();
?>