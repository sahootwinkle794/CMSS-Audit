<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/template_lib/plugins/datepicker/datepicker3.css" />
<link href="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" media="screen" />
<style>
	.oval {
		  -webkit-box-sizing: content-box;
		  -moz-box-sizing: content-box;
		  box-sizing: content-box;
		  width: 200px;
		  height: 100px;
		  border: none;
		  -webkit-border-radius: 50%;
		  border-radius: 50%;
		  font: normal 100%/normal Arial, Helvetica, sans-serif;
		  color: rgba(0,0,0,1);
		  -o-text-overflow: clip;
		  text-overflow: clip;
		  background: #1abc9c;
		}
		.oval2{
			width: 70px; height: 30px;; 
			-moz-border-radius: 100px / 50px; 
			-webkit-border-radius: 100px / 50px; 
			border-radius: 100px / 50px;
			font-size: 15px;
			font-weight: bold;
			color:white;
			text-align: center;
			vertical-align: middle;
			padding-top: 5px;
		}
</style>
<div id="page-wrapper">
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Students Alloted</h1>
        </div>
    	<!-- /.col-lg-12 -->
	</div>

    <!-- Main content -->
    <section class="content">
		<div class="row">
			
			<form class="form-horizontal"  role="form" id="assignform" name="assignform" action="">
				
				<div class="form-group">
					<label for="" class="col-sm-2 control-label" style="font-size:16px;">Year:</label>
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
					
					
				</div>
				
				<div class="form-group">
					<label for="" class="col-sm-2 control-label" style="font-size:16px;">Program:</label>
					<div class="col-sm-2">
						<select class="form-control" id="cmbProgram" name="cmbProgram">
							
						</select>
					</div>
				
					<label class="col-sm-2 control-label" style="font-size:16px;" >Branch:</label>
					
					<div class="col-sm-2">
						<select class="form-control" name="cmbBranch" id="cmbBranch">			
							<option value="">Select</option>		
						</select>
					</div>
					
					
				</div>
				<!--<div class="form-group">
					<label for="" class="col-sm-2 control-label">Publish Status</label>
					<div class="col-sm-2">
						<select class="form-control" id="cmbPublishStatus" name="cmbPublishStatus">
							<option value="">Select</option>
							<option value="YES">Yes</option>
							<option value="NO">No</option>
						</select>
					</div>
				</div>-->
							
				<!--<input type="hidden" id = "sel_program" value="<?=$sel_program ?>"/>
				<input type="hidden" id = "exam_centre" value="<?=$sel_exam_center ?>"/>
				<input type="hidden" id = "applied_date" value="<?=$application_date ?>"/>-->
				<div class="row">
					<div class="col-lg-12 col-sm-12" style="background-color: #9cabfe; padding: 5px; ">
						<div style="float: left; margin-left: 2%">
						    <b>From Sl No:</b> &nbsp;&nbsp;<input id="txtFromSlNo" style="height: 30px; width:100px;vertical-align: middle;" placeholder="From Sl No" />
							<b>To Sl No:</b> &nbsp;&nbsp;<input id="txtToSlNo" style="height: 30px; width:100px;vertical-align: middle;" placeholder="To Sl No" />
						 	<button type="button" class="btn btn-primary" value="Mark" id="btnMark">Mark Applicants</button>
						</div>
						<div class="col-lg-4" style="border-radius: 5px;float: left;">
							<div class="col-lg-2 col-sm-2" style="width:65%;">
								<input type="text"  class="form-control" id="txtAdmNo" name="txtAdmNo" placeholder="Enter JEE Roll No" >
							</div>
							<div class="col-lg-1 col-sm-1">
								<button type="button" class="btn btn-info custombtn" id="btnSearch"><i class="fa fa-search"></i> Search</button>
							</div>	
						</div>
					</div><!--/col-->
					<div class="col-lg-12 col-sm-12" style="background-color: #9cabfe; padding: 5px; ">
						<div class="col-lg-4" style="border-radius: 5px;float: left; margin-left: -1%" >
						  	<label class="col-sm-2 control-label" for="txtCenterCode"  style="height: 30px; width:100px;vertical-align: middle;">Percentage</label>
							<div class="col-lg-1 col-sm-1" style="width:50%; margin-left: 2%"">
								<input type="text"  class="form-control" id="txtPercentage" name="txtPercentage" placeholder="Percentage" >
							</div>
							 
							<div class="col-lg-1 col-sm-1">
								<button type="button" class="btn btn-info custombtn" id="btnFilter"><i class="fa fa-search"></i> Filter</button>
							</div>	
						</div>
					</div><!--/col-->
				</div><!--/row-->
				<div class="row">
				   	<div class="col-lg-12 col-sm-12" style="height:440px; width:100%; overflow-y: scroll;" id="divApplicantList">
						
							
					</div><!--/col-->
				</div><!--/row-->
				<div class="row">
					<div class="col-lg-12 col-sm-12" style="background-color: #9fc6f9; padding-top: 2px">
							
								<div class="form-group" id="successDiv">
									<!--<div class='alert alert-dismissable alert-success'>
										<button type='button' class='close' data-dismiss='alert'>&times;</button>
										<p style="font-size:14px;">Center allocated successfully.</p>
									</div>-->
								</div>
							
							<div class="form-group">
								<label class="col-sm-2 control-label" for="cmbNodalCenter" style="font-size:16px;" >Nodal Center:</label>
								<div class="col-sm-3">
									<select class="form-control" name="cmbNodalCenter" id="cmbNodalCenter">	
										
									</select>
								</div>
								
								<label for="" class="col-sm-2 control-label" style="font-size:16px;">Date:</label>
								<div class="col-sm-2">
									<select class="form-control" id="cmbDate" name="cmbDate">
										<option value="">Select</option>	
									</select>
								</div>
								<div class="col-md-2"><span id="spanProcessingExam" style="display: none"><img src="../images/bx_loader.gif" /></span></div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="txtCenterCode"  style="font-size:16px;">Counselling From Date:</label>
								
								<div class="col-sm-3">
									<input type="text"  class="form-control tooltips" id="txtFromDate" name="txtFromDate">
								</div>
								
								<label class="col-sm-2 control-label" for="txtCenterCode"  style="font-size:16px;">Counselling To Date:</label>
								
								<div class="col-sm-3">
									<input type="text"  class="form-control tooltips" id="txtToDate" name="txtToDate">
								</div>
								<div class="col-md-2"><span id="spanProcessingExam" style="display: none"><img src="../images/bx_loader.gif" /></span></div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="txtCapacity" style="font-size:16px;" >Available/Capacity:</label>
								<div class="col-sm-3">
									<input type="hidden" class="form-control" name="hidCapacity" id="hidCapacity"/>
									<input type="hidden" class="form-control" name="hidAssigned" id="hidAssigned"/>
									<div class="oval2" style="background-color: red; float: left;margin-left: 5px"><span id="spanCapacity"></span></div>
								</div>
								<label class="col-sm-2 control-label" for="spanCapacity" style="font-size:16px;" >Now Assign:</label>
								<div class="col-sm-2">
									<div class="oval2" style="background-color: green; float: left;"><span id="spanNowAssign"></span></div>
								</div>
								
								
								<div class="col-sm-2">
									<button type="button" class="btn btn-info custombtn" id="btnAssign" name="btnAssign" onClick="return checkStatus();">Assign</button>
								</div>
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
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin_counselling/allotment.js"></script>

   