<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/template_lib/plugins/datepicker/datepicker3.css" />
<link href="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" media="screen" />
<style>
	.daterangepicker{z-index:1151 !important;}
	.daterangepicker{ z-index:99999 !important; }
	/*.modal {
	    width : 560px;
	    position : absolute;
	}*/
	/*.datepicker { 
       z-index: 100000 !important; 
       display: block; 
    }

    .timepicker{
       z-index: 100001 !important;
    }*/
</style>
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
			<div class="col-lg-12" style="padding-top:0px;">
				<div class="panel panel-default">	
					<div class="panel-body">
						<div style="border-radius:0px;border: 0px inset;padding-left:20px;padding-right:20px;padding-top:0px;">
							
							
							<table class="table table-striped table-bordered " id="dtblApplicationDetail">
								<thead>
									<tr>
										<th class="text-center">#</th>
										<th class="text-center" hidden="">Code</th>
										<th class="text-center">Name</th>
										<th class="text-center">Year</th>
										<th class="text-center" hidden="">Appl. Slno</th>
										<th class="text-center">Counselling Start Date</th>
										<th class="text-center">Counselling End Date</th>
										<th class="text-center">Publish Status</th>
										<th class="text-center" hidden="">letter_number</th>
										<th class="text-center" hidden="">department_name</th>
										<th class="text-center" hidden="">status</th>
										<th class="text-center" hidden="">online_payment_transaction_no</th>
										<th class="text-center" hidden="">apply_start_date</th>
										<th class="text-center" hidden="">apply_end_date</th>
										<th class="text-center" hidden="">choice_lock_start_date</th>
										<th class="text-center" hidden="">choice_lock_end_date</th>
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
		<div class="modal fade" id="programAddModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							&times;
						</button>
						<h4 class="modal-title" id="myModalLabel">Add Records</h4>
					</div>
					<div class="modal-body">
						<form class="form-horizontal" role="form"  id="frmAddProgram" name="frmAddProgram">
							<!--<input type="hidden" id="hidSessionCode" name="hidSessionCode" value="<?=$MY_SESSION_NAME?>"/>-->
							<input type="hidden" class="form-control" id="hidUniqueid" name="hidUniqueid">
							<!--<div class="form-group">
								<label for="inputname" class="col-sm-2 control-label">Code</label>
								<div class="col-sm-10">
									<input type="text" class="form-control tooltips" id="txtProgramCode" name="txtProgramCode" title="Code of Counselling" placeholder="Unique Code of Counselling">
								</div>
							</div>-->
							<div class="form-group">
								<label for="" class="col-sm-2 control-label">Name</label>
								<div class="col-sm-10">
									<input type="text" class="form-control tooltips" id="txtProgramName" name="txtProgramName" placeholder="Name Of Counselling" title="Name Of Counselling">
								</div>
							</div>
							<!--<div class="form-group">
								<label for="" class="col-sm-2 control-label">Letter Number</label>
								<div class="col-sm-10">
									<input type="text" class="form-control tooltips" id="txtLetterNumber" name="txtLetterNumber" placeholder="Letter Number" title="Letter Number">
								</div>
							</div>
							<div class="form-group">
								<label for="" class="col-sm-2 control-label">Department Name</label>
								<div class="col-sm-10">
									<input type="text" class="form-control tooltips" id="txtDeptName" name="txtDeptName" placeholder="Department Name" title="Department Name">
								</div>
							</div>-->
							<div class="form-group">
								<label for="" class="col-sm-2 control-label">Year</label>
								<div class="col-sm-10">
									<select class="form-control" id="txtYear" name="txtYear">
										
									</select>
								</div>
								<!--<label for="" class="col-sm-2 control-label">Year</label>
								<div class="col-sm-10">
									<input type="text" class="form-control tooltips" id="txtYear" name="txtYear" placeholder="Enter Year" title="Pick Year">
								</div>-->
							</div>
							<!--<div class="form-group">
								<label for="" class="col-sm-2 control-label">Application Slno</label>
								<div class="col-sm-3">
									<input type="text" class="form-control tooltips" id="txtSlno" name="txtSlno" placeholder="Slno" title="Application Serial Number">
								</div>
								<label for="" class="col-sm-4 control-label">Online Payment TransNo</label>
								<div class="col-sm-3">
									<input type="text" class="form-control tooltips" id="txtOnlineTransactionNo" name="txtOnlineTransactionNo" placeholder="Eg:10000" title="Online Payment Transaction Number">
								</div>
							</div>-->
							
							<div class="form-group">
								<label for="" class="col-sm-2 control-label">Counselling Application Period</label>
								<div class="col-sm-10">
									<input type="text" class="form-control tooltips datepicker" id="txtCounsellingDate" name="txtCounsellingDate"  title="Counselling Date">
								</div>
							</div>
							<div class="form-group">
								<label for="" class="col-sm-2 control-label">Temporary Allotment Period</label>
								<div class="col-sm-10">
									<input type="text"  class="form-control tooltips timepicker" id="txtAppDate" name="txtAppDate"  title="Apply Date">
								</div>
							</div>
							<div class="form-group">
								<label for="" class="col-sm-2 control-label">Locking Period</label>
								<div class="col-sm-10">
									<input type="text"  class="form-control tooltips datepicker" id="txtChoiceLockDate" name="txtChoiceLockDate"  title="Choice Lock Date">
								</div>
							</div>
							<!--<div class="form-group">
								<label for="" class="col-sm-2 control-label">Status</label>
								<div class="col-sm-10">
									<select class="form-control" id="cmbStatus" name="cmbStatus">
										<option value="">Select</option>
										<option value="Active">Active</option>
										<option value="Inactive">Inactive</option>
									</select>
								</div>
							</div>-->
							<div class="form-group">
								<label for="" class="col-sm-2 control-label">Publish Status</label>
								<div class="col-sm-10">
									<select class="form-control" id="cmbPublishStatus" name="cmbPublishStatus">
										<option value="">Select</option>
										<option value="YES">Yes</option>
										<option value="NO">No</option>
									</select>
								</div>
							</div>
							
							<div class="modal-footer">
							<span id="spanProcessingProgram" style="display: none">Processing... <img src="../images/bx_loader.gif" /></span>
								<button type="submit" class="btn btn-primary" id="programaddsave">Save</button>
								<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>  
							</div>
						</form>
					</div>	
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
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin_counselling/counselling_setup.js"></script>

   