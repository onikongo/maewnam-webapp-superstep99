<div class="modal animated fadeIn" id="modal_change_password" tabindex="-1" role="dialog" aria-labelledby="smallModalHead" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="smallModalHead">Change password</h4>
			</div>
			<div class="modal-body">
				<p>Please complete all information in the box!</p>
			</div>
			<div class="modal-body form-horizontal form-group-separated">	
				<form id="change_password" onsubmit="return false;">
				<div class="form-group">
					<label class="col-md-3 control-label">Old Password</label>
					<div class="col-md-9">
						<input type="password" class="form-control" name="old_password"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">New Password</label>
					<div class="col-md-9">
						<input type="password" class="form-control" name="new_password"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Repeat New</label>
					<div class="col-md-9">
						<input type="password" class="form-control" name="re_password"/>
					</div>
				</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" onclick="change_password()">Proccess</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div> 
		
<script>
	function change_password(){
		$.post('libs/xhr/system/change_password.php',$('#change_password').serialize(),function(response){
			if(response.success){
				window.location.reload();
			}else{
				fn.engine.alert("Alert",response.msg);
			}
		},'json');
	}
</script>