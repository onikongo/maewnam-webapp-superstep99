<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Propvariety | Login</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <!-- Sweet Alert -->
    <link href="js/plugins/sweetalert2/sweetalert2.min.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>
				<div>
					<img src="img/logo.png">
				</div>

            </div>
            <h3>ระบบการจัดการนายหน้าอย่างมืออาชีพ</h3>
            <p>
				ระบบการจัดการนายหน้าเป็นระบบที่อำนวยความสะดวกให้กับนายหน้าอสังหาริมทรัพย์ในด้านต่างๆ
            </p>
            <p>Login in. To see it in action.</p>
            <form id="login-form" class="m-t" role="form" onsubmit="fn.login();return false;">
                <div class="form-group">
                    <input name="username" type="email" class="form-control" placeholder="Username" required="">
                </div>
                <div class="form-group">
                    <input name="password" type="password" class="form-control" placeholder="Password" required="">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

                <a href="#"><small>Forgot password?</small></a>
                <p class="text-muted text-center"><small>Do not have an account?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="?register">สมัครสมาชิกใหม่</a>
            </form>
            <p class="m-t"> <small>Maewnam Network Solution Co,Ltd. &copy; 2017</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <!-- Sweet alert -->
    <script src="js/plugins/sweetalert2/sweetalert2.min.js"></script>
	
	<script src="js/oceanos.js"></script>

</body>

</html>
