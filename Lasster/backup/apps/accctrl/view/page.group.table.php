<!--
<div class="panel panel-default table-responsive">
	<div class="panel-heading">Group</div>
	<div class="padding-md clearfix">
		<table id="tblGroup" class="table table-striped" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th class="text-center">
						<label class="label-checkbox">
							<input id="chk_group" type="checkbox"><span class="custom-checkbox"></span>
						</label>
					</th>
					<th class="text-center">Name</th>
					<th class="text-center">Created</th>
					<th class="text-center">Updated</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
</div>
-->
<section class="widget">
	<div class="widget-body">
	<div class="panel-heading">Group</div>
		<div class="mt">
			<div class="table-responsive">
			<table id="tblGroup" class="table table-striped" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th class="text-center">
							<label class="label-checkbox">
								<input id="chk_group" type="checkbox"><span class="custom-checkbox"></span>
							</label>
						</th>
						<th class="text-center">Name</th>
						<th class="text-center">Created</th>
						<th class="text-center">Updated</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
			</div>
		</div>
	</div>
</section>

<script>
$(function(){
	$.extend( $.fn.dataTableExt.oStdClasses, {
            "sWrapper": "dataTables_wrapper form-inline"
	} );
	$("#tblGroup").data( "selected", [] );
	$("#tblGroup").DataTable({
		"sDom": "<'row'<'col-md-6 hidden-xs'l><'col-md-6'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
		"oLanguage": {
			"sLengthMenu": "_MENU_",
			"sInfo": "Showing <strong>_START_ to _END_</strong> of _TOTAL_ entries"
		},
		"oClasses": {
			"sFilter": "pull-right",
			"sFilterInput": "form-control input-rounded ml-sm"
		},
		"responsive": true,
		"processing": true,
		"serverSide": true,
		"ajax": "apps/accctrl/store/store-group.php",
		"aoColumns": [
			{ "bSortable": false},
			{"bSort" : true},
			{"bSortable": true},
			{"bSortable": true},
			{"bSortable": false }
		],
		"order": [[ 1, "desc" ]],
		"createdRow": function ( row, data, index ) {
			var selected = false;
			var checked = "";
			if ( $.inArray(data.DT_RowId, $("#tblGroup").data( "selected")) !== -1 ) {
                $(row).addClass('selected');
				selected = true;
            }
			var s = '';
			s += fn.engine.datatable.checkbox('chk_group',data[0],selected);
			$('td', row).eq(0).html(s).addClass("text-center");
			s = '';
			s += fn.engine.datatable.button('btn-default','fa-pencil','fn.app.accctrl.group.change('+data[0]+')');
			s += ' ';
			s += fn.engine.datatable.button('btn-warning','fa-lock','fn.app.accctrl.group.permission('+data[0]+')');
			$('td', row).eq(4).html(s);
		}
	});
	fn.engine.datatable.add_selectable('tblGroup','chk_group');
	
});
</script>