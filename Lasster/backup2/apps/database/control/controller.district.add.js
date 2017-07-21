
	fn.app.database.district.dialog_add = function() {
		$.ajax({
			url: "apps/database/view/dialog.district.add.php",
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				$("#dialog_add_district").on("hidden.bs.modal",function(){
					$(this).remove();
				});
				$('#dialog_add_district').on('shown.bs.modal', function () {
					$("#txtName").focus();
				});
				$("#dialog_add_district").modal('show');
			}	
		});
	};

	fn.app.database.district.add = function(){
		$.post('apps/database/xhr/action-add-district.php',$('#form_adddistrict').serialize(),function(response){
			if(response.success){
				$("#tblDatabase").DataTable().draw();
				$("#dialog_add_district").modal('hide');
				$("#form_adddistrict")[0].reset();
			}else{
				fn.engine.alert("Alert",response.msg);
			}
		},'json');
		return false;
	};

	$(".dataTables_filter").prepend('<a class="btn btn-primary pull-right" onclick="fn.app.database.district.dialog_add()">Add</a>');
