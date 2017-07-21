<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$state = $dbc->GetRecord("states","*","id=".$_REQUEST['id'])
?>
<div class="modal fade" id="dialog_edit_state" data-backdrop="static">
  	<div class="modal-dialog">
		<form id="form_editstate" class="form-horizontal" role="form" onsubmit="fn.app.geographic.state.change();return false;">
		<input type="hidden" name="txtID" value="<?php echo $state['id'];?>">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4>Edit State</h4>
      		</div>
		    <div class="modal-body">
				<div class="form-group">
					<label for="cbbCountry" class="col-sm-2 control-label">Country</label>
					<div class="col-sm-10">
						<select class="form-control" id="cbbCountry" name="cbbCountry">
						<?php
							$sql = "SELECT * FROM countries";
							$rst = $dbc->Query($sql);
							while($line = $dbc->Fetch($rst)){
								echo '<option value="'.$line['id'].'"'.($line['id']==$state['country']?" selected":"").'>'.$line['name'].'</option>';
							}
						?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="txtName" class="col-sm-2 control-label">Name</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="txtName" name="txtName" placeholder="State Name" value="<?php echo $state['name'];?>">
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
	$('#dialog_edit_state').on('shown.bs.modal', function () {
		$("#txtName").focus();
	});
	$("#dialog_edit_state").on("hidden.bs.modal",function(){
		$(this).remove();
	});
	$("#dialog_edit_state").modal('show');
});	
</script>
