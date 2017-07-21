<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	if($dbc->HasRecord("organizations","name = '".$_REQUEST['txtName']."'")){
		echo json_encode(array(
			'success'=>false,
			'msg'=>'Ogranization is already exist.'
		));
	}else{
		$data = array(
			'#id' => "DEFAULT",
			'code' => "",
			'name' => $_REQUEST['txtName'],
			'email' => $_REQUEST['txtEmail'],
			'phone' => $_REQUEST['txtPhone'],
			'fax' => $_REQUEST['txtFax'],
			'website' => $_REQUEST['txtWebsite'],
			'#created' => "NOW()",
			'#updated' => "NOW()",
			'type' => $_REQUEST['cbbType'],
			'industry' => $_REQUEST['cbbIndustry'],
			'taxid' => $_REQUEST['txtTaxID'],
			'logo' => ''
		);
		$dbc->Insert("organizations",$data);
		$org_id = $dbc->GetID();
		
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
			'#contact' => 'NULL',
			'#organization' => $org_id,
			'priority' => 1
		);
		
		if($dbc->Insert("address", $data)){
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