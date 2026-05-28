
	<div id="page-wrapper">
		<br />
			 <!-- Main content -->
        <section class="content">
			<div class="row">
				<div class="panel-body">
					<div class="col-lg-12 page-header">
						<form class="form-horizontal" method="post" role="form" id="frmApplyNew" name="frmApplyNew">
							<div class="form-group">
								<label for="" class="control-label col-sm-2" >Program Group:</label>
								<div class="col-sm-2">
									<select class="form-control" name="cmbProgramGroup" id="cmbProgramGroup">
										<!--<option value=''>Select</option>-->
										
									</select>
								</div>
								<label for="" class="col-sm-2 control-label" style="margin-left: -50px">Program:</label>
								<div class="col-sm-2" style="margin-left: -20px;">
									<select class="form-control"  name="cmbProgramFilter" id="cmbProgramFilter" title="Select Program">
									</select>
								</div>
								<label for="" class="col-sm-2 control-label" style="margin-left: -20px; ">Exam Center:</label>
								<div class="col-sm-2">
									<select class="form-control"  name="cmbExamCentre" id="cmbExamCentre" title="Select Exam Center">
									</select>
								</div>
								<div class="col-sm-1">
									<button type="button" class="btn btn-info btn-circle tooltips tooltipstered" id="btnAddCentreAddress" title="Add"><i class="fa fa-plus" aria-hidden="true"></i></button>
								</div>
							</div>
						</form>
					</div>
					<div class="col-lg-12">
						<table class="table table-striped table-bordered"  id="tblCenterAddressMaster" width="100%">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th hidden>Program Code</th>
									<th hidden>Exam Center Code</th>
									<th class="text-center">Exam Venue</th>
									<th class="text-center">Capacity</th>
									<th hidden>Address</th>
									<th class="text-center">Exam Schedule</th>
									<th class="text-center">From Date</th>
									<th class="text-center">To Date</th>
									<th hidden>Instruction</th>
									<th hidden>Controller's sign</th>
									<th class="text-center">Status</th>
									<th hidden>Status</th>
									<th class="text-center">Action</th>
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
									<h4 class="modal-title" id="myModalLabel">Add Records</h4>
								</div>
								<div class="modal-body">
									<form class="form-horizontal" role="form"  id="frmAddCentreAddress" name="frmAddCentreAddress">
										<input type="hidden" id="hidOperTypeCentreAdd" name="hidOperTypeCentreAdd" value=""/>
										<div id="errorlogResource" style="display: none; color: red; font-size: 12px;"></div>
										<input type="hidden" class="form-control" id="hidUniqueid" name="hidUniqueid" />
										<input type="hidden" class="form-control" id="hidProgramCode" name="hidProgramCode" />
										<input type="hidden" class="form-control" id="hidExamCentreCode" name="hidExamCentreCode" />
										<div class="form-group">
											<label for="inputname" class="col-sm-3 control-label">Exam Centre</label>
											<div class="col-sm-9">
												<select class="form-control tooltips" id="cmbExamCentreAdd" name="cmbExamCentreAdd" placeholder="Select Exam Centre" title="Select Exam Centre">
													<option value="">Select</option>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label for="" class="col-sm-3 control-label">Exam Venue Code</label>
											<div class="col-sm-9">
												<input type="text" class="form-control tooltips" id="txtExamVanueCode" name="txtExamVanueCode" placeholder="Enter Exam Venue Code" title="Enter Exam Venue Code">
											</div>
										</div>
										<div class="form-group">
											<label for="" class="col-sm-3 control-label">Exam Venue</label>
											<div class="col-sm-9">
												<input type="text" class="form-control tooltips" id="txtExamVanue" name="txtExamVanue" placeholder="Enter Exam Venue" title="Enter Exam Venue">
											</div>
										</div>
										<div class="form-group">
											<label for="" class="col-sm-3 control-label">Capacity Of Center</label>
											<div class="col-sm-9">
												<input type="text" class="form-control tooltips" id="txtCapacity" name="txtCapacity" placeholder="Enter Capacity of Center" title="Enter Capacity of Center">
											</div>
										</div>
										<div class="form-group">
											<label for="" class="col-sm-3 control-label">Center Address</label>
											<div class="col-sm-9">
												<textarea rows="2" cols="40" class="form-control tooltips" name="txtCentreAddress" id="txtCentreAddress" placeholder="Enter Address" title="Enter Address"></textarea>
											</div>
										</div>
										<div class="form-group">
											<label for="" class="col-sm-3 control-label">Exam Schedule</label>
											<div class="col-sm-9">
												<textarea class="form-control" id="taExamSchedule" name="taExamSchedule"></textarea>
											</div>
										</div>
										
										<div class="col-lg-offset-2"><h4>Admit Card Available date</h4></div>
										
										<div class="form-group">
											
											<label for="" class="col-sm-3 control-label">From</label>
											<div class="col-sm-4">
												<input type="text" class="form-control tooltips" id="txtAvailableFrom" name="txtAvailableFrom" placeholder="Pick Start Date" title="Pick Start Date" value="" readonly=""/>
											</div>
											<label for="" class="col-sm-1 control-label">To</label>
											<div class="col-sm-4">
												<input type="text" class="form-control tooltips" id="txtAvailableUpto" name="txtAvailableUpto" placeholder="Pick End Date" title="Pick End Date" value="" readonly=""/>
											</div>
										</div>
										
										<div class="form-group">
											<label for="" class="col-sm-3 control-label">Instructions</label>
											<div class="col-sm-9">
												<textarea rows="10" cols="60" name="txtExamInstructions" id="txtExamInstructions" placeholder="Enter Exam Instructions" title="Enter Exam Instructions"></textarea>
											</div>
										</div>
										<div class="form-group">
											<label for="" class="col-sm-3 control-label">Controller signatute</label>
											<div class="col-sm-4">
												<input type="file" id="fileControllerSignature" name="fileControllerSignature" class="form-control"/>
												File-Type: jpg, jpeg, png<br />
												File-Size: 200kb Max<br />
												Dimension: 500*250 pixels
												<div id="signMessage" style="color:red;font-size:16px;"></div>
											</div>
											<div class="col-sm-5">
												<img id='signatureDisplayarea' src='' style='margin-left:50px;margin-right:50px;' width='150' height='100' />
											</div>
											
										</div>
										<div class="form-group">
											<label for="" class="col-sm-3 control-label">Status</label>
											<div class="col-sm-9">
												<select class="form-control tooltips" id="cmbStatus" name="cmbStatus" title="Pick Status">
													<option value="1">Active</option>
													<option value="0">Inactive</option>
												</select>
											</div>
										</div>
										<div class="modal-footer">
											<span id="spanProcessingSetup" style="display: none">Processing...<img src="../images/bx_loader.gif" /></span>
											<button type="submit" class="btn btn-primary" id="centreaddsave">Save</button>
											<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>  
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
									<h4 class="modal-title" id="myModalLabel">Edit Records</h4>
								</div>
								<div class="modal-body">
									<form class="form-horizontal" role="form"  id="frmEditCentreAddress" name="frmEditCentreAddress">
										<input type="hidden" id="hidOperTypeCentreEdit" name="hidOperTypeCentreEdit" value=""/>
										<div id="errorlogResource" style="display: none; color: red; font-size: 12px;"></div>
										<input type="hidden" class="form-control" id="hidUniqueidEdit" name="hidUniqueidEdit" />
										<input type="hidden" class="form-control" id="hidProgramCodeEdit" name="hidProgramCodeEdit" />
										<input type="hidden" class="form-control" id="hidExamCentreCodeEdit" name="hidExamCentreCodeEdit" />
										<div class="form-group">
											<label for="inputname" class="col-sm-3 control-label">Exam Centre</label>
											<div class="col-sm-9">
												<input type="text" class="form-control tooltips" id="cmbExamCentreEdit" name="cmbExamCentreEdit" placeholder="Select Exam Centre" title="Select Exam Centre" readonly>
											</div>
										</div>
										<div class="form-group">
											<label for="" class="col-sm-3 control-label">Exam Venue</label>
											<div class="col-sm-9">
												<input type="text" class="form-control tooltips" id="txtExamVanueEdit" name="txtExamVanueEdit" placeholder="Enter Exam Venue" title="Enter Exam Venue">
											</div>
										</div>
										<div class="form-group">
											<label for="" class="col-sm-3 control-label">Capacity Of Center</label>
											<div class="col-sm-9">
												<input type="text" class="form-control tooltips" id="txtCapacityEdit" name="txtCapacityEdit" placeholder="Enter Capacity of Center" title="Enter Capacity of Center">
											</div>
										</div>
										<div class="form-group">
											<label for="" class="col-sm-3 control-label">Center Address</label>
											<div class="col-sm-9">
												<textarea rows="2" cols="40" class="form-control tooltips" name="txtCentreAddressEdit" id="txtCentreAddressEdit" placeholder="Enter Address" title="Enter Address"></textarea>
											</div>
										</div>
										<div class="form-group">
											<label for="" class="col-sm-3 control-label">Exam Schedule</label>
											<div class="col-sm-9">
												<textarea class="form-control" id="taExamScheduleEdit" name="taExamScheduleEdit"></textarea>
											</div>
										</div>
										
										<div class="col-lg-offset-2"><h4>Admit Card Available date</h4></div>
										
										<div class="form-group">
											
											<label for="" class="col-sm-3 control-label">From</label>
											<div class="col-sm-4">
											<div class="bootstrap-timepicker">
												<input type="text" class="form-control tooltips" id="txtAvailableFromEdit" name="txtAvailableFromEdit" placeholder="Pick Date" title="Pick Date" readonly="">
											</div>
											</div>
											<label for="" class="col-sm-1 control-label">To</label>
											<div class="col-sm-4">
											<div class="bootstrap-timepicker">
												<input type="text" class="form-control tooltips" id="txtAvailableUptoEdit" name="txtAvailableUptoEdit" placeholder="Pick Date" title="Pick Date" readonly="">
											</div>
											</div>
										</div>
										<div class="form-group">
											<label for="" class="col-sm-3 control-label">Instructions</label>
											<div class="col-sm-9">
												<textarea rows="10" cols="60" name="txtExamInstructionsEdit" id="txtExamInstructionsEdit" placeholder="Enter Exam Instructions" title="Enter Exam Instructions"></textarea>
											</div>
										</div>
										<div class="form-group">
											<label for="" class="col-sm-3 control-label">Controller signatute</label>
											<div class="col-sm-4">
												<input type="file" id="fileControllerSignatureEdit" name="fileControllerSignatureEdit" class="form-control"/>
												File-Type: jpg, jpeg, png<br />
												File-Size: 200kb Max<br />
												Dimension: 500*250 pixels
												<div id="signMessageEdit" style="color:red;font-size:16px;"></div>
											</div>
											<div class="col-sm-5">
												<img id='signatureDisplayareaEdit' src='' style='margin-left:50px;margin-right:50px;' width='150' height='100' />
											</div>
										</div>
										<div class="form-group">
											<label for="" class="col-sm-3 control-label">Status</label>
											<div class="col-sm-9">
												<select class="form-control tooltips" id="cmbStatusEdit" name="cmbStatusEdit" title="Pick Status">
													<option value="1">ACTIVE</option>
													<option value="0">INACTIVE</option>
												</select>
											</div>
										</div>
										<div class="modal-footer">
											<span id="spanProcessingSetupEdit" style="display: none">Processing...<img src="../images/bx_loader.gif" /></span>
											<button type="submit" class="btn btn-primary" id="centreeditsave">Save</button>
											<button type="button" class="btn btn-danger" id="centreeditdelete" data-dismiss="modal">Close</button>  
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
    