<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../include/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$country = $dbc->GetRecord("countries","*","id=".$_REQUEST['id']);
?>
<div class="modal fade" id="dialog_edit_country" data-backdrop="static">
  	<div class="modal-dialog">
		<form id="form_editcountry" class="form-horizontal" role="form" onsubmit="fn.app.database.country.edit();return false;">
		<input type="hidden" name="txtID" value="<?php echo $country['id'];?>">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4>Edit country</h4>
      		</div>
		    <div class="modal-body">
				<div class="form-group">
					<label class="col-sm-2 control-label">Name</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="txtName" placeholder="Country Name" value="<?php echo $country['name'];?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Local Name</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="txtLocal" placeholder="Local Country Name" value="<?php echo $country['local_name'];?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">ISO</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" name="txtISO" placeholder="Abbreviation 2 Code" value="<?php echo $country['iso'];?>">
					</div>
					<label class="col-sm-2 control-label">ISO3</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" name="txtISO3" placeholder="Abbreviation 3 Code" value="<?php echo $country['iso3'];?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">PhoneCode</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="txtPhone" placeholder="Phone Code" value="<?php echo $country['phonecode'];?>">
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
<?php
	$dbc->Close();
?>