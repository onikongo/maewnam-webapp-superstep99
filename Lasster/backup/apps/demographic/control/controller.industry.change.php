<script tyle="text/javascript">
	fn.app.demographic.industry.change = function(id) {
		$.ajax({
			url: "apps/demographic/view/dialog.industry.edit.php",
			data: {id:id},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				$('#dialog_edit_industry').on('shown.bs.modal', function () {
					$("#txtName").focus();
				});
				$("#dialog_edit_industry").on("hidden.bs.modal",function(){
					$(this).remove();
				});
				$("#dialog_edit_industry").modal('show');
			}	
		});
	};
	
	fn.app.demographic.industry.save_change = function(){
		$.post('apps/demographic/xhr/action-edit-industry.php',$('#form_editindustry').serialize(),function(response){
			if(response.success){
				$("#tblIndustry").DataTable().draw();
				$("#dialog_edit_industry").modal('hide');
			}else{
				fn.engine.alert("Alert",response.msg);
			}
			
		},'json');
		return false;
	};
</script>
