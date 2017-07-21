<?php
	//$variable = $dbc->GetRecord("variable","*","name='aCompany_info'");
	//$company = json_decode(base64_decode($variable['value']),true);
	
	
	$company = json_decode($abox->load_variable('aCompany_info',"json"),true);
	
	function create_editable_text($caption,$field,$variable,$value,$title){
		echo '<tr>';
			echo '<td>'.$caption.'</td>';
			echo '<td>';
				echo '<a class="editable" data-name="'.$field.'" data-type="text" data-pk="'.$variable.'" data-title="'.$title.'">'.$value.'</a>';
			echo '</td>';
		echo '</tr>';
	}
	
	function aGet($array,$variable){
		if(isset($array[$variable])){
			return base64_decode($array[$variable]);
		}else{
			return "";
		}
	}
	
?>
<div class="widget-body-toolbar">
	<div class="row">
		<div class="col-sm-6">
			<button id="enable" class="btn btn btn-default">
				แก้ไข
			</button>
		</div>
		<div class="col-sm-6 text-right">			
						
		</div>					
	</div>
</div>
<table class="table table-bordered table-striped table-editable" style="clear: both">
	<thead>
		<tr>
			<th class="text-center" width="35%">Attribute</th>
			<th class="text-center" width="65%">Value</th>
		</tr>
	</head>
	<tbody>
	<?php
		create_editable_text("ชื่อองค์กรหรือบริษัท",	"org_name",	"aCompany_info",aGet($company,'org_name'),	"Enter Organization or Company Name");
		create_editable_text("หมายเลขผู้เสียภาษี",	"org_tax",	"aCompany_info",aGet($company,'org_tax'),	"Enter Tax");
		create_editable_text("เบอร์โทรศัพท์",		"phone",	"aCompany_info",aGet($company,'phone'),		"Enter Phone");
		create_editable_text("เบอร์แฟกซ์",		"fax",		"aCompany_info",aGet($company,'fax'),		"Enter Fax");
		create_editable_text("อีเมลล์",			"email",	"aCompany_info",aGet($company,'email'),		"Enter Email");
		create_editable_text("เว็บไซต์",			"website",	"aCompany_info",aGet($company,'website'),	"Enter Website");
		create_editable_text("สาขา",			"branch",	"aCompany_info",aGet($company,'branch'),	"Enter Branch");
		create_editable_text("ที่อยู่",			"address",	"aCompany_info",aGet($company,'address'),	"Enter Address");
	?>
	</tbody>
</table>
