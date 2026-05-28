<div id="page-wrapper">
	<div class="row">
	    <div class="col-lg-12">
	        <h1 class="page-header">Verification</h1>
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
								<div class="form-group">
									<label for="" class="control-label col-sm-2" >Program Group:</label>
									<div class="col-sm-2">
										<select class="form-control" name="cmbProgramGroup" id="cmbProgramGroup">
											<option value=''>Select</option>
										</select>
									</div>
									<label for="" class="control-label col-sm-1" >Program:</label>
									<div class="col-sm-3">
										<select class="form-control" name="cmbProgram" id="cmbProgram">
										</select>
									</div>
								</div>
							
							
							
						  <!--<form class="form-horizontal" role="form"  id="removeformid" name="removeformid" method="post">-->
							<input type="hidden" name="removeid" id="removeid" value="" />
							<input type="hidden" name="hidProgram" id="hidProgram" value="" />
							<table class="table table-striped table-bordered " id="applicationDetail">
								<thead>
									<tr>
										<th class="text-center">#</th>
										<th class="text-center">Name</th>
										<th class="text-center">Mobile No</th>
										<th class="text-center">Transaction Ref. No</th>
										<th class="text-center">Amount</th>
										<th class="text-center">Deposit Date</th>
										<th class="text-center">Bank Name</th>
										<th class="text-center">Bank Branch</th>
										<th class="text-center">challan</th>
										<th class="text-center">Verify</th>
									</tr>
								</thead>
								<tbody>
								
								</tbody>
							</table>
						    </form>
							
						</div>
					</div>
				</div>
			</div>
		</div>
    </section><!-- /.content -->
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
					<button type="button" class="btn btn-danger" id="applicantDisqualify">Submit</button>
					<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>   
				</div>
				
				
				</form>
			</div>
		</div>
	</div>
</div><!-- /.content-wrapper -->
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin/sbi_verification.js"></script>

   