<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();

	?>
    <!--<select name="level2" id="level2" class="form-control">--><?php
	$sql = $dbc->Query("select * from level2 where level1 = '".$_REQUEST['filter1']."'  ");//"
	while ( $aRow = $dbc->Fetch( $sql ) ){
		$name = explode("|",$aRow['name']);
		$select2 = ($aRow['sort']==$_REQUEST['sort'])?'selected':'';
		echo '<option value="'.$aRow['id'].'" '.$select2.'>'.$name[0].'</option>';
	}?>
    <!--</select>-->
    <?php
	
	
	$dbc->Close();

?>
<script>
$(document).ready(function(e) {
    $("#level2").change(function(){
		$.ajax({
			url:"apps/level4/store/store-level3.php",
			type:"POST",
			dataType:"html",
			data:{filter1:$("#level1").val(),filter2:$("#level2").val()},
			success: function(response2){
				
				$(".level3").html(response2);
			}
		});
	});
});
</script>