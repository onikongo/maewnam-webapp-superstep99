<div class="panel panel-default inbox-panel">
	<div class="panel-heading">
		<div class="input-group">
			<input type="text" class="form-control input-sm" placeholder="Search here...">
				<span class="input-group-btn">
				<button class="btn btn-default btn-sm" type="button"><i class="fa fa-search"></i></button>
			</span>
		</div><!-- /input-group -->
	</div>
	<div class="panel-body">
		<a id="btnAnouncement" class="btn btn-sm btn-danger"><i class="fa fa-plus"></i> Anouncement</a>
		<div class="pull-right">
			<a class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-refresh"></i></a>			
			
		</div>
	</div>
	<ul class="list-group">
	<?php
		$sql="SELECT * FROM notifications WHERE user=".$user['id'];
		$rst = $dbc->query($sql);
		while($noti = $dbc->Fetch($rst)){
			$href= '?app=profile&view=notification&action=read&notification='.$noti['id'];
			echo '<a href="'.$href.'">';
			$read = $noti['acknowledge']==""?"":" selected";
			echo '<li class="list-group-item clearfix inbox-item'.$read.'">';
			
				echo '<span class="from">'.$noti['type'].'</span>';
				/*echo '<span class="starred">';
					
				echo '</span>';
				*/
				echo '<span class="detail">';
				echo $noti['topic'];
				echo '</span>';
				echo '<span class="inline-block pull-right">';
					echo '<span class="time">'.$noti['created'].'</span>	';
				echo '</span>';
			echo '</li>';
			echo '</a>';
		}
	
	?>
	</ul><!-- /list-group -->
	<div class="panel-footer clearfix">
		<div class="pull-left">112 messages</div>
		<div class="pull-right">
			<span class="middle">Page 1 of 8 </span>
			<ul class="pagination middle">
				<li class="disabled"><a href="#"><i class="fa fa-step-backward"></i></a></li>
				<li class="disabled"><a href="#"><i class="fa fa-caret-left large"></i></a></li>
				<li><a href="#"><i class="fa fa-caret-right large"></i></a></li>
				<li><a href="#"><i class="fa fa-step-forward"></i></a></li>
			</ul>
		</div>
	</div>
</div><!-- /panel -->