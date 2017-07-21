<div class="modal fade" id="dialog_anouncement" data-backdrop="static">
  	<div class="modal-dialog">
		<form id="form_anouncement" class="form-horizontal" role="form" onsubmit="fn.app.profile.anouncement();return false;">
		<input type="hidden" name="txtID" value="<?php echo $user['id'];?>">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4>Anouncement</h4>
      		</div>
		    <div class="modal-body">
				<div class="form-group">
					<label class="col-sm-2 control-label">Topic</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="txtTopic" name="txtTopic">
					</div>
					
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Detail</label>
					<div class="col-sm-10">
						<textarea rows="8" class="form-control" name="txtDetail" id="txtDetail"></textarea>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-2 control-label">To</label>
					<div class="col-sm-4">
						<select class="form-control" name="cbbTarget">
							<option value="me">Me Only</option>
							<option value="all">All People</option>
							<option value="group">My Group</option>
						</select>
					</div>
				</div>
				
		    </div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Send</button>
			</div>
	  	</div><!-- /.modal-content -->
		</form>
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
$(function(){
	$("#btnAnouncement").click(function(){
		$("#dialog_anouncement").modal("show");
	});
	
	
	var func = function(){
		$.post('apps/profile/xhr/action-anouncement.php',$('#form_anouncement').serialize(),function(response){
			if(response.success){
				window.location="?app=profile&view=notification";
			}else{
				fn.engine.alert("Alert",response.msg);
			}
		},'json');
		return false;
	};
	$.extend(fn.app.profile,{anouncement:func});
});
</script>