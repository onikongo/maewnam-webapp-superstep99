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
	
	foreach($_REQUEST['items'] as $item){
		$user = $dbc->GetRecord("users","*","id=".$item);
		$contact = $dbc->GetRecord("contacts","*","id=".$user['contact']);
		$address = $dbc->GetRecord("address","*","id=".$user['contact']);
		$dbc->Delete("users","id=".$item);
		$dbc->Delete("contacts","id=".$user['contact']);
		$dbc->Delete("address","contact=".$user['contact']);
		$os->save_log(0,$_SESSION['auth']['user_id'],"user-delete",$user['id'],array("users" => $user,"contacts" => $contact,"address" => $address));
			
	}
	
	$dbc->Close();
?>