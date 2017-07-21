<script type="text/javascript">
	fn.app.setting.system.save_document = function(){
		fn.confirmbox("Please confirm to save?","This action may affect the your structure! Are you sure to confirm this action?",function(){
			$.post('apps/setting/xhr/action-save-system-document.php',$('#form_documentation').serialize(),function(response){
				if(response.success){	
					fn.successbox('Setting','Save complete',function(){
						fn.navigate("setting","view=system");
					});
				}else{
					fn.alertbox("Alert",response.msg);
				}
			},'json');
		});return false;
	}
</script>

