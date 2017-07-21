<?php
	
?>
<script tyle="text/javascript">
	fn.app.geographic.country.change = function(id) {
		$.ajax({
			url: "apps/geographic/view/dialog.country.edit.php",
			data: {id:id},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
			}	
		});
	};
	
	fn.app.geographic.country.save_change = function(){
		$.post('apps/geographic/xhr/action-edit-country.php',$('#form_editcountry').serialize(),function(response){
			if(response.success){
				$("#tblCountry").DataTable().draw();
				$("#dialog_edit_country").modal('hide');
			}else{
				fn.engine.alert("Alert",response.msg);
			}
			
		},'json');
		return false;
	};
</script>
