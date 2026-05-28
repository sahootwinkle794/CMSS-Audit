<div id="content-wrapper">
	<!--<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Scrutiny Verification</h1>
        </div>
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
								<div class="form-group" style="background-color: #9fc6f9; padding-top: 12px;margin-bottom:0px;">
									<label for="" class="control-label col-sm-2" >Recruitment Drive:</label>
									<div class="col-sm-3">
										<select class="form-control" name="cmbProgramGroup" id="cmbProgramGroup">
											<option value=''>Select</option>
										</select>
									</div>
									<div class="col-sm-1" id="divProcessing" style="display:none;">
										<img src="<?=BASE_URL?>public/assets/images/bx_loader.gif" />
									</div>
									<label for="" class="control-label col-sm-1" >Post:</label>
									<div class="col-sm-3">
										<select class="form-control" name="cmbProgram" id="cmbProgram">
											<option value=''>Select</option>
										</select>
									</div>
								</div>
								<div class="form-group" style="background-color: #9fc6f9; padding-top: 12px;padding-bottom: 12px;">
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
										<!--<div class="form-group">-->
											<button class="btn btn-primary" name="btnGenerateReport" id="btnGenerateReport" type="button" value="Show">Show</button>&nbsp;
											<button id="btnPrint" class="btn btn-primary" name="btnPrint" type="button">Print</button>
											<button type="button" id="btnExportReport" class="btn btn-primary" name="btnExportReport">Export Report</button>
										<!--</div>-->
									</div>
								</div>
							    <div class="form-group"
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
												<th class="text-center" hidden>Email ID</th>
												<th hidden="hidden">Post Code</th>
												<th class="text-center">Documents</th>
												<th class="text-center">Action</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
						    </form>	
						</div>
						
						<div class="modal fade" id="applicantDisqualifyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
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
									<input type="hidden" id="hidName" name="hidName"/>
									<input type="hidden" id="hidEmail" name="hidEmail"/>
										<div class="form-group">
											<label for="" class="col-sm-2 control-label">Remark</label>
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
					</div>
					<div id="exampleModal" class="modal fade" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog modal-lg ">

					    <!-- Modal content-->
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal">&times;</button>
					        <br />
					      </div>
					      <div class="modal-body">
					        <div id="dataPreview"></div>
					      </div>
					      <div class="modal-footer">
					      	<!--<button type="button" class="btn btn-warning" id="btnEdit" name="btnEdit" onclick="edit_template('<?php echo $file_name; ?>')">Edit</button>-->
					      	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					      </div>
					    </div>

					  </div>
					</div>
				</div>
			</div>
		</div>
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin/scrutiny_verification.js"></script>