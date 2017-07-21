<script type="text/javascript" href="apps/inbox/app.js"></script>
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
	
	if(isset($setting['email_server'])){
		$mail_connection = true;
		$mailconfig = $setting['email_server'];
	}else{
		$mail_connection = false;
	}

/*
	echo "<h1>Headers in INBOX</h1>\n";
	$headers = imap_headers($mbox);

	if ($headers == false) {
		echo "Call failed<br />\n";
	} else {
		foreach ($headers as $val) {
			echo $val . "<br />\n";
		}
	}
	
	$active = isset($_REQUEST['active'])?$_REQUEST['active']:" Inbox";
	$aFolder = array(
		array("Inbox","fa-inbox","badge-success"),
		array("Notes","fa-star","badge-warning"),
		array("Important","fa-bookmark-o","badge-warning"),
		array("Sent","fa-envelope","badge-danger"),
		array("Drafts","fa-pencil","badge-warning"),
		array("Junk","fa-inbox","badge-info"),
		array("Outbox","fa-inbox","badge-warning"),
		array("POP","fa-inbox","badge-warning")
	);
*/
?>
<div id="main-container">
	<div class="row row-merge">
	<?php
	if(!$mail_connection){
		?>
		<div class="padding-md">
			<div class="alert alert-danger">
				<strong>Mail Confiugration Error!</strong> There is no mail configuration!.
			</div>
		</div>
		<?php
	}else{
		$connection_string = "{".$mailconfig['imap_server'].":".$mailconfig['imap_port']
			."/imap"
			.($mailconfig['smtp_ssl']=="ssl"?"/ssl":"")
			.($mailconfig['smtp_ssl']=="tls"?"/tls":"")
			."/novalidate-cert}INBOX";
		$mbox = imap_open($connection_string,$mailconfig['imap_user'],$mailconfig['imap_password']);
	?>
		<div class="col-sm-3 bg-primary custom-grid menu-grid">
			<button type="button" class="navbar-toggle" id="inboxMenuToggle" >
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<div class="menu-header">Folder <a class="btn btn-sm pull-right" href="#newFolder" data-toggle="modal"><i class="fa fa-plus"></i></a></div>
			<ul class="inbox-menu" id="inboxMenu">
			<?php
			
				$folders = imap_list ($mbox, "{".$mailconfig['imap_server'].":".$mailconfig['imap_port']."}", "*");
				if ($folders == false) {
					echo "Call failed<br />\n";
				} else {
					foreach ($folders as $val) {
						$folder = array($val,substr($val,-5)=="INBOX"?"Inbox":end(explode(".",$val)),"");
						echo '<li'.($folder[0]==$active?' class="active"':"").'>';
							echo '<a href="?app=inbox&folder='.$folder[0].'">';
								echo '<i class="fa '.$folder[2].' fa-lg"></i>';
								echo '<span class="m-left-xs">'.$folder[1].'</span>';
								//if($folder[0]=="Inbox")echo '<span class="badge '.$folder[2].' pull-right">'.countimap_num_msg ($unreads).'</span>';
							echo '</a>';
						echo '</li>';
					}
				}
				
			?>
			</ul>
		</div><!-- /.col -->
		<div class="col-sm-9">
			<div class="panel panel-default inbox-panel">
				<div class="panel-heading">
					<div class="input-group">
						<input type="text" class="form-control input-sm" placeholder="Search here...">
						<span class="input-group-btn">
							<button class="btn btn-default btn-sm" type="button"><i class="fa fa-search"></i></button>
						</span>
					</div><!-- /input-group -->
				</div>
				<div class="panel-body">
					<label class="label-checkbox inline">
						<input type="checkbox" id="chk-all">
						<span class="custom-checkbox"></span>
					</label>
					<a class="btn btn-sm btn-danger"><i class="fa fa-plus"></i> Write Mail</a>
					<a class="btn btn-sm btn-default"><i class="fa fa-trash-o"></i> Delete</a>
			
					<div class="pull-right">
						<a class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-refresh"></i></a>			
						<div class="btn-group" id="inboxFilter">
							<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
								All
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu pull-right">
								<li><a href="#">Read</a></li>
								<li><a href="#">Unread</a></li>
								<li><a href="#">Starred</a></li>
								<li><a href="#">Unstarred</a></li>
							</ul>
						</div><!-- /btn-group -->
					</div>
				</div>
				<ul class="list-group">
				<?php
					//$connection_string = "{".$mailconfig['imap_server'].":".$mailconfig['imap_port']."/imap/novalidate-cert}INBOX";
					//$mbox = imap_open($connection_string,$mailconfig['imap_user'],$mailconfig['imap_password']);
					//$imap_obj = imap_check($mbox);
					$emails = imap_search($mbox,"ALL");
					//$MC = imap_check($mbox);
					//$messages = imap_headers($mbox);
					rsort($emails);
					foreach ($emails as $email_id) {
						$email = imap_fetch_overview($mbox, $email_id, 0)[0];
						$struct = imap_fetchstructure($mbox, $email_id, 0);
						//$contentParts = count($struct->parts);
						
						//echo '<pre>';
						//var_dump($struct);
						//echo '</pre>';
						echo '<li class="list-group-item clearfix inbox-item">';
							echo '<label class="label-checkbox inline">';
								echo '<input type="checkbox" class="chk-item">';
								echo '<span class="custom-checkbox"></span>';
							echo '</label>';
							if($email->flagged){
								echo '<span class="starred"><i class="fa fa-star fa-lg"></i></span>';
							}else{
								echo '<span class="not-starred"><i class="fa fa-star-o fa-lg"></i></span>';
							}
							echo '<span class="from">'.$email->from.'</span>';
							echo '<span class="detail">';
								//echo '<span class="label label-danger">Important</span>';
								echo $email->subject;
								echo '</span>';
							echo '<span class="inline-block pull-right">';
							echo '<span class="attachment"><i class="fa fa-paperclip fa-lg"></i></span>';
							echo '<span class="time">'.$email->date.'</span>';
							echo '</span>';
						echo '</li>';
						
						
					}
				?>
				</ul><!-- /list-group -->
				<div class="panel-footer clearfix">
					<div class="pull-left">112 messages</div>
					<div class="pull-right">
					<span class="middle">Page 1 of 8 </span>
					<ul class="pagination middle">
						<li class="disabled"><a href="#"><i class="fa fa-step-backward"></i></a></li>
						<li class="disabled"><a href="#"><i class="fa fa-caret-left large"></i></a></li>
						<li><a href="#"><i class="fa fa-caret-right large"></i></a></li>
						<li><a href="#"><i class="fa fa-step-forward"></i></a></li>
					</ul>
					</div>
				</div>
			</div><!-- /panel -->
		</div><!-- /.col -->
		
	<?php
	}
	?>
	</div><!-- /.row -->
</div><!-- /main-container -->
		
		<!--Modal-->
		<div class="modal fade" id="newFolder">
  			<div class="modal-dialog">
    			<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4>Create new folder</h4>
      		</div>
		    <div class="modal-body">
		        <form>
					<div class="form-group">
				<label for="folderName">Folder Name</label>
				<input type="text" class="form-control input-sm" id="folderName" placeholder="Folder name here...">
					</div>
				</form>
		    </div>
		    <div class="modal-footer">
		        <button class="btn btn-sm btn-success" data-dismiss="modal" aria-hidden="true">Close</button>
				<a href="#" class="btn btn-danger btn-sm">Save changes</a>
		    </div>
			  	</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
<?php
/*
	imap_close($mbox);
	*/
?>