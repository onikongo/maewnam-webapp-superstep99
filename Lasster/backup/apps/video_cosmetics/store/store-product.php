<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();


	$aColumns = array('p.id','SUBSTRING_INDEX(p.name,"|",1)','SUBSTRING_INDEX(s.name,"|",1)','SUBSTRING_INDEX(b.name,"|",1)','u.name','p.status','p.id');
	$sIndexColumn = "p.id";
	
	$sTable = "products AS p INNER JOIN suppliers AS s ON p.supplier = s.id
	INNER JOIN branchs AS b ON p.branch = b.id
	INNER JOIN users AS u ON p.user = u.id
	";
	
	/*$aColumns = array('p.id','SUBSTRING_INDEX(p.name,"|",1)','s.name','b.name','c.user','p.status','p.id');
	$sIndexColumn = "p.id";
	
	$sTable = "products AS p 
	INNER JOIN suppliers AS s ON p.supplier = s.id
	INNER JOIN branchs AS b ON p.branch = b.id
	INNER JOIN users AS u ON p.user = u.id
	INNER JOIN contacts AS c ON u.contact = c.id
	";*/
	$sLimit = "";
	
	if ( isset( $_REQUEST['start'] ) && $_REQUEST['length'] != '-1' ){
		$sLimit = "LIMIT ".$dbc->Escape_String( $_REQUEST['start'] ).", ".
		$dbc->Escape_String( $_REQUEST['length'] );
	}

	if ( isset( $_REQUEST['order'] ) ){
		$sOrder = "ORDER BY  ";
		for ( $i=0 ; $i<count( $_REQUEST['order'] ) ; $i++ ){
			if($_REQUEST['columns'][intval($_REQUEST['order'][$i]['column'])]['orderable']=="true"){
				
				$sOrder .= $aColumns[ intval( $_REQUEST['order'][$i]['column'] ) ]."
				 	".$dbc->Escape_String( $_REQUEST['order'][$i]['dir'] ) .", ";
			}
		}
		
		$sOrder = substr_replace( $sOrder, "", -2 );
		if ( $sOrder == "ORDER BY" ){
			$sOrder = "";
		}
	}
	

	$sWhere = "";
	if ( $_REQUEST['search']['value'] != "" ){
		$sWhere = "WHERE (";
		for ( $i=0 ; $i<count($aColumns) ; $i++ ){
			$sWhere .= $aColumns[$i]." LIKE '%".$dbc->Escape_String( $_REQUEST['search']['value'] )."%' OR ";
		}
		$sWhere = substr_replace( $sWhere, "", -3 );
		$sWhere .= ')';
	}
	
	
	if ( isset($_REQUEST['filter'])){
		if ( $sWhere == "" ){
			$sWhere = "WHERE ";
		}else{
			$sWhere .= " AND ";
		}
		$sWhere .= $_REQUEST['filter']." ";
	}
	
	$sQuery = "
		SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns))."
		FROM   $sTable
		$sWhere
		$sOrder
		$sLimit
	";
	
	$rResult = $dbc->Query($sQuery) or die(mysql_error());
	
	/* Data set length after filtering */
	$sQuery = "
		SELECT FOUND_ROWS()
	";
	$rResultFilterTotal = $dbc->Query( $sQuery) or die(mysql_error());
	$aResultFilterTotal = $dbc->Fetch($rResultFilterTotal);
	$iFilteredTotal = $aResultFilterTotal[0];
	
	/* Total data set length */
	$sQuery = "
		SELECT COUNT(".$sIndexColumn.")
		FROM   $sTable
	";
	$rResultTotal = $dbc->Query( $sQuery)  or die(mysql_error());
	$aResultTotal = $dbc->Fetch($rResultTotal);
	$iTotal = $aResultTotal[0];
	
	
	/*
	 * Output
	 */
	$output = array(
		"iTotalRecords" => $iTotal,
		"iTotalDisplayRecords" => $iFilteredTotal,
		"aaData" => array()
	);
	
	while ( $aRow = $dbc->Fetch( $rResult ) ){
		$row = array();
		for ( $i=0 ; $i<count($aColumns) ; $i++ ){
			$row[] = $aRow[$i];
			if($i==0)$row["DT_RowId"] = $aRow[$i];
			
		}
		$output['aaData'][] = $row;
	}
	
	echo json_encode( $output );
	
	$dbc->Close();

?>





