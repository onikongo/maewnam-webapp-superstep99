<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$city = $dbc->GetRecord("cities","*","id=".$_REQUEST['id'])
?>
<div class="modal fade" id="dialog_edit_city" data-backdrop="static">
  	<div class="modal-dialog">
		<form id="form_editcity" class="form-horizontal" role="form" onsubmit="fn.app.geographic.city.save_change();return false;">
		<input type="hidden" name="txtID" value="<?php echo $city['id'];?>">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4>Edit City</h4>
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
								echo '<option value="'.$line['id'].'"'.($line['id']==$city['country']?" selected":"").'>'.$line['name'].'</option>';
							}
						?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="cbbState" class="col-sm-2 control-label">State</label>
					<div class="col-sm-10">
						<select class="form-control" id="cbbState" name="cbbState">
						<?php
							$sql = "SELECT * FROM states";
							$rst = $dbc->Query($sql);
							while($line = $dbc->Fetch($rst)){
								echo '<option value="'.$line['id'].'"'.($line['id']==$city['country']?" selected":"").'>'.$line['name'].'</option>';
							}
						?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="txtName" class="col-sm-2 control-label">Name</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="txtName" name="txtName" placeholder="City Name" value="<?php echo $city['name'];?>">
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
	$('#dialog_edit_city').on('shown.bs.modal', function () {
		$("#txtName").focus();
	});
	$("#dialog_edit_city").on("hidden.bs.modal",function(){
		$(this).remove();
	});
	$("#dialog_edit_city").modal('show');
});	
</script>
