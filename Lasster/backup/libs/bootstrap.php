<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>SuperStep99</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="SuperStep99">
		<meta name="author" content="SuperStep99">
		
		 <!-- Bootstrap core CSS -->
        <link href="libs/css/bootstrap.min.css" rel="stylesheet">
        <link href="libs/css/bootstrap-reset.css" rel="stylesheet">
        <link href="libs/css/jquery.dataTables.css" rel="stylesheet">

        <!--Animation css-->
        <link href="libs/css/animate.css" rel="stylesheet">

        <!--Icon-fonts css-->
        <link href="libs/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <link href="libs/assets/ionicon/css/ionicons.min.css" rel="stylesheet" />
        <link href="libs/assets/material-design-iconic-font/css/material-design-iconic-font.min.css" rel="stylesheet" />

        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="libs/assets/morris/morris.css">

        <!-- sweet alerts -->
        <link href="libs/assets/sweet-alert/sweet-alert.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="libs/css/style.css" rel="stylesheet">
        <link href="libs/css/helper.css" rel="stylesheet">
		
		<!-- Jquery -->
		<!--
		<script src="libs/js/jquery-2.2.0.min.js"></script>
		-->
		
		<script src="libs/js/jquery.js"></script>
		<script src="libs/js/wow.min.js"></script>
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

	<!--
	<a href="" id="scroll-to-top" class="hidden-print"><i class="fa fa-chevron-up"></i></a>
	-->
	
	<?php
		//include_once "libs/iface/dialog_logout.php";
		// include_once "libs/iface/dialog_notification.php";
	?>
	
	 <!-- js placed at the end of the document so the pages load faster -->
        <!--
		<script src="libs/js/jquery.js"></script>
		-->
        <script src="libs/js/bootstrap.min.js"></script>
        <script src="libs/js/pace.min.js"></script>
       
        <script src="libs/js/jquery.nicescroll.js" type="text/javascript"></script>

        <!--common script for all pages-->
        <script src="libs/js/jquery.app.js"></script>
	<!-- Bootstrap -->
	<!--
	<script src="libs/bootstrap/js/bootstrap.js"></script>
	-->
	<!-- Morris -->
	<!--
	<script src='libs/js/rapheal.min.js'></script>	
	<script src='libs/js/morris.min.js'></script>	
	-->
	<!-- Colorbox -->
	<!--
	<script src='libs/js/jquery.colorbox.min.js'></script>	
	-->
	<!-- Sparkline -->
	<!--
	<script src='libs/js/jquery.sparkline.min.js'></script>
	-->
	<!-- Pace -->
	<!--
	<script src='libs/js/uncompressed/pace.js'></script>
	-->
	<!-- Popup Overlay -->
	<!--
	<script src='libs/js/jquery.popupoverlay.min.js'></script>
	-->
	<!-- Slimscroll -->
	<!--
	<script src='libs/js/jquery.slimscroll.min.js'></script>
	-->
	<!-- Modernizr -->
	<!--
	<script src='libs/js/modernizr.min.js'></script>
	-->
	<!-- Cookie -->
	<!--
	<script src='libs/js/jquery.cookie.min.js'></script>
	-->
	<!-- Endless -->
	<!--
	<script src="libs/js/endless/endless.js"></script>
	-->
	
	
	<!-- OceanOS and Application -->

	</body>
	<?php
	}else{
		include_once "libs/iface/iface_login.php";
	}
	?>
</html>