
<style>
.control-label{
	text-align: right;
    margin-top: 10px;
}
</style>

<div class="content-wrapper">
	<!--<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Document Download</h1>
        </div>
    </div>-->
    <section class="content-header">
      	<h1>
        	Document Download
      	</h1>
    </section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-lg-12" style="padding-top:0px;">
				<div class="panel panel-default">	
					<div class="panel-body box box-default">
						<div style="border-radius:0px;border: 0px inset;padding-left:20px;padding-right:20px;padding-top:0px;">
							<div class="form-group" style="padding-bottom: 5%;">
								<label for="" class="control-label col-sm-1" id ="cmbProgramGroupl" >Recruitment Drive:</label>
								<div class="col-sm-3">
									<select class="form-control" name="cmbProgramGroup" id="cmbProgramGroup">
									</select>
								</div>
								<label for="" class="control-label col-sm-1" style="" id="cmbPrograml">Post:</label>
								<div class="col-sm-3">
									<select class="form-control" name="cmbProgram" id="cmbProgram">
										<option value=''>Select Post</option>
									</select>
								</div>
								<label for="" class="control-label col-sm-1" style="">Round:</label>
								<div class="col-sm-3">
									<select class="form-control" name="cmbRound" id="cmbRound">
										<option value=''>Select Round</option>
									</select>
								</div>
							</div>
							<form class="form-horizontal" method="post" role="form" id="frmDocDown" name="frmDocDown">
								
							    <div class="form-group">
									<input type="hidden" name="removeid" id="removeid" value="" />
									<table class="table table-striped table-bordered " id="tblDocDown">
										<thead>
					      					<tr>
					      						<th>Sl No</th>
					      						<th>Name</th>
					      						<th>Roll No</th>
					      						<th>Mobile Number</th>
					      						<th>Secured Marks</th>
					      						<th hidden>Appl No</th>
					      						<th hidden>Applied Post</th>
					      						<th>View Documents</th>
					      						<th>Download Documents</th>
					      						
					      					</tr>
				      					</thead>
				      					<tbody>
				      						<td colspan="9" style="text-align: center">No Data Available</td>
				      					</tbody>
									</table>
								</div>
						    </form>	
						</div>
						
						
					</div>
				</div>
			</div>
		</div>
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<!--Modal for slot cancellation -->

<script type="text/javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datatable/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datatable/js/jszip.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datatable/js/buttons.html5.min.js"></script>	
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin/doc_download.js"></script>
