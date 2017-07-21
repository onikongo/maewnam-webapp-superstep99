<?php
	include_once "apps/geographic/view/dialog.district.add.php";
?>
<script style="text/javascript">
	fn.app.geographic.district.add = function(){
		$.post('apps/geographic/xhr/action-add-district.php',$('#form_adddistrict').serialize(),function(response){
			if(response.success){
				$("#tblDistrict").DataTable().draw();
				$("#dialog_add_district").modal('hide');
				$("#form_adddistrict")[0].reset();
			}else{
				fn.engine.alert("Alert",response.msg);
			}
		},'json');
		return false;
	};

	$("#geographic_district .itoolbar").append('<button id="btnAddDistrict" type="button" class="btn btn-primary pull-right">Add</button>');
	$("#btnAddDistrict").click(function(){
		$("#dialog_add_district").modal('show');
	});
	$('#dialog_add_district').on('shown.bs.modal', function () {
		$("#txtName").focus();
	});
</script>
