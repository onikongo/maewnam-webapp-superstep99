<script type="text/javascript" src="apps/why_qrs/app.js"></script>
<?php
	include_once "apps/why_qrs/include/me.class.php";
	$my = new meClass;
	$view = isset($_REQUEST['view'])?$_REQUEST['view']:"why_qrs";
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
								<div class="tab-pane fade<?php if($view=="why_qrs")echo" in active";?>" id="why_qrs">
								<div align="right" class="itoolbar"></div>
								<?php
									include_once "apps/why_qrs/view/page.table.php";
									
									/* if($os->allow('cover','add'))
									include_once "apps/cover/control/controller.add.php"; */
								
									if($os->allow('why_qrs','edit'))
									include_once "apps/why_qrs/control/controller.change.php";
									
									// if($os->allow('cover','delete'))
									// include_once "apps/cover/control/controller.remove.php";
								?>
								</div>
							</div>
						</div>
					</div><!-- /panel -->
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.padding20 -->
	</div><!-- /main-container -->