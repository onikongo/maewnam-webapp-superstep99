<?php
	session_start();
	include_once "../../config/define.php";
	include_once "../../include/db.php";
	include_once "../../include/concurrent.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$sql = "SELECT * FROM messages WHERE to=$_SESSION[auth][user_id] ORDER BY id DESC";
	$rst = $dbc->Query($sql);
	while($msg = $dbc->Fetch($rst)){
		echo '<div class="list-group-item">';
			echo '<span class="thumb-sm pull-left mr clearfix">';
				echo '<img class="img-circle" src="demo/img/people/a3.jpg" alt="...">';
			echo '</span>';
			echo '<p class="no-margin overflow-hidden">';
			echo $msg['msg'];
			echo '<a href="#">Monica Smith</a>\'s account.';
			echo '<time class="help-block no-margin">';
			echo '2 mins ago';
			echo '</time>';
			echo '</p>';
		echo '</div>';

	}
	
	
	
	$dbc->Close();
?>