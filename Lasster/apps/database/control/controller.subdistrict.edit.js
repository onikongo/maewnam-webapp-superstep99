
	fn.app.database.subdistrict.dialog_edit = function(id) {
		$.ajax({
			url: "apps/database/view/dialog.subdistrict.edit.php",
			data: {id:id},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				$('#dialog_edit_subdistrict').on('shown.bs.modal', function () {
					$("#txtName").focus();
				});
				$("#dialog_edit_subdistrict").on("hidden.bs.modal",function(){
					$(this).remove();
				});
				$("#dialog_edit_subdistrict").modal('show');
			}	
		});
	};
	
	fn.app.database.subdistrict.edit = function(){
		$.post('apps/database/xhr/action-edit-subdistrict.php',$('#form_editsubdistrict').serialize(),function(response){
			if(response.success){
				$("#tblDatabase").DataTable().draw();
				$("#dialog_edit_subdistrict").modal('hide');
			}else{
				fn.engine.alert("Alert",response.msg);
			}
			
		},'json');
		return false;
	};
