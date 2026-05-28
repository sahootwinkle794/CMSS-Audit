<style>
	tbody {
	   overflow-x: scroll;
	   width:600px; 
	}
	.dataTables_wrapper
	{
		overflow-y: auto;
	}
	.loadingRPimage {
	    position: fixed;
	    top: 0;
	    left: 0;
	    height: 100vh; /* to make it responsive */
	    width: 100vw; /* to make it responsive */
	    overflow: hidden; /*to remove scrollbars */
	    z-index: 99999; /*to make it appear on topmost part of the page */
	    display: none; /*to make it visible only on fadeIn() function */
	    background: none repeat scroll 0% 0% rgba(104, 136, 164, 0.44); /*to make background blur */
	    text-align:center;
	}
</style>
<div class="content-wrapper">
	<!--<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Manage Application</h1>
        </div>
	</div>-->
	
	<section class="content-header">
      	<h1>
        	Manage Application
      	</h1>
    </section>
    <!-- Main content -->
    <section class="content">
		<div class="row">
			<div class="col-lg-12" style="padding-top:0px;">
				<div class="loadingRPimage">
				    <img src="<?=base_url()?>upload/image/loader/loader2.gif"/>
				</div>
				<div class="panel panel-default">	
					<div class="panel-body box box-default">
						<div style="border-radius:0px;border: 0px inset;padding-left:20px;padding-right:20px;padding-top:0px;">
							<form class="form-horizontal" method="post" role="form" id="frmApplyNew" name="frmApplyNew">
								<input type="hidden" name="hidProgram" id="hidProgram" value=""/>
								<div class="form-group">
									<label for="" class="control-label col-sm-2" style="text-align:left;">Post Type:</label>
									<div class="col-sm-2">
										<label class="radio-inline">
												<input type="radio" name="radioProgramType" id="radioCurrent" value="Current" checked="checked"> Current
											</label>
											<label class="radio-inline">
												<input type="radio" name="radioProgramType" id="radioOld" value="Old"> Old
											</label>
									</div>
									<label for="" class="control-label col-sm-2 col-sm-offset-1" id ="cmbProgramGroupl" >Recruitment Type:</label>
									<div class="col-sm-3">
										<select class="form-control" name="cmbProgramGroup" id="cmbProgramGroup">
										</select>
									</div>
									
								</div>
								<div class="form-group">
									<label for="" class="control-label col-sm-2" style="text-align:left;" id="cmbPrograml">Post:</label>
									<div class="col-sm-4">
										<select class="form-control" name="cmbProgram" id="cmbProgram">
											<option value=''>Select Post</option>
										</select>
									</div>
									
									<!--<div class="col-sm-2" style="margin-left: 32%">
										<a href="apply-1.php" target="_blank" class="btn btn-primary tooltips" title="Add New Applicant" ><i class="fa fa-plus"></i> New Application</i></a>
									</div>-->
								</div>
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
													<option value='Fee_Paid'>Fee Paid(Challan Not Verified)</option>
													<option value='Payment_Updated'>Payment Updated</option>
													<option value='Application_Submitted'>Application Submitted</option>
													<option value='Verified'>Verified</option>
												</select>
											</div>
											<label for="" class="control-label col-sm-2">Mobile No:</label>
											<div class="col-sm-3" >
												<input type="text" class="form-control" id="txtMobileNo" name="txtMobileNo" placeholder="Enter Mobile No" value="">
											</div>
										</div>
										<div class="form-group">										
											
											<!--<label for="" class="control-label col-sm-2" style="text-align:left;">Payment Mode:</label>
											<div class="col-sm-3">
												<select class="form-control" name="cmbPayment" id="cmbPayment">
													<option value=''>Select Payment Mode</option>
													<option value='ONLINE'>ONLINE</option>
													<option value='CHALLAN'>CHALLAN</option>
													<option value='ON_THE_COUNTER'>ON THE COUNTER</option>
												</select>
											</div>-->
											<label for="" class="control-label col-sm-2">Payment Date:</label>
											<div class="col-sm-3" >
												<input type="text" class="form-control" id="txtPaymentDate" name="txtPaymentDate" placeholder="Enter Payment Date" value="" readonly="">
											</div>
											<div class="col-sm-1" >
												<button type="button" class="btn btn-info tooltips" name="btnFilter" id="btnFilter" title="Filter Application"><i class="fa fa-filter"></i> &nbsp;Filter</button>
											</div>
										</div>
									</div>
								</div>
								
								
							</form>
							
							<table class="table table-striped table-bordered " style=" overflow-y: auto;" id="dtblApplicationDetail">
								<thead>
									<tr>
										<th >#</th>
										<th >Name</th>
										<th >Mobile No</th>
										<th >Email Id</th>
										<th >Post</th>
										<th >Status</th>
										<th >Payment Mode</th>
										<th >Application Date</th>
										<th >Print Application</th>
										<th  hidden="">Application Number</th>
										<th >Action</th>
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
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin/manageApplication.js?v=3"></script>

   