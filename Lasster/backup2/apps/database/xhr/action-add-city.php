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
	
	if($dbc->HasRecord("cities","name = '".$_REQUEST['txtName']."'")){
		echo json_encode(array(
			'success'=>false,
			'msg'=>'city Name is already exist.'
		));
	}else{
		$data = array(
			'#id' => "DEFAULT",
			'name' => $_REQUEST['txtName'],
			'country' => $_REQUEST['cbbCountry']
		);
		
		if($dbc->Insert("cities",$data)){
			$city_id = $dbc->GetID();
			echo json_encode(array(
				'success'=>true,
				'msg'=> $city_id
			));
			
			$city = $dbc->GetRecord("cities","*","id=".$city_id);
			$os->save_log(0,$_SESSION['auth']['user_id'],"city-add",$city_id,array("cities" => $city));
		}else{
			echo json_encode(array(
				'success'=>false,
				'msg' => "Insert Error"
			));
		}
	}
	
	$dbc->Close();
?>