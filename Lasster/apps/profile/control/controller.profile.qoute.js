
	fn.app.profile.dialog_setqoute = function() {
		$.ajax({
			url: "apps/profile/view/dialog.profile.qoute.php",
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				$('#dialog_edit_qoute').on('shown.bs.modal', function () {
					$("#txtTitle").focus();
				});
				$("#dialog_edit_qoute").on("hidden.bs.modal",function(){
					$(this).remove();
				});
				$("#dialog_edit_qoute").modal('show');
				
					
			}	
		});
	};
	
	fn.app.profile.setqoute = function(){
		$.post('apps/profile/xhr/action-edit-qoute.php',$('#form_editqoute').serialize(),function(response){
			if(response.success){
				$("#dialog_edit_qoute").modal('hide');
				window.location.reload();
			}else{
				fn.engine.alert("Alert",response.msg);
			}
			
		},'json');
		return false;
	};