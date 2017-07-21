<div class="modal fade" id="dialog_add_country" data-backdrop="static">
  	<div class="modal-dialog">
		<form id="form_addcountry" class="form-horizontal" role="form" onsubmit="fn.app.database.country.add();return false;">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4>Add country</h4>
      		</div>
		    <div class="modal-body">
				<div class="form-group">
					<label class="col-sm-2 control-label">Name</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="txtName" placeholder="Country Name">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Local Name</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="txtLocal" placeholder="Local Country Name">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">ISO</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" name="txtISO" placeholder="Abbreviation 2 Code">
					</div>
					<label class="col-sm-2 control-label">ISO3</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" name="txtISO3" placeholder="Abbreviation 3 Code">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">PhoneCode</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="txtPhone" placeholder="Phone Code">
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
