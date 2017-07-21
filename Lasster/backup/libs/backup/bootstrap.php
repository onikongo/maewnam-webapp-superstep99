<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Ocean OS E-Commerce</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="E-Commerce System with Control Panel for E-Comerce Site">
		<meta name="author" content="Maewnam Network Solution Co., Ltd.">
		
		<link href="libs/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="libs/css/datatables.min.css" rel="stylesheet"/>
		<link href="libs/css/dataTables.bootstrap.min.css" rel="stylesheet"/>
		<link href="libs/css/font-awesome.min.css" rel="stylesheet">
		<link href="libs/css/pace.css" rel="stylesheet">
		<link href="libs/css/colorbox/colorbox.css" rel="stylesheet">
		<link href="libs/css/morris.css" rel="stylesheet"/>
		
		<link href="libs/css/endless.min.css" rel="stylesheet">
		<link href="libs/css/endless-skin.css" rel="stylesheet">
		<link href="libs/css/admin.css" rel="stylesheet">
		<!-- Jquery -->
		<script src="libs/js/jquery-2.2.0.min.js"></script>
		<!-- Jquery UI -->
		<script type="text/javascript" src="libs/js/jquery.ui.core.js"></script>
		<script type="text/javascript" src="libs/js/jquery.ui.widget.js"></script>
		<script type="text/javascript" src="libs/js/jquery.ui.mouse.js"></script>
		<script type="text/javascript" src="libs/js/jquery.ui.selectable.js"></script>
		<script type="text/javascript" src="libs/js/jquery.ui.button.js"></script>
		<script type="text/javascript" src="libs/js/jquery.ui.draggable.js"></script>
		<script type="text/javascript" src="libs/js/jquery.ui.droppable.js"></script>
		<script type="text/javascript" src="libs/js/jquery.ui.position.js"></script>
		<script type="text/javascript" src="libs/js/jquery.ui.resizable.js"></script>
		<script type="text/javascript" src="libs/js/jquery.ui.dialog.js"></script>
		<script type="text/javascript" src="libs/js/jquery.ui.sortable.js"></script>
		<!-- Data Table UI -->
		<script type="text/javascript" src="libs/js/jquery.dataTables.min.js"></script>
		
		<script src="libs/admin.js"></script>
	</head>
	<?php
	if(isset($_SESSION['auth'])){
	$_REQUEST['app'] = isset($_REQUEST['app'])?$_REQUEST['app']:"dashboard";
	?>
	<body class="overflow-hidden">
	
	<!-- Overlay Div -->
	<div id="overlay" class="transparent"></div>
	<div id="wrapper" class="preload">
		<?php
		include "apps/menu.php";
		
		include "libs/iface/iface_topnav.php";
		include "libs/iface/iface_navbar.php";
		
		
		$app = $_REQUEST['app'];
		include "apps/$app/view/index.php";

		?>
		
		<!--Modal-->
	</div><!-- /wrapper -->

	<a href="" id="scroll-to-top" class="hidden-print"><i class="fa fa-chevron-up"></i></a>
	
	<?php
		include_once "libs/iface/dialog_logout.php";
		include_once "libs/iface/dialog_notification.php";
	?>

	<!-- Bootstrap -->
	<script src="libs/bootstrap/js/bootstrap.js"></script>
	<!-- Morris -->
	<script src='libs/js/rapheal.min.js'></script>	
	<script src='libs/js/morris.min.js'></script>	
	<!-- Colorbox -->
	<script src='libs/js/jquery.colorbox.min.js'></script>	
	<!-- Sparkline -->
	<script src='libs/js/jquery.sparkline.min.js'></script>
	<!-- Pace -->
	<script src='libs/js/uncompressed/pace.js'></script>
	<!-- Popup Overlay -->
	<script src='libs/js/jquery.popupoverlay.min.js'></script>
	<!-- Slimscroll -->
	<script src='libs/js/jquery.slimscroll.min.js'></script>
	<!-- Modernizr -->
	<script src='libs/js/modernizr.min.js'></script>
	<!-- Cookie -->
	<script src='libs/js/jquery.cookie.min.js'></script>
	<!-- Endless -->
	<script src="libs/js/endless/endless.js"></script>
	
	
	<!-- OceanOS and Application -->

	</body>
	<?php
	}else{
		include_once "libs/iface/iface_login.php";
	}
	?>
</html>