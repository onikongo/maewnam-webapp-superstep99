<?php
	/* include_once "apps/blog/view/dialog.edit.php"; */
?>
<script tyle="text/javascript">
	fn.app.why_qrs.change = function(id) {
		$.ajax({
			url: "apps/why_qrs/view/dialog.edit.php",
			data: {id:id},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				$('#dialog_edit').on('shown.bs.modal', function () {
					$("#txttitle").focus();
				});
				$("#dialog_edit").on("hidden.bs.modal",function(){
					$(this).remove();
				});
				$("#dialog_edit").modal('show');
			}	
		});
	};
	
	fn.app.why_qrs.save_change = function(){
		$.post('apps/why_qrs/xhr/action-edit.php',$('#form_edit').serialize(),function(response){
			if(response.success){
				$("#tbl").DataTable().draw();
				$("#dialog_edit").modal('hide');
			}else{
				fn.engine.alert("Alert",response.msg);
			}
			
		},'json');
		return false;
	};
	fn.app.why_qrs.active = function(id,me){
		$.ajax({
			url:"apps/why_qrs/xhr/action-change-status.php",
				type:"POST",
				dataType:"json",
				data:{id:id},
				success: function(result){
					
				}
		});
	};
</script>
