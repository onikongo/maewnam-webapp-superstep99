<?php
	
?>
<div class="modal fade" id="dialog_add_organization" data-backdrop="static">
  	<div class="modal-dialog">
		<form id="form_addorganization" class="form-horizontal" role="form" onsubmit="fn.app.contact.organization.add();return false;">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4>Add Organization</h4>
      		</div>
		    <div class="modal-body">
				<div class="form-group">
					<label class="col-sm-2 control-label">Name</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="txtName" name="txtName">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Type</label>
					<div class="col-sm-4">
						<select id="cbbType" name="cbbType" class="form-control">
							<option>Public Company</option>
							<option>Limited Company</option>
							<option>Limited Partnership</option>
							<option>General Partnership</option>
							<option>Non-government Organization</option>
							<option>Union</option>
							<option>Other</option>
						</select>
					</div>
					<label class="col-sm-2 control-label">Tax ID</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="txtTaxID" name="txtTaxID">
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
								echo "<option value='$line[id]'>$line[name]</option>";
							}
						?>
						</select>
					</div>
					
				</div>
				
				<div class="form-group">
					<label class="col-sm-2 control-label">Phone</label>
					<div class="col-sm-4">
						<input type="tel" class="form-control" id="txtPhone" name="txtPhone" placeholder="Phone">
					</div>
					<label class="col-sm-1 control-label">Fax</label>
					<div class="col-sm-5">
						<input type="tel" class="form-control" id="txtFax" name="txtFax" placeholder="Fax">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">E-Mail</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="txtEmail" name="txtEmail" placeholder="E-Mail">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Website</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="txtWebsite" name="txtWebsite" placeholder="Website">
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
	  	</div><!-- /.modal-content -->
		</form>
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script tyle="text/javascript">
$(function(){
	var func = function(){
		$.post('apps/contact/xhr/action-add-organization.php',$('#form_addorganization').serialize(),function(response){
			if(response.success){
				$("#tblOrganization").DataTable().draw();
				$("#dialog_add_organization").modal('hide');
				$("#form_addorganization")[0].reset();
			}else{
				fn.engine.alert("Alert",response.msg);
			}
		},'json');
		return false;
	};
	$.extend(fn.app.contact.organization,{add:func});
	
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
					$(combobox).val(218);
					$(combobox).change();
				}
			});
		},
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
	
	$("#panel-head-group").append('<button id="btnAddOrganization" type="button" class="btn btn-primary pull-right">Add</button>');
	$("#btnAddOrganization").click(function(){
		$("#dialog_add_organization").modal('show');
	});
	$('#dialog_add_organization').on('shown.bs.modal', function () {
		$("#txtName").focus();
	});
	
	fn.app.contact.organization.address.initial(
		"#form_addorganization #cbbCountry",
		"#form_addorganization #cbbCity",
		"#form_addorganization #cbbDistrict",
		"#form_addorganization #cbbSubdistrict");
	fn.app.contact.organization.address.load_country("#form_addorganization #cbbCountry");
	
});	

</script>
