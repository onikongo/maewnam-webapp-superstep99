<div class="panel panel-default table-responsive">
	<div class="panel-heading">Subdistrict</div>
	<div class="padding-md clearfix">
		<table id="tblSubdistrict" class="table table-striped" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th class="text-center">
						<label class="label-checkbox">
							<input id="chk_subdistrict" type="checkbox"><span class="custom-checkbox"></span>
						</label>
					</th>
					<th class="text-center">ID</th>
					<th class="text-center">Country</th>
					<th class="text-center">City</th>
					<th class="text-center">District</th>
					<th class="text-center">Subdistrict</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
</div>

<script>
	$("#tblSubdistrict").data( "selected", [] );
	$("#tblSubdistrict").DataTable({
		"processing": true,
		"serverSide": true,
		"ajax": "apps/geographic/store/store-subdistrict.php",
		"aoColumns": [
			{ "bSortable": false , "sWidth": "30px"},
			{"bSort" : true},
			{"bSortable": true},
			{"bSortable": true},
			{"bSortable": true},
			{"bSortable": true},
			{"bSortable": false , "sWidth": "50px" }
		],
		"order": [[ 1, "desc" ]],
		"createdRow": function ( row, data, index ) {
			var checked = "";
			if ( $.inArray(data.DT_RowId, $("#tblSubdistrict").data( "selected")) !== -1 ) {
                $(row).addClass('selected');
                checked = " checked";
            }
			var s = '';
			
			s += '<label class="label-checkbox">';
				s += '<input type="checkbox" name="chk_subdistrict" class="chk_subdistrict" value="'+data[0]+'"'+checked+'>';
				s += '<span class="custom-checkbox"></span>';
			s += '</label>';
			$('td', row).eq(0).html(s).addClass("text-center");
			
			s = '';
			s += '<button title="Edit Subdistrict" type="button" class="btn btn-default btn-xs" onclick="fn.app.geographic.subdistrict.change('+data[0]+')"><span class="glyphicon glyphicon-pencil"></span></button>';
			
			$('td', row).eq(6).html(s);
		}
	});

	
	$('#tblSubdistrict tbody').on('click', 'td:not(:last-child)', function () {
		var me = $(this).parent();
        var id = me[0].id;
        var index = $.inArray(id, $("#tblSubdistrict").data("selected"));
		
        if ( index === -1 ) {
            $("#tblSubdistrict").data( "selected").push( id );
            $(me).find('input[name=chk_subdistrict]').prop('checked', true);
        } else {
            $("#tblSubdistrict").data( "selected").splice( index, 1 );
            $(me).find('input[name=chk_subdistrict]').prop('checked', false);
        }
 
        $(me).toggleClass('selected');
    } );
	
    
    $('#chk_subdistrict').click(function(){

    	var AllChecked = true;
    	$("input[name=chk_subdistrict]").each(function(){
    		if(!$(this).is(':checked')){
    			AllChecked = false;
    		}
		});
		
		if(AllChecked){
			$('input[name=chk_subdistrict]').prop('checked', false).parent().parent().removeClass('selected');
			$("input[name=chk_subdistrict]").each(function(){
				var tr = $(this).parent().parent().parent();
				var id = tr[0].id;
		    	var index = $.inArray(id, $("#tblSubdistrict").data( "selected"));
		        if ( index != -1 ) {
		           $("#tblSubdistrict").data( "selected").splice( index, 1 );
					tr.removeClass("selected");
		        }
			});
		}else{
			$('input[name=chk_subdistrict]').prop('checked', true).parent().parent().addClass('selected');
			$("input[name=chk_subdistrict]").each(function(){
				var tr = $(this).parent().parent().parent();
				var id = tr[0].id;
		    	var index = $.inArray(id, $("#tblSubdistrict").data( "selected"));
		        if ( index === -1 ) {
		            $("#tblSubdistrict").data( "selected").push( id );
					tr.addClass("selected");
		        }
			});
		}
		
    });

</script>