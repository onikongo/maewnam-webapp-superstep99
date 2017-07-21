<?php
	
?>
<div class="modal fade" id="dialog_add_video" data-backdrop="static">
  	<div class="modal-dialog">
		<form id="form_addvideo" class="form-horizontal" role="form" onSubmit="fn.app.video.add();return false;">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4>Add Video</h4>
      		</div>
		    <div class="modal-body">
				<div class="form-group">
					<label class="col-sm-2 control-label">name video</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="txtname" name="txtname">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">video link</label>
					<div class="col-sm-10">
                    	https://www.youtube.com/watch?v=<font color="#FF0000"><b>mk48xRzuNvA</b></font>
						<input type="text" class="form-control" id="linkvideo" name="linkvideo" placeholder="mk48xRzuNvA">
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
		$.post('apps/video/xhr/action-add.php',$('#form_addvideo').serialize(),function(response){
			if(response.success){
				$("#tbl").DataTable().draw();
				$("#dialog_add_video").modal('hide');
				$("#form_addvideo")[0].reset();
			}else{
				fn.engine.alert("Alert",response.msg);
			}
		},'json');
		return false;
	};
	$.extend(fn.app.video,{add:func});
	
	/*var address = {
		initial : function(country,province,district,subsitrict){
		
			$(country).change(function(){
				fn.app.contact.customer.address.load_city(province,$(this).val());
			});
			
			$(province).change(function(){
				fn.app.contact.customer.address.load_district(district,$(this).val());
			});
			
			$(district).change(function(){
				fn.app.contact.customer.address.load_subdistrict(subsitrict,$(this).val());
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
		},*/
		/*load_city : function(combobox,country){
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
		},*/
		/*load_district : function(combobox,city){
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
		},*/
		/*load_subdistrict : function(combobox,district){
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
	$.extend(fn.app.contact.customer,{address:address});*/
	
	$("#panel-head-group").append('<button id="btnAdd" type="button" class="btn btn-primary pull-right">Add</button>');
	$("#btnAdd").click(function(){
		$("#dialog_add_video").modal('show');
	});
	$('#dialog_add_video').on('shown.bs.modal', function () {
		$("#txtName").focus();
	});
	
	/*fn.app.contact.customer.address.initial(
		"#form_addcustomer #cbbCountry",
		"#form_addcustomer #cbbCity",
		"#form_addcustomer #cbbDistrict",
		"#form_addcustomer #cbbSubdistrict");
	fn.app.contact.customer.address.load_country("#form_addcustomer #cbbCountry");*/
	
});	

</script>
