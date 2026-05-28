<style>
	.multiselect-container
	{
		height:250px;

		overflow-y: scroll;
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
						<li class="active"><a href="#assign" data-toggle='tab'>Assign Cat.</a></li>
						<li><a href="#view" data-toggle='tab'>Update Cat.</a></li>
						<li><a href="#add_exam_centre" data-toggle='tab'>Assign Exam Centre</a></li>
						<li><a href="#exam_centre" data-toggle='tab'>Update Exam Centre</a></li>
						<li><a href="#qualification_assign" data-toggle='tab'>Assign Qualification</a></li>
						<li><a href="#qualification_view" data-toggle='tab'>Update Qualification</a></li>
						<!--<li><a href="#program_vacancy" data-toggle='tab'>Assign Vacancy Matrix</a></li>
						<li><a href="#program_vacancy_view" data-toggle='tab'>Update Vacancy Matrix</a></li>
						<li><a href="#dc_assign" data-toggle='tab'>Assign DC Office</a></li>
						<li><a href="#dc_view" data-toggle='tab'>Update DC Office</a></li>-->
					</ul>
					<!--</div>
					<div class="panel-body">-->
					<div class="tab-content">
						<div class="chart tab-pane in active" id="assign">
							<div class="col-lg-12 page-header">
								<label for="" class="control-label col-sm-2" id ="cmbProgramGroupl" >Recruitment Drive:</label>
								<div class="col-sm-3">
									<select class="form-control" name="cmbProgramGroupCat" id="cmbProgramGroupCat">
									</select>
								</div>
								<label for="" class="col-sm-2 control-label">Post :</label>
								
								<div class="col-sm-4">
									<select class="form-control cmbProgramSelect"  name="cmbProgramSelect[]" title="Select Post" id="cmbProgramSelect" multiple="multiple">
									</select>
								</div>
							</div>
							<div class="col-lg-12">
								<table class="table table-striped table-bordered" id="dtblProgramCategory" width="100%">
									<thead>
										<tr>
											<th >#</th>
											<th >Category Code</th>
											<th >Category</th>
											<th >
												<label class=" control control--checkbox"  style="margin-top: 5px;">  
													<input class="tooltips" title="Select All"  type="checkbox" id="chkCatAll" name="chkCatAll" value=""/>
													<div class="control__indicator"></div>
												</label>
											</th>
											<!--<th hidden="hidden" >ID</th>--><!-- id will be hide -->
										</tr>
									</thead>
								</table>
								<!--<button type="button" class="btn btn-success " name="btnUpdateMultiple" id="btnUpdateMultiple" /><i class="fa fa-check-square-o" aria-hidden="true">&nbsp;Assign</i></<button>-->
							</div>
						</div>	
						<div class="chart tab-pane" id="view">
							<div class="col-lg-12 page-header">
								<label for="" class="control-label col-sm-2" id ="cmbProgramGroupl" >Recruitment Drive:</label>
								<div class="col-sm-3">
									<select class="form-control" name="cmbProgramGroupCatSingle" id="cmbProgramGroupCatSingle">
									</select>
								</div>
								<label for="" class="col-sm-2 control-label">Post :</label>
								
								<div class="col-sm-4">
									<select class="form-control"  name="cmbProgramFilter" title="Select Post" id="cmbProgramFilter">
									</select>
								</div>
							</div>
							<div class="col-lg-12">
								<table class="table table-striped table-bordered" id="dtblProgramcategorySingle" width="100%">
									<thead>
										<tr>
											<th >#</th>
											<th >Category Code</th>
											<th >Category</th>
											<th >
												<label class="control control--checkbox" style="margin-top: 5px;">  
													<input class="tooltips" title="Select All"  type="checkbox" id="chkCatUpdate" name="chkCatUpdate" value=""/>
													<div class="control__indicator"></div>
												</label>
											</th>
											<th hidden="hidden" >ID</th><!-- id will be hide -->
										</tr>
									</thead>
								</table>
								<button type="button" class="btn btn-warning" name="btnUpdateSingle" id="btnUpdateSingle" /><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;Update</button>
							</div>
						</div>
						
						
						
						<div class="chart tab-pane" id="add_exam_centre">
							<div class="col-lg-12 page-header">
								<label for="" class="control-label col-sm-2" id ="cmbProgramGroupl" >Recruitment Drive:</label>
								<div class="col-sm-3">
									<select class="form-control" name="cmbProgramGroupExam" id="cmbProgramGroupExam">
									</select>
								</div>
								<label for="" class="col-sm-2 control-label">Post:</label>
								<div class="col-sm-3">
									<select class="form-control cmbProgramMultiple"  name="cmbProgramMultiple[]" title="Select Post" id="cmbProgramMultiple" multiple="multiple">
									</select>
								</div>
							</div>
							<div class="col-lg-12">
								<table class="table table-striped table-bordered"  id="tblCenterAdd" width="100%">
									<thead>
										<tr>
											<th >#</th>
											<th >Exam Center Code</th>
											<th >Exam Center Name</th>
											<th >
												<label class="control control--checkbox" style="margin-top: 5px;">  
													<input class="tooltips" title="Select All"  type="checkbox" id="chkAll" name="chkAll" value=""/>
													<div class="control__indicator"></div>
												</label></th>
											<!--<th hidden>Status</th>-->
										</tr>
									</thead>
									<tbody>

									</tbody>
								</table>
								<!--<button type="button" class="btn btn-success " name="btnUpdateCentreMultiple" id="btnUpdateCentreMultiple" /><i class="fa fa-check-square-o" aria-hidden="true">&nbsp;Assign</i></<button>-->
							</div>
						</div>
						
						
						
						
						<div class="chart tab-pane" id="exam_centre">
							<div class="col-lg-12 page-header">
								<label for="" class="control-label col-sm-2" id ="cmbProgramGroupl" >Recruitment Drive:</label>
								<div class="col-sm-3">
									<select class="form-control" name="cmbProgramGroupExamSingle" id="cmbProgramGroupExamSingle">
									</select>
								</div>
								<label for="" class="col-sm-2 control-label">Post:</label>
								
								<div class="col-sm-4">
									<select class="form-control"  name="cmbProgram" id="cmbProgram" title="Select Post">
									</select>
								</div>
							</div>
							<div class="col-lg-12">
								<table class="table table-striped table-bordered"  id="tblCenterMaster" width="100%">
									<thead>
										<tr>
											<th >#</th>
											<!--<th hidden>Post Code</th>-->
											<th hidden>Exam Code</th>
											<th >Exam Center Name</th>
											<th >
												<label class="control control--checkbox" style="margin-top: 5px;">  
													<input class="tooltips" title="Select All"  type="checkbox" id="chkCentreUpdate" name="chkCentreUpdate" value=""/>
													<div class="control__indicator"></div>
												</label>
											</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
								<button type="button" class="btn btn-warning" name="btnUpdateCentre" id="btnUpdateCentre" /><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;Update</button>
							</div>
							<div class="modal fade" id="centreAddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
												&times;
											</button>
											<h4 class="modal-title" id="myModalLabel">Add Records</h4>
										</div>
										<div class="modal-body">
											<form class="form-horizontal" role="form"  id="frmAddCentre" name="frmAddCentre">
												<div class="form-group">
													<div class="col-sm-10">
														<input type="hidden" class="form-control" id="hidUniqueid" name="hidUniqueid" />
														<input type="hidden" class="form-control" id="hidProgramCode" name="hidProgramCode" />
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-3 control-label">Exam Centre Code</label>
													<div class="col-sm-9">
														<select class="form-control tooltips" id="txtExamCentreCode" name="txtExamCentreCode" title="Select Exam Center Code">
														</select>
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-3 control-label">Exam Centre Name</label>
													<div class="col-sm-9">
														<input type="text" class="form-control tooltips" id="txtExamCentreName" name="txtExamCentreName" placeholder="Enter Exam Center Name" title="Enter Exam Center Name">
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-3 control-label">Status</label>
													<div class="col-sm-9">
														<select class="form-control tooltips" id="cmbStatus" name="cmbStatus" title="Pick Status">
															<option value="ACTIVE">ACTIVE</option>
															<option value="INACTIVE">INACTIVE</option>
														</select>
													</div>
												</div>
												<div class="modal-footer">
													<button type="submit" class="btn btn-primary" id="centreaddsave">Save</button>
													<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>  
												</div>
											</form>
										</div>	
									</div>
								</div>
							</div>
							<div class="modal fade" id="centreEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
												&times;
											</button>
											<h4 class="modal-title" id="myModalLabel">Edit records</h4>
										</div>
										<div class="modal-body">
											<form class="form-horizontal" role="form" id = "frmCentreEdit" name = "frmCentreEdit">
												<div class="form-group">
													<div class="col-sm-10">
														<input type="hidden" class="form-control" id="hidUniqueidEdit" name="hidUniqueidEdit">
														<input type="hidden" class="form-control" id="hidProgramCodeEdit" name="hidProgramCodeEdit" />
														<input type="hidden" class="form-control" id="hidCentreCodeEdit" name="hidCentreCodeEdit" />
													</div>
												</div>
												<!--<div class="form-group">
													<label for="" class="col-sm-2 control-label">Code</label>
													<div class="col-sm-10">
														<input type="text" class="form-control tooltips" id="txtExamCentreCodeEdit" name="txtExamCentreCodeEdit" placeholder="Enter Exam Center Code" title="Enter Exam Center Code" readonly="">
													</div>
												</div>-->
												<div class="form-group">
													<label for="" class="col-sm-2 control-label">Name</label>
													<div class="col-sm-10">
														<input type="text" class="form-control tooltips" id="txtExamCentreNameEdit" name="txtExamCentreNameEdit" placeholder="Enter Exam Center Name" title="Enter Exam Center Name" readonly="">
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-2 control-label">Status</label>
													<div class="col-sm-10">
														<select class="form-control tooltips" id="cmbStatusEdit" name="cmbStatusEdit" title="Pick Status">
															<option value="ACTIVE">ACTIVE</option>
															<option value="INACTIVE">INACTIVE</option>
														</select>
													</div>
												</div>
												<div class="modal-footer">
													<button type="submit" class="btn btn-primary" id="centreeditsave">Save</button>
													<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>  
												</div>
											</form>
										</div>	
									</div>
								</div>
							</div>
							<div class="modal fade" id="ChallanDeleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
						</div>
						<div class="chart tab-pane" id="qualification_assign">
							<div class="col-lg-12 page-header">
								<label for="" class="control-label col-sm-2" id ="cmbProgramGroupl" >Recruitment Drive:</label>
								<div class="col-sm-3">
									<select class="form-control" name="cmbProgramGroupQual" id="cmbProgramGroupQual">
									</select>
								</div>
								<label for="" class="col-sm-2 control-label">Post:</label>
								<div class="col-sm-3">
									<select class="form-control cmbSelectProgram"  name="cmbSelectProgram[]" title="Select Post" id="cmbSelectProgram" multiple="multiple">
									</select>
								</div>
							</div>
							<!--<form method="POST" role="form">-->
							<div class="col-lg-12">
								
								<table class="table table-striped table-bordered" id="dtblProgramQualificationAssign" width="100%">
									<thead>
										<tr>
											<th >#</th>
											<th >Qualification</th>
											<th >
												<label class="control control--checkbox" style="margin-top: 5px;">  
													<input type="checkbox"class="tooltips"  title="Select All"  id="chkQualAll" name="chkQualAll" value=""/>
													<div class="control__indicator"></div>
												</label>
											</th>
											<th hidden="hidden" >ID</th><!-- id will be hide -->
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
								<!--<button type="button" class="btn btn-success " name="btnUpdateMultipleQualification" id="btnUpdateMultipleQualification" /><i class="fa fa-check-square-o" aria-hidden="true">&nbsp;Assign</i></<button>-->
							</div>
						</div>
						<div class="chart tab-pane" id="qualification_view">
							<div class="col-lg-12 page-header">
								<label for="" class="control-label col-sm-2" id ="cmbProgramGroupl" >Recruitment Drive:</label>
								<div class="col-sm-3">
									<select class="form-control" name="cmbProgramGroupQualSingle" id="cmbProgramGroupQualSingle">
									</select>
								</div>
								<label for="" class="col-sm-2 control-label">Post:</label>
								<div class="col-sm-4">
									<select class="form-control"  name="cmbFilter" id="cmbFilter" title="Select Post">
									</select>
								</div>
							</div>
							<!--<form method="POST" role="form">-->
							<div class="col-lg-12">
								
								<table class="table table-striped table-bordered" id="dtblProgramQualification" width="100%">
									<thead>
										<tr>
											<th >#</th>
											<th >Qualification</th>
											<th >
												<label class="control control--checkbox" style="margin-top: 5px;">  
													<input type="checkbox" class="tooltips"  title="Select All"  id="chkQualUpdate" name="chkQualUpdate" value=""/>
													<div class="control__indicator"></div>
												</label>
											</th>
											<!--<th hidden="hidden" >ID</th>--><!-- id will be hide -->
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
								<button type="button" class="btn btn-warning" name="btnUpdateQualification" id="btnUpdateQualification" /><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;Update</button>
							</div>	
						</div>
						<div class="chart tab-pane" id="program_vacancy">
							<div class="col-lg-12 page-header">
								<label for="" class="control-label col-sm-2" id ="cmbProgramGroupl" >Recruitment Drive:</label>
								<div class="col-sm-3">
									<select class="form-control" name="cmbProgramGroupVacancy" id="cmbProgramGroupVacancy">
									</select>
								</div>
								<label for="" class="col-sm-2 control-label">Post:</label>
								<div class="col-sm-3">
									<select class="form-control cmbProgramVacancySelect"  name="cmbProgramVacancySelect[]" title="Select Post" id="cmbProgramVacancySelect" multiple="multiple">
									</select>
								</div>
							</div>
							<!--<form method="POST" role="form">-->
							<div class="col-lg-12">
								<table class="table table-striped table-bordered" id="tblProgramVacancyAssign"width="100%">
									<thead>
										<tr>
											<th >#</th>
											<th hidden="hidden"  >ID</th><!-- id will be hide -->
											<th >Category</th>
											<th  class="alignCenter">No. of Vacancies</th>
											
										</tr>
									</thead>
									<tbody>
										
									</tbody>
								</table>
								<!--<button type="button" class="btn btn-success " name="btnUpdateMultipleVacancy" id="btnUpdateMultipleVacancy" /><i class="fa fa-check-square-o" aria-hidden="true">&nbsp;Assign</i></<button>-->
							</div>
						</div>
						<div class="chart tab-pane" id="program_vacancy_view">
							<div class="col-lg-12 page-header">
								<label for="" class="control-label col-sm-2" id ="cmbProgramGroupl" >Recruitment Drive:</label>
								<div class="col-sm-3">
									<select class="form-control" name="cmbProgramGroupVacancySingle" id="cmbProgramGroupVacancySingle">
									</select>
								</div>
								<label for="" class="col-sm-2 control-label">Post:</label>
								<div class="col-sm-4">
									<select class="form-control"  name="cmbProgramFilterVacancy" title="Select Post" id="cmbProgramFilterVacancy">
									</select>
								</div>
							</div>
							<!--<form method="POST" role="form">-->
							<div class="col-lg-12">
								<table class="table table-striped table-bordered" id="tblProgramVacancy"width="100%">
									<thead>
										<tr>
											<th >#</th>
											<th >Category</th>
											<th >No. of Vacancies</th>
										</tr>
									</thead>
									<tbody>
										
									</tbody>
								</table>
								<button type="button" class="btn btn-warning" name="btnUpdateSingleVacancy" id="btnUpdateSingleVacancy" /><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;Update</button>
							</div>
							<div class="modal fade" id="feeAddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
												&times;
											</button>
											<h4 class="modal-title" id="myModalLabel">Add records</h4>
										</div>
										<div class="modal-body">
											<form class="form-horizontal" role="form" id = "frmFeeAdd" name = "frmFeeAdd">
												
												<div class="form-group">
													<label for="" class="col-sm-2 control-label">Category</label>
													<div class="col-sm-10">
														<select class="form-control tooltips" id="cmbCategory" name="cmbCategory" title="Select Category">
															
														</select>
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-2 control-label">Amount</label>
													<div class="col-sm-10">
														<input  type="text" class="form-control tooltips" id="txtAmount" name="txtAmount" title="Enter Amount"/>
													</div>
												</div>
												<div class="modal-footer">
													<button type="submit" class="btn btn-primary" ><i class="fa fa-save"></i>  Save</button>
													<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
												</div>
											</form>
										</div>	
									</div>
								</div>
							</div>
							<div class="modal fade" id="feeEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
												&times;
											</button>
											<h4 class="modal-title" id="myModalLabel">Edit records</h4>
										</div>
										<div class="modal-body">
											<form class="form-horizontal" role="form" id = "frmFeeEdit" name = "frmFeeEdit">
												<div class="form-group">
													<div class="col-sm-10">
														<input type="hidden" class="form-control" id="hidUniqueidEdit" name="hidUniqueidEdit">
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-2 control-label">Category</label>
													<div class="col-sm-10">
														<select class="form-control tooltips" id="cmbCategoryEdit" name="cmbCategoryEdit" title="Select Category">
															
														</select>
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-2 control-label">Amount</label>
													<div class="col-sm-10">
														<input  type="text" class="form-control tooltips" id="txtAmountEdit" name="txtAmountEdit" title="Enter Amount"/>
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
						</div>
						
						<div class="chart tab-pane" id="dc_assign" style="min-height: 1000px">
							<div class="col-lg-12 page-header">
								<label for="" class="control-label col-sm-2" id ="cmbProgramGroupl" >Recruitment Drive:</label>
								<div class="col-sm-3">
									<select class="form-control" name="cmbProgramGroupDC" id="cmbProgramGroupDC">
									</select>
								</div>
								<label for="" class="col-sm-2 control-label">Post :</label>
								
								<div class="col-sm-4">
									<select class="form-control cmbProgramSelectdc"  name="cmbProgramSelectdc[]" title="Select Program" id="cmbProgramSelectdc" multiple="multiple">
									</select>
								</div>
							</div>
							<div class="col-lg-12">
								<table class="table table-striped table-bordered" id="dtblProgramDc" width="100%">
									<thead>
										<tr>
											<th >#</th>
											<th >Dc office Code</th>
											<th >Dc office Name</th>
											<th >
												<label class="control control--checkbox" style="margin-top: 5px;">  
													<input type="checkbox" id="chkDcAll" name="chkDcAll" value=""/>
													<div class="control__indicator"></div>
												</label>
											</th>
											<th hidden="hidden" >ID</th><!-- id will be hide -->
										</tr>
									</thead>
								</table>
								<button type="button" class="btn btn-success " name="btnUpdateMultipleDc" id="btnUpdateMultipleDc" /><i class="fa fa-check-square-o" aria-hidden="true"></i>&nbsp;Assign</<button>
							</div>
						</div>	
						<div class="chart tab-pane" id="dc_view">
							<div class="col-lg-12 page-header">
								<label for="" class="control-label col-sm-2" id ="cmbProgramGroupl" >Recruitment Drive:</label>
								<div class="col-sm-3">
									<select class="form-control" name="cmbProgramGroupDCSingle" id="cmbProgramGroupDCSingle">
									</select>
								</div>
								<label for="" class="col-sm-2 control-label">Post :</label>
								
								<div class="col-sm-4">
									<select class="form-control"  name="cmbProgramFilterdc" title="Select Program" id="cmbProgramFilterdc">
									</select>
								</div>
							</div>
							<div class="col-lg-12">
								<table class="table table-striped table-bordered" id="dtblProgramDcSingle" width="100%">
									<thead>
										<tr>
											<th >#</th>
											<th >Dc office Code</th>
											<th >Dc office Name</th>
											<th >
												<label class="control control--checkbox" style="margin-top: 5px;">  
													<input type="checkbox" id="chkDcUpdate" name="chkDcUpdate" value=""/>
													<div class="control__indicator"></div>
												</label>
											</th>
											<th hidden="hidden" >ID</th><!-- id will be hide -->
										</tr>
									</thead>
								</table>
								<button type="button" class="btn btn-warning" name="btnUpdateSingleDc" id="btnUpdateSingleDc" /><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;Update</button>
							</div>
						</div>
						<!--Streams Tab -->
						<div class="chart tab-pane" id="program_qualification_stream">
							<div class="col-lg-12">
								<table class="table table-striped table-bordered" id="tblNodalCentre" width="100%">
									<thead>
										<tr>
											<th #</th>
											<th  hidden>Post Code</th>
											<th >Post Name</th>
											<th  hidden>Qualification Code</th>
											<th >Qualification Name</th>
											<th  hidden>Stream Code</th>
											<th >Stream Name</th>
											<th >Action</th>
											
										</tr>
									</thead>
									<tbody>
										
									</tbody>
								</table>
							</div>
							
							<div class="modal fade" id="modalNodalCounterMapping" tabindex="-1" Resource="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
												&times;
											</button>
											<h4 class="modal-title" id="myModalLabel">Add Records</h4>
										</div>
										<div class="modal-body">
											<form class="form-horizontal" Resource="form"  id="frmNodalCentre" name="frmNodalCentre">
												<input type="hidden" id="hidProgramCode" name="hidProgramCode"/>
												<input type="hidden" id="hidQualCode" name="hidQualCode"/>
												<input type="hidden" id="hidStreamCode" name="hidStreamCode"/>
												<div class="form-group">
													<label for="txtCodeGroup" class="col-sm-4 control-label">Post</label>
													<div class="col-sm-8">
														<select class="form-control" id="cmbProgramCode" name="cmbProgramCode">
														</select>
													</div>
												</div>
												<div class="form-group">
													<label for="txtCodeGroup" class="col-sm-4 control-label">Qualification</label>
													<div class="col-sm-8">
														<select class="form-control" id="cmbQualificationCode" name="cmbQualificationCode">
														</select>
													</div>
												</div>
												<div class="form-group"  id="CounterCode">
													<label for="" class="col-sm-4 control-label">Streams</label>
													<div class="col-lg-6 col-sm-6 col-md-6">
														<select id="cmbStreamCode" multiple="multiple"  class="form-control tooltips" data-live-search="true" name="cmbStreamCode[]"  title="Choose Stream">
			          										
			          									</select>
													</div>
												</div>
												
												<div class="form-group"  id="CounterCodeEdit">
													<label for="" class="col-sm-4 control-label">Streams</label>
													<div class="col-sm-8">
														<select id="cmbStreamCodeEdit" class="form-control" name="cmbStreamCodeEdit"  title="Choose Stream">
			          										
			          									</select>
													</div>
												</div>
												
												<div class="modal-footer">
													<button type="submit" class="btn btn-primary" id="btnSaveNodalCentre">Save</button>
													<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>  
												</div>
											</form>
										</div>	
									</div>
								</div>
							</div>
							
						</div>
					</div>
				</div>
				<!--</div>
			</div>-->
		</div>
	</div><!-- /.row -->
</div><!-- /#page-wrapper -->
		
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin/profile.js"></script>

