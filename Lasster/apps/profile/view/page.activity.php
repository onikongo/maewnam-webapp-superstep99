<section class="activities">
	<h2>Activities</h2>
	<?php
		$sql = "SELECT * FROM logs WHERE log_user_type=0 AND log_user=".$user['id']." ORDER BY log_id DESC LIMIT 0,5";
		$rst = $dbc->Query($sql);
		while($log = $dbc->Fetch($rst)){
			echo '<section class="event">';
				echo '<span class="thumb-sm avatar pull-left mr-sm">';
					echo '<img class="img-circle" src="demo/img/people/a5.jpg" alt="...">';
				echo '</span>';
			echo '<h4 class="event-heading"><a href="#">'.$log['log_action'].'</a> <small><a href="#">'.$log['log_location'].'</a></small></h4>';
			echo '<p class="fs-sm text-muted">'.date("F d,Y \a\\t H:i:s",strtotime($log['log_datetime'])).'</p>';
			echo '<p class="fs-mini">';
				//echo $log['log_value'];
				echo '<br>';
			echo '</p>';
			echo '</section>';
		}
	?>
</section>