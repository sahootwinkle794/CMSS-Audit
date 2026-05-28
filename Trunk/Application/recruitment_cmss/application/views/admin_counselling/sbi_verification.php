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
</div><!-- /.content-wrapper -->
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin/sbi_verification.js"></script>

   