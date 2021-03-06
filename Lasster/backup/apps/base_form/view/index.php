<script type="text/javascript" src="apps/category/app.js"></script>
<?php
	include_once "apps/category/include/me.class.php";
	$my = new meClass;
	$view = isset($_REQUEST['view'])?$_REQUEST['view']:"category";
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
								
								<div class="tab-pane fade<?php if($view=="category")echo" in active";?>" id="category">
								<div align="right" class="itoolbar"></div>
								<?php
									include_once "apps/category/view/page.table.php";
									
									if($os->allow('category','add'))
									include_once "apps/category/control/controller.add.php";
								
									if($os->allow('category','edit'))
									include_once "apps/category/control/controller.change.php";
									
									if($os->allow('category','delete'))
									include_once "apps/category/control/controller.remove.php";
								?>
								</div>
							</div>
						</div>
					</div><!-- /panel -->
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.padding20 -->
	</div><!-- /main-container -->