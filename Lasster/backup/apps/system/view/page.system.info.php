<?php
	if($dbc->HasRecord("variable","name='aSystem_info'")){
		$line = $dbc->GetRecord("variable","value","name='aSystem_info'");
		$info = json_decode(base64_decode($line['value']),true);
	}else{
		$info = array(
			"org_name" => "",
			"taxid" => "",
			"address" => "",
			"phone" => "",
			"mobile" => "",
			"fax" => "",
			"email" => "",
			"website" => ""
		);
	}
	
	if($dbc->HasRecord("variable","name = 'fSystem_logo'")){
		$line= $dbc->GetRecord("variable","value","name = 'fSystem_logo'");
		$avatar = $line['value'];
	}else{
		$avatar = "libs/img/user.jpg";
	}
?>
	<div class="row">
		<div class="col-xs-6 col-sm-12 col-md-6 text-center">
			<a href="#" data-toggle="modal" data-target="#dialogChangeAvarta">
				<img src="<?php echo $avatar;?>" alt="<?php echo $info['org_name'];?>" class="img-thumbnail">
			</a>
			<div class="seperator"></div>
			<div class="seperator"></div>
		</div><!-- /.col -->
		<div class="col-xs-6 col-sm-12 col-md-6">
			<strong class="font-14"><?php echo $info['org_name'];?></strong>
			<small class="block text-muted">
				<?php echo $info['address'];?>
			</small> 
			<small class="block text-muted">
				<?php echo $info['email'];?>
			</small>
			<div class="seperator"></div>
			<small class="block text-muted">
				Tel : <?php echo $info['phone'];?>
			</small>
			<div class="seperator"></div>
				<div id="system_info_toolbar"></div>
			<div class="seperator"></div>
			
		</div><!-- /.col -->
	</div><!-- /.row -->
	<?php
		$line = $dbc->GetRecord("users","count(id)");
		$total_user = $line['0'];
		$line = $dbc->GetRecord("customers","count(id)");
		$total_customer = $line['0'];
		$line = $dbc->GetRecord("organizations","count(id)");
		$total_org = $line['0'];
	?>
	<div class="panel m-top-md">
		<div class="panel-body">
			<div class="row">
				<div class="col-xs-4 text-center">
					<span class="block font-14"><?php echo $total_user;?></span>
					<small class="text-muted">Users</small>
				</div><!-- /.col -->
				<div class="col-xs-4 text-center">
					<span class="block font-14"><?php echo $total_customer;?></span>
					<small class="text-muted">Customers</small>
				</div><!-- /.col -->
				<div class="col-xs-4 text-center">
					<span class="block font-14"><?php echo $total_org;?></span>
					<small class="text-muted">Organizations</small>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div>
	</div><!-- /panel -->
	
	
	
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
		<input id="fAvatar" name="file" type="file">
	</form>
<script>
$(function(){
	$("#fAvatar").change(function(){
		var data = new FormData($("#form_change_avatar")[0]);
		jQuery.ajax({
			url: 'apps/system/xhr/action-upload-avatar.php',
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