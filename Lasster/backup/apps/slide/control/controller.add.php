<?php
	include_once "apps/slide/view/dialog.add.php";
?>
<script style="text/javascript">
	fn.app.slide.add = function(){
		$.post('apps/slide/xhr/action-add.php',$('#form_add').serialize(),function(response){
			if(response.success){
				$("#tbl").DataTable().draw();
				$("#dialog_add").modal('hide');
				$("#form_add")[0].reset();
			}else{
				fn.engine.alert("Alert",response.msg);
			}
		},'json');
		return false;
	};

	$("#slide .itoolbar").append('<button id="btnAdd" type="button" class="btn btn-primary pull-right">Add</button>');
	$("#btnAdd").click(function(){
		$("#dialog_add").modal('show');
	});
	$('#dialog_add').on('shown.bs.modal', function () {
		$("#txtName").focus();
	});
</script>
