
	fn.app.database.city.dialog_add = function() {
		$.ajax({
			url: "apps/database/view/dialog.city.add.php",
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				$("#dialog_add_city").on("hidden.bs.modal",function(){
					$(this).remove();
				});
				$('#dialog_add_city').on('shown.bs.modal', function () {
					$("#txtName").focus();
				});
				$("#dialog_add_city").modal('show');
				
				$("select[name=cbbCountry]").select2({width:"100%"});
			}	
		});
	};

	fn.app.database.city.add = function(){
		$.post('apps/database/xhr/action-add-city.php',$('#form_addcity').serialize(),function(response){
			if(response.success){
				$("#tblDatabase").DataTable().draw();
				$("#dialog_add_city").modal('hide');
				$("#form_addcity")[0].reset();
			}else{
				fn.engine.alert("Alert",response.msg);
			}
		},'json');
		return false;
	};

	$(".dataTables_filter").prepend('<a class="btn btn-primary pull-right" onclick="fn.app.database.city.dialog_add()">Add</a>');
