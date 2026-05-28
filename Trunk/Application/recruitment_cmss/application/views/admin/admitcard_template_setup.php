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
            <h1 class="page-header">Template Setup</h1>
        </div>
	</div>-->
	<section class="content-header">
	    <h1>
	    	Exam Type Setup
	    </h1>
    </section>
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
										<th >Code</th>
										<th >Name</th>
										<th >Description</th>
										<th >File Name</th>
										<th style="text-align: center;">Action</th>
										
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
							<!--<input type="hidden" id="hidSessionCode" name="hidSessionCode" value="<?=$MY_SESSION_NAME?>"/>-->
							<input type="hidden" class="form-control" id="hidUniqueid" name="hidUniqueid">
							<input type="hidden" class="form-control" id="hidAction" name="hidAction" value="Add">
							<div class="form-group">
								<label for="inputname" class="col-sm-4 control-label"><i style="color:red;font-size:18px;">*</i>&nbsp;Code</label>
								<div class="col-sm-8">
									<input type="text" class="form-control tooltips" id="txtTemplateCode" name="txtTemplateCode" title="Code" placeholder="Unique Code" maxlength="20">
								</div>
							</div>
							<div class="form-group">
								<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:18px;">*</i>&nbsp;Name</label>
								<div class="col-sm-8">
									<input type="text" class="form-control tooltips" id="txtTemplateName" name="txtTemplateName" placeholder="Name" title="Name" maxlength="80">
								</div>
							</div>
							<div class="form-group">
								<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:18px;">*</i>&nbsp;Description</label>
								<div class="col-sm-8">
									<textarea class="form-control" cols="3" rows="3" id="taTemplateDesc" name="taTemplateDesc"></textarea>
								</div>
							</div>
							<div class="form-group">
								<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:18px;">*</i>&nbsp;File Name</label>
								<div class="col-sm-8">
									<input type="text" class="form-control tooltips" id="txtFileName" name="txtFileName" placeholder="Name Of File" title="Name Of File"  maxlength="80">
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
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin/admitcard_template_setup.js"></script>

   