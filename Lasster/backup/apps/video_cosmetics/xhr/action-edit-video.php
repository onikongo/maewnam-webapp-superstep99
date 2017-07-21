<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	
	$data_product = array(
		'name ' => $_REQUEST['tx_title'],
		/*'brief ' => $_REQUEST['tx_brief'],
		'detail' => base64_encode($_REQUEST['tx_desc']),
		'photo ' => $_REQUEST['tx_photo'],*/
		'embed ' => $_REQUEST['tx_Video'],
		'#created ' => 'NOW()',
		'#status' => '0',
		'#updated ' => $_REQUEST['cate'],
		'#subcategory ' => $_REQUEST['sub_cate']
	);
	//$ins_product = $dbc->Insert("products",$data_product);
	
	
	if($dbc->Update("video",$data_product,"id=".$_REQUEST['txtID']))
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
			'msg' => "Insert Error"
		));
	}
		
		
	
	
	$dbc->Close();
?>