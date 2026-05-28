<div id="page-wrapper">
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Manage Application</h1>
        </div>
    	<!-- /.col-lg-12 -->
	</div>

    <!-- Main content -->
    <section class="content">
		<div class="row">
			<div class="col-lg-12" style="padding-top:0px;">
				<div class="panel panel-default">	
					<div class="panel-body">
						<div style="border-radius:0px;border: 0px inset;padding-left:20px;padding-right:20px;padding-top:0px;">
							<form class="form-horizontal" method="post" role="form" id="frmApplyNew" name="frmApplyNew">
								<input type="hidden" name="hidProgram" id="hidProgram" value=""/>
								<div class="form-group">
									<!--<label for="" class="control-label col-sm-2" style="text-align:left;">Program Type:</label>-->
									<div class="col-sm-2" style="display: none;">
										<label class="radio-inline">
												<input type="radio" name="radioProgramType" id="radioCurrent" value="Current" checked="checked"> Current
											</label>
											<label class="radio-inline">
												<input type="radio" name="radioProgramType" id="radioOld" value="Old"> Old
											</label>
									</div>
									<label for="" class="control-label col-sm-2 col-sm-offset-1">Program Group:</label>
									<div class="col-sm-3">
										<select class="form-control" name="cmbProgramGroup" id="cmbProgramGroup">
										</select>
									</div>
									
									<label for="" class="control-label col-sm-2" style="text-align:left;">Program:</label>
									<div class="col-sm-4">
										<select class="form-control" name="cmbProgram" id="cmbProgram">
											<option value=''>Select Program</option>
										</select>
									</div>
									
								</div>
								<!--<div class="form-group">
									
									
									<div class="col-sm-2" style="margin-left: 32%">
										<a href="apply-1.php" target="_blank" class="btn btn-primary tooltips" title="Add New Applicant" ><i class="fa fa-plus"></i> New Application</i></a>
									</div
								</div>>-->
							<!--</form>
							<form class="form-horizontal" method="post" role="form" id="frmSearch" name="frmSearch">-->
								<div class="panel panel-default">
									 <div class="panel-body">
									    <div class="form-group">
											<label for="" class="control-label col-sm-2" style="text-align:left;">Status:</label>
											<div class="col-sm-3">
												<select class="form-control" name="cmbStatus" id="cmbStatus">
													<option value=''>Select Status</option>
													<option value='Student_Details_Submitted'>Student Details Submitted</option>
													<option value='Document_Uploaded'>Document Uploaded</option>
													<!--<option value='Challan_Generated'>Challan Generated</option>
													<option value='Fee_Paid'>Fee Paid</option>-->
													<option value='Verified'>Verified</option>
												</select>
											</div>
											<label for="" class="control-label col-sm-2">Mobile No:</label>
											<div class="col-sm-3" >
												<input type="text" class="form-control" id="txtMobileNo" name="txtMobileNo" placeholder="Enter Mobile No" value="">
											</div>
											<div class="col-sm-1" >
												<button type="button" class="btn btn-info tooltips" name="btnFilter" id="btnFilter" title="Filter Application"><i class="fa fa-filter"></i> &nbsp;Filter</button>
											</div>
										</div>
									<!--	<div class="form-group">										
											
											<label for="" class="control-label col-sm-2" style="text-align:left;">Payment Mode:</label>
											<div class="col-sm-3">
												<select class="form-control" name="cmbPayment" id="cmbPayment">
													<option value=''>Select Payment Mode</option>
													<option value='ONLINE'>ONLINE</option>
													<option value='CHALLAN'>CHALLAN</option>
													<option value='ON_THE_COUNTER'>ON THE COUNTER</option>
												</select>
											</div>
											<label for="" class="control-label col-sm-2">Payment Date:</label>
											<div class="col-sm-3" >
												<input type="text" class="form-control" id="txtPaymentDate" name="txtPaymentDate" placeholder="Enter Payment Date" value="" readonly="">
											</div>
											
										</div>-->
									</div>
								</div>
								
								
							</form>
							
							<table class="table table-striped table-bordered " id="dtblApplicationDetail">
								<thead>
									<tr>
										<th class="text-center">#</th>
										<th class="text-center">Name</th>
										<th class="text-center">Mobile No</th>
										<th class="text-center">Status</th>
										<th class="text-center">Payment Mode</th>
										<th class="text-center">Application Date</th>
										<th class="text-center">Print Application</th>
										<th class="text-center" hidden="">Application Number</th>
										<th class="text-center">Action</th>
									</tr>
								</thead>
								<tbody>
								
								</tbody>
							</table>
							
						</div>
					</div>
				</div>
			</div>
		</div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<link href="<?php echo base_url(); ?>public/assets/js/buttons.dataTables.min.css" type="text/css" />
<script src="<?php echo base_url(); ?>public/assets/js/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>public/assets/js/buttons.flash.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>public/assets/js/jszip.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>public/assets/js/pdfmake.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>public/assets/js/vfs_fonts.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>public/assets/js/buttons.html5.min.js" type="text/javascript"></script>

<link href="<?php echo base_url(); ?>public/css/datepicker3.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin/manageApplication.js"></script>

   