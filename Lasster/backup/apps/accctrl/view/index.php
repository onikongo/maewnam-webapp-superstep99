<script type="text/javascript" src="apps/accctrl/app.js"></script>
<?php
	include_once "apps/accctrl/include/me.class.php";
	$my = new meClass;
	$view = isset($_REQUEST['view'])?$_REQUEST['view']:"group";
?>
<section class="content">	
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
								<div class="tab-pane fade<?php if($view=="group")echo" in active";?>" id="accctrl_group">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 m-b-5">
									<div align="right" class="itoolbar"></div>
								</div>
								<?php
									include_once "apps/accctrl/view/page.group.table.php";
									if($os->allow('accctrl','add'))
									include_once "apps/accctrl/control/controller.group.add.php";
									if($os->allow('accctrl','edit'))
									include_once "apps/accctrl/control/controller.group.change.php";
									if($os->allow('accctrl','edit'))
									include_once "apps/accctrl/control/controller.group.permission.php";
									if($os->allow('accctrl','delete'))
									include_once "apps/accctrl/control/controller.group.remove.php";
								?>
								</div>
								<div class="tab-pane fade<?php if($view=="user")echo" in active";?>" id="accctrl_user">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<div align="right" class="itoolbar"></div>
								</div>	
								<?php
									include_once "apps/accctrl/view/page.user.table.php";
									if($os->allow('accctrl','add'))
									include_once "apps/accctrl/control/controller.user.add.php";
									if($os->allow('accctrl','edit'))
									include_once "apps/accctrl/control/controller.user.change.php";
									if($os->allow('accctrl','delete'))
									include_once "apps/accctrl/control/controller.user.remove.php";
								?>
								</div>						
							</div>
						</div>
					</div><!-- /panel -->
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.padding20 -->
	</div><!-- /main-container -->
</section>		