<!--<link  rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery-ui.css"/>-->
<!--<link rel="stylesheet" media="all" type="text/css" href="<?php echo base_url(); ?>public/css/jquery-ui-timepicker-addon.css"/>-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/template_lib/plugins/datepicker/datepicker3.css" />
<!--<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/template_lib/plugins/jquery-ui-1.11.4/jquery-ui.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/template_lib/plugins/jquery-ui-1.11.4/jquery-ui.theme.min.css" />-->
<link href="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" media="screen" />


<div id="page-wrapper">
	<div class="row">
		<br />
		<div class="col-lg-12">
			<div class="panel with-nav-tabs panel-primary">
			<div class="panel-heading">
					<ul class="nav nav-tabs" role="tablist">
						<li id ="program" class="active"><a href="#tabProgram" data-toggle='tab'>Program</a></li>
						<li id ="branch"><a href="#tabBranch" data-toggle='tab'>Branch</a></li>
						<li id ="institute"><a href="#tabInstitute" data-toggle='tab'>Institute</a></li>
						<li id ="programbranch"><a href="#tabProgramBranch" data-toggle='tab'>Program Branch</a></li>
						<li id ="ProgramBranchIns"><a href="#tabProgramBranchIns" data-toggle='tab'>Program Branch Institute</a></li>
						<li id ="ProgramBranchInstituteSeat"><a href="#tabProgramBranchInstituteSeat" data-toggle='tab'>Program Branch Institute Seat</a></li>
					</ul>
				</div>
				<div class="panel-body">
					<div class="tab-content">
						<div class="tab-pane in active" id="tabProgram">
							<div class="col-lg-12" >
								<table class="table table-striped table-bordered" id="tblCourseMaster" width="100%">
									<thead>
										<tr>
											<th class="text-center">#</th>
											<th class="text-center">Code</th>
											<th class="text-center">Name</th>
											<th class="text-center">ID</th> <!-- ID WILL BE HIDE -->
											<th class="text-center">Action</th>
										</tr>
									</thead>
									<tbody>
										
									</tbody>
								</table>
							</div>
							
							
							<!-- Add  Modal Course master -->
							<div class="modal fade" id="courseAddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
													&times;
												</button>
												<h4 class="modal-title" id="myModalLabel"><span id="spanCourseModalLabel"></span> Record</h4>
											</div>
											<div class="modal-body">
												<form class="form-horizontal" role="form"  id="frmCourseAdd" name="frmCourseAdd">
													<input type="hidden" id="hidUniqueid" name=""/>
													<div class="form-group">
														<label for="inputname" class="col-sm-3 control-label">Program Code</label>
														<div class="col-sm-6">
															<input type="text" class="form-control tooltips" id="txtCourseCodeAdd" name="txtCourseCodeAdd" title="Program Code" placeholder="Program Code">
															
														</div>
													</div>
													<div class="form-group">
														<label for="" class="col-sm-3 control-label">Program Name</label>
														<div class="col-sm-6">
															<input type="text" class="form-control tooltips" id="txtCourseNameAdd" name="txtCourseNameAdd" placeholder="Program Name" title="Program Name">
														</div>
													</div>
													<div class="modal-footer">
														<button type="submit" class="btn btn-primary" id="courseAddSave">Save</button>
														<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>  
													</div>
												</form>
											</div>	
										</div>
									</div>
								</div>
							<!-- Add Modal Course master Close -->
							
						</div>
					
						<div class="tab-pane" id="tabBranch"> 
							<div class="col-lg-12">
								<table class="table table-striped table-bordered" id="tblDisciplineMaster" width="100%">
									<thead>
										<tr>
											<th class="text-center">#</th>
											<th class="text-center">Code</th>
											<th class="text-center">Name</th>
											<th class="text-center">ID</th> <!-- ID WILL BE HIDE -->
											<th class="text-center">Action</th>
											
										</tr>
									</thead>
									<tbody>
										
									</tbody>
								</table>
							</div>
							<div class="modal fade" id="disciplineAddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
												&times;
											</button>
											<h4 class="modal-title" id="myModalLabel">Add Records</h4>
										</div>
										<div class="modal-body">
											<form class="form-horizontal" role="form"  id="frmDisciplineAdd" name="frmDisciplineAdd">
												<input type="hidden" value="" id="hidDisciplineId" name="hidDisciplineId"/>
												<div class="form-group">
													<label for="inputname" class="col-sm-3 control-label">Branch Code</label>
													<div class="col-sm-6">
														<input type="text" class="form-control tooltips" id="txtDisciplineCodeAdd" name="txtDisciplineCodeAdd" title="Branch Code" placeholder="Branch Code" >
														
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-3 control-label">Branch</label>
													<div class="col-sm-6">
														<input type="text" class="form-control tooltips" id="txtDisciplineAdd" name="txtDisciplineAdd" placeholder="Branch" title="Add Branch">
													</div>
												</div>
											
												<div class="modal-footer">
													<button type="submit" class="btn btn-primary" id="disciplineAddSave">Save</button>
													<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>  
												</div>
											</form>
										</div>	
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="tabInstitute"> 
							<div class="col-lg-12">
								<table class="table table-striped table-bordered" id="institutedetails" width="100%">
									<thead>
										<tr>
											<th class="text-center">#</th>
											<th class="text-center">Name</th>
											<th class="text-center">Code</th>
											<th class="text-center">Type</th>
											
											<th class="text-center">Logo URL</th>
											<th class="text-center">Contact No</th>
											
											<th class="text-center">Image</th>
											<th class="text-center">Status</th>
											<th class="text-center">Logo</th>
											<th class="text-center">Location</th>
											
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
							<div class="modal fade" id="instituteaddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
												&times;
											</button>
											<h4 class="modal-title" id="myModalLabel">Add Records</h4>
										</div>
										<div class="modal-body">
											<?php echo form_open(null, array('class'=>'form-horizontal', 'id'=>'instmanageformid' ,'enctype'=>"multipart/form-data")); ?>
												<div id="errorlogInstitute" style="display: none; color: red; font-size: 12px;"></div>
												<div class="form-group">
													<input type="hidden" id="op_type" name="op_type" value="add_institute">
													<label for="inputname" class="col-sm-2 control-label">Name</label>
													<div class="col-sm-10">
														<input type="text" class="form-control tooltips" id="institutename" name="institutename" title="Name of institute" placeholder="Name of institute">
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-2 control-label">Code</label>
													<div class="col-sm-10">
														<input type="text" class="form-control tooltips" id="institutecode" name="institutecode" placeholder="Code of institute" title="Code Of Institute">
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-2 control-label">Type</label>
													<div class="col-sm-10">
														<input type="text" class="form-control tooltips" id="txtinstituteType" name="txtinstituteType" placeholder="Type of institute" title="Type Of Institute">
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-2 control-label">Web Address</label>
													<div class="col-sm-10">
														<input type="text" class="form-control tooltips" id="txtWebaddress" name="txtWebaddress" placeholder="Web site Address" title="Web site Address">
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-2 control-label">Contact No</label>
													<div class="col-sm-10">
														<input type="text" class="form-control tooltips" id="txtContactNo" name="txtContactNo" placeholder="Contact No" title="Contact No">
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-2 control-label">Location</label>
													<div class="col-sm-10">
														<input type="text" class="form-control tooltips" id="txtLocation" name="txtLocation" placeholder="Location" title="Location">
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-2 control-label">Logo</label>
													<div class="col-sm-10">
														<input type="file" class="form-control" id="fileinstitutelogo" name="fileinstitutelogo" >
													</div>
													<label for="" class="col-sm-offset-4 control-label" style="color: red;">(Dimensions of Logo should be 60*60)</label>
												</div>
												<!---->
												<div class="form-group">
													<label for="" class="col-sm-2 control-label">Status</label>
													<div class="col-sm-10">
														<select class="form-control" id="cmbRecordStatus" name="cmbRecordStatus">
															<option value="1">ACTIVE</option>
															<option value="0">INACTIVE</option>
														</select>
													</div>
												</div>
												
												<div class="form-group">
													<label for="" class="col-sm-2 control-label">Admin Name</label>
													<div class="col-sm-10">
														<input type="text" class="form-control tooltips" id="instituteadmindisplayname" name="instituteadmindisplayname" title="Display Name" placeholder="Admin Display Name">
													</div>
												</div>
												<div class="form-group">
													<label for="inputname" class="col-sm-2 control-label">Admin Username</label>
													<div class="col-sm-10">
														<input type="text" class="form-control tooltips" id="instituteadminusername" name="instituteadminusername" title="Username of institute admin" placeholder="Username of institute admin">
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-2 control-label">Address</label>
													<div class="col-sm-10">
														<textarea class="form-control tooltips" id="txtAddress" name="txtAddress" placeholder="Address of the Institute" title="Address Of the institute"></textarea>
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-2 control-label">Institute Image</label>
													<div class="col-sm-4">
														<input type="file" id="fileInstituteImage" name="fileInstituteImage" class="form-control"/>
														File-Type: jpg, jpeg, png<br />
														File-Size: 400kb Max<br />
														Dimension: 750*250 pixels
														<div id="signMessage" style="color:red;font-size:16px;"></div>
													</div>
													<div class="col-sm-6">
														<img id='imageDisplayarea' src='' style='margin-left:50px;margin-right:50px;margin-bottom: 20px;' width='200' height='100' />
													</div>
													
												</div>
												<div class="form-group modal-footer">
												    <span id="spanProcessingInstitute" style="display: none">Processing... <img src="<?php echo base_url(); ?>public/assets/images/bx_loader.gif" /></span>
													<button type="submit" class="btn btn-primary" id="institutemanageaddsave">Save</button>
													<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>  
												</div>
											</form>
										</div>	
									</div>
								</div>
							</div>
							<div class="modal fade" id="instituteeditmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
												&times;
											</button>
											<h4 class="modal-title" id="myModalLabel">Edit records</h4>
										</div>
										<div class="modal-body">
											<form class="form-horizontal" role="form" id="instmanageeditformid" enctype="multipart/form-data">
												<div id="errorlogInstituteEdit" style="display: none; color: red; font-size: 12px;"></div>
												<div class="form-group">
													<input type="hidden" id="op_type_institute" name="op_type_institute" value="edit_institute">
													<label for="inputname" class="col-sm-2 control-label">Name</label>
													<div class="col-sm-10">
														<input type="text" class="form-control" id="instituteeditname" name="instituteeditname" placeholder="Name of institute">
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-2 control-label">Code</label>
													<div class="col-sm-10">
														<input type="text" class="form-control" id="instituteeditcode" name="instituteeditcode" placeholder="Code of institute" readonly="readonly">
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-2 control-label">Type</label>
													<div class="col-sm-10">
														<input type="text" class="form-control tooltips" id="txtinstituteTypeEdit" name="txtinstituteTypeEdit" >
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-2 control-label">Web Address</label>
													<div class="col-sm-10">
														<input type="text" class="form-control tooltips" id="txtWebaddressEdit" name="txtWebaddressEdit">
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-2 control-label">Contact No</label>
													<div class="col-sm-10">
														<input type="text" class="form-control tooltips" id="txtContactNoEdit" name="txtContactNoEdit">
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-2 control-label">Location</label>
													<div class="col-sm-10">
														<input type="text" class="form-control tooltips" id="txtLocationEdit" name="txtLocationEdit">
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-2 control-label">Logo</label>
													<div class="col-sm-10">
														<input type="file" class="form-control" id="fileinstitutelogoEdit" name="fileinstitutelogoEdit" >
													</div>
													<label for="" class="col-sm-offset-4 control-label" style="color: red;">(Dimensions of Logo should be 60*60)</label>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-2 control-label">Institute Image</label>
													<div class="col-sm-4">
														<input type="file" id="fileInstituteImageEdit" name="fileInstituteImageEdit" class="form-control"/>
														File-Type: jpg, jpeg, png<br />
														File-Size: 400kb Max<br />
														Dimension: 750*250 pixels
														<div id="signMessageEdit" style="color:red;font-size:16px;"></div>
													</div>
													<div class="col-sm-6">
														<img id='imageDisplayareaEdit' src='' style='margin-left:50px;margin-right:50px;' width='200' height='100' />
													</div>
													
												</div>
												<div class="form-group">
													<label for="" class="col-sm-2 control-label">Status</label>
													<div class="col-sm-10">
														<select class="form-control" id="cmbRecordStatusEdit" name="cmbRecordStatusEdit">
															<option value="1">ACTIVE</option>
															<option value="0">INACTIVE</option>
														</select>
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-2 control-label">Address</label>
													<div class="col-sm-10">
														<textarea class="form-control tooltips" id="instituteeditAddress" name="instituteeditAddress" placeholder="Address of the Institute" title="Address Of the institute"></textarea>
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-2 control-label">Admin Display Name</label>
													<div class="col-sm-10">
														<input type="text" class="form-control" id="instituteadmindisplaynameEdit" name="instituteadmindisplaynameEdit" placeholder="Display Name">
													</div>
												</div>
												<div class="form-group">
													<label for="inputname" class="col-sm-2 control-label">Admin Username</label>
													<div class="col-sm-10">
														<input type="text" class="form-control" id="instituteadminusernameEdit" name="instituteadminusernameEdit" placeholder="Username of institute admin">
													</div>
												</div>
												
												<div class="modal-footer">
												    <span id="spanProcessingInstituteEdit" style="display: none">Processing... <img src="<?php echo base_url(); ?>public/assets/images/bx_loader.gif" /></span>
													<button type="submit" class="btn btn-primary" id="institutemanageeditsave">	Save</button>
													<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
												</div>
											</form>
										</div>	
									</div>
								</div>
							</div>
							<div class="modal fade" id="institutedeletemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
												&times;
											</button>
											<h4 class="modal-title" id="myModalLabel">Delete record</h4>
										</div>
										<div class="modal-body">
											<center><h2>Do You Want to Delete This Record?</h2></center>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-danger" id="institutemanagedeleterec">Delete</button>
											<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="tabProgramBranch"> 
							<div class="col-lg-12" >
								<table class="table table-striped table-bordered" id="tblCourseToDiscipline" width="100%">
									<thead>
										<tr>
											<th class="text-center">#</th>
											<th class="text-center">Program</th>
											<th class="text-center">Branch</th>
											<th class="text-center">Program Code</th> <!-- Course Code WILL BE HIDE -->
											<th class="text-center">Branch Code</th> <!-- Branch Code WILL BE HIDE -->
											<th class="text-center">ID</th> <!-- ID WILL BE HIDE -->
											<th class="text-center">Action</th>
										</tr>
									</thead>
									<tbody>
										
									</tbody>
								</table>
							</div>
							<!-- ADD  MODAL COURSE DISCIPLINE MAPPING -->
							<div class="modal fade" id="courseDisciplineMapAddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
												&times;
											</button>
											<h4 class="modal-title" id="myModalLabel">Add Records</h4>
										</div>
										<div class="modal-body">
											<form class="form-horizontal" role="form"  id="frmCourseDisciplineMapAdd" name="frmCourseDisciplineMapAdd">
												<div class="form-group">
													<label for="inputname" class="col-sm-4 control-label">Program</label>
													<div class="col-sm-6">
														
														<select class="form-control tooltips selectpicker" data-live-search="true" id="cmbCourseAdd" name="cmbCourseAdd" title="Choose Course">
															<!--<option value=""> Select Program</option>-->
														</select>
													
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-4 control-label">Branch</label>
													<div class="col-sm-6 ">
														<!--<input type="text" class="form-control tooltips" id="cmbInstituteNameAdd" name="cmbInstituteNameAdd" placeholder="Institute Name" title="Institute Name">-->
														<select id="cmbDisciplineAdd" multiple="multiple"   class="form-control tooltips  " data-live-search="true" name="cmbDisciplineAdd[]"  title="Choose Discipline">
			          										
			          									</select>
													</div>
												</div>
												
												
												<div class="modal-footer">
													<button type="submit" class="btn btn-primary" id="courseDisciplineMapAddSave">Save</button>
													<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>  
												</div>
											</form>
										</div>	
									</div>
								</div>
							</div>
							<!-- Add Modal Course Discipline mapping Close -->
							<!-- Edit modal  Course Discipline mapping -->
							<div class="modal fade" id="courseDisciplineMapEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
												&times;
											</button>
											<h4 class="modal-title" id="myModalLabel">Edit Records</h4>
										</div>
										<div class="modal-body">
											<form class="form-horizontal" role="form"  id="frmCourseDisciplineMapEdit" name="frmCourseDisciplineMapEdit">
												<div class="form-group">
													<div class="col-sm-10">
														<input type="hidden" class="form-control" id="uniqueidEdit" name="uniqueidEdit">
														<input type="hidden" class="form-control" id="hidDisciplineCode" name="hidDisciplineCode">
														<input type="hidden" class="form-control" id="hidInstituteCode" name="hidInstituteCode">
														<input type="hidden" class="form-control" id="courseCodeEdit" name="courseCodeEdit">
														<input type="hidden" class="form-control" id="hidSequenceCodeForDiscEdit" name="hidSequenceCodeForDiscEdit">
														<input type="hidden" class="form-control" id="hidcourseCodeForDiscEdit" name="hidcourseCodeForDiscEdit">
														<input type="hidden" class="form-control" id="hiddiscCodeForDiscEdit" name="hiddiscCodeForDiscEdit">
														

													</div>
												</div>
												
												<div class="form-group">
													<label for="inputname" class="col-sm-3 control-label">Course</label>
													<div class="col-sm-6">
														<input type="text" id="cmbCourseEdit" class="form-control tooltips " data-live-search="true" name="cmbCourseEdit"  title="course" readonly>
														<!--<select class="form-control tooltips selectpicker" data-live-search="true" id="cmbCourseEdit" name="cmbCourseEdit" title="Choose Course">
															<option value=""> Select Course</option>
														</select>-->
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-3 control-label">Discipline</label>
													<div class="col-sm-6">
														<!--<input type="text" class="form-control tooltips" id="cmbInstituteNameAdd" name="cmbInstituteNameAdd" placeholder="Institute Name" title="Institute Name">-->
														<!--<select id="cmbInstituteNameEdit" multiple="multiple"   class="form-control tooltips" data-live-search="true" name="cmbInstituteNameEdit[]"  title="Institute Name">
			          										
			          									</select>-->
			          									<!--<input type="text" id="txtDisciplineMapEdit" class="form-control tooltips " data-live-search="true" name="txtDisciplineMapEdit"  title="Discipline" >-->
			          									<select class="form-control tooltips" data-live-search="true" id="cmbDisciplineMapEdit" name="cmbDisciplineMapEdit" title="Choose Discipline">
															
														</select>
													</div>
												</div>
												
													
												
												<div class="modal-footer">
													<button type="submit" class="btn btn-primary" id="courseDisciplineMapEditSave">Save</button>
													<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>  
												</div>
											</form>
										</div>	
									</div>
								</div>
							</div><!-- Edit Modal Course Discipline mapping Close -->
						</div>
						<div class="tab-pane" id="tabProgramBranchIns"> 
							<form name="frmInstituteCourseSetup" class="form-horizontal" method="post" role="form">
								<div class="form-group">
									<div class="col-lg-12">
										<label for="" class="col-sm-2 control-label">Institute :</label>
										<div class="col-sm-6">
											<select class="form-control" data-live-search="true" name="cmbInstituteFilter"  id="cmbInstituteFilter">
											</select>
										</div>
										<div class="col-sm-1">
											<button type="button" class="btn btn-info" name="btnUpdate" id="btnUpdate"><i class="fa fa-check"></i> Assign</button>
										</div>
										<div class="col-sm-4">
											
										</div>
									</div>
								</div>
							</form>
							<div class="panel panel-default" style="height:700px; overflow-y: auto;">
								<div class="col-lg-12" style="padding-top: 5px;">
									<table class="table table-striped table-bordered" id="dtblInstituteCourse" width="100%">
										<thead>
											<tr>
												<th class="text-center">#</th>
												<th class="text-center">Course - Discipline code</th>
												<th class="text-center">Program</th>
												<th class="text-center">Branch</th>
												<th class="text-center">Status</th>
												<th hidden="hidden" class="text-center">ID</th><!-- id will be hide -->
											</tr>
										</thead>
									</table>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="tabProgramBranchInstituteSeat"> 
							<form name="frmInstituteCourseSetup" class="form-horizontal" method="post" role="form">
								<div class="form-group">
									<div class="col-lg-12">
										<label for="" class="col-sm-1 control-label">Institute :</label>
										<div class="col-sm-5">
											<select class="form-control" data-live-search="true" name="cmbInstituteFilterIns"  id="cmbInstituteFilterIns">
											</select>
										</div>
										<label for="" class="col-sm-2 control-label">Counselling Period :</label>
										<div class="col-sm-2">
											<select class="form-control" data-live-search="true" name="cmbCounsellingPeriod"  id="cmbCounsellingPeriod">
											</select>
										</div>
										<div class="col-sm-2">
												<button id="btnUploadReport" class="btn btn-info"><i class="fa fa-upload"></i> Upload</button>
											</div>
										<!--<div class="col-sm-1">
											<button type="button" class="btn btn-info" name="btnUpdate" id="btnUpdate"><i class="fa fa-check"></i> Assign</button>
										</div>-->
									</div>
								</div>
							</form>
							<div class="panel panel-default" style="height:700px; overflow-y: auto;">
								<div class="col-lg-12" style="padding-top: 5px;">
									<table class="table table-striped table-bordered" id="dtblProgramBranchInstituteSeat" width="100%">
										<thead>
											<tr>
												<th class="text-center">#</th>
												<th class="text-center">ipb code</th>
												<th class="text-center">Program</th>
												<th class="text-center">Branch</th>
												<th class="text-center">Institute</th>
												<th class="text-center">Category</th>
												<th class="text-center">No of Seats</th>
												<th class="text-center">Action</th>
											</tr>
										</thead>
									</table>
								</div>
							</div>
							<div class="modal fade" id="addExamSubjectModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
								<div class="modal-dialog" style="width:70%">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
												&times;
											</button>
											<h4 class="modal-title" id="myModalLabel">Seat Matrix</h4>
										</div>
										<br />
										<div class="modal-body">
											<form role="form"  id="frmaddExamSubject" name="frmaddExamSubject">
												<input type="hidden" class="form-control" id="hidInstituteFilterIns" name="hidInstituteFilterIns">
												<input type="hidden" class="form-control" id="hidCounsellingPeriod" name="hidCounsellingPeriod">
												<div class="col-lg-12 col-sm-12" id="tableDiv" style="overflow-x:auto;"></div>
												<br />
												<br />
											
												<div class="modal-footer">
													<button type="submit" class="btn btn-primary custombtn" id="btnSaveSeats" name="btnSaveSeats">Save</button>  &nbsp;&nbsp;
													<button type="button" class="btn btn-danger" data-dismiss="modal" id="close">Close</button>  
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
							
							<div class="modal fade" id="copyMatrixModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
								<div class="modal-dialog" style="width:70%">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
												&times;
											</button>
											<h4 class="modal-title" id="myModalLabelCopy">Seat Matrix</h4>
										</div>
										<br />
										<div class="modal-body">
											<form role="form"  id="frmaddExamSubjectCopy" name="frmaddExamSubjectCopy">
												<input type="hidden" class="form-control" id="hidInstituteFilterInsCopy" name="hidInstituteFilterInsCopy">
												<input type="hidden" class="form-control" id="hidCounsellingPeriodCopy" name="hidCounsellingPeriodCopy">
												<input type="hidden" class="form-control" id="hidCounsellingPeriodFromCopy" name="hidCounsellingPeriodFromCopy">
												<input type="hidden" class="form-control" id="hidCounsellingPeriodToCopy" name="hidCounsellingPeriodToCopy">
												<div class="col-lg-12 col-sm-12" id="tableDivCopy" style="overflow-x:auto;"></div>
												<br />
												<br />
											
												<div class="modal-footer">
													<button type="submit" class="btn btn-primary custombtn" id="btnSaveSeatsCopy" name="btnSaveSeatsCopy">Save</button>  &nbsp;&nbsp;
													<button type="button" class="btn btn-danger" data-dismiss="modal" id="close">Close</button>  
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
							
							<div class="modal fade" id="copyExamSubjectModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
								<div class="modal-dialog" style="width:70%">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
												&times;
											</button>
											<h4 class="modal-title" id="myModalLabel">Copy Seats</h4>
										</div>
										<br />
										<div class="modal-body">
											<form role="form"  id="frmcopyExamSubject" name="frmcopyExamSubject">
												<div class="form-group">
													<label for="" class="col-sm-2 control-label">Registration Field Template</label>
													<div class="col-sm-10">
														<select class="form-control" id="cmbRegistrationTemplate" name="cmbRegistrationTemplate">
															
														</select>
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-2 control-label">Registration Field Template</label>
													<div class="col-sm-10">
														<select class="form-control" id="cmbRegistrationTemplate" name="cmbRegistrationTemplate">
															
														</select>
													</div>
												</div>
											
												<div class="modal-footer">
													<button type="submit" class="btn btn-primary custombtn" id="btnSaveSeats" name="btnSaveSeats">Save</button>  &nbsp;&nbsp;
													<button type="button" class="btn btn-danger" data-dismiss="modal" id="close">Close</button>  
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="modal fade" id="programAddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
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
								<div class="form-group">
									<label for="inputname" class="col-sm-2 control-label">Group</label>
									<div class="col-sm-10">
										<select class="form-control" id="cmbProgramGroup" name="cmbProgramGroup">
											<!--<option value="">Select</option>-->
										</select>
									</div>
								</div>
								<div class="form-group">
									<label for="inputname" class="col-sm-2 control-label">Code</label>
									<div class="col-sm-10">
										<input type="text" class="form-control tooltips" id="txtProgramCode" name="txtProgramCode" title="Code of Program" placeholder="Unique Code of Program">
									</div>
								</div>
								<div class="form-group">
									<label for="" class="col-sm-2 control-label">Name</label>
									<div class="col-sm-10">
										<input type="text" class="form-control tooltips" id="txtProgramName" name="txtProgramName" placeholder="Name Of Program" title="Name Of Program">
									</div>
								</div>
								<div class="form-group">
									<label for="" class="col-sm-2 control-label">Elective Subjects</label>
									<div class="col-sm-10">
										<textarea class="form-control" cols="3" rows="3" id="taElectiveSubjects" name="taElectiveSubjects"></textarea>
									</div>
								</div>
								<div class="form-group">
									<label for="" class="col-sm-2 control-label">Year</label>
									<div class="col-sm-10">
										<input type="text" class="form-control tooltips" id="txtYear" name="txtYear" placeholder="Enter Year" title="Pick Year">
									</div>
								</div>
								<div class="form-group">
									<label for="" class="col-sm-2 control-label">Application Slno</label>
									<div class="col-sm-3">
										<input type="text" class="form-control tooltips" id="txtSlno" name="txtSlno" placeholder="Slno" title="Application Serial Number">
									</div>
									<label for="" class="col-sm-4 control-label">Online Payment TransNo</label>
									<div class="col-sm-3">
										<input type="text" class="form-control tooltips" id="txtOnlineTransactionNo" name="txtOnlineTransactionNo" placeholder="Eg:10000" title="Online Payment Transaction Number">
									</div>
								</div>
								<div class="form-group">
									<label for="" class="col-sm-2 control-label">Sequence Code</label>
									<div class="col-sm-3">
										<input type="text" class="form-control tooltips" id="txtSeqCode" name="txtSeqCode" placeholder="Slno" title="Sequence Code">
									</div>
									<label for="" class="col-sm-4 control-label">Sequence No.</label>
									<div class="col-sm-3">
										<input type="text" class="form-control tooltips" id="txtSeqno" name="txtSeqno" title="Sequence Number">
									</div>
								</div>
								<div class="form-group">
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
								</div>
								<div class="form-group">
									<label for="" class="col-sm-2 control-label">OMR Sl No</label>
									<div class="col-sm-10">
										<input type="text" class="form-control tooltips" id="txtOmrNo" name="txtOmrNo" placeholder="Enter OMR SlNo" title="Enter OMR SlNo">
									</div>
								</div>
								<div class="form-group">
									<label for="" class="col-sm-2 control-label">Registration Field Template</label>
									<div class="col-sm-10">
										<select class="form-control" id="cmbRegistrationTemplate" name="cmbRegistrationTemplate">
											
										</select>
									</div>
								</div>
								<div class="form-group">
									<label for="" class="col-sm-2 control-label">Profile Template</label>
									<div class="col-sm-10">
										<select class="form-control" id="cmbTemplate" name="cmbTemplate" > 
											
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
			<div class="modal fade" id="programEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
								&times;
							</button>
							<h4 class="modal-title" id="myModalLabel">Edit records</h4>
						</div>
						<div class="modal-body">
							<form class="form-horizontal" role="form" id = "frmProgramEdit" name = "frmProgramEdit">
								<input type="hidden" class="form-control" id="hidUniqueidEdit" name="hidUniqueidEdit">
								<div class="form-group">
									<label for="inputname" class="col-sm-2 control-label">Group</label>
									<div class="col-sm-10">
										<select class="form-control" id="cmbProgramGroupEdit" name="cmbProgramGroupEdit">
									
										</select>
									</div>
								</div>
								<div class="form-group">
									<label for="inputname" class="col-sm-2 control-label">Code</label>
									<div class="col-sm-10">
										<input type="text" class="form-control tooltips" id="txtProgramCodeEdit" name="txtProgramCodeEdit" title="Code of Program" placeholder="Unique Code of Program">
									</div>
								</div>
								<div class="form-group">
									<label for="" class="col-sm-2 control-label">Elective Subjects</label>
									<div class="col-sm-10">
										<textarea class="form-control" cols="3" rows="3" id="taElectiveSubjectsEdit" name="taElectiveSubjectsEdit"></textarea>
									</div>
								</div>
								<div class="form-group">
									<label for="" class="col-sm-2 control-label">Name</label>
									<div class="col-sm-10">
										<input type="text" class="form-control tooltips" id="txtProgramNameEdit" name="txtProgramNameEdit" placeholder="Name Of Program" title="Name Of Program">
									</div>
								</div>
								<div class="form-group">
									<label for="" class="col-sm-2 control-label">Year</label>
									<div class="col-sm-10">
										<input type="text" class="form-control tooltips" id="txtYearEdit" name="txtYearEdit" placeholder="Pick Year" title="Pick Year">
									</div>
								</div>
								<div class="form-group">
									<label for="" class="col-sm-2 control-label">Application Slno</label>
									<div class="col-sm-3">
										<input type="text" class="form-control tooltips" id="txtSlnoEdit" name="txtSlnoEdit" placeholder="Application Serial Number" title="Application Serial Number" readonly="readonly">
									</div>
									<label for="" class="col-sm-4 control-label">Online Payment TransNo</label>
									<div class="col-sm-3">
										<input type="text" class="form-control tooltips" id="txtOnlineTransactionNoEdit" name="txtOnlineTransactionNoEdit" placeholder="Eg:10000" title="Online Payment Transaction Number" readonly="readonly">
									</div>
								</div>
								<div class="form-group">
									<label for="" class="col-sm-2 control-label">Sequence Code</label>
									<div class="col-sm-4">
										<input type="text" class="form-control tooltips" id="txtSeqCodeEdit" name="txtSeqCodeEdit" placeholder="Slno" title="Sequence Code">
									</div>
									<label for="" class="col-sm-3 control-label">Sequence No.</label>
									<div class="col-sm-3">
										<input type="text" class="form-control tooltips" id="txtSeqnoEdit" name="txtSeqnoEdit" title="Sequence Number">
									</div>
								</div>
								<div class="form-group">
									<label for="" class="col-sm-2 control-label">Program Date</label>
									<div class="col-sm-10">
										<input type="text" class="form-control tooltips" id="txtProgramDateEdit" name="txtProgramDateEdit"  title="Program Date">
									</div>
								</div>
								<div class="form-group">
									<label for="" class="col-sm-2 control-label">Application Date</label>
									<div class="col-sm-10">
										<input type="text"  class="form-control tooltips" id="txtAppDateEdit" name="txtAppDateEdit"  title="Apply Date">
									</div>
								</div>
								<div class="form-group">
									<label for="" class="col-sm-2 control-label">Eligible Birth Date</label>
									<div class="col-sm-10">
										<input type="text"  class="form-control tooltips" id="txtEligibleDateEdit" name="txtEligibleDateEdit"  title="Eligible Date">
									</div>
								</div>
								<div class="form-group">
									<label for="" class="col-sm-2 control-label">OMR Sl No</label>
									<div class="col-sm-10">
										<input type="text" class="form-control tooltips" id="txtOmrNoEdit" name="txtOmrNoEdit" placeholder="Enter OMR SlNo" title="Enter OMR SlNo">
									</div>
								</div>
								<div class="form-group">
									<label for="" class="col-sm-2 control-label">Status</label>
									<div class="col-sm-10">
										<select class="form-control" id="cmbStatusEdit" name="cmbStatusEdit">
											<option value="Active">Active</option>
											<option value="Inactive">Inactive</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label for="" class="col-sm-2 control-label">Registration Field Template</label>
									<div class="col-sm-8">
										<select class="form-control" id="cmbRegistrationTemplateEdit" name="cmbRegistrationTemplateEdit">
											
										</select>
									</div>
									<div class="col-sm-2">
										<button type="button" class="btn btn-success tooltips" title="View" id="btnRegistrationViewEdit"><i class="fa fa-search" aria-hidden="true"></i></button>
									</div>
								</div>
								<div class="form-group">
									<label for="" class="col-sm-2 control-label">Profile Template</label>
									<div class="col-sm-8">
										<select class="form-control" id="cmbTemplateEdit" name="cmbTemplateEdit">
											
										</select>
									</div>
									<div class="col-sm-2">
										<button type="button" class="btn btn-success tooltips" title="View" id="btnViewEdit"><i class="fa fa-search" aria-hidden="true"></i></button>
									</div>
								</div>
	
								
								
								<div class="modal-footer">
								    <span id="spanProcessingProgramEdit" style="display: none">Processing... <img src="../images/bx_loader.gif" /></span>
									<button type="submit" class="btn btn-primary" id="programEditSave">Save</button>
									<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>  
								</div>
							</form>
						</div>	
					</div>
				</div>
			</div>
			<div class="modal fade" id="programDeleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
								&times;
							</button>
							<h4 class="modal-title" id="myModalLabel">Delete record</h4>
						</div>
						<div class="modal-body">
							<center><h2>Do You Want to Delete This Record?</h2></center>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger" id="programDeleteRecord">Delete</button>
							<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
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
							<h4 class="modal-title" id="myModalLabelCopy">Copy Program</h4>
						</div>
						<div class="modal-body">
							<form class="form-horizontal" role="form"  id="frmCopyProgram" name="frmCopyProgram">
								<!--<input type="hidden" id="hidSessionCode" name="hidSessionCode" value="<?=$MY_SESSION_NAME?>"/>-->
								<!--<input type="hidden" class="form-control" id="hidfrom" name="hidfrom">
								<input type="hidden" class="form-control" id="hidto" name="hidto">-->
								<div class="form-group">
									<label for="" class="control-label col-sm-1">Copy From:</label>
									<div class="col-sm-10">
										<select class="form-control" data-live-search="true" name="cmbFrom" id="cmbFrom" >
											
										</select>
									</div>
								</div>
								<div class="form-group">
									<label for="" class="control-label col-sm-1">Copy To:</label>
									<div class="col-sm-10">
										<select class="form-control" data-live-search="true" name="cmbTo" id="cmbTo" >
											<option value="1">Select</option>
											
										</select>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-primary" id="programCopy">Copy</button>     <!--onclick="return check();-->
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
							<h4 class="modal-title" id="myModalLabel">Review & Publish Program</h4>
						</div>
						<div class="modal-body">
							<form class="form-horizontal" role="form" id="frmProgramPublish">
							<div class="form-group">
								<div class="col-sm-12 col-sm-offset-2">
									<label>1) Program Menu Setup</label><span id="spanLoadMenu">&nbsp;(LOADING...)</span><span id="spanProgramMenu" style="display: none;"></span><span id="spanActiveProgramMenu" style="display: none;"></span><span id="spanShowProgramMenu" style="display: none;"></span>
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



			<div class="modal fade" id="programBranchInstituteSeatAddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
								&times;
							</button>
							<h4 class="modal-title" id="myModalLabel">Add Records</h4>
						</div>
						<div class="modal-body">
							<form class="form-horizontal" role="form"  id="frmAddprogramBranchInstituteSeat" name="frmAddprogramBranchInstituteSeat">
								<!--<input type="hidden" id="hidSessionCode" name="hidSessionCode" value="<?=$MY_SESSION_NAME?>"/>-->
								<input type="hidden" class="form-control" id="hidUniqueid" name="hidUniqueid">
								<div class="form-group">
									<label for="inputname" class="col-sm-2 control-label">Program</label>
									<div class="col-sm-10">
										<select class="form-control" id="cmbprogramBranchInstitute" name="cmbprogramBranchInstitute">
											<!--<option value="">Select</option>-->
										</select>
									</div>
								</div>
								<div class="form-group">
									<label for="inputname" class="col-sm-2 control-label">Category</label>
									<div class="col-sm-10">
										<select class="form-control" id="cmbCategoryCode" name="cmbCategoryCode">
											<!--<option value="">Select</option>-->
										</select>
									</div>
								</div>
								<div class="form-group">
									<label for="" class="col-sm-2 control-label">Seats</label>
									<div class="col-sm-10">
										<input type="text" class="form-control tooltips" id="txtSeats" name="txtSeats" placeholder="Alloted Seats" title="Alloted Seats">
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

			<div class="modal fade" id="programBranchInstituteSeatEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
								&times;
							</button>
							<h4 class="modal-title" id="myModalLabel">Edit Records</h4>
						</div>
						<div class="modal-body">
							<form class="form-horizontal" role="form"  id="frmprogramBranchInstituteSeatEdit" name="frmprogramBranchInstituteSeatEdit">
								<!--<input type="hidden" id="hidSessionCode" name="hidSessionCode" value="<?=$MY_SESSION_NAME?>"/>-->
								<input type="hidden" class="form-control" id="uniqueidProgramBranchInstituteSeatEdit" name="uniqueidProgramBranchInstituteSeatEdit">
								<div class="form-group">
									<label for="inputname" class="col-sm-2 control-label">Program</label>
									<div class="col-sm-10">
										<input type="text" class="form-control tooltips" id="cmbprogramBranchInstituteEdit" name="cmbprogramBranchInstituteEdit" disabled="">
									</div>
								</div>
								<div class="form-group">
									<label for="inputname" class="col-sm-2 control-label">Category</label>
									<div class="col-sm-10">
										<input type="text" class="form-control tooltips" id="cmbCategoryCodeEdit" name="cmbCategoryCodeEdit" disabled="">
									</div>
								</div>
								<div class="form-group">
									<label for="" class="col-sm-2 control-label">Seats</label>
									<div class="col-sm-10">
										<input type="text" class="form-control tooltips" id="txtSeatsEdit" name="txtSeatsEdit" placeholder="Alloted Seats" title="Alloted Seats">
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
		</div><!-- /.row -->
	</div><!-- /#page-wrapper -->
</div><!-- /#wrapper -->
<!--<script src="<?php echo base_url(); ?>public/template_lib/plugins/jquery-ui-1.11.4/jquery-ui.min.js"></script>-->
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datepicker/bootstrap-datepicker.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/daterangepicker/moment.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<!--<script src="<?php echo base_url(); ?>public/js/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>public/js/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/js/moment.min.js"></script>-->
<!--<script src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrap-datepicker.js"></script>-->
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin_counselling/program.js"></script>			