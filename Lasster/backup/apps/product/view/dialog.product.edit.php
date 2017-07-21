<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$product = $dbc->GetRecord("products","*","id=".$_REQUEST['id'])
?>
<div class="modal fade" id="dialog_edit_product" data-backdrop="static">
  	<div class="modal-dialog">
		<form id="form_editproduct" class="form-horizontal" role="form" onsubmit="fn.app.product.change();return false;">
		<input type="hidden" name="txtID" value="<?php echo $product['id'];?>">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4>Edit Product</h4>
      		</div>
		    <div class="modal-body">
				<div class="form-group">
					<label class="col-sm-2 control-label">Code</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="txtCode" name="txtCode" placeholder="Product Name" value="<?php echo $product['name'];?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Name</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="txtName" name="txtName" placeholder="Product Name" value="<?php echo $product['name'];?>">
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
	$('#dialog_edit_product').on('shown.bs.modal', function () {
		$("#txtName").focus();
	});
	$("#dialog_edit_product").on("hidden.bs.modal",function(){
		$(this).remove();
	});
	$("#dialog_edit_product").modal('show');
});	
</script>
