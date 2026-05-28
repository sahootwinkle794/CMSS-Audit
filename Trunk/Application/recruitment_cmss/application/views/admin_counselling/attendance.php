<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/template_lib/plugins/datepicker/datepicker3.css" />
<link href="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" media="screen" />
<div id="page-wrapper">
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Students Attendance</h1>
        </div>
    	<!-- /.col-lg-12 -->
	</div>
    <!-- Main content -->
    <section class="content">
		<div class="row">
			
			<form class="form-horizontal"  role="form" id="assignform" name="assignform" action="">
				
				<div class="form-group">
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
					
					<label class="col-sm-2 control-label" for="cmbNodalCenter" style="font-size:16px;" >Nodal Center:</label>
					<div class="col-sm-2">
						<select class="form-control" name="cmbNodalCenter" id="cmbNodalCenter">		
							
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-1 control-label" style="font-size:16px;">Date:</label>
					<div class="col-sm-2">
						<select class="form-control" id="cmbDate" name="cmbDate">
							<option value="">Select</option>
						</select>
					</div>
					<div class="col-md-2"><span id="spanProcessingExam" style="display: none"><img src="../images/bx_loader.gif" /></span></div>
				</div>
				<div class="row">
					<div class="col-lg-12 col-sm-12" style="background-color: #9cabfe; padding: 5px; ">
						
						<div class="col-lg-4" style="border-radius: 5px;">
							<div class="col-lg-2 col-sm-2" style="width:65%;">
								<input type="text"  class="form-control" id="txtAdmNo" name="txtAdmNo" placeholder="Enter JEE Roll No" >
							</div>
							<div class="col-lg-1 col-sm-1">
								<button type="button" class="btn btn-info custombtn" id="btnSearch"><i class="fa fa-search"></i> Search</button>
							</div>	
						</div>
					</div><!--/col-->
				</div><!--/row-->
				<div class="row">
				   	<div class="col-lg-9" style="height:440px; overflow: auto;" id="divApplicantList">
						
							
					</div><!--/col-->
					<div id="divAssignedCounterApplicants" class="col-lg-3" style="font-size:12px;text-align: right; padding-right: 30px;">
						
					</div>
				</div><!--/row-->
				<div class="row">
					<div class="col-lg-12 col-sm-12" style="background-color: #9fc6f9; padding-top: 2px">
							
								<div class="form-group" id="successDiv">
								</div>
							
							
					</div>
				</div><!--/row-->
			</form>
			
		</div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<link href="<?php echo base_url(); ?>public/css/datepicker3.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datepicker/bootstrap-datepicker.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/daterangepicker/moment.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin_counselling/attendance.js"></script>

   