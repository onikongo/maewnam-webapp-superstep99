<div class="modal fade" id="dialogChangeIcon" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4>Are you sure to change photo</h4>
				</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-danger pull-left" onclick="fn.app.setting.remove_icon()">Remove</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button id="btnChangeIcon" type="submit" class="btn btn-primary">Change</button>
				</div>
			</div><!-- /.modal-content -->
			</form>
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<form id="form_change_icon" class="hidden">
		<input name="txtID" value="<?php echo $contact['id']?>" type="hidden">
		<input id="fIcon" name="file" type="file">
	</form>
<script>
$(function(){
	$("#fIcon").change(function(){
		var data = new FormData($("#form_change_icon")[0]);
		jQuery.ajax({
			url: 'apps/setting/xhr/action-upload-icon.php',
			data: data,
			cache: false,
			contentType: false,
			processData: false,
			type: 'POST',
			dataType: 'json',
			success: function(response){
				if(response.success){
					fn.navigate("setting","view=company");
				}else{
					fn.engine.alert("Alert",response.msg);
				}	
			}
		});
	});
	$("#btnChangeIcon").click(function(){
		$("#dialogChangeIcon").modal("hide");
		$("#fIcon").click();
	});
});


fn.app.setting.company.change_icon = function(){
	$("#dialogChangeIcon").modal("show");
};

fn.app.setting.company.remove_icon = function(){
	fn.confirmbox("Confirmation?","Are you sure to remove icon.",function(confirmed){
		if(confirmed){
			$.post('apps/setting/xhr/action-remove-icon.php',function(json){
				$("#dialogChangeIcon").modal("hide");
				if(json.success){
					$("#trademark_icon").attr("src","img/default/organization.png");
				}
			},"json");
		}
	});
};


</script>