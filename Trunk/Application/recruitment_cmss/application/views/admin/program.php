<link  rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery-ui.css"/>
<link href="<?php echo base_url(); ?>public/assets/css/datetimepickercss.css" />
<!--<link  rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery-ui.css"/>
<link rel="stylesheet" media="all" type="text/css" href="<?php echo base_url(); ?>public/assets/js/jquery-ui-timepicker-addon.css"/>-->
<!--<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/template_lib/plugins/datepicker/datepicker3.css" />-->
<!--<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/template_lib/plugins/jquery-ui-1.11.4/jquery-ui.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/template_lib/plugins/jquery-ui-1.11.4/jquery-ui.theme.min.css" />-->
<!--<link href="<?php echo base_url(); ?>public/assets/js/timeline/timeline.css" rel="stylesheet /">-->
<style>
	h5{
		font-weight: bold;
		color: blue;
	}
	.form-horizontal {
	    padding: 0px 10px 3px 35px;
	}
</style>

<div class="content-wrapper">
	<div class="row">
		<br />
		<div class="col-lg-12">
			<!--<div class="panel with-nav-tabs panel-primary">
				<div class="panel-heading">-->
				<div class="nav-tabs-custom box box-default">
					<ul class="nav nav-tabs" role="tablist">
						<li id ="new_tab" class="active"><a href="#new" data-toggle='tab'>Current</a></li>
						<li id ="old_tab"><a href="#old" data-toggle='tab'>Previous</a></li>
						<li id ="additional_tab"><a href="#additional" data-toggle='tab'>Additional Setup</a></li>
					</ul>
				<!--</div>
				<div class="panel-body">-->
					<div class="tab-content">
						<div class="chart tab-pane in active" id="new">
							<div>
								<input type="hidden" class="form-control" id="hidProgram12" name="hidProgram12">
								<table class="table table-striped table-bordered"   id="tblProgramMaster" width="100%">
									<thead>
										<tr>
											<th >#</th>
											<th >Drive Code</th>
											<th >Code</th>
											<th >Name</th>
											<th >Name</th>
											<th >Name</th>
											<th >Year</th>
											<th >Appl. Slno</th>
											<th >Template</th>
											<th >Apply Start Date</th>
											<th >Apply End Date</th>
											<th >Publish Status</th>
											<th >Action</th>
											
										</tr>
									</thead>
									<tbody>

									</tbody>
								</table>
							</div> 
							<!--<button type="submit" class="btn btn-success" id="btnCopyProgram"><i class="fa fa-refresh" aria-hidden="true">&nbsp;Copy</i></button>
							<button type="submit" class="btn btn-warning" id="btnPublishProgram"><i class="fa fa-check-square-o" aria-hidden="true">&nbsp;Review & Publish</i></button>-->
						</div>
						<div class="chart tab-pane" id="old"> 
							<form class="form-horizontal" name = "formYear" id = "formYear">
								<div class="form-group">
									<label for="" class="col-sm-2 control-label">Year :</label>
									<div class="col-sm-2">
										<select class="form-control" id="cmbYear" name="cmbYear">
											
										</select>
									</div>
								</div>
							</form>
							<table class="table table-striped table-bordered"  id="tblProgramMasterOld" width="100%">
								<thead>
									<tr>
										<!--<th >Sl No</th>
										<th >Program Code</th>
										<th >Program Name</th>
										<th >Year</th>
										<th >Application Slno</th>
										<th >Online Payment Transaction No</th>
										<th >OMR Sl no.</th>
										
										<th >Template</th>
										<th >Program Start Date</th>
										<th >Program End Date</th>
										<th >Program Date</th>
										<th >Apply Start Date</th>
										<th >Apply End Date</th>
										<th >Apply Date</th>
										<th >ID</th><!-- id will be hide -->
										<!-- <th >template_code</th><!-- id will be hide -->
										<!-- <th >Program Group</th>
										<th >Elective Subjects</th>
										<th >Publish Status</th>
										<th >Sequence Code</th>
										<th >Sequence no.</th>
										<th >Birth Start Date</th>
										<th >Birth End Date</th>-->
										<th >#</th>
										<th >Group</th>
										<th >Code</th>
										<th >Name</th>
										<th >Year</th>
										<th >Appl. Slno</th>
										<!--<th >Online Payment Transaction No</th>
										<th >OMR Sl no.</th>-->
										<th >Template</th>
										<th >Post Start Date</th>
										<th >Post End Date</th>
										<!--<th >Program Date</th>-->
										<!--<th >Apply Start Date</th>
										<th >Apply End Date</th>
										<th >Apply Date</th>-->
										<!--<th >ID</th><!-- id will be hide -->
										<!--<th >template_code</th>--><!-- id will be hide -->
										<!--<th >Program Group</th>
										<th >Elective Subjects</th>-->
										<th >Publish Status</th>
										<th >Action</th>
										<!--<th >Sequence Code</th>
										<th >Sequence no.</th>
										<th >Birth Start Date</th>
										<th >Birth End Date</th>-->
									</tr>
								</thead>
								<tbody>

								</tbody>
							</table>
							
						</div>
						<div class="chart tab-pane" id="additional">
							<div>
								<table class="table table-striped table-bordered"   id="tblProgramAdditional" width="100%">
									<thead>
										<tr>
											<th >#</th>
											<th >Program Code</th>
											<th >Post</th>
											<th >Classification</th>
											<th >Ministry/Administration</th>
											<th >Department/Office</th>
											<th >Organisation</th>
											<th >Pay Scale</th>
											<th >Age</th>
											<th >Essential Qualificaiton (s)</th>
											<th >Desirable Qualificaiton (s)</th>
											<th >Duty(ies)</th>
											<th >Probation</th>
											<th >Head Quarter</th>
											<th >Other Details</th>
											<th >Link</th>
											<th >Link Path</th>
											<th >Action</th>
											
										</tr>
									</thead>
									<tbody>

									</tbody>
								</table>
							</div> 
							<!--<button type="submit" class="btn btn-success" id="btnCopyProgram"><i class="fa fa-refresh" aria-hidden="true">&nbsp;Copy</i></button>
							<button type="submit" class="btn btn-warning" id="btnPublishProgram"><i class="fa fa-check-square-o" aria-hidden="true">&nbsp;Review & Publish</i></button>-->
						</div>
					</div>
				</div>
				<!--</div>
			</div>-->
			<div class="modal fade" id="programAddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
								&times;
							</button>
							<h4 class="modal-title" id="myModalLabel">Add Post</h4>
						</div>
						<div class="modal-body">
							<form class="form-horizontal" role="form"  id="frmAddProgram" name="frmAddProgram">
								<!--<input type="hidden" id="hidSessionCode" name="hidSessionCode" value="<?=$MY_SESSION_NAME?>"/>-->
								<input type="hidden" class="form-control" id="hidUniqueid" name="hidUniqueid">
								<input type="hidden" class="form-control" id="txtYear" name="txtYear">
								<!--<input type="hidden" class="form-control" id="txtOmrNo" name="txtOmrNo">-->
								<div class="row col-sm-12 col-xs-12 ">
									<div class="col-sm-6 col-xs-6">
										<h5>Post Details:</h5>
										<div class="form-group">
											<label for="inputname" class="col-sm-4 control-label"><i style="color:red;font-size:18px;">*</i> Drive</label>
											<div class="col-sm-8">
												<select class="form-control" id="cmbProgramGroup" name="cmbProgramGroup">
													<!--<option value="">Select</option>-->
												</select>
											</div>
										</div>
										<div class="form-group">
											<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> Name</label>
											<div class="col-sm-8">
												<input type="text" class="form-control tooltips" id="txtProgramName" name="txtProgramName" placeholder="Name Of Post" title="Name Of Post">
											</div>
										</div>
										<div class="form-group">
											<label for="inputname" class="col-sm-4 control-label"><i style="color:red;font-size:18px;">*</i> Advertisement No</label>
											<div class="col-sm-8">
												<select class="form-control" id="cmbadvertisement" name="cmbadvertisement">
													
												</select>
											</div>
										</div>
										<div class="form-group">
											<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> Advertisement Date</label>
											<div class="col-sm-8">
												<input type="text" class="form-control tooltips" id="txtAdvtDate" name="txtAdvtDate" placeholder="Advertisement Date" title="Advertisement Date"readonly="">
											</div>
										</div>
										<!-- ADDED-->
										<div class="form-group">
											<label for="" class="col-sm-4 control-label"> Post Description</label>
											<div class="col-sm-8">
												<textarea class="form-control" cols="2" rows="2" id="taProgramDescription" name="taProgramDescription" placeholder="Description of Post"></textarea>
											</div>
										</div>
										<div class="form-group">
											<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> Profile Template</label>
											<div class="col-sm-8">
												<select class="form-control" id="cmbTemplate" name="cmbTemplate" > 
													
												</select>
											</div>
										</div>
										<!--<div class="form-group">
											<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> Year</label>
											<div class="col-sm-8">
												<input type="text" class="form-control tooltips" id="txtYear" name="txtYear" placeholder="Enter Year" title="Pick Year">
											</div>
										</div>-->
										
										<!-- Change by me-->
									<h5>Post Date:</h5>
										<div class="form-group">
											<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> From</label>
											<div class="col-sm-8">
												<input type="text" class="form-control tooltips" readonly="" id="txtStartdate" name="txtStartdate"  title="Post Start Date" placeholder="Post Start Date">
											</div>
										</div>
										<div class="form-group">	
											<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> To</label>
											<div class="col-sm-8">
												<input type="text" class="form-control tooltips" readonly="" id="txtEnddate" name="txtEnddate"  title="Post End Date" placeholder="Post End Date">
											</div>
										</div>
										
										<!--<div class="form-group">
											<label for="" class="col-sm-4 control-label">Registration Field Template</label>
											<div class="col-sm-8">
												<select class="form-control" id="cmbRegistrationTemplate" name="cmbRegistrationTemplate">
													
												</select>
											</div>
										</div>-->
									</div>	
									<div class="col-sm-6 col-xs-6">	
										<h5>Roll No Starting Sl No:</h5>
										<div class="form-group">
											<label for="" class="col-sm-4 control-label">Sl No</label>
											<div class="col-sm-8">
												<input type="text"  class="form-control tooltips"  id="txtOmrNo" name="txtOmrNo" maxlength="5" title="Roll No Starting Sl No" placeholder="Roll No Starting Sl No">
											</div>
										</div>
										
										<!--<div class="form-group">
											<label for="" class="col-sm-2 control-label">Program Date</label>
											<div class="col-sm-10">
												<input type="text" class="form-control tooltips" id="txtProgramDate" name="txtProgramDate"  title="Program Date">
											</div>
										</div>
										<div class="form-group">
											<label for="" class="col-sm-2 control-label">Application Date</label>
											<div class="col-sm-10">
												<input type="text"  class="form-control tooltips" id="txtAppDate" name="txtAppDate"  title="Apply Date">
											</div>
										</div>
										<div class="form-group">
											<label for="" class="col-sm-2 control-label">Eligible Birth Date</label>
											<div class="col-sm-10">
												<input type="text"  class="form-control tooltips" id="txtEligibleDate" name="txtEligibleDate"  title="Eligible Date">
											</div>
										</div>-->
										<!--<div class="form-group">
											<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> OMR Sl No</label>
											<div class="col-sm-8">
												<input type="text" class="form-control tooltips" id="txtOmrNo" name="txtOmrNo" placeholder="Enter OMR SlNo" title="Enter OMR SlNo">
											</div>
										</div>-->
										<h5>Application Date:</h5>
										<div class="form-group">
											<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i>From</label>
											<div class="col-sm-8">
												<input type="text"  class="form-control tooltips" readonly="" id="txtAppStartdate" name="txtAppStartdate"  title="Apply Start Date" placeholder="Apply Start Date">
											</div>
										</div>
										<div class="form-group">	
											<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i>To</label>
											<div class="col-sm-8">
												<input type="text"  class="form-control tooltips" readonly="" id="txtAppEnddate" name="txtAppEnddate"  title="Apply End Date" placeholder="Apply End Date">
											</div>
										</div>
										<h5>Admit Card Available Date:</h5>
										<div class="form-group">
											<label for="" class="col-sm-4 control-label"><!--<i style="color:red;font-size:15px;">*</i>--> From</label>
											<div class="col-sm-8">
												<input type="text"  class="form-control tooltips" readonly="" id="txtAdmitCardStartdate" name="txtAdmitCardStartdate"  title="Admit Card Start Date" placeholder="Admit Card Start Date">
											</div>
										</div>
										<div class="form-group">	
											<label for="" class="col-sm-4 control-label"><!--<i style="color:red;font-size:15px;">*</i>--> To</label>
											<div class="col-sm-8">
												<input type="text"  class="form-control tooltips" readonly="" id="txtAdmitCardEnddate" name="txtAdmitCardEnddate"  title="Admit Card End Date" placeholder="Admit Card End Date">
											</div>
										</div>
									</div>	
								</div>
								<div class="modal-footer">
									<button type="submit" class="btn btn-primary" id="programaddsave"><i class="fa fa-save"></i>  Save</button>
									<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
								</div>
							</form>
						</div>	
					</div>
				</div>
			</div>
			<div class="modal fade" id="programEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
								&times;
							</button>
							<h4 class="modal-title" id="myModalLabel">Edit Post</h4>
						</div>
						<div class="modal-body">
							<form class="form-horizontal" role="form" id = "frmProgramEdit" name = "frmProgramEdit">
								<input type="hidden" class="form-control" id="hidUniqueidEdit" name="hidUniqueidEdit">
								<input type="hidden" class="form-control" id="txtYearEdit" name="txtYearEdit">
								<!--<input type="hidden" class="form-control" id="txtOmrNoEdit" name="txtOmrNoEdit">-->
								<input type="hidden" class="form-control tooltips" id="txtProgramCodeEdit" name="txtProgramCodeEdit" title="Code of Post" placeholder="Unique Code of Post">
								<div class="row col-sm-12 col-xs-12 ">
									<div class="col-sm-6 col-xs-6">	
										<h5>Post Details:</h5>
										<div class="form-group">
											<label for="inputname" class="col-sm-4 control-label"><i style="color:red;font-size:18px;">*</i> Drive</label>
											<div class="col-sm-8">
												<select class="form-control" id="cmbProgramGroupEdit" name="cmbProgramGroupEdit">
													<!--<option value="">Select</option>-->
												</select>
											</div>
										</div>
										<div class="form-group">
											<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> Name</label>
											<div class="col-sm-8">
												<input type="text" class="form-control tooltips" id="txtProgramNameEdit" name="txtProgramNameEdit" placeholder="Name Of Post" readonly="" title="Name Of Post">
											</div>
										</div>
										<div class="form-group">
											<label for="inputname" class="col-sm-4 control-label"><i style="color:red;font-size:18px;">*</i> Advertisement No</label>
											<div class="col-sm-8">
												<select class="form-control" id="cmbadvertisementedit" name="cmbadvertisementedit" readonly>
													
												</select>
											</div>
										</div>
										<div class="form-group">
											<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> Advertisement Date</label>
											<div class="col-sm-8">
												<input type="text" class="form-control tooltips" id="txtAdvtDateEdit" name="txtAdvtDateEdit" placeholder="Advertisement Date" title="Advertisement Date">
											</div>
										</div>
										<!-- ADDED-->
										<div class="form-group">
											<label for="" class="col-sm-4 control-label">Post Description</label>
											<div class="col-sm-8">
												<textarea class="form-control" cols="3" rows="3" id="taProgramDescriptionEdit" name="taProgramDescriptionEdit" placeholder="Description Of Post"></textarea>
											</div>
										</div>
										<div class="form-group">
											<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> Profile Template</label>
											<div class="col-sm-8">
												<select class="form-control" id="cmbTemplateEdit" name="cmbTemplateEdit" placeholder="Profile Template">
													
												</select>
											</div>
											<!--<div class="col-sm-2">
												<button type="button" class="btn btn-success tooltips" title="View" id="btnViewEdit"><i class="fa fa-search" aria-hidden="true"></i></button>
											</div>-->
										</div>
										<!-- upto this-->
										<!--<div class="form-group">
											<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> Year</label>
											<div class="col-sm-8">
												<input type="text" class="form-control tooltips" id="txtYearEdit" name="txtYearEdit" placeholder="Pick Year" title="Pick Year">
											</div>
										</div>-->
										
										<h5>Post Date:</h5>
										<div class="form-group">
											<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> From</label>
											<div class="col-sm-8">
												<input type="text" class="form-control tooltips" id="txtStartdateEdit" name="txtStartdateEdit" placeholder="Post Start Date" title="Post Start Date"  readonly="" >
											</div>
										</div>	
										<div class="form-group">	
											<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> To</label>
											<div class="col-sm-8">
												<input type="text"  class="form-control tooltips" id="txtEnddateEdit" name="txtEnddateEdit" placeholder="Post End Date" title="Post End Date" readonly="" >
											</div>
										</div>
										
									</div>	
									<div class="col-sm-6 col-xs-6">		
										<h5>Roll No Starting Sl No:</h5>
										<div class="form-group">
											<label for="" class="col-sm-4 control-label">Sl No</label>
											<div class="col-sm-8">
												<input type="text"  class="form-control tooltips"  id="txtOmrNoEdit" name="txtOmrNoEdit" maxlength="5" title="Roll No Starting Sl No" placeholder="Roll No Starting Sl No">
											</div>
										</div>
										
										<!--<div class="form-group">
											<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> OMR Sl No</label>
											<div class="col-sm-8">
												<input type="text" class="form-control tooltips" id="txtOmrNoEdit" name="txtOmrNoEdit" placeholder="Enter OMR SlNo" title="Enter OMR SlNo">
											</div>
										</div>-->
										<!--<div class="form-group">
											<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> Status</label>
											<div class="col-sm-8">
												<select class="form-control" id="cmbStatusEdit" name="cmbStatusEdit">
													<option value="Active">Active</option>
													<option value="Inactive">Inactive</option>
												</select>
											</div>
										</div>-->
										
										<h5>Application Date:</h5>
										<div class="form-group">
											<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i>From</label>
											<div class="col-sm-8">
												<input type="text"  class="form-control tooltips" id="txtAppStartdateEdit" name="txtAppStartdateEdit"  title="Apply Start Date" readonly="" placeholder="Apply Start Date">
											</div>
										</div>	
										<div class="form-group">
											<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i>To</label>
											<div class="col-sm-8">
												<input type="text"  class="form-control tooltips" id="txtAppEnddateEdit" name="txtAppEnddateEdit"  title="Apply End Date" readonly="" placeholder="Apply End Date">
											</div>
										</div>
										<h5>Admit Card Available Date:</h5>
										<div class="form-group">
											<label for="" class="col-sm-4 control-label"><!--<i style="color:red;font-size:15px;">*</i>--> From</label>
											<div class="col-sm-8">
												<input type="text"  class="form-control tooltips" id="txtAdmitCardStartdateEdit" name="txtAdmitCardStartdateEdit"  readonly="" title="Admit Card Start Date" placeholder="Admit Card Start Date">
											</div>
										</div>
										<div class="form-group">	
											<label for="" class="col-sm-4 control-label"><!--<i style="color:red;font-size:15px;">*</i>--> To</label>
											<div class="col-sm-8">
												<input type="text"  class="form-control tooltips" id="txtAdmitCardEnddateEdit" name="txtAdmitCardEnddateEdit"  readonly="" title="Admit Card End Date" placeholder="Admit Card End Date">
											</div>
										</div>
										
									</div>
								</div>	
								
								<div class="modal-footer">
									<button type="submit" class="btn btn-primary" id="programEditSave"><i class="fa fa-save"></i>  Save</button>
									<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
								</div>
							</form>
						</div>	
					</div>
				</div>
			</div>
			<div class="modal fade" id="programDeleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog" style="width: 50%;">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
								&times;
							</button>
							<h4 class="modal-title" id="myModalLabel">Delete Post</h4>
						</div>
						<div class="modal-body">
							<center><h2>Do You Want to Delete This Record?</h2></center>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger" id="programDeleteRecord"><i class="fa fa-trash"></i>  Delete</button>
							<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>
						</div>
					</div>
				</div>
			</div>	
			<!-- For copy modal -->					
			<div class="modal fade" id="programCopyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
								&times;
							</button>
							<h4 class="modal-title" id="myModalLabel"> Copy Post</h4>
						</div>
						<div class="modal-body">
							<form class="form-horizontal" role="form"  id="frmCopyProgram" name="frmCopyProgram">
								<!--<input type="hidden" id="hidSessionCode" name="hidSessionCode" value="<?=$MY_SESSION_NAME?>"/>-->
								<input type="hidden" class="form-control" id="hidUniqueid" name="hidUniqueid">
								<div class="row col-sm-12 col-xs-12 ">
									<div class="col-sm-6 col-xs-6">
										<div class="form-group">
											<label for="inputname" class="col-sm-4 control-label"><i style="color:red;font-size:18px;">*</i> Drive</label>
											<div class="col-sm-8">
												<select class="form-control" id="cmbProgramGroupCopy" name="cmbProgramGroupCopy">
													<!--<option value="">Select</option>-->
												</select>
											</div>
										</div>
										
										<div class="form-group">
											<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> Name</label>
											<div class="col-sm-8">
												<input type="text" class="form-control tooltips" id="txtProgramNameCopy" name="txtProgramNameCopy" placeholder="Name Of Post" title="Name Of Post">
											</div>
										</div>
										
										<h5>Application Date</h5>
										<div class="form-group">
											<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> From</label>
											<div class="col-sm-8">
												<input type="text" class="form-control tooltips" id="txtStartdateCopy" name="txtStartdateCopy"  title="Apply Start Date" placeholder="Apply Start Date" readonly="">
											</div>
											<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> To</label>
											<div class="col-sm-8">
												<input type="text" class="form-control tooltips" id="txtEnddateCopy" name="txtEnddateCopy"  title="Apply End Date" placeholder="Apply End Date" readonly="">
											</div>
										</div>
										<h5>Post Date</h5>
										<div class="form-group">
											<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> From</label>
											<div class="col-sm-8">
												<input type="text"  class="form-control tooltips" id="txtAppStartdateCopy" name="txtAppStartdateCopy"  title="Post Start Date" placeholder="Post Start Date" readonly="">
											</div>
											<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> To</label>
											<div class="col-sm-8">
												<input type="text"  class="form-control tooltips" id="txtAppEnddateCopy" name="txtAppEnddateCopy"  title="Post End Date" placeholder="Post End Date" readonly="">
											</div>
										</div>
									</div>
									<div class="col-sm-6 col-xs-6">
										
										<div class="form-group">
											<label for="inputname" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> Copy From</label>
											<div class="col-sm-8">
												<select class="form-control" id="cmbCopyFrom" data-live-search="true" name="cmbCopyFrom">
													
												</select>
											</div>
										</div>
										<h5>Age Criteria:</h5>
										<div class="form-group">
											<label for="" class="col-sm-4 control-label">Birth Start Date</label>
											<div class="col-sm-8">
												<input type="text"  class="form-control tooltips" readonly="" id="txtAgeStartdateCopy" name="txtAgeStartdateCopy"  title="Eligible Start Date" placeholder="Eligible Start Date">
											</div>
										</div>
										<div class="form-group">	
											<label for="" class="col-sm-4 control-label">Birth End Date</label>
											<div class="col-sm-8">
												<input type="text"  class="form-control tooltips" readonly="" id="txtAgeEnddateCopy" name="txtAgeEnddateCopy"  title="Eligible End Date" placeholder="Eligible End Date">
											</div>
										</div>
										
										<h5>Admit Card Available Date:</h5>
										<div class="form-group">
											<label for="" class="col-sm-4 control-label"><!--<i style="color:red;font-size:15px;">*</i>--> From</label>
											<div class="col-sm-8">
												<input type="text"  class="form-control tooltips" readonly="" id="txtAdmitCardStartdateCopy" name="txtAdmitCardStartdateCopy"  title="Admit Card Start Date" placeholder="Admit Card Start Date">
											</div>
										</div>
										<div class="form-group">	
											<label for="" class="col-sm-4 control-label"><!--<i style="color:red;font-size:15px;">*</i>--> To</label>
											<div class="col-sm-8">
												<input type="text"  class="form-control tooltips" readonly="" id="txtAdmitCardEnddateCopy" name="txtAdmitCardEnddateCopy"  title="Admit Card End Date" placeholder="Admit Card End Date">
											</div>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<span id="spanProcessingProgram" style="display: none">Processing... <img src="../images/bx_loader.gif" /></span>
									<button type="submit" class="btn btn-primary" id="programCopysave" onclick="return check();">Save</button>
									<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>  
								</div>
							</form>
						</div>	
					</div>
				</div>
			</div>
			<div class="modal fade" id="programPublishModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
								&times;
							</button>
							<h4 class="modal-title" id="myModalLabel">Review & Publish Post</h4>
						</div>
						<div class="modal-body">
							<form class="form-horizontal" role="form" id="frmProgramPublish">
							<!--<div class="form-group">
								<div class="col-sm-12 col-sm-offset-2">
									<label>1) Post Menu Setup</label><span id="spanLoadMenu">&nbsp;(LOADING...)</span><span id="spanProgramMenu" style="display: none;"></span><span id="spanActiveProgramMenu" style="display: none;"></span><span id="spanShowProgramMenu" style="display: none;"></span>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-12 col-sm-offset-2">
									<label>2) Fee Setup</label><span id="spanLoadFee">&nbsp;(LOADING...)</span><span id="spanProgramFee" style="display: none;"></span>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-12 col-sm-offset-2">
									<label>3) Document Setup</label><span id="spanLoadDocument">&nbsp;(LOADING...)</span><span id="spanProgramDocuments" style="display: none;"></span>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-12 col-sm-offset-2">
									<label>4) Challan Setup</label><span id="spanLoadChallan">&nbsp;(LOADING...)</span><span id="spanProgramChallan" style="display: none;"></span>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-12 col-sm-offset-2">
									<label>5) Exam Center Setup</label><span id="spanLoadExamCentre">&nbsp;(LOADING...)</span><span id="spanProgramExamCentre" style="display: none;"></span>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-12 col-sm-offset-2">
									<label>6) SMS Setup</label><span id="spanLoadSms">&nbsp;(LOADING...)</span><span id="spanProgramSms" style="display: none;"></span>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-12 col-sm-offset-2">
									<label>7) Category Setup</label><span id="spanLoadCategory">&nbsp;(LOADING...)</span><span id="spanProgramCategory" style="display: none;"></span>
								</div>
							</div>-->
								<input type="hidden" class="form-control" id="hidUniqueidEdit" name="hidUniqueidEdit">
								<input type="hidden" class="form-control" id="txtYearEdit" name="txtYearEdit">
								<!--<input type="hidden" class="form-control" id="txtOmrNoEdit" name="txtOmrNoEdit">-->
								<input type="hidden" class="form-control tooltips" id="txtProgramCodeEdit" name="txtProgramCodeEdit" title="Code of Post" placeholder="Unique Code of Post">
								<div class="row col-sm-12 col-xs-12 ">
									<div class="col-sm-6 col-xs-6">	
										<h5>Post Details:</h5>
										<div class="form-group">
											<label for="inputname" class="col-sm-4 control-label">Drive :</label>
											<div class="col-sm-8" style = "margin-top:10px;">
												<label for="inputname" id="publishDrive"></label>
											</div>
										</div>
										<div class="form-group">
											<label for="" class="col-sm-4 control-label"> Name :</label>
											<div class="col-sm-8" style = "margin-top:10px;">
												<label for="" id="publishName"></label>
											</div>
										</div>
										<!-- ADDED-->
										<div class="form-group">
											<label for="" class="col-sm-4 control-label">Post Description :</label>
											<div class="col-sm-8" style = "margin-top:10px;">
												<label for="" id="publishDesc">Post Description</label>
											</div>
										</div>
										
										<h5>Application Date:</h5>
										<div class="form-group">
											<label for="" class="col-sm-4 control-label">From :</label>
											<div class="col-sm-8" style = "margin-top:10px;">
												<label for="" id="publishAppFrom">From</label>
											</div>
										</div>	
										<div class="form-group">	
											<label for="" class="col-sm-4 control-label">To :</label>
											<div class="col-sm-8" style = "margin-top:10px;">
												<label for="" id="publishAppTo">To</label>
											</div>
										</div>
										
									</div>	
									<div class="col-sm-6 col-xs-6">		
										<h5>Age Criteria:</h5>
										<div class="form-group">
											<label for="" class="col-sm-4 control-label">Birth Start Date :</label>
											<div class="col-sm-8" style = "margin-top:10px;">
												<label for="" id="publishBirthFrom">Birth Start Date</label>
											</div>
										</div>
										<div class="form-group">	
											<label for="" class="col-sm-4 control-label">Birth End Date :</label>
											<div class="col-sm-8" style = "margin-top:10px;">
												<label for="" id="publishBirthTo">Birth End Date</label>
											</div>
										</div>
										<!--<div class="form-group">
											<label for="" class="col-sm-4 control-label">Status :</label>
											<div class="col-sm-8">
												<label for="" id="publishStatus">Status</label>
											</div>
										</div>
										-->
										<h5>Post Date:</h5>
										<div class="form-group">
											<label for="" class="col-sm-4 control-label">From :</label>
											<div class="col-sm-8" style = "margin-top:10px;">
												<label for="" id="publishPostFrom">From</label>
											</div>
										</div>	
										<div class="form-group">
											<label for="" class="col-sm-4 control-label">To :</label>
											<div class="col-sm-8" style = "margin-top:10px;">
												<label for="" id="publishPostTo">To</label>
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger" id="programPublishRecord">Publish</button>
							<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
			<div class="modal fade" id="programAdditionalModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
								&times;
							</button>
							<h4 class="modal-title" id="myModalLabel">Add Additional Data</h4>
						</div>
						<div class="modal-body">
							<form class="form-horizontal" role="form"  id="frmAdditionalData" name="frmAdditionalData">
								<!--<input type="hidden" id="hidSessionCode" name="hidSessionCode" value="<?=$MY_SESSION_NAME?>"/>-->
								<input type="hidden" class="form-control" id="hidUniqueidAdditional" name="hidUniqueidAdditional">
								<div class="row col-sm-12 col-xs-12 ">
										<div class="col-sm-6 col-xs-6">
											<div class="form-group">
												<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> Post :</label>
												<div class="col-sm-8">
													<select class="form-control" id="cmbAdditionalProgram" name="cmbAdditionalProgram" > 
														
													</select>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> Upload/ Fill Data :</label>
													<div class="col-sm-8">
													<label class="radio-inline">
													<input id="radioUpload" type="radio" value="PDF" name="radioUpload" >
													Upload Pdf
													</label>
													<label class="radio-inline">
													<input  id="radioWrite" type="radio" value="CODE" name="radioUpload" >
													<i class="form-control-feedback" style="display: none;" data-bv-icon-for="radioUpload"></i>
													Fill Data
													</label>
													
													
													</div>
											</div>
										</div>
								</div>
								<div class="row col-sm-12 col-xs-12 " id="divWrite" style="display: none">
										<div class="col-sm-6 col-xs-6">
										<div class="form-group">
											<label for="" class="col-sm-4 control-label">Classification</label>
											<div class="col-sm-8">
												<input type="text" class="form-control tooltips" id="txtClassification" name="txtClassification" placeholder="Classification" title="Classification">
											</div>
										</div>
										<!-- ADDED-->
										<div class="form-group">
											<label for="" class="col-sm-4 control-label">Ministry/Administration</label>
											<div class="col-sm-8">
												<textarea class="form-control" cols="2" rows="2" id="txtMinistry" name="txtMinistry" placeholder="Ministry/Administration" title="Ministry/Administration"></textarea>
												
											</div>
										</div>
										<div class="form-group">
											<label for="" class="col-sm-4 control-label">Department/Office</label>
											<div class="col-sm-8">
												<textarea class="form-control" cols="2" rows="2" id="txtDepartment" name="txtDepartment" placeholder="Department/Office" title="Department/Office"></textarea>
												
											</div>
										</div>
										
										<!-- Change by me-->
										<div class="form-group">
											<label for="" class="col-sm-4 control-label">Organisation</label>
											<div class="col-sm-8">
												<textarea class="form-control" cols="2" rows="2" id="txtOrganisation" name="txtOrganisation" placeholder="Organisation" title="Organisation"></textarea>
											</div>
										</div>
										<div class="form-group">	
											<label for="" class="col-sm-4 control-label">Pay Scale</label>
											<div class="col-sm-8">
												<textarea class="form-control" cols="2" rows="2" id="txtPayScale" name="txtPayScale" placeholder="Pay Scale" title="Pay Scale"></textarea>
											</div>
										</div>
										
										<div class="form-group">
											<label for="" class="col-sm-4 control-label">Age</label>
											<div class="col-sm-8">
												<textarea class="form-control" cols="2" rows="2" id="txtAge" name="txtAge" placeholder="Age" title="Age"></textarea>
											</div>
										</div>
										
									</div>	
									<div class="col-sm-6 col-xs-6">	
										<div class="form-group">
											<label for="" class="col-sm-4 control-label">Essential Qualificaiton</label>
											<div class="col-sm-8">
												<textarea class="form-control" cols="2" rows="2" id="txtEsQualification" name="txtEsQualification" placeholder="Essential Qualificaiton" title="Essential Qualificaiton"></textarea>
											</div>
										</div>
										<div class="form-group">	
											<label for="" class="col-sm-4 control-label">Desirable Qualification</label>
											<div class="col-sm-8">
												<textarea class="form-control" cols="2" rows="2" id="txtDesireQualification" name="txtDesireQualification" placeholder="Desirable Qualification" title="Desirable Qualification"></textarea>
											</div>
										</div>
										
										<div class="form-group">
											<label for="" class="col-sm-4 control-label">Duties</label>
											<div class="col-sm-8">
												<textarea class="form-control" cols="2" rows="2" id="txtDuties" name="txtDuties" placeholder="Duties" title="Duties"></textarea>
											</div>
										</div>
										<div class="form-group">
											<label for="" class="col-sm-4 control-label">Probation Period</label>
											<div class="col-sm-8">
												<input type="text"  class="form-control tooltips" id="txtProbPeriod" name="txtProbPeriod"  title="Probation Period" placeholder="Probation Period">
											</div>
										</div>
										<div class="form-group">	
											<label for="" class="col-sm-4 control-label">Head Quarter</label>
											<div class="col-sm-8">
												<input type="text"  class="form-control tooltips" id="txtHeadQuarter" name="txtHeadQuarter"  title="Head Quarter" placeholder="Head Quarter">
											</div>
										</div>
										<div class="form-group">
											<label for="" class="col-sm-4 control-label">Other Details</label>
											<div class="col-sm-8">
												<input type="text"  class="form-control tooltips" id="txtOtherDetail" name="txtOtherDetail"  title="Other Details" placeholder="Other Details">
											</div>
											</div>
										</div>
										
									</div>
								<div class="row col-sm-12 col-xs-12 " id="divUpload" style="display: none">
									<div class="form-group">
										 <div class="col-sm-6 col-xs-6">
										 	<label class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> Upload Pdf:</label>
											<div class="col-sm-8 input-file" >
												<input type="file" class="form-control" id="filePdf" name="filePdf" />
												File-Type: pdf/PDF<br />
												File-Size: 1MB Max<br />
												Sample PDF file : <a target="_blank" href="<?=BASE_URL?>downloads/Post Details.pdf" >Download File </a><br />
												(The PDF file should be like this sample file.)
											</div>
										 </div>	
									</div>
										
								</div>	
								
								<div class="modal-footer">
									<button type="submit" class="btn btn-primary" id="programaddsave"><i class="fa fa-save"></i>  Save</button>
									<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
								</div>
							</form>
						</div>	
					</div>
				</div>
			</div>
			<div class="modal fade" id="programEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
								&times;
							</button>
							<h4 class="modal-title" id="myModalLabel">Edit Post</h4>
						</div>
						<div class="modal-body">
							<form class="form-horizontal" role="form" id = "frmProgramEdit" name = "frmProgramEdit">
								<input type="hidden" class="form-control" id="hidUniqueidEdit" name="hidUniqueidEdit">
								<input type="hidden" class="form-control tooltips" id="txtProgramCodeEdit" name="txtProgramCodeEdit" title="Code of Post" placeholder="Unique Code of Post">
								<div class="row col-sm-12 col-xs-12 ">
									<div class="col-sm-6 col-xs-6">	
										<h5>Post Details:</h5>
										<div class="form-group">
											<label for="" class="col-sm-4 control-label">Name</label>
											<div class="col-sm-8">
												<input type="text" class="form-control tooltips" id="txtProgramNameEdit" name="txtProgramNameEdit" placeholder="Name Of Post" title="Name Of Post">
											</div>
										</div>
										<!-- ADDED-->
										<div class="form-group">
											<label for="" class="col-sm-4 control-label">Post Description</label>
											<div class="col-sm-8">
												<textarea class="form-control" cols="3" rows="3" id="taProgramDescriptionEdit" name="taProgramDescriptionEdit" placeholder="Description Of Post"></textarea>
											</div>
										</div>
										
										<!-- upto this-->
										<div class="form-group">
											<label for="" class="col-sm-4 control-label">Year</label>
											<div class="col-sm-8">
												<input type="text" class="form-control tooltips" id="txtYearEdit" name="txtYearEdit" placeholder="Pick Year" title="Pick Year">
											</div>
										</div>
										
										<h5>Application Date:</h5>
										<div class="form-group">
											<label for="" class="col-sm-4 control-label">From</label>
											<div class="col-sm-8">
												<input type="text" class="form-control tooltips" id="txtStartdateEdit" name="txtStartdateEdit" placeholder="Apply Start Date" title="Post Start Date" placeholder="Post Start Date">
											</div>
										</div>	
										<div class="form-group">	
											<label for="" class="col-sm-4 control-label">To</label>
											<div class="col-sm-8">
												<input type="text"  class="form-control tooltips" id="txtEnddateEdit" name="txtEnddateEdit" placeholder="Apply End Date" title="Post End Date" placeholder="Post End Date">
											</div>
										</div>
										<div class="form-group">
											<label for="" class="col-sm-4 control-label">Registration Field Template</label>
											<div class="col-sm-6">
												<select class="form-control" id="cmbRegistrationTemplateEdit" name="cmbRegistrationTemplateEdit" placeholder="Registration Field Template">
													
												</select>
											</div>
											<div class="col-sm-2">
												<button type="button" class="btn btn-success tooltips" title="View" id="btnRegistrationViewEdit"><i class="fa fa-search" aria-hidden="true"></i></button>
											</div>
										</div>
									</div>	
									<div class="col-sm-6 col-xs-6">		
										<h5>Age Criteria:</h5>
										<div class="form-group">
											<label for="" class="col-sm-4 control-label">Birth Start Date</label>
											<div class="col-sm-8">
												<input type="text"  class="form-control tooltips" id="txtAgeStartdateEdit" name="txtAgeStartdateEdit"  title="Eligible Start Date" placeholder="Birth Start Date">
											</div>
										</div>
										<div class="form-group">	
											<label for="" class="col-sm-4 control-label">Birth End Date</label>
											<div class="col-sm-8">
												<input type="text"  class="form-control tooltips" id="txtAgeEnddateEdit" name="txtAgeEnddateEdit"  title="Eligible End Date" placeholder="Birth End Date">
											</div>
										</div>
										
										<div class="form-group">
											<label for="" class="col-sm-4 control-label">OMR Sl No</label>
											<div class="col-sm-8">
												<input type="text" class="form-control tooltips" id="txtOmrNoEdit" name="txtOmrNoEdit" placeholder="Enter OMR SlNo" title="Enter OMR SlNo">
											</div>
										</div>
										<div class="form-group">
											<label for="" class="col-sm-4 control-label">Status</label>
											<div class="col-sm-8">
												<select class="form-control" id="cmbStatusEdit" name="cmbStatusEdit">
													<option value="Active">Active</option>
													<option value="Inactive">Inactive</option>
												</select>
											</div>
										</div>
										
										<h5>Post Date:</h5>
										<div class="form-group">
											<label for="" class="col-sm-4 control-label">From</label>
											<div class="col-sm-8">
												<input type="text"  class="form-control tooltips" id="txtAppStartdateEdit" name="txtAppStartdateEdit"  title="Post Start Date" placeholder="Apply Start Date">
											</div>
										</div>	
										<div class="form-group">
											<label for="" class="col-sm-4 control-label">To</label>
											<div class="col-sm-8">
												<input type="text"  class="form-control tooltips" id="txtAppEnddateEdit" name="txtAppEnddateEdit"  title="Post End Date" placeholder="Apply End Date">
											</div>
										</div>
										<div class="form-group">
											<label for="" class="col-sm-4 control-label">Profile Template</label>
											<div class="col-sm-6">
												<select class="form-control" id="cmbTemplateEdit" name="cmbTemplateEdit" placeholder="Profile Template">
													
												</select>
											</div>
											<div class="col-sm-2">
												<button type="button" class="btn btn-success tooltips" title="View" id="btnViewEdit"><i class="fa fa-search" aria-hidden="true"></i></button>
											</div>
										</div>
									</div>
								</div>	
								
								<div class="modal-footer">
									<button type="submit" class="btn btn-primary" id="programEditSave"><i class="fa fa-save"></i>  Save</button>
									<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
								</div>
							</form>
						</div>	
					</div>
				</div>
			</div>	
		</div><!-- /.row -->
	</div><!-- /#page-wrapper -->
</div><!-- /#wrapper -->
<!--<script src="<?php echo base_url(); ?>public/template_lib/plugins/jquery-ui-1.11.4/jquery-ui.min.js"></script>-->
<!--<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datepicker/bootstrap-datepicker.js"></script>-->
<!--<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/daterangepicker/moment.min.js"></script>
-->

<!--<script src="<?php echo base_url(); ?>public/js/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>public/js/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/js/moment.min.js"></script>
<script src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrap-datepicker.js"></script>-->
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/datetimepickermoment.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/datetimepickerjs.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin/program.js?v=3"></script>			