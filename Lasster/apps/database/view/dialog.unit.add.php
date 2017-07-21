<div class="modal fade" id="dialog_add_unit" data-backdrop="static">
  	<div class="modal-dialog">
		<form id="form_addunit" class="form-horizontal" role="form" onsubmit="fn.app.database.unit.add();return false;">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4>Add unit</h4>
      		</div>
		    <div class="modal-body">
				
				<div class="form-group">
					<label class="col-sm-2 control-label">Name</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="txtName" placeholder="Industry Name">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Scale</label>
					<div class="col-sm-10">
						<input type="number" class="form-control" name="txtScale" placeholder="Scale">
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
