<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	if($dbc->HasRecord("users","name = '".$_REQUEST['txtName']."' AND id != ".$_REQUEST['txtUserID'])){
		echo json_encode(array(
			'success'=>false,
			'msg'=>'Username is already exist.'
		));
	}else{
		$data = array(
			'name' => $_REQUEST['txtUsername'],
			'#updated' => 'NOW()'
		);
		$dbc->Update("users",$data,"id=".$_REQUEST['txtUserID']);
		$data = array(
			'name' => $_REQUEST['txtName'],
			'surname' => $_REQUEST['txtSurname'],
			'title' => $_REQUEST['cbbTitle'],
			'gender' => $_REQUEST['cbbGender'],
			'dob' => $_REQUEST['txtDOB'],
			'email' => $_REQUEST['txtEmail'],
			'phone' => $_REQUEST['txtPhone'],
			'mobile' => $_REQUEST['txtMobile'],
			'#updated' => 'NOW()'
		);
		$dbc->Update("contacts",$data,"id=".$_REQUEST['txtUserID']);
		
		$data = array(
			'address' => $_REQUEST['txtAddress'],
			'#updated' => 'NOW()'
		);
		$dbc->Update("address",$data,"id=".$_REQUEST['txtAddressID']);
		
		echo json_encode(array(
				'success'=>true,
				'msg'=> $dbc->GetID()
		));
		
	}
	
	$dbc->Close();
?>