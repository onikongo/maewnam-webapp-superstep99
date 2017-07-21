
	fn.app.database.industry.dialog_edit = function(id) {
		$.ajax({
			url: "apps/database/view/dialog.industry.edit.php",
			data: {id:id},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				$('#dialog_edit_industry').on('shown.bs.modal', function () {
					$("#txtName").focus();
				});
				$("#dialog_edit_industry").on("hidden.bs.modal",function(){
					$(this).remove();
				});
				$("#dialog_edit_industry").modal('show');
			}	
		});
	};
	
	fn.app.database.industry.edit = function(){
		$.post('apps/database/xhr/action-edit-industry.php',$('#form_editindustry').serialize(),function(response){
			if(response.success){
				$("#tblDatabase").DataTable().draw();
				$("#dialog_edit_industry").modal('hide');
			}else{
				fn.engine.alert("Alert",response.msg);
			}
			
		},'json');
		return false;
	};
