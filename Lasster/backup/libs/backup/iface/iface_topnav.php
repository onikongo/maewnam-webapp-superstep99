<?php
	$user = $dbc->GetRecord("users","*","id=".$_SESSION['auth']['user_id']);
	$contact = $dbc->GetRecord("contacts","*","id=".$user['contact']);
	$address = $dbc->GetRecord("address","*","contact=".$contact['id']);
	
	$setting = json_decode($user['setting'],true);
	
	if($contact['avatar']==""){
		$avatar = "libs/img/user.jpg";
	}else{
		$avatar = $contact['avatar'];
	}
?>		
		<div id="top-nav" class="fixed skin-5">
			<a href="#" class="brand">
				<span>OceanOS</span>
				<span class="text-toggle"> Basic</span>
			</a><!-- /brand -->					
			<button type="button" class="navbar-toggle pull-left" id="sidebarToggle">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<button type="button" class="navbar-toggle pull-left hide-menu" id="menuToggle">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<ul class="nav-notification clearfix">
			<?php
				$line = $dbc->GetRecord("notifications","COUNT(id)","acknowledge IS NULL AND user=".$user['id']);
				$new_noti = $line[0];
			?>
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="fa fa-bell fa-lg"></i>
						<span class="notification-label bounceIn animation-delay6"><?php echo $new_noti; ?></span>
					</a>
					<ul class="dropdown-menu notification dropdown-3">
						<li><a href="#">You have <?php echo $new_noti; ?> new notifications</a></li>
						<?php
							$sql="SELECT * FROM notifications WHERE user=".$user['id']." AND acknowledge IS NULL ORDER BY id DESC LIMIT 0,5";
							$rst = $dbc->query($sql);
							$read = $noti['acknowledge']==""?"":" selected";
							while($noti = $dbc->Fetch($rst)){
								$href= '?app=profile&view=notification&action=read&notification='.$noti['id'];
								echo '<li>';
									echo '<a href="'.$href.'">';
									
										if($noti['type']=="message"){
											echo '<span class="notification-icon bg-warning">';
												echo '<i class="fa fa-warning"></i>';
											echo '</span>';
										}
										echo '<span class="m-left-xs">'.$noti['topic'].'</span>';
										echo '<span class="time text-muted">'.$noti['created'].'</span>';
									echo '</a>';
								echo '</li>';
							}
						?>
						
						<li><a href="?app=profile&view=notification">View all notifications</a></li>						
					</ul>
				</li>
				<li class="profile dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
						<strong><?php echo $user['name'];?></strong>
						<span><i class="fa fa-chevron-down"></i></span>
					</a>
					<ul class="dropdown-menu">
						<li>
							<a class="clearfix" href="#">
								<img src="<?php echo $avatar;?>" alt="<?php echo $contact['name']." ".$contact['surname'];?>">
								<div class="detail">
									<strong><?php echo $user['name'];?></strong>
									<p class="grey"><?php echo $contact['email'];?></p> 
								</div>
							</a>
						</li>
						<li><a tabindex="-1" href="?profile&view=edit" class="main-link"><i class="fa fa-edit fa-lg"></i> Edit profile</a></li>
						<li><a tabindex="-1" href="gallery.html" class="main-link"><i class="fa fa-picture-o fa-lg"></i> Photo Gallery</a></li>
						<li><a tabindex="-1" href="#" class="theme-setting"><i class="fa fa-cog fa-lg"></i> Setting</a></li>
						<li class="divider"></li>
						<li><a tabindex="-1" class="main-link logoutConfirm_open" href="#logoutConfirm"><i class="fa fa-lock fa-lg"></i> Log out</a></li>
					</ul>
				</li>
			</ul>
		</div><!-- /top-nav-->