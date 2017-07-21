<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();

?>
<table class="table table-striped" id="responsiveTable tbscheule">
            <thead>
                <tr>
                    <th>From</th>
                    <th>To</th>
                    <th>Seat</th>
                    <th>Week</th>
                    <th>Action</th>
                </tr>
            <thead>
            <tbody>
            <?php
			if(!isset($_REQUEST['id']))
			{
				$option = "where status = '99' and product = '0' ";
			}
			else
			{
				$option = "where product = '".$_REQUEST['id']."' ";
			}
			$sql_sched = $dbc->Query("select * from schedules ".$option." ");
			while($rows = $dbc->Fetch($sql_sched))
			{
				 echo '<tr>';
                    echo '<td>'.$rows['date_start'].'</td>';
                    echo '<td>'.$rows['date_end'].'</td>';
                    echo '<td>'.$rows['seat'].'</td>';
                    echo '<td>';
					$val = json_decode($rows['datas'],true);
					foreach($val as $datas)
					{
						echo '<div class="alert alert-info" role="alert">';
						$week = array('All day','Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
						$weekT = array('All','Sun','Mon','Tue','Wed','Thu','Fri','Sat');
						//echo 'Day : '.$week[$datas['week']].'<br>';
						echo '<span class="btext">Time : '.$datas['start_time'].'</span>';
						echo '<span class="btext"> -  '.$datas['end_time'].'</span>';
						echo '<button class="rtext pull-right">'.$weekT[$datas['week']].'</button>';
						echo '</div>';
					}
					echo '</td>';
                    echo '<td><button type="button" class="btn btn-danger" onClick="delsched('.$rows['id'].')"><i class="fa fa-minus" aria-hidden="true" ></i></button></td>';
               echo ' </tr>';
			}
			?>
               
            </tbody>
            
        </table>
        <?php	
	$dbc->Close();

?>





