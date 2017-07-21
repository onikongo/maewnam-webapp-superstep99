<script type="text/javascript" href="apps/profile/app.js"></script>
<?php
	include_once "apps/profile/include/me.class.php";
	$my = new meClass;
	$section = isset($_REQUEST['view'])?$_REQUEST['view']:"overview";
	$action = isset($_REQUEST['action'])?$_REQUEST['action']:"";
	
	$user = $dbc->GetRecord("users","*","id=".$_SESSION['auth']['user_id']);
	$contact = $dbc->GetRecord("contacts","*","id=".$user['contact']);
	$address = $dbc->GetRecord("address","*","contact=".$contact['id']);
	$setting = json_decode($user['setting'],true);
	
	if($contact['avatar']==""){
		$avatar = "libs/img/user.jpg";
	}else{
		$avatar = $contact['avatar'];
	}
	
	if(isset($setting['email_server'])){
		$mail_connection = true;
		$mailconfig = $setting['email_server'];
	}else{
		$mail_connection = false;
	}
	echo '<pre>';
	if($mail_connection){
		/*
		try{
			$connection_string = "{".$mailconfig['imap_server'].":".$mailconfig['imap_port']."/imap/novalidate-cert}INBOX";
			$mbox = imap_open($connection_string,$mailconfig['imap_user'],$mailconfig['imap_password']);
			echo "<h1>Mailboxes</h1>\n";
			$folders = imap_listmailbox($mbox, "{imap.example.org:143}", "*");

			if ($folders == false) {
				echo "Call failed<br />\n";
			} else {
				foreach ($folders as $val) {
					echo $val . "<br />\n";
				}
			}
			
		}catch(Exception $e){
			$imapErrors = implode("; ", imap_errors());
			$message = $e->getMessage() . "\n\nIMAP ERRORS: {$imapErrors}";
			throw new Exception($message);
		}
		*/
	}
	echo '</pre>';
	
?>
	<div id="main-container">
	
	
		<?php
			$my->PageHeader($section);
			$my->PageTabBar($section);
		?>
		
		<div class="padding-md">
			<div class="row">
				<div class="col-md-3 col-sm-3">
				<?php
					include_once "apps/profile/view/page.profile.info.php";
				?>
				</div><!-- /.col -->
				<div class="col-md-9 col-sm-9">
					<div class="tab-content">
						<div class="tab-pane fade<?php if($section=="overview")echo' in active';?>" id="overview">
						<?php
							include_once "apps/profile/view/page.profile.overview.php";
						?>		
						</div><!-- /tab1 -->
						<div class="tab-pane fade<?php if($section=="edit")echo' in active';?>" id="edit">
						<?php
							include_once "apps/profile/view/page.profile.editprofile.php";
							include_once "apps/profile/view/dialog.profile.editmailserver.php";
						?>		
						</div><!-- /tab2 -->
						<div class="tab-pane fade<?php if($section=="message")echo' in active';?>" id="message">
						<?php
							include_once "apps/profile/view/page.profile.message.php";
						?>		
						</div><!-- /tab3 -->
						<div class="tab-pane fade<?php if($section=="notification")echo' in active';?>" id="notification">
						<?php
							if($action=="read"){
								include_once "apps/profile/view/page.profile.notification.read.php";
							}else{
								include_once "apps/profile/view/page.profile.notification.php";
								include_once "apps/profile/view/dialog.notification.anouncement.php";
							}
						
							
						?>		
						</div><!-- /tab3 -->
					</div><!-- /tab-content -->
				</div><!-- /.col -->
			</div><!-- /.row -->			
		</div><!-- /.padding-md -->
	</div><!-- /main-container -->