
	fn.app.accctrl.team.member = function(id) {
		var multiple = true;
		$.ajax({
			url: "apps/accctrl/view/dialog.team.member.php",
			data: {id:id},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				$("#dialog_team_member").on("hidden.bs.modal",function(){
					$(this).remove();
				});
				$("#dialog_team_member").modal('show');
				$("#btnAddMember").click(function(){
					var selected = [];
					$("#dialog_team_member input.user_id").each(function(){
						selected.push($(this).val());
					});
					fn.app.accctrl.user.dialog_lookup(function(member){
						var add_member = function(member){
							var s = '';
							s +='<tr>';
								s +='<td class="text-center">';
									s += '<img src="'+(member.contact.avatar==null?"img/default/user.png":member.contact.avatar)+'" alt="" class="img-round" height="36">';
								s +='</td>';
								s +='<td>';
									s += '<input type="hidden" name="txtID[]" value="">';
									s += '<input type="hidden" class="flagRemove" name="flagRemove[]" value="no">';
									s += '<input type="hidden" class="user_id" name="txtMember[]" value="' + member.id + '">';
									s += member.username;
								s +='</td>';
								s +='<td>';
									s += '<select name="cbbRole[]" class="form-control">';
									s += $("#data_sales_role_option").html();
									s += '</select>'
								s +='</td>';
								s +='<td class="text-center">';
									s += '<a class="btn btn-xs btn-danger" onclick="fn.app.accctrl.team.remove_member(this)">';
										s += '<i class="fa fa-remove"></i>';
									s += '</a>';
								s +='</td>';
							s +='</tr>';
							return s;
						};
						if(multiple){
							for(i in member){
								$("#form_teammember table tbody").append(add_member(member[i]));
							}
						}else{
							$("#form_teammember table tbody").append(add_member(member));
						}
					},multiple,selected);
				});
			}
		});
	};
	
	fn.app.accctrl.team.save_member = function(){
		$.post('apps/accctrl/xhr/action-save-team-member.php',$('#form_teammember').serialize(),function(response){
			if(response.success){
				$("#dialog_team_member").modal('hide');
			}else{
				fn.engine.alert("Alert",response.msg);
			}
		},'json');
		return false;
	};
	
	fn.app.accctrl.team.remove_member = function(me,id){
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
	};
	
	
