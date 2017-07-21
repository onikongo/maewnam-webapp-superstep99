<script type="text/javascript" src="apps/geographic/app.js"></script>
<?php
	include_once "apps/geographic/include/me.class.php";
	$my = new meClass;
	$view = isset($_REQUEST['view'])?$_REQUEST['view']:"country";
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
								<div class="tab-pane fade<?php if($view=="country")echo" in active";?>" id="geographic_country">
								<div align="right" class="itoolbar"></div>
								<?php
									include_once "apps/geographic/view/page.country.table.php";
									
									if($os->allow('geographic','add'))
									include_once "apps/geographic/control/controller.country.add.php";
								
									if($os->allow('geographic','edit'))
									include_once "apps/geographic/control/controller.country.change.php";
									
									if($os->allow('geographic','delete'))
									include_once "apps/geographic/control/controller.country.remove.php";
								?>
								</div>
								<div class="tab-pane fade<?php if($view=="state")echo" in active";?>" id="geographic_state">
								<div align="right" class="itoolbar"></div>
								<?php
								if($view=="city"){
									include_once "apps/geographic/view/page.state.table.php";
									
									if($os->allow('geographic','add'))
									include_once "apps/geographic/control/controller.state.add.php";
								
									if($os->allow('geographic','edit'))
									include_once "apps/geographic/control/controller.state.change.php";
									
									if($os->allow('geographic','delete'))
									include_once "apps/geographic/control/controller.state.remove.php";
								}
								?>
								</div>
								<div class="tab-pane fade<?php if($view=="city")echo" in active";?>" id="geographic_city">
								<div align="right" class="itoolbar"></div>
								<?php
								if($view=="city"){
									include_once "apps/geographic/view/page.city.table.php";
									
									if($os->allow('geographic','add'))
									include_once "apps/geographic/control/controller.city.add.php";
								
									if($os->allow('geographic','edit'))
									include_once "apps/geographic/control/controller.city.change.php";
									
									if($os->allow('geographic','delete'))
									include_once "apps/geographic/control/controller.city.remove.php";
								}
								?>
								</div>
								<div class="tab-pane fade<?php if($view=="district")echo" in active";?>" id="geographic_district">
								<div align="right" class="itoolbar"></div>
								<?php
								if($view=="district"){
									include_once "apps/geographic/view/page.district.table.php";
									
									if($os->allow('geographic','add'))
									include_once "apps/geographic/control/controller.district.add.php";
								
									if($os->allow('geographic','edit'))
									include_once "apps/geographic/control/controller.district.change.php";
									
									if($os->allow('geographic','delete'))
									include_once "apps/geographic/control/controller.district.remove.php";
								}
								?>
								</div>
								<div class="tab-pane fade<?php if($view=="subdistrict")echo" in active";?>" id="geographic_subdistrict">
								<div align="right" class="itoolbar"></div>
								<?php
									if($view=="subdistrict"){
										include_once "apps/geographic/view/page.subdistrict.table.php";
										
										if($os->allow('geographic','add'))
										include_once "apps/geographic/control/controller.subdistrict.add.php";
									
										if($os->allow('geographic','edit'))
										include_once "apps/geographic/control/controller.subdistrict.change.php";
										
										if($os->allow('geographic','delete'))
										include_once "apps/geographic/control/controller.subdistrict.remove.php";
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