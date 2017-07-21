<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$organization = $dbc->GetRecord("organizations","*","id=".$_REQUEST['id']);
	$address = $dbc->GetRecord("address","*","organization=".$organization['id']);
?>
<div class="modal fade" id="dialog_edit_organization" data-backdrop="static">
  	<div class="modal-dialog">
		<form id="form_editorganization" class="form-horizontal" role="form" onsubmit="fn.app.contact.organization.save_change();return false;">
		<input type="hidden" name="txtOrganizationID" value="<?php echo $organization['id'];?>">
		<input type="hidden" name="txtAddressID" value="<?php echo $address['id'];?>">
    	<div class="modal-content">
			
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4>Edit Organization</h4>
      		</div>
		    <div class="modal-body">
				<div class="form-group">
					<label class="col-sm-2 control-label">Name</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="txtName" name="txtName" value="<?php echo $organization['name'];?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Type</label>
					<div class="col-sm-4">
						<select id="cbbType" name="cbbType" class="form-control">
							<option<?php if($organization['type']=="Public Company")echo" selected"?>>Public Company</option>
							<option<?php if($organization['type']=="Limited Company")echo" selected"?>>Limited Company</option>
							<option<?php if($organization['type']=="Limited Partnership")echo" selected"?>>Limited Partnership</option>
							<option<?php if($organization['type']=="General Partnership")echo" selected"?>>General Partnership</option>
							<option<?php if($organization['type']=="Non-government Organization")echo" selected"?>>Non-government Organization</option>
							<option<?php if($organization['type']=="Union")echo" selected"?>>Union</option>
							<option<?php if($organization['type']=="Other")echo" selected"?>>Other</option>
						</select>
					</div>
					<label class="col-sm-2 control-label">Tax ID</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="txtTaxID" name="txtTaxID" value="<?php echo $organization['taxid'];?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Industry</label>
					<div class="col-sm-10">
						<select id="cbbIndustry" name="cbbIndustry" class="form-control">
						<?php
							$sql= "SELECT * FROM industries";
							$rst = $dbc->Query($sql);
							while($line = $dbc->Fetch($rst)){
								$selected = $line['id']==$organization['industry']?" selected":"";
								echo "<option value='$line[id]'$selected>$line[name]</option>";
							}
						?>
						</select>
					</div>
					
				</div>
				
				<div class="form-group">
					<label class="col-sm-2 control-label">Phone</label>
					<div class="col-sm-4">
						<input type="tel" class="form-control" id="txtPhone" name="txtPhone" placeholder="Phone" value="<?php echo $organization['phone'];?>">
					</div>
					<label class="col-sm-1 control-label">Fax</label>
					<div class="col-sm-5">
						<input type="tel" class="form-control" id="txtFax" name="txtFax" placeholder="Fax" value="<?php echo $organization['fax'];?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">E-Mail</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="txtEmail" name="txtEmail" placeholder="E-Mail" value="<?php echo $organization['email'];?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Website</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="txtWebsite" name="txtWebsite" placeholder="Website" value="<?php echo $organization['website'];?>">
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-2 control-label">Address</label>
					<div class="col-sm-10">
						<textarea name="txtAddress" rows="2" class="form-control"><?php echo $address['address'];?></textarea>
					</div>
				</div>
	
				<div class="form-group">
					<label class="col-sm-2 control-label">Country</label>
					<div class="col-sm-10">
						<select id="cbbCountry" name="cbbCountry" class="form-control">
						<?php
							$sql= "SELECT * FROM countries";
							$rst = $dbc->Query($sql);
							while($line = $dbc->Fetch($rst)){
								$selected = $line['id']==$address['country']?" selected":"";
								echo "<option value='$line[id]'$selected>$line[name]</option>";
							}
						?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Province</label>
					<div class="col-sm-4">
						<select id="cbbCity" name="cbbCity" class="form-control">
						<?php
							$sql= "SELECT * FROM cities WHERE country =  ".$address['country'];
							$rst = $dbc->Query($sql);
							while($line = $dbc->Fetch($rst)){
								$selected = $line['id']==$address['city']?" selected":"";
								echo "<option value='$line[id]'$selected>$line[name]</option>";
							}
						?>
						</select>
					</div>
					<label class="col-sm-2 control-label">District</label>
					<div class="col-sm-4">
						<select id="cbbDistrict" name="cbbDistrict" class="form-control">
						<?php
							$sql= "SELECT * FROM districts WHERE city =  ".$address['city'];
							$rst = $dbc->Query($sql);
							while($line = $dbc->Fetch($rst)){
								$selected = $line['id']==$address['district']?" selected":"";
								echo "<option value='$line[id]'$selected>$line[name]</option>";
							}
						?>
						</select>
						
					</div>
					
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Subdistrict</label>
					<div class="col-sm-4">
						<select id="cbbSubdistrict" name="cbbSubdistrict" class="form-control">
						<?php
							$sql= "SELECT * FROM subdistricts WHERE district =  ".$address['district'];
							$rst = $dbc->Query($sql);
							while($line = $dbc->Fetch($rst)){
								$selected = $line['id']==$address['subdistrict']?" selected":"";
								echo "<option value='$line[id]'$selected>$line[name]</option>";
							}
						?>
						</select>
					</div>
					<label class="col-sm-2 control-label">Postal</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="txtPostal" name="txtPostal" placeholder="Zip Code" value="<?php echo $address['postal']?>">
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
<script tyle="text/javascript">
$(function(){
	
	$('#dialog_edit_organization').on('shown.bs.modal', function () {
		$("#txtName").focus();
	});
	$("#dialog_edit_organization").on("hidden.bs.modal",function(){
		$(this).remove();
	});
	$("#dialog_edit_organization").modal('show');
	
	var address = {
		initial : function(country,province,district,subsitrict){
		
			$(country).change(function(){
				fn.app.contact.organization.address.load_city(province,$(this).val());
			});
			
			$(province).change(function(){
				fn.app.contact.organization.address.load_district(district,$(this).val());
			});
			
			$(district).change(function(){
				fn.app.contact.organization.address.load_subdistrict(subsitrict,$(this).val());
			});
		},
		load_country : function(combobox){
			$.ajax({
				url: "apps/contact/store/store-country.php",
				type: "POST",dataType: "json",
				success: function(json){
					$(combobox).html("");
					for(i in json.aaData){
						$(combobox).append('<option value="' + json.aaData[i][0] + '">' + json.aaData[i][1] + '</option>');
					}
					$(combobox).val(213);
					$(combobox).change();
				}
			});		},
		load_city : function(combobox,country){
			$.ajax({
				url: "apps/contact/store/store-city.php",
				type: "POST",
				data: {filter : "country = " + country},
				dataType: "json",
				success: function(json){
					$(combobox).html("");
					for(i in json.aaData){
						$(combobox).append('<option value="' + json.aaData[i][0] + '">' + json.aaData[i][1] + '</option>');
					}
					$(combobox).change();
				}
			});
		},
		load_district : function(combobox,city){
			$.ajax({
				url: "apps/contact/store/store-district.php",
				type: "POST",
				data: {filter : "city = " + city},
				dataType: "json",
				success: function(json){
					$(combobox).html("");
					for(i in json.aaData){
						$(combobox).append('<option value="' + json.aaData[i][0] + '">' + json.aaData[i][1] + '</option>');
					}
					$(combobox).change();
				}
			});
		},
		load_subdistrict : function(combobox,district){
			$.ajax({
				url: "apps/contact/store/store-subdistrict.php",
				type: "POST",
				data: {filter : "district = " + district},
				dataType: "json",
				success: function(json){
					$(combobox).html("");
					for(i in json.aaData){
						$(combobox).append('<option value="' + json.aaData[i][0] + '">' + json.aaData[i][1] + '</option>');
					}
				}
			});
		}
	}
	$.extend(fn.app.contact.organization,{address:address});
	
	fn.app.contact.organization.address.initial(
		"#form_editorganization #cbbCountry",
		"#form_editorganization #cbbCity",
		"#form_editorganization #cbbDistrict",
		"#form_editorganization #cbbSubdistrict");
	
	
});	
</script>
