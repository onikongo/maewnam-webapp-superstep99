<?php
	
?>
<script tyle="text/javascript">
	fn.app.product.change = function(id) {
		$.ajax({
			url: "apps/product/view/dialog.edit.php",
			data: {id:id},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				$('#dialog_edit').on('shown.bs.modal', function () {
					$("#txtName").focus();
				});
				$("#dialog_edit").on("hidden.bs.modal",function(){
					$(this).remove();
				});
				$("#dialog_edit").modal('show');
			}	
		});
	};
	
	fn.app.product.save_change = function(){
		$.post('apps/product/xhr/action-edit.php',$('#form_edit').serialize(),function(response){
			if(response.success){
				$("#tbl").DataTable().draw();
				$("#dialog_edit").modal('hide');
			}else{
				fn.engine.alert("Alert",response.msg);
			}
			
		},'json');
		return false;
	};
	fn.app.product.active = function(id,me){
		$.ajax({
			url:"apps/product/xhr/action-change-status.php",
				type:"POST",
				dataType:"json",
				data:{id:id},
				success: function(result){
					
				}
		});
	};
</script>
