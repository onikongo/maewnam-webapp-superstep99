<script>
	$(document).ready(function(e) {
       $( 'textarea.editor' ).ckeditor();
    });
</script>
<?php
	$root = $_SERVER['DOCUMENT_ROOT'];
	include_once "../../../config/define.php";
	include_once "../../../libs/class/db.php";
	include_once "../../../libs/class/oceanos.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);

	$dbc = new dbc;
	$dbc->Connect();
	$articles = $dbc->GetRecord("video","*","id=".$_REQUEST['id']);
?>
<div class="">

<form  id="add_product" class="form-horizontal">
<input type="hidden" name="txtID" id="txtID" value="<?php echo $_REQUEST['id'];?>">
  <!-- Tab panes -->
    	<br>
        
            
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Category Name</label>
                <div class="col-sm-10">
                	<select  id="cate" name="cate" class="form-control">
                    <?php $sql_cate = $dbc->Query("select * from video_category order by id asc");
					while($c_row = $dbc->Fetch($sql_cate))
					{
						?><option value="<?php echo $c_row['id'];?>" <?php echo($c_row['id']==$articles['category'])?'selected':'';?>><?php echo $c_row['name'];?></option><?php
					}
					?>
                    	
                    </select>
                    
                </div>
            </div>
            <script>
			$(document).ready(function(e) {
                $.ajax({
					url:"apps/video/xhr/action-load-subcate.php",
					type:"POST",
					dataType:"html",
					data:{cate:$("#cate").val()},
					success: function(response){
						$("#subCate").html(response);
					}
				});
				$("#cate").change(function(e) {
                    $.ajax({
						url:"apps/video/xhr/action-load-subcate.php",
						type:"POST",
						dataType:"html",
						data:{cate:$("#cate").val()},
						success: function(response){
							$("#subCate").html(response);
						}
					});
                });
            });
			</script>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Subcategory Name</label>
                <div class="col-sm-10">
                	<div id="subCate"></div>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                    <input type="text"  class="form-control" id="tx_title" name="tx_title"  value="<?php echo $articles['name'];?>">
                </div>
            </div>
             <?php /*?><div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Brief</label>
                <div class="col-sm-10">
                    <input type="text"  class="form-control" id="tx_brief" name="tx_brief" value="<?php echo $articles['brief'];?>">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10">
                    <textarea class="form-control editor" id="tx_desc" name="tx_desc" ><?php echo base64_decode($articles['detail']);?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Photo</label>
                <div class="col-sm-4">
                    <img class="img" width="100%" src="<?php echo $articles['photo'];?>">
                </div>
                <div class="col-sm-4">
                    <input type="text"  class="form-control" id="tx_photo" name="tx_photo" value="<?php echo $articles['photo'];?>">
                </div>
                <div class="col-md-2" style="    margin-bottom: 20px;">
                    <div class="btn btn-default" onClick="fn.app.video.edit.add_photo.open_elfinder()">Browse</div>
                </div>
            </div><?php */?>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Video</label>
                
                <div class="col-sm-5">
                    <iframe width="560" height="315" id="vdo" src="https://www.youtube.com/embed/<?php echo $articles['embed'];?>" frameborder="0" allowfullscreen></iframe>
                </div>
                <div class="col-sm-5">https://www.youtube.com/watch?v=<font color="#FF0000"><b>mk48xRzuNvA</b></font>
                    <input type="text"  class="form-control" id="tx_Video" name="tx_Video" value="<?php echo $articles['embed'];?>">
                </div>
            </div>
            
            
</form>
</div>
<script>
  $(function() {
    $( "#thumbnail_photo" ).sortable();
    $( "#thumbnail_photo" ).disableSelection();
	
	$("#tx_Video").keyup(function(e) {
        $("#vdo").attr('src',"https://www.youtube.com/embed/"+$(this).val());
    });
  });
  </script>
<script tyle="text/javascript">

$(function(){
	
	var func = {
		save_product:function(){
			var data = {
				txtID : $("#txtID").val(),
				cate : $("#cate").val(),
				sub_cate : $("#sub_cate").val(),
				tx_title : $("#tx_title").val(),
				/*tx_brief : $("#tx_brief").val(),
				tx_desc : $("#tx_desc").val(),
				tx_photo : $("#tx_photo").val(),*/
				tx_Video : $("#tx_Video").val()
				
			};
			
			
		$.ajax({
				url:"apps/video/xhr/action-edit-video.php",
				type:"POST",
				dataType:"json"	,
				data:data,
				success: function(response){
					window.location.reload();
				}
		 
		});
		},
		
	add_photo : { 
			open_elfinder : function(name){
				window.open("apps/video/view/dialog_elfinder_photo.php?name="+name+"&type=edit", "_blank", "top=100, left=100,toolbar=no, resizable=no, width=800, height=600");
			},
			add_image : function(name,val){
				$(".img").attr('src',val);
				$("#tx_photo").val(val);
				$("#cover").css({display:"none"});
			}
		},		
		back:function(){
			window.location.reload();
		}
	};
	$.extend(fn.app.video,{edit:func});
});

</script>

	<!-- Dropzone -->
	<script src='libs/js/dropzone.min.js'></script>	