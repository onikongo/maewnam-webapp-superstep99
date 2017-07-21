<script type="text/javascript" src="apps/product/app.js"></script>
<?php
	include_once "apps/product/include/me.class.php";
	$my = new meClass;
	$view = isset($_REQUEST['view'])?$_REQUEST['view']:"product";
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
							<?php
								$my->PageTabPanel($view);
							?>
						</div>
						<div class="panel-body">
							<div class="tab-content">
								
								<div class="tab-pane fade<?php if($view=="product")echo" in active";?>" id="product">
								<div align="right" class="itoolbar"></div>
								<?php
									include_once "apps/product/view/page.table.php";
									
									if($os->allow('product','add'))
									include_once "apps/product/control/controller.add.php";
								
									if($os->allow('product','edit'))
									include_once "apps/product/control/controller.change.php";
									
									if($os->allow('product','delete'))
									include_once "apps/product/control/controller.remove.php";
								?>
								</div>
							</div>
						</div>
					</div><!-- /panel -->
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.padding20 -->
	</div><!-- /main-container -->