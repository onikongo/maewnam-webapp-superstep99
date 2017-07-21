<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$category = $dbc->GetRecord("category","*","id=".$_REQUEST['id']);
	/*$customer = $dbc->GetRecord("customers","*","id=".$_REQUEST['id']);
	$contact = $dbc->GetRecord("contacts","*","id=".$customer['contact']);
	$address = $dbc->GetRecord("address","*","contact=".$contact['id']);*/
?>
<div class="modal fade" id="dialog_edit" data-backdrop="static">
  	<div class="modal-dialog">
		<form id="form_edit" class="form-horizontal" role="form" onSubmit="fn.app.category.save_change();return false;">
		<input type="hidden" id="txtID" name="txtID" value="<?php echo $category['id'];?>">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4>Edit category</h4>
      		</div>
		    <div class="modal-body">
            	<div class="form-group">
					<label class="col-sm-2 control-label">category</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="txtname" name="txtname" value="<?php echo $category['name'];?>">
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
