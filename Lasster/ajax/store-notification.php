<?php
	session_start();
	include_once "../config/define.php";
	include_once "../include/db.php";
	include_once "../include/concurrent.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	$sql = "SELECT * FROM notifications WHERE user=".$_SESSION['auth']['user_id'];
	$rst = $dbc->Query($sql);
	while($noti = $dbc->Fetch($rst)){
		echo '<a class="list-group-item" href="#">';
			echo '<span class="thumb-sm pull-left mr">';
			echo '<i class="glyphicon glyphicon-upload fa-lg"></i>';
			echo '</span>';
			echo '<p class="text-ellipsis no-margin">';
			echo $noti['topic'];
			echo '</p>';
			echo '<time class="help-block no-margin">';
				echo '5h ago';
			echo '</time>';
		echo '</a>';
	}
	$dbc->Close();
?>