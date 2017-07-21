$("#tblGroup").data( "selected", [] );
$('#tblGroup').DataTable({
	"bStateSave": true,
	"sDom": fn.config.datatable.sDom,
	"oLanguage": fn.config.datatable.oLanguage,
	"autoWidth" : true,
	"processing": true,
	"serverSide": true,
	"ajax": "apps/accctrl/store/store-group.php",
	"aoColumns": [
		{"bSortable":false	,"data":"id"		,"sClass":"hidden-xs text-center",	"sWidth": "20px"  },
		{"bSort":true		,"data":"name"	},
		{"bSortable":true	,"data":"created"	,"sClass":"hidden-xs text-center"},
		{"bSortable":true	,"data":"updated"	,"sClass":"hidden-xs text-center"},
		{"bSortable":false	,"data":"id"		,"sClass":"text-center" , "sWidth": "80px"  }
	],"order": [[ 1, "desc" ]],
	"createdRow": function ( row, data, index ) {
		var selected = false,checked = "",s = '';
		if ( $.inArray(data.DT_RowId, $("#tblGroup").data( "selected")) !== -1 ) {
			$(row).addClass('selected');
			selected = true;
		}
		$('td', row).eq(0).html(fn.ui.checkbox("chk_group",data[0],selected));
		$('td', row).eq(2).html(moment(data.created).format("DD/MM/YYYY HH:mm:ss"));
		$('td', row).eq(3).html(moment(data.updated).format("DD/MM/YYYY HH:mm:ss"));

		s = '';
		s += fn.ui.button("btn btn-xs btn-default","fa fa-pencil","fn.app.accctrl.group.dialog_edit("+data[0]+")");
		s += fn.ui.button("btn btn-xs btn-danger","fa fa-lock","fn.app.accctrl.group.dialog_permission("+data[0]+")");
		s += fn.ui.button("btn btn-xs btn-warning","fa fa-university","fn.app.accctrl.group.dialog_role("+data[0]+")");
		$('td', row).eq(4).html(s);
	}
});
fn.ui.datatable.selectable('#tblGroup','chk_group');