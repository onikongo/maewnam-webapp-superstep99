<?php
	include_once "apps/accctrl/view/dialog.user.add.php";
?>
<script style="text/javascript">
	fn.app.accctrl.user.add = function(){
		$.post('apps/accctrl/xhr/action-add-user.php',$('#form_adduser').serialize(),function(response){
			if(response.success){
				$("#tblUser").DataTable().draw();
				$("#dialog_add_user").modal('hide');
				$("#form_adduser")[0].reset();
			}else{
				fn.engine.alert("Alert",response.msg);
			}
		},'json');
		return false;
	};

	$("#accctrl_user .itoolbar").append('<button id="btnAddUser" type="button" class="btn btn-primary pull-right">Add</button>');
	$("#btnAddUser").click(function(){
		$("#dialog_add_user").modal('show');
	});
	$('#dialog_add_user').on('shown.bs.modal', function () {
		$("#txtName").focus();
	});
</script>
