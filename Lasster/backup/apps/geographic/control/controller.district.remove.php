<?php
	include_once "apps/geographic/view/dialog.district.remove.php";
?>
<script style="text/javascript">
	
	fn.app.geographic.district.remove = function(){
		
		$('#dialog_remove_district').modal('show');
		var item_selected = $("#tblDistrict").data("selected");
		
		if(item_selected.length > 0){
			$("#dialog_remove_district .btnConfirm").show();
			$("#dialog_remove_district .lblOutput").html(item_selected.join());
		}else{
			$("#dialog_remove_district .lblOutput").html("No Data Selected");
			$("#dialog_remove_district .btnConfirm").hide();
		}
	};
	
	
	$("#geographic_district .itoolbar").append('<button id="btnRemoveDistrict" type="button" class="btn btn-danger pull-right">Remove</button>');
	$("#btnRemoveDistrict").click(function(){
		fn.app.geographic.district.remove();
	});
	
	
	$("#dialog_remove_district .btnCancel").click(function(){
		$('#dialog_remove_district').modal('hide');
	});
	$("#dialog_remove_district .btnConfirm").click(function(){
		var item_selected = $("#tblDistrict").data("selected");
		$.post('apps/geographic/xhr/action-remove-district.php',{items:item_selected},function(response){
			$("#tblDistrict").data("selected",[]);
			$("#tblDistrict").DataTable().draw();
			$('#dialog_remove_district').modal('hide');
		});
	});

</script>
