<div class="content-wrapper">
	<div class="row">
        <!--<div class="col-lg-12">
            <h1 class="page-header">Post Category Eligibility Setup</h1>
        </div>-->
        <section class="content-header">
	      	<h1>
	        	CutOff Matrix
	      	</h1>
	    </section>
    	<!-- /.col-lg-12 -->
	</div>
	<div class="row">
		<br />
		<div class="col-lg-12">
			<!--<div class="panel with-nav-tabs panel-primary">
				<div class="panel-heading">-->
				<div class="nav-tabs-custom box box-default">
					<ul class="nav nav-tabs" role="tablist">
						<!--<li class="active"><a href="#assign" data-toggle='tab'>Assign Cat.</a></li>-->
						<!--<li><a href="#view" data-toggle='tab'>Update Cat.</a></li>
						<li><a href="#add_exam_centre" data-toggle='tab'>Add Exam Centre</a></li>
						<li><a href="#exam_centre" data-toggle='tab'>Update Exam Centre</a></li>
						<li><a href="#qualification_assign" data-toggle='tab'>Assign Qualification</a></li>
						<li><a href="#qualification_view" data-toggle='tab'>Update Qualification</a></li>-->
						<li class="active"><a href="#program_vacancy" data-toggle='tab'>Assign cutoff Matrix</a></li>
						<li><a href="#program_vacancy_view" data-toggle='tab'>Update cutoff Matrix</a></li>
					</ul>
					<!--</div>
					<div class="panel-body">-->
					<div class="tab-content">
						<div class="chart tab-pane in active" id="program_vacancy">
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
											<th >Cutoff Marks</th>
										</tr>
									</thead>
									<tbody>
										
									</tbody>
								</table>
								<button type="button" class="btn btn-success " name="btnUpdateMultipleVacancy" id="btnUpdateMultipleVacancy" /><i class="fa fa-check-square-o" aria-hidden="true"></i>&nbsp;Assign</<button>
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
											<th >Cutoff Marks</th>
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
																						
												<!--<div class="form-group">
													<label for="" class="col-sm-2 control-label">Post</label>
													<div class="col-sm-10">
														<select class="form-control tooltips" id="cmbProgramName" name="cmbProgramName" title="Select Program Name">
															
														</select>
													</div>
												</div>-->
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

						<!--Streams Tab -->
						
					</div>
				</div>
				<!--</div>
			</div>-->
		</div>
	</div><!-- /.row -->
</div><!-- /#page-wrapper -->
		
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin/category_wise_cutoff.js"></script>

