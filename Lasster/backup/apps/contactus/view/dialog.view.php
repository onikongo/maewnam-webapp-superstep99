<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$contact = $dbc->GetRecord("contactus","*","id=".$_REQUEST['id']);
?>
<div class="modal fade" id="dialog_edit" data-backdrop="static">
  	<div class="modal-dialog">
		<form id="form_editgroup" class="form-horizontal" role="form" onsubmit="fn.app.contactus.read('<?php echo $contact['id'];?>');return false;">
		<input type="hidden" name="txtID" value="<?php echo $contact['id'];?>">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4>View Detail </h4>
      		</div>
		    <div class="modal-body">
                <div class="form-group">
					<label for="txtName" class="col-sm-2 control-label">Subject</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="txtcodeEdit" name="txtcodeEdit" value="<?php echo $contact['subject']; ?>" readonly>
					</div>
				</div>
				<div class="form-group">
					<label for="txtName" class="col-sm-2 control-label">name</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="txtcodeEdit" name="txtcodeEdit" value="<?php echo $contact['name']; ?>" readonly>
					</div>
				</div>
				<div class="form-group">
					<label for="txtName" class="col-sm-2 control-label">phone</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="txtcodeEdit" name="txtcodeEdit" value="<?php echo $contact['phone']; ?>" readonly>
					</div>
				</div>
				<div class="form-group">
					<label for="txtName" class="col-sm-2 control-label">date</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="txtcodeEdit" name="txtcodeEdit" value="<?php echo $contact['created']; ?>" readonly>
					</div>
				</div>
                <div class="form-group">
					<label for="txtName" class="col-sm-2 control-label">Message</label>
					<div class="col-sm-10">
						<textarea type="text" class="form-control" id="parth_edit" name="parth_edit"  readonly><?php echo $contact['message'];?></textarea>
					</div>
				</div>
		    </div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-default" >Close</button>
				<!--
				<button data-dismiss="modal"  class="btn btn-default" >Close</button>
               -->
			</div>
	  	</div><!-- /.modal-content -->
		</form>
        
       
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<script tyle="text/javascript">
$(function(){
	$('#dialog_edit').on('shown.bs.modal', function () {
		$("#txtName").focus();
	});
	$("#dialog_edit").on("hidden.bs.modal",function(){
		$(this).remove();
	});
	$("#dialog_edit").modal('show');
});	

	
</script>

