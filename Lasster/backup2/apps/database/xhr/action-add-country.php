<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../include/db.php";
	include_once "../../../include/oceanos.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	$os = new oceanos($dbc);
	
	if($dbc->HasRecord("countries","name = '".$_REQUEST['txtName']."'")){
		echo json_encode(array(
			'success'=>false,
			'msg'=>'country Name is already exist.'
		));
	}else{
		$data = array(
			'#id' => "DEFAULT",
			'name' => $_REQUEST['txtName'],
			'local_name' => $_REQUEST['txtLocal'],
			'region' => 0,
			'iso' => $_REQUEST['txtISO'],
			'iso3' => $_REQUEST['txtISO3'],
			'#numcode' => "NULL",
			'phonecode' => $_REQUEST['txtPhone']
		);
		
		if($dbc->Insert("countries",$data)){
			$country_id = $dbc->GetID();
			echo json_encode(array(
				'success'=>true,
				'msg'=> $country_id
			));
			
			$country = $dbc->GetRecord("countries","*","id=".$country_id);
			$os->save_log(0,$_SESSION['auth']['user_id'],"country-add",$country_id,array("countries" => $country));
		}else{
			echo json_encode(array(
				'success'=>false,
				'msg' => "Insert Error"
			));
		}
	}
	
	$dbc->Close();
?>