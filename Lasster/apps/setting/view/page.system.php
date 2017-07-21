<div class="row">
	<div class="col-md-6">
		<section class="widget">
			<header>
				<h5> <i class="fa fa-list-alt"></i> General </h5>
			</header>
			<div class="widget-body">
				<form id="form_general" class="form-horizontal form-label-left" role="form" onsubmit="fn.app.setting.system.save_general();return false;">
					<fieldset>
						<legend>Default Value</legend>
						<div class="form-group">
							<label class="col-sm-4 control-label">Default Language</label>
							<div class="col-sm-8">
								<select name="cbbDefaultLanguage" class="form-control">
									<?php
										if($dbc->HasRecord("variable","name='default_language'")){
											$line = $dbc->GetRecord("variable","value","name='default_language'");
											$value = $line[0];
										}else{
											$value = "en";
										}
									?>
									<option value="en"<?php if($value=="en")echo" selected";?>>English</option>
									<option value="th"<?php if($value=="th")echo" selected";?>>ภาษาไทย</option>
								</select>
							</div>
						</div>
						<legend>Time & Currency</legend>
						<div class="form-group">
							<label class="col-sm-4 control-label">Default Date Format</label>
							<div class="col-sm-8">
								<?php
									if($dbc->HasRecord("variable","name='default_date_format'")){
										$line = $dbc->GetRecord("variable","value","name='default_date_format'");
										$value = $line[0];
									}else{
										$value = "d/m/Y";
									}
								?>
								<input type="input" name="txtDefault_DateFormat" class="form-control" value="<?php echo $value;?>">
							</div>
						<div class="form-group">
						</div>
							<label class="col-sm-4 control-label">Default Time Format</label>
							<div class="col-sm-8">
								<?php
									if($dbc->HasRecord("variable","name='default_time_format'")){
										$line = $dbc->GetRecord("variable","value","name='default_time_format'");
										$value = $line[0];
									}else{
										$value = "H:i:s";
									}
								?>
								<input type="input" name="txtDefault_TimeFormat" class="form-control" value="<?php echo $value;?>">
							</div>
						<div class="form-group">
						</div>
							<label class="col-sm-4 control-label">Default DateTime Format</label>
							<div class="col-sm-8">
								<?php
									if($dbc->HasRecord("variable","name='default_datetime_format'")){
										$line = $dbc->GetRecord("variable","value","name='default_datetime_format'");
										$value = $line[0];
									}else{
										$value = "d/m/Y H:i:s";
									}
								?>
								<input type="input" name="txtDefault_DateTimeFormat" class="form-control" value="<?php echo $value;?>">
							</div>
						</div>
					</fieldset>
					<button class="btn btn-primary pull-right">Save</button>
				</form>
			</div>
		</section>
	</div>
	<div class="col-md-6">
		<section class="widget">
			<header>
				<h5> <i class="fa fa-list-alt"></i> Dialog </h5>
			</header>
			<div class="widget-body">
				<form class="form-horizontal form-label-left" role="form">
					<fieldset>
						<legend>Customer Dialog</legend>
						<div class="form-group">
							<label class="col-sm-4 control-label">Type</label>
							<div class="col-sm-8">
								<select name="cbbType" class="form-control">
									<option value="compact">Compact</option>
									<option value="general">General</option>
									<option value="full">Full</option>
								</select>
							</div>
						</div>
						<legend>Inventory Dialog</legend>
						<div class="form-group">
							<label class="col-sm-4 control-label">Type</label>
							<div class="col-sm-8">
								<select name="cbbType" class="form-control">
									<option value="compact">Compact</option>
									<option value="general">General</option>
									<option value="full">Full</option>
								</select>
							</div>
						</div>
					</fieldset>
				</form>
			</div>
		</section>
		
		
		<section class="widget">
			<header>
				<h5> <i class="fa fa-list-alt"></i> Documentation </h5>
			</header>
			<div class="widget-body">
				<form id="form_documentation" class="form-horizontal form-label-left" role="form" onsubmit="fn.app.setting.system.save_document();return false;">
					<fieldset>
						<legend>Numberic</legend>
						<div class="form-group">
							<label class="col-sm-4 control-label">Quotation Code</label>
							<div class="col-sm-8">
								<select name="cbbQuotationCode" class="form-control">
									<?php
										if($dbc->HasRecord("variable","name='sQuotation_code_type'")){
											$line = $dbc->GetRecord("variable","value","name='sQuotation_code_type'");
											$value = $line[0];
										}else{
											$value = "default";
										}
									?>
									<option value="default"<?php if($value=="default")echo" selected";?>>Default</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label">Order Code</label>
							<div class="col-sm-8">
								<select name="cbbOrderCode" class="form-control">
									<?php
										if($dbc->HasRecord("variable","name='sOrder_code_type'")){
											$line = $dbc->GetRecord("variable","value","name='sOrder_code_type'");
											$value = $line[0];
										}else{
											$value = "default";
										}
									?>
									<option value="default"<?php if($value=="default")echo" selected";?>>Default</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label">Invoice Code</label>
							<div class="col-sm-8">
								<select name="cbbInvoiceCode" class="form-control">
									<?php
										if($dbc->HasRecord("variable","name='sInvoice_code_type'")){
											$line = $dbc->GetRecord("variable","value","name='sInvoice_code_type'");
											$value = $line[0];
										}else{
											$value = "default";
										}
									?>
									<option value="default"<?php if($value=="default")echo" selected";?>>Default</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label">Receipt Code</label>
							<div class="col-sm-8">
								<select name="cbbReceiptCode" class="form-control">
									<?php
										if($dbc->HasRecord("variable","name='sReceipt_code_type'")){
											$line = $dbc->GetRecord("variable","value","name='sReceipt_code_type'");
											$value = $line[0];
										}else{
											$value = "default";
										}
									?>
									<option value="default"<?php if($value=="default")echo" selected";?>>Default</option>
								</select>
							</div>
						</div>
					</fieldset>
					<button class="btn btn-primary pull-right">Save</button>
				</form>
			</div>
		</section>
	</div>
</div>

