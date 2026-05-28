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
	<div class="row">
        <section class="content-header">
	      	<h1>
	        	Invigilator Setup
	      	</h1>
	    </section>
	</div>
    <!-- Main content -->
    <section class="content">
		<div class="row">
			<div class="col-lg-12" style="padding-top:0px;">
				<div class="panel panel-default">	
					<div class="panel-body box box-default">
						<div style="border-radius:0px;border: 0px inset;padding-left:20px;padding-right:20px;padding-top:0px;">
							<table class="table table-striped table-bordered " id="dtblApplicationDetail">
								<thead>
									<tr>
										<th >#</th>
										<th hidden="">Post Code</th>
										<th >Post</th>
										<th >Code</th>
										<th >Name</th>
										<th >Designation</th>
										<th >From</th>
										<th hidden="">Mail Id</th>
										<th hidden="">Mobile</th>
										<th >Action</th>
										
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
						<h4 class="modal-title" id="myModalLabel">Add Records</h4>
					</div>
					<div class="modal-body">
						<form class="form-horizontal" role="form"  id="frmAddProgram" name="frmAddProgram">
							<input type="hidden" class="form-control" id="hidUniqueid" name="hidUniqueid">
							<input type="hidden" class="form-control" id="hidUniquePostId" name="hidUniquePostId">
							<input type="hidden" class="form-control" id="hidAction" name="hidAction" value="Add">
							<div class="form-group" style="margin-top: 20px;">
								<label class="col-sm-4 control-label"><i style="color:red;font-size:18px;">*</i> Post</label>
								<div class="col-sm-8">
									<select class="form-control" id="cmbProgram" name="cmbProgram"></select>
								</div>
							</div>
							<div class="form-group">
								<label for="inputname" class="col-sm-4 control-label"><i style="color:red;font-size:18px;">*</i>&nbsp;Code</label>
								<div class="col-sm-8">
									<input type="text" class="form-control tooltips" id="txtInvigilatorCode" readonly="" name="txtInvigilatorCode" title="Code" placeholder="Unique Code" maxlength="20">
								</div>
							</div>
							<div class="form-group">
								<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:18px;">*</i>&nbsp;Name</label>
								<div class="col-sm-8">
									<input type="text" class="form-control tooltips" id="txtInvigilatorName" name="txtInvigilatorName" placeholder="Name" title="Name" maxlength="80">
								</div>
							</div>
							<div class="form-group">
								<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:18px;">*</i>&nbsp;Email</label>
								<div class="col-sm-8">
									<input type="text" class="form-control tooltips" id="txtMailId" name="txtMailId" placeholder="Email Id" title="Email Id" maxlength="80">
								</div>
							</div>
							<div class="form-group">
								<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:18px;">*</i>&nbsp;Mobile No</label>
								<div class="col-sm-8">
									<input type="text" class="form-control tooltips" id="txtPhoneNo" name="txtPhoneNo" placeholder="Mobile No" title="Mobile No" maxlength="20">
								</div>
							</div>
							<div class="form-group">
								<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:18px;">*</i>&nbsp;From</label>
								<div class="col-sm-8">
									<input type="text" class="form-control tooltips" id="txtFrom" name="txtFrom" placeholder="From" title="From" maxlength="20">
								</div>
							</div>
							<div class="form-group">
								<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:18px;">*</i>&nbsp;Designation</label>
								<div class="col-sm-8">
									<input type="text" class="form-control tooltips" id="txtDesignation" name="txtDesignation" placeholder="Designation" title="Designation" maxlength="200">
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
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin/invigilator_setup.js"></script>

   