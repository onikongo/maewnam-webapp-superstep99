<?php
	include_once "apps/geographic/view/dialog.country.add.php";
?>
<script style="text/javascript">
	fn.app.geographic.country.add = function(){
		$.post('apps/geographic/xhr/action-add-country.php',$('#form_addcountry').serialize(),function(response){
			if(response.success){
				$("#tblCountry").DataTable().draw();
				$("#dialog_add_country").modal('hide');
				$("#form_addcountry")[0].reset();
			}else{
				fn.engine.alert("Alert",response.msg);
			}
		},'json');
		return false;
	};

	$("#geographic_country .itoolbar").append('<button id="btnAddCountry" type="button" class="btn btn-primary pull-right">Add</button>');
	$("#btnAddCountry").click(function(){
		$("#dialog_add_country").modal('show');
	});
	$('#dialog_add_country').on('shown.bs.modal', function () {
		$("#txtName").focus();
	});
</script>
