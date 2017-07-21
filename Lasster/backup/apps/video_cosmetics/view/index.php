<script type="text/javascript" href="apps/video/app.js"></script>
<?php
	include_once "apps/video/include/me.class.php";
	$my = new meClass;
	$view = isset($_REQUEST['view'])?$_REQUEST['view']:"video";
?>
	<div id="main-container">
		<?php
			$my->PageHeader($view);
		?>
		<div class="padding-md">
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-tab clearfix">
							<div class="panel-heading">
								Video Management
							</div>
						</div>
						<div class="panel-body" id="product_container">
							<div align="right" class="itoolbar"></div>
                                <div class="view_old">
                                    <?php
                                    if($view=="video"){
                                        include_once "apps/video/view/page_video_table.php";
                                            
                                        if($os->allow('video','add'))
										?>
										<script>
											$("#product_container .itoolbar").append('<button id="btnAddProduct" type="button" class="btn btn-info"><i class="fa fa-plus font20"></i></button>');
											$("#btnAddProduct").click(function(){
			
												$.ajax({
													url:"apps/video/view/page_add_video.php",
													type:"POST",
													dataType:"html",
													data:{},
													success: function(resulted){
														$(".view_old").hide();
														$(".view_details").html(resulted);
														$("#btnAddProduct,#btnRemoveProduct").hide();
														$("#product_container .itoolbar").append('<button id="btnSaveProduct" type="button" class="btn btn-success" onclick="fn.app.video.add.save_product()"><i class="fa fa-floppy-o font20"></i></button>');
														$("#product_container .itoolbar").append('<button  type="button" class="btn btn-default" onclick="fn.app.video.add.back()"><i class="fa fa-reply font20"></i></button>');
													}
													
												});
											});
                                         </script>
										
										<?php
                                        //include_once "apps/product/view/page_add_product.php";
										//include_once "apps/product/view/dialog.product.add.php";
                                        
                                        if($os->allow('video','edit'))
										?>
										<script>
										$(function(){
											var funct = {
												edit_video:function(id){
													$.ajax({
														url:"apps/video/view/page_edit_video.php",
														type:"POST",
														dataType:"html",
														data:{id:id},
														success: function(resulted){
															$(".view_old").hide();
															$(".view_details").html(resulted);
															$("#btnAddProduct,#btnRemoveProduct").hide();
															$("#product_container .itoolbar").append('<button id="btnSaveProduct" type="button" class="btn btn-success" onclick="fn.app.video.edit.save_product()"><i class="fa fa-floppy-o font20"></i></button>');
															$("#product_container .itoolbar").append('<button  type="button" class="btn btn-default" onclick="fn.app.video.edit.back()"><i class="fa fa-reply font20"></i></button>');
															
														}
													});
												},
												hightlight:function(id){
													$.ajax({
														url:"apps/video/xhr/action-hightlight.php",
														type:"POST",
														dataType:"html",
														data:{id:id},
														success: function(resulted){
															$(".table").DataTable().draw();
															
														}
													});
												}
											};
											$.extend(fn.app.video,{edit:funct});
											
										 });
                                         </script>
										
										<?php
                                        //include_once "apps/product/view/controller.product.change.php";
                                            
                                        if($os->allow('video','delete'))
                                        include_once "apps/video/view/dialog.product.remove.php";
                                    }
                                    ?>
                                </div>
							<div class="view_details"></div>
						</div>
					</div><!-- /panel -->
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.padding20 -->
	</div><!-- /main-container -->