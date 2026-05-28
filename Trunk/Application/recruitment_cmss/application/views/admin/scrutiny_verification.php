<style>
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

<div id="content-wrapper">
	<div class="loadingRPimage">
		<img src="<?=base_url()?>upload/image/loader/loader2.gif" style="margin-top: 194px; width: 15%;"/>
	</div>
	<!--<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Scrutiny Verification (<?=$this->session->userdata('user_display_name')?>)</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>-->
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-lg-12" style="padding-top:0px;">
				<div class="panel panel-default">	
					<div class="panel-body">
						<div style="border-radius:0px;border: 0px inset;padding-left:250px;padding-right:20px;padding-top:0px;">
							<form class="form-horizontal" method="post" role="form" id="frmApplyNew" name="frmApplyNew">
								<input type="hidden" name="hidTemplate" id="hidTemplate" value=""/>
								<div class="form-group" style=" padding-top: 12px; margin-bottom: 10px; padding-bottom: 12px;">
									<label for="" class="control-label col-sm-2" >Recruitment Drive:</label>
									<div class="col-sm-3">
										<select class="form-control" name="cmbProgramGroup" id="cmbProgramGroup">
											<option value=''>Select</option>
										</select>
									</div>
									<div class="col-sm-1" id="divProcessing" style="display:none;">
										<img src="../images/bx_loader.gif" />
									</div>
									<label for="" class="control-label col-sm-1" >Post:</label>
									<div class="col-sm-3">
										<select class="form-control" name="cmbProgram" id="cmbProgram">
											<option value=''>Select</option>
										</select>
									</div>
									<div class="col-sm-3">
										<!--<div class="form-group">-->
											<button class="btn btn-primary" name="btnGenerateReport" id="btnGenerateReport" type="button" value="Show">Show</button>
											<button type="button" id="btnSynopsisSheet" class="btn btn-success" name="btnSynopsisSheet">Synopsis Sheet</button>
											<!--<button type="button" id="btnExportReport" class="btn btn-success" name="btnExportReport">Export Report</button>-->
											<!--<button id="btnPrint" class="btn btn-primary" name="btnPrint" type="button">Print</button>
											<button type="button" id="btnExportReport" class="btn btn-primary" name="btnExportReport">Export Report</button>-->
										<!--</div>-->
									</div>
								</div>
								<!--<div class="form-group" style="background-color: #9fc6f9; padding-top: 12px;padding-bottom: 12px;">
									<label for="" class="control-label col-sm-2" >Date:</label>
									<div class="col-sm-2">
										<input class="form-control" type="text" name="txtAppDate" id="txtAppDate" placeholder="Application Date"  />
									</div>
									<label for="" class="control-label col-sm-1 col-sm-offset-1" >Status:</label>
									<div class="col-sm-2">
										<select class="form-control" name="cmbStatus" id="cmbStatus">
											<option value="">All</option>
											<option value="Valid">Valid</option>
											<option value="Invalid">Invalid</option>
										</select>
									</div>
									<div class="col-sm-4">
										
											<button class="btn btn-primary" name="btnGenerateReport" id="btnGenerateReport" type="button" value="Show">Show</button>&nbsp;
											<button id="btnPrint" class="btn btn-primary" name="btnPrint" type="button">Print</button>
											<button type="button" id="btnExportReport" class="btn btn-primary" name="btnExportReport">Export Report</button>
										
									</div>
								</div>-->
								<div class="col-md-12" style="padding: 0px;">
									<!--<div class="panel with-nav-tabs panel-primary">-->
			            				<!--<div class="panel-heading">-->
			            				<div class="nav-tabs-custom box box-default">
											<ul class="nav nav-tabs" role="tablist">
												<li class="active"><a href="#new" data-toggle='tab'>New</a></li>
												<li><a href="#valid" data-toggle='tab'>Approved</a></li>
												<li><a href="#invalid" data-toggle='tab'>Rejected</a></li>
											</ul>
										</div>
										<!--</div>-->
										<div class="panel-body">
			           						<div class="tab-content no-padding">
												<div class="tab-pane in active" id="new">
													<div class="col-lg-12">
														<input type="hidden" name="removeid" id="removeid" value="" />
														<table class="table table-striped table-bordered " id="tblApplicantDetails">
															<thead>
																<tr>
																	<th class="text-center">#</th>
																	<th class="text-center">Appl No</th>
																	<th class="text-center">Mobile No</th>
																	<th class="text-center" hidden="">Mobile No</th>
																	<th class="text-center">Name</th>
																	<th class="text-center">Status</th>
																	<th class="text-center">Remark</th>
																	<th hidden="hidden">Index No</th>
																	<th class="text-center">Submission Date</th>
																	<th class="text-center">Scrutinized Date</th>
																	<th class="text-center">Documents</th>
																	<th class="text-center">Action</th>
																</tr>
															</thead>
															<tbody>
															</tbody>
														</table>												
													</div>
												</div>
												<div class="tab-pane" id="valid">
													<div class="col-lg-12">
														<table class="table table-striped table-bordered " id="tblApplicantDetailsValid">
															<thead>
																<tr>
																	<th class="text-center">#</th>
																	<th class="text-center">Appl No</th>
																	<th class="text-center">Mobile No</th>
																	<th class="text-center" hidden="">Mobile No</th>
																	<th class="text-center">Name</th>
																	<th class="text-center">Status</th>
																	<th class="text-center">Remark</th>
																	<th hidden="hidden">Index No</th>
																	<th class="text-center">Submission Date</th>
																	<th class="text-center">Scrutinized Date</th>
																	<th class="text-center">Documents</th>
																</tr>
															</thead>
															<tbody>
															</tbody>
														</table>		
													</div>
												</div>
												<div class="tab-pane" id="invalid">
													<div class="col-lg-12">
														<table class="table table-striped table-bordered " id="tblApplicantDetailsInvalid">
															<thead>
																<tr>
																	<th class="text-center">#</th>
																	<th class="text-center">Appl No</th>
																	<th class="text-center">Mobile No</th>
																	<th class="text-center" hidden="">Mobile No</th>
																	<th class="text-center">Name</th>
																	<th class="text-center">Status</th>
																	<th class="text-center">Remark</th>
																	<th hidden="hidden">Index No</th>
																	<th class="text-center">Submission Date</th>
																	<th class="text-center">Scrutinized Date</th>
																	<th class="text-center">Documents</th>
																</tr>
															</thead>
															<tbody>
															</tbody>
														</table>		
													</div>
												</div>
											</div>
										</div>
									<!--</div>-->
									
								</div>
								
								
								
								
								
								
								
							   <!-- <div class="form-group">
									<input type="hidden" name="removeid" id="removeid" value="" />
									<table class="table table-striped table-bordered " id="tblApplicantDetails">
										<thead>
											<tr>
												<th class="text-center">#</th>
												<th class="text-center">Index No</th>
												<th class="text-center">Mobile No</th>
												<th class="text-center">Name</th>
												<th class="text-center">Status</th>
												<th class="text-center">Remark</th>
												<th hidden="hidden">Appl No</th>
												<th class="text-center">Documents</th>
												<th class="text-center">Action</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>-->
						    </form>	
						</div>
						
						<div class="modal fade" id="applicantDisqualifyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog" style="width: 50%">
								<div class="modal-content">
									<form method="POST" name="frmDisQualifyModal" id="frmDisQualifyModal">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
											&times;
										</button>
										<h4 class="modal-title" id="myModalLabel">Remark for Invalidation</h4>
									</div>
									<div class="modal-body">
									
									<input type="hidden" id="hidRegUserId" name="hidRegUserId"/>
									<input type="hidden" id="hidProgram" name="hidProgram"/>
										<div class="form-group">
											<label for="" class="col-sm-2 control-label"><i style="color:red;font-size:18px;">*</i>&nbsp;Remark</label>
											<div class="col-sm-10">
												<textarea class="form-control" cols="3" rows="3" id="taRemark" name="taRemark" placeholder="Enter Reason for Invalidation"></textarea>
											</div>
										</div>
									</div>
									<div class="modal-footer" style="margin-top: 20%">
										<button type="submit" class="btn btn-danger" id="applicantDisqualify">Submit</button>
										<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
									</div>
									</form>
								</div>
							</div>
						</div>
						
						<div class="modal fade" id="applicantqualifyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog"style="width: 50%">
								<div class="modal-content">
									<form method="POST" name="frmQualifyModal" id="frmQualifyModal">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
											&times;
										</button>
										<h4 class="modal-title" id="myModalLabel">Remark</h4>
									</div>
									<div class="modal-body">
									
									<input type="hidden" id="hidRegqualyUserId" name="hidRegqualyUserId"/>
									<input type="hidden" id="hidqualyProgram" name="hidqualyProgram"/>
										<div class="form-group">
											<label for="" class="col-sm-2 control-label"><i style="color:red;font-size:18px;">*</i>&nbsp;Remark</label>
											<div class="col-sm-10">
												<textarea class="form-control" cols="3" rows="3" id="taqulyRemark" name="taqulyRemark" placeholder="Enter Remark"></textarea>
											</div>
										</div>
									</div>
									<div class="modal-footer" style="margin-top: 20%">
										<button type="submit" class="btn btn-danger" id="applicantqualify">Submit</button>
										<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
									</div>
									
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<div id="viewModal" class="modal fade" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg ">

    <!-- Modal content-->
    <div class="modal-content" style="background: white"><!--
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">View Form</h4>
      </div>-->
      <div class="modal-body" style="padding: 30px;">
      	<!--<iframe src="<?= base_url(); ?>/application/views/apply/preview_temp009.php" />-->
        <div id="tempPreview"></div>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin/scrutiny_verification.js"></script>
<script>
	$(document).ajaxSend(function(){
		$('.loadingRPimage').fadeIn(250);
	});
	$(document).ajaxComplete(function(){
		$('.loadingRPimage').fadeOut(250);
	});
</script>