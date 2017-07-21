<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$slide = $dbc->GetRecord("slide","*","id=".$_REQUEST['id']);
	/*$customer = $dbc->GetRecord("customers","*","id=".$_REQUEST['id']);
	$contact = $dbc->GetRecord("contacts","*","id=".$customer['contact']);
	$address = $dbc->GetRecord("address","*","contact=".$contact['id']);*/
?>
<div class="modal fade" id="dialog_edit" data-backdrop="static">
  	<div class="modal-dialog">
		<form id="form_edit" class="form-horizontal" role="form" onSubmit="fn.app.slide.save_change();return false;">
		<input type="hidden" id="txtVideoID" name="txtVideoID" value="<?php echo $slide['id'];?>">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4>Edit Video</h4>
      		</div>
		    <div class="modal-body">
            	<div class="form-group">
					<label class="col-sm-2 control-label">name slide</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="txtname" name="txtname" value="<?php echo $slide['name'];?>">
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    	<div class="col-sm-10">
                            <input id="txtphotoEdit" name="txtphotoEdit" type="text" class="form-control" value="<?php echo $slide['data'];?>">
                        </div>   
                        <div class="col-sm-2">
                            <div class="btn btn-default" data-toggle="modal" id="browEdit" >Browse</div>
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
		<input id="fPhotoEdit" name="file" type="file">
</form>

<script tyle="text/javascript">
$(function(){
	$("#fPhotoEdit").change(function(){
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
					$('#txtphotoEdit').val(response.photo);
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
	$("#browEdit").click(function(e) {
        $("#fPhotoEdit").click();
    });
});
</script>
