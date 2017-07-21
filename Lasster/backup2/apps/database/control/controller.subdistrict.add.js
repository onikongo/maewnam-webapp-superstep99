
	fn.app.database.subdistrict.dialog_add = function() {
		$.ajax({
			url: "apps/database/view/dialog.subdistrict.add.php",
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				$("#dialog_add_subdistrict").on("hidden.bs.modal",function(){
					$(this).remove();
				});
				$('#dialog_add_subdistrict').on('shown.bs.modal', function () {
					$("#txtName").focus();
				});
				$("#dialog_add_subdistrict").modal('show');
			}	
		});
	};

	fn.app.database.subdistrict.add = function(){
		$.post('apps/database/xhr/action-add-subdistrict.php',$('#form_addsubdistrict').serialize(),function(response){
			if(response.success){
				$("#tblDatabase").DataTable().draw();
				$("#dialog_add_subdistrict").modal('hide');
				$("#form_addsubdistrict")[0].reset();
			}else{
				fn.engine.alert("Alert",response.msg);
			}
		},'json');
		return false;
	};

	$(".dataTables_filter").prepend('<a class="btn btn-primary pull-right" onclick="fn.app.database.subdistrict.dialog_add()">Add</a>');
