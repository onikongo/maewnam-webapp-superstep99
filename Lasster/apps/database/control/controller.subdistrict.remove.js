
	fn.app.database.subdistrict.dialog_remove = function() {
		var item_selected = $("#tblDatabase").data("selected");
		$.ajax({
			url: "apps/database/view/dialog.subdistrict.remove.php",
			data: {item:item_selected},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				$("#dialog_remove_subdistrict").on("hidden.bs.modal",function(){
					$(this).remove();
				});
				$("#dialog_remove_subdistrict").modal('show');
				
				$("#dialog_remove_subdistrict .btnConfirm").click(function(){
					fn.app.database.subdistrict.remove();
				});
			}	
		});
	};
	
	fn.app.database.subdistrict.remove = function(){
		var item_selected = $("#tblDatabase").data("selected");
		$.post('apps/database/xhr/action-remove-subdistrict.php',{items:item_selected},function(response){
			$("#tblDatabase").data("selected",[]);
			$("#tblDatabase").DataTable().draw();
			$('#dialog_remove_subdistrict').modal('hide');
		});
		
	};
	
	$(".dataTables_filter").prepend('<a class="btn btn-danger pull-right" onclick="fn.app.database.subdistrict.dialog_remove()">Remove</a>');

