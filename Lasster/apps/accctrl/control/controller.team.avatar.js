	
	fn.app.accctrl.team.dialog_icon = function(id) {
		$.ajax({
			url: "apps/accctrl/view/dialog.team.photo.php",
			data: {id:id},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				$("#dialog_team_photo").on("hidden.bs.modal",function(){
					$(this).remove();
				});
				$("#dialog_team_photo").modal('show');
				
				$("#dialog_team_photo .form_upload .fileinput").change(function(){
					var data = new FormData($("#dialog_team_photo form.form_upload")[0]);
					jQuery.ajax({
						url: 'apps/accctrl/xhr/action-upload-team-image.php',
						data: data,
						cache: false,
						contentType: false,
						processData: false,
						type: 'POST',
						dataType: 'json',
						success: function(response){
							if(response.success){
								$("#tblTeam").DataTable().draw();
								$("#dialog_team_photo").modal('hide');
							}else{
								fn.engine.alert("Alert",response.msg);
							}	
						}
					});
				});
				$("#dialog_team_photo").find(".btn_change").click(function(){
					$("#dialog_team_photo .form_upload .fileinput").click();
				});
				
				$("#dialog_team_photo").find(".btn_remove").click(function(){
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
					}).then(function() {
						$.post('apps/accctrl/xhr/action-clear-team-image.php',{id:id},function(response){
							swal({
								title: 'Deleted!',
								text: 'Your imaginary file has been deleted.',
								type: 'success',
								confirmButtonClass: 'btn-raised btn-success',
								confirmButtonText: 'OK'
							}).then(function(){
								$("#tblTeam").DataTable().draw();
								$("#dialog_team_photo").modal('hide');
							});
						},'json');
					});
				});
			}	
		});
	};
