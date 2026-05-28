<div id="page-wrapper">
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Payment Details</h1>
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
								<input type="hidden" name="hidTemplate" id="hidTemplate" value=""/>
								<div class="form-group" style="background-color: #9fc6f9; padding-top: 12px;margin-bottom:0px;">
									<label for="" class="control-label col-sm-2" >Program Group:</label>
									<div class="col-sm-3">
										<select class="form-control" name="cmbProgramGroup" id="cmbProgramGroup">
											<option value=''>Select</option>
										</select>
									</div>
									
									<label for="" class="control-label col-sm-1" >Program:</label>
									<div class="col-sm-3">
										<select class="form-control" name="cmbProgram" id="cmbProgram">
											<option value=''>Select</option>
										</select>
									</div>
								
									<div class="col-sm-2">
										<!--<div class="form-group">-->
											<button class="btn btn-primary" name="btnGenerateReport" id="btnGenerateReport" type="button" value="Show">Show</button>&nbsp;
											
										<!--</div>-->
									</div>
								</div>
							    <div class="form-group"
									<input type="hidden" name="removeid" id="removeid" value="" />
									<table class="table table-striped table-bordered " id="tblApplicantDetails" style="margin-top: 20px;">
										<thead>
											<tr>
												<th class="text-center">#</th>
												<th class="text-center">Application No</th>
												<th class="text-center">Mobile No</th>
												<th class="text-center">Name</th>
												<th class="text-center">Order Id</th>
												<th class="text-center">Payment Status</th>
												<th class="text-center">Transaction No</th>
												<th class="text-center">Payment Date</th>
												<th class="text-center">Amount</th>
												<!--<th class="text-center">Action</th>-->
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
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin/payment_details.js"></script>