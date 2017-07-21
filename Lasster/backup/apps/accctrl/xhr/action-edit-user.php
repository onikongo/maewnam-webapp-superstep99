<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	if($dbc->HasRecord("users","name = '".$_REQUEST['txtUsername']."' AND id != ".$_REQUEST['txtUserID'])){
		echo json_encode(array(
			'success'=>false,
			'msg'=>'Username is already exist.'
		));
	}else{
		$data = array(
			'title' => $_REQUEST['cbbTitle'],
			'name' => $_REQUEST['txtFirst'],
			'surname' => $_REQUEST['txtSurname'],
			'nickname' => $_REQUEST['txtNick'],
			'dob' => $_REQUEST['txtDOB'],
			'gender' => $_REQUEST['cbbGender'],
			'email' => $_REQUEST['txtEmail'],
			'phone' => $_REQUEST['txtPhone'],
			'mobile' => $_REQUEST['txtMobile'],
			'#updated' => "NOW()"
		);
		$dbc->Update("contacts", $data,"id=".$_REQUEST['txtContactID']);
		
		$data = array(
			'address' => $_REQUEST['txtAddress'],
			'postal' => $_REQUEST['txtPostal'],
			'#updated' => "NOW()"
		);
		
		if(isset($_REQUEST['cbbCountry']))$data['#country']=$_REQUEST['cbbCountry'];
		if(isset($_REQUEST['cbbCity']))$data['#city']=$_REQUEST['cbbCity'];
		if(isset($_REQUEST['cbbSubdistrict']))$data['#subdistrict']=$_REQUEST['cbbCountry'];
		if(isset($_REQUEST['cbbDistrict']))$data['#district']=$_REQUEST['cbbDistrict'];
		
		$dbc->Update("address", $data,"id=".$_REQUEST['txtAddressID']);
		
		$data = array(
			'name' => $_REQUEST['txtUsername'],
			'#updated' => "NOW()",
			'#gid' => $_REQUEST['cbbGroup']
		);
		if($_REQUEST['txtPassword']!="")$data['#password'] = "PASSWORD('".$_REQUEST['txtPassword']."')";
		$dbc->Update("users", $data,"id=".$_REQUEST['txtUserID']);
		
		echo json_encode(array(
			'success'=>true,
			'msg'=> "Passed"
		));
		
	}
	
	$dbc->Close();
?>