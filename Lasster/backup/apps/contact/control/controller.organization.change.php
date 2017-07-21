<?php
	
?>
<script tyle="text/javascript">
	fn.app.contact.organization.change = function(id) {
		$.ajax({
			url: "apps/contact/view/dialog.organization.edit.php",
			data: {id:id},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				$('#dialog_edit_organization').on('shown.bs.modal', function () {
					$("#txtName").focus();
				});
				$("#dialog_edit_organization").on("hidden.bs.modal",function(){
					$(this).remove();
				});
				$("#dialog_edit_organization").modal('show');
			}	
		});
	};
	
	fn.app.contact.organization.save_change = function(){
		$.post('apps/contact/xhr/action-edit-organization.php',$('#form_editorganization').serialize(),function(response){
			if(response.success){
				$("#tblOrganization").DataTable().draw();
				$("#dialog_edit_organization").modal('hide');
			}else{
				fn.engine.alert("Alert",response.msg);
			}
			
		},'json');
		return false;
	};
</script>
