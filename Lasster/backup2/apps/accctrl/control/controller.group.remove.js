
	fn.app.accctrl.group.dialog_remove = function() {
		var item_selected = $("#tblGroup").data("selected");
		$.ajax({
			url: "apps/accctrl/view/dialog.group.remove.php",
			data: {item:item_selected},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				$("#dialog_remove_group").on("hidden.bs.modal",function(){
					$(this).remove();
				});
				$("#dialog_remove_group").modal('show');
				
				$("#dialog_remove_group .btnConfirm").click(function(){
					fn.app.accctrl.group.remove();
				});
			}	
		});
	};
	
	fn.app.accctrl.group.remove = function(){
		var item_selected = $("#tblGroup").data("selected");
		$.post('apps/accctrl/xhr/action-remove-group.php',{items:item_selected},function(response){
			$("#tblGroup").data("selected",[]);
			$("#tblGroup").DataTable().draw();
			$('#dialog_remove_group').modal('hide');
		});
		
	};
	
	$(".dataTables_filter").prepend('<a class="btn btn-danger pull-right" onclick="fn.app.accctrl.group.dialog_remove()">Remove</a>');

