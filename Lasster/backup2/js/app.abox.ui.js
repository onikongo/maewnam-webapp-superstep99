fn.ui = {
	unique : 0,
	button : function(btnClass,iconClass,func){
		var s = '';
		s += '<button type="button" class="'+btnClass+' btn-xs" onclick="'+func+'">';
		s += '<span class="'+iconClass+'"></span>';
		s += '</button>';
		return s;
	},
	checkbox : function(name,val,selected,multiple){
		if(typeof multiple == "undefined")multiple = true;
		
		var icon_selected = (multiple?"check-square":"dot-circle-o")
		var icon_notselected = (multiple?"square-o":"circle-o")
		
		var s = '';
		s += '<span name="' + name + '" type="checkbox" data="' + val + '" class="fa fa-lg fa-'+(selected?icon_selected:icon_notselected) +'"></span>';
		return s;
	},
	switchbox : function(status,func){
		var newid = fn.ui.unique++;
		var s ='';
		s += '<span class="onoffswitch">';
			s += '<input onchange="'+func+'" type="checkbox" class="onoffswitch-checkbox" '+(status?'checked="checked"':'')+' id="chk_'+newid+'">';
			s += '<label class="onoffswitch-label" for="chk_'+newid+'">';
				s += '<span class="onoffswitch-inner" data-swchon-text="on" data-swchoff-text="off"></span>';
				s += '<span class="onoffswitch-switch"></span>';
			s += '</label>';
		s += '</span>';
		return s;
	},
	datatable : {
		selectable : function(tblName,chkName,multiple){
			var table = $(tblName);
			if(typeof multiple == "undefined"){
				multiple = true;
			}
			
			if(multiple){
			
				table.on('click', 'td:not(:last-child)', function () {
					var me = $(this).parent();
					var id = me[0].id;
					var index = $.inArray(id,table.data("selected"));
					if ( index === -1 ) {
						table.data( "selected").push( id );
						$(me).find('span[type=checkbox]').removeClass("fa-square-o").addClass("fa-check-square");
					} else {
						table.data( "selected").splice( index, 1 );
						$(me).find('span[type=checkbox]').removeClass("fa-check-square").addClass("fa-square-o");
					}
					$(me).toggleClass('selected');
				});
				table.find("span[type=checkall]").click(function(){
					var checkbox = $(this);
					if(checkbox.attr('control')==chkName){
						var allchecked = true;
						$('span[name='+chkName+']').each(function(){
							if($(this).hasClass("fa-square-o")){
								allchecked = false;
							}
						});
						
						if(allchecked){
							checkbox.removeClass("fa-check-square").addClass("fa-square-o");
							$('span[name='+chkName+']').removeClass("fa-check-square").addClass("fa-square-o");
							$('span[name='+chkName+']').each(function(){
								var tr = $(this).parent().parent().parent();
								var id = tr[0].id;
								var index = $.inArray(id, table.data( "selected"));
								if ( index != -1 ) {
									table.data("selected").splice( index, 1 );
									tr.removeClass("selected");
								}
							});
						}else{
							checkbox.removeClass("fa-square-o").addClass("fa-check-square");
							$('span[name='+chkName+']').removeClass("fa-square-o").addClass("fa-check-square");
							$('span[name='+chkName+']').each(function(){
								var tr = $(this).parent().parent().parent();
								var id = tr[0].id;
								var index = $.inArray(id, table.data( "selected"));
								if ( index === -1 ) {
									table.data( "selected").push( id );
									tr.addClass("selected");
								}
							});
						}
					}
				});
			}else{ //For General Seelction
				table.on('click', 'td:not(:last-child)', function () {
					var me = $(this).parent();
					var id = me[0].id;
					table.find('span[type=checkbox]').removeClass("fa-dot-circle-o").addClass("fa-circle-o");
					$(me).find('span[type=checkbox]').removeClass("fa-circle-o").addClass("fa-dot-circle-o");
					table.data( "selected", id );
					table.find('tr').removeClass('selected');
					$(me).addClass('selected');
				});
			}
		}
	},
	numberic :{
		phone : function(text){
			if(text.length==10){
				return text.replace(/(\d{3})(\d{3})(\d{4})/, '$1-$2-$3');
			}else if(text.length==9){
				return text.replace(/(\d{3})(\d{3})(\d{3})/, '$1-$2-$3');
			}
			
		}
	}
};
