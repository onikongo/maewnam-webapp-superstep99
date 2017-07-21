<?php	
	$noti = $dbc->GetRecord("notifications","*","id=".$_REQUEST['notification']);
	if($noti['acknowledge']==""){
		$dbc->Update("notifications",array("#acknowledge"=>"NOW()"),"id=".$noti['id']);
		$noti = $dbc->GetRecord("notifications","*","id=".$_REQUEST['notification']);
	}
?>

<a href="?app=profile&view=notification" class="btn btn-sm btn-danger"><i class="fa fa-plus"></i> Back</a>
<br>
<div class="panel panel-default inbox-panel">
	<div class="panel-heading">
		<?php echo $noti['topic']; ?>
	</div>
	<div class="panel-body">
		
		<p>
		<?php echo $noti['detail']; ?>
		</p>
	</div>
	
	<div class="panel-footer clearfix">
		<div class="pull-left">Created :<?php echo $noti['created']; ?></div>
		
	</div>
</div><!-- /panel -->