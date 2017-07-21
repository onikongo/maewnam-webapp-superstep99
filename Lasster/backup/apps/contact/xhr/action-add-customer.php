<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	if($dbc->HasRecord("users","name = '".$_REQUEST['txtUsername']."'")){
		echo json_encode(array(
			'success'=>false,
			'msg'=>'Username is already exist.'
		));
	}else{
		$data = array(
			'#id' => "DEFAULT",
			'title' => $_REQUEST['cbbTitle'],
			'name' => $_REQUEST['txtFirst'],
			'surname' => $_REQUEST['txtSurname'],
			'nickname' => $_REQUEST['txtNick'],
			'dob' => $_REQUEST['txtDOB'],
			'gender' => $_REQUEST['cbbGender'],
			'email' => $_REQUEST['txtEmail'],
			'phone' => $_REQUEST['txtPhone'],
			'mobile' => $_REQUEST['txtMobile'],
			'#created' => "NOW()",
			'#updated' => "NOW()",
			'status' => 1
		);
		$dbc->Insert("contacts", $data);
		$contact_id = $dbc->GetID();
		
		$data = array(
			'#id' => "DEFAULT",
			'address' => $_REQUEST['txtAddress'],
			'country' => $_REQUEST['cbbCountry'],
			'city' => $_REQUEST['cbbCity'],
			'district' => $_REQUEST['cbbDistrict'],
			'subdistrict' => $_REQUEST['cbbSubdistrict'],
			'postal' => $_REQUEST['txtPostal'],
			'#created' => "NOW()",
			'#updated' => "NOW()",
			'#contact' => $contact_id,
			'#organization' => 'NULL',
			'priority' => 1
		);
		
		$dbc->Insert("address", $data);
		
		$data = array(
			'#id' => "DEFAULT",
			'code' => "",
			'type' => $_REQUEST['cbbType'],
			'username' => $_REQUEST['txtUsername'],
			'#password' => "PASSWORD('".$_REQUEST['txtPassword']."')",
			'status' => 1,
			'#created' => "NOW()",
			'#updated' => "NOW()",
			'#gid' => $_REQUEST['cbbGroup'],
			'#contact' => $contact_id,
			'#organization' => "NULL",
			'#last_login' => "NULL"
			
		);
		
		if($dbc->Insert("customers",$data)){
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