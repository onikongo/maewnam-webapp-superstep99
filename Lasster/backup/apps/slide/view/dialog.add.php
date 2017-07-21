<?php
	
?>
<div class="modal fade" id="dialog_add" data-backdrop="static">
  	<div class="modal-dialog">
		<form id="form_add" class="form-horizontal" role="form" onSubmit="fn.app.slide.add();return false;">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4>Add Image</h4>
      		</div>
		    <div class="modal-body">
				<div class="form-group">
					<label class="col-sm-2 control-label">name Image</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="txtname" name="txtname">
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    	<div class="col-sm-10">
                            <input id="txtphoto" name="txtphoto" type="text" class="form-control" >
                        </div>   
                        <div class="col-sm-2">
                            <div class="btn btn-default" data-toggle="modal" id="browAdd" >Browse</div>
                        </div> 
						<div class="seperator"></div>
						<div class="seperator"></div>
					</div><!-- /.col -->
				</div><!-- /.col -->
		    </div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Save</button>
			</div>
	  	</div><!-- /.modal-content -->
		</form>
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<form id="form_change_Photo" class="hidden">
		<input name="txtID" value="" type="hidden">
		<input id="fPhoto" name="file" type="file">
</form>
<script tyle="text/javascript">

$(function(){
	var func = function(){
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
	$.extend(fn.app.slide,{add:func});
	
	$("#panel-head-group").append('<button id="btnAdd" type="button" class="btn btn-primary pull-right">Add</button>');
	$("#btnAdd").click(function(){
		$("#dialog_add").modal('show');
	});
	$('#dialog_add').on('shown.bs.modal', function () {
		$("#txtname").focus();
	});
	
});	

</script>
<script>
$(function(){
	$("#fPhoto").change(function(){
		var data = new FormData($("#form_change_Photo")[0]);
		jQuery.ajax({
			url: 'apps/slide/xhr/action-upload-photo.php',
			data: data,
			cache: false,
			contentType: false,
			processData: false,
			type: 'POST',
			dataType: 'json',
			success: function(response){
				console.log(response);
				if(response.success==true){
					$('#txtphoto').val(response.photo);
					//window.location.reload();
				}else{
					fn.engine.alert("Alert",response.msg);
				}	
			}
		});
	});
	/*$("#btnChangePhoto").click(function(){
		$("#dialogChangePhoto").modal("hide");
		$("#fPhoto").click();
	});*/
	$("#browAdd").click(function(e) {
        $("#fPhoto").click();
    });
});
</script>	