<script type="text/javascript" href="apps/system/app.js"></script>
<?php
	include_once "apps/system/include/me.class.php";
	$my = new meClass;
	$section = isset($_REQUEST['view'])?$_REQUEST['view']:"overview";
?>
	<div id="main-container">
		<?php
			$my->PageHeader($section);
			$my->PageTabBar($section);
		?>
		
			
		<div class="padding-md">
			<div class="row">
				<div class="col-md-3 col-sm-3">
				<?php
					include_once "apps/system/view/page.system.info.php";
					if($os->allow('system','edit')){
						include_once "apps/system/view/dialog.system.editinfo.php";
					}
				?>
				</div><!-- /.col -->
				<div class="col-md-9 col-sm-9">
					<div class="tab-content">
						<div class="tab-pane fade<?php if($section=="overview")echo' in active';?>" id="overview">
						<?php
							if($section=="overview")
							include_once "apps/system/view/page.system.overview.php";
						?>		
						</div><!-- /tab1 -->
					</div><!-- /tab-content -->
				</div><!-- /.col -->
			</div><!-- /.row -->			
		</div><!-- /.padding-md -->
	</div><!-- /main-container -->