<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();

	?>
    <!--<select name="level3" id="level3" class="form-control">--><?php
	$sql = $dbc->Query("select * from level3 where level1 = '".$_REQUEST['filter1']."' AND level2 = '".$_REQUEST['filter2']."'");// 
	while ( $aRow = $dbc->Fetch( $sql ) ){
		$name = explode("|",$aRow['name']);
		$select2 = ($aRow['id']==$_REQUEST['filter3'])?'selected':'';
		echo '<option value="'.$aRow['id'].'" '.$select2.'>'.$name[0].'</option>';
	}?>
    <!--</select>-->
    <?php
	
	
	$dbc->Close();

?>
