	<div class="custom-popup width-100" id="logoutConfirm">
		<div class="padding-md">
			<h4 class="m-top-none"> Do you want to logout?</h4>
		</div>

		<div class="text-center">
			<a class="btn btn-success m-right-sm" onclick="sign_out()">Logout</a>
			<a class="btn btn-danger logoutConfirm_close">Cancel</a>
		</div>
	</div>
	<script>
		function sign_out(){
			$.ajax({
				url: "libs/xhr/system/logout.php",
				type: "POST",
				dataType: "html",
				success: function(html){
					window.location.reload();
				}
			});
			return false;
		}
	</script>