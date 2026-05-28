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
	
    <!-- Main content -->
    <section class="content">
		<div class="row">
			<div class="col-lg-12" style="padding-top:0px;">
				<div class="panel panel-default">	
					<div class="panel-body box box-default">
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
									<div class="col-sm-1" >
										<button type="button" class="btn btn-info tooltips" name="btnFilter" id="btnFilter" title="Filter Application"><i class="fa fa-filter"></i> &nbsp;Filter</button>
									</div>
								</div>
								<br /><br /><br />
					        </div>
					    	<!-- /.col-lg-12 -->
						</div>
						<div style="border-radius:0px;border: 0px inset;padding-left:20px;padding-right:20px;padding-top:0px;">
							<table class="table table-striped table-bordered " id="dtblApplicationDetail">
								<thead>
									<tr>
										<th >#</th>
										<th hidden="">Post Code</th>
										<th >Post</th>
										<th >Authorised Name</th> 
										<th hidden="">Instructions</th> 
										<th hidden="">Signature</th> 
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
							<input type="hidden" class="form-control" id="hidUniqueid" name="hidUniqueid">
							<input type="hidden" class="form-control" id="hidUniquePostId" name="hidUniquePostId">
							<input type="hidden" class="form-control" id="hidAction" name="hidAction" value="Add">
							
							<div class="form-group">
								<label for="inputname" class="col-sm-4 control-label"><i style="color:red;font-size:18px;">*</i>&nbsp;Authorised Name</label>
								<div class="col-sm-8">
									<input type="text" class="form-control tooltips" id="txtAuthorisedName" name="txtAuthorisedName" title="Code" placeholder="Authorised Name" maxlength="100">
								</div>
							</div>
							<div class="form-group">
								<label for="" class="col-sm-4 control-label">&nbsp;Authorised Signature</label>
								<div class="col-sm-3">
									<input type="file" id="fileControllerSignature" name="fileControllerSignature" class="form-control"/>
									File-Type: jpg, jpeg, png<br />
									File-Size: 200kb Max<br />
									Dimension: 500*250 pixels
									<div id="signMessage" style="color:red;font-size:16px;"></div>
								</div>
								<div class="col-sm-4">
									<img id='signatureDisplayarea' src='' style='margin-left:50px;margin-right:50px;' width='100' height='100' />
								</div>
							</div>
							<div class="form-group">
								<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:18px;">*</i>&nbsp;Appointment Letter</label>
								<div class="col-sm-8">
									<textarea class="form-control" id="taExamSchedule" name="taExamSchedule"></textarea>
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
<!--<script src="//cdn.ckeditor.com/4.4.3/basic/ckeditor.js"></script>
<script src="//cdn.ckeditor.com/4.4.3/basic/adapters/jquery.js"></script>-->
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin/appointment_template.js"></script>

   