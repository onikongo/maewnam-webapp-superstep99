function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}
var fn={
	navigate : function(view,extend){
		var app = getParameterByName("app");
		var previous = getParameterByName("view");
		var link = "?app=" + app + "&view=" + view + "&previous=" + previous;
		if(typeof extend != "undefined"){
			for(i in extend){
				link += "&" + i + "=" + extend[i];
			}
		}
		window.location = link;
		
	},
	app : {},
	iface : {},
	noaccess : function(){
		$('#dlgAccessDenied').toggleClass("open");
		playAudio('fail');       
		return false;
	},
	engine : {
		datatable : {
			button : function(class_color,class_icon,func){
				var s = '';
				s += '<button class="btn '+class_color+' btn-rounded btn-condensed btn-sm" onclick="'+func+'">';
				s += '<span class="fa '+class_icon+'"></span>';
				s += '</button>';
				return s;
			},
			checkbox : function(chk_group,val,selected){
				var s = '';
				s += '<label class="label-checkbox">';
					s += '<input type="checkbox" name="'+chk_group+'" value="'+val+'"'+(selected?' checked':'')+'>';
					s += '<span class="custom-checkbox"></span>';
				s += '</label>';
				return s;
			},
			add_selectable : function(tblName,chkName){
				
				$("#"+tblName+" tbody").on('click', 'td:not(:last-child)', function () {
					var me = $(this).parent();
					var id = me[0].id;
					var index = $.inArray(id, $("#"+tblName+"").data("selected"));
					
					if ( index === -1 ) {
						$("#"+tblName+"").data( "selected").push( id );
						$(me).find('input[name='+chkName+']').prop('checked', true);
					} else {
						$("#"+tblName+"").data( "selected").splice( index, 1 );
						$(me).find('input[name='+chkName+']').prop('checked', false);
					}
			 
					$(me).toggleClass('selected');
				} );
				
				
				$('#'+chkName+'').click(function(){

					var AllChecked = true;
					$('input[name='+chkName+']').each(function(){
						if(!$(this).is(':checked')){
							AllChecked = false;
						}
					});
					
					if(AllChecked){
						$('input[name='+chkName+']').prop('checked', false).parent().parent().removeClass('selected');
						$('input[name='+chkName+']').each(function(){
							var tr = $(this).parent().parent().parent();
							var id = tr[0].id;
							var index = $.inArray(id, $("#"+tblName+"").data( "selected"));
							if ( index != -1 ) {
							   $("#"+tblName+"").data( "selected").splice( index, 1 );
								tr.removeClass("selected");
							}
						});
					}else{
						$('input[name='+chkName+']').prop('checked', true).parent().parent().addClass('selected');
						$('input[name='+chkName+']').each(function(){
							var tr = $(this).parent().parent().parent();
							var id = tr[0].id;
							var index = $.inArray(id, $("#"+tblName+"").data( "selected"));
							if ( index === -1 ) {
								$("#"+tblName+"").data( "selected").push( id );
								tr.addClass("selected");
							}
						});
					}
					
				});
			}
		},
		alert : function(title,message){
			$('#dlgAlertBox h4').html(title);
			$('#dlgAlertBox p').html(message);
			//$('#dlgAlertBox').popup("show");
			$('#dlgAlertBox').toggleClass("open");
			playAudio('alert');       
			return false;
		},
		dlgbox : function(option,title){
			var options = {
				title : "Message Dialog",
				message : "No Message",
				type : "messageDialog"
			};
			if(typeof option == "string"){
				options.message = option;
				if(typeof title != "undefined")options.title = title;
			}else{
				$.extend(options,option);
			}
			
			
			var body = '';
			switch(options.type){
				case "messageDialog":
					body += '<div class="text-center">'+options.message+'</div>';
					var btnSet = [
						{text : "OK", class : "btn btn-default pull-right", click: function() {
							$("#dlgbox").dialog("destroy").remove();
						}}
					];
					break;
				case "confirmDialog":
					body += '<div class="text-center">'+options.message+'</div>';
					var btnSet = [
						{text : "Apply", class : "btn btn-primary pull-right", click: function() {
							$("#dlgbox").dialog("destroy").remove();
							if(typeof options.confirm != "undefined")options.confirm();
						}},
						{text : "Cancel", class : "btn btn-default pull-right", click: function() {
							$("#dlgbox").dialog("destroy").remove();
						}}
					];
					break;
				case "inputDialog":
					body += '<div class="text-center">'+options.message+'<input type="text" class="form-control text-center"></div>';
					var btnSet = [
						{text : "Confirm", class : "btn btn-default pull-right", click: function() {
							var value = $(this).find("input").val();
							$("#dlgbox").dialog("destroy").remove();
							if(typeof options.confirm != "undefined")options.confirm(value);
						}},
						{text : "Cancel", class : "btn btn-default pull-right", click: function() {
							$("#dlgbox").dialog("destroy").remove();
						}}
						
					];
					break;
			}
			
			$("body").append("<div id=\"dlgbox\"></div>");
			$("#dlgbox").html(body);
			$("#dlgbox").dialog({
				autoOpen : true,
				title : options.title,
				modal : true,
				buttons : btnSet,
				close: function(){
					$("#dialogBox").dialog("destroy").remove();
				}
			});
			
			
		},
		click_button_set : function(btn,item,value){
			var value = "item[]";
			
		}
	}
};

$(function(){
	$('#dlgAlertBox,#dlgAccessDenied').popup({
		pagecontainer: '.container',
		transition: 'all 0.3s'
	});	
});
