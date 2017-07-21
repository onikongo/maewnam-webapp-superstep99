<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$country = $dbc->GetRecord("countries","*","id=".$_REQUEST['id'])
?>
<div class="modal fade" id="dialog_edit_country" data-backdrop="static">
  	<div class="modal-dialog">
		<form id="form_editcountry" class="form-horizontal" role="form" onsubmit="fn.app.geographic.country.save_change();return false;">
		<input type="hidden" name="txtID" value="<?php echo $country['id'];?>">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4>Edit Country</h4>
      		</div>
		    <div class="modal-body">
				<div class="form-group">
					<label for="txtName" class="col-sm-2 control-label">Code</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="txtCode" name="txtCode" placeholder="Country Code" value="<?php echo $country['code'];?>">
					</div>
				</div>
				<div class="form-group">
					<label for="txtName" class="col-sm-2 control-label">Name</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="txtName" name="txtName" placeholder="Country Name" value="<?php echo $country['name'];?>">
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
$(function(){
	$('#dialog_edit_country').on('shown.bs.modal', function () {
		$("#txtName").focus();
	});
	$("#dialog_edit_country").on("hidden.bs.modal",function(){
		$(this).remove();
	});
	$("#dialog_edit_country").modal('show');
});	
</script>
