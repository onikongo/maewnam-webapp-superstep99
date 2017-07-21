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
<script src="apps/accctrl/include/interface.js"></script>
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
			case "group":
				include "control/controller.group.view.js";
				include "control/controller.group.remove.js";
				include "control/controller.group.add.js";
				include "control/controller.group.edit.js";
				include "control/controller.group.permission.js";
				include "control/controller.group.role.js";
				break;
			case "user":
				include "control/controller.address.js";
				include "control/controller.user.view.js";
				include "control/controller.user.remove.js";
				include "control/controller.user.add.js";
				include "control/controller.user.edit.js";
				break;
			case "team":
				include "control/controller.team.view.js";
				include "control/controller.team.remove.js";
				include "control/controller.team.add.js";
				include "control/controller.team.edit.js";
				include "control/controller.team.avatar.js";
				include "control/controller.team.member.js";
				include "control/controller.user.lookup.js";
				break;
			case "role":
				include "control/controller.role.view.js";
				include "control/controller.role.remove.js";
				include "control/controller.role.add.js";
				include "control/controller.role.edit.js";
				break;
		}
	?>
	});});});});});});
</script>