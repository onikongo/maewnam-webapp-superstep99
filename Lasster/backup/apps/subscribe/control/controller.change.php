<?php
	
?>
<script tyle="text/javascript">
	fn.app.subscribe.change = function(id) {
		$.ajax({
			url: "apps/subscribe/view/dialog.view.php",
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
	
	fn.app.subscribe.save_change = function(){
		$.post('apps/subscribe/xhr/action-edit.php',$('#form_edit').serialize(),function(response){
			if(response.success){
				$("#tbl").DataTable().draw();
				$("#dialog_edit").modal('hide');
			}else{
				fn.engine.alert("Alert",response.msg);
			}
			
		},'json');
		return false;
	};
	fn.app.subscribe.active = function(id,me){
		$.ajax({
			url:"apps/subscribe/xhr/action-change-status.php",
				type:"POST",
				dataType:"json",
				data:{id:id},
				success: function(result){
					
				}
		});
	};
	fn.app.subscribe.read = function(id){
		$.post('apps/subscribe/xhr/action-update-contact.php',$('#form_editgroup').serialize(),function(response){
				if(response.success==true){
					$("#tbl").DataTable().draw();
					$("#dialog_edit").modal('hide');
					//$("#thumbnail_edit").attr('src','../../../../upload/contact.jpg');
				}else{
					//fn.engine.alert("Alert",response.msg);
					$("#tbl").DataTable().draw();
					$("#dialog_edit").modal('hide');
				}
			},'json');
			return false;
	};
</script>
