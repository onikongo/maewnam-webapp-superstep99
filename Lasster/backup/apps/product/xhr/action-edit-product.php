<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$product = $dbc->GetRecord("products","*","id=".$_REQUEST['txtID']);
	//$product_detail = $dbc->GetRecord("product_detail","*","id=".$product['detail']);
	$photo = array();
	foreach($_REQUEST['photos'] as $img)
	{
		array_push($photo,$img['s_photos']);
	}
	$data_product_detail = array(
			/* '#id' => 'DEFAULT', */
			'detail ' => base64_encode($_REQUEST['Description']),
			'photo ' => json_encode($photo),
			'brief ' => $_REQUEST['Brief'],
			'size' => $_REQUEST['size'],
			'color' => $_REQUEST['color'],
			//'code ' => $_REQUEST[''],
			/* 'name ' => $_REQUEST['Name'],
			'brief ' => $_REQUEST['Brief'], */
			/* '#price ' => $_REQUEST['Price'], */
			/* 'discount ' => $_REQUEST['Discount'],
			'#point ' => $_REQUEST['Point'], */
			/* '#created ' => 'NOW()',
			'#status' => '0', */
		);
		
	if($dbc->Update("product_detail",$data_product_detail,"id='".$product['detail']."'"))
	{	
		
			$data_product = array(
			'name ' => $_REQUEST['Name'],
			'category' => $_REQUEST['cate'],
			'brand' => $_REQUEST['brand'],
			'unit' => $_REQUEST['Unit'],
			'#price ' => $_REQUEST['Price'],
			'#status' => '0',
			'#updated ' => 'NOW()',
		);
		
		
			$dbc->Update("products",$data_product,"id=".$_REQUEST['txtID']);
		
		echo json_encode(array(
			'success'=>true,
			'msg'=> $dbc->GetID()
		));
	}
	else
	{
		echo json_encode(array(
			'success'=>false,
			'msg' => "Insert product detail Error"
		));
	}
	
	
		
	
	
	$dbc->Close();
?>