
	fn.app.profile.save_setting = function() {
		fn.confirmbox("Save Setting!","Are you sure to save new setting?",function(){
			$.post('apps/profile/xhr/action-save-setting.php',$('#form_setting').serialize(),function(response){
				if(response.success){
					window.location.reload();
				}else{
					fn.engine.alert("Alert",response.msg);
				}
			},'json');
		});
	};
	