<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../include/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
?>
<div class="modal fade" id="dialog_add_user" data-backdrop="static">
  	<div class="modal-dialog modal-lg">
		<form id="form_adduser" class="form-horizontal" role="form" onsubmit="fn.app.accctrl.user.add();return false;">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4>Add User</h4>
      		</div>
		    <div class="modal-body">
				<div class="form-group">
					<label class="col-sm-2 control-label">Username</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="txtUsername" name="txtUsername">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Password</label>
					<div class="col-sm-10">
						<input type="password" class="form-control" id="txtPassword" name="txtPassword">
					</div>
				</div>
				
				
				<div class="form-group">
					<label class="col-sm-2 control-label">Name</label>
					<div class="col-sm-5">
						<input type="text" class="form-control" id="txtFirst" name="txtFirst" placeholder="Firstname">
					</div>
					<div class="col-sm-5">
						<input type="text" class="form-control" id="txtSurname" name="txtSurname" placeholder="Surname">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Title</label>
					<div class="col-sm-2">
						<select id="cbbTitle" name="cbbTitle" class="form-control">
							<option>Mr.</option>
							<option>Mrs.</option>
							<option>Miss.</option>
							<option>Ms.</option>
							<option>Mx.</option>
						</select>
					</div>
					<label class="col-sm-1 control-label">Gender</label>
					<div class="col-sm-2">
						<select id="cbbGender" name="cbbGender" class="form-control">
							<option value="male">Male</option>
							<option value="female">Female</option>
						</select>
					</div>
					<label for="txtName" class="col-sm-1 control-label">DOB</label>
					<div class="col-sm-4">
						<input type="date" class="form-control" id="txtDOB" name="txtDOB" placeholder="Date of Birth">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Group</label>
					<div class="col-sm-5">
						<select id="cbbGroup" name="cbbGroup" class="form-control">
						<?php
							$sql= "SELECT * FROM groups";
							$rst = $dbc->Query($sql);
							while($line = $dbc->Fetch($rst)){
								echo "<option value='$line[id]'>$line[name]</option>";
							}
						?>
						</select>
					</div>
					<label class="col-sm-1 control-label">Nick</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="txtNick" name="txtNick" placeholder="Nickname">
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-2 control-label">Phone</label>
					<div class="col-sm-4">
						<input type="tel" class="form-control" id="txtPhone" name="txtPhone" placeholder="Phone">
					</div>
					<label class="col-sm-1 control-label">Mobile</label>
					<div class="col-sm-5">
						<input type="tel" class="form-control" id="txtMobile" name="txtMobile" placeholder="Mobile">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">E-Mail</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="txtEmail" name="txtEmail" placeholder="E-Mail">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Address</label>
					<div class="col-sm-10">
						<textarea name="txtAddress" rows="2" class="form-control"></textarea>
					</div>
				</div>
	
				<div class="form-group">
					<label class="col-sm-2 control-label">Country</label>
					<div class="col-sm-10">
						<select id="cbbCountry" name="cbbCountry" class="form-control">
						
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Province</label>
					<div class="col-sm-4">
						<select id="cbbCity" name="cbbCity" class="form-control">
						
						</select>
					</div>
					<label class="col-sm-2 control-label">District</label>
					<div class="col-sm-4">
						<select id="cbbDistrict" name="cbbDistrict" class="form-control">
						
						</select>
						
					</div>
					
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Subdistrict</label>
					<div class="col-sm-4">
						<select id="cbbSubdistrict" name="cbbSubdistrict" class="form-control">
						
						</select>
					</div>
					<label class="col-sm-2 control-label">Postal</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="txtPostal" name="txtPostal" placeholder="Zip Code">
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