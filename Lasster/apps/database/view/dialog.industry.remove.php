<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../include/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$removable = true;
	$items = isset($_REQUEST['item'])?$_REQUEST['item']:array();
	
	if(count($items)==0){
		$removable = false;
	}
?>
<div class="modal fade" id="dialog_remove_industry" data-backdrop="static">
  	<div class="modal-dialog">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4>Are you sure to remove the following?</h4>
      		</div>
		    <div class="modal-body">
				<p class="lblOutput">
				
				<?php
					if($removable){
						echo '<ul>';
						foreach($items as $item){
							$industry = $dbc->GetRecord("industries","*","id=".$item);
							echo '<li>'.$industry['id'].' : '.$industry['name'].'</li>';
						}
						echo '</ul>';
					}else{
						echo 'Please selecte item to remove!';
					}
				?>
				
				</p>
		    </div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<?php
					if($removable)echo '<button type="submit" class="btn btn-danger btnConfirm">Remove</button>';
				?>
				
			</div>
	  	</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php
	$dbc->Close();
?>