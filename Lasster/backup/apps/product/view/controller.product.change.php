<?php
	
?>
<script tyle="text/javascript">

$(function(){
	var edit = function(id) {
		$.ajax({
			url: "apps/product/view/dialog.product.edit.php",
			data: {id:id},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
			}	
		});
	};
	
	var change = function(){
		$.post('apps/product/xhr/action-edit-product.php',$('#form_editproduct').serialize(),function(response){
			if(response.success){
				$("#tblProduct").DataTable().draw();
				$("#dialog_edit_product").modal('hide');
			}else{
				fn.engine.alert("Alert",response.msg);
			}
			
		},'json');
		return false;
	};
	$.extend(fn.app.product,{edit:edit,change:change});
});	

</script>
