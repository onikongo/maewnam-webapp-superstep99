<?php
	include_once "apps/job/view/dialog.remove.php";
?>
<script style="text/javascript">
	
	fn.app.job.remove = function(){
		
		$('#dialog_remove').modal('show');
		var item_selected = $("#tbl").data("selected");
		
		if(item_selected.length > 0){
			$("#dialog_remove .btnConfirm").show();
			$("#dialog_remove .lblOutput").html(item_selected.join());
		}else{
			$("#dialog_remove .lblOutput").html("No Data Selected");
			$("#dialog_remove .btnConfirm").hide();
		}
	};
	
	
	$("#job .itoolbar").append('<button id="btnRemove" type="button" class="btn btn-danger pull-right">Remove</button>');
	$("#btnRemove").click(function(){
		fn.app.job.remove();
	});
	
	
	$("#dialog_remove .btnCancel").click(function(){
		$('#dialog_remove').modal('hide');
	});
	$("#dialog_remove .btnConfirm").click(function(){
		var item_selected = $("#tbl").data("selected");
		$.post('apps/job/xhr/action-remove.php',{items:item_selected},function(response){
			$("#tbl").data("selected",[]);
			$("#tbl").DataTable().draw();
			$('#dialog_remove').modal('hide');
		});
	});

</script>
