<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	if($_FILES['file']['name']==""){
		echo json_encode(array(
			'success'=>false,
			'msg' => "Please upload photo"
		));
	}else{
		
		if($dbc->HasRecord("variable","name='iAvatarNumber'")){
			$line = $dbc->GetRecord("variable","value","name='iAvatarNumber'");
			$iAvatarNumber = $line['value'];
		}else{
			$iAvatarNumber = 0;
			$dbc->Insert("variable",array(
				"#id" => "DEFAULT",
				"name" => "iAvatarNumber",
				"value" => $iAvatarNumber,
				"#updated" => "NOW()"
			));
		}
		$iAvatarNumber++;
		
		$path = "upload/avatar/$iAvatarNumber.png";
		move_uploaded_file($_FILES['file']['tmp_name'],"../../../".$path);
		if($dbc->HasRecord("variable","name = 'fSystem_logo'")){
			$dbc->Update("variable",array("value" => $path,"#updated" => "NOW()"),"name = 'fSystem_logo'");
		}else{
			$dbc->Insert("variable",array("value" => $path,"#updated" => "NOW()","name"=>"fSystem_logo"));
		}
		$dbc->Update("variable",array("value" => $iAvatarNumber,"#updated" => "NOW()"),"name='iAvatarNumber'");
		
		echo json_encode(array(
			'success'=>true
		));
	}
	
	//$order = $dbc->GetRecord("orders","*","id=".$_REQUEST['id']);
	
?>

<?php
	
	$dbc->Close();
?>