
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
					<th class="text-center">Name</th>
					<th class="text-center">Group</th>
					<th class="text-center">Status</th>
					<th class="text-center">Created</th>
					<th class="text-center">Updated</th>
					<th class="text-center">Validated</th>
					<th class="text-center">Last Login</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
</div>

<script>
	$("#tblUser").data( "selected", [] );
	$("#tblUser").DataTable({
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
			{"bSortable": true},
			{"bSortable": false , "sWidth": "50px" }
		],
		"order": [[ 1, "desc" ]],
		"createdRow": function ( row, data, index ) {
			var checked = "";
			if ( $.inArray(data.DT_RowId, $("#tblUser").data( "selected")) !== -1 ) {
                $(row).addClass('selected');
                checked = " checked";
            }
			var s = '';
			
			s += '<label class="label-checkbox">';
				s += '<input type="checkbox" name="chk_user" class="chk_user" value="'+data[0]+'"'+checked+'>';
				s += '<span class="custom-checkbox"></span>';
			s += '</label>';
			$('td', row).eq(0).html(s).addClass("text-center");
			
			s = '';
			s += '<button type="button" class="btn btn-default btn-xs" onclick="fn.app.accctrl.user.edit('+data[0]+')"><span class="glyphicon glyphicon-pencil"></span> Change</button>';
			$('td', row).eq(8).html(s);
		}
	});

	
	$('#tblUser tbody').on('click', 'td:not(:last-child)', function () {
		var me = $(this).parent();
        var id = me[0].id;
        var index = $.inArray(id, $("#tblUser").data("selected"));
		
        if ( index === -1 ) {
            $("#tblUser").data( "selected").push( id );
            $(me).find('input[name=chk_user]').prop('checked', true);
        } else {
            $("#tblUser").data( "selected").splice( index, 1 );
            $(me).find('input[name=chk_user]').prop('checked', false);
        }
 
        $(me).toggleClass('selected');
    } );
	
    
    $('#chk_user').click(function(){

    	var AllChecked = true;
    	$("input[name=chk_user]").each(function(){
    		if(!$(this).is(':checked')){
    			AllChecked = false;
    		}
		});
		
		if(AllChecked){
			$('input[name=chk_user]').prop('checked', false).parent().parent().removeClass('selected');
			$("input[name=chk_user]").each(function(){
				var tr = $(this).parent().parent().parent();
				var id = tr[0].id;
		    	var index = $.inArray(id, $("#tblUser").data( "selected"));
		        if ( index != -1 ) {
		           $("#tblUser").data( "selected").splice( index, 1 );
					tr.removeClass("selected");
		        }
			});
		}else{
			$('input[name=chk_user]').prop('checked', true).parent().parent().addClass('selected');
			$("input[name=chk_user]").each(function(){
				var tr = $(this).parent().parent().parent();
				var id = tr[0].id;
		    	var index = $.inArray(id, $("#tblUser").data( "selected"));
		        if ( index === -1 ) {
		            $("#tblUser").data( "selected").push( id );
					tr.addClass("selected");
		        }
			});
		}
		
    });

</script>