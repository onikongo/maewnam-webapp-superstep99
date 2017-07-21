<script type="text/javascript" src="apps/video/app.js"></script>
<?php
	include_once "apps/video/include/me.class.php";
	$my = new meClass;
	$view = isset($_REQUEST['view'])?$_REQUEST['view']:"video";
?>
	<!--
	<div id="main-container">
	-->
<section class="content">	
	<div id="wraper container-fluid">
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
								
								<div class="tab-pane fade<?php if($view=="video")echo" in active";?>" id="video">
								<div align="right" class="itoolbar"></div>
								<?php
									include_once "apps/video/view/page.table.php";
									
									if($os->allow('video','add'))
									include_once "apps/video/control/controller.add.php";
								
									if($os->allow('video','edit'))
									include_once "apps/video/control/controller.change.php";
									
									if($os->allow('video','delete'))
									include_once "apps/video/control/controller.remove.php";
								?>
								</div>
							</div>
                            <!--
							<div class="tab-content">
								<div class="tab-pane fade<?php //if($view=="group")echo" in active";?>" id="contact_group">
								<div align="right" class="itoolbar"></div>
								<?php/*
									include_once "apps/contact/view/page.group.table.php";
									
									if($os->allow('contact','add'))
									include_once "apps/contact/control/controller.group.add.php";
								
									if($os->allow('contact','edit'))
									include_once "apps/contact/control/controller.group.change.php";
									
									if($os->allow('contact','delete'))
									include_once "apps/contact/control/controller.group.remove.php";*/
								?>
								</div>
							</div>
							<div class="tab-content">
								<div class="tab-pane fade<?php //if($view=="organization")echo" in active";?>" id="contact_organization">
								<div align="right" class="itoolbar"></div>
								<?php/*
									include_once "apps/contact/view/page.organization.table.php";
									
									if($os->allow('contact','add'))
									include_once "apps/contact/control/controller.organization.add.php";
								
									if($os->allow('contact','edit'))
									include_once "apps/contact/control/controller.organization.change.php";
									
									if($os->allow('contact','delete'))
									include_once "apps/contact/control/controller.organization.remove.php";*/
								?>
								</div>
							</div>
                            -->
						</div>
					</div><!-- /panel -->
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.padding20 -->
	</div><!-- /main-container -->
</section>	