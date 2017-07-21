
	fn.app.database.industry.dialog_add = function() {
		$.ajax({
			url: "apps/database/view/dialog.industry.add.php",
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				$("#dialog_add_industry").on("hidden.bs.modal",function(){
					$(this).remove();
				});
				$('#dialog_add_industry').on('shown.bs.modal', function () {
					$("#txtName").focus();
				});
				$("#dialog_add_industry").modal('show');
			}	
		});
	};

	fn.app.database.industry.add = function(){
		$.post('apps/database/xhr/action-add-industry.php',$('#form_addindustry').serialize(),function(response){
			if(response.success){
				$("#tblDatabase").DataTable().draw();
				$("#dialog_add_industry").modal('hide');
				$("#form_addindustry")[0].reset();
			}else{
				fn.engine.alert("Alert",response.msg);
			}
		},'json');
		return false;
	};

	$(".dataTables_filter").prepend('<a class="btn btn-primary pull-right" onclick="fn.app.database.industry.dialog_add()">Add</a>');
