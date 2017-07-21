
<div class="panel panel-default table-responsive">
	<div class="panel-heading">Organization</div>
	<div class="padding-md clearfix">
		<table id="tblOrganization" class="table table-striped" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th class="text-center">
						<label class="label-checkbox">
							<input id="chk_organization" type="checkbox"><span class="custom-checkbox"></span>
						</label>
					</th>
					<th class="text-center">Organization</th>
					<th class="text-center">Email</th>
					<th class="text-center">Mobile</th>
					<th class="text-center">Phone</th>
					<th class="text-center">Industry</th>
					<th class="text-center">Type</th>
					<th class="text-center">Updated</th>
					<th class="text-center">Action</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
</div>

<script>
	
$(function(){
	$("#tblOrganization").data( "selected", [] );
	$("#tblOrganization").DataTable({
		"processing": true,
		"serverSide": true,
		"ajax": "apps/contact/store/store-organization.php",
		"aoColumns": [
			{ "bSortable": false , "sWidth": "30px"},
			{"bSort" : true},
			{"bSortable": true},
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
			if ( $.inArray(data.DT_RowId, $("#tblOrganization").data( "selected")) !== -1 ) {
                $(row).addClass('selected');
				selected = true;
            }
			var s = '';
			s += fn.engine.datatable.checkbox('chk_organization',data[0],selected);
			$('td', row).eq(0).html(s).addClass("text-center");
			s = '';
			s += fn.engine.datatable.button('btn-default','fa-pencil','fn.app.contact.organization.change('+data[0]+')');
			$('td', row).eq(8).html(s);
		}
	});
	fn.engine.datatable.add_selectable('tblOrganization','chk_organization');
	
});
</script>