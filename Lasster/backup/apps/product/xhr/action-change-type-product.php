<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$product = $dbc->GetRecord("products","*","id=".$_REQUEST['txtID']);
	
	$data_product = array(
			'type' => $_REQUEST['txtType']
			/* '#id' => 'DEFAULT', */
			/* 'detail ' => base64_encode($_REQUEST['Description']),
			'photo ' => json_encode($photo),
			'brief ' => $_REQUEST['Brief'],
			'size' => $_REQUEST['size'],
			'color' => $_REQUEST['color'], */
			//'code ' => $_REQUEST[''],
			/* 'name ' => $_REQUEST['Name'],
			'brief ' => $_REQUEST['Brief'], */
			/* '#price ' => $_REQUEST['Price'], */
			/* 'discount ' => $_REQUEST['Discount'],
			'#point ' => $_REQUEST['Point'], */
			/* '#created ' => 'NOW()',
			'#status' => '0', */
		);
		
	if($dbc->Update("products",$data_product,"id='".$product['id']."'"))
	{	
		echo json_encode(array(
			'success'=>true,
			'msg'=> $dbc->GetID()
		));
	}
	else
	{
		echo json_encode(array(
			'success'=>false,
			'msg' => "Update product type Error"
		));
	}
	
	
		
	
	
	$dbc->Close();
?>