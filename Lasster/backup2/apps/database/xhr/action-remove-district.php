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
		$district = $dbc->GetRecord("districts","*","id=".$item);
		$dbc->Delete("districts","id=".$item);
		$os->save_log(0,$_SESSION['auth']['user_id'],"district-delete",$id,array("districts" => $district));
	}
	
	$dbc->Close();
?>