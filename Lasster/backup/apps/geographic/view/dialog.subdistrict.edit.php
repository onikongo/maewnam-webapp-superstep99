<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$subdistrict = $dbc->GetRecord("subdistricts","*","id=".$_REQUEST['id']);
	$district = $dbc->GetRecord("districts","*","id=".$subdistrict['district']);
	$city = $dbc->GetRecord("cities","*","id=".$district['city']);
?>
<div class="modal fade" id="dialog_edit_subdistrict" data-backdrop="static">
  	<div class="modal-dialog">
		<form id="form_editsubdistrict" class="form-horizontal" role="form" onsubmit="fn.app.geographic.subdistrict.save_change();return false;">
		<input type="hidden" name="txtID" value="<?php echo $subdistrict['id'];?>">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4>Edit District</h4>
      		</div>
		    <div class="modal-body">
				<div class="form-group">
					<label for="cbbCountry" class="col-sm-2 control-label">Country</label>
					<div class="col-sm-10">
						<select class="form-control" id="cbbCountry" name="cbbCountry">
						<?php
							$sql = "SELECT * FROM countries";
							$rst = $dbc->Query($sql);
							while($line = $dbc->Fetch($rst)){
								echo '<option value="'.$line['id'].'"'.($line['id']==$country['id']?" selected":"").'>'.$line['name'].'</option>';
							}
						?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="cbbCity" class="col-sm-2 control-label">City</label>
					<div class="col-sm-10">
						<select class="form-control" id="cbbCity" name="cbbCity">
						<?php
							$sql = "SELECT * FROM cities";
							$rst = $dbc->Query($sql);
							while($line = $dbc->Fetch($rst)){
								echo '<option value="'.$line['id'].'"'.($line['id']==$city['id']?" selected":"").'>'.$line['name'].'</option>';
							}
						?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="cbbDistrict" class="col-sm-2 control-label">District</label>
					<div class="col-sm-10">
						<select class="form-control" id="cbbDistrict" name="cbbDistrict">
						<?php
							$sql = "SELECT * FROM districts";
							$rst = $dbc->Query($sql);
							while($line = $dbc->Fetch($rst)){
								echo '<option value="'.$line['id'].'"'.($line['id']==$district['id']?" selected":"").'>'.$line['name'].'</option>';
							}
						?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="txtName" class="col-sm-2 control-label">Subdistrict</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="txtName" name="txtName" placeholder="District Name" value="<?php echo $subdistrict['name'];?>">
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
	$('#dialog_edit_subdistrict').on('shown.bs.modal', function () {
		$("#txtName").focus();
	});
	$("#dialog_edit_subdistrict").on("hidden.bs.modal",function(){
		$(this).remove();
	});
	$("#dialog_edit_subdistrict").modal('show');
	
	var address = {
		initial : function(country,province,district){
		
			$(country).change(function(){
				fn.app.geographic.subdistrict.address.load_city(province,$(this).val());
			});
			
			$(province).change(function(){
				fn.app.geographic.subdistrict.address.load_district(district,$(this).val());
			});
			
			
		},
		load_country : function(combobox){
			$.ajax({
				url: "apps/geographic/store/store-country.php",
				type: "POST",dataType: "json",
				success: function(json){
					$(combobox).html("");
					for(i in json.aaData){
						$(combobox).append('<option value="' + json.aaData[i][0] + '">' + json.aaData[i][3] + '</option>');
					}
					$(combobox).val(213);
					$(combobox).change();
				}
			});
		},
		load_city : function(combobox,country){
			$.ajax({
				url: "apps/geographic/store/store-city.php",
				type: "POST",
				data: {filter : "country = " + country},
				dataType: "json",
				success: function(json){
					$(combobox).html("");
					for(i in json.aaData){
						$(combobox).append('<option value="' + json.aaData[i][0] + '">' + json.aaData[i][3] + '</option>');
					}
					$(combobox).change();
				}
			});
		},
		load_district : function(combobox,city){
			$.ajax({
				url: "apps/geographic/store/store-district.php",
				type: "POST",
				data: {filter : "city = " + city},
				dataType: "json",
				success: function(json){
					$(combobox).html("");
					for(i in json.aaData){
						$(combobox).append('<option value="' + json.aaData[i][0] + '">' + json.aaData[i][3] + '</option>');
					}
					$(combobox).change();
				}
			});
		}
	}
	$.extend(fn.app.geographic.subdistrict,{address:address});
	
	fn.app.geographic.subdistrict.address.initial(
		"#form_editsubdistrict #cbbCountry",
		"#form_editsubdistrict #cbbCity",
		"#form_editsubdistrict #cbbDistrict");
});	
</script>
