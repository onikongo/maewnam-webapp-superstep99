<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$image = array();
	foreach($_REQUEST['txt_pic'] as $a)
	{
		array_push($image,$a);
	}
	
	if($dbc->HasRecord("blog","title = '".$_REQUEST['txttitle']."'")){
		echo json_encode(array(
			'success'=>false,
			'msg'=>'blog name is already exist.'
		));
	}else{
		
		$data = array(
			'#id' => "DEFAULT",
			'title' => $_REQUEST['txttitle'],
			/* 'brief' => $_REQUEST['txtbrief'], */
			'detail' => $_REQUEST['txtdetail'],
			// 'image' => $_REQUEST['txtphoto'],
			'image' =>  json_encode(isset($image)?$image:'NULL'),
			'file' => $_REQUEST['txtfile'],
			'status' => 1,
			'#created' => "NOW()",
			'#updated' => "NOW()"
			
		);
		
		if($dbc->Insert("blog",$data)){
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