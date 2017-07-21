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
	
	$items = array(
		array('default_language','cbbDefaultLanguage'),
		array('default_date_format','txtDefault_DateFormat'),
		array('default_time_format','txtDefault_TimeFormat'),
		array('default_datetime_format','txtDefault_DateTimeFormat')
	);
	
	foreach($items as $item){
		if($dbc->HasRecord("variable","name='".$item[0]."'")){
			$dbc->Update("variable",array(
				"name" => $item[0],
				"value" => $_REQUEST[$item[1]],
				"#updated" => "NOW()"
			),"name='".$item[0]."'");
		}else{
			$dbc->Insert("variable",array(
				"#id" => "DEFAULT",
				"name" => $item[0],
				"value" => $_REQUEST[$item[1]],
				"#updated" => "NOW()"
			));
		}
		$variable = $dbc->GetRecord("variable","*","name='".$item[0]."'");
		$os->save_log(0,$_SESSION['auth']['user_id'],"variable-edit",$item[0],array("variable" => $variable));
	}
	
	echo json_encode(array(
		'success'=>true,
		'msg'=> "Passed"
	));
	
	$dbc->Close();
?>