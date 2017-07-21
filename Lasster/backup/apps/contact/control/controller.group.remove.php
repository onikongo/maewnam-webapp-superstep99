<?php
	include_once "apps/contact/view/dialog.group.remove.php";
?>
<script style="text/javascript">
	
	fn.app.contact.group.remove = function(){
		
		$('#dialog_remove_group').modal('show');
		var item_selected = $("#tblGroup").data("selected");
		
		if(item_selected.length > 0){
			$("#dialog_remove_group .btnConfirm").show();
			$("#dialog_remove_group .lblOutput").html(item_selected.join());
		}else{
			$("#dialog_remove_group .lblOutput").html("No Data Selected");
			$("#dialog_remove_group .btnConfirm").hide();
		}
	};
	
	
	$("#contact_group .itoolbar").append('<button id="btnRemoveGroup" type="button" class="btn btn-danger pull-right">Remove</button>');
	$("#btnRemoveGroup").click(function(){
		fn.app.contact.group.remove();
	});
	
	
	$("#dialog_remove_group .btnCancel").click(function(){
		$('#dialog_remove_group').modal('hide');
	});
	$("#dialog_remove_group .btnConfirm").click(function(){
		var item_selected = $("#tblGroup").data("selected");
		$.post('apps/contact/xhr/action-remove-group.php',{items:item_selected},function(response){
			$("#tblGroup").data("selected",[]);
			$("#tblGroup").DataTable().draw();
			$('#dialog_remove_group').modal('hide');
		});
	});

</script>
