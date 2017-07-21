
	fn.app.accctrl.group.dialog_add = function() {
		$.ajax({
			url: "apps/accctrl/view/dialog.group.add.php",
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				$("#dialog_add_group").on("hidden.bs.modal",function(){
					$(this).remove();
				});
				$('#dialog_add_group').on('shown.bs.modal', function () {
					$("#txtName").focus();
				});
				$("#dialog_add_group").modal('show');
			}	
		});
	};

	fn.app.accctrl.group.add = function(){
		$.post('apps/accctrl/xhr/action-add-group.php',$('#form_addgroup').serialize(),function(response){
			if(response.success){
				$("#tblGroup").DataTable().draw();
				$("#dialog_add_group").modal('hide');
				$("#form_addgroup")[0].reset();
			}else{
				fn.engine.alert("Alert",response.msg);
			}
		},'json');
		return false;
	};

	$(".dataTables_filter").prepend('<a class="btn btn-primary pull-right" onclick="fn.app.accctrl.group.dialog_add()">Add</a>');
