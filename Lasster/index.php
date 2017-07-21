<?php
	session_start();
	include_once "config/define.php";
	include_once "include/db.php";
	include_once "include/oceanos.php";
	include_once "include/abox.php";
	
	$dbc = new dbc;
	$dbc->Connect();
	$abox = new abox($dbc);
	
	if(is_null($abox->auth)){
		include_once "iface/login.php";
	}else{
		include_once "iface/bootstrap.php";
	}

	$dbc->Close();
	
?>