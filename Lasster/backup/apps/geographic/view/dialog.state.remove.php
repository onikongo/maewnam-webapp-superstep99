<?php
	
?>
<div class="modal fade" id="dialog_remove_state" data-backdrop="static">
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
		
		$('#dialog_remove_state').modal('show');
		var item_selected = $("#tblState").data("selected");
		
		if(item_selected.length > 0){
			$("#dialog_remove_state .btnConfirm").show();
			$("#dialog_remove_state .lblOutput").html(item_selected.join());
		}else{
			$("#dialog_remove_state .lblOutput").html("No Data Selected");
			$("#dialog_remove_state .btnConfirm").hide();
		}
	};
	$.extend(fn.app.geographic.state,{remove:func});
	
	$("#geographic_state .itoolbar").append('<button id="btnRemoveState" type="button" class="btn btn-danger">Remove</button>');
	$("#btnRemoveState").click(function(){
		fn.app.geographic.state.remove();
	});
	
	
	$("#dialog_remove_state .btnCancel").click(function(){
		$('#dialog_remove_state').modal('hide');
	});
	$("#dialog_remove_state .btnConfirm").click(function(){
		var item_selected = $("#tblState").data("selected");
		$.post('apps/geographic/xhr/action-remove-state.php',{items:item_selected},function(response){
			$("#tblState").data("selected",[]);
			$("#tblState").DataTable().draw();
			$('#dialog_remove_state').modal('hide');
		});
	});
});	

</script>