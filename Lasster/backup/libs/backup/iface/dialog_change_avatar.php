
<div class="modal animated fadeIn" id="modal_change_photo" tabindex="-1" role="dialog" aria-labelledby="smallModalHead" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="smallModalHead">Change photo</h4>
                    </div>                    
			<form id="cp_crop" method="post" action="libs/xhr/engine/crop_image.php">
				<div class="modal-body">
                        <div class="text-center" id="cp_target">Use form below to upload file. Only .jpg files.</div>
                        <input type="hidden" name="cp_img_path" id="cp_img_path"/>
                        <input type="hidden" name="ic_x" id="ic_x"/>
                        <input type="hidden" name="ic_y" id="ic_y"/>
                        <input type="hidden" name="ic_w" id="ic_w"/>
                        <input type="hidden" name="ic_h" id="ic_h"/>                        
				</div>                    
			</form>
			<form id="cp_upload" method="post" enctype="multipart/form-data" action="libs/xhr/engine/upload_image.php">
				<div class="modal-body form-horizontal form-group-separated">
					<div class="form-group">
						<label class="col-md-4 control-label">New Photo</label>
						<div class="col-md-4">
							<input type="file" class="fileinput btn-info" name="file" id="cp_photo" data-filename-placement="inside" title="Select file"/>
						</div>                            
					</div>                        
				</div>
			</form>
			<div class="modal-footer">
				<button type="button" class="btn btn-success disabled" id="cp_accept">Accept</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
        
         