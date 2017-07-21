
	fn.app.accctrl.role.dialog_remove = function() {
		var item_selected = $("#tblRole").data("selected");
		$.ajax({
			url: "apps/accctrl/view/dialog.role.remove.php",
			data: {item:item_selected},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				$("#dialog_remove_role").on("hidden.bs.modal",function(){
					$(this).remove();
				});
				$("#dialog_remove_role").modal('show');
				
				$("#dialog_remove_role .btnConfirm").click(function(){
					fn.app.accctrl.role.remove();
				});
			}	
		});
		
	};
	
	fn.app.accctrl.role.remove = function(){
		var item_selected = $("#tblRole").data("selected");
		$.post('apps/accctrl/xhr/action-remove-role.php',{items:item_selected},function(response){
			$("#tblRole").data("selected",[]);
			$("#tblRole").DataTable().draw();
			$('#dialog_remove_role').modal('hide');
		});
		
	};
	
	
	$(".dataTables_filter").prepend('<a class="btn btn-danger pull-right" onclick="fn.app.accctrl.role.dialog_remove()">Remove</a>');


