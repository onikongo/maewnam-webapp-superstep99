<?php
	$user = $dbc->GetRecord("users","*","id=".$_SESSION['auth']['user_id']);
	$contact = $dbc->GetRecord("contacts","*","id=".$user['contact']);
	$address = $dbc->GetRecord("address","*","contact=".$contact['id']);
	$setting = json_decode($user['setting'],true);
?>

<div class="row">
	<div class="panel panel-info pull-right">
		<div class="panel-body">
			Last Update on <?php echo $user['updated'];?>
		</div>
	</div><!-- /panel -->
</div><!-- /.row -->

<div class="panel panel-default">
	<form id="formEditProfile" onsubmit="fn.app.profile.update();return false;" class="form-horizontal form-border">
		<input type="hidden" name="txtUserID" value="<?php echo $user['id'];?>">
		<input type="hidden" name="txtContactID" value="<?php echo $contact['id'];?>">
		<input type="hidden" name="txtAddressID" value="<?php echo $address['id'];?>">
		<div class="panel-heading">
			Basic Information
		</div>
		<div class="panel-body">
			<div class="form-group">
				<label class="control-label col-md-2">Username</label>				
				<div class="col-md-10">
					<input name="txtUsername" type="text" class="form-control input-sm" placeholder="Username" value="<?php echo $user['name'];?>">
				</div><!-- /.col -->
			</div><!-- /form-group -->
			<div class="form-group">
				<label class="control-label col-md-2">Password</label>
				<div class="col-md-10">
					<input name="txtPassword" type="password" class="form-control input-sm" value="Password">
				</div><!-- /.col -->
			</div><!-- /form-group -->
			<div class="form-group">
				<label class="control-label col-md-2">Name</label>				
				<div class="col-md-4">
					<input name="txtName" type="text" class="form-control input-sm" placeholder="Name" value="<?php echo $contact['name'];?>">
				</div><!-- /.col -->
				<label class="control-label col-md-2">Surname</label>				
				<div class="col-md-4">
					<input name="txtSurname" type="text" class="form-control input-sm" placeholder="Surname" value="<?php echo $contact['surname'];?>">
				</div><!-- /.col -->
			</div><!-- /form-group -->
			<div class="form-group">
				<label class="control-label col-md-2">Email</label>
				<div class="col-md-10">
					<input name="txtEmail" type="email" class="form-control input-sm" value="<?php echo $contact['email'];?>">
				</div><!-- /.col -->
			</div><!-- /form-group -->
			<div class="form-group">
				<label class="col-sm-2 control-label">Title</label>
				<div class="col-sm-2">
					<select id="cbbTitle" name="cbbTitle" class="form-control">
						<option<?php if($contact['title']=="Mr.")echo" selected";?>>Mr.</option>
						<option<?php if($contact['title']=="Mrs.")echo" selected";?>>Mrs.</option>
						<option<?php if($contact['title']=="Miss.")echo" selected";?>>Miss.</option>
						<option<?php if($contact['title']=="Ms.")echo" selected";?>>Ms.</option>
						<option<?php if($contact['title']=="Mx.")echo" selected";?>>Mx.</option>
					</select>
				</div>
				<label class="col-sm-1 control-label">Gender</label>
				<div class="col-sm-2">
					<select id="cbbGender" name="cbbGender" class="form-control">
						<option value="male"<?php if($contact['gender']=="male")echo" selected";?>>Male</option>
						<option value="female"<?php if($contact['gender']=="female")echo" selected";?>>Female</option>
					</select>
				</div>
				<label for="txtName" class="col-sm-1 control-label">DOB</label>
				<div class="col-sm-4">
					<input type="date" class="form-control" id="txtDOB" name="txtDOB" placeholder="Date of Birth" value="<?php echo date("Y-m-d",strtotime($contact['dob']));?>">
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-md-2">Address</label>
				<div class="col-md-10">
					<textarea name="txtAddress" class="form-control" rows="3"><?php echo $address['address'];?></textarea>
				</div><!-- /.col -->
			</div><!-- /form-group -->
			<div class="form-group">
				<label class="control-label col-md-2">Phone</label>
				<div class="col-md-10">
					<input name="txtPhone" type="text" class="form-control input-sm" value="<?php echo $contact['phone'];?>">
				</div><!-- /.col -->
			</div><!-- /form-group -->
			<div class="form-group">
				<label class="control-label col-md-2">Mobile</label>
				<div class="col-md-10">
					<input name="txtMobile" type="text" class="form-control input-sm" value="<?php echo $contact['mobile'];?>">
				</div><!-- /.col -->
			</div><!-- /form-group -->
		</div>
		<div class="panel-footer">
			<div class="text-right">
				<button class="btn btn-sm btn-success">Update</button>
				<button class="btn btn-sm btn-success" type="reset">Reset</button>
			</div>
		</div>
	</form>
</div><!-- /panel -->

<div class="panel panel-default">
	<div class="panel-heading">
		E-Mail Setting
	</div>
	<div class="panel-body padding-xs">
	<?php
		if(isset($setting['email_server'])){
			echo '<div class="alert alert-info">';
				echo '<strong>Complete</strong> ';
			echo '</div>';
		}else{
			echo '<div class="alert alert-warning"><strong>Warning!</strong> There is no mail server configuration!</div>';
		}
	?>	
	</div>
	<div class="panel-footer clearfix">
		<a id="btnEditMailServer" class="btn btn-xs btn-success pull-right">Change Setting</a>
	</div>
</div><!-- /panel -->

<div class="panel panel-default">
	<form id="formEditPersonalization" onsubmit="fn.app.profile.edit_personalization();return false;" class="form-horizontal form-border">
	<input type="hidden" name="txtID" value="<?php echo $user['id'];?>">
	<div class="panel-heading">
		Personalization
	</div>
	<div class="panel-body padding-xs">
		<textarea name="txtComment" class="form-control no-border no-shadow" rows="5" placeholder="Who are you?"><?php if(isset($setting['personalization'])){echo base64_decode($setting['personalization']);}?></textarea>
	</div>
	<div class="panel-footer clearfix">
		<button class="btn btn-xs btn-success pull-right">Change Setting</button>
	</div>
	</form>
</div><!-- /panel -->
							
<script>
$(function(){
	var func = function(){
		$.post('apps/profile/xhr/action-update-profile.php',$('#formEditProfile').serialize(),function(response){
			if(response.success){
				window.location="?app=profile&view=edit";
			}else{
				fn.engine.alert("Alert",response.msg);
			}
		},'json');
		return false;
	};
	$.extend(fn.app.profile,{update:func});
	
	var func = function(){
		$.post('apps/profile/xhr/action-edit-personalization.php',$('#formEditPersonalization').serialize(),function(response){
			if(response.success){
				window.location="?app=profile&view=edit";
			}else{
				fn.engine.alert("Alert",response.msg);
			}
		},'json');
		return false;
	};
	$.extend(fn.app.profile,{edit_personalization:func});
});
</script>