<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../include/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
?>
<div class="modal fade" id="dialog_add_city" data-backdrop="static">
  	<div class="modal-dialog">
		<form id="form_addcity" class="form-horizontal" role="form" onsubmit="fn.app.database.city.add();return false;">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4>Add city</h4>
      		</div>
		    <div class="modal-body">
				<div class="form-group">
					<label class="col-sm-2 control-label">City Name</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="txtName" placeholder="City Name">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Country</label>
					<div class="col-sm-10">
						<select name="cbbCountry" class="form-control">
						<?php
							$sql = "SELECT id,name FROM countries";
							$rst = $dbc->Query($sql);
							while($country = $dbc->Fetch($rst)){
								echo '<option value="'.$country['id'].'">'.$country['name'].'</option>';
							}
						
						?>
						</select>
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