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
?>
<div class="">

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">General</a></li>
    <!--<li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Data</a></li>-->
    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Image</a></li>
    <!--<li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Discount</a></li>
    <li role="presentation"><a href="#reward" aria-controls="reward" role="tab" data-toggle="tab">Reward</a></li>-->
  </ul>

<form  id="add_product" class="form-horizontal">
  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane   active" id="home">
    	<br>
			
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Category</label>
                <div class="col-sm-3">
					<!--
                    <input type="number" class="form-control" id="tx_price" name="tx_price" placeholder="0">
					-->
					<select  id="cate" name="cate" class="form-control">
                    <?php  //$sql_cate = $dbc->Query("select * from categories"); //order by id asc
					 $sql_cate = $dbc->Query("select * from categories WHERE parent is null");
					while($c_row = $dbc->Fetch($sql_cate)) //mysqli_fetch_array $dbc->Fetch
					{
						echo '<option value="'.$c_row['id'].'">'.$c_row['name'].'</option>';
					}
					?>
                    </select>
                </div>
                <div class="col-sm-1">
                    
                </div>
            </div>
			<div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Brands</label>
                <div class="col-sm-3">
					<!--
                    <input type="number" class="form-control" id="tx_price" name="tx_price" placeholder="0">
					-->
					<select  id="brands" name="brands" class="form-control">
                    <?php  $sql_brand = $dbc->Query("select * from brands WHERE parent is null"); //order by id asc
					while($b_row = $dbc->Fetch($sql_brand)) //mysqli_fetch_array $dbc->Fetch
					{
						echo '<option value="'.$b_row['id'].'">'.$b_row['name'].'</option>';
					}
					?>
                    </select>
                </div>
                <div class="col-sm-1">
                    
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Product Name</label>
                <div class="col-sm-10">
                    <input type="text"  class="form-control" id="tx_name" maxlength="30" name="tx_name" placeholder="Product Name">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Brief</label>
                <div class="col-sm-10">
                    <input type="text"  class="form-control" id="tx_Brief" maxlength="80" name="tx_Brief" placeholder="Brief">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10">
                    <textarea class="form-control editor" id="tx_desc" name="tx_desc" placeholder="Category"></textarea>
                </div>
            </div>
        
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Size</label>
                <div class="col-sm-3">
                    <input type="number" class="form-control" id="tx_size" name="tx_size" placeholder="0">
                </div>
                <div class="col-sm-1">
                    
                </div>
            </div>
			
			<div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Color</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="tx_color" name="tx_color" placeholder="color">
                </div>
                <div class="col-sm-1">
                    
                </div>
            </div>
			
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Price</label>
                <div class="col-sm-3">
                    <input type="number" class="form-control" id="tx_price" name="tx_price" placeholder="0">
                </div>
                <div class="col-sm-1">
                    
                </div>
            </div>
			
			<div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Unit</label>
                <div class="col-sm-3">
                    <input type="number" class="form-control" id="tx_unit" name="tx_unit" placeholder="0">
                </div>
                <div class="col-sm-1">
                    
                </div>
            </div>
			<!--
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Discount</label>
                <div class="col-sm-3">
                    <input type="number" class="form-control" id="tx_Discount" name="tx_Discount" placeholder="0">
                </div>
                <div class="col-sm-1">
                    
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Promotion</label>
                <div class="col-sm-3">
                    <input type="number" class="form-control" id="tx_Promotion" name="tx_Promotion" placeholder="0">
                </div>
                <div class="col-sm-1">
                    
                </div>
            </div>
            -->
			
    </div><!--tap1-->
    
    
    
    <div role="tabpanel" class="tab-pane fade " id="messages">
    <br>
        <div class="form-group">
            <label for="txtPhoto" class="col-md-2 control-label">Photos</label>
            <div class="col-md-2" style="    margin-bottom: 20px;">
                <div class="btn btn-default" onClick="fn.app.product.add.add_photo.open_elfinder('a')">Browse</div>&nbsp;&nbsp;<font color="#FF0004">270px x 270px</font>
            </div><br>
            
            <div class="row col-md-12" id="thumbnail_photo">
            </div>
        </div>
        
    </div><!--tap3-->
    
    
  </div>
</form>
</div>
<style>
  #thumbnail_photo a_photo {  padding: 50px;  }
  .a_photo
{
  height:200px; 
}
</style>
<script>
  $(function() {
    $( "#thumbnail_photo" ).sortable();
    $( "#thumbnail_photo" ).disableSelection();
  });
  </script>
<script type="text/javascript">

$(function(){
	
	var func = {
		save_product:function(){
			var data = {
				Name : $("#tx_name").val(),
				cate : $("#cate").val(),
				brand : $("#brands").val(),
				size : $("#tx_size").val(),
				color : $("#tx_color").val(),
				Brief : $("#tx_Brief").val(),
				Description : $("#tx_desc").val(),
				Price : $("#tx_price").val(),
				Unit : $("#tx_unit").val(),
				Discount : $("#tx_Discount").val(),
				promotion : $("#tx_Promotion").val(),
				photos : []
			};
			
			$("#thumbnail_photo .a_photo").each(function(index, element) {
                data.photos.push({
						s_photos : $(this).find("input[name=txtPhoto]").val()
					});
            });
			
			
		$.ajax({
				url:"apps/product/xhr/action-add-product.php",
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
				window.open("apps/product/view/dialog_elfinder_product.php?name="+name+"&type=add", "_blank", "top=100, left=100,toolbar=no, resizable=no, width=800, height=600");
			},
			add_image : function(name,val){
				var s='';
					s += '<div class="col-md-12 a_photo">';
						s += '<div class="col-md-2"><i class="fa fa-arrows font20"></i></div>';
						s += '<div class="col-md-5"><img src="'+val+'" data-src="'+val+'" alt="..." style="cursor:move;height:200px;"></div>';
						s += '<input type="hidden" id="txtPhoto" class="txtPhoto" name="txtPhoto" value="'+val+'">';
						s += '<div class="col-md-5"><button type="button" class="btn btn-danger" onclick="$(this).parent().parent().remove()"><i class="fa fa-times-circle"></i></button></div>';
					s += '</div>';
					
				
				$("#thumbnail_photo").append(s);
				$("#cover").css({display:"none"});
			}
		},
		add_discount:function(){
			var t='';
					t+='<tr>';
						t+='<td>';
                    	t+='<select name="s_group" id="s_group" class="form-control">';
						 <?php 
							$sql_group1 = $dbc->Query("select * from customer_groups order by id asc");
							while($g_row1 = $dbc->Fetch($sql_group1))
							{?>
								t+='<option value="<?php echo $g_row1['id'];?>"><?php echo $g_row1['name'];?></option>';<?php
							}
						?>
                        t+='</select>';
						t+='</td>';
						t+='<td><input type="number"  min="1" class="form-control" id="tx_dis_qmt" name="tx_dis_qmt" ></td>';
						t+='<td><input type="number"  min="1" class="form-control" id="tx_dis_price" name="tx_dis_price" ></td>';
						t+='<td><input type="date"  class="form-control" id="tx_dis_start" name="tx_dis_start" ></td>';
						t+='<td><input type="date"  class="form-control" id="tx_dis_end" name="tx_dis_end" ></td>';
						t+='<td><button type="button" class="btn btn-danger" onClick="$(this).parent().parent().remove()"><i class="fa fa-minus"></i></button></td>';
					t+='</tr>';
					
				
			$("#responsiveTable tbody").append(t);
		},
		back:function(){
			window.location.reload();
		}
	};
	$.extend(fn.app.product,{add:func});
});

</script>

	<!-- Dropzone -->
	<script src='libs/js/dropzone.min.js'></script>	