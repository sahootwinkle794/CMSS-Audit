<?php
	$sel_program = $program_code;
	$sel_exam_center = $assigned_exam_center_code;
	$sel_exam_vanue1 = $exam_vanue;
	$round_data = $round_data;
	$sel_exam_vanue = str_replace("_", "/", $sel_exam_vanue1);
?>
<style>
		.alignCenter { text-align: center; }
		#page-wrapper {
			margin: 0 0 0 0px;
		}
		#statusTable{
		    margin-bottom: 5px;
		    color: #496CAD;
		 }
		 #statusTable tr td{
		    border:4px solid #D3DABE;
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
		 .navbar-custom-menu > .navbar-nav > li {

		    position: relative;
		    display: none;

		}
</style>
<body class="sidebar-collapse"></body>
<div id="page-wrapper" style="min-height: 700px !important;">
	<div class="row">
	   <div class="col-lg-12 col-sm-12 page-header" style="background: #fff; margin-top:40px;background-image: none; background-image: linear-gradient(to bottom, #f3f8f9 20%, #d9f9f4 80%, #caf5ef 100%); color: #333"; padding-top: 12px">
			<label for="" class="col-sm-3 control-label" style="text-align:left;font-size:16px;">Post: 
			<p id="program"></p></label>
			<label for="" class="col-sm-4 control-label" style="text-align:left; font-size:16px;">Assigned Exam Center: 
			<p id="exam_centre"></p></label>
			<label for="" class="col-sm-5 control-label" style="text-align:left;font-size:16px;">Assigned Exam Venue: 
			<p id="exam_venue"></p></label>
			
		</div>
		<div class="col-sm-3">
				<div class="col-sm-9">
					<label class="control-label" for="txtCapacity" style="font-size:16px;" >Total Applicant:</label>
				</div>
			 	<div class="col-sm-3" style="padding: 0px;margin-top: 4px;">
			 		<div class="oval2" style="background-color: green; float: left;margin-left: 0px"><span id="btnTotalcount" name="btnTotalcount"></span></div>
			 	</div>
					 	
			</div>
	</div>
	<form class="form-horizontal"  role="form" id="frmAdmitCard" name="frmAdmitCard" method="post" action="" enctype="multipart/form-data">
		<input type="hidden" id = "sel_program" value="<?=$sel_program ?>"/>
		<input type="hidden" id = "sel_exam_center" value="<?=$sel_exam_center ?>"/>
		<input type="hidden" id = "sel_exam_vanue" value="<?=$sel_exam_vanue ?>"/>
		<input type="hidden" id = "round_data" value="<?=$round_data ?>"/>
		<div class="row">
		<div class="panel panel-default" style="margin-left: 50px; max-width: 1160px;">
			<div class="panel-body box box-default" style="max-width: 1160px;">
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
		</div>
		</div>
		</div><!--/row-->
		<div class="row">
			<div class="col-lg-12 col-sm-12" style="background: #fff; background-image: none; margin-bottom: 20px; background-image: none; background-image: linear-gradient(to bottom, #f3f8f9 20%, #d9f9f4 80%, #caf5ef 100%); color: #333; padding: 5px;; padding-top: 2px">
					<div class="form-group" style="margin-top: 10px">
						<label class="col-sm-1 control-label" for="cmbExamCenter" style="font-size:16px;" >From Sl:</label>
						<div class="col-sm-1">
							<input type="text" class="form-control" name="txtFromSlNo" id="txtFromSlNo" />
						</div>
						<label class="col-sm-1 control-label" for="cmbExamCenter" style="font-size:16px;" >To Sl:</label>
						<div class="col-sm-1">
							<input type="text" class="form-control" name="txtToSlNo" id="txtToSlNo" />
						</div>
						<div class="col-sm-2">
							<button type="button" class="btn btn-info custombtn" id="btnExcel12" name="btnExcel12">Roll Sheet(Excel)</button>
						</div>
						<div class="col-sm-3">
							<button type="button" class="btn btn-info custombtn" id="btnpdfl2" name="btnpdfl2" style="margin-left: -7%;">Attendance Sheet(PDF)</button>
						</div>	
						<!--<div class="col-sm-1">
							<button type="button" class="btn btn-info custombtn" id="btnExcel1" name="btnExcel1">Report</button>
						</div>
						<div class="col-sm-3">
							<button type="button" class="btn btn-info custombtn" id="btnExcel2" name="btnExcel2">Report (with photo &amp; signature)</button>
						</div>-->
						<div class="col-sm-2">
							<button type="button" class="btn btn-info custombtn" id="btnPrintAdmitCard" name="btnPrintAdmitCard">Download Admit Card</button>
						</div>
						<!--<div class="col-sm-2">
							<button type="button" class="btn btn-info custombtn" id="btnSaveAdmitCard" name="btnSaveAdmitCard">Save a Copy</button>
						</div>-->
					</div>
			</div>
		</div><!--/row-->
	</form>
</div>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin/admitcard_published_applicants.js"></script> 