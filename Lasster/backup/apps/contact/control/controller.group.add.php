<?php
	include_once "apps/contact/view/dialog.group.add.php";
?>
<script style="text/javascript">
	fn.app.contact.group.add = function(){
		$.post('apps/contact/xhr/action-add-group.php',$('#form_addgroup').serialize(),function(response){
			if(response.success){
				$("#tblGroup").DataTable().draw();
				$("#dialog_add_group").modal('hide');
				$("#form_addgroup")[0].reset();
			}else{
				fn.engine.alert("Alert",response.msg);
			}
		},'json');
		return false;
	};

	$("#contact_group .itoolbar").append('<button id="btnAddGroup" type="button" class="btn btn-primary pull-right">Add</button>');
	$("#btnAddGroup").click(function(){
		$("#dialog_add_group").modal('show');
	});
	$('#dialog_add_group').on('shown.bs.modal', function () {
		$("#txtName").focus();
	});
</script>
