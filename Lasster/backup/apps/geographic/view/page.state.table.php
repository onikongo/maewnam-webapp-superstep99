<div class="panel panel-default table-responsive">
	<div class="panel-heading">State</div>
	<div class="padding-md clearfix">
		<table id="tblState" class="table table-striped" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th class="text-center">
						<label class="label-checkbox">
							<input id="chk_state" type="checkbox"><span class="custom-checkbox"></span>
						</label>
					</th>
					<th class="text-center">ID</th>
					<th class="text-center">Name</th>
					<th class="text-center">Country</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
</div>

<script>
	$("#tblState").data( "selected", [] );
	$("#tblState").DataTable({
		"processing": true,
		"serverSide": true,
		"ajax": "apps/geographic/store/store-state.php",
		"aoColumns": [
			{ "bSortable": false , "sWidth": "30px"},
			{"bSort" : true},
			{"bSortable": true},
			{"bSortable": true},
			{"bSortable": false , "sWidth": "50px" }
		],
		"order": [[ 1, "desc" ]],
		"createdRow": function ( row, data, index ) {
			var checked = "";
			if ( $.inArray(data.DT_RowId, $("#tblState").data( "selected")) !== -1 ) {
                $(row).addClass('selected');
                checked = " checked";
            }
			var s = '';
			
			s += '<label class="label-checkbox">';
				s += '<input type="checkbox" name="chk_state" class="chk_state" value="'+data[0]+'"'+checked+'>';
				s += '<span class="custom-checkbox"></span>';
			s += '</label>';
			$('td', row).eq(0).html(s).addClass("text-center");
			
			s = '';
			s += '<button title="Edit State" type="button" class="btn btn-default btn-xs" onclick="fn.app.geographic.state.edit('+data[0]+')"><span class="glyphicon glyphicon-pencil"></span></button>';
			
			$('td', row).eq(4).html(s);
		}
	});

	
	$('#tblState tbody').on('click', 'td:not(:last-child)', function () {
		var me = $(this).parent();
        var id = me[0].id;
        var index = $.inArray(id, $("#tblState").data("selected"));
		
        if ( index === -1 ) {
            $("#tblState").data( "selected").push( id );
            $(me).find('input[name=chk_state]').prop('checked', true);
        } else {
            $("#tblState").data( "selected").splice( index, 1 );
            $(me).find('input[name=chk_state]').prop('checked', false);
        }
 
        $(me).toggleClass('selected');
    } );
	
    
    $('#chk_state').click(function(){

    	var AllChecked = true;
    	$("input[name=chk_state]").each(function(){
    		if(!$(this).is(':checked')){
    			AllChecked = false;
    		}
		});
		
		if(AllChecked){
			$('input[name=chk_state]').prop('checked', false).parent().parent().removeClass('selected');
			$("input[name=chk_state]").each(function(){
				var tr = $(this).parent().parent().parent();
				var id = tr[0].id;
		    	var index = $.inArray(id, $("#tblState").data( "selected"));
		        if ( index != -1 ) {
		           $("#tblState").data( "selected").splice( index, 1 );
					tr.removeClass("selected");
		        }
			});
		}else{
			$('input[name=chk_state]').prop('checked', true).parent().parent().addClass('selected');
			$("input[name=chk_state]").each(function(){
				var tr = $(this).parent().parent().parent();
				var id = tr[0].id;
		    	var index = $.inArray(id, $("#tblState").data( "selected"));
		        if ( index === -1 ) {
		            $("#tblState").data( "selected").push( id );
					tr.addClass("selected");
		        }
			});
		}
		
    });

</script>