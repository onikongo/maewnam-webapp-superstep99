<script type="text/javascript">
	fn.app.setting.profile.dialog_language = function() {
		$.ajax({
			url: "apps/setting/view/dialog.language.change.php",
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				$("#dialog_language").on("hidden.bs.modal",function(){
					$(this).remove();
				});
				$('#dialog_language').on('shown.bs.modal', function () {
					$("#txtName").focus();
				});
				$("#dialog_language").modal('show');
			}	
		});
	};

	fn.app.setting.profile.change_language = function(){
		$.post('apps/setting/xhr/action-change-language.php',$('#form_language').serialize(),function(response){
			if(response.success){
				fn.engine.alert("The language will change after reload!",response.msg);
				$("#dialog_language").modal('hide');
				$("#form_language")[0].reset();
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