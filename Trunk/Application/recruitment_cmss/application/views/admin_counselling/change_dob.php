
		<div id="page-wrapper">
			<div class="row">
				<div class="col-lg-12 page-header">
					<h3>Change Registered DOB</h3>
				</div>
				<section class="content">
			<div class="row">
				<div class="col-lg-12" style="padding-top:0px;">
					<div class="panel panel-default">	
						<div class="panel-body">
							<div style="border-radius:0px;border: 0px inset;padding-left:20px;padding-right:20px;padding-top:0px;">
								<form class="form-horizontal" method="post" role="form" id="frmChangeProgram" name="frmChangeProgram">
									<input type="hidden" id="hidAction" name="hidAction"/>
									<div class="row">
										<div class="form-group">
											<div class="col-md-3">
												<label for="" class="control-label" style="text-align:left;">Program Group:</label>
											</div>
											<div class="col-md-4">
												<select class="form-control" name="cmbProgramGroup" id="cmbProgramGroup">
													<option value=''>Select Program Group</option>
												<?php 
												foreach($all_program_groups as $row)
												{
												?>		 
													<option value='<?=$row['program_group_name']?>'><?=$row['program_group_name']?></option>
										    <?php } ?>
												</select>
											</div>
											<div class="col-md-2"><span id="spanProcessingProgram" style="display: none"><img src="../images/bx_loader.gif" /></span></div>
										</div>
									</div><!-- end row -->
									<div class="row">
									<div class="form-group">
										<div class="col-md-3">
											<label for="" class="control-label" style="text-align:left;">Program:</label>
										</div>
										<div class="col-md-4">
											<select class="form-control" name="cmbProgram" id="cmbProgram">
											</select>
										</div>
									</div>
									</div><!-- end row -->
									<div class="row">
									<div class="form-group">
										<div class="col-md-3">
											<label for="" class="control-label" style="text-align:left;">Registered Mobile:</label>
										</div>
										<div class="col-md-4">
											<input type="text" id="txtRegUserId" name="txtRegUserId" class="form-control" maxlength="10"/>
										</div>
									</div>
									</div><!-- end row -->
									<div class="row">
									<div class="form-group">
										<div class="col-md-4">
											
										</div>
										<div class="col-md-3">
											<button class="btn btn-primary" value="Search" type="button" id="btnShow" name="btnShow">Search</button>
										</div>
									</div>
									</div><!-- end row -->
									<div class="row">
										<div class="col-md-2">
										</div>
										<div class="col-md-6">
										<table id="tblApplicantDetail" class="table table-bordered" hidden="hidden">
											<tr>
												<td>Applicant No</td>
												<td><span id="spanApplicantNo"></span></td>
											</tr>
											<tr>
												<td>Full Name</td>
												<td><span id="spanApplicantName"></span></td>
											</tr>
											<tr>
												<td>Date Of Birth</td>
												<td><span id="spanApplicantDob"></span></td>
											</tr>
										</table>
										</div>
									</div>
									<div id="divChangeProgram"  hidden="">
									<div class="row" >
									<div class="form-group">
										<div class="col-md-3">
											<label for="" class="control-label" style="text-align:left;">Change To:</label>
										</div>
										<div class="col-md-4">
											<input type="text" name="txtChangeRegUserId" id="txtChangeRegUserId" class="form-control" onkeypress="return isNumber(event);"/>
										</div>
									</div>
									</div>
									<div class="row">
									<div class="form-group">
										<div class="col-md-4">
											
										</div>
										<div class="col-md-3">
											<button class="btn btn-primary" value="Search" type="button" id="btnChange" name="btnChange">Change</button>
										</div>
									</div>
									</div><!-- end row -->
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
        </section><!-- /.content -->
	</div>
		</div>
				<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin/change_dob.js"></script>
    