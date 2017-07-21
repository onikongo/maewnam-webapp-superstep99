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
	$product = $dbc->GetRecord("products","*","id=".$_REQUEST['id']);
	$product_detail = $dbc->GetRecord("product_detail","*","id=".$product['detail']);
	/* $mate_tag = $dbc->GetRecord("metatag","*","product=".$product['id']);
	$reward = $dbc->GetRecord("reward","*","product=".$product['id']); */
?>
<div class="">

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">General</a></li>
    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Image</a></li>
  </ul>

<form  id="add_product" class="form-horizontal">
<input type="hidden" name="txtID" id="txtID" value="<?php echo $_REQUEST['id'];?>">
  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane   active" id="home">
    	<br>
			
			
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Category</label>
                <div class="col-sm-3">
			
					<select  id="cate" name="cate" class="form-control">
                   	<?php $sql_cate = $dbc->Query("select * from categories WHERE parent is null");
					while($cate_row = $dbc->Fetch($sql_cate))
					{
						$select = ($cate_row['id']==$product['category'])?'selected':'';
						echo '<option value="'.$cate_row['id'].'" '.$select.'>'.$cate_row['name'].' </option>';
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
					<select  id="brands" name="brands" class="form-control">
					
					
					<?php $sql_brand = $dbc->Query("select * from brands WHERE parent is null");
					while($brand_row = $dbc->Fetch($sql_brand))
					{
						$select = ($brand_row['id']==$product['brand'])?'selected':'';
						echo '<option value="'.$brand_row['id'].'" '.$select.'>'.$brand_row['name'].' </option>';
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
                    <input type="text"  class="form-control" id="tx_name" maxlength="30" name="tx_name" value="<?php echo $product['name'];?>">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Brief</label>
                <div class="col-sm-10">
                    <input type="text"  class="form-control" id="tx_Brief" maxlength="80" name="tx_Brief" value="<?php echo $product_detail['brief'];?>">
                </div>
            </div>
			<div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10">
                    <textarea class="form-control editor" id="tx_desc" name="tx_desc" placeholder="Category"><?php echo base64_decode($product_detail['detail']);?></textarea>
                </div>
            </div>
			<!--
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10">
                    <textarea class="form-control editor" id="tx_desc" name="tx_desc" placeholder="Category"><?php //echo base64_decode($product['detail']);?></textarea>
                </div>
            </div>
			-->
             <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Size</label>
                <div class="col-sm-3">
                    <input type="number" class="form-control" id="tx_size" name="tx_size" placeholder="0" value="<?php echo $product_detail['size'];?>">
                </div>
                <div class="col-sm-1">
                    
                </div>
            </div>
			
			<div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Color</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="tx_color" name="tx_color" placeholder="color" value="<?php echo $product_detail['color'];?>">
                </div>
                <div class="col-sm-1">
                    
                </div>
            </div>
			
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Price</label>
                <div class="col-sm-3">
                    <input type="number" class="form-control" id="tx_price" name="tx_price" value="<?php echo $product['price'];?>">
                </div>
                <div class="col-sm-1">
                </div>
            </div>
			
			<div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Unit</label>
                <div class="col-sm-3">
                    <input type="number" class="form-control" id="tx_unit" name="tx_unit" placeholder="0" value="<?php echo $product['unit'];?>">
                </div>
                <div class="col-sm-1">
                    
                </div>
            </div>
			<!--
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Discount</label>
                <div class="col-sm-3">
                    <input type="number" class="form-control" id="tx_Discount" name="tx_Discount" value="<?php //echo $product['discount'];?>">
                </div>
                <div class="col-sm-1">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Point</label>
                <div class="col-sm-3">
                    <input type="number" class="form-control" id="tx_Point" name="tx_Point" placeholder="0" value="<?php //echo $product['point'];?>">
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
                <div class="btn btn-default" onClick="fn.app.product.edit.add_photo.open_elfinder('a')">Browse</div>&nbsp;&nbsp;<font color="#FF0004">270px x 270px</font>
            </div><br>
            
            <div class="row col-md-12" id="thumbnail_photo">
            	
				<?php
					$photo = json_decode($product_detail['photo'],true);
                    if(isset($photo))
                    {
                        foreach($photo as $img){
							echo '<div class="col-md-12 a_photo">';
								echo '<div class="col-md-2"><i class="fa fa-arrows font20"></i></div>';
								echo '<div class="col-md-5"><img src="'.$img.'" data-src="'.$img.'" alt="..." style="cursor:move;height:200px;"></div>';
								echo '<input type="hidden" id="txtPhoto" class="txtPhoto" name="txtPhoto" value="'.$img.'">';
								echo '<div class="col-md-5"><button type="button" class="btn btn-danger" onclick="$(this).parent().parent().remove()"><i class="fa fa-times-circle"></i></button></div>';
							echo '</div>';
                        }
                    }
                    else
                    {
                        ?>
                        <!--<span class="glyphicon glyphicon-picture" aria-hidden="true" style="font-size:50px;"></span>-->
                        <?php
                    }
                ?>
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
<script tyle="text/javascript">

$(function(){
	
	var func = {
		save_product:function(){
			var data = {
				/* txtID : $("#txtID").val(),
				Name : $("#tx_name").val(),
				Brief : $("#tx_Brief").val(),
				Description : $("#tx_desc").val(),
				Price : $("#tx_price").val(),
				Discount : $("#tx_Discount").val(),
				Point : $("#tx_Point").val(),
				photos : [] */
				txtID : $("#txtID").val(),
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
				url:"apps/product/xhr/action-edit-product.php",
				type:"POST",
				dataType:"json"	,
				data:data,
				success: function(response){
					window.location.reload();
					//if(response.success){
//						$("#tblProduct").DataTable().draw();
//						$("#dialog_add_product").modal('hide');
//						$("#form_addproduct")[0].reset();
//					}else{
//						fn.engine.alert("Alert",response.msg);
//					},'json');
//					return false;
				}
		});
			//$.post('apps/product/xhr/action-add-product.php',$('#add_product').serialize(),function(response){
				//
			//}
			//
		},
		
		add_photo : { 
			open_elfinder : function(name){
				window.open("apps/product/view/dialog_elfinder_product.php?name="+name+"&type=edit", "_blank", "top=100, left=100,toolbar=no, resizable=no, width=800, height=600");
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
			},
			open_main : function(name){
				window.open("apps/product/view/dialog_elfinder_product_main.php?name="+name+"&type=edit", "_blank", "top=100, left=100,toolbar=no, resizable=no, width=800, height=600");
			},
			add_image_main : function(name,val){
				$("#tx_main").val(val)
				$("#photo_main").attr('src',val);
			},
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
	$.extend(fn.app.product,{edit:func});
});

</script>

	<!-- Dropzone -->
	<script src='libs/js/dropzone.min.js'></script>	