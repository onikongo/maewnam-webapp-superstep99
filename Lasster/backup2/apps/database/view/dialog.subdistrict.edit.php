<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../include/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$subdistrict = $dbc->GetRecord("subdistricts","*","id=".$_REQUEST['id']);
?>
<div class="modal fade" id="dialog_edit_subdistrict" data-backdrop="static">
  	<div class="modal-dialog">
		<form id="form_editsubdistrict" class="form-horizontal" role="form" onsubmit="fn.app.database.subdistrict.edit();return false;">
		<input type="hidden" name="txtID" value="<?php echo $subdistrict['id'];?>">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4>Edit subdistrict</h4>
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
								$selected = $subdistrict['country']==$country['id']?" selected":"";
								echo '<option value="'.$country['id'].'"'.$selected.'>'.$country['name'].'</option>';
							}
						?>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-2 control-label">City</label>
					<div class="col-sm-10">
						<select name="cbbCity" class="form-control">
						<?php
							$sql = "SELECT id,name FROM cities";
							$rst = $dbc->Query($sql);
							while($city = $dbc->Fetch($rst)){
								$selected = $subdistrict['city']==$city['id']?" selected":"";
								echo '<option value="'.$city['id'].'"'.$selected.'>'.$city['name'].'</option>';
							}
						
						?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">District</label>
					<div class="col-sm-10">
						<select name="cbbCity" class="form-control">
						<?php
							$sql = "SELECT id,name FROM cities";
							$rst = $dbc->Query($sql);
							while($district = $dbc->Fetch($rst)){
								$selected = $subdistrict['city']==$district['id']?" selected":"";
								echo '<option value="'.$district['id'].'"'.$selected.'>'.$district['name'].'</option>';
							}
						
						?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Name</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="txtName" placeholder="Subdistrict Name" value="<?php echo $subdistrict['name'];?>">
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