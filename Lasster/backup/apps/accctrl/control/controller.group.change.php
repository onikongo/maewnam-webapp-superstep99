<?php
	
?>
<script tyle="text/javascript">
	fn.app.accctrl.group.change = function(id) {
		$.ajax({
			url: "apps/accctrl/view/dialog.group.edit.php",
			data: {id:id},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
			}	
		});
	};
	
	fn.app.accctrl.group.save_change = function(){
		$.post('apps/accctrl/xhr/action-edit-group.php',$('#form_editgroup').serialize(),function(response){
			if(response.success){
				$("#tblGroup").DataTable().draw();
				$("#dialog_edit_group").modal('hide');
			}else{
				fn.engine.alert("Alert",response.msg);
			}
			
		},'json');
		return false;
	};
</script>
