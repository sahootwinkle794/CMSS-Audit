<div class="content-wrapper">
	<section class="content-header">
      	<h1>
        	Merit List
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
										<div class="col-sm-2">
											<select class="form-control" name="cmbProgramGroup" id="cmbProgramGroup">
											</select>
										</div>
										<label for="" class="control-label col-sm-1" style="text-align:left;" id="cmbPrograml">Post:</label>
										<div class="col-sm-2">
											<select class="form-control" name="cmbProgram" id="cmbProgram">
												<option value=''>Select Post</option>
											</select>
										</div>
										<label for="" class="control-label col-sm-1" style="text-align:left;">Round:</label>
										<div class="col-sm-2">
											<select class="form-control" name="cmbRound" id="cmbRound">
												<!--<option value=''>Select Round</option>
												<option value='1'>1</option>
												<option value='2'>2</option>
												<option value='3'>3</option>
												<option value='4'>4</option>-->
											</select>
										</div>
										<div class="col-sm-1" >
											<button type="button" class="btn btn-info tooltips" name="btnFilter" id="btnFilter" title="Filter Application"><i class="fa fa-filter"></i> &nbsp;Filter</button>
										</div>
									</div>
									<br /><br /><br />
						        </div>
						    	<!-- /.col-lg-12 -->
							</div>
							 &nbsp; &nbsp;
							<!--<button id="btnUploadReport" class="btn btn-success "><i class="fa fa-upload"></i> Upload Data</button> &nbsp; &nbsp;
							<button id='btnPublishResult' type="submit" class='btn btn-success tooltips' title='Publish Result'> Publish Result</button>
							-->
							<table class="table table-striped table-bordered " id="dtblApplicationDetail">
								<thead>
									<tr>
										<th >#</th>
										<th >Name</th>
										<th >Roll No</th>
										<th >Appl No</th>
										<th >Mark</th>
										<th >Action</th>
									</tr>
								</thead>
								<tbody>
								
								</tbody>
							</table>
							<div  id = "bulk" class="form-group" style="margin-top: 10px">
								<label class="col-sm-2 control-label" for="cmbExamCenter" style="font-size:16px;" >From Sl:</label>
								<div class="col-sm-1">
									<input type="text" class="form-control" name="txtFromSlNo" id="txtFromSlNo" />
								</div>
								<label class="col-sm-2 control-label" for="cmbExamCenter" style="font-size:16px;" >To Sl:</label>
								<div class="col-sm-1">
									<input type="text" class="form-control" name="txtToSlNo" id="txtToSlNo" />
								</div>
								
								<div class="col-sm-2">
									<button type="button" class="btn btn-info custombtn" id="btnBulkdownload" name="btnBulkdownload">Bulk Download</button>
								</div>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		 <!-- Modal for publish result-->
		
	
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<link href="<?php echo base_url(); ?>public/assets/js/buttons.dataTables.min.css" type="text/css" />
<script src="<?php echo base_url(); ?>public/assets/js/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>public/assets/js/buttons.flash.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>public/assets/js/jszip.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>public/assets/js/pdfmake.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>public/assets/js/vfs_fonts.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>public/assets/js/buttons.html5.min.js" type="text/javascript"></script>

<link href="<?php echo base_url(); ?>public/css/datepicker3.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin/merit_list.js?v=3"></script>

   