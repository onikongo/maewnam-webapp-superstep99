<?php
	
?>

<link href='libs/css/dropzone/dropzone.css' rel="stylesheet"/>
<div class="modal fade" id="dialog_add_product" data-backdrop="static">
  	<div class="modal-dialog">
		<form id="form_addproduct" class="form-horizontal" role="form" onsubmit="fn.app.product.add();return false;">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4>Add Product</h4>
      		</div>
		    <div class="modal-body">
				<div class="form-group">
					<label class="col-sm-2 control-label">Code</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="txtCode" name="txtCode" placeholder="Product Code">
					</div>
				</div>
				<div class="form-group">
					<label for="txtName" class="col-sm-2 control-label">Name</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="txtName" name="txtName" placeholder="Product Name">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Detail</label>
					<div class="col-sm-10">
						<textarea class="form-control" name="txtDetail"  placeholder="Product Description"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Category</label>
					<div class="col-sm-10">
						<select class="form-control" name="cbbParent">
							<option value="NULL">No Category</option>
						<?php
							$sql = "SELECT * FROM categories";
							$rst = $dbc->Query($sql);
							while($line = $dbc->Fetch($rst)){
								echo '<option value="'.$line['id'].'">'.$line['name'].'</option>';
							}
						?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Brand</label>
					<div class="col-sm-10">
						<select class="form-control" name="cbbParent">
							<option value="NULL">No Brand</option>
						<?php
							$sql = "SELECT * FROM brands";
							$rst = $dbc->Query($sql);
							while($line = $dbc->Fetch($rst)){
								echo '<option value="'.$line['id'].'">'.$line['name'].'</option>';
							}
						?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Price</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="txtPrice" name="txtPrice" placeholder="Price">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Quantity</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="txtAmount" name="txtAmount" placeholder="Start Quantity">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Status</label>
					<div class="col-sm-10">
						<label class="label-radio inline">
							<input name="chkStatus" value="0" type="radio">
							<span class="custom-radio"></span>
							Active
						</label>
						<label class="label-radio inline">
							<input name="chkStatus" value="1" type="radio">
							<span class="custom-radio"></span>
							Inactive
						</label>
					</div>
				</div>
				<div class="form-group">
								<label class="control-label col-lg-2">Dropzone</label>
								<div class="col-lg-10">
									<div class="alert">
										<i class="fa fa-warning"></i><span class="m-left-xs">This is just a demo dropzone. Uploaded files are not stored.</span>
									</div>
									<form action="." class="dropzone">
										  <div class="fallback">
											<input name="file" type="file" multiple />
										  </div>
									</form>
								</div><!-- /.col -->
				</div><!-- /form-group -->
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
		$.post('apps/product/xhr/action-add-product.php',$('#form_addproduct').serialize(),function(response){
			if(response.success){
				$("#tblProduct").DataTable().draw();
				$("#dialog_add_product").modal('hide');
				$("#form_addproduct")[0].reset();
			}else{
				fn.engine.alert("Alert",response.msg);
			}
		},'json');
		return false;
	};
	$.extend(fn.app.product,{add:func});
	
	$("#product_container .itoolbar").append('<button id="btnAddProduct" type="button" class="btn btn-primary">Add</button>');
	$("#btnAddProduct").click(function(){
		//$("#dialog_add_product").modal('show');
		
		$.ajax({
			url:"apps/product/view/page_add_product.php",
			type:"POST",
			dataType:"html",
			data:{},
			success: function(resulted){
				$(".view_old").hide();
				$(".view_details").html(resulted);
			}
		});
	});
	$('#dialog_add_product').on('shown.bs.modal', function () {
		$("#txtName").focus();
	})
	
});	

</script>
	<!-- Dropzone -->
	<script src='libs/js/dropzone.min.js'></script>	