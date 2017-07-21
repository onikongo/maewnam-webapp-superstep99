
	fn.app.accctrl.user.dialog_edit = function(id) {
		$.ajax({
			url: "apps/accctrl/view/dialog.user.edit.php",
			data: {id:id},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				$('#dialog_edit_user').on('shown.bs.modal', function () {
					$("#txtName").focus();
				});
				$("#dialog_edit_user").on("hidden.bs.modal",function(){
					$(this).remove();
				});
				$("#dialog_edit_user").modal('show');
				
				fn.app.accctrl.address.initial(
					"#form_edituser #cbbCountry",
					"#form_edituser #cbbCity",
					"#form_edituser #cbbDistrict",
					"#form_edituser #cbbSubdistrict");
			}	
		});
	};
	
	fn.app.accctrl.user.edit = function(){
		$.post('apps/accctrl/xhr/action-edit-user.php',$('#form_edituser').serialize(),function(response){
			if(response.success){
				$("#tblUser").DataTable().draw();
				$("#dialog_edit_user").modal('hide');
			}else{
				fn.engine.alert("Alert",response.msg);
			}
			
		},'json');
		return false;
	};
