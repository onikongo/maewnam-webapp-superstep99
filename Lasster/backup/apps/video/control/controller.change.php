<?php
	
?>
<script tyle="text/javascript">
	fn.app.video.change = function(id) {
		$.ajax({
			url: "apps/video/view/dialog.edit.php",
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
	
	fn.app.video.save_change = function(){
		$.post('apps/video/xhr/action-edit.php',$('#form_edit').serialize(),function(response){
			if(response.success){
				$("#tbl").DataTable().draw();
				$("#dialog_edit").modal('hide');
			}else{
				fn.engine.alert("Alert",response.msg);
			}
			
		},'json');
		return false;
	};
	fn.app.video.active = function(id,me){
		$.ajax({
			url:"apps/video/xhr/action-change-status.php",
				type:"POST",
				dataType:"json",
				data:{id:id},
				success: function(result){
					
				}
		});
	};
	fn.app.video.activeheightlight = function(id,me){
		$.ajax({
			url:"apps/video/xhr/action-change-statusheightlight.php",
				type:"POST",
				dataType:"json",
				data:{id:id},
				success: function(result){
					
				}
		});
	};
</script>
