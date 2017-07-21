<!--
<aside class="fixed skin-5">
	<div class="sidebar-inner scrollable-sidebar">
		<div class="size-toggle">
			<a class="btn btn-sm" id="sizeToggle">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<a class="btn btn-sm pull-right logoutConfirm_open"	href="#logoutConfirm">
				<i class="fa fa-power-off"></i>
			</a>
		</div>
		<div class="user-block clearfix">
			<img src="<?php //echo $avatar;?>" alt="User Avatar">
			<div class="detail">
				<strong><?php //echo $_SESSION['auth']['user']?></strong>
				<ul class="list-inline">
					<li><a href="?app=profile">Profile</a></li>
				</ul>
			</div>
		</div>
		<div class="main-menu">
			<ul>
			<?php
			/* foreach($aOceanOSMenu as $menu){
				// Command to Check System
				if($os->allow($menu['app'],'view')){
					$active = $_REQUEST['app']==$menu['app']?" active":"";
					if(isset($menu['submenu'])){
						$openable = " openable";
						foreach($menu['submenu'] as $submenu){
							if($_REQUEST['app']==$submenu['app'])$active = " active";;
						}
						$href = "#";
					}else{
						$openable = "";
						$href = "?app=".$menu['app'];
					}		
					echo '<li class="'.$openable.$active.'">';
						echo '<a href="'.$href.'">';
							echo '<span class="menu-icon">';
									echo '<i class="fa '.$menu['menu-icon'].' fa-lg"></i> ';
								echo '</span>';
							echo '</span>';
							echo '<span class="text">';
							echo $menu['name'];
							echo '<span class="menu-hover"></span>';
						echo '</a>';
						if(isset($menu['submenu'])){
							echo '<ul class="submenu">';
							foreach($menu['submenu'] as $submenu){
								if($os->allow($submenu['app'],'view')){
									$active = $_REQUEST['app']==$submenu['app']?" active":"";
									echo '<li class="'.$active.'">';
										echo '<a href="?app='.$submenu['app'].'">';
										echo '<span class="submenu-label">'.$submenu['name'].'</span>';
										echo '</a>';
									echo '</li>';
								}
							}
							echo '</ul>';
							
						}
					echo '</li>';
				}
			} */
			?>
			</ul>
			<div class="alert alert-info">
				Oceanos 1.0
			</div>
		</div>
	</div>
</aside>
-->

<!-- Aside Start-->
        <aside class="left-panel">

            <!-- brand -->
            <div class="logo">
                <a href="index.html" class="logo-expanded">
                    <i class="ion-social-buffer"></i>
                    <span class="nav-label">SuperStep99</span>
                </a>
            </div>
            <!-- / brand -->
        
            <!-- Navbar Start -->
            <nav class="navigation">
			<ul class="list-unstyled">
			<?php
			foreach($aOceanOSMenu as $menu){
				// Command to Check System
				if($os->allow($menu['app'],'view')){
					$active = $_REQUEST['app']==$menu['app']?" active":"";
					if(isset($menu['submenu'])){
						$openable = "has-submenu";
						foreach($menu['submenu'] as $submenu){
							if($_REQUEST['app']==$submenu['app'])$active = " active";;
						}
						$href = "#";
						$arrow = '<span class="menu-arrow"></span>';
					}else{
						$openable = "";
						$href = "?app=".$menu['app'];
						$arrow ="";
					}		
					echo '<li class="'.$openable.$active.'">';
						echo '<a href="'.$href.'">';
							echo '<span class="nav-label">';
									echo '<i class="'.$menu['menu-icon'].'"></i> ';
									echo $menu['name'];
							echo '</span>'.$arrow;
	
							// echo '</span>';
							// echo '<span class="text">';
							// echo '<span class="menu-hover"></span>'.$arrow;
						echo '</a>';
						if(isset($menu['submenu'])){
							echo '<ul class="list-unstyled">';
							foreach($menu['submenu'] as $submenu){
								if($os->allow($submenu['app'],'view')){
									$active = $_REQUEST['app']==$submenu['app']?" active":"";
									echo '<li class="'.$active.'">';
									// echo '<li>';
										echo '<a href="?app='.$submenu['app'].'">';
										// echo '<span class="submenu-label">'.$submenu['name'].'</span>';
										echo '<span>'.$submenu['name'].'</span>';
										echo '</a>';
									echo '</li>';
								}
							}
							echo '</ul>';
							
						}
					echo '</li>';
				}
			} 
			?>
			</ul>
				<!--
                <ul class="list-unstyled">
                    <li class="active"><a href="index.html"><i class="zmdi zmdi-view-dashboard"></i> <span class="nav-label">Dashboard</span></a></li>
                    <li class="has-submenu">
                        <a href="#"><i class="zmdi zmdi-format-underlined"></i> <span class="nav-label">User Interface</span><span class="menu-arrow"></span></a>
                        <ul class="list-unstyled">
                            <li><a href="ui-typography.html">Typography</a></li>
                            <li><a href="ui-buttons.html">Buttons</a></li>
                            <li><a href="ui-icons.html">Icons</a></li>
                            <li><a href="ui-panels.html">Panels</a></li>
                            <li><a href="ui-tabs-accordions.html">Tabs &amp; Accordions</a></li>
                            <li><a href="ui-modals.html">Modals</a></li>
                            <li><a href="ui-bootstrap.html">BS Elements</a></li>
                            <li><a href="ui-progressbars.html">Progress Bars</a></li>
                            <li><a href="ui-notification.html">Notification</a></li>
                            <li><a href="ui-sweet-alert.html">Sweet-Alert</a></li>
                        </ul>
                    </li>
                    <li class="has-submenu"><a href="#"><i class="zmdi zmdi-album"></i> <span class="nav-label">Components</span><span class="badge bg-warning">New</span></a>
                        <ul class="list-unstyled">
                            <li><a href="components-grid.html">Grid</a></li>
                            <li><a href="components-portlets.html">Portlets</a></li>
                            <li><a href="components-widgets.html">Widgets</a></li>
                            <li><a href="components-nestable-list.html">Nesteble</a></li>
                            <li><a href="components-calendar.html">Calendar</a></li>
                            <li><a href="components-sliders.html">Range Slider</a></li>
                        </ul>
                    </li>
                    <li class="has-submenu"><a href="#"><i class="zmdi zmdi-collection-text"></i> <span class="nav-label">Forms</span><span class="menu-arrow"></span></a>
                        <ul class="list-unstyled">
                            <li><a href="form-elements.html">General Elements</a></li>
                            <li><a href="form-validation.html">Form Validation</a></li>
                            <li><a href="form-advanced.html">Advanced Form</a></li>
                            <li><a href="form-wizard.html">Form Wizard</a></li>
                            <li><a href="form-editor.html">WYSIWYG Editor</a></li>
                            <li><a href="form-codeeditor.html">Code Editors</a></li>
                            <li><a href="form-uploads.html">Multiple File Upload</a></li>
                            <li><a href="form-imagecrop.html">Image Crop</a></li>
                            <li><a href="form-xeditable.html">X-Editable</a></li>
                        </ul>
                    </li>
                    <li class="has-submenu"><a href="#"><i class="zmdi zmdi-format-list-bulleted"></i> <span class="nav-label">Data Tables</span><span class="menu-arrow"></span></a>
                        <ul class="list-unstyled">
                            <li><a href="tables.html">Basic Tables</a></li>
                            <li><a href="tables-datatable.html">Data Table</a></li>
                            <li><a href="tables-editable.html">Editable Table</a></li>
                            <li><a href="tables-responsive.html">Responsive Table</a></li>
                        </ul>
                    </li>
                    <li class="has-submenu"><a href="#"><i class="zmdi zmdi-chart"></i> <span class="nav-label">Charts</span><span class="menu-arrow"></span></a>
                        <ul class="list-unstyled">
                            <li><a href="charts-morris.html">Morris Chart</a></li>
                            <li><a href="charts-chartjs.html">Chartjs</a></li>
                            <li><a href="charts-flot.html">Flot Chart</a></li>
                            <li><a href="charts-rickshaw.html">Rickshaw Chart</a></li>
                            <li><a href="charts-peity.html">Peity Chart</a></li>
                            <li><a href="charts-c3.html">C3 Chart</a></li>
                            <li><a href="charts-other.html">Other Chart</a></li>
                        </ul>
                    </li>

                    <li class="has-submenu"><a href="#"><i class="zmdi zmdi-email"></i> <span class="nav-label">Mail</span><span class="badge bg-success">7</span></a>
                        <ul class="list-unstyled">
                            <li><a href="email-inbox.html">Inbox</a></li>
                            <li><a href="email-compose.html">Compose Mail</a></li>
                            <li><a href="email-read.html">View Mail</a></li>
                            <li><a href="email-templates.html">Email Templates</a></li>
                        </ul>
                    </li>

                    <li class="has-submenu"><a href="#"><i class="zmdi zmdi-map"></i> <span class="nav-label">Maps</span><span class="menu-arrow"></span></a>
                        <ul class="list-unstyled">
                            <li><a href="maps-google.html"> Google Map</a></li>
                            <li><a href="maps-vector.html"> Vector Map</a></li>
                        </ul>
                    </li>
                    <li class="has-submenu"><a href="#"><i class="zmdi zmdi-collection-item"></i> <span class="nav-label">Pages</span><span class="menu-arrow"></span></a>
                        <ul class="list-unstyled">
                            <li><a href="pages-profile.html">Profile</a></li>
                            <li><a href="pages-timeline.html">Timeline</a></li>
                            <li><a href="pages-invoice.html">Invoice</a></li>
                            <li><a href="pages-contact.html">Contact-list</a></li>
                            <li><a href="pages-login.html">Login</a></li>
                            <li><a href="pages-register.html">Register</a></li>
                            <li><a href="pages-recoverpw.html">Recover Password</a></li>
                            <li><a href="pages-lock-screen.html">Lock Screen</a></li>
                            <li><a href="pages-blank.html">Blank Page</a></li>
                            <li><a href="pages-404.html">404 Error</a></li>
                            <li><a href="pages-404_alt.html">404 alt</a></li>
                            <li><a href="pages-500.html">500 Error</a></li>
                        </ul>
                    </li>
                </ul>
				-->
            </nav>
                
        </aside>
        <!-- Aside Ends-->