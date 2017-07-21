<?php
	
?>
<div class="modal fade" id="dialog_remove_product" data-backdrop="static">
  	<div class="modal-dialog">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4>Are you sure to remove the following ID!</h4>
      		</div>
		    <div class="modal-body">
				<p class="lblOutput"></p>
		    </div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-danger btnConfirm">Remove</button>
			</div>
	  	</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script tyle="text/javascript">

$(function(){
	var func = function(){
		
		$('#dialog_remove_product').modal('show');
		var item_selected = $("#tblProduct").data("selected");
		
		if(item_selected.length > 0){
			$("#dialog_remove_product .btnConfirm").show();
			$("#dialog_remove_product .lblOutput").html(item_selected.join());
		}else{
			$("#dialog_remove_product .lblOutput").html("No Data Selected");
			$("#dialog_remove_product .btnConfirm").hide();
		}
	};
	$.extend(fn.app.video,{remove:func});
	
	$("#product_container .itoolbar").append('<button id="btnRemoveProduct" type="button" class="btn btn-danger"><i class="fa fa-trash-o font20 "></i></button>');
	$("#btnRemoveProduct").click(function(){
		fn.app.video.remove();
	});
	
	
	$("#dialog_remove_product .btnCancel").click(function(){
		$('#dialog_remove_product').modal('hide');
	});
	$("#dialog_remove_product .btnConfirm").click(function(){
		var item_selected = $("#tblProduct").data("selected");
		$.post('apps/video/xhr/action-remove-video.php',{items:item_selected},function(response){
			$("#tblProduct").data("selected",[]);
			$("#tblProduct").DataTable().draw();
			$('#dialog_remove_product').modal('hide');
		});
	});
});	

</script>