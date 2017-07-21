
	fn.app.accctrl.group.dialog_edit = function(id) {
		$.ajax({
			url: "apps/accctrl/view/dialog.group.edit.php",
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
	
	fn.app.accctrl.group.edit = function(){
		$.post('apps/accctrl/xhr/action-edit-group.php',$('#form_editgroup').serialize(),function(response){
			if(response.success){
				$("#tblGroup").DataTable().draw();
				$("#dialog_edit_group").modal('hide');
			}else{
				fn.engine.alert("Alert",response.msg);
			}
			
		},'json');
		return false;
	};
