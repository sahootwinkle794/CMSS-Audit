<div class="content-wrapper">
    <section class="content-header">
      	<h1>
        	Program Declaration Data
      	</h1>
    </section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-lg-12" style="padding-top:0px;">
				<div class="panel panel-default">	
					<div class="panel-body box box-default">
						<div style="border-radius:0px;border: 0px inset;padding-left:20px;padding-right:20px;padding-top:0px;">
						
							<!--<form class="form-horizontal" method="post" role="form" id="frmactionmaster" name="frmactionmaster">
								<input type="hidden" name="hidTemplate" id="hidTemplate" value=""/>
								
							    <div class="form-group"
									<input type="hidden" name="removeid" id="removeid" value="" />-->
									<table class="table table-striped table-bordered " id="tblprogramdeclaration">
										<thead>
											<tr>
												<th >Sl. No.</th>
												<th  hidden="">Id</th>
												<th  hidden="">Recruitment Type</th>
												<th  hidden="">Recruitment Type</th>
												<th  hidden="">program code</th>
												<th >Program Name</th>
												<th >Declaration</th>
												<th >Status</th>
												<th >Action</th>	
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								<!--</div>
						    </form>-->	
						</div>
					</div>
				</div>
			</div>
		</div>
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<div class="modal fade" id="program_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog" style="width: 50%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
				&times;</button>
				<h4 class="modal-title" id="myModalLabel"> </h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" id="programdeclarationForm" name="programdeclarationForm">
					<div id="errorlog" style="display: none; color: red; font-size: 12px;"></div>
					<input type="hidden" id="hidid" name="hidid" value=""/>
					<input type="hidden" id="hidOperType" name="hidOperType" value="Add_programdeclaration_setup"/>
					<input type="hidden" class="form-control" id="hidAction" name="hidAction" value="Add">
					
					<div class="form-group">
						<label for="cmbRecruitmentType" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Recruitment Type</label>						
						<div class="col-sm-9">
							 <select class="form-control" name="cmbRecruitmentType" id="cmbRecruitmentType">
								<option value=''>Select Recruitment Type</option>							
							 </select>
						</div>
					</div>
					<div class="form-group">
						<label for="cmbProgramName" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Program Name</label>						
						<div class="col-sm-9">
							 <select class="form-control" name="cmbProgramName" id="cmbProgramName">
								<option value=''>Select Program Name</option>							
							 </select>
						</div>                        
					</div>
					<div class="form-group">
						<label for="txtDeclaration" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i>&nbsp;Declaration</label>
						<div class="col-sm-9">
							 <textarea id="txtDeclaration" name="txtDeclaration" style="height: 100px;" class=" form-control"></textarea> 
							 <!--<input type="text" class="form-control" name="txtDeclaration" id="txtDeclaration" value="" autocomplete="off">-->
						</div>
				    </div>					
					<div class="form-group">
						<label for="cmbRecordStatus" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Status</label>
						<div class="col-sm-9">
							<select class="form-control tooltips" id="cmbRecordStatus" name="cmbRecordStatus" title="Select Status">
								<option value="1" selected>Active</option>
								<option value="0" >Inactive</option>
							</select>
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
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin/program_declaration_data.js"></script>   