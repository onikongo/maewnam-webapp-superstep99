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
					<th class="text-center">Roles</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
</div>

<script>
	$("#tblGroup").data( "selected", [] );
	$("#tblGroup").DataTable({
		"processing": true,
		"serverSide": true,
		"ajax": "apps/accctrl/store/store-group.php",
		"aoColumns": [
			{ "bSortable": false , "sWidth": "30px"},
			{"bSort" : true},
			{"bSortable": true},
			{"bSortable": true},
			{"bSortable": true},
			{"bSortable": false , "sWidth": "50px" }
		],
		"order": [[ 1, "desc" ]],
		"createdRow": function ( row, data, index ) {
			var checked = "";
			if ( $.inArray(data.DT_RowId, $("#tblGroup").data( "selected")) !== -1 ) {
                $(row).addClass('selected');
                checked = " checked";
            }
			var s = '';
			
			s += '<label class="label-checkbox">';
				s += '<input type="checkbox" name="chk_group" class="chk_group" value="'+data[0]+'"'+checked+'>';
				s += '<span class="custom-checkbox"></span>';
			s += '</label>';
			$('td', row).eq(0).html(s).addClass("text-center");
			
			s = '';
			s += '<button type="button" class="btn btn-default btn-xs" onclick="fn.app.accctrl.group.edit('+data[0]+')"><span class="glyphicon glyphicon-pencil"></span> Change</button>';
			$('td', row).eq(5).html(s);
		}
	});

	
	$('#tblGroup tbody').on('click', 'td:not(:last-child)', function () {
		var me = $(this).parent();
        var id = me[0].id;
        var index = $.inArray(id, $("#tblGroup").data("selected"));
		
        if ( index === -1 ) {
            $("#tblGroup").data( "selected").push( id );
            $(me).find('input[name=chk_group]').prop('checked', true);
        } else {
            $("#tblGroup").data( "selected").splice( index, 1 );
            $(me).find('input[name=chk_group]').prop('checked', false);
        }
 
        $(me).toggleClass('selected');
    } );
	
    
    $('#chk_group').click(function(){

    	var AllChecked = true;
    	$("input[name=chk_group]").each(function(){
    		if(!$(this).is(':checked')){
    			AllChecked = false;
    		}
		});
		
		if(AllChecked){
			$('input[name=chk_group]').prop('checked', false).parent().parent().removeClass('selected');
			$("input[name=chk_group]").each(function(){
				var tr = $(this).parent().parent().parent();
				var id = tr[0].id;
		    	var index = $.inArray(id, $("#tblGroup").data( "selected"));
		        if ( index != -1 ) {
		           $("#tblGroup").data( "selected").splice( index, 1 );
					tr.removeClass("selected");
		        }
			});
		}else{
			$('input[name=chk_group]').prop('checked', true).parent().parent().addClass('selected');
			$("input[name=chk_group]").each(function(){
				var tr = $(this).parent().parent().parent();
				var id = tr[0].id;
		    	var index = $.inArray(id, $("#tblGroup").data( "selected"));
		        if ( index === -1 ) {
		            $("#tblGroup").data( "selected").push( id );
					tr.addClass("selected");
		        }
			});
		}
		
    });

</script>