
	fn.app.profile.address.load_country = function(combobox){
		$.ajax({
			url: "apps/accctrl/store/store-country.php",
			type: "POST",dataType: "json",
			success: function(json){
				$(combobox).html("");
				for(i in json.aaData){
					$(combobox).append('<option value="' + json.aaData[i][0] + '">' + json.aaData[i][1] + '</option>');
				}
				$(combobox).val(211); // Default Select Thailand
				$(combobox).change();
			}
		});
	}
	
	fn.app.profile.address.load_city = function(combobox,country){
		$.ajax({
			url: "apps/accctrl/store/store-city.php",
			type: "POST",
			data: {filter : "country = " + country},
			dataType: "json",
			success: function(json){
				$(combobox).html("");
				for(i in json.aaData){
					$(combobox).append('<option value="' + json.aaData[i][0] + '">' + json.aaData[i][1] + '</option>');
				}
				$(combobox).change();
			}
		});
	}
	
	fn.app.profile.address.load_district = function(combobox,city){
		$.ajax({
			url: "apps/accctrl/store/store-district.php",
			type: "POST",
			data: {filter : "city = " + city},
			dataType: "json",
			success: function(json){
				$(combobox).html("");
				for(i in json.aaData){
					$(combobox).append('<option value="' + json.aaData[i][0] + '">' + json.aaData[i][1] + '</option>');
				}
				$(combobox).change();
			}
		});
	}
	
	fn.app.profile.address.load_subdistrict = function(combobox,district){
		$.ajax({
			url: "apps/accctrl/store/store-subdistrict.php",
			type: "POST",
			data: {filter : "district = " + district},
			dataType: "json",
			success: function(json){
				$(combobox).html("");
				for(i in json.aaData){
					$(combobox).append('<option value="' + json.aaData[i][0] + '">' + json.aaData[i][1] + '</option>');
				}
			}
		});
	}
	
	fn.app.profile.address.initial = function(country,province,district,subsitrict){
		$(country).change(function(){
			fn.app.profile.address.load_city(province,$(this).val());
		});
		$(province).change(function(){
			fn.app.profile.address.load_district(district,$(this).val());
		});
		$(district).change(function(){
			fn.app.profile.address.load_subdistrict(subsitrict,$(this).val());
		});
	}


	fn.app.profile.dialog_edit = function() {
		$.ajax({
			url: "apps/profile/view/dialog.profile.edit.php",
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				$('#dialog_edit_profile').on('shown.bs.modal', function () {
					$("#txtName").focus();
				});
				$("#dialog_edit_profile").on("hidden.bs.modal",function(){
					$(this).remove();
				});
				$("#dialog_edit_profile").modal('show');
				
				fn.app.profile.address.initial(
					"#form_editprofile #cbbCountry",
					"#form_editprofile #cbbCity",
					"#form_editprofile #cbbDistrict",
					"#form_editprofile #cbbSubdistrict");
					
			}	
		});
	};
	
	fn.app.profile.edit = function(){
		$.post('apps/profile/xhr/action-edit-profile.php',$('#form_editprofile').serialize(),function(response){
			if(response.success){
				$("#dialog_edit_profile").modal('hide');
				fn.navigate("profile");
			}else{
				fn.engine.alert("Alert",response.msg);
			}
			
		},'json');
		return false;
	};