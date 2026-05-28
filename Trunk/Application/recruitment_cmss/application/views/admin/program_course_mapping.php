<style>
.modalExbottom
{
	color:#d2a9a9;
}
</style>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/template_lib/plugins/datepicker/datepicker3.css" />
<link href="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" media="screen" />
<style>
	.daterangepicker{z-index:1151 !important;}
	.daterangepicker{ z-index:99999 !important; }
	/*.modal {
	    width : 560px;
	    position : absolute;
	}*/
	/*.datepicker { 
       z-index: 100000 !important; 
       display: block; 
    }

    .timepicker{
       z-index: 100001 !important;
    }*/
</style>
<div class="content-wrapper">
	<!--<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Post - Course Mapping</h1>
        </div>
	</div>-->
	<section class="content-header">
      	<h1>
        	Post - Examination Mapping
      	</h1>
    </section>
    <!-- Main content -->
    <section class="content">
		<div class="row">
			<div class="col-lg-12" style="padding-top:0px;">
				<div class="panel panel-default box box-default">	
					<div class="panel-body">
						<div style="border-radius:0px;border: 0px inset;padding-left:20px;padding-right:20px;padding-top:0px;">
							<!--<div class="col-lg-12 page-header">
								<label for="" class="col-sm-2 control-label">Post:</label>
								<div class="col-sm-4">
									<select class="form-control"  name="cmbProgramFilter" title="Select Post" id="cmbProgramFilter">
									</select>
								</div>
								<button type="button" class="btn btn-warning" name="btnFilter" id="btnFilter" /><i class="fa fa-filter" aria-hidden="true">&nbsp;Filter</i></button>
							</div>-->
							
							<table class="table table-striped table-bordered " id="dtblApplicationDetail">
								<thead>
									<tr>
										<th >#</th>
										<th  hidden="">Program Code</th>
										<th  hidden="">Course Code</th>
										<th >Post</th>
										<th >Subject</th>
										<th >Total Mark</th>
										<th >Date of Exam</th>
										<th >Timing</th>
										<th >Session</th>
										<th style="text-align: center;" >Action</th>
										
									</tr>
								</thead>
								<tbody>
								
								</tbody>
							</table>
							
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="programAddModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
			<div class="modal-dialog" style="width: 50%;">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							&times;
						</button>
						<h4 class="modal-title" id="myModalLabel">Add Post-Examination</h4>
					</div>
					<div class="modal-body">
						<form class="form-horizontal" role="form"  id="frmAddProgram" name="frmAddProgram">
							<input type="hidden" class="form-control" id="hidUniqueid" name="hidUniqueid">
							<input type="hidden" class="form-control" id="hidUniqueCourseid" name="hidUniqueCourseid">
							<input type="hidden" class="form-control" id="hidAction" name="hidAction" value="Add_course_setup">
							<div class="form-group">
								<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:18px;">*</i> Post</label>
								<div class="col-sm-8">
									<select class="form-control" id="cmbProgram" name="cmbProgram">
									</select>
								</div>
							</div>
							<!--<div class="form-group">
								<label for="" class="col-sm-2 control-label">Code</label>
								<div class="col-sm-10">
									<input type="text" class="form-control tooltips" id="txtCourseCode" name="txtCourseCode" placeholder="Course Code" title="Course Code">
								</div>
							</div>-->
							<div class="form-group">
								<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:18px;">*</i> Subject Name</label>
								<div class="col-sm-8">
									<input type="text" class="form-control tooltips" id="txtCourseName" name="txtCourseName" placeholder="Name Of Subject" title="Name Of Course" maxlength="80">
								</div>
								<p class="modalExbottom" style="margin-left: 240px;">Ex: Aptitute</p>
							</div>
							<div class="form-group">
								<label for="" class="col-sm-4 control-label"> Total mark</label>
								<div class="col-sm-8">
									<input type="text" class="form-control tooltips" id="txtMark" name="txtMark"  onkeypress="return isNumberKey(event)" placeholder="Total mark" title="Total mark" maxlength="3">
								</div>
							</div>
							<div class="form-group">
								<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:18px;">*</i> Date of Exam</label>
								<div class="col-sm-8">
									<input type="text" class="form-control tooltips" id="txtExamDate" readonly name="txtExamDate" placeholder="Exam Date" title="Exam Date">
								</div>
							</div>
							<div class="form-group">
								<label for="" class="col-sm-4 control-label">&nbsp;&nbsp;Timing</label>
								<div class="col-sm-8">
									<input type="text" class="form-control tooltips" id="txtTiming" name="txtTiming" placeholder="Exam Timing" title="Exam Timing" maxlength="80">
								</div>
							</div>
							<div class="form-group">
								<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:18px;">*</i> Session</label>
								<div class="col-sm-8">
									<select class="form-control" id="cmbSession" name="cmbSession">
										<option value="">Select</option>
										<option value="Morning Session">Morning Session</option>
										<option value="Evening session">Evening Session</option>
									</select>
								</div>
							</div>
							
							<div class="modal-footer">
							<span id="spanProcessingProgram" style="display: none">Processing... <img src="../images/bx_loader.gif" /></span>
								<button type="submit" class="btn btn-primary" id="programaddsave"><i class="fa fa-save"></i>  Save</button>
								<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
							</div>
						</form>
					</div>	
				</div>
			</div>
		</div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<link href="<?php echo base_url(); ?>public/css/datepicker3.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datepicker/bootstrap-datepicker.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/daterangepicker/moment.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin/program_course_mapping.js"></script>

   