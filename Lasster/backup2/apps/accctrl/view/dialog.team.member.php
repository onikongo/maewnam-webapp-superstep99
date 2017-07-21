<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../include/db.php";
	include_once "../../menu.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$team = $dbc->GetRecord("sales_team","*","id=".$_REQUEST['id']);
	
?>
<div class="modal fade" id="dialog_team_member" data-backdrop="static">
  	<div class="modal-dialog">
		<form id="form_teammember" class="form-horizontal" role="form" onsubmit="fn.app.accctrl.team.save_member();return false;">
		<input type="hidden" name="team_id" value="<?php echo $team['id'];?>">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4>Edit Team Member</h4>
      		</div>
		    <div class="modal-body">
				<table class="table table-bordered table-condensed table-hover table-striped table-middle">
					<thead>
						<tr>
							<th class="text-center">Avatar</th>
							<th class="text-center">Member</th>
							<th class="text-center">Role</th>
							<th class="text-center">Action</th>
						</tr>
					<head>
					<tbody>
					<?php
						$sql = "SELECT * FROM sales_mapping WHERE team=".$team['id'];
						$rst = $dbc->Query($sql);
						while($map=$dbc->Fetch($rst)){
							$user = $dbc->GetRecord("users","id,name,contact","id=".$map['user']);
							$contact = $dbc->GetRecord("contacts","*","id=".$user['contact']);
							echo '<tr>';
								echo '<td class="text-center">';
									echo '<img src="'.($contact['avatar']==""?"img/default/user.png":$contact['avatar']).'" alt="" class="img-round" height="36">';
								echo '</td>';
								echo '<td>';
									echo '<input type="hidden" name="txtID[]" value="'.$map['id'].'">';
									echo '<input type="hidden" class="flagRemove" name="flagRemove[]" value="no">';
									echo '<input type="hidden" class="user_id" name="txtMember[]" value="'.$map['user'].'">';
									echo $user['name'];
								echo '</td>';
								echo '<td>';
									echo '<select name="cbbRole[]" class="form-control">';
										$sql = " SELECT * FROM sales_role";
										$rst_role = $dbc->Query($sql);
										while($role=$dbc->Fetch($rst_role)){
											echo '<option value="'.$role['id'].'"'.($map['role']==$role['id']?" selected":"").'>'.$role['role'].'</option>';
										}
										echo '';
									echo '</select>';
								echo '</td>';
								echo '<td class="text-center">';
									echo '<button type="button" class="btn btn-xs btn-danger" onclick="fn.app.accctrl.team.remove_member(this,'.$map['id'].')">';
									echo '<i class="fa fa-remove"></i>';
									echo '</button>';
								echo '</td>';
								
							echo '</tr>';
						}
					?>
					</tbody>
				</table>
		    </div>
			<div class="modal-footer">
				<button id="btnAddMember" type="button" class="btn btn-default pull-left">Add Member</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Save</button>
			</div>
	  	</div><!-- /.modal-content -->
		</form>
	</div><!-- /.modal-dialog -->
	<div id="data_sales_role_option" class="hidden">
	<?php
		$sql = " SELECT * FROM sales_role";
		$rst_role = $dbc->Query($sql);
		while($role=$dbc->Fetch($rst_role)){
			echo '<option value="'.$role['id'].'">'.$role['role'].'</option>';
		}
	?>
	<div>
</div><!-- /.modal -->
