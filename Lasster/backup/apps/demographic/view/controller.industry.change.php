<?php
	
?>
<script tyle="text/javascript">

$(function(){
	var edit = function(id) {
		$.ajax({
			url: "apps/demographic/view/dialog.industry.edit.php",
			data: {id:id},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
			}	
		});
	};
	
	var change = function(){
		$.post('apps/demographic/xhr/action-edit-industry.php',$('#form_editindustry').serialize(),function(response){
			if(response.success){
				$("#tblIndustry").DataTable().draw();
				$("#dialog_edit_industry").modal('hide');
			}else{
				fn.engine.alert("Alert",response.msg);
			}
			
		},'json');
		return false;
	};
	$.extend(fn.app.demographic.industry,{edit:edit,change:change});
});	

</script>
