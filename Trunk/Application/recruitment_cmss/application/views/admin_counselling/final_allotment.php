<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/template_lib/plugins/datepicker/datepicker3.css" />
<link href="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" media="screen" />
<div id="page-wrapper">
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Counselling Setup</h1>
        </div>
    	<!-- /.col-lg-12 -->
	</div>

    <!-- Main content -->
    <section class="content">
		<div class="row">
			<div class="form-group">
				<label for="" class="col-sm-1 control-label" style="font-size:16px;">Year:</label>
				<div class="col-sm-2">
					<select class="form-control" id="cmbYear" name="cmbYear">
						
					</select>
				</div>
				
				<label class="col-sm-2 control-label" for="txtCenterCode" style="font-size:16px;" >Counselling Name:</label>
				
				<div class="col-sm-2">
					<select class="form-control" name="cmbCounsellingName" id="cmbCounsellingName">			
						<option value="">Select</option>	
					</select>
				</div>
				<div class="col-sm-1">
					<button type="button" class="btn btn-info" id="btnAllot"><i class="fa fa-check"></i> Allot</button>
				</div>
				<div class="col-sm-2">
					<button type="button" class="btn btn-warning" id="btnFinalAllot"><i class="fa fa-check"></i> Final Allotment</button>
				</div>
				<div class="col-sm-1" style="margin-left: -20px;">
					<button type="button" class="btn btn-danger" id="btnPublish"><i class="fa fa-eye"></i> Publish</button>
				</div>
			</div>
			<br /><br />
			<div class="form-group">
				<label for="" class="col-sm-1 control-label" style="font-size:16px;"></label>
				<div class="col-sm-2">
					
				</div>
				
				<label class="col-sm-2 control-label" for="txtCenterCode" style="font-size:16px;" ></label>
				
				<div class="col-sm-2">
					
				</div>
				
				<div class="col-sm-1" >
					<button type="button" class="btn btn-success" id="btnDownload"><i class="fa fa-file-excel-o"></i> Download</button>
				</div>
				<div class="col-sm-1" style="margin-left: 30px;">
					<button type="button" class="btn btn-primary" id="btnSearch"><i class="fa fa-upload"></i> Upload</button>
				</div>
			</div>
			<br /><br />
			<div class="col-lg-12 col-sm-12">
				<div style="border-radius:0px;border: 0px inset;padding-left:20px;padding-right:20px;padding-top:0px;">
					<table class="table table-striped table-bordered " id="dtblApplicationDetail">
						<thead>
							<tr>
								<th class="text-center">#</th>
								<th class="text-center">Jee Roll No.</th>
								<th class="text-center">Name</th>
								<th class="text-center">Category</th>
								<th class="text-center">College</th>
								<th class="text-center">Program</th>
								<th class="text-center">Branch</th>
							</tr>
						</thead>
						<tbody>
						
						</tbody>
					</table>
					
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
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin_counselling/final_allotment.js"></script>

   