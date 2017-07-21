<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../include/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$city = $dbc->GetRecord("cities","*","id=".$_REQUEST['id']);
?>
<div class="modal fade" id="dialog_edit_city" data-backdrop="static">
  	<div class="modal-dialog">
		<form id="form_editcity" class="form-horizontal" role="form" onsubmit="fn.app.database.city.edit();return false;">
		<input type="hidden" name="txtID" value="<?php echo $city['id'];?>">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4>Edit city</h4>
      		</div>
		    <div class="modal-body">
				<div class="form-group">
					<label class="col-sm-2 control-label">Country</label>
					<div class="col-sm-10">
						<select name="cbbCountry" class="form-control">
						<?php
							$sql = "SELECT id,name FROM countries";
							$rst = $dbc->Query($sql);
							while($country = $dbc->Fetch($rst)){
								$selected = $city['country']==$country['id']?" selected":"";
								echo '<option value="'.$country['id'].'"'.$selected.'>'.$country['name'].'</option>';
							}
						?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">City Name</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="txtName" placeholder="City Name" value="<?php echo $city['name'];?>">
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