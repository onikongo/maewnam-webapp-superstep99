
	fn.app.database.city.dialog_edit = function(id) {
		$.ajax({
			url: "apps/database/view/dialog.city.edit.php",
			data: {id:id},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				$('#dialog_edit_city').on('shown.bs.modal', function () {
					$("#txtName").focus();
				});
				$("#dialog_edit_city").on("hidden.bs.modal",function(){
					$(this).remove();
				});
				$("#dialog_edit_city").modal('show');
				$("select[name=cbbCountry]").select2({width:"100%"});
			}	
		});
	};
	
	fn.app.database.city.edit = function(){
		$.post('apps/database/xhr/action-edit-city.php',$('#form_editcity').serialize(),function(response){
			if(response.success){
				$("#tblDatabase").DataTable().draw();
				$("#dialog_edit_city").modal('hide');
			}else{
				fn.engine.alert("Alert",response.msg);
			}
			
		},'json');
		return false;
	};
