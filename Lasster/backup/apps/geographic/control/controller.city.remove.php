<?php
	include_once "apps/geographic/view/dialog.city.remove.php";
?>
<script style="text/javascript">
	
	fn.app.geographic.city.remove = function(){
		
		$('#dialog_remove_city').modal('show');
		var item_selected = $("#tblCity").data("selected");
		
		if(item_selected.length > 0){
			$("#dialog_remove_city .btnConfirm").show();
			$("#dialog_remove_city .lblOutput").html(item_selected.join());
		}else{
			$("#dialog_remove_city .lblOutput").html("No Data Selected");
			$("#dialog_remove_city .btnConfirm").hide();
		}
	};
	
	
	$("#geographic_city .itoolbar").append('<button id="btnRemoveCity" type="button" class="btn btn-danger pull-right">Remove</button>');
	$("#btnRemoveCity").click(function(){
		fn.app.geographic.city.remove();
	});
	
	
	$("#dialog_remove_city .btnCancel").click(function(){
		$('#dialog_remove_city').modal('hide');
	});
	$("#dialog_remove_city .btnConfirm").click(function(){
		var item_selected = $("#tblCity").data("selected");
		$.post('apps/geographic/xhr/action-remove-city.php',{items:item_selected},function(response){
			$("#tblCity").data("selected",[]);
			$("#tblCity").DataTable().draw();
			$('#dialog_remove_city').modal('hide');
		});
	});

</script>
