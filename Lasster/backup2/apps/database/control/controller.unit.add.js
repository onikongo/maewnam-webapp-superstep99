
	fn.app.database.unit.dialog_add = function() {
		$.ajax({
			url: "apps/database/view/dialog.unit.add.php",
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				$("#dialog_add_unit").on("hidden.bs.modal",function(){
					$(this).remove();
				});
				$('#dialog_add_unit').on('shown.bs.modal', function () {
					$("#txtName").focus();
				});
				$("#dialog_add_unit").modal('show');
			}	
		});
	};

	fn.app.database.unit.add = function(){
		$.post('apps/database/xhr/action-add-unit.php',$('#form_addunit').serialize(),function(response){
			if(response.success){
				$("#tblDatabase").DataTable().draw();
				$("#dialog_add_unit").modal('hide');
				$("#form_addunit")[0].reset();
			}else{
				fn.engine.alert("Alert",response.msg);
			}
		},'json');
		return false;
	};

	$(".dataTables_filter").prepend('<a class="btn btn-primary pull-right" onclick="fn.app.database.unit.dialog_add()">Add</a>');
