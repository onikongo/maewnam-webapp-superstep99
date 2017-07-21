<?php
$aApplication = array(
	array(
		"appname" => "dashboard",
		"name" => "Dashboard",
		"icon" => "fa fa-lg fa-fw fa-home",
		"path" => "apps/dashboard/index.php"
	),array(
		"appname" => "admin",
		"icon" => "fa fa-lg fa-fw fa-gears",
		"name" => "Administration",
		"submenu" => array(
			array(
				"appname" => "setting",
				"name" => "Setting",
				"icon" => "fa fa-lg fa-fw fa-wrench",
				"path" => "apps/setting/index.php"
			),array(
				"appname" => "accctrl",
				"name" => "Access Control",
				"icon" => "fa fa-lg fa-fw fa-user",
				"path" => "apps/accctrl/index.php"
			),array(
				"appname" => "database",
				"name" => "Database",
				"icon" => "fa fa-lg fa-fw fa-database",
				"path" => "apps/database/index.php"
			)
		)
	)
);
?>