
	fn.app.database.industry.dialog_remove = function() {
		var item_selected = $("#tblDatabase").data("selected");
		$.ajax({
			url: "apps/database/view/dialog.industry.remove.php",
			data: {item:item_selected},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				$("#dialog_remove_industry").on("hidden.bs.modal",function(){
					$(this).remove();
				});
				$("#dialog_remove_industry").modal('show');
				
				$("#dialog_remove_industry .btnConfirm").click(function(){
					fn.app.database.industry.remove();
				});
			}	
		});
	};
	
	fn.app.database.industry.remove = function(){
		var item_selected = $("#tblDatabase").data("selected");
		$.post('apps/database/xhr/action-remove-industry.php',{items:item_selected},function(response){
			$("#tblDatabase").data("selected",[]);
			$("#tblDatabase").DataTable().draw();
			$('#dialog_remove_industry').modal('hide');
		});
		
	};
	
	$(".dataTables_filter").prepend('<a class="btn btn-danger pull-right" onclick="fn.app.database.industry.dialog_remove()">Remove</a>');

