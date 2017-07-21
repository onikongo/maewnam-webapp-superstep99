<?php
	session_start();
	include_once "../config/define.php";
	include_once "../include/db.php";
	include_once "../include/oceanos.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	$os = new oceanos($dbc);
	
	if(!isset($_POST['chkAgree'])){
		echo json_encode(array(
			"success" => false,
			"msg" => "โปรดกดปุ่มยอมรับเงื่อนไขการลงทะเบียน!"
		));
	}else if($dbc->HasRecord("users","name='".$_POST['txtEmail']."'")){
		echo json_encode(array(
			"success" => false,
			"msg" => "มีผู้ใช้งานลงทะเบียนด้วย Email นี้แล้ว!"
		));
	}else{
		$name = explode(" ",$_POST['txtName']);
		$data = array(
			'#id' => "DEFAULT",
			'title' => "",
			'name' => $name[0],
			'surname' => isset($name[1])?$name[1]:"",
			'nickname' => "",
			'gender' => "",
			'email' => $_POST['txtEmail'],
			'phone' => "",
			'mobile' => "",
			'#dob' => "NULL",
			'#created' => "NOW()",
			'#updated' => "NOW()",
			'status' => 1
		);
		
		$dbc->Insert("contacts", $data);
		$contact_id = $dbc->GetID();
		
		$data = array(
			'#id' => "DEFAULT",
			'address' => "",
			'#country' => 0,
			'#city' => 0,
			'#district' => 0,
			'#subdistrict' => 0,
			'postal' => "",
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
			'name' => $_POST['txtEmail'],
			'#password' => "PASSWORD('".$_POST['txtPassword']."')",
			'status' => 1,
			'#created' => "NOW()",
			'#updated' => "NOW()",
			'#gid' => 2,
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
			$os->save_log(0,$user_id,"user-register",$user_id,array("users" => $user,"contacts" => $contact,"address" => $address));
			
		}else{
			echo json_encode(array(
				'success'=>false,
				'msg' => "Insert Error"
			));
		}
	}
	$dbc->Close();
?>