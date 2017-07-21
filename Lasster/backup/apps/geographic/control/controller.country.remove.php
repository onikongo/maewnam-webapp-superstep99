<?php
	include_once "apps/geographic/view/dialog.country.remove.php";
?>
<script style="text/javascript">
	
	fn.app.geographic.country.remove = function(){
		
		$('#dialog_remove_country').modal('show');
		var item_selected = $("#tblCountry").data("selected");
		
		if(item_selected.length > 0){
			$("#dialog_remove_country .btnConfirm").show();
			$("#dialog_remove_country .lblOutput").html(item_selected.join());
		}else{
			$("#dialog_remove_country .lblOutput").html("No Data Selected");
			$("#dialog_remove_country .btnConfirm").hide();
		}
	};
	
	
	$("#geographic_country .itoolbar").append('<button id="btnRemoveCountry" type="button" class="btn btn-danger pull-right">Remove</button>');
	$("#btnRemoveCountry").click(function(){
		fn.app.geographic.country.remove();
	});
	
	
	$("#dialog_remove_country .btnCancel").click(function(){
		$('#dialog_remove_country').modal('hide');
	});
	$("#dialog_remove_country .btnConfirm").click(function(){
		var item_selected = $("#tblCountry").data("selected");
		$.post('apps/geographic/xhr/action-remove-country.php',{items:item_selected},function(response){
			$("#tblCountry").data("selected",[]);
			$("#tblCountry").DataTable().draw();
			$('#dialog_remove_country').modal('hide');
		});
	});

</script>
