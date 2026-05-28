<link href="<?php echo base_url(); ?>public/assets/js/timeline/timeline.css" rel="stylesheet /">
<style>
	h5{
		font-weight: bold;
		color: blue;
	}
	.form-horizontal {
	    padding: 0px 10px 3px 35px;
	}
</style>

<div class="content-wrapper">
	<div class="row">
		<br />
		<div class="col-lg-12">
			<!--<div class="panel with-nav-tabs panel-primary">
				<div class="panel-heading">-->
				<div class="nav-tabs-custom box box-default">
						<div class="" id="additional">
							<div>
								<table class="table table-striped table-bordered"   id="tbluploadresult" width="100%">
									<thead>
										<tr>
											<th >#</th>
											<th >Instruction</th>
											<th hidden="">Id</th>
											<th >Action</th>
										</tr>
									</thead>
							</table>
							</div> 
							<!--<button type="submit" class="btn btn-success" id="btnCopyProgram"><i class="fa fa-refresh" aria-hidden="true">&nbsp;Copy</i></button>
							<button type="submit" class="btn btn-warning" id="btnPublishProgram"><i class="fa fa-check-square-o" aria-hidden="true">&nbsp;Review & Publish</i></button>-->
						</div>
				</div>
			
			<div class="modal fade" id="programAdditionalModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
								&times;
							</button>
							<h4 class="modal-title" id="myModalLabel">INSTRUCTION</h4>
						</div>
						<div class="modal-body">
							<form class="form-horizontal" role="form"  id="frmAdditionalData" name="frmAdditionalData">
								<!--<input type="hidden" id="hidSessionCode" name="hidSessionCode" value="<?=$MY_SESSION_NAME?>"/>-->
								<input type="hidden" class="form-control" id="hidUniqueidAdditional" name="hidUniqueidAdditional">
								<input type="hidden" class="form-control" id="hidUniqueidprogram" name="hidUniqueidprogram">
								<div class="row col-sm-12 col-xs-12 ">
										<div class="col-sm-12 col-xs-12">
											
											
											
											<div class="form-group">
											
											 	<div class="form-group">
											
												 	<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> Instruction:</label>
													<div class="col-sm-8">
													<textarea name="txtareainstruction" style="overflow: y;" class="form-control ckeditor" required="required" autocomplete="off" ></textarea>
													</div>
											
												</div>
											
											</div>
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
			<div class="modal fade" id="programEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
								&times;
							</button>
							<h4 class="modal-title" id="myModalLabel">Edit Post</h4>
						</div>
						<div class="modal-body">
							<form class="form-horizontal" role="form" id = "frmProgramEdit" name = "frmProgramEdit">
								<input type="hidden" class="form-control" id="hidUniqueidEdit" name="hidUniqueidEdit">
								<input type="hidden" class="form-control tooltips" id="txtProgramCodeEdit" name="txtProgramCodeEdit" title="Code of Post" placeholder="Unique Code of Post">
								<div class="row col-sm-12 col-xs-12 ">
									<div class="col-sm-6 col-xs-6">	
										<h5>Post Details:</h5>
										<div class="form-group">
											<label for="" class="col-sm-4 control-label">Name</label>
											<div class="col-sm-8">
												<input type="text" class="form-control tooltips" id="txtProgramNameEdit" name="txtProgramNameEdit" placeholder="Name Of Post" title="Name Of Post">
											</div>
										</div>
										<!-- ADDED-->
										<div class="form-group">
											<label for="" class="col-sm-4 control-label">Post Description</label>
											<div class="col-sm-8">
												<textarea class="form-control" cols="3" rows="3" id="taProgramDescriptionEdit" name="taProgramDescriptionEdit" placeholder="Description Of Post"></textarea>
											</div>
										</div>
										
										<!-- upto this-->
										<div class="form-group">
											<label for="" class="col-sm-4 control-label">Year</label>
											<div class="col-sm-8">
												<input type="text" class="form-control tooltips" id="txtYearEdit" name="txtYearEdit" placeholder="Pick Year" title="Pick Year">
											</div>
										</div>
										
										<h5>Application Date:</h5>
										<div class="form-group">
											<label for="" class="col-sm-4 control-label">From</label>
											<div class="col-sm-8">
												<input type="text" class="form-control tooltips" id="txtStartdateEdit" name="txtStartdateEdit" placeholder="Apply Start Date" title="Post Start Date" placeholder="Post Start Date">
											</div>
										</div>	
										<div class="form-group">	
											<label for="" class="col-sm-4 control-label">To</label>
											<div class="col-sm-8">
												<input type="text"  class="form-control tooltips" id="txtEnddateEdit" name="txtEnddateEdit" placeholder="Apply End Date" title="Post End Date" placeholder="Post End Date">
											</div>
										</div>
										<div class="form-group">
											<label for="" class="col-sm-4 control-label">Registration Field Template</label>
											<div class="col-sm-6">
												<select class="form-control" id="cmbRegistrationTemplateEdit" name="cmbRegistrationTemplateEdit" placeholder="Registration Field Template">
													
												</select>
											</div>
											<div class="col-sm-2">
												<button type="button" class="btn btn-success tooltips" title="View" id="btnRegistrationViewEdit"><i class="fa fa-search" aria-hidden="true"></i></button>
											</div>
										</div>
									</div>	
									<div class="col-sm-6 col-xs-6">		
										<h5>Age Criteria:</h5>
										<div class="form-group">
											<label for="" class="col-sm-4 control-label">Birth Start Date</label>
											<div class="col-sm-8">
												<input type="text"  class="form-control tooltips" id="txtAgeStartdateEdit" name="txtAgeStartdateEdit"  title="Eligible Start Date" placeholder="Birth Start Date">
											</div>
										</div>
										<div class="form-group">	
											<label for="" class="col-sm-4 control-label">Birth End Date</label>
											<div class="col-sm-8">
												<input type="text"  class="form-control tooltips" id="txtAgeEnddateEdit" name="txtAgeEnddateEdit"  title="Eligible End Date" placeholder="Birth End Date">
											</div>
										</div>
										
										<div class="form-group">
											<label for="" class="col-sm-4 control-label">OMR Sl No</label>
											<div class="col-sm-8">
												<input type="text" class="form-control tooltips" id="txtOmrNoEdit" name="txtOmrNoEdit" placeholder="Enter OMR SlNo" title="Enter OMR SlNo">
											</div>
										</div>
										<div class="form-group">
											<label for="" class="col-sm-4 control-label">Status</label>
											<div class="col-sm-8">
												<select class="form-control" id="cmbStatusEdit" name="cmbStatusEdit">
													<option value="Active">Active</option>
													<option value="Inactive">Inactive</option>
												</select>
											</div>
										</div>
										
										<h5>Post Date:</h5>
										<div class="form-group">
											<label for="" class="col-sm-4 control-label">From</label>
											<div class="col-sm-8">
												<input type="text"  class="form-control tooltips" id="txtAppStartdateEdit" name="txtAppStartdateEdit"  title="Post Start Date" placeholder="Apply Start Date">
											</div>
										</div>	
										<div class="form-group">
											<label for="" class="col-sm-4 control-label">To</label>
											<div class="col-sm-8">
												<input type="text"  class="form-control tooltips" id="txtAppEnddateEdit" name="txtAppEnddateEdit"  title="Post End Date" placeholder="Apply End Date">
											</div>
										</div>
										<div class="form-group">
											<label for="" class="col-sm-4 control-label">Profile Template</label>
											<div class="col-sm-6">
												<select class="form-control" id="cmbTemplateEdit" name="cmbTemplateEdit" placeholder="Profile Template">
													
												</select>
											</div>
											<div class="col-sm-2">
												<button type="button" class="btn btn-success tooltips" title="View" id="btnViewEdit"><i class="fa fa-search" aria-hidden="true"></i></button>
											</div>
										</div>
									</div>
								</div>	
								
								<div class="modal-footer">
									<button type="submit" class="btn btn-primary" id="programEditSave"><i class="fa fa-save"></i>  Save</button>
									<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
								</div>
							</form>
						</div>	
					</div>
				</div>
			</div>	
		</div><!-- /.row -->
	</div><!-- /#page-wrapper -->
</div><!-- /#wrapper -->
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin/general_instruction.js?v=3"></script>		
<script src="<?=base_url()?>public/template_lib/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>	