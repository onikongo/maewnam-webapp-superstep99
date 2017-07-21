<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	foreach($_REQUEST['items'] as $item){
		$customer = $dbc->GetRecord("video","*","id=".$item);
		$dbc->Delete("video","id=".$item);
		/*$dbc->Delete("contacts","id=".$customer['contact']);
		$dbc->Delete("address","contact=".$customer['contact']);*/
	}
	
	$dbc->Close();
?>