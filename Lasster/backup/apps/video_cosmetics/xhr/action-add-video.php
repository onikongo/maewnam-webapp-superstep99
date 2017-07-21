<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	
	if($dbc->HasRecord("video","name = '".$_REQUEST['tx_title']."'"))
	{
		echo json_encode(array(
			'success'=>false,
			'msg'=>'title Name is already exist.'
		));
	}
	else
	{
		$data_article = array(
			'#id' => 'DEFAULT',
			'name ' => $_REQUEST['tx_title'],
			/*'brief ' => $_REQUEST['tx_brief'],
			'detail' => base64_encode($_REQUEST['tx_desc']),
			'photo ' => $_REQUEST['tx_photo'],*/
			'embed ' => $_REQUEST['tx_Video'],
			'#created ' => 'NOW()',
			'#status' => '0',
			'#category ' => $_REQUEST['cate'],
			'#subcategory ' => $_REQUEST['sub_cate']
		);
		//$ins_product = $dbc->Insert("products",$data_product);
		
		
		if($dbc->Insert("video",$data_article))
		{	
			$idp = $dbc->GetID();
			
		
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
	}
	
	
	$dbc->Close();
?>