<?php
	session_start();
	ini_set('display_errors',1);
	include_once "../../../config/define.php";
	include_once "../../../include/db.php";
	include_once "../../../include/datastore.php";
	
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new datastore;
	$dbc->Connect();
	
	$columns = array(
		"id"		=> "subdistricts.id",
		"name"		=> "subdistricts.name",
		"district"	=> "districts.name",
		"city"		=> "cities.name",
		"country"	=> "countries.name"
	);
	
	$table = array(
		"index" => "id",
		"name" => "subdistricts",
		"join" => array(
			array(
				"field" => "district",
				"table" => "districts",
				"with" => "id"
			),
			array(
				"field" => "city",
				"table" => "cities",
				"with" => "id"
			),
			array(
				"field" => "country",
				"table" => "countries",
				"with" => "id"
			)
		)
	);
	
	$dbc->SetParam($table,$columns,$_GET['order'],$_GET['columns'],$_GET['search']);
	$dbc->SetLimit($_GET['length'],$_GET['start']);
	$dbc->Processing();
	echo json_encode($dbc->GetResult());
	
	$dbc->Close();

?>








