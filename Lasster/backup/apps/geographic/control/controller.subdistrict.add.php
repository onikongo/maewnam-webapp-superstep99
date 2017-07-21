<?php
	include_once "apps/geographic/view/dialog.subdistrict.add.php";
?>
<script style="text/javascript">
	fn.app.geographic.subdistrict.add = function(){
		$.post('apps/geographic/xhr/action-add-subdistrict.php',$('#form_addsubdistrict').serialize(),function(response){
			if(response.success){
				$("#tblSubdistrict").DataTable().draw();
				$("#dialog_add_subdistrict").modal('hide');
				$("#form_addsubdistrict")[0].reset();
			}else{
				fn.engine.alert("Alert",response.msg);
			}
		},'json');
		return false;
	};

	$("#geographic_subdistrict .itoolbar").append('<button id="btnAddSubdistrict" type="button" class="btn btn-primary pull-right">Add</button>');
	$("#btnAddSubdistrict").click(function(){
		$("#dialog_add_subdistrict").modal('show');
	});
	$('#dialog_add_subdistrict').on('shown.bs.modal', function () {
		$("#txtName").focus();
	});
</script>
