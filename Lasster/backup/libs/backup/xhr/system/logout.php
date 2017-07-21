<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	unset($_SESSION['admin_mode']);
	unset($_SESSION['edit_mode']);
	
	unset($_SESSION['auth']);
	unset($_SESSION['exptime']);
	
?>