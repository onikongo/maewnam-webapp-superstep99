<?php
	session_start();
	$root = $_SERVER['DOCUMENT_ROOT'];
	include_once "../../../config/define.php";
	include_once "../../../libs/class/db.php";
	include_once "../../../libs/class/oceanos.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);

	$dbc = new dbc;
	$dbc->Connect();
?>



<select  id="subcate" name="subcate" class="form-control">
<?php $sql_cate = $dbc->Query("select * from subcategory where category = '".$_REQUEST['cate']."'  order by id asc");
while($c_row = $dbc->Fetch($sql_cate))
{
	?><option value="<?php echo $c_row['id'];?>" <?php //echo($c_row['category']==$_REQUEST['cate'])?'selected':'';?>><?php echo $c_row['name'];?></option><?php
}
?>
</select>

<?php
$dbc->Close();
?>