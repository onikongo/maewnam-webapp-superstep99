<?php
	
?>
<div class="modal fade" id="dialog_add_subdistrict" data-backdrop="static">
  	<div class="modal-dialog">
		<form id="form_addsubdistrict" class="form-horizontal" role="form" onsubmit="fn.app.geographic.subdistrict.add();return false;">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4>Add Subdistrict</h4>
      		</div>
		    <div class="modal-body">
				<div class="form-group">
					<label for="cbbCountry" class="col-sm-2 control-label">Country</label>
					<div class="col-sm-10">
						<select class="form-control" id="cbbCountry" name="cbbCountry">
						
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="cbbCity" class="col-sm-2 control-label">City</label>
					<div class="col-sm-10">
						<select class="form-control" id="cbbCity" name="cbbCity">
						
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="cbbDistrict" class="col-sm-2 control-label">District</label>
					<div class="col-sm-10">
						<select class="form-control" id="cbbDistrict" name="cbbDistrict">
						
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="txtName" class="col-sm-2 control-label">Name</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="txtName" name="txtName" placeholder="Subdistrict Name">
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
		"#form_addsubdistrict #cbbCountry",
		"#form_addsubdistrict #cbbCity",
		"#form_addsubdistrict #cbbDistrict");
	fn.app.geographic.subdistrict.address.load_country("#form_addsubdistrict #cbbCountry");
	
});	

</script>
