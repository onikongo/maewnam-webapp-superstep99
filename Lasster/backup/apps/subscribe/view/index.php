<script type="text/javascript" src="apps/subscribe/app.js"></script>
<?php
	include_once "apps/subscribe/include/me.class.php";
	$my = new meClass;
	$view = isset($_REQUEST['view'])?$_REQUEST['view']:"subscribe";
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
								
								<div class="tab-pane fade<?php if($view=="subscribe")echo" in active";?>" id="subscribe">
								<div align="right" class="itoolbar"></div>
								<?php
									include_once "apps/subscribe/view/page.table.php";
									
									if($os->allow('subscribe','delete'))
									include_once "apps/subscribe/control/controller.remove.php";
									
								/* 	if($os->allow('job','add'))
									include_once "apps/job/control/controller.add.php"; */
								
								/* 	if($os->allow('subscribe','edit'))
									include_once "apps/subscribe/control/controller.change.php"; */
								?>
								</div>
							</div>
						</div>
					</div><!-- /panel -->
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.padding20 -->
	</div><!-- /main-container -->