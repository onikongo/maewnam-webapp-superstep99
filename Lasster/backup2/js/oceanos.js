var fn={
	app : {},
	iface : {},
	ui : {},
	config : {
		datatable : {
			sDom : "<'dt-toolbar'<'col-xs-12 col-sm-6 hidden-xs'l><'itoolbar col-sm-6 col-xs-12'f>>t<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i>r<'col-xs-12 col-sm-6'p>>",
			oLanguage: {
				sSearch: '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
			}
		}
	},
	noEnterSubmit(e){
		if( e.which == 13 ) e.preventDefault();
	},
	blockUI : function(element){
		$(element).block({
			message : '<div class=\'sk-three-bounce\'><div class=\'sk-child sk-bounce1\'></div><div class=\'sk-child sk-bounce2\'></div><div class=\'sk-child sk-bounce3\'></div></div>',
			css : {
				border : 'none',
				backgroundColor : 'transparent'
			},
			overlayCSS : {
				backgroundColor : '#FAFEFF',
				opacity : 0.5,
				cursor : 'wait'
			}
		});
	},
	unblockUI : function(element){
		$(element).unblock();
	},
	oceanos : {
		data : {
			session_id : null,
			user_id : null,
			user_name : null,
			server_time : null,
			actions : [],
			notificaiton : null,
			widget : null
		},
		timer : null,
		process : function(ps){
			switch(ps.action){
				case "instance_message":
					var s = '';
					s += '<li class="message">';
						s += '<span class="thumb-sm">';
							s += '<img class="img-circle" src="demo/img/people/a2.jpg" alt="' + ps.sender + '">';
							s += '</span>';
						s += '<div class="message-body">' + ps.msg + '</div>';
					s += '</li>';
					$(".message-list[data-to="+ps.source+"]").append(s);
					$(".message-list[data-to="+ps.source+"]").slimscroll({ scrollBy: '400px' });
					break;
			}
		},
		login : function(){
			$.post("ajax/abox/action-login.php",$("form[name=form_login]").serialize(),function(response){
				if(response.success){
					window.location.reload();
				}else{
					fn.alertbox("Access Denied",response.msg);
				}
			},"json");
			return false;
		},
		logout : function(){
			$.post("ajax/abox/action-logout.php",function(html){
				window.location.reload();
			});
		},
		init : function(auto_start){
			new Switchery(document.getElementById('checkbox-ios1'));
			var changeCheckbox = document.querySelector('#checkbox-ios1');
			
			$("#checkbox-ios1").click(function(){
				var status = changeCheckbox.checked;
				if(status){
					fn.abox.run_timer();
				}else{
					clearInterval(fn.abox.timer);
				}
				
				$.post("ajax/abox/action-update-switch.php",{status:status},function(html){
					 
				});
			});
			
			if(auto_start){
				fn.abox.run_timer();
			}
			
			/*
			$("#notifications-toggle").on("change",function(){
				var btnActive = $(this).find('.active').load("btnActive").
				console.log(this);
			});
			*/
			fn.abox.notification.update();
			fn.navigate('dashboard');
		},
		run_timer : function(){
			fn.abox.timer = setInterval(function(){
				var now = new moment();
				$.post("ajax/abox/action-update.php",{local_time:now.unix(),actions:fn.abox.data.actions},function(json){
					fn.abox.data.server_time = json.server_time;
					fn.abox.data.actions = [];
					
					if(json.process.length > 0){
						for(i in json.process){
							fn.abox.process(json.process[i]);
						}
					}
				},"json");
			},4000);
		},
		send_message : function(me,to,msg){
			$.post("ajax/abox/action-send-message.php",{to:to,msg:msg},function(response){
				
				var $currentMessageList = $('.chat-sidebar-chat.open .message-list'),
				$message = $('<li class="message from-me">' +
                    '<span class="thumb-sm"><img class="img-circle" src="img/avatar.png" alt="..."></span>' +
                    '<div class="message-body"></div>' +
                    '</li>');
				$message.appendTo($currentMessageList).find('.message-body').text(msg);
				$(me).val('');
				$currentMessageList.slimscroll({ scrollBy: '400px' });
				/*
				if(response.success){
					window.location.reload();
				}else{
					fn.alertbox("Access Denied",response.msg);
				}
				*/
			},"json");
			return false;
		},
		notification : {
			update : function(){
				$.post("ajax/live/store-notification.php",function(html){
					var now = new Date();
					$("#notifications-list").html(html);
					$("#notifications-status").html("Synced at: "+now.format("d F Y H:i"));
				},"html");
			},
			initial : function(){
				
			}
		},
		load_widget_each : function(current){
			var widget = $("#"+fn.abox.data.widget[current]);
			var widget_name = widget.attr("widget");
			var widget_param = widget.attr("param");
			$.get("widget/" + widget_name + "/widget.json",function(json){
				$.post("widget/" + widget_name + "/index.php",{
						id : widget.attr("id"),
						widget : widget_name,
						param : widget_param
					},function(html){
					widget.html(html);
					widget.addClass(json.class);
					if(json.controller != ""){
						$.post("widget/" + widget_name + "/" + json.controller,{
							id : widget.attr("id"),
							widget : widget_name,
							param : widget_param
						},function(html){
							$("body").append(html);
						},"html");
					}
					current++;
					if(fn.abox.data.widget.length > current){
						fn.abox.load_widget_each(current);
					}
					
				},"html");
				
			},"json");

		},
		initial_widget : function(){
			var widgets = [];
			$(".widget").each(function(){
				widgets.push($(this).attr("id"));
			});
			fn.abox.data.widget = widgets;
			fn.abox.load_widget_each(0);
		}
	},
	navigate : function(app,param){
		var path = '#apps/' + app + '/index.php';
		if(typeof param != "undefined"){
			path += '?' + param;
		}
		
		window.location = path;
		
		/*
		var li = $(".main_menu[appname="+app+"]");
		if(!li.hasClass("active")){
			$(".main_menu,.head_menu").removeClass("active");
			li.addClass("active");
			if(li.parent().hasClass("collapse")){
				li.parent().parent().addClass("active");
			}
		}
		var path = 'apps/' + app + '/index.php';
		if(typeof param != "undefined"){
			path += '?' + param;
		}
		fn.blockUI("#content");
		//SingApp._resetResizeCallbacks()
		$.post(path,function(html){
			$("#content").html(html);
			fn.unblockUI("#content");
		},"html");
		*/
	},
	reload : function(){
		var app = $("body").data('current_page');
		var path = 'apps/' + app + '/index.php';
		if($("body").data('current_param') != ''){
			path += '?' + param;
		}
		
		fn.redraw = function(){};
		$.post(path,function(html){
			$(".page-container").html(html);
			fn.redraw();
		},"html");
	},
	alertbox : function(title,message,func){
		swal({
			title : title,
			text : message,
			type : "warning",
			confirmButtonText : "Dismiss"
		}).then(function () {
			if(typeof func != "undefined")func();
		}); 
	},
	successbox : function(title,message,func){
		swal({
			title : title,
			text : message,
			type : "success",
			confirmButtonText : "Dismiss"
		}).then(function () {
			func();
		}); 
	},
	confirmbox : function(title,message,confirmed){
		swal({
			title: title,
			text: message,
			type: 'question',
			showCancelButton: true,
			confirmButtonText: 'Confirm'
		}).then(function () {
			confirmed();
		});
		
	
	},
	errorbox : function(title,message,func){
		swal({
			title : title,
			text : message,
			type : "error",
			confirmButtonClass : "btn-raised btn-danger",
			confirmButtonText : "Dismiss"
		},function(){
			if(typeof func != "undefined"){
				func();
			}
		});      
	},
	logout : function(){
		
		swal({
			title : "logout?",
			text : "Do you want to logout?",
			type : "warning",
			cancelButtonText : "Cancel!",
			confirmButtonText : "Yes!",
			showCancelButton: true,
		}).then(function () {
			$.post("ajax/abox/action-logout.php",function(html){
				window.location.reload();
			});
		});;
		return false;
	},
	noaccess : function(me){
		swal({
			title : "Access Denied!",
			text : "Sorry! You have no permission to access this action!",
			type : "warning",
			confirmButtonClass : "btn-raised btn-warning",
			confirmButtonText : "Dismiss"
		});
		
		if(typeof me != "undefined"){
			if($(me).is("input[type=checkbox]")){
				$(me).prop('checked',!$(me).prop('checked'));
				
			}
		}
		
		return false;
	},
	engine : {
		alert : function(title,message){
			swal({
				title : title,
				text : message,
				type : "warning",
				confirmButtonClass : "btn-raised btn-warning",
				confirmButtonText : "Dismiss"
			});      
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
	},
	register : function(){
		$.post("ajax/action-register.php",$("#form-register").serialize(),function(response){
			if(response.success){
				fn.successbox("ขอบคุณสำหรับการลงทะเบียน","ท่านสามารถเข้าใช้งานได้ทันที",function(){
					window.location = "?";
				});
			}else{
				fn.alertbox("Access Denied", response.msg);
			}
		},"json");
	},
	login : function(){
		$.post("ajax/action-login.php",$("#login-form").serialize(),function(response){
			if(response.success){
				window.location.reload();
			}else{
				fn.alertbox("Access Denied", response.msg);
			}
		},"json");
		return false;
	},
	logout : function(){
		$.SmartMessageBox({
			title : "<i class='fa fa-sign-out txt-color-orangeDark'></i> Logout <span class='txt-color-orangeDark'><strong>" + $('#show-shortcut').text() + "</strong></span> ?",
			content : $this.data('logout-msg') || "You can improve your security further after logging out by closing this opened browser",
			buttons : '[No][Yes]'
			
		},function(ButtonPressed) {
			if (ButtonPressed == "Yes") {
				$.root_.addClass('animated fadeOutUp');
				setTimeout(logout, 1000);
			}
		});
			
		function logout() {
			window.location = $this.attr('href');
				$.post("ajax/action-logout.php",function(html){
				window.location.reload();
			});
		}
	}
};

$(function(){
	$("#main").css("min-height",$(window).height()-52);
});
/*

$(function(){
	$(".main_menu").click(function(){
		$(".main_menu,.head_menu").removeClass("active");
		$(this).addClass("active");
		if($(this).parent().hasClass("collapse")){
			$(this).parent().parent().addClass("active");
		}
	});
});

var theme = 'flat';
$.globalMessenger({ theme: theme });
Messenger.options = { theme: theme  };
*/

//var logout = fn.abox.logout();