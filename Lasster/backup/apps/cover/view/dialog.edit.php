<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$blog = $dbc->GetRecord("cover","*","id=".$_REQUEST['id']);
	// $photo = $blog['image'];
	$photo = json_decode($blog['image'],true);	
	/*$customer = $dbc->GetRecord("customers","*","id=".$_REQUEST['id']);
	$contact = $dbc->GetRecord("contacts","*","id=".$customer['contact']);
	$address = $dbc->GetRecord("address","*","contact=".$contact['id']);*/
?>
<div class="modal fade" id="dialog_edit" data-backdrop="static">
  	<div class="modal-dialog">
		<form id="form_edit" class="form-horizontal" role="form" onSubmit="fn.app.cover.save_change();return false;">
		<input type="hidden" id="txtID" name="txtID" value="<?php echo $blog['id'];?>">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4>Edit Cover</h4>
      		</div>
			<div class="modal-body">
				<ul class="nav nav-tabs" role="tablist">
					<!--
					<li role="presentation" class="active"><a href="#profileEdit" aria-controls="profileEdit" role="tab" data-toggle="tab">Profile</a></li>
					-->
					<li role="presentation" class="active"><a href="#PhotoEdit" aria-controls="PhotoEdit" role="tab" data-toggle="tab">Photo</a></li>
				</ul>
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane" id="profileEdit">
						<br>	
						<div class="form-group">
						<!--
						<div class="col-xs-12 col-sm-12 col-md-12 text-center">
						-->
						<label class="col-sm-2 control-label">File</label>
						<div class="col-sm-8">
                            <input id="txtfileEdit" name="txtfileEdit" type="text" class="form-control" value="<?php echo $blog['file'];?>">
                        </div>   
                        <div class="col-sm-2">
                            <div class="btn btn-default" data-toggle="modal" id="browEditfile">Browse</div>
                        </div> 
						<div class="seperator"></div>
						<div class="seperator"></div>
						<!--
						</div>
						-->
						</div><!-- /.col -->
						<div class="form-group">
							<label class="col-sm-2 control-label">Title</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="txttitle" name="txttitle" value="<?php echo $blog['title'];?>">
							</div>
						</div>
						<!--
						<div class="form-group">
							<label class="col-sm-2 control-label">brief</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="txtbrief" name="txtbrief" value="<?php //echo $blog['brief'];?>">
							</div>
						</div>
						-->
						<div class="form-group">
							<label class="col-sm-2 control-label">Detail</label>
							<div class="col-sm-10">
								<textarea rows="6" type="text" class="form-control" id="txtdetail" name="txtdetail"><?php echo $blog['detail'];?></textarea>
							</div>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane active" id="PhotoEdit">
						<br>
						<div class="form-group">
							<div class="col-xs-12 col-sm-12 col-md-12 text-center">
								<div class="col-xs-12 col-sm-12 col-md-12 text-center">
									<label class="col-sm-6 control-label">Photo</label>
									<!--
									<div class="col-sm-8">
										<input id="txtphotoEdit" name="txtphotoEdit" type="text" class="form-control" value="<?php //echo $blog['image'];?>">
									</div>   
									-->
									<div class="col-sm-6">
										<div class="btn btn-default" data-toggle="modal" id="browEdit">Browse</div>
									</div> 
								</div>	 
								<?php 
								foreach( $photo as $a)
								{
								?>
								<div class="col-sm-4 test" style="margin-top:10px;">
									<div class="col-sm-10">
										<input type="text" class="form-control" id="txtphotoEdit" name="txtphotoEdit[]" value="<?php echo $a; ?>" readonly>
									</div>
									<div class="col-sm-2">
										<button type="button" class="btn btn-danger" onclick="$(this).parent().parent().remove();"><i class="fa fa-times" aria-hidden="true"></i></button>
									</div>
									<img src="<?php echo $a; ?> " width="300px" />
								</div>
								<?php	
								}
								?>
								<div class="ShowImgEdit"></div>
								<div class="seperator"></div>
								<div class="seperator"></div>
							</div>
						</div><!-- /.col -->
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

	<form id="form_change_PhotoEdit" class="hidden">
		<input name="txtID" value="" type="hidden">
		<input id="fPhotoEdit" name="file" type="file">
	</form>
	<form id="form_change_FileEdit" class="hidden">
		<input name="txtID" value="" type="hidden">
		<input id="fFileEdit" name="file" type="file">
	</form>
<script >
$(function(){
	$("#fPhotoEdit").unbind();
	$("#fPhotoEdit").change(function(){
		var data = new FormData($("#form_change_PhotoEdit")[0]);
		jQuery.ajax({
			url: 'apps/cover/xhr/action-upload-photo.php',
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
					var s='';
					s+= '<div class="col-sm-4 test" style="margin-top:10px;">';
					s+= '<div class="col-sm-10">';
					s+='<input type="text" class="form-control" id="txtphotoEdit" name="txtphotoEdit[]" value="'+response.photo+'" readonly>';
					s+= '</div>';
					s+='<div class="col-sm-2">';
					s+= '<button type="button" class="btn btn-danger" onclick="$(this).parent().parent().remove();"><i class="fa fa-times" aria-hidden="true"></i></button>';
					s+='</div>';
					s+= '<img src="'+response.photo+'" width="300px" />';
					s+= '</div>';
					$('.ShowImgEdit').append(s);
				/* 	$(".ShowImgEdit").unbind(s); */
				}else{
					fn.engine.alert("Alert",response.msg);
				}	
			}
		});
	});

	
	$("#browEdit").click(function(e) {
        $("#fPhotoEdit").click();
    });
});
</script>	

<script >
$(function(){
	$("#fFileEdit").change(function(){
		var data = new FormData($("#form_change_FileEdit")[0]);
		jQuery.ajax({
			url: 'apps/cover/xhr/action-upload-file.php',
			data: data,
			cache: false,
			contentType: false,
			processData: false,
			type: 'POST',
			dataType: 'json',
			success: function(response){
				console.log(response);
				if(response.success==true){
					$('#txtfileEdit').val(response.file);
					//window.location.reload();
				}else{
					fn.engine.alert("Alert",response.msg);
				}	
			}
		});
	});

	
	$("#browEditfile").click(function(e) {
        $("#fFileEdit").click();
    });
});
</script>	