<?php
	
?>
<script tyle="text/javascript">
	fn.app.geographic.district.change = function(id) {
		$.ajax({
			url: "apps/geographic/view/dialog.district.edit.php",
			data: {id:id},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
			}	
		});
	};
	
	fn.app.geographic.district.save_change = function(){
		$.post('apps/geographic/xhr/action-edit-district.php',$('#form_editdistrict').serialize(),function(response){
			if(response.success){
				$("#tblDistrict").DataTable().draw();
				$("#dialog_edit_district").modal('hide');
			}else{
				fn.engine.alert("Alert",response.msg);
			}
			
		},'json');
		return false;
	};
</script>
