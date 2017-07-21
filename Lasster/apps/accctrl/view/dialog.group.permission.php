<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../include/db.php";
	include_once "../../menu.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$group = $dbc->GetRecord("groups","*","id=".$_REQUEST['id']);
	
	$apps = array();
	foreach($aApplication as $menu){
		if(!in_array($menu['appname'],$apps)){
			array_push($apps,$menu['appname']);
		}
		if(isset($menu['submenu'])){
			foreach($menu['submenu'] as $submenu){
				if(!in_array($submenu['appname'],$apps)){
					array_push($apps,$submenu['appname']);
				}
			}
		}
	}
?>
<div class="modal fade" id="dialog_edit_group" data-backdrop="static">
  	<div class="modal-dialog">
		<form id="form_editgroup" class="form-horizontal" role="form" onsubmit="fn.app.accctrl.group.save_permission();return false;">
		<input type="hidden" name="txtID" value="<?php echo $group['id'];?>">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4>Edit Permission</h4>
      		</div>
		    <div class="modal-body">
				<table class="table table-bordered table-condensed table-hover table-striped">
					<thead>
						<tr>
							<th>Application</th>
							<th>View</th>
							<th>Add</th>
							<th>Edit</th>
							<th>Remove</th>
						</tr>
					<head>
					<tbody>
					<?php
					foreach($apps as $app){
						echo '<tr>';
							echo '<td>'.$app.'</td>';
							echo '<td>';
								echo '<label class="label-checkbox">';
									echo '<input name="permission['.$app.'][view]" type="checkbox"'.($dbc->hasRecord("permissions","name='$app' AND action='view' AND gid=".$group['id'])?" checked":"").'>';
									echo '<span class="custom-checkbox"></span>';
								echo '</label>';
							echo '</td>';
							echo '<td>';
								echo '<label class="label-checkbox">';
									echo '<input name="permission['.$app.'][add]" type="checkbox"'.($dbc->hasRecord("permissions","name='$app' AND action='add' AND gid=".$group['id'])?" checked":"").'>';
									echo '<span class="custom-checkbox"></span>';
								echo '</label>';
							echo '</td>';
							echo '<td>';
								echo '<label class="label-checkbox">';
									echo '<input name="permission['.$app.'][edit]" type="checkbox"'.($dbc->hasRecord("permissions","name='$app' AND action='edit' AND gid=".$group['id'])?" checked":"").'>';
									echo '<span class="custom-checkbox"></span>';
								echo '</label>';
							echo '</td>';
							echo '<td>';
								echo '<label class="label-checkbox">';
									echo '<input name="permission['.$app.'][delete]" type="checkbox"'.($dbc->hasRecord("permissions","name='$app' AND action='delete' AND gid=".$group['id'])?" checked":"").'>';
									echo '<span class="custom-checkbox"></span>';
								echo '</label>';
							echo '</td>';
						echo '</tr>';
					}
					?>
					</tbody>
				</table>
		    </div>
			<div class="modal-footer">
				<button id="btnSelectAll" type="button" class="btn btn-default pull-left">Select All</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Save</button>
			</div>
	  	</div><!-- /.modal-content -->
		</form>
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
