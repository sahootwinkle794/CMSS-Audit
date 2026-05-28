<div id="page-wrapper">
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Applicant List</h1>
        </div>
    	<!-- /.col-lg-12 -->
	</div>

    <!-- Main content -->
    <section class="content">
		<div class="row">
			<div class="col-lg-12" style="padding-top:0px;">
				<div class="panel panel-default">	
					<div class="panel-body">
						<div style="border-radius:0px;border: 0px inset;padding-left:20px;padding-right:20px;padding-top:0px;">
							<form class="form-horizontal" method="post" role="form" id="frmApplyNew" name="frmApplyNew">
								<div class="panel panel-default">
									 <div class="panel-body">
									    <div class="form-group">
											<label for="" class="control-label col-sm-2" style="text-align:left;">Applicant Name:</label>
											<div class="col-sm-3">
												<input type="text" class="form-control" id="txtApplicantName" name="txtApplicantName" placeholder="Enter Name" value="">
											</div>
											<label for="" class="control-label col-sm-2">JEE Roll No:</label>
											<div class="col-sm-3" >
												<input type="text" class="form-control" id="txtRollNo" name="txtRollNo" placeholder="Enter JEE Roll No" value="">
											</div>
											<div class="col-sm-1" >
												<button type="button" class="btn btn-info tooltips" name="btnFilter" id="btnFilter" title="Filter Application"><i class="fa fa-filter"></i> &nbsp;Filter</button>
											</div>
										</div>
									</div>
								</div>
							</form>
							
							<table class="table table-striped table-bordered " id="dtblApplicationDetail">
								<thead>
									<tr>
										<th class="text-center">#</th>
										<th class="text-center">Name</th>
										<th class="text-center">Jee Roll No</th>
										<th class="text-center">Gender</th>
										<th class="text-center">Category</th>
										<th class="text-center">Mobile No</th>
										<th class="text-center">Email</th>
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
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin/applicant_list.js"></script>

   