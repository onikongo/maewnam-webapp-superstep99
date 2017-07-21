
	fn.app.database.district.dialog_edit = function(id) {
		$.ajax({
			url: "apps/database/view/dialog.district.edit.php",
			data: {id:id},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				$('#dialog_edit_district').on('shown.bs.modal', function () {
					$("#txtName").focus();
				});
				$("#dialog_edit_district").on("hidden.bs.modal",function(){
					$(this).remove();
				});
				$("#dialog_edit_district").modal('show');
			}	
		});
	};
	
	fn.app.database.district.edit = function(){
		$.post('apps/database/xhr/action-edit-district.php',$('#form_editdistrict').serialize(),function(response){
			if(response.success){
				$("#tblDatabase").DataTable().draw();
				$("#dialog_edit_district").modal('hide');
			}else{
				fn.engine.alert("Alert",response.msg);
			}
			
		},'json');
		return false;
	};
