$("#tblRole").data( "selected", [] );
$('#tblRole').DataTable({
	"bStateSave": true,
	"sDom": fn.config.datatable.sDom,
	"oLanguage": fn.config.datatable.oLanguage,
	"autoWidth" : true,
	"processing": true,
	"serverSide": true,
	"ajax": "apps/accctrl/store/store-role.php",
	"aoColumns": [
		{"bSortable": false , "sWidth": "20px", "sClass" : "hidden-xs text-center" },
		{"bSort" : true},
		{"bSortable": false, "sClass" : "text-center" , "sWidth": "40px"  }
	],"order": [[ 1, "desc" ]],
	"createdRow": function ( row, data, index ) {
		var selected = false;
		var checked = "";
		if ( $.inArray(data.DT_RowId, $("#tblGroup").data( "selected")) !== -1 ) {
			$(row).addClass('selected');
			selected = true;
		}
		var s = '';
		s += fn.ui.checkbox("chk_role",data[0],selected);
		$('td', row).eq(0).html(s);
		s = '';
		s += fn.ui.button("btn btn-xs btn-default","fa fa-pencil","fn.app.accctrl.role.dialog_edit("+data[0]+")");
		$('td', row).eq(2).html(s);
	}
});
fn.ui.datatable.selectable('#tblRole','chk_role');