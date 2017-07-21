<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$district = $dbc->GetRecord("districts","*","id=".$_REQUEST['id']);
	$city = $dbc->GetRecord("cities","*","id=".$district['city']);
	$country = $dbc->GetRecord("countries","*","id=".$city['country']);
?>
<div class="modal fade" id="dialog_edit_district" data-backdrop="static">
  	<div class="modal-dialog">
		<form id="form_editdistrict" class="form-horizontal" role="form" onsubmit="fn.app.geographic.district.save_change();return false;">
		<input type="hidden" name="txtID" value="<?php echo $district['id'];?>">
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
							$sql = "SELECT * FROM cities WHERE country = ".$country['id'];
							$rst = $dbc->Query($sql);
							while($line = $dbc->Fetch($rst)){
								echo '<option value="'.$line['id'].'"'.($line['id']==$city['id']?" selected":"").'>'.$line['name'].'</option>';
							}
						?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="txtName" class="col-sm-2 control-label">Name</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="txtName" name="txtName" placeholder="District Name" value="<?php echo $district['name'];?>">
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
	$('#dialog_edit_district').on('shown.bs.modal', function () {
		$("#txtName").focus();
	});
	$("#dialog_edit_district").on("hidden.bs.modal",function(){
		$(this).remove();
	});
	$("#dialog_edit_district").modal('show');
	
	var address = {
		initial : function(country,province){
		
			$(country).change(function(){
				fn.app.geographic.district.address.load_city(province,$(this).val());
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
		}
	}
	
	fn.app.geographic.district.address.initial(
		"#form_editdistrict #cbbCountry",
		"#form_editdistrict #cbbCity");
});	
</script>
