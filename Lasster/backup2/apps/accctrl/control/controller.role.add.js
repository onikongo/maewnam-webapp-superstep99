
	fn.app.accctrl.role.dialog_add = function() {
		$.ajax({
			url: "apps/accctrl/view/dialog.role.add.php",
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				$("#dialog_add_role").on("hidden.bs.modal",function(){
					$(this).remove();
				});
				$('#dialog_add_role').on('shown.bs.modal', function () {
					$("#txtName").focus();
				});
				$("#dialog_add_role").modal('show');
       
			}	
		});
	};

	fn.app.accctrl.role.add = function(){
		$.post('apps/accctrl/xhr/action-add-role.php',$('#form_addrole').serialize(),function(response){
			if(response.success){
				$("#tblRole").DataTable().draw();
				$("#dialog_add_role").modal('hide');
				$("#form_addrole")[0].reset();
			}else{
				fn.engine.alert("Alert",response.msg);
			}
		},'json');
		return false;
	};
	$(".dataTables_filter").prepend('<a class="btn btn-primary pull-right" onclick="fn.app.accctrl.role.dialog_add()">Add</a>');
