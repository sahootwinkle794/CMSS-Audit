<?php
	foreach($ver_codes as $row)
	{
		$nodal_centre = $row['nodal_centre_code'];
		$counter_code = $row['counter_code'];
	}
?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/template_lib/plugins/datepicker/datepicker3.css" />
<link href="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" media="screen" />
<div id="page-wrapper">
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Counselling Setup</h1>
        </div>
    	<!-- /.col-lg-12 -->
	</div>

    <!-- Main content -->
    <section class="content">
		<div class="row">
			<div class="form-group">
				<input type="hidden" id="nodal_centre" value="<?php echo $nodal_centre; ?>"/>
				<input type="hidden" id="counter_code" value="<?php echo $counter_code; ?>"/>
				<label for="" class="col-sm-1 control-label" style="font-size:16px;">Year:</label>
				<div class="col-sm-2">
					<select class="form-control" id="cmbYear" name="cmbYear">
						
					</select>
				</div>
				
				<label class="col-sm-2 control-label" for="txtCenterCode" style="font-size:16px;" >Counselling Name:</label>
				
				<div class="col-sm-2">
					<select class="form-control" name="cmbCounsellingName" id="cmbCounsellingName">			
						<option value="">Select</option>	
					</select>
				</div>
				<label for="" class="col-sm-1 control-label" style="font-size:16px;">Date:</label>
				<div class="col-sm-2">
					<select class="form-control" id="cmbDate" name="cmbDate">
						<option value="">Select</option>
					</select>
				</div>
			</div>
			<br /><br />
			<!--<div class="form-group">
				<label class="col-sm-2 control-label" for="cmbCounter" style="font-size:16px;" >Counter Name:</label>
				<div class="col-sm-2">
					<select class="form-control" name="cmbCounter" id="cmbCounter">			
						<option value="">Select</option>
					</select>
				</div>
				
			</div>-->
			<br /><br />
			<div class="col-lg-12" style="padding-top:0px;">
				<div class="panel panel-default">	
					<div class="panel-body">
						<div style="border-radius:0px;border: 0px inset;padding-left:20px;padding-right:20px;padding-top:0px;">
							
							
							<table class="table table-striped table-bordered " id="dtblApplicationDetail">
								<thead>
									<tr>
										<th class="text-center">#</th>
										<th class="text-center">Jee Roll No.</th>
										<th class="text-center">Name</th>
										<th class="text-center">Token Number</th>
										<th class="text-center">Print</th>
										<th class="text-center" hidden="">Appl No</th>
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
		

		<div class="modal fade" id="applicantListDocumentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog  modal-md">
				<div class="modal-content">
					<form method="POST" name="frmListDocumentModal" id="frmListDocumentModal">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							&times;
						</button>
						<h4 class="modal-title" id="myModalLabel">Check List</h4>
					</div>
					<div class="modal-body">
					
						<div id="applicantListDocument"></div>
						<input type="hidden" id="hidRegUserId" name="hidRegUserId"/>
						<input type="hidden" id="hidApplNo" name="hidApplNo"/>
						<div>
							<h4>DD Details</h4><!--
							<hr/>-->
							<div class="form-group">
								<label for="" class="col-sm-1 control-label">DD No.:</label>
								<div class="col-sm-3">
									<input type="text"  class="form-control tooltips" id="txtDDNo" name="txtDDNo"  title="DD No">
								</div>
								
								<label class="col-sm-1 control-label" for="txtCenterCode" >Date:</label>
								
								<div class="col-sm-3">
									<input type="text"  class="form-control tooltips" id="txtAppDate" name="txtAppDate"  title="DD Date">
								</div>
								<label class="col-sm-1 control-label" for="cmbNodalCenter" >Amount:</label>
								<div class="col-sm-3">
									<input type="text"  class="form-control tooltips" id="txtAmount" name="txtAmount"  title="Amount">
								</div>
								
							</div>
							<br /><br /><br />
							<div class="form-group">
								
								<label for="" class="col-sm-1 control-label">Issued Bank:</label>
								<div class="col-sm-3">
									<input type="text"  class="form-control tooltips" id="txtBank" name="txtBank"  title="Issued Bank">
								</div>
								
								<label class="col-sm-1 control-label" for="txtCenterCode" >Branch:</label>
								
								<div class="col-sm-3">
									<input type="text"  class="form-control tooltips" id="txtBranch" name="txtBranch"  title="Branch">
								</div>
							</div>
						</div>
						
					</div>
					<div class="modal-footer" style="margin-top: 5%">
						<button type="button" class="btn btn-success" id="applicantValidation">Accept</button>
						<button type="button" class="btn btn-danger" id="applicantRejection">Reject</button>
						<br /><br />
						<div id="remark" class="form-group">
							<div>
								<label for="" class="col-sm-2 control-label">Reason</label>
								<div class="col-sm-10">
									<textarea class="form-control" cols="3" rows="3" id="taRemark" name="taRemark" placeholder="Please Enter The Reason"></textarea>
								</div>
							</div>
							<div>
								<br /><br />
							</div>
							<div>
								<button type="button" class="btn btn-danger" id="btnApplicantRejection">Submit</button>
							</div>
						</div>
						
					</div>
					
					
					</form>
				</div>
			</div>
		</div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<link href="<?php echo base_url(); ?>public/css/datepicker3.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datepicker/bootstrap-datepicker.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/daterangepicker/moment.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin/ver_students_verification.js"></script>

   