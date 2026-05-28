	<?php
		$sel_program = $program_code;
		$sel_exam_center = $exam_centre;
		$application_date = $applied_date;
		$application_date = str_replace("-","/",$application_date);
	?>
	<div id="page-wrapper" style="min-height: 700px !important;">
		<div class="row">
		    <div class="col-lg-12 col-sm-12 page-header" style="background-color: #9fc6f9; padding-top: 12px">
				<label for="" class="col-sm-3 control-label" style="text-align:left;font-size:18px;">Program :
				<p id="program"></p></label>
				<label for="" class="col-sm-5 control-label" style="text-align:left; font-size:18px;">Applied Exam Center : 
				<p id="exam_center"></p></label>
				<label for="" class="col-sm-4 control-label" style="text-align:left;font-size:18px;">Applied Upto : 
				<p id="applied_upto"></p></label>
			</div>
		</div>
		<form class="form-horizontal"  role="form" id="assignform" name="assignform" action="">
			<input type="hidden" id = "sel_program" value="<?=$sel_program ?>"/>
			<input type="hidden" id = "exam_centre" value="<?=$sel_exam_center ?>"/>
			<input type="hidden" id = "applied_date" value="<?=$application_date ?>"/>
			<div class="row">
				<div class="col-lg-12 col-sm-12" style="background-color: #9cabfe; padding: 5px; ">
					 <div style="float: left; margin-left: 30%">
					    <b>From Sl No:</b> &nbsp;&nbsp;<input id="txtFromSlNo" style="height: 30px; width:100px;vertical-align: middle;" placeholder="From Sl No" />
						<b>To Sl No:</b> &nbsp;&nbsp;<input id="txtToSlNo" style="height: 30px; width:100px;vertical-align: middle;" placeholder="To Sl No" />
					 	<button type="button" class="btn btn-primary" value="Mark" id="btnMark">Mark Applicants</button>
					 </div>
				</div><!--/col-->
			</div><!--/row-->
			<div class="row">
			   	<div class="col-lg-12 col-sm-12" style="height:440px; width:100%; overflow-y: scroll;" id="divApplicantList">
					<!--<table class="table table-bordered" id="tblApplicantDetails">
						<thead>
							<tr>
								<th>
									#
									<input type="checkbox" id="chkSelectAll" name="chkSelectAll"/>
								</th>
								<th class="text-center">Name</th>
								<th class="text-center">Mobile No</th>
								<th class="text-center">Appl No</th>
								<th class="text-center">Applied On</th>
								<th class="text-center">Fee Paid Mode</th>
								<th class="text-center">Amount</th>
								<th class="text-center">Fee Paid On</th>
								<th class="text-center">Receipt No</th>
								<th class="text-center">Photo</th>
								<th class="text-center">Signature</th>
							</tr>
						</thead>
						<tbody id="applicantBody">
						</tbody>
					</table>-->
						
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
							<label class="col-sm-2 control-label" for="cmbExamCenter" style="font-size:16px;" >Exam Center:</label>
							<div class="col-sm-3">
								<select class="form-control" name="cmbExamCenter" id="cmbExamCenter">			
								</select>
							</div>
							<div class="col-md-2"><span id="spanProcessingExam" style="display: none"><img src="../images/bx_loader.gif" /></span></div>
							<label class="col-sm-2 control-label" for="cmbExamVanue" style="font-size:16px;" >Exam Venue:</label>
							<div class="col-sm-2">
								<select class="form-control" name="cmbExamVanue" id="cmbExamVanue">			
								</select>
							</div>
							<div class="col-md-1"><span id="spanProcessingExamVanue" style="display: none"><img src="../images/bx_loader.gif" /></span></div>
							
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
	<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin/admitcard_applicant.js"></script>