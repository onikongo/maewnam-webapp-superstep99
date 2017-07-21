(function (e) {
	"use strict";
	var t = function (e) {
		this.init("address", e, t.defaults)
	};
	e.fn.editableutils.inherit(t, e.fn.editabletypes.abstractinput);
	e.extend(t.prototype, {
		render: function () {
			this.$input = this.$tpl.find("input")
		},
		value2html: function (t, n) {
			if (!t) {
				e(n).empty();
				return
			}
			var r = e("<div>").text(t.city).html() + ", " + e("<div>").text(t.street).html() + " st., bld. " + e("<div>").text(t.building).html();
			e(n).html(r)
		},
		html2value: function (e) {
			return null
		},
		value2str: function (e) {
			var t = "";
			if (e)for (var n in e)t = t + n + ":" + e[n] + ";";
			return t
		},
		str2value: function (e) {
			return e
		},
		value2input: function (e) {
			if (!e)
				return;
			this.$input.filter('[name="city"]').val(e.city);
			this.$input.filter('[name="street"]').val(e.street);
			this.$input.filter('[name="building"]').val(e.building)
		},
		input2value: function () {
			return {
				city: this.$input.filter('[name="city"]').val(),
				street: this.$input.filter('[name="street"]').val(),
				building: this.$input.filter('[name="building"]').val()
			}
		},
		activate: function () {
			this.$input.filter('[name="city"]').focus()
		},
		autosubmit: function () {
			this.$input.keydown(function (t) {
				t.which === 13 && e(this).closest("form").submit()
			})
		}
	});
	
	t.defaults = e.extend({}, e.fn.editabletypes.abstractinput.defaults, {
		tpl: '<div class="editable-address"><label><span>City: </span><input type="text" name="city" class="form-control"></label></div><div class="editable-address"><label><span>Street: </span><input type="text" name="street" class="form-control"></label></div><div class="editable-address"><label><span>Building: </span><input type="text" name="building" class="form-control"></label></div>',
		inputclass: ""
	});
	e.fn.editabletypes.address = t
})(window.jQuery);
	
		    //ajax mocks
	$.mockjaxSettings.responseTime = 500;
	$.mockjax({
		url: '/post',
		response: function (settings) {
			log(settings, this);
		}
	});
	
	$.mockjax({
		url: '/error',
		status: 400,
		statusText: 'Bad Request',
		response: function (settings) {
			this.responseText = 'Please input correct value';
			log(settings, this);
		}
	});
	
	$.mockjax({
		url: '/status',
		status: 500,
		response: function (settings) {
			this.responseText = 'Internal Server Error';
			log(settings, this);
		}
	});
	
	$.mockjax({
		url: '/groups',
		response: function (settings) {
			this.responseText = [{
				value: 0,
		               text: 'Guest'
		            }, {
		                value: 1,
		                text: 'Service'
		            }, {
		                value: 2,
		                text: 'Customer'
		            }, {
		                value: 3,
		                text: 'Operator'
		            }, {
		                value: 4,
		                text: 'Support'
		            }, {
		                value: 5,
		                text: 'Admin'
		            }];
		            log(settings, this);
		        }
	});
	
		    //TODO: add this div to page
		    function log(settings, response) {
		        var s = [],
		            str;
		        s.push(settings.type.toUpperCase() + ' url = "' + settings.url + '"');
		        for (var a in settings.data) {
		            if (settings.data[a] && typeof settings.data[a] === 'object') {
		                str = [];
		                for (var j in settings.data[a]) {
		                    str.push(j + ': "' + settings.data[a][j] + '"');
		                }
		                str = '{ ' + str.join(', ') + ' }';
		            } else {
		                str = '"' + settings.data[a] + '"';
		            }
		            s.push(a + ' = ' + str);
		        }
		        s.push('RESPONSE: status = ' + response.status);
	
		        if (response.responseText) {
		            if ($.isArray(response.responseText)) {
		                s.push('[');
		                $.each(response.responseText, function (i, v) {
		                    s.push('{value: ' + v.value + ', text: "' + v.text + '"}');
		                });
		                s.push(']');
		            } else {
		                s.push($.trim(response.responseText));
		            }
		        }
		        s.push('--------------------------------------\n');
		        $('#console').val(s.join('\n') + $('#console').val());
		    }
	
	/**************************************************************************************************
		 * X-EDITABLES
	*/
	
	$('#inline').on('change', function (e) {
		if ($(this).prop('checked')) {
			window.location.href = '?mode=inline#ajax/plugins.html';
		} else {
			window.location.href = '?#ajax/plugins.html';
		}
	});
	
	if (window.location.href.indexOf("?mode=inline") > -1) {
		$('#inline').prop('checked', true);
		$.fn.editable.defaults.mode = 'inline';
	} else {
		$('#inline').prop('checked', false);
		$.fn.editable.defaults.mode = 'popup';
	}
	
	$.fn.editable.defaults.url = 'apps/setting/xhr/action-save-setting.php';
	$.fn.editable.defaults.mode = 'popup';
	
	$('.editable').editable();
		   
		    //enable / disable
	$('#enable').click(function () {
		$('.table-editable .editable').editable('toggleDisabled');
	});
	
	$('.table-editable .editable').editable('toggleDisabled');
	
	
	