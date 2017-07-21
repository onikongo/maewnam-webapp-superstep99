<?php
	include_once "apps/contact/view/dialog.organization.remove.php";
?>
<script style="text/javascript">
	
	fn.app.contact.organization.remove = function(){
		
		$('#dialog_remove_organization').modal('show');
		var item_selected = $("#tblOrganization").data("selected");
		
		if(item_selected.length > 0){
			$("#dialog_remove_organization .btnConfirm").show();
			$("#dialog_remove_organization .lblOutput").html(item_selected.join());
		}else{
			$("#dialog_remove_organization .lblOutput").html("No Data Selected");
			$("#dialog_remove_organization .btnConfirm").hide();
		}
	};
	
	
	$("#contact_organization .itoolbar").append('<button id="btnRemoveOrganization" type="button" class="btn btn-danger pull-right">Remove</button>');
	$("#btnRemoveOrganization").click(function(){
		fn.app.contact.organization.remove();
	});
	
	
	$("#dialog_remove_organization .btnCancel").click(function(){
		$('#dialog_remove_organization').modal('hide');
	});
	$("#dialog_remove_organization .btnConfirm").click(function(){
		var item_selected = $("#tblOrganization").data("selected");
		$.post('apps/contact/xhr/action-remove-organization.php',{items:item_selected},function(response){
			$("#tblOrganization").data("selected",[]);
			$("#tblOrganization").DataTable().draw();
			$('#dialog_remove_organization').modal('hide');
		});
	});

</script>
