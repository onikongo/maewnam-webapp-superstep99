<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$job = $dbc->GetRecord("job","*","id=".$_REQUEST['id']);
	/*$customer = $dbc->GetRecord("customers","*","id=".$_REQUEST['id']);
	$contact = $dbc->GetRecord("contacts","*","id=".$customer['contact']);
	$address = $dbc->GetRecord("address","*","contact=".$contact['id']);*/
?>
<div class="modal fade" id="dialog_edit" data-backdrop="static">
  	<div class="modal-dialog">
		<form id="form_edit" class="form-horizontal" role="form" onSubmit="fn.app.job.save_change();return false;">
		<input type="hidden" id="txtID" name="txtID" value="<?php echo $job['id'];?>">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4>Edit job</h4>
      		</div>
		    <div class="modal-body">
				<div class="form-group">
					<div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    	<div class="col-sm-10">
                            <input id="txtphotoEdit" name="txtphotoEdit" type="text" class="form-control"value="<?php echo$job['image'] ?>" >
                        </div>   
                        <div class="col-sm-2">
                            <div class="btn btn-default" data-toggle="modal" id="browEdit" >Browse</div>
                        </div> 
						<div class="seperator"></div>
						<div class="seperator"></div>
					</div><!-- /.col -->
				</div><!-- /.col -->
				<div class="form-group">
					<label class="col-sm-2 control-label">name</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="txtname" name="txtname" value="<?php echo$job['name'] ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">job</label>
					<div class="col-sm-10">
						<textarea rows="6" type="text" class="form-control" id="txtjob" name="txtjob">
						<?php echo$job['detail'] ?>
						</textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">property</label>
					<div class="col-sm-10">
						<textarea rows="6" type="text" class="form-control" id="txtproperty" name="txtproperty">
						<?php echo$job['property'] ?>
						</textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">salary</label>
					<div class="col-sm-10">
					<input type="number" class="form-control" id="tx_price" name="tx_price" placeholder="0" value="<?php echo$job['salary'] ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">place</label>
					<div class="col-sm-10">
						<!--
						<input type="text" class="form-control" id="txtname" name="txtname">
						-->
						<select class="form-control" id="city" name="city">
						<?php
							//$select = "SELECT * FROM category WHERE id ='".$product['category']."'";
							$sql="SELECT * FROM cities";
							$rst = $dbc->Query($sql);
							while($line = $dbc->Fetch($rst)){
								echo '<option value="'.$line['id'].'"'.($line['id']==$job['place']?" selected":"").'>'.$line['name'].'</option>';
							}
						?>
						</select>
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


<div class="modal fade" id="dialogChangePhotoEdit" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4>Are you sure to change photo</h4>
				</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button id="btnChangePhotoEdit" type="submit" class="btn btn-primary">Change</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
	<form id="form_change_PhotoEdit" class="hidden">
		<input name="txtID" value="" type="hidden">
		<input id="fPhotoEdit" name="file" type="file">
	</form>
<script >
$(function(){
	$("#fPhotoEdit").change(function(){
		var data = new FormData($("#form_change_PhotoEdit")[0]);
		jQuery.ajax({
			url: 'apps/job/xhr/action-upload-photo.php',
			data: data,
			cache: false,
			contentType: false,
			processData: false,
			type: 'POST',
			dataType: 'json',
			success: function(response){
				console.log(response);
				if(response.success==true){
					$('#txtphotoEdit').val(response.photo);
					//window.location.reload();
				}else{
					fn.engine.alert("Alert",response.msg);
				}	
			}
		});
	});
	/*$("#btnChangePhotoEdit").click(function(){
		$("#dialogChangePhotoEdit").modal("hide");
		$("#fPhoto").click();
	});*/
	
	$("#browEdit").click(function(e) {
        $("#fPhotoEdit").click();
    });
});
</script>	