<?php
	include_once "apps/demographic/view/dialog.industry.add.php";
?>
<script style="text/javascript">
	fn.app.demographic.industry.add = function(){
		$.post('apps/demographic/xhr/action-add-industry.php',$('#form_addindustry').serialize(),function(response){
			if(response.success){
				$("#tblIndustry").DataTable().draw();
				$("#dialog_add_industry").modal('hide');
				$("#form_addindustry")[0].reset();
			}else{
				fn.engine.alert("Alert",response.msg);
			}
		},'json');
		return false;
	};

	$("#demographic_industry .itoolbar").append('<button id="btnAddIndustry" type="button" class="btn btn-primary pull-right">Add</button>');
	$("#btnAddIndustry").click(function(){
		$("#dialog_add_industry").modal('show');
	});
	$('#dialog_add_industry').on('shown.bs.modal', function () {
		$("#txtName").focus();
	});
</script>
