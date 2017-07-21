<?php
	session_start();
	include "../../config/define.php";
	include "../../include/db.php";
	include "../../include/oceanos.php";
	include "../../include/abox.php";
	include "../../include/widgeteer.php";
	include "include/me.class.php";

	$dbc = new dbc;
	$dbc->Connect();
	$me = new meClass($dbc);
	$abox = new abox($dbc);
	if(isset($_REQUEST['view']))$me->setView($_REQUEST['view']);
	
?>
<script src="apps/profile/include/interface.js"></script>
<div class="row">
	<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
	<?php
		$me->PageBreadcrumb();
	?>
	</div>
</div>
<section id="widget-grid" class="">
	<div class="row">
		<article class="col-sm-12 col-md-12 col-lg-12">
		<?php
			$me->widget();
		?>
		</article>
	</div>
</section>
<script>
	pageSetUp();
	loadScript("js/plugin/datatables/jquery.dataTables.min.js", function(){
	loadScript("js/plugin/datatables/dataTables.colVis.min.js", function(){
	loadScript("js/plugin/datatables/dataTables.tableTools.min.js", function(){
	loadScript("js/plugin/datatables/dataTables.bootstrap.min.js", function(){
	loadScript("js/plugin/datatable-responsive/datatables.responsive.min.js",function(){
	loadScript("js/plugin/moment/moment.min.js",function(){
	<?php
		switch($me->getView()){
			case "overview":
				include_once "control/controller.profile.edit.js";
				include_once "control/controller.profile.avatar.js";
				include_once "control/controller.profile.qoute.js";
				break;
			
		}
	?>
	});});});});});});
</script>
<?php
	$dbc->Close();
?>