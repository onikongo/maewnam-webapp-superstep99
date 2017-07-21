<?php
	
?>
<script tyle="text/javascript">
	fn.app.contact.group.change = function(id) {
		$.ajax({
			url: "apps/contact/view/dialog.group.edit.php",
			data: {id:id},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				
				$('#dialog_edit_group').on('shown.bs.modal', function () {
					$("#txtName").focus();
				});
				$("#dialog_edit_group").on("hidden.bs.modal",function(){
					$(this).remove();
				});
				$("#dialog_edit_group").modal('show');
			}	
		});
	};
	
	fn.app.contact.group.save_change = function(){
		$.post('apps/contact/xhr/action-edit-group.php',$('#form_editgroup').serialize(),function(response){
			if(response.success){
				$("#tblGroup").DataTable().draw();
				$("#dialog_edit_group").modal('hide');
			}else{
				fn.engine.alert("Alert",response.msg);
			}
			
		},'json');
		return false;
	};
</script>
