
	fn.app.database.city.dialog_remove = function() {
		var item_selected = $("#tblDatabase").data("selected");
		$.ajax({
			url: "apps/database/view/dialog.city.remove.php",
			data: {item:item_selected},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				$("#dialog_remove_city").on("hidden.bs.modal",function(){
					$(this).remove();
				});
				$("#dialog_remove_city").modal('show');
				
				$("#dialog_remove_city .btnConfirm").click(function(){
					fn.app.database.city.remove();
				});
			}	
		});
	};
	
	fn.app.database.city.remove = function(){
		var item_selected = $("#tblDatabase").data("selected");
		$.post('apps/database/xhr/action-remove-city.php',{items:item_selected},function(response){
			$("#tblDatabase").data("selected",[]);
			$("#tblDatabase").DataTable().draw();
			$('#dialog_remove_city').modal('hide');
		});
		
	};
	
	$(".dataTables_filter").prepend('<a class="btn btn-danger pull-right" onclick="fn.app.database.city.dialog_remove()">Remove</a>');

