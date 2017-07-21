<?php
	$user = $dbc->GetRecord("users","*","id=".$_SESSION['auth']['user_id']);
	$contact = $dbc->GetRecord("contacts","*","id=".$user['contact']);
	$address = $dbc->GetRecord("address","*","contact=".$contact['id']);
	$setting = json_decode($user['setting'],true);
	
	if($contact['avatar']==""){
		$avatar = "libs/img/user.jpg";
	}else{
		$avatar = $contact['avatar'];
	}
	
	
	$total = $dbc->GetRecord("users",
		"COUNT(id) AS user,
		(SELECT COUNT(id) FROM organizations) AS organization,
		(SELECT COUNT(id) FROM customers) AS customer,
		(SELECT COUNT(log_id) FROM logs WHERE log_action != 'access') AS log,
		(SELECT COUNT(log_id) FROM logs) AS alllog"
	,"1");
	
	$activity = $dbc->GetRecord("logs",
		"(SELECT (COUNT(log_id)/$total[alllog]*100) FROM logs WHERE log_user=$user[id] AND log_action = 'access'),
		(SELECT (COUNT(log_id)/$total[log]*100) FROM logs WHERE log_user=$user[id] AND log_action LIKE '%add'),
		(SELECT (COUNT(log_id)/$total[log]*100) FROM logs WHERE log_user=$user[id] AND log_action LIKE '%edit'),
		(SELECT (COUNT(log_id)/$total[log]*100) FROM logs WHERE log_user=$user[id] AND log_action LIKE '%remove')"
	,"log_user = ".$user['id']);
	
	
?>
	<div class="row">
		<div class="col-xs-6 col-sm-12 col-md-6 text-center">
			<a href="#" data-toggle="modal" data-target="#dialogChangeAvarta">
				<img src="<?php echo $avatar;?>" alt="<?php echo $user['name'];?>" class="img-thumbnail">
			</a>
			<div class="seperator"></div>
			<div class="seperator"></div>
		</div><!-- /.col -->
		<div class="col-xs-6 col-sm-12 col-md-6">
			<strong class="font-14"><?php echo $contact['name']." ".$contact['surname'];?></strong>
			<small class="block text-muted">
				<?php echo $contact['email'];?>
			</small> 
			<div class="seperator"></div>
			<a class="btn btn-success btn-xs m-bottom-sm">Follow</a>
			<div class="seperator"></div>
			<a href="#" class="social-connect tooltip-test facebook-hover pull-left m-right-xs" data-toggle="tooltip" data-original-title="Facebook"><i class="fa fa-facebook"></i></a>
			<a href="#" class="social-connect tooltip-test twitter-hover pull-left m-right-xs" data-toggle="tooltip" data-original-title="Twitter"><i class="fa fa-twitter"></i></a>
			<a href="#" class="social-connect tooltip-test google-plus-hover pull-left" data-toggle="tooltip" data-original-title="Google Plus"><i class="fa fa-google-plus"></i></a>
			<div class="seperator"></div>
			<div class="seperator"></div>
		</div><!-- /.col -->
	</div><!-- /.row -->
	<div class="panel m-top-md">
		<div class="panel-body">
			<div class="row">
				<div class="col-xs-4 text-center">
					<span class="block font-14"><?php echo $total[0];?></span>
					<small class="text-muted">User</small>
				</div><!-- /.col -->
				<div class="col-xs-4 text-center">
					<span class="block font-14"><?php echo $total[1];?></span>
					<small class="text-muted">Group</small>
				</div><!-- /.col -->
				<div class="col-xs-4 text-center">
					<span class="block font-14"><?php echo $total[2];?></span>
					<small class="text-muted">Customer</small>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div>
	</div><!-- /panel -->
	
	<h5 class="headline">
		Your Activity
		<span class="line"></span>
	</h5>
	<dl>
		<dt>Access <span class="pull-right"><?php echo $activity[0];?></span></dt>
		<dd>
			<div class="progress progress-striped">
				<div class="progress-bar progress-bar-success animated-bar" style="width:90%"></div>
			</div>
		</dd>
		<dt>Add <span class="pull-right"><?php echo $activity[1];?></span></dt>
		<dd>
			<div class="progress progress-striped">
				<div class="progress-bar progress-bar-info animated-bar" style="width:<?php echo $activity[1];?>%"></div>
			</div>
		</dd>
		<dt>Change <span class="pull-right"><?php echo $activity[2];?></span></dt>
		<dd>
			<div class="progress progress-striped">
				<div class="progress-bar progress-bar-warning animated-bar" style="width:<?php echo $activity[2];?>%"></div>
			</div>
		</dd>
		<dt>Remove <span class="pull-right"><?php echo $activity[3];?></span></dt>
		<dd>
			<div class="progress progress-striped">
				<div class="progress-bar progress-bar-danger animated-bar" style="width:<?php echo $activity[3];?>%"></div>
			</div>
		</dd>
	</dl>
	<div class="modal fade" id="dialogChangeAvarta" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4>Are you sure to change photo</h4>
				</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button id="btnChangeAvatar" type="submit" class="btn btn-primary">Change</button>
				</div>
			</div><!-- /.modal-content -->
			</form>
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<form id="form_change_avatar" class="hidden">
		<input name="txtID" value="<?php echo $contact['id']?>" type="hidden">
		<input id="fAvatar" name="file" type="file">
	</form>
<script>
$(function(){
	$("#fAvatar").change(function(){
		var data = new FormData($("#form_change_avatar")[0]);
		jQuery.ajax({
			url: 'apps/profile/xhr/action-upload-avatar.php',
			data: data,
			cache: false,
			contentType: false,
			processData: false,
			type: 'POST',
			dataType: 'json',
			success: function(response){
				if(response.success){
					window.location.reload();
				}else{
					fn.engine.alert("Alert",response.msg);
				}	
			}
		});
	});
	$("#btnChangeAvatar").click(function(){
		$("#dialogChangeAvarta").modal("hide");
		$("#fAvatar").click();
	});
});
</script>