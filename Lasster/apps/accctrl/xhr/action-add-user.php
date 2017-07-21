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
	
	if($_REQUEST['txtUsername']==""){
		echo json_encode(array(
			'success'=>false,
			'msg'=>'Please insert username!'
		));
	}else if($dbc->HasRecord("users","name = '".$_REQUEST['txtUsername']."'")){
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
			'gender' => $_REQUEST['cbbGender'],
			'email' => $_REQUEST['txtEmail'],
			'phone' => $_REQUEST['txtPhone'],
			'mobile' => $_REQUEST['txtMobile'],
			'#created' => "NOW()",
			'#updated' => "NOW()",
			'status' => 1
		);
		if($_REQUEST['txtDOB']==""){
			$data['#dob'] = "NULL";
		}else{
			$data['dob'] = $_REQUEST['txtDOB'];
		}
		
		$dbc->Insert("contacts", $data);
		$contact_id = $dbc->GetID();
		
		$data = array(
			'#id' => "DEFAULT",
			'address' => $_REQUEST['txtAddress'],
			'#country' => $_REQUEST['cbbCountry'],
			'#city' => $_REQUEST['cbbCity'],
			'#district' => $_REQUEST['cbbDistrict'],
			'#subdistrict' => $_REQUEST['cbbSubdistrict'],
			'postal' => $_REQUEST['txtPostal'],
			'#created' => "NOW()",
			'#updated' => "NOW()",
			'#contact' => $contact_id,
			'#organization' => 'NULL',
			'priority' => 1
		);
		
		$dbc->Insert("address", $data);
		$address_id = $dbc->GetID();
		
		$data = array(
			'#id' => "DEFAULT",
			'name' => $_REQUEST['txtUsername'],
			'#password' => "PASSWORD('".$_REQUEST['txtPassword']."')",
			'status' => 1,
			'#created' => "NOW()",
			'#updated' => "NOW()",
			'#gid' => $_REQUEST['cbbGroup'],
			'#contact' => $contact_id,
			'setting' => json_encode(array())
			
		);
		
		if($dbc->Insert("users",$data)){
			$user_id = $dbc->GetID();
			echo json_encode(array(
				'success'=>true,
				'msg'=> $user_id
			));
			
			$user = $dbc->GetRecord("users","*","id=".$user_id);
			$contact = $dbc->GetRecord("contacts","*","id=".$contact_id);
			$address = $dbc->GetRecord("address","*","id=".$address_id);
			$os->save_log(0,$_SESSION['auth']['user_id'],"user-add",$user_id,array("users" => $user,"contacts" => $contact,"address" => $address));
			
		}else{
			echo json_encode(array(
				'success'=>false,
				'msg' => "Insert Error"
			));
		}
	}
	
	$dbc->Close();
?>