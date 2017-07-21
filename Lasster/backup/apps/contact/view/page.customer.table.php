
<div class="panel panel-default table-responsive">
	<div class="panel-heading">Customer</div>
	<div class="padding-md clearfix">
		<table id="tblCustomer" class="table table-striped" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th class="text-center">
						<label class="label-checkbox">
							<input id="chk_customer" type="checkbox"><span class="custom-checkbox"></span>
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

<script>
	
$(function(){
	$("#tblCustomer").data( "selected", [] );
	$("#tblCustomer").DataTable({
		"processing": true,
		"serverSide": true,
		"ajax": "apps/contact/store/store-customer.php",
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
			if ( $.inArray(data.DT_RowId, $("#tblCustomer").data( "selected")) !== -1 ) {
                $(row).addClass('selected');
				selected = true;
            }
			var s = '';
			s += fn.engine.datatable.checkbox('chk_customer',data[0],selected);
			$('td', row).eq(0).html(s).addClass("text-center");
			s = '';
			s += fn.engine.datatable.button('btn-default','fa-pencil','fn.app.contact.customer.change('+data[0]+')');
			$('td', row).eq(7).html(s);
		}
	});
	fn.engine.datatable.add_selectable('tblCustomer','chk_customer');
	
});
</script>