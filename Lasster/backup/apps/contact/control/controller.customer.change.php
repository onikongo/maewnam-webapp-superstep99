<?php
	
?>
<script tyle="text/javascript">
	fn.app.contact.customer.change = function(id) {
		$.ajax({
			url: "apps/contact/view/dialog.customer.edit.php",
			data: {id:id},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				$('#dialog_edit_customer').on('shown.bs.modal', function () {
					$("#txtName").focus();
				});
				$("#dialog_edit_customer").on("hidden.bs.modal",function(){
					$(this).remove();
				});
				$("#dialog_edit_customer").modal('show');
			}	
		});
	};
	
	fn.app.contact.customer.save_change = function(){
		$.post('apps/contact/xhr/action-edit-customer.php',$('#form_editcustomer').serialize(),function(response){
			if(response.success){
				$("#tblCustomer").DataTable().draw();
				$("#dialog_edit_customer").modal('hide');
			}else{
				fn.engine.alert("Alert",response.msg);
			}
			
		},'json');
		return false;
	};
</script>
