
	fn.app.database.country.dialog_add = function() {
		$.ajax({
			url: "apps/database/view/dialog.country.add.php",
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				$("#dialog_add_country").on("hidden.bs.modal",function(){
					$(this).remove();
				});
				$('#dialog_add_country').on('shown.bs.modal', function () {
					$("#txtName").focus();
				});
				$("#dialog_add_country").modal('show');
			}	
		});
	};

	fn.app.database.country.add = function(){
		$.post('apps/database/xhr/action-add-country.php',$('#form_addcountry').serialize(),function(response){
			if(response.success){
				$("#tblDatabase").DataTable().draw();
				$("#dialog_add_country").modal('hide');
				$("#form_addcountry")[0].reset();
			}else{
				fn.engine.alert("Alert",response.msg);
			}
		},'json');
		return false;
	};

	$(".dataTables_filter").prepend('<a class="btn btn-primary pull-right" onclick="fn.app.database.country.dialog_add()">Add</a>');
