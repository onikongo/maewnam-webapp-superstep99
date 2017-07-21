<?php
	
?>
<script tyle="text/javascript">
	fn.app.geographic.subdistrict.change = function(id) {
		$.ajax({
			url: "apps/geographic/view/dialog.subdistrict.edit.php",
			data: {id:id},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
			}	
		});
	};
	
	fn.app.geographic.subdistrict.save_change = function(){
		$.post('apps/geographic/xhr/action-edit-subdistrict.php',$('#form_editsubdistrict').serialize(),function(response){
			if(response.success){
				$("#tblSubdistrict").DataTable().draw();
				$("#dialog_edit_subdistrict").modal('hide');
			}else{
				fn.engine.alert("Alert",response.msg);
			}
			
		},'json');
		return false;
	};
</script>
