<?php
	if($dbc->HasRecord("variable","name='aSystem_info'")){
		$line = $dbc->GetRecord("variable","value","name='aSystem_info'");
		$info = json_decode(base64_decode($line['value']),true);
	}else{
		$info = array(
			"org_name" => "Your Organization Name",
			"taxid" => "",
			"address" => "",
			"phone" => "",
			"mobile" => "",
			"fax" => "",
			"email" => "",
			"website" => ""
		);
	}

?>

<body>
	<div class="login-wrapper">
		<div class="text-center">
			<h2 class="fadeInUp animation-delay8" style="font-weight:bold">
				<span class="text-success">Oceanos</span> <span style="color:#ccc; text-shadow:0 1px #fff">Admin</span>
			</h2>
		</div>
		<div class="login-widget animation-delay1">	
			<div class="panel panel-default">
				<div class="panel-heading clearfix">
					<div class="pull-left">
						<i class="fa fa-lock fa-lg"></i> Login
					</div>

					<div class="pull-right">
						<span style="font-size:11px;"><?php echo $info['org_name'];?></span>
						
					</div>
				</div>
				<div class="panel-body">
					<form class="form-login" onsubmit="sign_in()">
						<div class="form-group">
							<label>Username</label>
							<input id="txtUsernameLoginFirstPage" type="text" placeholder="Username" class="form-control input-sm bounceIn animation-delay2" value="<?php echo isset($_REQUEST['username'])?$_REQUEST['username']:"";?>">
						</div>
						<div class="form-group">
							<label>Password</label>
							<input id="txtPasswordLoginFirstPage" onkeypress="if (event.which == 13){sign_in();}" type="password" placeholder="Password" class="form-control input-sm bounceIn animation-delay4">
						</div>
						<div class="form-group">
							<label class="label-checkbox inline">
								<input type="checkbox" class="regular-checkbox chk-delete" />
								<span class="custom-checkbox info bounceIn animation-delay4"></span>
							</label>
							Remember me		
						</div>
		
						<div class="seperator"></div>
						<hr/>
							
						<a onclick="sign_in()" class="btn btn-success btn-sm bounceIn animation-delay5 login-link pull-right" href="#"><i class="fa fa-sign-in"></i> Sign in</a>
					</form>
				</div>
			</div><!-- /panel -->
		</div><!-- /login-widget -->
	</div><!-- /login-wrapper -->
	<script>
		function sign_in(){
			$.ajax({
				url: "libs/xhr/system/login.php",
				type: "POST",
				data: {
					username : $("#txtUsernameLoginFirstPage").val(),
					password : $("#txtPasswordLoginFirstPage").val()
				},
				dataType: "json",
				success: function(json){
					if(json==true){
						window.location = "";
					}else{
						var href = "?error=1";
						href += "username="+$("#txtUsernameLoginFirstPage").val();
						
						
						window.location = href;
					}
				}
			});
			return false;
		}
	</script>
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <!-- Bootstrap -->
    <script src="libs/bootstrap/js/bootstrap.min.js"></script>
	<!-- Modernizr -->
	<script src='libs/js/modernizr.min.js'></script>
    <!-- Pace -->
	<script src='libs/js/pace.min.js'></script>
	<!-- Popup Overlay -->
	<script src='libs/js/jquery.popupoverlay.min.js'></script>
    <!-- Slimscroll -->
	<script src='libs/js/jquery.slimscroll.min.js'></script>
	<!-- Cookie -->
	<script src='libs/js/jquery.cookie.min.js'></script>
	<!-- Endless -->
	<script src="libs/js/endless/endless.js"></script>
</body>
	
	