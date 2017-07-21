<?php
	include_once "apps/geographic/view/dialog.subdistrict.remove.php";
?>
<script style="text/javascript">
	
	fn.app.geographic.subdistrict.remove = function(){
		
		$('#dialog_remove_subdistrict').modal('show');
		var item_selected = $("#tblSubdistrict").data("selected");
		
		if(item_selected.length > 0){
			$("#dialog_remove_subdistrict .btnConfirm").show();
			$("#dialog_remove_subdistrict .lblOutput").html(item_selected.join());
		}else{
			$("#dialog_remove_subdistrict .lblOutput").html("No Data Selected");
			$("#dialog_remove_subdistrict .btnConfirm").hide();
		}
	};
	
	
	$("#geographic_subdistrict .itoolbar").append('<button id="btnRemoveSubdistrict" type="button" class="btn btn-danger pull-right">Remove</button>');
	$("#btnRemoveSubdistrict").click(function(){
		fn.app.geographic.subdistrict.remove();
	});
	
	
	$("#dialog_remove_subdistrict .btnCancel").click(function(){
		$('#dialog_remove_subdistrict').modal('hide');
	});
	$("#dialog_remove_subdistrict .btnConfirm").click(function(){
		var item_selected = $("#tblSubdistrict").data("selected");
		$.post('apps/geographic/xhr/action-remove-subdistrict.php',{items:item_selected},function(response){
			$("#tblSubdistrict").data("selected",[]);
			$("#tblSubdistrict").DataTable().draw();
			$('#dialog_remove_subdistrict').modal('hide');
		});
	});

</script>
