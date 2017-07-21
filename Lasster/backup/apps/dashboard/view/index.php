<?php
	/* $user = $dbc->GetRecord("users","*","id=".$_SESSION['auth']['user_id']);
	$contact = $dbc->GetRecord("contacts","*","id=".$user['contact']);
	$address = $dbc->GetRecord("address","*","contact=".$contact['id']);
	$setting = json_decode($user['setting'],true);
	$total = $dbc->GetRecord("users",
		"COUNT(id) AS user,
		(SELECT COUNT(id) FROM organizations) AS organization,
		(SELECT COUNT(id) FROM customers) AS customer,
		(SELECT COUNT(log_id) FROM logs WHERE log_action != 'access') AS log,
		(SELECT COUNT(log_id) FROM logs WHERE log_user = $user[id]) AS alllog"
	,"1"); */
?>

<!--
<div id="main-container">
	<div id="breadcrumb">
		<ul class="breadcrumb">
			 <li><i class="fa fa-home"></i><a href="?"> Home</a></li>
			 <li class="active">Dashboard</li>	 
		</ul>
	</div>
	<div class="main-header clearfix">
		<div class="page-title">
			<h3 class="no-margin">Dashboard</h3>
			<span>Welcome back <?php //echo $_SESSION['auth']['user'];?></span>
		</div>
				
		<ul class="page-stats">
			<li>
				<div class="value">
					<span>My Activity</span>
					<h4 id="currentVisitor"><?php //echo $total['alllog'];?></h4>
				</div>
				<span id="visits" class="sparkline"></span>
			</li>
			<li>
				<div class="value">
					<span>Customer</span>
					<h4><strong id="currentBalance"><?php //echo number_format($total['customer']);?></strong></h4>
				</div>
				<span id="balances" class="sparkline"></span>
			</li>
		</ul>
	</div>
	<div class="padding-md">
		<div class="row">
					<div class="col-sm-6 col-md-3">
						<div class="panel-stat3 bg-danger">
							<h2 class="m-top-none" id="userCount">362</h2>
							<h5>Registered users</h5>
							<i class="fa fa-arrow-circle-o-up fa-lg"></i><span class="m-left-xs">5% Higher than last week</span>
							<div class="stat-icon">
								<i class="fa fa-user fa-3x"></i>
							</div>
							<div class="refresh-button">
								<i class="fa fa-refresh"></i>
							</div>
							<div class="loading-overlay">
								<i class="loading-icon fa fa-refresh fa-spin fa-lg"></i>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-3">
						<div class="panel-stat3 bg-info">
							<h2 class="m-top-none"><span id="serverloadCount">15</span>%</h2>
							<h5>Server Load</h5>
							<i class="fa fa-arrow-circle-o-up fa-lg"></i><span class="m-left-xs">1% Higher than last week</span>
							<div class="stat-icon">
								<i class="fa fa-hdd-o fa-3x"></i>
							</div>
							<div class="refresh-button">
								<i class="fa fa-refresh"></i>
							</div>
							<div class="loading-overlay">
								<i class="loading-icon fa fa-refresh fa-spin fa-lg"></i>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-3">
						<div class="panel-stat3 bg-warning">
							<h2 class="m-top-none" id="orderCount">593</h2>
							<h5>New Orders</h5>
							<i class="fa fa-arrow-circle-o-up fa-lg"></i><span class="m-left-xs">3% Higher than last week</span>
							<div class="stat-icon">
								<i class="fa fa-shopping-cart fa-3x"></i>
							</div>
							<div class="refresh-button">
								<i class="fa fa-refresh"></i>
							</div>
							<div class="loading-overlay">
								<i class="loading-icon fa fa-refresh fa-spin fa-lg"></i>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-3">
						<div class="panel-stat3 bg-success">
							<h2 class="m-top-none" id="visitorCount">7214</h2>
							<h5>Total Visitors</h5>
							<i class="fa fa-arrow-circle-o-up fa-lg"></i><span class="m-left-xs">15% Higher than last week</span>
							<div class="stat-icon">
								<i class="fa fa-bar-chart-o fa-3x"></i>
							</div>
							<div class="refresh-button">
								<i class="fa fa-refresh"></i>
							</div>
							<div class="loading-overlay">
								<i class="loading-icon fa fa-refresh fa-spin fa-lg"></i>
							</div>
						</div>
					</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading clearfix">
						<span class="pull-left"><i class="fa fa-bar-chart-o fa-lg"></i> Time Zone</span>
						<ul class="tool-bar">
							<li><a href="#" class="refresh-widget" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Refresh"><i class="fa fa-refresh"></i></a></li>
						</ul>
					</div>
					<div class="panel-body" id="trafficWidget">
						<?php
							/* $aTimezone = array(
								"Asia/Bangkok",
								"Asia/Dili",
								"Asia/Manila",
								"Asia/Seoul",
								"Asia/Tokyo",
								"Asia/Taipei",
								"Asia/Shanghai",
								"Etc/GMT+7",
								"Etc/GMT-7",
								"Etc/GMT+8",
								"Etc/Greenwich",
								"Etc/UCT",
								"Etc/Universal",
								"Etc/UTC"
							); */
						?>
						<table class="table">
							<thead>
								<tr>
									<th>Time Zone</th>
									<th>Time</th>
									<th>GMT</th>
								</tr>
							</thead>
							<tbody>
							<?php
								/* foreach($aTimezone as $timezone){
									echo '<tr>';
										date_default_timezone_set($timezone);
										echo '<td>'.$timezone.'</td>';
										echo '<td>'.date("Y-d-m H:i:s").'</td>';
										echo '<td>'.date_default_timezone_get().'</td>';
									echo '</tr>';
								} */
							?>
							</tbody>
						</table>
				
					</div>
					<div class="panel-footer">
								<div class="row row-merge">
									<div class="col-xs-3 text-center border-right">
										<h4 class="no-margin">1232</h4>
										<small class="text-muted">Visitors</small>
									</div>
									<div class="col-xs-3 text-center border-right">
										<h4 class="no-margin">5421</h4>
										<small class="text-muted">Orders</small>
									</div>
									<div class="col-xs-3 text-center border-right">
										<h4 class="no-margin">3021</h4>
										<small class="text-muted">Tickets</small>
									</div>
									<div class="col-xs-3 text-center">
										<h4 class="no-margin">7098</h4>
										<small class="text-muted">Customers</small>
									</div>
								</div>
					</div>
					<div class="loading-overlay">
						<i class="loading-icon fa fa-refresh fa-spin fa-lg"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
-->
<?php /* ?>
        <!-- Aside Start-->
        <aside class="left-panel">

            <!-- brand -->
            <div class="logo">
                <a href="index.html" class="logo-expanded">
                    <i class="ion-social-buffer"></i>
                    <span class="nav-label">Velonic</span>
                </a>
            </div>
            <!-- / brand -->
        
            <!-- Navbar Start -->
            <nav class="navigation">
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
            </nav>
                
        </aside>
        <!-- Aside Ends-->
<?php */ ?>

        <!--Main Content Start -->
        <section class="content">
            <?php /* ?>
            <!-- Header -->
            <header class="top-head container-fluid">
                <button type="button" class="navbar-toggle pull-left">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                
                <!-- Search -->
                <form role="search" class="navbar-left app-search pull-left hidden-xs">
                  <input type="text" placeholder="Search..." class="form-control">
                  <a href=""><i class="fa fa-search"></i></a>
                </form>
                
                <!-- Left navbar -->
                <nav class=" navbar-default" role="navigation">
                    <ul class="nav navbar-nav hidden-xs">
                        <li class="dropdown">
                          <a data-toggle="dropdown" class="dropdown-toggle" href="#">English <span class="caret"></span></a>
                            <ul role="menu" class="dropdown-menu">
                                <li><a href="#">German</a></li>
                                <li><a href="#">French</a></li>
                                <li><a href="#">Italian</a></li>
                                <li><a href="#">Spanish</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Files</a></li>
                    </ul>

                    <!-- Right navbar -->
                    <ul class="nav navbar-nav navbar-right top-menu top-right-menu">  
                        <!-- mesages -->  
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <i class="zmdi zmdi-email-open"></i>
                                <span class="badge badge-sm up bg-purple count">4</span>
                            </a>
                            <ul class="dropdown-menu extended fadeInUp animated nicescroll" tabindex="5001">
                                <li>
                                    <p>Messages</p>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="pull-left"><img src="libs/img/avatar-2.jpg" class="img-circle thumb-sm m-r-15" alt="img"></span>
                                        <span class="block"><strong>John smith</strong></span>
                                        <span class="media-body block">New tasks needs to be done<br><small class="text-muted">10 seconds ago</small></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="pull-left"><img src="libs/img/avatar-3.jpg" class="img-circle thumb-sm m-r-15" alt="img"></span>
                                        <span class="block"><strong>John smith</strong></span>
                                        <span class="media-body block">New tasks needs to be done<br><small class="text-muted">3 minutes ago</small></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="pull-left"><img src="libs/img/avatar-4.jpg" class="img-circle thumb-sm m-r-15" alt="img"></span>
                                        <span class="block"><strong>John smith</strong></span>
                                        <span class="media-body block">New tasks needs to be done<br><small class="text-muted">10 minutes ago</small></span>
                                    </a>
                                </li>
                                <li>
                                    <p><a href="inbox.html" class="text-right">See all Messages</a></p>
                                </li>
                            </ul>
                        </li>
                        <!-- /messages -->
                        <!-- Notification -->
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <i class="zmdi zmdi-notifications-none"></i>
                                <span class="badge badge-sm up bg-pink count">3</span>
                            </a>
                            <ul class="dropdown-menu extended fadeInUp animated nicescroll" tabindex="5002">
                                <li class="noti-header">
                                    <p>Notifications</p>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="pull-left"><i class="fa fa-user-plus fa-2x text-info"></i></span>
                                        <span>New user registered<br><small class="text-muted">5 minutes ago</small></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="pull-left"><i class="fa fa-diamond fa-2x text-primary"></i></span>
                                        <span>Use animate.css<br><small class="text-muted">5 minutes ago</small></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="pull-left"><i class="fa fa-bell-o fa-2x text-danger"></i></span>
                                        <span>Send project demo files to client<br><small class="text-muted">1 hour ago</small></span>
                                    </a>
                                </li>
                                
                                <li>
                                    <p><a href="#" class="text-right">See all notifications</a></p>
                                </li>
                            </ul>
                        </li>
                        <!-- /Notification -->

                        <!-- user login dropdown start-->
                        <li class="dropdown text-center">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <img alt="" src="libs/img/avatar-2.jpg" class="img-circle profile-img thumb-sm">
                                <span class="username">John Deo </span> <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu pro-menu fadeInUp animated" tabindex="5003" style="overflow: hidden; outline: none;">
                                <li><a href="profile.html"><i class="fa fa-briefcase"></i>Profile</a></li>
                                <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                                <li><a href="#"><i class="fa fa-bell"></i> Friends <span class="label label-info pull-right mail-info">5</span></a></li>
                                <li><a href="#"><i class="fa fa-sign-out"></i> Log Out</a></li>
                            </ul>
                        </li>
                        <!-- user login dropdown end -->       
                    </ul>
                    <!-- End right navbar -->
                </nav>
                
            </header>
            <!-- Header Ends -->
<?php */ ?>

            <!-- Page Content Start -->
            <!-- ================== -->

            <div class="wraper container-fluid">
                <div class="page-title"> 
                    <h3 class="title">Welcome !</h3> 
                </div>


                


                <div class="row">

                    <div class="col-lg-6">
                        <div class="portlet"><!-- /primary heading -->
                            <div class="portlet-heading">
                                <h3 class="portlet-title text-dark text-uppercase">
                                    Weekly Sales Report
                                </h3>
                                <div class="portlet-widgets">
                                    <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                                    <span class="divider"></span>
                                    <a data-toggle="collapse" data-parent="#accordion1" href="#portlet1"><i class="ion-minus-round"></i></a>
                                    <span class="divider"></span>
                                    <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div id="portlet1" class="panel-collapse collapse in">
                                <div class="portlet-body">
                                    <div id="morris-bar-example" style="height: 280px;"></div>

                                    <div class="row text-center m-t-30 m-b-30">
                                        <div class="col-sm-3 col-xs-6">
                                            <h4>$ 126</h4>
                                            <small class="text-muted"> Today's Sales</small>
                                        </div>
                                        <div class="col-sm-3 col-xs-6">
                                            <h4>$ 967</h4>
                                            <small class="text-muted">This Week's Sales</small>
                                        </div>
                                        <div class="col-sm-3 col-xs-6">
                                            <h4>$ 4500</h4>
                                            <small class="text-muted">This Month's Sales</small>
                                        </div>
                                        <div class="col-sm-3 col-xs-6">
                                            <h4>$ 87,000</h4>
                                            <small class="text-muted">This Year's Sales</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- /Portlet -->

                    </div> <!-- end col -->


                    <div class="col-lg-6">
                        <div class="portlet"><!-- /primary heading -->
                            <div class="portlet-heading">
                                <h3 class="portlet-title text-dark text-uppercase">
                                    Yearly Sales Report
                                </h3>
                                <div class="portlet-widgets">
                                    <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                                    <span class="divider"></span>
                                    <a data-toggle="collapse" data-parent="#accordion1" href="#portlet2"><i class="ion-minus-round"></i></a>
                                    <span class="divider"></span>
                                    <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div id="portlet2" class="panel-collapse collapse in">
                                <div class="portlet-body">
                                    <div id="morris-area-example" style="height: 280px;"></div>
                                    
                                    <div class="row text-center m-t-30 m-b-30">
                                        <div class="col-sm-3 col-xs-6">
                                            <h4>$ 126</h4>
                                            <small class="text-muted"> Today's Sales</small>
                                        </div>
                                        <div class="col-sm-3 col-xs-6">
                                            <h4>$ 967</h4>
                                            <small class="text-muted">This Week's Sales</small>
                                        </div>
                                        <div class="col-sm-3 col-xs-6">
                                            <h4>$ 4500</h4>
                                            <small class="text-muted">This Month's Sales</small>
                                        </div>
                                        <div class="col-sm-3 col-xs-6">
                                            <h4>$ 87,000</h4>
                                            <small class="text-muted">This Year's Sales</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- /Portlet -->
                        
                    </div>

                    
                </div> <!-- end row -->


                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="tile-stats white-bg"> 
                            <div class="status">
                                <h3 class="m-t-0"><span class="counter">25</span>% more</h3> 
                                <p>Monthly visitor statistics</p>
                            </div> 
                            <div class="chart-inline">
                                <span class="inlinesparkline"></span> 
                            </div>
                        </div> 
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <div class="tile-stats white-bg"> 
                            <div class="status">
                                <h3 class="m-t-0 counter">49</h3> 
                                <p>Avg. Sales per day</p>
                            </div> 
                            <span class="dynamicbar-big"></span> 
                        </div> 
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <div class="tile-stats white-bg"> 
                            <div class="status">
                                <h3 class="m-t-0 counter">0.9</h3> 
                                <p>Stock Market</p>
                            </div> 
                            <span id="compositeline"></span> 
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <div class="tile-stats white-bg"> 
                            <div class="col-sm-8">
                                <div class="status">
                                <h3 class="m-t-15"><span class="counter">91.5</span>%</h3> 
                                <p>US Dollar Share</p>
                            </div> 
                            </div>
                            <div class="col-sm-4 m-t-20">
                                <span class="sparkpie-big"></span> 
                            </div>
                        </div> 
                    </div>
                </div>


                <!-- WEATHER -->
                <div class="row">
                            
                    <div class="col-lg-6">
                        
                        <!-- BEGIN WEATHER WIDGET 1 -->
                        <div class="panel bg-success-alt">
                            <div class="panel-body">
                            
                                <div class="row">
                                    <div class="col-sm-7">
                                        <div class="row">
                                            <div class="col-xs-6 text-center">
                                                <canvas id="partly-cloudy-day" width="115" height="115"></canvas>
                                            </div>
                                            <div class="col-xs-6">
                                                <h2 class="m-t-0 text-white"><b>32°</b></h2>
                                                <p class="text-white">Partly cloudy</p>
                                                <p class="text-white">15km/h - 37%</p>
                                            </div>
                                        </div><!-- End row -->
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="row">
                                            <div class="col-xs-4 text-center">
                                                <h4 class="text-white m-t-0">SAT</h4>
                                                <canvas id="cloudy" width="35" height="35"></canvas>
                                                <h4 class="text-white">30<i class="wi-degrees"></i></h4>
                                            </div>
                                            <div class="col-xs-4 text-center">
                                                <h4 class="text-white m-t-0">SUN</h4>
                                                <canvas id="wind" width="35" height="35"></canvas>
                                                <h4 class="text-white">28<i class="wi-degrees"></i></h4>
                                            </div>
                                            <div class="col-xs-4 text-center">
                                                <h4 class="text-white m-t-0">MON</h4>
                                                <canvas id="clear-day" width="35" height="35"></canvas>
                                                <h4 class="text-white">33<i class="wi-degrees"></i></h4>
                                            </div>
                                        </div><!-- end row -->
                                    </div>
                                </div><!-- end row -->
                            </div><!-- panel-body -->
                        </div><!-- panel-->
                        <!-- END Weather WIDGET 1 -->
                        
                    </div><!-- End col-md-6 -->

                    <div class="col-lg-6">
                        
                        <!-- WEATHER WIDGET 2 -->
                        <div class="panel bg-primary-alt">
                            <div class="panel-body">
                            
                                <div class="row">
                                    <div class="col-sm-7">
                                        <div class="">
                                            <div class="row">
                                                <div class="col-xs-6 text-center">
                                                    <canvas id="snow" width="115" height="115"></canvas>
                                                </div>
                                                <div class="col-xs-6">
                                                    <h2 class="m-t-0 text-white"><b> 23°</b></h2>
                                                    <p class="text-white">Partly cloudy</p>
                                                    <p class="text-white">15km/h - 37%</p>
                                                </div>
                                            </div><!-- end row -->
                                        </div><!-- weather-widget -->
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="row">
                                            <div class="col-xs-4 text-center">
                                                <h4 class="text-white m-t-0">SAT</h4>
                                                <canvas id="sleet" width="35" height="35"></canvas>
                                                <h4 class="text-white">30<i class="wi-degrees"></i></h4>
                                            </div>
                                            <div class="col-xs-4 text-center">
                                                <h4 class="text-white m-t-0">SUN</h4>
                                                <canvas id="fog" width="35" height="35"></canvas>
                                                <h4 class="text-white">28<i class="wi-degrees"></i></h4>
                                            </div>
                                            <div class="col-xs-4 text-center">
                                                <h4 class="text-white m-t-0">MON</h4>
                                                <canvas id="partly-cloudy-night" width="35" height="35"></canvas>
                                                <h4 class="text-white">33<i class="wi-degrees"></i></h4>
                                            </div>
                                        </div><!-- End row -->
                                    </div> <!-- col-->
                                </div><!-- End row -->
                            </div><!-- panel-body -->
                        </div><!-- panel -->
                        <!-- END WEATHER WIDGET 2 -->
                            
                    </div><!-- /.col-md-6 -->
                </div> <!-- End row -->  


                <div class="row">
                    
                    <div class="col-lg-12">

                        <div class="portlet"><!-- /primary heading -->
                            <div class="portlet-heading">
                                <h3 class="portlet-title text-dark text-uppercase">
                                    Projects
                                </h3>
                                <div class="portlet-widgets">
                                    <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                                    <span class="divider"></span>
                                    <a data-toggle="collapse" data-parent="#accordion1" href="#portlet2"><i class="ion-minus-round"></i></a>
                                    <span class="divider"></span>
                                    <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div id="portlet2" class="panel-collapse collapse in">
                                <div class="portlet-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Project Name</th>
                                                    <th>Start Date</th>
                                                    <th>Due Date</th>
                                                    <th>Status</th>
                                                    <th>Assign</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Velonic Admin v1</td>
                                                    <td>01/01/2015</td>
                                                    <td>26/04/2015</td>
                                                    <td><span class="label label-info">Released</span></td>
                                                    <td>Coderthemes</td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Velonic Frontend v1</td>
                                                    <td>01/01/2015</td>
                                                    <td>26/04/2015</td>
                                                    <td><span class="label label-success">Released</span></td>
                                                    <td>Coderthemes</td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Velonic Admin v1.1</td>
                                                    <td>01/05/2015</td>
                                                    <td>10/05/2015</td>
                                                    <td><span class="label label-pink">Pending</span></td>
                                                    <td>Coderthemes</td>
                                                </tr>
                                                <tr>
                                                    <td>4</td>
                                                    <td>Velonic Frontend v1.1</td>
                                                    <td>01/01/2015</td>
                                                    <td>31/05/2015</td>
                                                    <td><span class="label label-purple">Work in Progress</span></td>
                                                    <td>Coderthemes</td>
                                                </tr>
                                                <tr>
                                                    <td>5</td>
                                                    <td>Velonic Admin v1.3</td>
                                                    <td>01/01/2015</td>
                                                    <td>31/05/2015</td>
                                                    <td><span class="label label-warning">Coming soon</span></td>
                                                    <td>Coderthemes</td>
                                                </tr>

                                                <tr>
                                                    <td>6</td>
                                                    <td>Velonic Admin v1.3</td>
                                                    <td>01/01/2015</td>
                                                    <td>31/05/2015</td>
                                                    <td><span class="label label-primary">Coming soon</span></td>
                                                    <td>Coderthemes</td>
                                                </tr>

                                                <tr>
                                                    <td>7</td>
                                                    <td>Velonic Admin v1.3</td>
                                                    <td>01/01/2015</td>
                                                    <td>31/05/2015</td>
                                                    <td><span class="label label-info">Cool</span></td>
                                                    <td>Coderthemes</td>
                                                </tr>

                                                <tr>
                                                    <td>8</td>
                                                    <td>Velonic Admin v1.3</td>
                                                    <td>01/01/2015</td>
                                                    <td>31/05/2015</td>
                                                    <td><span class="label label-warning">Coming soon</span></td>
                                                    <td>Coderthemes</td>
                                                </tr>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                    
                </div> <!-- end row -->





            </div>
            <!-- Page Content Ends -->
            <!-- ================== -->

            <!-- Footer Start -->
            <footer class="footer">
                2017 © Maewnam Network solution.
            </footer>
            <!-- Footer Ends -->



        </section>
        <!-- Main Content Ends -->
       
	      <!-- Counter-up -->
        <script src="libs/js/waypoints.min.js" type="text/javascript"></script>
        <script src="libs/js/jquery.counterup.min.js" type="text/javascript"></script>

         <!-- sparkline --> 
        <script src="libs/assets/sparkline-chart/jquery.sparkline.min.js" type="text/javascript"></script>
        <script src="libs/assets/sparkline-chart/chart-sparkline.js" type="text/javascript"></script> 

        <!-- skycons -->
        <script src="libs/js/skycons.min.js" type="text/javascript"></script>
    
        <!--Morris Chart-->
        <script src="libs/assets/morris/morris.min.js"></script>
        <script src="libs/assets/morris/raphael.min.js"></script>


        <script src="libs/js/jquery.app.js"></script>
        
        <!-- Dashboard -->
        <script src="libs/js/jquery.dashboard.js"></script>


        <script type="text/javascript">
            jQuery(document).ready(function($) {
                /* Counter Up */
                $('.counter').counterUp({
                    delay: 100,
                    time: 1200
                });
            });
            /* BEGIN SVG WEATHER ICON */
            if (typeof Skycons !== 'undefined'){
            var icons = new Skycons(
                {"color": "#fff"},
                {"resizeClear": true}
                ),
                    list  = [
                        "clear-day", "clear-night", "partly-cloudy-day",
                        "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
                        "fog"
                    ],
                    i;

                for(i = list.length; i--; )
                icons.set(list[i], list[i]);
                icons.play();
            };
        </script>
