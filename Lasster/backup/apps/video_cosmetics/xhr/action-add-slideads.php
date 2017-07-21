<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	
		$photo = array();
		foreach($_REQUEST['photos'] as $img)
		{
			$data = array(
				'photo' => $img['s_photos'],
				'link' => $img['link']
			);
			array_push($photo,$data);
		}
		
		$data_product = array(
			'data ' => json_encode($photo),
			'#updated ' => 'NOW()',
		);
		
		
		if($dbc->Update("website",$data_product,"name = 'adsverslide'"))
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
	
	
	$dbc->Close();
?>