<script type="text/javascript" src="apps/job/app.js"></script>
<?php
	include_once "apps/job/include/me.class.php";
	$my = new meClass;
	$view = isset($_REQUEST['view'])?$_REQUEST['view']:"job";
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
								
								<div class="tab-pane fade<?php if($view=="job")echo" in active";?>" id="job">
								<div align="right" class="itoolbar"></div>
								<?php
									include_once "apps/job/view/page.table.php";
									
									if($os->allow('job','add'))
									include_once "apps/job/control/controller.add.php";
								
									if($os->allow('job','edit'))
									include_once "apps/job/control/controller.change.php";
									
									if($os->allow('job','delete'))
									include_once "apps/job/control/controller.remove.php";
								?>
								</div>
							</div>
						</div>
					</div><!-- /panel -->
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.padding20 -->
	</div><!-- /main-container -->