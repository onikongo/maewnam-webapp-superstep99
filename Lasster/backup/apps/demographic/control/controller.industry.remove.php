<?php
	include_once "apps/demographic/view/dialog.industry.remove.php";
?>
<script style="text/javascript">
	
	fn.app.demographic.industry.remove = function(){
		
		$('#dialog_remove_industry').modal('show');
		var item_selected = $("#tblIndustry").data("selected");
		
		if(item_selected.length > 0){
			$("#dialog_remove_industry .btnConfirm").show();
			$("#dialog_remove_industry .lblOutput").html(item_selected.join());
		}else{
			$("#dialog_remove_industry .lblOutput").html("No Data Selected");
			$("#dialog_remove_industry .btnConfirm").hide();
		}
	};
	
	
	$("#demographic_industry .itoolbar").append('<button id="btnRemoveIndustry" type="button" class="btn btn-danger pull-right">Remove</button>');
	$("#btnRemoveIndustry").click(function(){
		fn.app.demographic.industry.remove();
	});
	
	
	$("#dialog_remove_industry .btnCancel").click(function(){
		$('#dialog_remove_industry').modal('hide');
	});
	$("#dialog_remove_industry .btnConfirm").click(function(){
		var item_selected = $("#tblIndustry").data("selected");
		$.post('apps/demographic/xhr/action-remove-industry.php',{items:item_selected},function(response){
			$("#tblIndustry").data("selected",[]);
			$("#tblIndustry").DataTable().draw();
			$('#dialog_remove_industry').modal('hide');
		});
	});

</script>
