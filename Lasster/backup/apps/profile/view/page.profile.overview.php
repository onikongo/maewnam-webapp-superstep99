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
	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-default fadeInDown animation-delay2">
				<div class="panel-heading">
					About Me
				</div>
				<div class="panel-body">
					<p>
					<?php
					if(isset($setting['personalization'])){
						echo base64_decode($setting['personalization']);
					}
					?>
					</p>
				</div>
			</div><!-- /panel -->
											
			<div class="panel panel-default fadeInDown animation-delay3">
				<div class="panel-heading">
					<i class="fa fa-twitter"></i> Latest Activities
				</div>
				<ul class="list-group"> 
				<?php
					$sql = "SELECT * FROM logs WHERE log_user = ".$user['id']." ORDER BY log_id DESC LIMIT 0,5";
					$rst = $dbc->Query($sql);
					while($log = $dbc->Fetch($rst)){
						echo '<li class="list-group-item">';
							echo '<p>Action : '.$log['log_action'].' Value : '.$log['log_value'].'</p>';
							echo '<small class="block text-muted">';
								echo '<i class="fa fa-clock-o"></i> '.$log['log_datetime'];
							echo '</small>';
						echo '</li> ';
					}
				?>
				</ul><!-- /list-group -->
			</div><!-- /panel -->
		</div><!-- /.col -->
		<div class="col-md-6">
			<div class="panel panel-overview fadeInUp animation-delay5">
				<div class="overview-icon bg-success">
					<i class="fa fa-shopping-cart"></i>
				</div>
				<div class="overview-value">
					<div class="h2">256</div>
					<div class="text-muted">Sales</div>
				</div>
			</div><!--/ panel -->
			<div class="panel panel-overview fadeInUp animation-delay6">
				<div class="overview-icon bg-danger">
					<i class="fa fa-usd"></i>
				</div>
				<div class="overview-value">
					<div class="h2">$5,690</div>
					<div class="text-muted">Incomes</div>
				</div>
			</div><!--/ panel -->
		</div><!-- /.col -->
	</div><!-- /.row -->
								
							