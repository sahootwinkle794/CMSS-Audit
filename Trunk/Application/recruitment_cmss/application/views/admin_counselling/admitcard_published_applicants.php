<?php
	$sel_program = $program_code;
	$sel_exam_center = $assigned_exam_center_code;
	$sel_exam_vanue = $exam_vanue;
?>
<div id="page-wrapper" style="min-height: 700px !important;">
	<div class="row">
	    <div class="col-lg-12 col-sm-12 page-header" style="background-color: #9fc6f9; padding-top: 12px">
			<label for="" class="col-sm-3 control-label" style="text-align:left;font-size:16px;">Program: 
			<p id="program"></p></label>
			<label for="" class="col-sm-4 control-label" style="text-align:left; font-size:16px;">Assigned Exam Center: 
			<p id="exam_centre"></p></label>
			<label for="" class="col-sm-5 control-label" style="text-align:left;font-size:16px;">Assigned Exam Venue: 
			<p id="exam_venue"></p>
		</div>
	</div>
	<form class="form-horizontal"  role="form" id="frmAdmitCard" name="frmAdmitCard" method="post" action="" enctype="multipart/form-data">
		<input type="hidden" id = "sel_program" value="<?=$sel_program ?>"/>
		<input type="hidden" id = "sel_exam_center" value="<?=$sel_exam_center ?>"/>
		<input type="hidden" id = "sel_exam_vanue" value="<?=$sel_exam_vanue ?>"/>
		<div class="row">
		   	<div class="col-lg-12 col-sm-12" style="height:440px; width:99%; overflow-y: scroll;" id="divApplicantList">
		   		<!--<div class="form-group">
					<table class="table table-responsive table-bordered" id="tblApplicants">
						<thead>
						<tr>
							<th>
								Sl No
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
					<div class="form-group" style="margin-top: 10px">
						<label class="col-sm-1 control-label" for="cmbExamCenter" style="font-size:16px;" >From Sl:</label>
						<div class="col-sm-1">
							<input type="text" class="form-control" name="txtFromSlNo" id="txtFromSlNo" />
						</div>
						<label class="col-sm-1 control-label" for="cmbExamCenter" style="font-size:16px;" >To Sl:</label>
						<div class="col-sm-1">
							<input type="text" class="form-control" name="txtToSlNo" id="txtToSlNo" />
						</div>
						<div class="col-sm-1">
							<button type="button" class="btn btn-info custombtn" id="btnExcel1" name="btnExcel1">Report</button>
						</div>
						<div class="col-sm-3">
							<button type="button" class="btn btn-info custombtn" id="btnExcel2" name="btnExcel2">Report (with photo &amp; signature)</button>
						</div>
						<div class="col-sm-2">
							<button type="button" class="btn btn-info custombtn" id="btnPrintAdmitCard" name="btnPrintAdmitCard">Download Admit Card</button>
						</div>
						<div class="col-sm-2">
							<button type="button" class="btn btn-info custombtn" id="btnSaveAdmitCard" name="btnSaveAdmitCard">Save a Copy</button>
						</div>
					</div>
			</div>
		</div><!--/row-->
	</form>
</div>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin/admitcard_published_applicants.js"></script> 