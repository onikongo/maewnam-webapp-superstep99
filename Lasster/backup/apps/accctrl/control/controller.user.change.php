<?php
	
?>
<script tyle="text/javascript">
	fn.app.accctrl.user.change = function(id) {
		$.ajax({
			url: "apps/accctrl/view/dialog.user.edit.php",
			data: {id:id},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
			}	
		});
	};
	
	fn.app.accctrl.user.save_change = function(){
		$.post('apps/accctrl/xhr/action-edit-user.php',$('#form_edituser').serialize(),function(response){
			if(response.success){
				$("#tblUser").DataTable().draw();
				$("#dialog_edit_user").modal('hide');
			}else{
				fn.engine.alert("Alert",response.msg);
			}
			
		},'json');
		return false;
	};
</script>
