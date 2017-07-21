<?php
	session_start();
	include "../../config.php";
	include "../../include/db.php";
	include "../../include/oceanos.php";
	include "../../include/abox.php";
	include "../../include/widgeteer.php";
	include "include/me.class.php";
	
	$dbc = new dbc;
	$dbc->Connect();
	$me = new meClass($dbc);
	if(isset($_REQUEST['view']))$me->setView($_REQUEST['view']);
	
	
	class myWidget extends widgeteer{
		
		function widgetHeader(){
			echo '<h2><strong>Welcome to </strong> <i>Dashbaord</i></h2>';
		}
		
		function widgetBody(){
			echo '<h1>Welcom to OceanOS</h1>';
			
		}
		

	}
	$widget = new myWidget;
	
?>
<script src="apps/dashboard/include/interface.js"></script>
<div class="row">
	<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
	<?php
		$me->PageBreadcrumb();
	?>
	</div>
</div>
<section>
	<div class="row">
		<article class="col-sm-12 col-md-12 col-lg-12">
		<?php
			$widget->widget();
			
		?>
		</article>
	</div>
</section>
<script>
	pageSetUp();
</script>