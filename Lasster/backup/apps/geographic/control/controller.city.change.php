<?php
	
?>
<script tyle="text/javascript">
	fn.app.geographic.city.change = function(id) {
		$.ajax({
			url: "apps/geographic/view/dialog.city.edit.php",
			data: {id:id},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
			}	
		});
	};
	
	fn.app.geographic.city.save_change = function(){
		$.post('apps/geographic/xhr/action-edit-city.php',$('#form_editcity').serialize(),function(response){
			if(response.success){
				$("#tblCity").DataTable().draw();
				$("#dialog_edit_city").modal('hide');
			}else{
				fn.engine.alert("Alert",response.msg);
			}
			
		},'json');
		return false;
	};
</script>
