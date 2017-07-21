<?php
	include_once "apps/contact/view/dialog.organization.add.php";
?>
<script style="text/javascript">
	fn.app.contact.organization.add = function(){
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

	$("#contact_organization .itoolbar").append('<button id="btnAddOrganization" type="button" class="btn btn-primary pull-right">Add</button>');
	$("#btnAddOrganization").click(function(){
		$("#dialog_add_organization").modal('show');
	});
	$('#dialog_add_organization').on('shown.bs.modal', function () {
		$("#txtName").focus();
	});
</script>
