<?php
	
?>
<script tyle="text/javascript">
$(function(){
	fn.app.accctrl.group.permission = function(id) {
		$.ajax({
			url: "apps/accctrl/view/dialog.group.permission.php",
			data: {id:id},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
			}
		});
	};
	
	fn.app.accctrl.group.save_permission = function(){
		$.post('apps/accctrl/xhr/action-edit-group-permission.php',$('#form_editgroup').serialize(),function(response){
			if(response.success){
				$("#tblGroup").DataTable().draw();
				$("#dialog_edit_group").modal('hide');
			}else{
				fn.engine.alert("Alert",response.msg);
			}
			
		},'json');
		return false;
	};
});	

</script>
