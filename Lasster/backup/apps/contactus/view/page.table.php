<style>

/* ============================================================
  switch button
============================================================ */
.switch 
{
	
	width:50px;
	margin:auto;

}

/* ============================================================
  COMMON
============================================================ */
.cmn-toggle {
  position: absolute;
  margin-left: -9999px;
  visibility: hidden;
}
.cmn-toggle + label {
  display: block;
  position: relative;
  cursor: pointer;
  outline: none;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}
/* ============================================================
  SWITCH 1 - ROUND
============================================================ */

/* input.cmn-toggle-round + label {
  padding: 2px;
  width: 50px;
  height: 30px;
  background-color: #dddddd;
  -webkit-border-radius: 60px;
  -moz-border-radius: 60px;
  -ms-border-radius: 60px;
  -o-border-radius: 60px;
  border-radius: 60px;
} */

input.cmn-toggle-round + label {
  padding: 14px;
  width: 50px;
  height: 25px;
  background-color: #dddddd;
  -webkit-border-radius: 60px;
  -moz-border-radius: 60px;
  -ms-border-radius: 60px;
  -o-border-radius: 60px;
  border-radius: 60px;
}

input.cmn-toggle-round + label:before, input.cmn-toggle-round + label:after {
  display: block;
  position: absolute;
  top: 1px;
  left: 1px;
  bottom: 1px;
  content: "";
}
input.cmn-toggle-round + label:before {
  right: 1px;
  background-color: #f1f1f1;
  -webkit-border-radius: 60px;
  -moz-border-radius: 60px;
  -ms-border-radius: 60px;
  -o-border-radius: 60px;
  border-radius: 60px;
  -webkit-transition: background 0.2s;
  -moz-transition: background 0.2s;
  -o-transition: background 0.2s;
  transition: background 0.2s;
}
input.cmn-toggle-round + label:after {
  width: 28px;
  background-color: #fff;
  -webkit-border-radius: 100%;
  -moz-border-radius: 100%;
  -ms-border-radius: 100%;
  -o-border-radius: 100%;
  border-radius: 100%;
  -webkit-box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
  -moz-box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
  -webkit-transition: margin 0.2s;
  -moz-transition: margin 0.2s;
  -o-transition: margin 0.2s;
  transition: margin 0.2s;
}

input.cmn-toggle-round:checked + label:before {
  background-color: #27C139;
}
input.cmn-toggle-round:checked + label:after {
  margin-left: 20px;
}

/* ============================================================
  switch button
============================================================ */
</style>
<div class="panel panel-default table-responsive">
	<div class="panel-heading">contactus</div>
	<div class="padding-md clearfix">
		<table id="tbl" class="table table-striped" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th class="text-center">
						<label class="label-checkbox">
							<input id="chk" type="checkbox"><span class="custom-checkbox"></span>
						</label>
					</th>
					<th class="text-center">Name</th>
					<th class="text-center">Email</th>
					<th class="text-center">Phone</th>
					<th class="text-center">Date</th>
					<th class="text-center">User</th>
					<th class="text-center">Status</th>
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
	$("#tbl").data( "selected", [] );
	$("#tbl").DataTable({
		"processing": true,
		"serverSide": true,
		"ajax": "apps/contactus/store/store.php",
		"aoColumns": [
			{ "bSortable": false , "sWidth": "30px"},
			{"bSort" : true},
			{"bSort" : true},
			{"bSort" : true},
			{"bSortable": false},
			{"bSortable": false},
			{"bSortable": false},
			{"bSortable": false}
		],
		"order": [[ 1, "desc" ]],
		"createdRow": function ( row, data, index ) {
			var selected = false;
			var checked = "";
			if ( $.inArray(data.DT_RowId, $("#tbl").data( "selected")) !== -1 ) {
                $(row).addClass('selected');
				selected = true;
            }
			var s = '';
			s += fn.engine.datatable.checkbox('chk',data[0],selected);
			$('td', row).eq(0).html(s).addClass("text-center");
			
			 var a = '';
			if(data[6]==1){
				a+='<button class="btn btn-success"><i class="fa fa-file-text-o" aria-hidden="true"></i></button>';
			}else {
				a+='<button class="btn btn-warning"><i class="fa fa-envelope " aria-hidden="true"></i></button>'; 
			}
			$('td', row).eq(6).html(a); 
			
			s = '';
			s += fn.engine.datatable.button('btn-default','fa-pencil','fn.app.contactus.change('+data[0]+')');
			$('td', row).eq(7).html(s);
		}
	});
	fn.engine.datatable.add_selectable('tbl','chk');
	
});
</script>