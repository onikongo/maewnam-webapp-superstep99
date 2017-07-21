<script type="text/javascript">
	fn.app.setting.profile.mail.dialog_sendmail = function() {
		$.ajax({
			url: "apps/setting/view/dialog.mail.sender.php",
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				$("#dialog_sendmail").on("hidden.bs.modal",function(){
					$(this).remove();
				});
				$('#dialog_sendmail').on('shown.bs.modal', function () {
					$("#txtName").focus();
				});
				$("#dialog_sendmail").modal('show');
			}	
		});
	};

	fn.app.setting.profile.mail.sendmail = function(){
		$.post('apps/setting/xhr/action-mail-send.php',$('#form_sendmail').serialize(),function(response){
			if(response.success){
				$("#dialog_sendmail").modal('hide');
				$("#form_sendmail")[0].reset();
			}else{
				fn.engine.alert("Alert",response.msg);
			}
		},'json');
		return false;
	};
	
	$("#btnSendmail").click(function(){
		fn.app.setting.profile.mail.dialog_sendmail()
	});
</script>