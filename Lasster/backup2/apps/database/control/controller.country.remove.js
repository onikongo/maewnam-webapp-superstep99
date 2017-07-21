
	fn.app.database.country.dialog_remove = function() {
		var item_selected = $("#tblDatabase").data("selected");
		$.ajax({
			url: "apps/database/view/dialog.country.remove.php",
			data: {item:item_selected},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				$("#dialog_remove_country").on("hidden.bs.modal",function(){
					$(this).remove();
				});
				$("#dialog_remove_country").modal('show');
				
				$("#dialog_remove_country .btnConfirm").click(function(){
					fn.app.database.country.remove();
				});
			}	
		});
	};
	
	fn.app.database.country.remove = function(){
		var item_selected = $("#tblDatabase").data("selected");
		$.post('apps/database/xhr/action-remove-country.php',{items:item_selected},function(response){
			$("#tblDatabase").data("selected",[]);
			$("#tblDatabase").DataTable().draw();
			$('#dialog_remove_country').modal('hide');
		});
		
	};
	
	$(".dataTables_filter").prepend('<a class="btn btn-danger pull-right" onclick="fn.app.database.country.dialog_remove()">Remove</a>');

