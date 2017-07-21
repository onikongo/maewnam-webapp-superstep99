<?php
	include_once "apps/accctrl/view/dialog.user.remove.php";
?>
<script style="text/javascript">
	
	fn.app.accctrl.user.remove = function(){
		
		$('#dialog_remove_user').modal('show');
		var item_selected = $("#tblUser").data("selected");
		
		if(item_selected.length > 0){
			$("#dialog_remove_user .btnConfirm").show();
			$("#dialog_remove_user .lblOutput").html(item_selected.join());
		}else{
			$("#dialog_remove_user .lblOutput").html("No Data Selected");
			$("#dialog_remove_user .btnConfirm").hide();
		}
	};
	
	
	$("#accctrl_user .itoolbar").append('<button id="btnRemoveUser" type="button" class="btn btn-danger pull-right">Remove</button>');
	$("#btnRemoveUser").click(function(){
		fn.app.accctrl.user.remove();
	});
	
	
	$("#dialog_remove_user .btnCancel").click(function(){
		$('#dialog_remove_user').modal('hide');
	});
	$("#dialog_remove_user .btnConfirm").click(function(){
		var item_selected = $("#tblUser").data("selected");
		$.post('apps/accctrl/xhr/action-remove-user.php',{items:item_selected},function(response){
			$("#tblUser").data("selected",[]);
			$("#tblUser").DataTable().draw();
			$('#dialog_remove_user').modal('hide');
		});
	});

</script>
