<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$industry = $dbc->GetRecord("industries","*","id=".$_REQUEST['id'])
?>
<div class="modal fade" id="dialog_edit_industry" data-backdrop="static">
  	<div class="modal-dialog">
		<form id="form_editindustry" class="form-horizontal" role="form" onsubmit="fn.app.demographic.industry.save_change();return false;">
		<input type="hidden" name="txtID" value="<?php echo $industry['id'];?>">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4>Edit Industry</h4>
      		</div>
			<div class="modal-body">
				<div class="form-group">
					<label for="txtName" class="col-sm-2 control-label">Code</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="txtCode" name="txtCode" placeholder="Industry Code" value="<?php echo $industry['code'];?>">
					</div>
				</div>
				<div class="form-group">
					<label for="txtName" class="col-sm-2 control-label">Name</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="txtName" name="txtName" placeholder="Industry Name" value="<?php echo $industry['name'];?>">
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
