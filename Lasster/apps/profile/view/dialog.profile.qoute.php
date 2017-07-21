<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../include/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$user = $dbc->GetRecord("users","*","id=".$_SESSION['auth']['user_id']);
	$contact = $dbc->GetRecord("contacts","*","id=".$user['contact']);
	$address = $dbc->GetRecord("address","*","contact=".$contact['id']);
	$setting = json_decode($user['setting'],true);
	
	if(isset($setting['qoute'])){
		$qoute = $setting['qoute'];
	}else{
		$qoute = array(
			"title" => base64_encode(""),
			"detail" => base64_encode("") 
		);
	}
?>
<div class="modal fade" id="dialog_edit_qoute" data-backdrop="static">
  	<div class="modal-dialog modal-lg">
		<form id="form_editqoute" class="form-horizontal" role="form" onsubmit="fn.app.profile.setqoute();return false;">
		<input type="hidden" name="txtID" value="<?php echo $user['id'];?>">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4>What about your?</h4>
      		</div>
		    <div class="modal-body">
				<div class="form-group">
					<label class="col-sm-2 control-label">About You</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="txtTitle" value="<?php echo base64_decode($qoute['title']);?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">More Detail</label>
					<div class="col-sm-10">
						<textarea class="form-control" name="txtDetail"><?php echo base64_decode($qoute['detail']);?></textarea>
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