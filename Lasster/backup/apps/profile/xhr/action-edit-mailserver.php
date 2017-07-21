<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$user = $dbc->GetRecord("users","setting","id=".$_REQUEST['txtID']);
	$setting = json_decode($user['setting'],true);
	
	$setting['email_server'] = array(
		"imap_server" => $_REQUEST['txtIMAPServer'],
		"imap_user" => $_REQUEST['txtIMAPUser'],
		"imap_password" => $_REQUEST['txtIMAPPass'],
		"imap_port" => $_REQUEST['txtIMAPPort'],
		
		"smtp_server" => $_REQUEST['txtSMTPServer'],
		"smtp_user" => $_REQUEST['txtSMTPUser'],
		"smtp_password" => $_REQUEST['txtSMTPPass'],
		"smtp_port" => $_REQUEST['txtSMTPPort'],
		"smtp_ssl" => $_REQUEST['cbbAuthenticate']
	);
	
		$data = array(
			'setting' => json_encode($setting),
			'#updated' => 'NOW()'
		);
		$dbc->Update("users",$data,"id=".$_REQUEST['txtID']);
		
		echo json_encode(array(
				'success'=>true,
				'msg'=> $dbc->GetID()
		));
		
	
	
	$dbc->Close();
?>