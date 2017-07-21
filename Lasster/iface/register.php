<!DOCTYPE html>
<html>

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Propvariety | Register</title>

	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="font-awesome/css/font-awesome.css" rel="stylesheet">
	<link href="css/plugins/iCheck/custom.css" rel="stylesheet">
	<link href="css/animate.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
    <!-- Sweet Alert -->
    <link href="js/plugins/sweetalert2/sweetalert2.min.css" rel="stylesheet">
</head>

<body class="gray-bg">

	<div class="middle-box text-center loginscreen   animated fadeInDown">
		<div>
			<div>

				<div>
					<img src="img/logo.png">
				</div>

			</div>
			<h3>เข้าร่วมเป็นสมาชิก</h3>
			<p>Create account to see it in action.</p>
			<form id="form-register" class="m-t" role="form" onsubmit="fn.register();return false;">
				<div class="form-group">
					<input name="txtName" type="text" class="form-control" placeholder="Name" required="">
				</div>
				<div class="form-group">
					<input name="txtEmail" type="email" class="form-control" placeholder="Email" required="">
				</div>
				<div class="form-group">
					<input name="txtPassword" type="password" class="form-control" placeholder="Password" required="">
				</div>
				<div class="form-group">
					<div class="checkbox i-checks"><label> <input name="chkAgree" type="checkbox"><i></i> Agree the terms and policy </label></div>
				</div>
				<button type="submit" class="btn btn-primary block full-width m-b">Register</button>

				<p class="text-muted text-center"><small>Already have an account?</small></p>
				<a class="btn btn-sm btn-white btn-block" href="?">มี Account อยู่แล้ว</a>
			</form>
			<p class="m-t"> <small>Maewnam Network Solution Co,Ltd. &copy; 2017</small> </p>
		</div>
	</div>

	<!-- Mainly scripts -->
	<script src="js/jquery-3.1.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<!-- iCheck -->
	<script src="js/plugins/iCheck/icheck.min.js"></script>
	<script>
		$(document).ready(function(){
			$('.i-checks').iCheck({
				checkboxClass: 'icheckbox_square-green',
				radioClass: 'iradio_square-green',
			});
		});
	</script>
	
    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

    <!-- Sweet alert -->
    <script src="js/plugins/sweetalert2/sweetalert2.min.js"></script>
	
	<script src="js/oceanos.js"></script>
</body>

</html>
