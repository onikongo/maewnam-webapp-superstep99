<div class="panel panel-default table-responsive">
	<div class="panel-heading">Product Product</div>
	<div class="padding-md clearfix">
		<table id="tblProduct" class="table table-striped" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th class="text-center">
						<label class="label-checkbox">
							<input id="chk_product" type="checkbox"><span class="custom-checkbox"></span>
						</label>
					</th>
					<th class="text-center">Name</th>
                    <th class="text-center">Video</th>
					<th class="text-center">Action</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
</div>

<script>
	$("#tblProduct").data( "selected", [] );
	$("#tblProduct").DataTable({
		"processing": true,
		"serverSide": true,
		"ajax": "apps/video/store/store-article.php",
		"aoColumns": [
			{ "bSortable": false , "sWidth": "30px"},
			{"bSortable": true , "class":"text-center"},
			{"bSortable": true , "class":"text-center"},
			{"bSortable": false , "sWidth": "50px", "class":"text-center" }
		],
		"order": [[ 1, "desc" ]],
		"createdRow": function ( row, data, index ) {
			var checked = "";
			if ( $.inArray(data.DT_RowId, $("#tblProduct").data( "selected")) !== -1 ) {
                $(row).addClass('selected');
                checked = " checked";
            }
			var s = '';
			var d = '';
			
			s += '<label class="label-checkbox">';
				s += '<input type="checkbox" name="chk_product" class="chk_product" value="'+data[0]+'"'+checked+'>';
				s += '<span class="custom-checkbox"></span>';
			s += '</label>';
			$('td', row).eq(0).html(s).addClass("text-center");
			
			d += '<img  width="100%" height="200"  src="http://img.youtube.com/vi/'+data[2]+'/default.jpg"  frameborder="0" allowfullscreen>';
			$('td', row).eq(2).html(d);
			
			s = '';
			
						
			s += '<button title="Edit Product" type="button" class="btn btn-default btn-xs" onclick="fn.app.video.edit.edit_video('+data[0]+')"><i class="fa fa-pencil font20"></i></button>';
			if(data[6]==100)
			{
				s += ' <button title="Edit Product" type="button" class="btn btn-danger btn-xs" onclick="fn.app.video.edit.hightlight('+data[0]+')"><i class="fa fa-flag font20"></i></button>';
			}
			else
			{
				s += ' <button title="Edit Product" type="button" class="btn btn-default btn-xs" onclick="fn.app.video.edit.hightlight('+data[0]+')"><i class="fa fa-flag font20"></i></button>';
			}
			
			
			$('td', row).eq(5).html(s);
		}
	});

	
	$('#tblProduct tbody').on('click', 'td:not(:last-child)', function () {
		var me = $(this).parent();
        var id = me[0].id;
        var index = $.inArray(id, $("#tblProduct").data("selected"));
		
        if ( index === -1 ) {
            $("#tblProduct").data( "selected").push( id );
            $(me).find('input[name=chk_product]').prop('checked', true);
        } else {
            $("#tblProduct").data( "selected").splice( index, 1 );
            $(me).find('input[name=chk_product]').prop('checked', false);
        }
 
        $(me).toggleClass('selected');
    } );
	
    
    $('#chk_product').click(function(){

    	var AllChecked = true;
    	$("input[name=chk_product]").each(function(){
    		if(!$(this).is(':checked')){
    			AllChecked = false;
    		}
		});
		
		if(AllChecked){
			$('input[name=chk_product]').prop('checked', false).parent().parent().removeClass('selected');
			$("input[name=chk_product]").each(function(){
				var tr = $(this).parent().parent().parent();
				var id = tr[0].id;
		    	var index = $.inArray(id, $("#tblProduct").data( "selected"));
		        if ( index != -1 ) {
		           $("#tblProduct").data( "selected").splice( index, 1 );
					tr.removeClass("selected");
		        }
			});
		}else{
			$('input[name=chk_product]').prop('checked', true).parent().parent().addClass('selected');
			$("input[name=chk_product]").each(function(){
				var tr = $(this).parent().parent().parent();
				var id = tr[0].id;
		    	var index = $.inArray(id, $("#tblProduct").data( "selected"));
		        if ( index === -1 ) {
		            $("#tblProduct").data( "selected").push( id );
					tr.addClass("selected");
		        }
			});
		}
		
    });

</script>