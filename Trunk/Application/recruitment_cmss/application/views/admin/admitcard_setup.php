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
							</div>
							<div class="form-group">
								<label for="" class="control-label col-sm-3">Exam Center:</label>
								<div class="col-sm-3">
									<select class="form-control"  name="cmbExamCentre" id="cmbExamCentre" title="Select Exam Center">
									</select>
								</div>
								<!--<div class="col-sm-4 ">
									
									<button type="button" class="btn btn-info btn-circle pull-right  tooltips tooltipstered" id="btnAddCentreAddress" title="Add"><i class="fa fa-plus" aria-hidden="true"></i></button>
								</div>
								<div class="col-sm-2 ">
									<button type="submit"  class="btn btn-success   " id="sbtnExcel" name="sbtnExcel">Excel</button>
									</div>-->
							</div>
						</div>
						</div>
							
						</form>
					</div>
					<div class="col-lg-12">
						<table class="table table-striped table-bordered"  id="tblCenterAddressMaster" width="100%">
							<thead>
								<tr>
									<th >#</th>
									<th hidden>Post Code</th>
									<th hidden>Exam Center Code</th>
									<th >Round</th>
									<th >Exam Venue</th>
									<th >Exam Venue Sl No.</th>
									<th >Capacity</th>
									<th hidden>Address</th>
									<th >Exam Schedule</th>
									<th hidden>From Date</th>
									<th hidden>To Date</th>
									<th hidden>Instruction</th>
									<th hidden>Controller's name</th>
									<th hidden>Controller's no</th>
									<th hidden>Controller's mail</th>
									<th hidden>Controller's sign</th>
									<th >Status</th>
									<th hidden>Status</th>
									<th hidden>Template Code</th>
									<th hidden>Exam Shift</th>
									<th hidden>Exam Date</th>
									<th hidden>Reporting Time</th>
									<th hidden>Exam Start Time</th>
									<th style="text-align: center">Action</th>
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
									<h4 class="modal-title" id="myModalLabel">Add Venue Details</h4>
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
												<div class="form-group">
													<label for="inputname" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> Exam Centre</label>
													<div class="col-sm-8">
														<select class="form-control tooltips" id="cmbExamCentreAdd" name="cmbExamCentreAdd" placeholder="Select Exam Centre" title="Select Exam Centre">
															<option value="">Select</option>
														</select>
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> Exam Venue Code</label>
													<div class="col-sm-8">
														<input type="text" class="form-control tooltips" id="txtExamVanueCode" name="txtExamVanueCode" placeholder="Enter Exam Venue Code" title="Enter Exam Venue Code" readonly="">
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> Exam Venue Sl No.</label>
													<div class="col-sm-8">
														<input type="text" class="form-control tooltips" id="txtExamVanueslno" maxlength="2" name="txtExamVanueslno" placeholder="Enter Exam Venue Sl No." title="Enter Exam Venue Sl No." >
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> Exam Venue</label>
													<div class="col-sm-8">
														<input type="text" class="form-control tooltips" id="txtExamVanue" name="txtExamVanue" placeholder="Enter Exam Venue" title="Enter Exam Venue">
													</div>
													<p class="modalExbottom" style="margin-left: 310px;">Ex : Govt. High school</p>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> Round</label>
													<div class="col-sm-8">
														<select class="form-control tooltips" id="cmbRound" name="cmbRound" title="Round">
															<!--<option value="1">1</option>
															<option value="2">2</option>
															<option value="3">3</option>-->
														</select>
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> Exam Type</label>
													<div class="col-sm-8">
														<select class="form-control" id="cmbTemplate" name="cmbTemplate">
															
														</select>
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> Capacity Of Center</label>
													<div class="col-sm-8">
														<input type="text" class="form-control tooltips" id="txtCapacity" name="txtCapacity" placeholder="Enter Capacity of Center" title="Enter Capacity of Center">
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-4 control-label"><!--<i style="color:red;font-size:15px;">*</i>--> Center Address</label>
													<div class="col-sm-8">
														<textarea rows="2" cols="40" class="form-control tooltips" name="txtCentreAddress" id="txtCentreAddress" placeholder="Enter Address" title="Enter Address"></textarea>
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-4 control-label">Exam Schedule</label>
													<div class="col-sm-8">
														<textarea class="form-control" id="taExamSchedule" name="taExamSchedule"></textarea>
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> Status</label>
													<div class="col-sm-8">
														<select class="form-control tooltips" id="cmbStatus" name="cmbStatus" title="Pick Status">
															<option value="">Select</option>
															<option value="1">Active</option>
															<option value="0">Inactive</option>
														</select>
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:18px;">*</i> Exam Shift</label>
													<div class="col-sm-8">
														<select class="form-control" id="cmbSession" name="cmbSession">
															<option value="">Select</option>
															<option value="Morning Shift">Morning Shift</option>
															<option value="Evening Shift">Evening Shift</option>
														</select>
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:18px;">*</i> Exam Date</label>
													<div class="col-sm-8">
														<input type="text" class="form-control tooltips" id="txtDate" readonly="" name="txtDate" placeholder="Enter Exam Date" title="Enter Exam Date">
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
												<div class="form-group">
													<label for="inputname" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> Exam Centre</label>
													<div class="col-sm-8">
														<input type="text" class="form-control tooltips" id="cmbExamCentreEdit" name="cmbExamCentreEdit" placeholder="Select Exam Centre" title="Select Exam Centre" readonly>
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> Exam Venue</label>
													<div class="col-sm-8">
														<input type="text" class="form-control tooltips" id="txtExamVanueEdit" name="txtExamVanueEdit" placeholder="Enter Exam Venue" title="Enter Exam Venue">
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i>Exam Venue Sl No.</label>
													<div class="col-sm-8">
														<input type="text" class="form-control tooltips" id="txtExamVanueEditslno" maxlength="2" name="txtExamVanueEditslno" placeholder="Enter Exam Venue Sl No." title="Enter Exam Venue Sl No." >
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> Round</label>
													<div class="col-sm-8">
														<input type="text" class="form-control tooltips" id="txtExamRoundEdit" name="txtExamRoundEdit" title="Round">
															
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> Exam Type</label>
													<div class="col-sm-8">
														<select class="form-control" id="cmbTemplateEdit" name="cmbTemplateEdit">
															
														</select>
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> Capacity Of Center</label>
													<div class="col-sm-8">
														<input type="text" class="form-control tooltips" id="txtCapacityEdit" name="txtCapacityEdit" placeholder="Enter Capacity of Center" title="Enter Capacity of Center">
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-4 control-label"><!--<i style="color:red;font-size:15px;">*</i>--> Center Address</label>
													<div class="col-sm-8">
														<textarea rows="2" cols="40" class="form-control tooltips" name="txtCentreAddressEdit" id="txtCentreAddressEdit" placeholder="Enter Address" title="Enter Address"></textarea>
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-4 control-label">Exam Schedule</label>
													<div class="col-sm-8">
														<textarea class="form-control" id="taExamScheduleEdit" name="taExamScheduleEdit"></textarea>
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> Status</label>
													<div class="col-sm-8">
														<select class="form-control tooltips" id="cmbStatusEdit" name="cmbStatusEdit" title="Pick Status">
															<option value="1">ACTIVE</option>
															<option value="0">INACTIVE</option>
														</select>
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:18px;">*</i> Exam Shift</label>
													<div class="col-sm-8">
														<select class="form-control" id="cmbSessionEdit" name="cmbSessionEdit">
															<option value="">Select</option>
															<option value="Morning Shift">Morning Shift</option>
															<option value="Evening Shift">Evening Shift</option>
														</select>
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:18px;">*</i> Exam Date</label>
													<div class="col-sm-8">
														<input type="text" class="form-control tooltips" id="txtDateEdit" readonly="" name="txtDateEdit" placeholder="Enter Exam Date" title="Enter Exam Date">
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
	<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin/admitcard_setup.js"></script>
    