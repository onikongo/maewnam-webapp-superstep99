<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$info = array(
		"org_name" => $_REQUEST['txtName'],
		"tax_id" => $_REQUEST['txtTax'],
		"address" => $_REQUEST['txtAddress'],
		"phone" => $_REQUEST['txtPhone'],
		"mobile" => $_REQUEST['txtMobile'],
		"email" => $_REQUEST['txtEmail'],
		"website" => $_REQUEST['txtWebsite'],
	);
	
	if($dbc->HasRecord("variable","name='aSystem_info'")){
		$dbc->Update("variable",array(
				"name" => "aSystem_info",
				"value" => base64_encode(json_encode($info)),
				"#updated" => "NOW()"
		),"name='aSystem_info'");
		
	}else{
		$dbc->Insert("variable",array(
				"#id" => "DEFAULT",
				"name" => "aSystem_info",
				"value" => base64_encode(json_encode($info)),
				"#updated" => "NOW()"
		));
		
	}
	
	echo json_encode(array(
		'success'=>true,
		'msg'=> "Passed"
	));
	
	$dbc->Close();
?>