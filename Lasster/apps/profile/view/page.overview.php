<div class="well well-sm">
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-6">
			<div class="well well-light well-sm no-margin no-padding">
				<div class="row">
					<div class="col-sm-12">
						<div id="myCarousel" class="carousel fade profile-carousel">
							<div class="air air-bottom-right padding-10">
								<a href="javascript:void(0);" onclick="fn.app.profile.dialog_photo()" class="btn btn-default">Change</a>
								<a href="javascript:void(0);" onclick="fn.app.profile.dialog_edit()" class="btn txt-color-white bg-color-orange btn-sm"><i class="fa fa-pencil"></i> Edit</a>
								<a href="javascript:void(0);" onclick="fn.app.profile.dialog_setmail()" class="btn txt-color-white bg-color-blueDark btn-sm"><i class="glyphicon glyphicon-envelope"></i> Email</a>
								<a href="javascript:void(0);" onclick="fn.app.profile.dialog_setqoute()" class="btn txt-color-white bg-color-greenDark btn-sm"><i class="fa fa-comment"></i> Qoute</a>
							</div>
							<div class="air air-top-left padding-10">
								<h4 class="txt-color-white font-md"><?php echo date("d F,Y");?></h4>
							</div>
							<ol class="carousel-indicators">
								<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
								<li data-target="#myCarousel" data-slide-to="1" class=""></li>
								<li data-target="#myCarousel" data-slide-to="2" class=""></li>
							</ol>
							<div class="carousel-inner">
								<div class="item active">
									<img src="img/default/bg/101.jpg" alt="">
								</div>
								<div class="item">
									<img src="img/default/bg/102.jpg" alt="">
								</div>
								<div class="item">
									<img src="img/default/bg/103.jpg" alt="">
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-12">
						<div class="row">
							<div class="col-sm-3 profile-pic">
								<img src="<?php echo $abox->auth['avatar'];?>">
								
								<div class="padding-10">
									<h4 class="font-md"><strong>1,543</strong>
									<br>
									<small>Followers</small></h4>
									<br>
									<h4 class="font-md"><strong>419</strong>
									<br>
									<small>Connections</small></h4>
								</div>
							</div>
							<div class="col-sm-6">
								<h1><?php echo $abox->auth['name'];?> <span class="semi-bold"><?php echo $abox->auth['surname'];?></span>
								<br>
								<small> <?php echo $abox->auth['group'];?></small></h1>
								<ul class="list-unstyled">
								<?php
									if($abox->auth['phone']!=""){
										echo '<li>';
											echo '<p class="text-muted">';
												echo '<i class="fa fa-phone"></i>&nbsp;&nbsp;';
												echo $abox->auth['phone'];
											echo '</p>';
										echo '</li>';
									}
									if($abox->auth['mobile']!=""){
										echo '<li>';
											echo '<p class="text-muted">';
												echo '<i class="fa fa-phone"></i>&nbsp;&nbsp;';
												echo $abox->auth['mobile'];
											echo '</p>';
										echo '</li>';
									}
									if($abox->auth['email']!=""){
										echo '<li>';
											echo '<p class="text-muted">';
												echo '<i class="fa fa-envelope"></i>&nbsp;&nbsp;';
												echo '<a href="mailto:'.$abox->auth['email'].'">'.$abox->auth['email'].'</a>';
											echo '</p>';
										echo '</li>';
									}
									if($abox->auth['skype']!=""){
										echo '<li>';
											echo '<p class="text-muted">';
												echo '<i class="fa fa-skype"></i>&nbsp;&nbsp;';
												echo '<span class="txt-color-darken">'.$abox->auth['skype'].'</span>';
											echo '</p>';
										echo '</li>';
									}
								?>
								</ul>
								<br>
								<?php
									if(isset($abox->auth['setting']['qoute'])){
										$qoute = $abox->auth['setting']['qoute'];
									}else{
										$qoute = array(
											"title" => base64_encode("-"),
											"detail" => base64_encode("-") 
										);
									}
								
								?>
								<p class="font-md"><i><?php echo base64_decode($qoute['title']);?></i></p>
								<p><?php echo base64_decode($qoute['detail']);?></p>
								<br>
								<a href="javascript:void(0);" class="btn btn-default btn-xs"><i class="fa fa-envelope-o"></i> Send Message</a>
								<br>
								<br>
							</div>
							<div class="col-sm-3">
								<h1><small>Your Group</small></h1>
								<ul class="list-inline friends-list">
								<?php
									$sql = "SELECT
										contacts.avatar AS avatar,
										users.name AS name
									FROM users
									LEFT JOIN contacts ON users.contact = contacts.id
									WHERE users.gid=".$abox->auth['gid']." AND users.id != ".$abox->auth['id'];
									$rst = $dbc->Query($sql);
									while($people = $dbc->Fetch($rst)){
										if($people['avatar']==""){
											$avatar = "img/default/user.png";
										}else{
											$avatar = $people['avatar'];
										}
										echo '<li><img src="'.$avatar.'" title="'.$people['name'].'"></li>';
									}
								?>
									
									
								</ul>

								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
		
		
		function LoadSetting($setting){
			global $abox;
			$value = null;
			if(isset($abox->auth['setting'][$setting])){
				$value = $abox->auth['setting'][$setting];
			}else{
				switch($setting){
					case "datetime":
						$value = array(
							"timezone" 	=> DEFAULT_TIMEZONE,
							"sdate" 	=> "d/m/Y",
							"ldate" 	=> "F d,Y",
							"stime" 	=> "H:i",
							"ltime" 	=> "H:i:s",
							"firstday"	=> 0
						);
						break;
					default:
						$value = "";
						break;
				}
			}
			return $value;
		}
		
		
		?>
		<div class="col-sm-12 col-md-12 col-lg-6">
			<form id="form_setting" class="form-horizontal" role="form" onsubmit="fn.app.profile.save_setting();return false;">
				<div class="modal-header">
					<h4>Personal Setting</h4>
				</div>
				<div class="modal-body">
					<?php $datetime = LoadSetting("datetime");?>
					<div class="form-group">
						<label class="col-sm-2 control-label">Timezone</label>
						<div class="col-sm-10">
							<select class="form-control" name="setting[datetime][timezone]">
							<?php
								$timezones = DateTimeZone::listIdentifiers();
								
								foreach( $timezones as $timezone ){
									$selected = $timezone == $datetime['timezone'] ? " selected" : "";
									echo '<option value="'.$timezone.'"'.$selected.'>'.$timezone.'</option>';
								}
							
							?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Long Date</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="setting[datetime][ldate]" value="<?php echo $datetime['ldate'];?>">
						</div>
						<label class="col-sm-3 control-label">Long Time</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="setting[datetime][ltime]" value="<?php echo $datetime['ltime'];?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Short Date</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="setting[datetime][sdate]" value="<?php echo $datetime['sdate'];?>">
						</div>
						<label class="col-sm-3 control-label">Short Time</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="setting[datetime][stime]" value="<?php echo $datetime['stime'];?>">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="reset" class="btn btn-warning">Reset</button>
					<button type="submit" class="btn btn-primary">Save</button>
				</div>
			</form>
		</div>
	</div>
</div>