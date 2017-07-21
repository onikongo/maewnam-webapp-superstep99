<?php
	

	$aOceanOSMenu = array(
		array(
			'name' => 'Dashboard',
			'menu-icon' => 'fa-desktop',
			'app' => 'dashboard'
		),
		array(
			'name' => 'Administrator',
			'menu-icon' => 'fa-cog',
			'app' => 'admin',
			'submenu' => array(
				array(
					'name' => 'Access Control',
					'app' => 'accctrl'
				),
				/* array(
					'name' => 'System Setting',
					'app' => 'system'
				) */
			)
		)
	);



?>