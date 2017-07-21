fn.app.profile.dialog_photo = function() {
		$.ajax({
			url: "apps/profile/view/dialog.profile.photo.php",
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				$("#dialog_profile_photo").on("hidden.bs.modal",function(){
					$(this).remove();
				});
				$("#dialog_profile_photo").modal('show');
				
				$("#dialog_profile_photo .form_upload .fileinput").change(function(){
					var data = new FormData($("#dialog_profile_photo form.form_upload")[0]);
					jQuery.ajax({
						url: 'apps/profile/xhr/action-upload-avatar.php',
						data: data,
						cache: false,
						contentType: false,
						processData: false,
						type: 'POST',
						dataType: 'json',
						success: function(response){
							if(response.success){
								$("#dialog_profile_photo").modal('hide');
								window.location.reload();
							}else{
								fn.engine.alert("Alert",response.msg);
							}	
						}
					});
				});
				$("#dialog_profile_photo").find(".btn_change").click(function(){
					$("#dialog_profile_photo .form_upload .fileinput").click();
				});
				
				$("#dialog_profile_photo").find(".btn_remove").click(function(){
					swal({
						title: 'Are you sure to clear image?',
						text: 'Your will not be able to recover this imaginary file!',
						type: 'warning',
						showCancelButton: true,
						cancelButtonClass: 'btn-raised btn-default',
						cancelButtonText: 'Cancel!',
						confirmButtonClass: 'btn-raised btn-danger',
						confirmButtonText: 'Yes, delete it!',
						closeOnConfirm: false
					}).then(function(){
						$.post('apps/profile/xhr/action-clear-avatar.php',function(response){
							swal({
								title: 'Deleted!',
								text: 'Your imaginary file has been deleted.',
								type: 'success',
								confirmButtonClass: 'btn-raised btn-success',
								confirmButtonText: 'OK'
							}).then(function(){
								$("#dialog_profile_photo").modal('hide');
								window.location.reload();
							});
						},'json');
					});
				});
			}	
		});
	};