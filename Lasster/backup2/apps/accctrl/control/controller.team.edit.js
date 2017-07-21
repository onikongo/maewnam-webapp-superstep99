
	fn.app.accctrl.team.dialog_edit = function(id) {
		$.ajax({
			url: "apps/accctrl/view/dialog.team.edit.php",
			data: {id:id},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				$('#dialog_edit_team').on('shown.bs.modal', function () {
					$("#txtName").focus();
				});
				$("#dialog_edit_team").on("hidden.bs.modal",function(){
					$(this).remove();
				});
				$("#dialog_edit_team").modal('show');
				
			}	
		});
	};
	
	fn.app.accctrl.team.edit = function(){
		$.post('apps/accctrl/xhr/action-edit-team.php',$('#form_editteam').serialize(),function(response){
			if(response.success){
				$("#tblTeam").DataTable().draw();
				$("#dialog_edit_team").modal('hide');
			}else{
				fn.engine.alert("Alert",response.msg);
			}
			
		},'json');
		return false;
	};
