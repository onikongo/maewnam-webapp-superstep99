<!--
<div class="panel panel-default table-responsive">
	<div class="panel-heading">User</div>
	<div class="padding-md clearfix">
		<table id="tblUser" class="table table-striped" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th class="text-center">
						<label class="label-checkbox">
							<input id="chk_user" type="checkbox"><span class="custom-checkbox"></span>
						</label>
					</th>
					<th class="text-center">Fullname</th>
					<th class="text-center">Email</th>
					<th class="text-center">Mobile</th>
					<th class="text-center">Group</th>
					<th class="text-center">Status</th>
					<th class="text-center">Last Login</th>
					<th class="text-center">Action</th>
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
			<table id="tblUser" class="table table-striped" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th class="text-center">
							<label class="label-checkbox">
								<input id="chk_user" type="checkbox"><span class="custom-checkbox"></span>
							</label>
						</th>
						<th class="text-center">Fullname</th>
						<th class="text-center">Email</th>
						<th class="text-center">Mobile</th>
						<th class="text-center">Group</th>
						<th class="text-center">Status</th>
						<th class="text-center">Last Login</th>
						<th class="text-center">Action</th>
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
	$("#tblUser").data( "selected", [] );
	$("#tblUser").DataTable({
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
		"ajax": "apps/accctrl/store/store-user.php",
		"aoColumns": [
			{ "bSortable": false , "sWidth": "30px"},
			{"bSort" : true},
			{"bSortable": true},
			{"bSortable": true},
			{"bSortable": true},
			{"bSortable": true},
			{"bSortable": true},
			{"bSortable": false , "sWidth": "50px" }
		],
		"order": [[ 1, "desc" ]],
		"createdRow": function ( row, data, index ) {
			var selected = false;
			var checked = "";
			if ( $.inArray(data.DT_RowId, $("#tblUser").data( "selected")) !== -1 ) {
                $(row).addClass('selected');
				selected = true;
            }
			var s = '';
			s += fn.engine.datatable.checkbox('chk_user',data[0],selected);
			$('td', row).eq(0).html(s).addClass("text-center");
			s = '';
			s += fn.engine.datatable.button('btn-default','fa-pencil','fn.app.accctrl.user.change('+data[0]+')');
			$('td', row).eq(7).html(s);
		}
	});
	fn.engine.datatable.add_selectable('tblUser','chk_user');

});
</script>