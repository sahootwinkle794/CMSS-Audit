<div class="content-wrapper">
	<section class="content-header">
      	<h1>
        	Generate Report
      	</h1>
    </section>
	
	<!-- Main content -->
    <section class="content">
		<div class="row">
			<div class="col-lg-12" style="padding-top:0px;">
				<div class="panel panel-default">	
					<div class="panel-body box box-default">
						<div style="border-radius:0px;border: 0px inset;padding-left:20px;padding-right:20px;padding-top:0px;">
							<form class="form-horizontal" method="post" role="form" id="frmApplyNew" name="frmApplyNew">
								<input type="hidden" name="hidProgram" id="hidProgram" value=""/>
							</form>
							<!--<div class="col-sm-2">
								
							</div>-->
							<div class="row">
								<div class="col-lg-12">
						        	
						            <!--<h1 class="page-header">Result Upload</h1>-->
						            <div class="form-group">
										<label for="" class="control-label col-sm-2" id ="cmbProgramGroupl" >Recruitment Drive:</label>
										<div class="col-sm-4">
											<select class="form-control" name="cmbProgramGroup" id="cmbProgramGroup">
											</select>
										</div>
										<label for="" class="control-label col-sm-1" style="text-align:left;" id="cmbPrograml">Post:</label>
										<div class="col-sm-4">
											<select class="form-control" name="cmbProgram" id="cmbProgram">
												<option value=''>Select Post</option>
											</select>
										</div>
										
									</div>
								</div>
								<br /><br /><br />
								<div class="col-lg-12">
									<div class="form-group">
										<label for="" class="control-label col-sm-2" style="text-align:left;">Round:</label>
										<div class="col-sm-3">
											<select class="form-control" name="cmbRound" id="cmbRound">
												<option value=''>Select Round</option>
											</select>
										</div>
										
										<label for="" class="control-label col-sm-2" style="text-align:left;">Type of Report:</label>
										<div class="col-sm-3">
											<select class="form-control" name="cmbExcel" id="cmbExcel">
												<option value=''>Select Excel Type</option>
												<option value="report_c">Consolidated Report</option>
												<option value="report_sw">Subject Wise Report</option>
												<option value="report_cc">Consolidated With Count</option>
												<option value="report_swc">Subject Wise With Count</option>
											</select>
										</div>
										
										
										<div class="col-sm-2" >
											<button type="button" class="btn btn-info btn-circle tooltips" name="btnFilter" id="btnFilter" title="Filter Application"><i class="fa fa-filter"></i></button> &nbsp;&nbsp;
											<button type="button" class="btn btn-success btn-circle btn-sm tooltips" id="btnExcelDownload" title="Excel Download" style="margin-top: 0.3%"><i class="fa fa-file-excel-o"></i> </button>
										</div>
										
									</div>
									<br /><br /><br />
						        </div>
						    	<!-- /.col-lg-12 -->
							</div>
							<div class="col-lg-12 col-sm-12" id="tableCReport" style="display: none;">
								<table class="table table-striped table-bordered " id="dtblReportC">
									<thead>
										<tr>
											<th >#</th>
											<th >Name</th>
											<th >Roll No</th>
											<th >Marks</th>
											<th >Rank</th>
										</tr>
									</thead>
									<tbody>
									
									</tbody>
								</table>
							</div>
							<div class="col-lg-12 col-sm-12" id="tableSWReport" style="display: none;"></div>
							<div class="col-lg-12 col-sm-12" id="tableCCReport" style="display: none;">
								<table class="table table-striped table-bordered " id="dtblReportCC">
									<thead>
										<tr>
											<th rowspan="2">#</th>
											<th rowspan="2">Name</th>
											<th rowspan="2">Roll No</th>
											<th colspan="4" style="text-align: center">Total</th>
											<th rowspan="2">Rank</th>
										</tr>
										<tr>
											<th >Right Count</th>
											<th >Wrong Count</th>
											<th >Blank Count</th>
											<th >Marks</th>
										</tr>
									</thead>
									<tbody>
									
									</tbody>
								</table>
								
							</div>
							<div class="col-lg-12 col-sm-12" id="tableSWCReport" style="display: none;white-space:nowrap;overflow-y:auto;"></div>
							<div class="alert alert-danger alert-dismissible" id="alert2" role="alert" style="display:none;"> <!-- Alert for error -->
								<div id="alertmessageDanger"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<link href="<?php echo base_url(); ?>public/assets/js/buttons.dataTables.min.css" type="text/css" />
<script src="<?php echo base_url(); ?>public/assets/js/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>public/assets/js/buttons.flash.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>public/assets/js/jszip.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>public/assets/js/pdfmake.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>public/assets/js/vfs_fonts.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>public/assets/js/buttons.html5.min.js" type="text/javascript"></script>
<!--<script src="<?php echo base_url(); ?>public/assets/js/datatable_excel/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>public/assets/js/datatable_excel/buttons.html5.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>public/assets/js/datatable_excel/buttons.print.min.js" type="text/javascript"></script>-->

<link href="<?php echo base_url(); ?>public/css/datepicker3.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin/generate_report.js?v=3"></script>

   