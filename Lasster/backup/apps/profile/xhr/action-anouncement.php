<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	if($_REQUEST['txtTopic']==""){
		echo json_encode(array(
			'success'=>false,
			'msg'=>'Plese input topic'
		));
	}else{
		$user = $dbc->GetRecord("users","*","id=".$_SESSION['auth']['user_id']);
		switch($_REQUEST['cbbTarget']){
			case "me":
				$data = array(
					'#id' => 'DEFAULT',
					'type' => 'message',
					'topic' => addslashes($_REQUEST['txtTopic']),
					'detail' => addslashes($_REQUEST['txtDetail']),
					'#created' => 'NOW()',
					'#updated' => 'NOW()',
					'#user' => $user['id'],
					'#acknowledge' => 'NULL'
				);
				$dbc->Insert("notifications",$data);
				break;
			case "all":
				$sql="SELECT id FROM users";
				$rst = $dbc->query($sql);
				while($line = $dbc->Fetch($rst)){
					$data = array(
						'#id' => 'DEFAULT',
						'type' => 'message',
						'topic' => addslashes($_REQUEST['txtTopic']),
						'detail' => addslashes($_REQUEST['txtDetail']),
						'#created' => 'NOW()',
						'#updated' => 'NOW()',
						'#user' => $line['id'],
						'#acknowledge' => 'NULL'
					);
					$dbc->Insert("notifications",$data);
				}
				break;
			case "group":
			$sql="SELECT id FROM users WHERE gid = ".$user['gid'];
				$rst = $dbc->query($sql);
				while($line = $dbc->Fetch($rst)){
					$data = array(
						'#id' => 'DEFAULT',
						'type' => 'message',
						'topic' => addslashes($_REQUEST['txtTopic']),
						'detail' => addslashes($_REQUEST['txtDetail']),
						'#created' => 'NOW()',
						'#updated' => 'NOW()',
						'#user' => $line['id'],
						'#acknowledge' => 'NULL'
					);
					$dbc->Insert("notifications",$data);
				}
				break;
		}
		
		echo json_encode(array(
			'success'=>true
		));
		
	}
	
	
	
	
		
		
		
		
	
	
	$dbc->Close();
?>