<?php
	include_once "apps/contact/view/dialog.customer.remove.php";
?>
<script style="text/javascript">
	
	fn.app.contact.customer.remove = function(){
		
		$('#dialog_remove_customer').modal('show');
		var item_selected = $("#tblCustomer").data("selected");
		
		if(item_selected.length > 0){
			$("#dialog_remove_customer .btnConfirm").show();
			$("#dialog_remove_customer .lblOutput").html(item_selected.join());
		}else{
			$("#dialog_remove_customer .lblOutput").html("No Data Selected");
			$("#dialog_remove_customer .btnConfirm").hide();
		}
	};
	
	
	$("#contact_customer .itoolbar").append('<button id="btnRemoveCustomer" type="button" class="btn btn-danger pull-right">Remove</button>');
	$("#btnRemoveCustomer").click(function(){
		fn.app.contact.customer.remove();
	});
	
	
	$("#dialog_remove_customer .btnCancel").click(function(){
		$('#dialog_remove_customer').modal('hide');
	});
	$("#dialog_remove_customer .btnConfirm").click(function(){
		var item_selected = $("#tblCustomer").data("selected");
		$.post('apps/contact/xhr/action-remove-customer.php',{items:item_selected},function(response){
			$("#tblCustomer").data("selected",[]);
			$("#tblCustomer").DataTable().draw();
			$('#dialog_remove_customer').modal('hide');
		});
	});

</script>
