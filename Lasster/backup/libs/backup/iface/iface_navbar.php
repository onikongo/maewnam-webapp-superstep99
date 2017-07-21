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
		</div><!-- /size-toggle -->	
		<div class="user-block clearfix">
			<img src="<?php echo $avatar;?>" alt="User Avatar">
			<div class="detail">
				<strong><?php echo $_SESSION['auth']['user']?></strong>
				<ul class="list-inline">
					<li><a href="?app=profile">Profile</a></li>
					<!-- <li><a href="?app=inbox" class="no-margin">Inbox</a></li> -->
				</ul>
			</div>
		</div><!-- /user-block -->
		<div class="main-menu">
			<ul>
			<?php
			foreach($aOceanOSMenu as $menu){
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
			}
			?>
			</ul>
			<div class="alert alert-info">
				Oceanos 1.0
			</div>
		</div><!-- /main-menu -->
	</div><!-- /sidebar-inner -->
</aside>