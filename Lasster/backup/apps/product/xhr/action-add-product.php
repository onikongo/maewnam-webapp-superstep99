<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	
	if($dbc->HasRecord("products","name = '".$_REQUEST['Name']."'"))
	{
		echo json_encode(array(
			'success'=>false,
			'msg'=>'Group Name is already exist.'
		));
	}
	else
	{
		$photo = array();
		foreach($_REQUEST['photos'] as $img)
		{
			array_push($photo,$img['s_photos']);
		}
		
		$data_product_detail = array(
			'#id' => 'DEFAULT',
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
		
		if($dbc->Insert("product_detail",$data_product_detail))
		{	
			$idp = $dbc->GetID();
			
			$data_product = array(
			'#id' => 'DEFAULT',
			//'code ' => $_REQUEST[''],
			'type'  => 'product',
			'name' => $_REQUEST['Name'],
			'category' => $_REQUEST['cate'],
			'brand' => $_REQUEST['brand'],
			'unit' => $_REQUEST['Unit'],
			'#price ' => $_REQUEST['Price'],
			'#created ' => 'NOW()',
			'#status' => '0',
			'detail' => $idp
			/* 'detail ' => base64_encode($_REQUEST['Description']), */
			/* 'discount ' => $_REQUEST['Discount'],
			'#point ' => $_REQUEST['Point'], */
			/* 'photo ' => json_encode($photo), */
			);
			
			if($dbc->Insert("products",$data_product))
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
			
			/* echo json_encode(array(
				'success'=>true,
				'msg'=> $dbc->GetID()
			)); */
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