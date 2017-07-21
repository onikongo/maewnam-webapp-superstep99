<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../include/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
?>
<div class="modal fade" id="dialog_add_role" data-backdrop="static">
  	<div class="modal-dialog modal-lg">
		<form id="form_addrole" class="form-horizontal" role="form" onsubmit="fn.app.accctrl.role.add();return false;">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4>Add Role</h4>
      		</div>
		    <div class="modal-body">
				<div class="form-group">
					<label class="col-sm-2 control-label">Role Name</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="txtName" name="txtName">
					</div>
				</div>
		    </div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Save</button>
			</div>
	  	</div>
		</form>
	</div>
</div>
-->
<?php
	$dbc->Close();
?>