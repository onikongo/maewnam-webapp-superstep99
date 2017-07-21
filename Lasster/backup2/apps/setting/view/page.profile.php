<?php
	if(!isset($setting['personalize'])){
		$setting['personalize'] = array(
			"qoute" => "",
			"explain" => "",
		);
	}
	$personalize = $setting['personalize'];
?>

<div class="row">
	<div class="col-md-6">
		<section class="widget">
			<div class="widget-body">
				<div class="widget-top-overflow text-white">
					<div class="height-250 overflow-hidden bg-gray">
						<!--<img class="img-responsive" src="demo/img/pictures/19.jpg">-->
					</div>
					<div class="btn-toolbar">
						<a href="#" class="btn btn-outline btn-sm pull-right"><i class="fa fa-twitter mr-xs"></i> Follow </a>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-5 text-center">
						<div class="post-user post-user-profile">
							<span class="thumb-xlg">
								<a href="#" onclick="fn.app.setting.profile.change_avatar();">
									<img class="img-circle" src="<?php echo $avatar;?>" alt="...">
									</a>
							</span>
							<h4 class="fw-normal"><?php echo $display_name;?></h4>
							<p><?php echo $group['name'];?></p>
							<a id="btnSendmail" href="#" class="btn btn-danger btn-sm mt">&nbsp;Send <i class="fa fa-envelope ml-xs"></i>&nbsp;</a>
							<ul class="contacts">
								<li><i class="fa fa-phone fa-fw mr-xs"></i><a href="#"><?php echo $contact['mobile'];?></a></li>
								<li><i class="fa fa-envelope fa-fw mr-xs"></i><a href="#"><?php echo $contact['email'];?></a></li>
							</ul>
						</div>
						<div class="col-sm-12">
							<button onclick="fn.app.setting.profile.dialog_edit()" class="btn-block btn btn-primary">Change Profile</button>
							<button onclick="fn.app.setting.profile.mail.dialog_setting()" class="btn-block btn btn-default">Email Setting</button>
							<button onclick="fn.app.setting.profile.detail.dialog_edit()" class="btn-block btn btn-default">Personalize</button>
							<button onclick="fn.app.setting.profile.dialog_language()" class="btn-block btn btn-default">Language</button>
						</div>
					</div>
					<div class="col-sm-7">
						<div class="stats-row stats-row-profile mt text-right">
							<div class="stat-item">
										<p class="value">251</p>
										<h5 class="name">Posts</h5>
							</div>
							<div class="stat-item">
										<p class="value">9.38%</p>
										<h5 class="name">Conversion</h5>
							</div>
							<div class="stat-item">
										<p class="value"><?php echo strtoupper($setting['lang']);?></p>
										<h5 class="name">Lang</h5>
							</div>
						</div>
						<p class="text-right mt-lg">
							<?php
								$sql = "SELECT 
										sales_team.name AS name 
									FROM sales_mapping
									LEFT JOIN sales_team ON sales_team.id = sales_mapping.team
									WHERE user=".$user['id'];
								$rst = $dbc->Query($sql);
								while($team = $dbc->Fetch($rst)){
									echo '<a href="#" class="label label-default ml-xs"> '.$team['name'].' </a>';
								}
							?>
						</p>
						<p class="lead mt-lg">
						<?php
							$qoute = base64_decode($personalize['qoute']);
							echo ($qoute=="")?"No Qoute":$qoute;
						?>
						</p>
						<p>
						<?php
							$explain = base64_decode($personalize['explain']);
							echo ($explain=="")?"-":$explain;
						?>
						</p>
					</div>
				</div>
			</div>
		</section>
	</div>
	<div class="col-md-6">
	<section class="activities">
		<h2>Activities</h2>
		<?php
			$sql = "SELECT * FROM logs WHERE log_user_type=0 AND log_user=".$user['id']." ORDER BY log_id DESC LIMIT 0,5";
			$rst = $dbc->Query($sql);
			while($log = $dbc->Fetch($rst)){
				echo '<section class="event">';
					echo '<span class="thumb-sm avatar pull-left mr-sm">';
						echo '<img class="img-circle" src="'.$avatar.'" alt="...">';
					echo '</span>';
					echo '<h4 class="event-heading"><a href="#">'.$log['log_action'].'</a> <small><a href="#">'.$log['log_location'].'</a></small></h4>';
					echo '<p class="fs-sm text-muted">'.date("F d,Y \a\\t H:i:s",strtotime($log['log_datetime'])).'</p>';
				echo '</section>';
			}
		?>
	</section>
	</div>
</div>

