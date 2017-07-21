
	fn.app.database.unit.dialog_remove = function() {
		var item_selected = $("#tblDatabase").data("selected");
		$.ajax({
			url: "apps/database/view/dialog.unit.remove.php",
			data: {item:item_selected},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				$("#dialog_remove_unit").on("hidden.bs.modal",function(){
					$(this).remove();
				});
				$("#dialog_remove_unit").modal('show');
				
				$("#dialog_remove_unit .btnConfirm").click(function(){
					fn.app.database.unit.remove();
				});
			}	
		});
	};
	
	fn.app.database.unit.remove = function(){
		var item_selected = $("#tblDatabase").data("selected");
		$.post('apps/database/xhr/action-remove-unit.php',{items:item_selected},function(response){
			$("#tblDatabase").data("selected",[]);
			$("#tblDatabase").DataTable().draw();
			$('#dialog_remove_unit').modal('hide');
		});
		
	};
	
	$(".dataTables_filter").prepend('<a class="btn btn-danger pull-right" onclick="fn.app.database.unit.dialog_remove()">Remove</a>');

