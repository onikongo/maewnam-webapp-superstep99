
	fn.app.accctrl.user.dialog_remove = function() {
		var item_selected = $("#tblUser").data("selected");
		$.ajax({
			url: "apps/accctrl/view/dialog.user.remove.php",
			data: {item:item_selected},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				$("#dialog_remove_user").on("hidden.bs.modal",function(){
					$(this).remove();
				});
				$("#dialog_remove_user").modal('show');
				
				$("#dialog_remove_user .btnConfirm").click(function(){
					fn.app.accctrl.user.remove();
				});
			}	
		});
		
	};
	
	fn.app.accctrl.user.remove = function(){
		var item_selected = $("#tblUser").data("selected");
		$.post('apps/accctrl/xhr/action-remove-user.php',{items:item_selected},function(response){
			$("#tblUser").data("selected",[]);
			$("#tblUser").DataTable().draw();
			$('#dialog_remove_user').modal('hide');
		});
		
	};
	
	$(".dataTables_filter").prepend('<a class="btn btn-danger pull-right" onclick="fn.app.accctrl.user.dialog_remove()">Remove</a>');

