<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();

	
	/* if($_FILES['file']['name']==""){
		echo json_encode(array(
			'success'=>false,
			'msg' => "Please upload photo"
		));
	}else{ */
		$name = $_FILES['file']['name'];
		
		$times = time(' H:i:s');
		$picName = 'photo_'.$times.".jpg";
		
		$path = "upload/why_qrs/pic/".$picName;
		move_uploaded_file($_FILES['file']['tmp_name'],"../../../".$path);
		
		echo json_encode(array(
			'success'=>true,
			'photo' => $path
		));
	/* } */
	
	//$order = $dbc->GetRecord("orders","*","id=".$_REQUEST['id']);
	
?>

<?php
	
	$dbc->Close();
?>