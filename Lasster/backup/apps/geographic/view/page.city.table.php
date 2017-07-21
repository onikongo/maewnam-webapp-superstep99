<div class="panel panel-default table-responsive">
	<div class="panel-heading">City</div>
	<div class="padding-md clearfix">
		<table id="tblCity" class="table table-striped" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th class="text-center">
						<label class="label-checkbox">
							<input id="chk_city" type="checkbox"><span class="custom-checkbox"></span>
						</label>
					</th>
					<th class="text-center">ID</th>
					<th class="text-center">Code</th>
					<th class="text-center">Name</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
</div>

<script>
	$("#tblCity").data( "selected", [] );
	$("#tblCity").DataTable({
		"processing": true,
		"serverSide": true,
		"ajax": "apps/geographic/store/store-city.php",
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
			if ( $.inArray(data.DT_RowId, $("#tblCity").data( "selected")) !== -1 ) {
                $(row).addClass('selected');
                checked = " checked";
            }
			var s = '';
			
			s += '<label class="label-checkbox">';
				s += '<input type="checkbox" name="chk_city" class="chk_city" value="'+data[0]+'"'+checked+'>';
				s += '<span class="custom-checkbox"></span>';
			s += '</label>';
			$('td', row).eq(0).html(s).addClass("text-center");
			
			s = '';
			s += '<button title="Edit City" type="button" class="btn btn-default btn-xs" onclick="fn.app.geographic.city.change('+data[0]+')"><span class="glyphicon glyphicon-pencil"></span></button>';
			
			$('td', row).eq(4).html(s);
		}
	});

	
	$('#tblCity tbody').on('click', 'td:not(:last-child)', function () {
		var me = $(this).parent();
        var id = me[0].id;
        var index = $.inArray(id, $("#tblCity").data("selected"));
		
        if ( index === -1 ) {
            $("#tblCity").data( "selected").push( id );
            $(me).find('input[name=chk_city]').prop('checked', true);
        } else {
            $("#tblCity").data( "selected").splice( index, 1 );
            $(me).find('input[name=chk_city]').prop('checked', false);
        }
 
        $(me).toggleClass('selected');
    } );
	
    
    $('#chk_city').click(function(){

    	var AllChecked = true;
    	$("input[name=chk_city]").each(function(){
    		if(!$(this).is(':checked')){
    			AllChecked = false;
    		}
		});
		
		if(AllChecked){
			$('input[name=chk_city]').prop('checked', false).parent().parent().removeClass('selected');
			$("input[name=chk_city]").each(function(){
				var tr = $(this).parent().parent().parent();
				var id = tr[0].id;
		    	var index = $.inArray(id, $("#tblCity").data( "selected"));
		        if ( index != -1 ) {
		           $("#tblCity").data( "selected").splice( index, 1 );
					tr.removeClass("selected");
		        }
			});
		}else{
			$('input[name=chk_city]').prop('checked', true).parent().parent().addClass('selected');
			$("input[name=chk_city]").each(function(){
				var tr = $(this).parent().parent().parent();
				var id = tr[0].id;
		    	var index = $.inArray(id, $("#tblCity").data( "selected"));
		        if ( index === -1 ) {
		            $("#tblCity").data( "selected").push( id );
					tr.addClass("selected");
		        }
			});
		}
		
    });

</script>