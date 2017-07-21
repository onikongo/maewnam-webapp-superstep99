<script type="text/javascript" src="apps/demographic/app.js"></script>
<?php
	include_once "apps/demographic/include/me.class.php";
	$my = new meClass;
	$view = isset($_REQUEST['view'])?$_REQUEST['view']:"industry";
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
								<div class="tab-pane fade<?php if($view=="industry")echo" in active";?>" id="demographic_industry">
								<div align="right" class="itoolbar"></div>
								<?php
								if($view=="industry"){
									include_once "apps/demographic/view/page.industry.table.php";
									
									if($os->allow('demographic','add'))
									include_once "apps/demographic/control/controller.industry.add.php";
								
									if($os->allow('demographic','edit'))
									include_once "apps/demographic/control/controller.industry.change.php";
									
									if($os->allow('demographic','delete'))
									include_once "apps/demographic/control/controller.industry.remove.php";
								}
								?>
								</div>						
							</div>
						</div>
					</div><!-- /panel -->
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.padding20 -->
	</div><!-- /main-container -->