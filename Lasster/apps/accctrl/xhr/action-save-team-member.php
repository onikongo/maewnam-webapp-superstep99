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
	
	for($i=0;$i<count($_POST['txtID']);$i++){
		if($_POST['txtID'][$i] == ""){
			
			$data = array(
				"#id" => "DEFAULT",
				"#user" => $_POST['txtMember'][$i],
				"#team" => $_POST['team_id'],
				"#role" => $_POST['cbbRole'][$i],
				
			);
			$dbc->Insert("sales_mapping",$data);
		}else{
			if($_POST['flagRemove'][$i]=="yes"){
				$dbc->Delete("sales_mapping","id=".$_POST['txtID'][$i]);
			}else{
				$data = array(
					"#role" => $_POST['cbbRole'][$i],
				);
				$dbc->Update("sales_mapping",$data,"id=".$_POST['txtID'][$i]);
			}
		}
	}
	
	echo json_encode(array(
		'success'=>true,
		'msg'=> "Passed"
	));
	
	$dbc->Close();
?>