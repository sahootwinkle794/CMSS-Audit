<style>
	.modal-footer {
	    margin-top: 15px;
	    padding: 19px 20px 20px;
	    text-align: right;
	}
</style>
<div class="content-wrapper">
	<div class="row">
        <!--<div class="col-lg-12">
            <h1 class="page-header">Post Category Eligibility Setup</h1>
        </div>-->
        <section class="content-header">
	      	<h1>
	        	Category Wise Age Validation Setup
	      	</h1>
	    </section>
    	<!-- /.col-lg-12 -->
	</div>
	<div class="row">
		<br />
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-body box box-default">
					<!--<form method="POST" role="form">-->
					<div class="col-lg-12">
						<label for="" class="control-label col-sm-2" style="text-align:left;" id="cmbPrograml">Post:</label>
						<div class="col-sm-4">
							<select class="form-control" name="cmbProgramFilter" id="cmbProgramFilter">
								<option value=''>Select Post</option>
							</select>
						</div><br /><br /><br /><br />
					</div>
						
					<div class="col-sm-12">
						<table class="table table-striped table-bordered" id="tblCounsellingPeriod" width="100%">
							<thead>
								<tr>
									<th >Sl No</th>
									<th >Post Code</th><!-- id will be hide -->
									<th >Post</th>
									<th >Category Code</th>
									<th >Category</th>
									<th >Birth Start Date</th>
									<th >Birth End Date</th>
									<th >Action</th>
									
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>
						<!--<button type="button" class="btn btn-success " name="btnUpdateMultiple" id="btnUpdateMultiple" /><i class="fa fa-check-square-o" aria-hidden="true">&nbsp;Assign</i></<button>-->
					</div>
					
					<div class="modal fade" id="modalCounsellingPeriod" tabindex="-1" Resource="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
						<div class="modal-dialog" style="width: 50%;">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
										&times;
									</button>
									<h4 class="modal-title" id="myModalLabelCounsellingPeriod">Add Category Wise Age Relaxation</h4>
								</div>
								<div class="modal-body">
									<form class="form-horizontal" Resource="form"  id="frmCounsellingPeriod" name="frmCounsellingPeriod">
										<input type="hidden" id="hidCounsellingPeriod" name="hidCounsellingPeriod"/>
										<input type="hidden" id="hidCounsellingCat" name="hidCounsellingCat"/>
										<input type="hidden" id="hidAction" name="hidAction" value="Add"/>
										<div class="form-group">
											<label class="col-sm-4 control-label"><i style="color:red;font-size:18px;">*</i> Post</label>
											<div class="col-sm-8">
												<select class="form-control" id="cmbProgram" name="cmbProgram" ></select>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-4 control-label"><i style="color:red;font-size:18px;">*</i> Category</label>
											<div class="col-sm-8">
												<select class="form-control" id="cmbCategory" name="cmbCategory"></select>
											</div>
										</div>
										<div class="form-group">
											<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:18px;">*</i> Birth Start Date</label>
											<div class="col-sm-8">
												<input type="text"  class="form-control tooltips" id="txtAgeStartdate" name="txtAgeStartdate"  title="Eligible Start Date" readonly="">
											</div>
										</div>
										<div class="form-group">
											<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:18px;">*</i> Birth End Date</label>
											<div class="col-sm-8">
												<input type="text"  class="form-control tooltips" id="txtAgeEnddate" name="txtAgeEnddate"  title="Eligible End Date" readonly="">
											</div>
										</div>
										
										<div class="modal-footer">
											<button type="submit" class="btn btn-primary" id="btnSaveCounsellingPeriod"><i class="fa fa-save"></i>  Save</button>
											<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
										</div>
									</form>
								</div>	
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div><!-- /.row -->
</div><!-- /#page-wrapper -->
<!--<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datepicker/bootstrap-datepicker.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/daterangepicker/moment.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>-->
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin/program_cat_eligibility.js"></script>
