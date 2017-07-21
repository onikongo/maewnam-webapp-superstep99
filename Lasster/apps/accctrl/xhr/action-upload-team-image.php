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
	
	$sale_team = $dbc->GetRecord("sales_team","*",'id='.$_REQUEST['txtID']);
	
	if($_FILES['file']['name']==""){
		echo json_encode(array(
			'success'=>false,
			'msg' => "Please upload photo"
		));
	}else{
		$iAvatarNumber = $os->load_variable('iAvatarNumber');
		$iAvatarNumber++;
		
		$filename = $_FILES['file']['name'];
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		$path = "img/avatar/$iAvatarNumber.".$ext;
		
		$uploaded = $os->upload($_FILES['file'],"../../../".$path);
		if(!$uploaded['success']){
			echo json_encode(array(
				'success'=>false,
				'msg' => $uploaded['msg']
			));
		}else{
			$dbc->Update("sales_team",array("icon" => $path),'id='.$_REQUEST['txtID']);
			$os->save_variable('iAvatarNumber',$iAvatarNumber);
			if(isset($sale_team['icon']))unlink("../../../".$sale_team['icon']);
			echo json_encode(array(
				'success'=>true,
				'path' => "$path"
			));
		}
	}
?>
<?php
	$dbc->Close();
?>