var contact = {
	customer : {
		add : fn.noaccess,
		change : fn.noaccess,
		save_change : fn.noaccess,
		remove : fn.noaccess
	},
	organization : {
		add : fn.noaccess,
		change : fn.noaccess,
		save_change : fn.noaccess,
		remove : fn.noaccess
	},
	group : {
		add : fn.noaccess,
		change : fn.noaccess,
		save_change : fn.noaccess,
		remove : fn.noaccess
	}
};

$.extend(fn.app,{contact:contact});