<!--<link  rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery-ui.css"/>
<link rel="stylesheet" media="all" type="text/css" href="<?php echo base_url(); ?>public/assets/js/jquery-ui-timepicker-addon.css"/>-->
<!--<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/template_lib/plugins/datepicker/datepicker3.css" />-->
<!--<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/template_lib/plugins/jquery-ui-1.11.4/jquery-ui.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/template_lib/plugins/jquery-ui-1.11.4/jquery-ui.theme.min.css" />-->
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
					<ul class="nav nav-tabs" role="tablist">
						
						<li id ="additional_tab" class="active"><a href="#additional" data-toggle='tab'>Additional Setup</a></li>
					</ul>
				<!--</div>
				<div class="panel-body">-->
					<div class="tab-content">
						
						<div class="chart tab-pane active" id="additional">
							<div>
								<table class="table table-striped table-bordered" id="tblProgramAdditional" width="100%">
									<thead>
										<tr>
											<th >#</th>
											<th >Drive</th>
											<th >Advertisement No</th>
											<th >Advertisement Name</th>
											<th >Advertisement Date</th>
											<th hidden>Advt Id</th>
											<th >Action</th>
										</tr>
									</thead>
									<tbody>

									</tbody>
								</table>
							</div> 
							<!--<button type="submit" class="btn btn-success" id="btnCopyProgram"><i class="fa fa-refresh" aria-hidden="true">&nbsp;Copy</i></button>
							<button type="submit" class="btn btn-warning" id="btnPublishProgram"><i class="fa fa-check-square-o" aria-hidden="true">&nbsp;Review & Publish</i></button>-->
						</div>
					</div>
				</div>
				<!--</div>
			</div>-->
			<div class="modal fade" id="programAdditionalModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
								&times;
							</button>
							<h4 class="modal-title" id="myModalLabel">Add Advertisement Data</h4>
						</div>
						<div class="modal-body">
							<form class="form-horizontal" role="form" id="frmAdditionalData" name="frmAdditionalData">
								
								<input type="hidden" class="form-control" id="hidUniqueidAdditional" name="hidUniqueidAdditional">
								<div class="row col-sm-12 col-xs-12 ">
									<div class="col-sm-6 col-xs-6">
										<div class="form-group">
											<label for="" class="col-sm-5 control-label"><i style="color:red;font-size:15px;">*</i> Drive :</label>
											<div class="col-sm-7">
												<select class="form-control" id="cmbProgramGroup" name="cmbProgramGroup">
												</select>
											</div>
										</div>
										<div class="form-group">
											<label for="" class="col-sm-5 control-label"><i style="color:red;font-size:15px;">*</i> Advertisement No. :</label>
											<div class="col-sm-7">
												<input class="form-control" id="advNo" name="advNo">
											</div>
										</div>
										<div class="form-group">
											<label for="" class="col-sm-5 control-label"><i style="color:red;font-size:15px;">*</i> Advertisement Date</label>
											<div class="col-sm-7">
												<input type="text" class="form-control tooltips" id="txtAdvtDate" name="txtAdvtDate" placeholder="Advertisement Date" title="Advertisement Date">
											</div>
										</div>
									</div>
								</div>
								<div class="row col-sm-12 col-xs-12 " >
									<div class="form-group">
										 <div class="col-sm-6 col-xs-6">
										 	<label class="col-sm-5 control-label"><i style="color:red;font-size:15px;">*</i> Upload Pdf:</label>
											<div class="col-sm-7 input-file" >
												<input type="file" class="form-control" id="filePdf" name="filePdf" />
												File-Type: pdf/PDF<br/>
												File-Size: 10 MB Max<br/>
												(The PDF file should be like this sample file.)
											</div>
										 </div>	
									</div>
								</div>	
								
								<div class="modal-footer">
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
							<h4 class="modal-title" id="myModalLabel">Edit Advertisement</h4>
						</div>
						<div class="modal-body">
							<form class="form-horizontal" role="form" id = "frmProgramEdit" name = "frmProgramEdit">
								<input type="hidden" class="form-control" id="hidUniqueidEdit" name="hidUniqueidEdit">
								<div class="row col-sm-12 col-xs-12 ">
									<div class="col-sm-6 col-xs-6">
										<div class="form-group">
											<label for="" class="col-sm-5 control-label"><i style="color:red;font-size:15px;">*</i> Drive :</label>
											<div class="col-sm-7">
												<select class="form-control" id="cmbProgramGroupEdit" name="cmbProgramGroupEdit">
												</select>
											</div>
										</div>
										<div class="form-group">
											<label for="" class="col-sm-5 control-label"><i style="color:red;font-size:15px;">*</i> Advertisement No. :</label>
											<div class="col-sm-7">
												<input class="form-control" id="advNoEdit" name="advNoEdit">
											</div>
										</div>
										<div class="form-group">
											<label for="" class="col-sm-5 control-label"><i style="color:red;font-size:15px;">*</i> Advertisement Date</label>
											<div class="col-sm-7">
												<input type="text" class="form-control tooltips" id="txtAdvtDateEdit" name="txtAdvtDateEdit" placeholder="Advertisement Date" title="Advertisement Date">
											</div>
										</div>
									</div>
								</div>
								<div class="row col-sm-12 col-xs-12 " >
									<div class="form-group">
										 <div class="col-sm-6 col-xs-6">
										 	<label class="col-sm-5 control-label"><i style="color:red;font-size:15px;">*</i> Upload Pdf:</label>
											<div class="col-sm-7 input-file" >
												<input type="file" class="form-control" id="filePdfEdit" name="filePdfEdit" />
												File-Type: pdf/PDF<br/>
												File-Size: 10 MB Max<br/>
												(The PDF file should be like this sample file.)
											</div>
										 </div>	
									</div>
								</div>	
								
								<div class="modal-footer">
									<button type="submit" class="btn btn-primary" id="programaddsave"><i class="fa fa-save"></i>  Save</button>
									<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
								</div>
							</form>
						</div>	
					</div>
				</div>
			</div>
			<div class="modal fade" id="programDeleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog" style="width: 50%;">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
								&times;
							</button>
							<h4 class="modal-title" id="myModalLabel">Delete Advertisement</h4>
						</div>
						<div class="modal-body">
							<input type="hidden" class="form-control" id="hidUniqueidDelete" name="hidUniqueidDelete">
							<center><h2>Do You Want to Delete This Record?</h2></center>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger" id="programDeleteRecord"><i class="fa fa-trash"></i>  Delete</button>
							<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>
						</div>
					</div>
				</div>
			</div>
		</div><!-- /.row -->
	</div><!-- /#page-wrapper -->
</div><!-- /#wrapper -->
<!--<script src="<?php echo base_url(); ?>public/template_lib/plugins/jquery-ui-1.11.4/jquery-ui.min.js"></script>-->
<!--<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datepicker/bootstrap-datepicker.js"></script>-->
<!--<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/daterangepicker/moment.min.js"></script>
-->

<!--<script src="<?php echo base_url(); ?>public/js/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>public/js/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/js/moment.min.js"></script>
<script src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrap-datepicker.js"></script>-->
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin/manageadvertisement.js?v=3"></script>			