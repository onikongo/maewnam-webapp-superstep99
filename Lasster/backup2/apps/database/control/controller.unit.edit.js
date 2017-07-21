
	fn.app.database.unit.dialog_edit = function(id) {
		$.ajax({
			url: "apps/database/view/dialog.unit.edit.php",
			data: {id:id},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				$('#dialog_edit_unit').on('shown.bs.modal', function () {
					$("#txtName").focus();
				});
				$("#dialog_edit_unit").on("hidden.bs.modal",function(){
					$(this).remove();
				});
				$("#dialog_edit_unit").modal('show');
			}	
		});
	};
	
	fn.app.database.unit.edit = function(){
		$.post('apps/database/xhr/action-edit-unit.php',$('#form_editunit').serialize(),function(response){
			if(response.success){
				$("#tblDatabase").DataTable().draw();
				$("#dialog_edit_unit").modal('hide');
			}else{
				fn.engine.alert("Alert",response.msg);
			}
			
		},'json');
		return false;
	};
