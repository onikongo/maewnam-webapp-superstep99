
	fn.app.accctrl.team.dialog_remove = function() {
		var item_selected = $("#tblTeam").data("selected");
		$.ajax({
			url: "apps/accctrl/view/dialog.team.remove.php",
			data: {item:item_selected},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				$("#dialog_remove_team").on("hidden.bs.modal",function(){
					$(this).remove();
				});
				$("#dialog_remove_team").modal('show');
				
				$("#dialog_remove_team .btnConfirm").click(function(){
					fn.app.accctrl.team.remove();
				});
			}	
		});
	};
	
	fn.app.accctrl.team.remove = function(){
		var item_selected = $("#tblTeam").data("selected");
		$.post('apps/accctrl/xhr/action-remove-team.php',{items:item_selected},function(response){
			$("#tblTeam").data("selected",[]);
			$("#tblTeam").DataTable().draw();
			$('#dialog_remove_team').modal('hide');
		});
		
	};
	
	$(".dataTables_filter").prepend('<a class="btn btn-danger pull-right" onclick="fn.app.accctrl.team.dialog_remove()">Remove</a>');


