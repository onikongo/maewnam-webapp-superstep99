<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	if($dbc->HasRecord("organizations","name = '".$_REQUEST['txtName']."' AND id != ".$_REQUEST['txtOrganizationID'])){
		echo json_encode(array(
			'success'=>false,
			'msg'=>'Username is already exist.'
		));
	}else{
		
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
			'name' => $_REQUEST['txtName'],
			'email' => $_REQUEST['txtEmail'],
			'phone' => $_REQUEST['txtPhone'],
			'fax' => $_REQUEST['txtFax'],
			'website' => $_REQUEST['txtWebsite'],
			'type' => $_REQUEST['cbbType'],
			'industry' => $_REQUEST['cbbIndustry'],
			'taxid' => $_REQUEST['txtTaxID'],
			'#updated' => "NOW()"
		);
		
		$dbc->Update("organizations", $data,"id=".$_REQUEST['txtOrganizationID']);
		
		echo json_encode(array(
			'success'=>true,
			'msg'=> "Passed"
		));
		
	}
	
	$dbc->Close();
?>