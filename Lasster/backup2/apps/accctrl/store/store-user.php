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
		"id" => "users.id",
		"username" => "users.name",
		"fullname" => "CONCAT(contacts.name,' ',contacts.surname)",
		"phone" => "contacts.phone",
		"mobile" => "contacts.mobile",
		"groupname" => "groups.name",
		"status" => "users.status",
		"last_login" => "IF(users.last_login IS NULL,'-',users.last_login)",
		"avatar" => "contacts.avatar",
		"email" => "contacts.email"
	);
	
	$table = array(
		"index" => "id",
		"name" => "users",
		"join" => array(
			array(
				"field" => "gid",
				"table" => "groups",
				"with" => "id"
			),
			array(
				"field" => "contact",
				"table" => "contacts",
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



