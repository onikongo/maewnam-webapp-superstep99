<?php
	$root = $_SERVER['DOCUMENT_ROOT'];
	include_once "../../../config/define.php";
	include_once "../../../libs/class/db.php";
	include_once "../../../libs/class/oceanos.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);

	$dbc = new dbc;
	$dbc->Connect();
	$cate = $_REQUEST['cate'];
?>
<select name="" id="sub_cate" name="sub_cate" class="form-control">
<?php $sql_cate = $dbc->Query("select * from video_subcategory where category = '".$cate."' order by id asc");
while($c_row = $dbc->Fetch($sql_cate))
{
	echo '<option value="'.$c_row['id'].'">'.$c_row['name'].'</option>';
}
?>
	
</select>