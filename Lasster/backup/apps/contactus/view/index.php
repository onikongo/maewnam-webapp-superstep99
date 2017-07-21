<script type="text/javascript" src="apps/contactus/app.js"></script>
<?php
	include_once "apps/contactus/include/me.class.php";
	$my = new meClass;
	$view = isset($_REQUEST['view'])?$_REQUEST['view']:"contactus";
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
								
								<div class="tab-pane fade<?php if($view=="contactus")echo" in active";?>" id="contactus">
								<div align="right" class="itoolbar"></div>
								<?php
									include_once "apps/contactus/view/page.table.php";
									
								/* 	if($os->allow('job','add'))
									include_once "apps/job/control/controller.add.php"; */
								
									if($os->allow('contactus','edit'))
									include_once "apps/contactus/control/controller.change.php";
									
									if($os->allow('contactus','delete'))
									include_once "apps/contactus/control/controller.remove.php";
								?>
								</div>
							</div>
						</div>
					</div><!-- /panel -->
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.padding20 -->
	</div><!-- /main-container -->