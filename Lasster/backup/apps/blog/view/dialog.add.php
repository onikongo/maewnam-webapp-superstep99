<?php
	
?>
<div class="modal fade" id="dialog_add" data-backdrop="static">
  	<div class="modal-dialog">
		<form id="form_add" class="form-horizontal" role="form" onSubmit="fn.app.blog.add();return false;">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4>Add ACCESSORIES</h4>
      		</div>
		    <div class="modal-body">
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Profile</a></li>
					<li role="presentation"><a href="#Photo" aria-controls="Photo" role="tab" data-toggle="tab">Photo</a></li>
				</ul>
				<!-- Tab panes -->
			    <div class="tab-content">
					<div role="tabpanel" class="tab-pane active" id="profile">
						<br>
						<div class="form-group">
							<!--
							<div class="col-xs-12 col-sm-12 col-md-12 text-center">
							-->
								<label class="col-sm-2 control-label">File</label>
								<div class="col-sm-8 nopad">
									<input id="txtfile" name="txtfile" type="text" class="form-control" >
								</div>   
								<div class="col-sm-2">
									<div class="btn btn-default" data-toggle="modal" id="browAddFile" >Browse</div>
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
								<input type="text" class="form-control" id="txttitle" name="txttitle">
							</div>
						</div>
						<!--
						<div class="form-group">
							<label class="col-sm-2 control-label">brief</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="txtbrief" name="txtbrief">
							</div>
						</div>
						-->
						<div class="form-group">
							<label class="col-sm-2 control-label">Detail</label>
							<div class="col-sm-10">
								<textarea rows="6" type="text" class="form-control" id="txtdetail" name="txtdetail"></textarea>
							</div>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane" id="Photo">
						<br>
						<div class="form-group">
							<!--
							<div class="col-xs-12 col-sm-12 col-md-12 text-center">
							-->
								<div class="col-xs-12 col-sm-12 col-md-12 text-center">
								<label class="col-sm-6 control-label">Photo</label>
								<div class="col-sm-6">
									<div class="btn btn-default" data-toggle="modal" id="browAdd" >Browse</div>
								</div> 
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12 text-center">
									<div class="ShowImg"></div>
									<div class="seperator"></div>
									<div class="seperator"></div>
								</div><!-- /.col -->
							<!--
							</div>
							-->
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
	<form id="form_change_Photo" class="hidden">
		<input name="txtID" value="" type="hidden">
		<input id="fPhoto" name="file" type="file">
	</form>
	<form id="form_change_file" class="hidden">
		<input name="txtID" value="" type="hidden">
		<input id="ffile" name="file" type="file">
	</form>
<script>
$(function(){
	$("#fPhoto").change(function(){
		var data = new FormData($("#form_change_Photo")[0]);
		jQuery.ajax({
			url: 'apps/blog/xhr/action-upload-photo.php',
			data: data,
			cache: false,
			contentType: false,
			processData: false,
			type: 'POST',
			dataType: 'json',
			success: function(response){
				console.log(response);
				if(response.success==true){
					$('#txtphoto').val(response.photo);
					var s='';
					s+= '<div class="col-sm-4 test" style="margin-top:10px;">';
					s+= '<div class="col-sm-10" style="margin-bottom:10px;">';
					s+='<input type="text" class="form-control" id="txt_pic" name="txt_pic[]" value="'+response.photo+'" readonly>';
					s+= '</div>';
					s+='<div class="col-sm-2">';
					s+= '<button type="button" class="btn btn-danger" onclick="$(this).parent().parent().remove();"><i class="fa fa-times" aria-hidden="true"></i></button>';
					s+='</div>';
					s+= '<img src="'+response.photo+'" width="100px" />';
					s+= '</div>';
					$('.ShowImg').append(s);
				}else{
					fn.engine.alert("Alert",response.msg);
				}	
			}
		});
	});
	/*$("#btnChangePhoto").click(function(){
		$("#dialogChangePhoto").modal("hide");
		$("#fPhoto").click();
	});*/
	$("#browAdd").click(function(e) {
        $("#fPhoto").click();
    });
});
</script>	
	
<script>
$(function(){
	$("#ffile").change(function(){
		var data = new FormData($("#form_change_file")[0]);
		jQuery.ajax({
			url: 'apps/blog/xhr/action-upload-file.php',
			data: data,
			cache: false,
			contentType: false,
			processData: false,
			type: 'POST',
			dataType: 'json',
			success: function(response){
				console.log(response);
				if(response.success==true){
					$('#txtfile').val(response.file);
					//window.location.reload();
				}else{
					fn.engine.alert("Alert",response.msg);
				}	
			}
		});
	});
	/*$("#btnChangePhoto").click(function(){
		$("#dialogChangePhoto").modal("hide");
		$("#fPhoto").click();
	});*/
	$("#browAddFile").click(function(e) {
        $("#ffile").click();
    });
});
</script>	

<script tyle="text/javascript">

$(function(){
	var func = function(){
		$.post('apps/blog/xhr/action-add.php',$('#form_add').serialize(),function(response){
			if(response.success){
				$("#tbl").DataTable().draw();
				$("#dialog_add").modal('hide');
				$("#form_add")[0].reset();
			}else{
				fn.engine.alert("Alert",response.msg);
			}
		},'json');
		return false;
	};
	$.extend(fn.app.blog,{add:func});
	
	
	
	$("#panel-head-group").append('<button id="btnAdd" type="button" class="btn btn-primary pull-right">Add</button>');
	$("#btnAdd").click(function(){
		$("#dialog_add").modal('show');
	});
	$('#dialog_add').on('shown.bs.modal', function () {
		$("#txttitle").focus();
	});
	
	
});	

</script>
