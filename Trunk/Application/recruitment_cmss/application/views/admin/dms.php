<style>
	.modal-body {
    position: relative;
    
    padding-left: 45px;
    }
</style>

<div class="content-wrapper">
	<!--<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">DOCUMENT MANAGEMENT SYSTEM</h1>
        </div>
	</div>-->
	<section class="content-header">
      	<h1>
        	Document Management System
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
								<div class="panel panel-default">
									<div class="panel-body">
										<input type="hidden" name="hidProgram" id="hidProgram" value=""/>
										<div class="form-group">
											<label for="" class="control-label col-sm-2" id ="cmbProgramGroupl" >Recruitment Drive:</label>
											<div class="col-sm-3">
												<select class="form-control" name="cmbProgramGroup" id="cmbProgramGroup">
												</select>
											</div>
											<label for="" class="control-label col-sm-2" style="text-align:left;" id="cmbPrograml">Post:</label>
											<div class="col-sm-4">
												<select class="form-control" name="cmbProgram" id="cmbProgram">
													<option value=''>Select Post</option>
												</select>
											</div>
											
										</div>
									<!--</form>
									<form class="form-horizontal" method="post" role="form" id="frmSearch" name="frmSearch">-->
								
									    <div class="form-group">
											
											<label for="" class="control-label col-sm-2">Mobile No:</label>
											<div class="col-sm-3" >
												<input type="text" class="form-control" id="txtMobileNo" name="txtMobileNo" placeholder="Enter Mobile No" value="">
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
										<th >#</th>
										<th >Name</th>
										<th >Mobile No</th>
										<th >Appl No</th>
										<th  hidden="">Institute Code</th>
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
		<div id="eModal" class="modal fade" role="dialog" aria-labelledby="eModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-md ">

		    <!-- Modal content-->
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <br />
		      </div>
		      <div class="modal-body">
		        <div id="dataPreview"></div>
		      </div>
		      <div class="modal-footer">
		      	<!--<button type="button" class="btn btn-warning" id="btnEdit" name="btnEdit" onclick="edit_template('<?php echo $file_name; ?>')">Edit</button>-->
		      	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin/dms.js?v=3"></script>

   