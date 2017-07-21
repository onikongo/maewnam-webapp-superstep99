<script type="text/javascript">
	fn.app.setting.sales = {
		add_stage : function(){
			var s = '';
			s += '<tr class="success">';
				s += '<td>';
					s += '<input type="hidden" name="txtID[]" value="">';
					s += '<a class="btn btn-default">';
						s += '<i class="fa fa-sort"></i>';
					s += '</a>';
				s += '</td>';
				s += '<td>';
					s += '<input type="text" name="txtName[]" class="form-control" placeholder="New Stage" >';
				s += '</td>';
				s += '<td>';
					s += '<input type="color" name="txtColor[]" class="form-control">';
				s += '</td>';
				s += '<td>';
					s += '<select name="cbbStatus[]" class="form-control">';
						s += '<option value="1">Active</option>';
						s += '<option value="0">Inactive</option>';
						s += '<option value="2">Halt</option>';
					s += '</select>';
				s += '</td>';
				s += '<td>';
					s += '<a class="btn btn-danger" onclick="fn.app.sales.action.toggleRemove(this)">';
						s += '<i class="fa fa-remove"></i>';
					s += '</a>';
					s += '&nbsp;';
					s += '<a class="btn btn-warning">';
						s += '<i class="fa fa-pencil"></i>';
					s += '</a>';
					s += '&nbsp;';
					s += '<a class="btn btn-default">';
						s += '<i class="fa fa-pencil"></i>';
					s += '</a>';
					s += '<input class="txtDetail" type="hidden" name="txtDetail[]">';
					s += '<input class="flagRemove" type="hidden" name="flagRemove[]">'
				s += '</td>';
			s += '</tr>';
			$("#tblStage tbody").append(s);
		},
		save_stage : function(){
			$.post('apps/setting/xhr/action-save-stage.php',$('#formStage').serialize(),function(response){
				if(response.success){
					fn.successbox('setting','Save complete',function(){
						fn.navigate("setting","view=company");
					});
				}else{
					fn.engine.alert("Alert",response.msg);
				}
			},'json');
			return false;
		},
		action : {
			toggleRemove : function(me,id){
				var tr = $(me).parent().parent();
				if(typeof id != "undefined"){
					if(tr.hasClass("danger")){
						tr.removeClass("danger");
						tr.find(".flagRemove").val("no");
					}else{
						tr.addClass("danger");
						tr.find(".flagRemove").val("yes");
					}
				}else{
					tr.remove();
				}
			}
		}
	};
	
	$(".itoolbar").append('<a class="btn btn-primary" onclick="fn.app.setting.sales.add_stage()">Add</a>');
	
	$(".itoolbar").append('<a class="btn btn-danger pull-right" onclick="fn.app.setting.sales.save_stage()">Save</a>');
</script>

