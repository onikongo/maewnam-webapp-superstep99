$("#tblTeam").data( "selected", [] );
$('#tblTeam').DataTable({
	"bStateSave": true,
	"sDom": fn.config.datatable.sDom,
	"oLanguage": fn.config.datatable.oLanguage,
	"autoWidth" : true,
	"processing": true,
	"serverSide": true,
	"ajax": "apps/accctrl/store/store-team.php",
	"aoColumns": [
		{ "bSortable": false , "sWidth": "20px", "sClass" : "hidden-xs text-center" },
		{"bSortable": true , "sWidth": "30px", "sClass" : "hidden-xs"},
		{"bSort" : true},
		{"bSortable": false, "sClass" : "text-center" , "sWidth": "100px" }
		
	],"order": [[ 1, "desc" ]],
	"createdRow": function ( row, data, index ) {
		var selected = false;
		var checked = "";
		if ( $.inArray(data.DT_RowId, $("#tblTeam").data( "selected")) !== -1 ) {
			$(row).addClass('selected');
			selected = true;
		}
		var s = '';
		s += fn.ui.checkbox("chk_team",data[0],selected);
		$('td', row).eq(0).html(s);

		s = '';
		s += '<a onclick="fn.app.accctrl.team.dialog_icon('+data[0]+')">';
		if(data[1]==null){
			s += '<img class="img-circle" style="height:32px;" src="img/default/user.png">';
		}else{
			s += '<img class="img-circle" style="height:33px;" src="'+data[1]+'?'+(new Date())+'">';
		}
		s += '</a>';
		$('td', row).eq(1).html(s);
			
		s = '';
		s += fn.ui.button("btn btn-xs btn-default","fa fa-pencil","fn.app.accctrl.team.dialog_edit("+data[0]+")");
		s += ' ';
		s += fn.ui.button("btn btn-xs btn-info","fa fa-image","fn.app.accctrl.team.dialog_icon("+data[0]+")");
		s += ' ';
		s += fn.ui.button("btn btn-xs btn-warning","fa fa-chain","fn.app.accctrl.team.member("+data[0]+")");
		$('td', row).eq(3).html(s);
		
	}
});
fn.ui.datatable.selectable('#tblTeam','chk_team');