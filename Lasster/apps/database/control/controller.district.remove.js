
	fn.app.database.district.dialog_remove = function() {
		var item_selected = $("#tblDatabase").data("selected");
		$.ajax({
			url: "apps/database/view/dialog.district.remove.php",
			data: {item:item_selected},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				$("#dialog_remove_district").on("hidden.bs.modal",function(){
					$(this).remove();
				});
				$("#dialog_remove_district").modal('show');
				
				$("#dialog_remove_district .btnConfirm").click(function(){
					fn.app.database.district.remove();
				});
			}	
		});
	};
	
	fn.app.database.district.remove = function(){
		var item_selected = $("#tblDatabase").data("selected");
		$.post('apps/database/xhr/action-remove-district.php',{items:item_selected},function(response){
			$("#tblDatabase").data("selected",[]);
			$("#tblDatabase").DataTable().draw();
			$('#dialog_remove_district').modal('hide');
		});
		
	};
	
	$(".dataTables_filter").prepend('<a class="btn btn-danger pull-right" onclick="fn.app.database.district.dialog_remove()">Remove</a>');

