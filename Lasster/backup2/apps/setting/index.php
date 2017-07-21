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
	$abox = new abox($dbc);
	$me = new meClass($dbc,$abox);
	if(isset($_REQUEST['view']))$me->setView($_REQUEST['view']);
?>
<script src="apps/setting/include/interface.js"></script>
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
				include_once "../profile/control/controller.profile.edit.js";
				include_once "../profile/control/controller.profile.avatar.js";
				include_once "../profile/control/controller.profile.qoute.js";
				break;
			case "profile":
				include "../profile/control/controller.profile.edit.js";
				include "../profile/control/controller.profile.avatar.js";
				include "../profile/control/controller.profile.qoute.js";
				include "../profile/control/controller.profile.setting.js";
				break;
			case "company":
				?>
				loadScript("js/plugin/x-editable/moment.min.js",function(){
				loadScript("js/plugin/x-editable/jquery.mockjax.min.js",function(){
				loadScript("js/plugin/x-editable/x-editable.min.js",function(){
				loadScript("js/plugin/typeahead/typeahead.min.js",function(){
				loadScript("js/plugin/typeahead/typeaheadjs.min.js",function(){
				<?php
					include "control/controller.company.edit.js";
				?>
				});});});});});
				<?php
				break;
				/*
			case "profile":
				include "control/controller.avatar.php";
				include "control/controller.profile.edit.php";
				include "control/controller.language.php";
				include "control/controller.email.setting.php";
				include "control/controller.mail.sender.php";
				include "control/controller.profile.detail.php";
				break;
			case "company":
				include "control/controller.icon.php";
				include "control/controller.company.edit.php";
				include "control/controller.sales.php";
				break;
			case "system":
				include "control/controller.system.general.php";
				include "control/controller.system.document.php";
				break;
				*/
		}
	?>
	});});});});});});
</script>