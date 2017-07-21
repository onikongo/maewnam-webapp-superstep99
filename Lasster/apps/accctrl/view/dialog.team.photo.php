<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../include/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$team = $dbc->GetRecord("sales_team","*","id=".$_REQUEST['id']);
	$img = $team['icon']!=""?$team['icon']:"img/default/user.png";
	
?>
<div class="modal fade" id="dialog_team_photo" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="smallModalHead">Change photo</h4>
			</div>
			<div class="modal-body text-center">
				<div>
				<?php
					echo '<img src="'.$img.'?'.time().'" class="img-round"></img>';
				?>
				</div>
			</div>
			<form class="form_upload hidden" method="post" enctype="multipart/form-data">
				<input type="hidden" name="txtID" value="<?php echo $team['id'];?>">
				<input type="file" class="fileinput btn-info" name="file" data-filename-placement="inside" title="Select file"/>	
			</form>
			<div class="modal-footer">
				<?php
					if($team['icon']!=""){
						echo '<button type="button" class="btn_remove btn btn-danger pull-left">Clear Image</button>';
					}
				?>
				<button type="button" class="btn_change btn btn-primary">Change</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
	  	</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php
	$dbc->Close();
?>