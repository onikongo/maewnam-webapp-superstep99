
	fn.app.database.country.dialog_edit = function(id) {
		$.ajax({
			url: "apps/database/view/dialog.country.edit.php",
			data: {id:id},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				$('#dialog_edit_country').on('shown.bs.modal', function () {
					$("#txtName").focus();
				});
				$("#dialog_edit_country").on("hidden.bs.modal",function(){
					$(this).remove();
				});
				$("#dialog_edit_country").modal('show');
			}	
		});
	};
	
	fn.app.database.country.edit = function(){
		$.post('apps/database/xhr/action-edit-country.php',$('#form_editcountry').serialize(),function(response){
			if(response.success){
				$("#tblDatabase").DataTable().draw();
				$("#dialog_edit_country").modal('hide');
			}else{
				fn.engine.alert("Alert",response.msg);
			}
			
		},'json');
		return false;
	};
