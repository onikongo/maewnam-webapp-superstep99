<?php
	include_once "apps/geographic/view/dialog.city.add.php";
?>
<script style="text/javascript">
	fn.app.geographic.city.add = function(){
		$.post('apps/geographic/xhr/action-add-city.php',$('#form_addcity').serialize(),function(response){
			if(response.success){
				$("#tblCity").DataTable().draw();
				$("#dialog_add_city").modal('hide');
				$("#form_addcity")[0].reset();
			}else{
				fn.engine.alert("Alert",response.msg);
			}
		},'json');
		return false;
	};

	$("#geographic_city .itoolbar").append('<button id="btnAddCity" type="button" class="btn btn-primary pull-right">Add</button>');
	$("#btnAddCity").click(function(){
		$("#dialog_add_city").modal('show');
	});
	$('#dialog_add_city').on('shown.bs.modal', function () {
		$("#txtName").focus();
	});
</script>
