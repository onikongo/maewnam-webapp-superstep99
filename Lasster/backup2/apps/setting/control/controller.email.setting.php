<script type="text/javascript">
	fn.app.setting.profile.mail.dialog_setting = function() {
		$.ajax({
			url: "apps/setting/view/dialog.setting.email.php",
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				$("#dialog_mailsetting").on("hidden.bs.modal",function(){
					$(this).remove();
				});
				$('#dialog_mailsetting').on('shown.bs.modal', function () {
					$("#txtName").focus();
				});
				$("#dialog_mailsetting").modal('show');
				
				$("select[name=cbbSecurity]").change(function(){
					if($(this).val()=="none"){
						$("input[name=txtIncomingPort]").val(143);
					}else if($(this).val()=="ssl"){
						$("input[name=txtIncomingPort]").val(993);
					}
				});
				$("select[name=cbbSMTPSecurity]").change(function(){
					if($(this).val()=="none"){
						$("input[name=txtOutgoingPort]").val(25);
					}else if($(this).val()=="ssl"){
						$("input[name=txtOutgoingPort]").val(465);
					}
				});
				
				$("#chkAuth").change(function(){
					if($(this).prop('checked')){
						$(".gSame").hide();
					}else{
						$(".gSame").show();
						
					}
				});
				
				
			}	
		});
	};

	fn.app.setting.profile.mail.save_setting = function(){
		$.post('apps/setting/xhr/action-email-setting.php',$('#form_mailsetting').serialize(),function(response){
			if(response.success){
				$("#dialog_mailsetting").modal('hide');
				$("#form_mailsetting")[0].reset();
			}else{
				fn.engine.alert("Alert",response.msg);
			}
		},'json');
		return false;
	};
	
	fn.app.setting.profile.mail.testserver = function(){
		$.post('apps/setting/xhr/action-email-testserver.php',$('#form_mailsetting').serialize(),function(response){
			if(response.success){
				fn.successbox("Passed",response.msg);
			}else{
				fn.engine.alert("Alert",response.msg);
			}
		},'json');
		return false;
	};
	
</script>