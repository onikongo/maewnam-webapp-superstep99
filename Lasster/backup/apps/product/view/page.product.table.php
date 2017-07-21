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
					<th class="text-center">Type</th>
                    <th class="text-center">Price</th>
                    <th class="text-center">Discount</th>
                    <th class="text-center">Photo</th>
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
	$("#tblProduct").data( "selected", [] );
	$("#tblProduct").DataTable({
		"processing": true,
		"serverSide": true,
		"ajax": "apps/product/store/store-product.php",
		"aoColumns": [
			{ "bSortable": false , "sWidth": "30px"},
			{"bSortable": true , "class":"text-center"},
			{"bSortable": true , "class":"text-center"},
			{"bSortable": false   , "class":"text-center"},
			{"bSortable": false   , "class":"text-center"},
			{"bSortable": false   , "class":"text-center"},
			{"bSortable": false  , "class":"text-center"},
			{"bSortable": false , "sWidth": "100px", "class":"text-center" }
		],
		"order": [[ 1, "desc" ]],
		"createdRow": function ( row, data, index ) {
			var checked = "";
			if ( $.inArray(data.DT_RowId, $("#tblProduct").data( "selected")) !== -1 ) {
                $(row).addClass('selected');
                checked = " checked";
            }
			var s = '';
			
			s += '<label class="label-checkbox">';
				s += '<input type="checkbox" name="chk_product" class="chk_product" value="'+data[0]+'"'+checked+'>';
				s += '<span class="custom-checkbox"></span>';
			s += '</label>';
			$('td', row).eq(0).html(s).addClass("text-center");
			
			var i = '';
			i += '<img src="'+data[5]+'" width="100">';
			$('td', row).eq(5).html(i).addClass("text-center");
			
			s = '';
			s += '<button title="Edit Product" type="button" class="btn btn-default btn-xs" onclick="fn.app.product.edit.edit_product('+data[0]+')"><i class="fa fa-pencil font20"></i></span></button>';
			s += '&nbsp';	
			s += '<button title="Edit_Product_type" type="button" class="btn btn-default btn-xs" onclick="fn.app.product.edit.dialog_product_change_type('+data[0]+')"><i class="fa fa-bookmark font20"></i></span></button>';
			$('td', row).eq(7).html(s);
			
			var a = '';
			if(data[6]==1){
				a +='<div class="switch">';
				a +='<input id="cmn-toggle-'+data[0]+'" class="cmn-toggle cmn-toggle-round" checked type="checkbox" onClick="fn.app.product.edit.active('+data[0]+',this)">';
				a += '<label for="cmn-toggle-'+data[0]+'"></label>';
				a += '</div>'; 
				$('td', row).eq(6).html(a);
			} else {
				a +='<div class="switch">';
				a +='<input id="cmn-toggle-'+data[0]+'" class="cmn-toggle cmn-toggle-round" type="checkbox" onClick="fn.app.product.edit.active('+data[0]+',this)">';
				a += ' <label for="cmn-toggle-'+data[0]+'"></label>';
				a += '</div>';
				$('td', row).eq(6).html(a);
			}
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