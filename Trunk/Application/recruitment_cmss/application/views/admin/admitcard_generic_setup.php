<style>
	h5{
		font-weight: bold;
		color: blue;
	}
	.modal-content{
		background: url(<?=base_url()?>public/photos/rink_background.jpg) ;
		background-size: cover;
	}
	.modalExbottom
	{
		color:#d2a9a9;
	}
	.form-horizontal {
	    padding: 0px 10px 3px 35px;
	}
</style>
	<div class="content-wrapper">
		<br />
			 <!-- Main content -->
        <section class="content">
			<div class="row">
				<div class="panel-body box box-default">
					<div class="col-lg-12">
						<form class="form-horizontal" method="post" role="form" id="frmApplyNew" name="frmApplyNew">
						<div class="panel panel-default">
							<div class="panel-body">
							<div class="form-group">
								<label for="" class="control-label col-sm-3" >Recruitment Drive:</label>
								<div class="col-sm-3">
									<select class="form-control" name="cmbProgramGroup" id="cmbProgramGroup">
										<!--<option value=''>Select</option>-->
										
									</select>
								</div>
								<label for="" class="col-sm-3 control-label" >Post:</label>
								<div class="col-sm-3" style="margin-left: -20px;">
									<select class="form-control"  name="cmbProgramFilter" id="cmbProgramFilter" title="Select Post">
									</select>
								</div>
							</div></div>
							</div>
							
						</form>
					</div>
					<div class="col-lg-12">
						<table class="table table-striped table-bordered"  id="tblCenterAddressMaster" width="100%">
							<thead>
								<tr>
									<th >#</th>
									<th hidden>Post Code</th>
									<th >From Date</th>
									<th >To Date</th>
									<th hidden>Instruction</th>
									<th >Controller's name</th>
									<th >Controller's no</th>
									<th >Controller's mail</th>
									<th >Controller's sign</th>
									<th >Reporting Time</th>
									<th >Exam Start Time</th>
									<th >Action</th>
								</tr>
							</thead>
							<tbody>

							</tbody>
						</table>
					</div>
					<div class="modal fade" id="centreAddressAddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
										&times;
									</button>
									<h4 class="modal-title" id="myModalLabel">Add Generic Details</h4>
								</div>
								<div class="modal-body">
									<form class="form-horizontal" role="form"  id="frmAddCentreAddress" name="frmAddCentreAddress">
										<input type="hidden" id="hidOperTypeCentreAdd" name="hidOperTypeCentreAdd" value=""/>
										<div id="errorlogResource" style="display: none; color: red; font-size: 12px;"></div>
										<input type="hidden" class="form-control" id="hidUniqueid" name="hidUniqueid" />
										<input type="hidden" class="form-control" id="hidProgramCode" name="hidProgramCode" />
										<input type="hidden" class="form-control" id="hidExamCentreCode" name="hidExamCentreCode" />
										<div class="row col-sm-12 col-xs-12 ">
											<div class="col-sm-12 col-xs-12">	
												<h5>Admit Card Available date</h5>
												
												<div class="form-group">
													<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> From</label>
													<div class="col-sm-8">
														<input type="text" class="form-control tooltips" id="txtAvailableFrom" name="txtAvailableFrom" placeholder="Pick Start Date" title="Pick Start Date" value="" readonly=""/>
													</div>
												</div>	
												<div class="form-group">	
													<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> To</label>
													<div class="col-sm-8">
														<input type="text" class="form-control tooltips" id="txtAvailableUpto" name="txtAvailableUpto" placeholder="Pick End Date" title="Pick End Date" value="" readonly=""/>
													</div>
												</div>
												
												<div class="form-group">
													<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> Instructions</label>
													<div class="col-sm-8">
														<textarea rows="10" cols="60" name="txtExamInstructions" id="txtExamInstructions" placeholder="Enter Exam Instructions" title="Enter Exam Instructions"></textarea>
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> Controller Name</label>
													<div class="col-sm-8">
														<input type="text" class="form-control tooltips" id="txtControllerName" name="txtControllerName" placeholder="Enter Controller Name" title="Enter Controller Name">
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> Controller Mobile No.</label>
													<div class="col-sm-8">
														<input type="text" class="form-control tooltips" id="txtControllerMobileNo" name="txtControllerMobileNo" placeholder="Enter Controller Mobile No." title="Enter Controller Mobile No.">
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> Controller Email Id</label>
													<div class="col-sm-8">
														<input type="text" class="form-control tooltips" id="txtControllerEmail" name="txtControllerEmail" placeholder="Enter Controller Email Id" title="Enter Controller Email Id">
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> Controller signatute</label>
													<div class="col-sm-5">
														<input type="file" id="fileControllerSignature" name="fileControllerSignature" class="form-control"/>
														File-Type: jpg, jpeg, png<br />
														File-Size: 200kb Max<br />
														Dimension: 500*250 pixels
														<div id="signMessage" style="color:red;font-size:16px;"></div>
													</div>
													<div class="col-sm-3" style="margin-left: -6%;">
														<img id='signatureDisplayarea' src='' style='margin-left:50px;margin-right:50px;' width='100' height='100' />
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:18px;">*</i> Reporting Time</label>
													<div class="col-sm-8">
														<input type="text" class="form-control tooltips" id="txtReportingTime" name="txtReportingTime" placeholder="Enter Reporting Time" title="Enter Reporting Time">
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:18px;">*</i> Gate closing time</label>
													<div class="col-sm-8">
														<input type="text" class="form-control tooltips" id="txtStartTime" name="txtStartTime" placeholder="Enter Gate closing Time" title="Enter Gate closing Time">
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:18px;">*</i> Exam Start Time</label>
													<div class="col-sm-8">
														<input type="text" class="form-control tooltips" id="txtExamStartTime" name="txtExamStartTime" placeholder="Enter Exam Start Time" title="Enter Exam Start Time">
													</div>
												</div>
											</div>
										</div>		
										<div class="modal-footer">
											<span id="spanProcessingSetup" style="display: none">Processing...<img src="<?=base_url()?>public/assets/images/bx_loader.gif" /></span>
											<button type="submit" class="btn btn-primary" id="centreaddsave"><i class="fa fa-save"></i>  Save</button>
											<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
										</div>
									</form>
								</div>	
							</div>
						</div>
					</div>
					<div class="modal fade" id="centreAddressEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
										&times;
									</button>
									<h4 class="modal-title" id="myModalLabel">Edit Venue Details</h4>
								</div>
								<div class="modal-body">
									<form class="form-horizontal" role="form"  id="frmEditCentreAddress" name="frmEditCentreAddress">
										<input type="hidden" id="hidOperTypeCentreEdit" name="hidOperTypeCentreEdit" value=""/>
										<div id="errorlogResource" style="display: none; color: red; font-size: 12px;"></div>
										<input type="hidden" class="form-control" id="hidUniqueidEdit" name="hidUniqueidEdit" />
										<input type="hidden" class="form-control" id="hidProgramCodeEdit" name="hidProgramCodeEdit" />
										<input type="hidden" class="form-control" id="hidExamCentreCodeEdit" name="hidExamCentreCodeEdit" />
										<div class="row col-sm-12 col-xs-12 ">
											<div class="col-sm-12 col-xs-12">	
												<h5>Admit Card Available date</h5>
												
												<div class="form-group">
													<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> From</label>
													<div class="col-sm-8">
														<div class="bootstrap-timepicker">
															<input type="text" class="form-control tooltips" id="txtAvailableFromEdit" name="txtAvailableFromEdit" placeholder="Pick Date" title="Pick Date" readonly="">
														</div>
													</div>
												</div>
												<div class="form-group">	
													<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> To</label>
													<div class="col-sm-8">
														<div class="bootstrap-timepicker">
															<input type="text" class="form-control tooltips" id="txtAvailableUptoEdit" name="txtAvailableUptoEdit" placeholder="Pick Date" title="Pick Date" readonly="">
														</div>
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> Instructions</label>
													<div class="col-sm-8">
														<textarea rows="10" cols="60" name="txtExamInstructionsEdit" id="txtExamInstructionsEdit" placeholder="Enter Exam Instructions" title="Enter Exam Instructions"></textarea>
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> Controller Name</label>
													<div class="col-sm-8">
														<input type="text" class="form-control tooltips" id="txtControllerNameEdit" name="txtControllerNameEdit" placeholder="Enter Controller Name" title="Enter Controller Name">
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> Controller Mobile No.</label>
													<div class="col-sm-8">
														<input type="text" class="form-control tooltips" id="txtControllerMobileNoEdit" name="txtControllerMobileNoEdit" placeholder="Enter Controller Mobile No." title="Enter Controller Mobile No.">
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> Controller Email Id</label>
													<div class="col-sm-8">
														<input type="text" class="form-control tooltips" id="txtControllerEmailEdit" name="txtControllerEmailEdit" placeholder="Enter Controller Email Id" title="Enter Controller Email Id">
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-4 control-label">Controller signatute</label>
													<div class="col-sm-5">
														<input type="file" id="fileControllerSignatureEdit" name="fileControllerSignatureEdit" class="form-control"/>
														File-Type: jpg, jpeg, png<br />
														File-Size: 200kb Max<br />
														Dimension: 500*250 pixels
														<div id="signMessageEdit" style="color:red;font-size:16px;"></div>
													</div>
													<div class="col-sm-3" style="margin-left: -6%;">
														<img id='signatureDisplayareaEdit' src='' style='margin-left:30px;margin-right:50px;' width='100' height='100' />
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:18px;">*</i> Reporting Time</label>
													<div class="col-sm-8">
														<input type="text" class="form-control tooltips" id="txtReportingTimeEdit" name="txtReportingTimeEdit" placeholder="Enter Reporting Time" title="Enter Reporting Time">
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:18px;">*</i> Gate closing time</label>
													<div class="col-sm-8">
														<input type="text" class="form-control tooltips" id="txtStartTimeEdit"  name="txtStartTimeEdit" placeholder="Enter Gate closing Time" title="Enter Gate closing Time">
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:18px;">*</i> Exam Start Time</label>
													<div class="col-sm-8">
														<input type="text" class="form-control tooltips" id="txtExamStartTimeEdit"  name="txtExamStartTimeEdit" placeholder="Enter Exam Start Time" title="Enter Exam Start Time">
													</div>
												</div>
												
											</div>
										</div>		
										<div class="modal-footer">
											<span id="spanProcessingSetupEdit" style="display: none">Processing...<img src="../images/bx_loader.gif" /></span>
											<button type="submit" class="btn btn-primary" id="centreeditsave"><i class="fa fa-save"></i>  Save</button>
											<button type="button" class="btn btn-danger" id="centreeditdelete" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
										</div>
									</form>
								</div>	
							</div>
						</div>
					</div>
				</div>
					<!--</div>-->
				<!--</div>-->
			</div>
    	</section><!-- /.content -->
	</div>
	<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin/admitcard_generic_setup.js"></script>
    