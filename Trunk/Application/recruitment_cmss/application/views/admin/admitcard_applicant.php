	<?php
		$sel_program = $program_code;
		$sel_exam_center = '';
		$application_date = $applied_date;
		$application_date = $application_date;
		$round_data = $round_data;
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
		table.dataTable thead .sorting::after{
			content:none;
		}
		
		.navbar-custom-menu > .navbar-nav > li {

		    position: relative;
		    display: none;

		}
		/*.exited {
			background-color: #4396E8 !important;
		}*/
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
		#studentattendancedetails_wrapper{
			width:98%;
		}
		.loadingRPimage {
	    position: fixed;
	    top: 0;
	    left: 0;
	    height: 100vh; /* to make it responsive */
	    width: 100vw; /* to make it responsive */
	    overflow: hidden; /*to remove scrollbars */
	    z-index: 99999; /*to make it appear on topmost part of the page */
	    display: none; /*to make it visible only on fadeIn() function */
	    background: none repeat scroll 0% 0% rgba(104, 136, 164, 0.44); /*to make background blur */
	    text-align:center;
	}
		</style>
	<div id="page-wrapper" style="min-height: 700px !important;">
	<div class="loadingRPimage">
		<img src="<?=base_url()?>upload/image/loader/loader2.gif"/>
	</div>
		<div class="row">
		    <div class="col-lg-12 col-sm-12 page-header" style="background: #fff; margin-top:40px;background-image: none; background-image: linear-gradient(to bottom, #f3f8f9 20%, #d9f9f4 80%, #caf5ef 100%); color: #333"; padding-top: 12px">
				<label for="" class="col-sm-2 control-label" style="text-align:left;font-size:18px;">Post :
				<p id="program"></p></label>
				<label for="" class="col-sm-2 control-label" style="text-align:left;font-size:18px;">Applied Upto : 
				<p id="applied_upto"></p></label>
				<div class="col-sm-8">
						<div class="col-sm-4 form-group">
							<label>Choice 1</label>

							<select class="form-control" name="center_name1" id="center_name1">
								<option value="">Select Preference</option>							 
							</select>

						</div>

						<div class="col-sm-4 form-group">
							<label>Choice 2</label>

							<select class="form-control" name="center_name2" id="center_name2">
								<option value="">Select Preference</option>									 
							</select>
						</div>

						<div class="col-sm-4 form-group">
							<label>Choice 3</label>
							<select class="form-control" name="center_name3" id="center_name3">
								<option value="">Select Preference</option>									 
							</select>
						</div>
					</div>
				<!--<label for="" class="col-sm-5 control-label" style="text-align:left; font-size:18px;">Applied Exam Center : 
				<p id="exam_center"></p></label>-->
			</div>
		</div>
		
		<form class="form-horizontal"  role="form" id="assignform" name="assignform" action="">
			<input type="hidden" id = "sel_program" value="<?=$sel_program ?>"/>
			<input type="hidden" id = "exam_centre" value="<?=$sel_exam_center ?>"/>
			<input type="hidden" id = "applied_date" value="<?=$application_date ?>"/>
			<input type="hidden" id = "round_data" value="<?=$round_data ?>"/>
			<center>
			<div class="row">
			
				<div class="col-lg-12 col-sm-12" style="background: #fff;margin-bottom: 20px; background-image: none; background-image: linear-gradient(to bottom, #f3f8f9 20%, #d9f9f4 80%, #caf5ef 100%); color: #333; padding: 5px; ">
					<div class="col-sm-2">
						<button type="button" class="btn btn-info custombtn" id="btnRandomize" name="btnRandomize" onClick="return Randomize();">Randomize</button>
					</div>
					 <div style="float: left;" class="col-sm-7">
					    <b>From Sl No:</b> &nbsp;&nbsp;<input id="txtFromSlNo" style="height: 30px; width:100px;vertical-align: middle;" placeholder="From Sl No" />
						<b>To Sl No:</b> &nbsp;&nbsp;<input id="txtToSlNo" style="height: 30px; width:100px;vertical-align: middle;" placeholder="To Sl No" />
					 	<button type="button" class="btn btn-primary" value="Mark" id="btnMark">Mark Applicants</button>
					 </div>
					 <div class="col-sm-3">
					 <div class="col-sm-9">
					 	<label class="control-label" for="txtCapacity" style="font-size:16px;" >Total Applicant:</label>
					 </div>
					 	<div class="col-sm-3" style="padding: 0px;margin-top: 4px;">
					 		<div class="oval2" style="background-color: green; float: left;margin-left: 0px"><span id="btnTotalcount" name="btnTotalcount"></span></div>
					 	</div>
					 	
					 </div>
					<!-- <div class="col-sm-2">
					 	<div class="oval2" style="background-color: red; float: left;margin-left: 5px"><span id="btnTotalcount" name="btnTotalcount"></span></div>
					 </div>-->	
						<!--<button type="button" class="btn btn-info custombtn" id="btnTotalcount" name="btnTotalcount"></button>-->
				</div>
			<!--/col-->
			</div><!--/row-->
			</center>
			<div class="row">
			<div class="panel panel-default" style="margin-left: 50px;">
			<div class="panel-body box box-default" >
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
						
				</div>
				</div>
				</div><!--/col-->
			</div><!--/row-->
			<div class="row">
				<div class="col-lg-12 col-sm-12" style="background: #fff; background-image: none; margin-bottom: 20px; background-image: none; background-image: linear-gradient(to bottom, #f3f8f9 20%, #d9f9f4 80%, #caf5ef 100%); color: #333; padding: 5px;; padding-top: 2px">
						
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
						
							<!--<label class="col-sm-2 control-label" for="cmbExamVanue" style="font-size:16px;" >Exam Venue:</label>
							<div class="col-sm-3">
								<select class="form-control" name="cmbExamVanue" id="cmbExamVanue">			
								</select>
							</div>
							<div class="col-md-1"><span id="spanProcessingExamVanue" style="display: none"><img src="<?=base_url()?>public/assets/images/bx_loader.gif" /></span></div>
							<div class="col-md-2"><span id="spanProcessingExam" style="display: none"><img src="<?=base_url()?>public/assets/images/bx_loader.gif" /></span></div>
							-->
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
		
	<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin/admitcard_applicant.js?v=<?= rand(); ?>"></script>