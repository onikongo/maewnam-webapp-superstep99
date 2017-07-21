var profile = {
	address : {
		initial : fn.noaccess,
		load_country : fn.noaccess,
		load_city : fn.noaccess,
		load_district : fn.noaccess,
		load_subdistrict : fn.noaccess
	},
	dialog_edit : fn.noaccess,
	dialog_setmail : fn.noaccess,
	dialog_setqoute : fn.noaccess,
	dialog_photo : fn.noaccess,
	
	edit : fn.noaccess,
	setmail : fn.noaccess,
	setqoute : fn.noaccess,
	
	save_setting : fn.noaccess,
	
	change_language : fn.noaccess,
	mail : {
		dialog_setting : fn.noaccess,
		save_setting : fn.noaccess,
		dialog_sendmail : fn.noaccess,
		sendmail : fn.noaccess,
		testsever : fn.noaccess
	},
	change_avatar : fn.noaccess
};

$.extend(fn.app,{profile:profile});