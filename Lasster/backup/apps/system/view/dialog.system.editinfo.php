<?php

	$json = $info;

?>
<div class="modal fade" id="dialog_edit_system_info" data-backdrop="static">
  	<div class="modal-dialog">
		<form id="form_editsysteminfo" class="form-horizontal" role="form">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4>Edit System Information</h4>
      		</div>
		    <div class="modal-body">
				<div class="form-group">
					<label for="txtName" class="col-sm-3 control-label">Company Name</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" id="txtName" name="txtName" placeholder="Orgnization Name" value="<?php echo $json['org_name'];?>">
					</div>
				</div>
				<div class="form-group">
					<label for="txtTax" class="col-sm-3 control-label">Tax ID</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" id="txtTax" name="txtTax" placeholder="Tax" value="<?php echo $json['tax_id'];?>">
					</div>
				</div>
				<div class="form-group">
					<label for="txtAddress" class="col-sm-3 control-label">Address</label>
					<div class="col-sm-9">
						<textarea class="form-control" id="txtAddress" name="txtAddress" placeholder="Address"><?php echo $json['address'];?></textarea>
					</div>
				</div>
				
				<div class="form-group">
					<label for="txtHome" class="col-sm-3 control-label">Phone</label>
					<div class="col-sm-9">
						<input type="tel" class="form-control" id="txtPhone" name="txtPhone" placeholder="Phone Number" value="<?php echo $json['phone'];?>">
					</div>
				</div>
				
				<div class="form-group">
					<label for="txtMobile" class="col-sm-3 control-label">Mobile</label>
					<div class="col-sm-9">
						<input type="tel" class="form-control" id="txtMobile" name="txtMobile" placeholder="Mobile Number" value="<?php echo $json['mobile'];?>">
					</div>
				</div>
				<div class="form-group">
					<label for="txtEmail" class="col-sm-3 control-label">Email</label>
					<div class="col-sm-9">
						<input type="email" class="form-control" id="txtEmail" name="txtEmail" placeholder="Email Address" value="<?php echo $json['email'];?>">
					</div>
				</div>
				<div class="form-group">
					<label for="txtEmail" class="col-sm-3 control-label">Website</label>
					<div class="col-sm-9">
						<input type="url" class="form-control" id="txtWebsite" name="txtWebsite" placeholder="Website" value="<?php echo $json['website'];?>">
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
	
	$("#system_info_toolbar").append('<button id="btnEditSystemInfo" type="button" class="btn btn-success btn-xs m-bottom-sm">Change</button>');
	$("#btnEditSystemInfo").click(function(){
		$("#dialog_edit_system_info").modal("show");
	});
	
	$("#form_editsysteminfo").submit(function(){
		$.post('apps/system/xhr/action-edit-info.php',$('#form_editsysteminfo').serialize(),function(response){
			if(response.success){
				window.location.reload();
			}else{
				fn.engine.alert("Alert",response.msg);
			}
		},'json');
		
		
		return false;
	});
	
});
</script>