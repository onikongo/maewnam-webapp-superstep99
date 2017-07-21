<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../include/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$unit = $dbc->GetRecord("units","*","id=".$_REQUEST['id']);
?>
<div class="modal fade" id="dialog_edit_unit" data-backdrop="static">
  	<div class="modal-dialog">
		<form id="form_editunit" class="form-horizontal" role="form" onsubmit="fn.app.database.unit.edit();return false;">
		<input type="hidden" name="txtID" value="<?php echo $unit['id'];?>">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4>Edit unit</h4>
      		</div>
		    <div class="modal-body">
				
				<div class="form-group">
					<label class="col-sm-2 control-label">Name</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="txtName" placeholder="Unit Name" value="<?php echo $unit['name'];?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Scale</label>
					<div class="col-sm-10">
						<input type="number" class="form-control" name="txtScale" placeholder="Scale" value="<?php echo $unit['scale'];?>">
					</div>
				</div>
		    </div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Save</button>
			</div>
	  	</div><!-- /.modal-content -->
		</form>
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php
	$dbc->Close();
?>