<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$image = array();
	foreach($_REQUEST['txtphotoEdit'] as $a)
	{
		array_push($image,$a);
	}
	
	
		$data = array(
			// 'title' => $_REQUEST['txttitle'],
			/* 'brief' => $_REQUEST['txtbrief'], */
			// 'detail' => $_REQUEST['txtdetail'],
			// 'image' => $_REQUEST['txtphotoEdit'],
			'image' => json_encode(isset($image)?$image:'NULL'),
			/* 'file' => $_REQUEST['txtfileEdit'],
			'status' => 1, */
			'#updated' => "NOW()"
			
		);
	if($dbc->HasRecord("why_qrs","id = '".$_REQUEST['txtID']."'")){
		$dbc->Update("why_qrs", $data,"id=".$_REQUEST['txtID']);
		
		echo json_encode(array(
			'success'=>true,
			'msg'=> "Passed"
		));
	}
	
	$dbc->Close();
?>