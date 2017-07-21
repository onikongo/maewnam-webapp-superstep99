<?php
	include_once "apps/cover/view/dialog.add.php";
?>
<script style="text/javascript">
	fn.app.cover.add = function(){
		$.post('apps/cover/xhr/action-add.php',$('#form_addvideo').serialize(),function(response){
			if(response.success){
				$("#tbl").DataTable().draw();
				$("#dialog_add_video").modal('hide');
				$("#form_addvideo")[0].reset();
			}else{
				fn.engine.alert("Alert",response.msg);
			}
		},'json');
		return false;
	};

	$("#cover .itoolbar").append('<button id="btnAdd" type="button" class="btn btn-primary pull-right">Add</button>');
	$("#btnAdd").click(function(){
		$("#dialog_add_video").modal('show');
	});
	$('#dialog_add_video').on('shown.bs.modal', function () {
		$("#txtName").focus();
	});
</script>
