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
		$group = $dbc->GetRecord("groups","*","id=".$item);
		$dbc->Delete("groups","id=".$item);
		$dbc->Delete("permissions","gid=".$item);
		$os->save_log(0,$_SESSION['auth']['user_id'],"group-delete",$id,array("groups" => $group));
	}
	
	$dbc->Close();
?>