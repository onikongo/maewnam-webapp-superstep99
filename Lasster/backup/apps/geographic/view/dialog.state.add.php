<?php
	
?>
<div class="modal fade" id="dialog_add_state" data-backdrop="static">
  	<div class="modal-dialog">
		<form id="form_addstate" class="form-horizontal" role="form" onsubmit="fn.app.geographic.state.add();return false;">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4>Add State</h4>
      		</div>
		    <div class="modal-body">
				<div class="form-group">
					<label for="cbbCountry" class="col-sm-2 control-label">Country</label>
					<div class="col-sm-10">
						<select class="form-control" id="cbbCountry" name="cbbCountry">
						<?php
							$sql = "SELECT * FROM countries";
							$rst = $dbc->Query($sql);
							while($line = $dbc->Fetch($rst)){
								echo '<option value="'.$line['id'].'">'.$line['name'].'</option>';
							}
						?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="txtName" class="col-sm-2 control-label">Name</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="txtName" name="txtName" placeholder="State Name">
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
<script tyle="text/javascript">

$(function(){
	var func = function(){
		$.post('apps/geographic/xhr/action-add-state.php',$('#form_addstate').serialize(),function(response){
			if(response.success){
				$("#tblState").DataTable().draw();
				$("#dialog_add_state").modal('hide');
				$("#form_addstate")[0].reset();
			}else{
				fn.engine.alert("Alert",response.msg);
			}
		},'json');
		return false;
	};
	$.extend(fn.app.geographic.state,{add:func});
	
	$("#geographic_state .itoolbar").append('<button id="btnAddState" type="button" class="btn btn-primary">Add</button>');
	$("#btnAddState").click(function(){
		$("#dialog_add_state").modal('show');
	});
	$('#dialog_add_state').on('shown.bs.modal', function () {
		$("#txtName").focus();
	})
	
});	

</script>
