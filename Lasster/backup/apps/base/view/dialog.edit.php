<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$video = $dbc->GetRecord("video","*","id=".$_REQUEST['id']);
	/*$customer = $dbc->GetRecord("customers","*","id=".$_REQUEST['id']);
	$contact = $dbc->GetRecord("contacts","*","id=".$customer['contact']);
	$address = $dbc->GetRecord("address","*","contact=".$contact['id']);*/
?>
<div class="modal fade" id="dialog_edit" data-backdrop="static">
  	<div class="modal-dialog">
		<form id="form_editvideo" class="form-horizontal" role="form" onSubmit="fn.app.video.save_change();return false;">
		<input type="hidden" id="txtVideoID" name="txtVideoID" value="<?php echo $video['id'];?>">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4>Edit Video</h4>
      		</div>
		    <div class="modal-body">
            	<div class="form-group">
					<label class="col-sm-2 control-label">name video</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="txtname" name="txtname" value="<?php echo $video['name'];?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">video link</label>
					<div class="col-sm-10">
                    	https://www.youtube.com/watch?v=<font color="#FF0000"><b>mk48xRzuNvA</b></font>
						<input type="text" class="form-control" id="linkvideo" name="linkvideo" placeholder="mk48xRzuNvA" value="<?php echo $video['data'];?> ">
					</div>
				</div>
		    </div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Save</button>
			</div>
	  	</div><!-- /.modal-content -->
		</form>
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script tyle="text/javascript">
/*$(function(){
	
	$('#dialog_edit').on('shown.bs.modal', function () {
		$("#txtName").focus();
	});
	$("#dialog_edit").on("hidden.bs.modal",function(){
		$(this).remove();
	});
	$("#dialog_edit").modal('show');
	$.extend(fn.app.contact.customer,{address:address});
});	*/
</script>
