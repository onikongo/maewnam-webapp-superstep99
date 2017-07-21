
	fn.app.accctrl.user.dialog_add = function() {
		$.ajax({
			url: "apps/accctrl/view/dialog.user.add.php",
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				$("#dialog_add_user").on("hidden.bs.modal",function(){
					$(this).remove();
				});
				$('#dialog_add_user').on('shown.bs.modal', function () {
					$("#txtName").focus();
				});
				$("#dialog_add_user").modal('show');
				
				fn.app.accctrl.address.initial(
					"#form_adduser #cbbCountry",
					"#form_adduser #cbbCity",
					"#form_adduser #cbbDistrict",
					"#form_adduser #cbbSubdistrict");
				fn.app.accctrl.address.load_country("#form_adduser #cbbCountry");
			}	
		});
	};

	fn.app.accctrl.user.add = function(){
		$.post('apps/accctrl/xhr/action-add-user.php',$('#form_adduser').serialize(),function(response){
			if(response.success){
				$("#tblUser").DataTable().draw();
				$("#dialog_add_user").modal('hide');
				$("#form_adduser")[0].reset();
			}else{
				fn.engine.alert("Alert",response.msg);
			}
		},'json');
		return false;
	};
	
	$(".dataTables_filter").prepend('<a class="btn btn-primary pull-right" onclick="fn.app.accctrl.user.dialog_add();">Add</a>');