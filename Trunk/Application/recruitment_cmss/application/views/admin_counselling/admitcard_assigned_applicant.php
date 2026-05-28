<?php
	$sel_program = $program_code;
	$sel_exam_center = $assigned_exam_center_code;
	$sel_exam_vanue = $exam_vanue;
?>
<div id="page-wrapper" style="min-height: 700px !important;">
	<div class="row">
	    <div class="col-lg-12 col-sm-12 page-header" style="background-color: #9fc6f9; padding-top: 12px">
			<label for="" class="col-sm-3 control-label" style="text-align:left;font-size:18px;">Program : 
			<p id="program"></p></label>
			<label for="" class="col-sm-5 control-label" style="text-align:left; font-size:18px;">Assigned Exam Center : 
			<p id="exam_centre"></p></label>
			<label for="" class="col-sm-4 control-label" style="text-align:left;font-size:18px;">Assigned Exam Venue : 
			<p id="exam_venue"></p>
			</label>
		</div>
	</div>
	<form class="form-horizontal"  role="form" id="frmAdmitCard" name="frmAdmitCard" method="post" action="" enctype="multipart/form-data">
		<input type="hidden" id = "sel_program" value="<?=$sel_program ?>"/>
		<input type="hidden" id = "sel_exam_center" value="<?=$sel_exam_center ?>"/>
		<input type="hidden" id = "sel_exam_vanue" value="<?=$sel_exam_vanue ?>"/>
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
		   	<div class="col-lg-12 col-sm-12" style="height:440px; width:99%; overflow-y: scroll;" id="divApplicantList">
		   		<!--<div class="form-group">
					<table class="table table-responsive table-bordered" id="tblApplicants">
						<thead>
						<tr>
							<th>
								Sl No
								<input type="checkbox" id="chkSelectAll" name="chkSelectAll"/>
							</th>
							<th>Name</th>
							<th>Appl No</th>
							<th>Applied On</th>
							<th>Fee Paid Mode</th>
							<th>Amount</th>
							<th>Fee Paid On</th>
							<th>Receipt No</th>
							<th>Applied</th>
							<th>Assigned</th>
							<th>OMR</th>
							<th>Photo</th>
							<th>Signature</th>
						</tr>
						</thead>
						<tbody id="applicantBody">

					</tbody>							
					</table>
				</div>-->
			</div><!--/col-->
		</div><!--/row-->
		<div class="row">
			<div class="col-lg-12 col-sm-12" style="background-color: #9fc6f9; padding-top: 2px">

				<div class="form-group" id="successDiv">
					<!--<div class='alert alert-dismissable alert-success'>
						<button type='button' class='close' data-dismiss='alert'>&times;</button>
						<p style="font-size:14px;">Admit Card published successfully.</p>
					</div>-->
				</div>

				
				<div class="form-group" style="margin-top: 10px">
					<label class="col-sm-2 control-label" for="spanCapacity" style="font-size:16px;" >Now Publish:</label>
					<div class="col-sm-2">
						<div class="oval2" style="background-color: green; float: left;"><span id="spanNowPublish"></span></div>
					</div>
					<div class="col-sm-2">
						<button type="button" class="btn btn-info custombtn" id="btnPublish" onClick="return checkStatus();" name="btnPublish">Publish</button>
					</div>
				</div>
			</div>
		</div><!--/row-->
	</form>
</div>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin/admitcard_assigned_applicant.js"></script>