<script type="text/javascript" src="apps/blog/app.js"></script>
<?php
	include_once "apps/blog/include/me.class.php";
	$my = new meClass;
	$view = isset($_REQUEST['view'])?$_REQUEST['view']:"blog";
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
								<div class="tab-pane fade<?php if($view=="blog")echo" in active";?>" id="blog">
								<div align="right" class="itoolbar"></div>
								<?php
									include_once "apps/blog/view/page.table.php";
									
									if($os->allow('blog','add'))
									include_once "apps/blog/control/controller.add.php";
								
									if($os->allow('blog','edit'))
									include_once "apps/blog/control/controller.change.php";
									
									if($os->allow('blog','delete'))
									include_once "apps/blog/control/controller.remove.php";
								?>
								</div>
							</div>
						</div>
					</div><!-- /panel -->
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.padding20 -->
	</div><!-- /main-container -->