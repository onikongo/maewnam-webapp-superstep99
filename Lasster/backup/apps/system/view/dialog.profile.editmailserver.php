<?php
	if(isset($setting['imap_server'])){
		$mailconfig = $setting['imap_server'];
	}else{
		$mailconfig = array(
			"imap_server" => "",
			"imap_incoming_port" => "",
			"imap_user" => "",
			"imap_password" => "",
			"imap_port" => ""
		);
	}

?>
<div class="modal fade" id="dialog_edit_system_mailserver" data-backdrop="static">
  	<div class="modal-dialog">
		<form id="form_edituser" class="form-horizontal" role="form" onsubmit="fn.app.accctrl.user.change();return false;">
		<input type="hidden" name="txtID" value="<?php echo $user['id'];?>">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4>Edit Personal Mail Server</h4>
      		</div>
		    <div class="modal-body">
				<div class="form-group">
					<label class="col-sm-2 control-label">Incomming</label>
					<div class="col-sm-7">
						<input type="text" class="form-control" id="txtIMAPServer" name="txtIMAPServer" value="<?php echo $mailconfig['imap_server']; ?>">
					</div>
					<label class="col-sm-1 control-label">Port</label>
					<div class="col-sm-2">
						<input type="text" class="form-control" id="txtIMAPServer" name="txtIMAPServer" value="<?php echo $mailconfig['imap_incoming_port']; ?>">
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-2 control-label">Username</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="txtIMAPUser" name="txtIMAPUser" value="<?php echo $mailconfig['imap_user']; ?>">
					</div>
					<label class="col-sm-2 control-label">Password</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="txtIMAPPass" name="txtIMAPPass">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Outgoing</label>
					<div class="col-sm-7">
						<input type="text" class="form-control" id="txtServer" name="txtServer">
					</div>
					<label class="col-sm-1 control-label">Port</label>
					<div class="col-sm-2">
						<input type="text" class="form-control" id="txtIMAPServer" name="txtIMAPServer" value="<?php echo $mailconfig['imap_incoming_port']; ?>">
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-2 control-label">Username</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="txtUsername" name="txtUsername">
					</div>
					<label class="col-sm-2 control-label">Password</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="txtPassword" name="txtPassword">
					</div>
				</div>
				<hr>
				<div class="form-group">
					<label class="col-sm-2 control-label">SSL</label>
					<div class="col-sm-4">
						<select class="form-control" name="cbbAuthenticate">
							<option class="none">None</option>
							<option class="tsl">TSL</option>
							<option class="ssl">SSL</option>
						</select>
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
<script>
$(function(){
	$("#btnEditMailServer").click(function(){
		console.log("TESTddd");
		$("#dialog_edit_system_mailserver").modal("show");
	});
});
</script>