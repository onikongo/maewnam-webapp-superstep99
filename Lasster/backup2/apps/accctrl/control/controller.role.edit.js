
	fn.app.accctrl.role.dialog_edit = function(id) {
		$.ajax({
			url: "apps/accctrl/view/dialog.role.edit.php",
			data: {id:id},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				$('#dialog_edit_role').on('shown.bs.modal', function () {
					$("#txtName").focus();
				});
				$("#dialog_edit_role").on("hidden.bs.modal",function(){
					$(this).remove();
				});
				$("#dialog_edit_role").modal('show');
				
			}	
		});
	};
	
	fn.app.accctrl.role.edit = function(){
		$.post('apps/accctrl/xhr/action-edit-role.php',$('#form_editrole').serialize(),function(response){
			if(response.success){
				$("#tblRole").DataTable().draw();
				$("#dialog_edit_role").modal('hide');
			}else{
				fn.engine.alert("Alert",response.msg);
			}
			
		},'json');
		return false;
	};
	
