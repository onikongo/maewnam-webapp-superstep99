<?php
	include_once "apps/contact/view/dialog.customer.add.php";
?>
<script style="text/javascript">
	fn.app.contact.customer.add = function(){
		$.post('apps/contact/xhr/action-add-customer.php',$('#form_addcustomer').serialize(),function(response){
			if(response.success){
				$("#tblCustomer").DataTable().draw();
				$("#dialog_add_customer").modal('hide');
				$("#form_addcustomer")[0].reset();
			}else{
				fn.engine.alert("Alert",response.msg);
			}
		},'json');
		return false;
	};

	$("#contact_customer .itoolbar").append('<button id="btnAddCustomer" type="button" class="btn btn-primary pull-right">Add</button>');
	$("#btnAddCustomer").click(function(){
		$("#dialog_add_customer").modal('show');
	});
	$('#dialog_add_customer').on('shown.bs.modal', function () {
		$("#txtName").focus();
	});
</script>
