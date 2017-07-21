
	fn.app.accctrl.team.dialog_add = function() {
		$.ajax({
			url: "apps/accctrl/view/dialog.team.add.php",
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				$("#dialog_add_team").on("hidden.bs.modal",function(){
					$(this).remove();
				});
				$('#dialog_add_team').on('shown.bs.modal', function () {
					$("#txtName").focus();
				});
				$("#dialog_add_team").modal('show');
       
			}	
		});
	};

	fn.app.accctrl.team.add = function(){
		$.post('apps/accctrl/xhr/action-add-team.php',$('#form_addteam').serialize(),function(response){
			if(response.success){
				$("#tblTeam").DataTable().draw();
				$("#dialog_add_team").modal('hide');
				$("#form_addteam")[0].reset();
			}else{
				fn.engine.alert("Alert",response.msg);
			}
		},'json');
		return false;
	};
	
	$(".dataTables_filter").prepend('<a class="btn btn-primary pull-right" onclick="fn.app.accctrl.team.dialog_add()">Add</a>');

	
