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
	if(isset($_REQUEST['view']))$me->setView($_REQUEST['view']);
?>
<script src="apps/database/include/interface.js"></script>
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
			case "country":
				include "control/controller.country.view.js";
				include "control/controller.country.remove.js";
				include "control/controller.country.add.js";
				include "control/controller.country.edit.js";
				break;
			case "city":
				include "control/controller.city.view.js";
				include "control/controller.city.remove.js";
				include "control/controller.city.add.js";
				include "control/controller.city.edit.js";
				break;
			case "district":
				include "control/controller.district.view.js";
				include "control/controller.district.remove.js";
				include "control/controller.district.add.js";
				include "control/controller.district.edit.js";
				break;
			case "subdistrict":
				include "control/controller.subdistrict.view.js";
				include "control/controller.subdistrict.remove.js";
				include "control/controller.subdistrict.add.js";
				include "control/controller.subdistrict.edit.js";
				break;
			case "industry":
				include "control/controller.industry.view.js";
				include "control/controller.industry.remove.js";
				include "control/controller.industry.add.js";
				include "control/controller.industry.edit.js";
				break;
			case "unit":
				include "control/controller.unit.view.js";
				include "control/controller.unit.remove.js";
				include "control/controller.unit.add.js";
				include "control/controller.unit.edit.js";
				break;
		}
	?>
	});});});});});});
</script>