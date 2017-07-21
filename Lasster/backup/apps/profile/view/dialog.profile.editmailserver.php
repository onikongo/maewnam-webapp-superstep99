<?php
	if(isset($setting['email_server'])){
		$mailconfig = $setting['email_server'];
	}else{
		$mailconfig = array(
			"imap_server" => "",
			"imap_user" => "",
			"imap_password" => "",
			"imap_port" => "",
			
			"smtp_server" => "",
			"smtp_user" => "",
			"smtp_password" => "",
			"smtp_port" => "",
			"smtp_ssl" => "none"
		);
	}

?>
<div class="modal fade" id="dialog_edit_profile_mailserver" data-backdrop="static">
  	<div class="modal-dialog">
		<form id="form_editmailserver" class="form-horizontal" role="form" onsubmit="fn.app.profile.edit_mailserver();return false;">
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
						<input type="text" class="form-control" id="txtIMAPPort" name="txtIMAPPort" value="<?php echo $mailconfig['imap_port']; ?>">
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-2 control-label">Username</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="txtIMAPUser" name="txtIMAPUser" value="<?php echo $mailconfig['imap_user']; ?>">
					</div>
					<label class="col-sm-2 control-label">Password</label>
					<div class="col-sm-4">
						<input type="password" class="form-control" id="txtIMAPPass" name="txtIMAPPass" value="<?php echo $mailconfig['imap_password']; ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Outgoing</label>
					<div class="col-sm-7">
						<input type="text" class="form-control" id="txtSMTPServer" name="txtSMTPServer" value="<?php echo $mailconfig['smtp_server']; ?>">
					</div>
					<label class="col-sm-1 control-label">Port</label>
					<div class="col-sm-2">
						<input type="text" class="form-control" id="txtSMTPPort" name="txtSMTPPort" value="<?php echo $mailconfig['smtp_port']; ?>">
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-2 control-label">Username</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="txtSMTPUser" name="txtSMTPUser" value="<?php echo $mailconfig['smtp_user']; ?>">
					</div>
					<label class="col-sm-2 control-label">Password</label>
					<div class="col-sm-4">
						<input type="password" class="form-control" id="txtSMTPPass" name="txtSMTPPass" value="<?php echo $mailconfig['smtp_password']; ?>">
					</div>
				</div>
				<hr>
				<div class="form-group">
					<label class="col-sm-2 control-label">SSL</label>
					<div class="col-sm-4">
						<select class="form-control" name="cbbAuthenticate">
							<option value="none"<?php if($mailconfig['smtp_ssl']=="none")echo" selected";?>>None</option>
							<option value="tsl"<?php if($mailconfig['smtp_ssl']=="tsl")echo" selected";?>>TSL</option>
							<option value="ssl"<?php if($mailconfig['smtp_ssl']=="ssl")echo" selected";?>>SSL</option>
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
		$("#dialog_edit_profile_mailserver").modal("show");
	});
	
	
	var func = function(){
		$.post('apps/profile/xhr/action-edit-mailserver.php',$('#form_editmailserver').serialize(),function(response){
			if(response.success){
				window.location="?app=profile&view=edit";
			}else{
				fn.engine.alert("Alert",response.msg);
			}
		},'json');
		return false;
	};
	$.extend(fn.app.profile,{edit_mailserver:func});
});
</script>