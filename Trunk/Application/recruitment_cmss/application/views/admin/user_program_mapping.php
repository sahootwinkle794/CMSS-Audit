<style>
	.modal-content {
	    background: #FFFFFF;
	}
</style>
<div class="content-wrapper">
    <section class="content-header">
      	<h1>
        	User Program Mapping
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
									<table class="table table-striped table-bordered " id="tbluserprogrammapping">
										<thead>
											<tr>
												<th >Sl. No.</th>
												<th  hidden="">Id</th>
												<th  >User Code</th>
												<th >Admin Name</th>
												<th  hidden="">Program Code</th>
												<th >Program Name</th>
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
			</div><br />
			<div class="modal-body">
				<form class="form-horizontal" id="userprogrammapingForm" name="userprogrammapingForm">
					<div id="errorlog" style="display: none; color: red; font-size: 12px;"></div>
					<input type="hidden" id="hidid" name="hidid" value=""/>
					<input type="hidden" id="hidOperType" name="hidOperType" value="Add_user_program_maping_setup"/>
					<input type="hidden" class="form-control" id="hidAction" name="hidAction" value="Add">
					
					<div class="form-group">
						<label for="cmbadmin" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Admin Name</label>						
						<div class="col-sm-9">
							 <select class="form-control" name="cmbadmin" id="cmbadmin">
								<option value=''>Select Admin</option>							
							 </select>
						</div>
					</div>
					
					<div>
						<table class="table  table-bordered" id="dtblSelectedProgramName" width="100%">
							<thead>
								<tr>
									<th >#</th>
									<th hidden="">Id</th>
									<th hidden="">program_code</th>
									<th >Program Name</th>
									<th >
										<label class="control control--checkbox" style="margin-top: 5px;">  
											<input type="checkbox" class="tooltips" title="Select All" id="chkSelectedUpdateAll" name="chkSelectedUpdateAll" value=""/>
											<div class="control__indicator"></div>
										</label>
									</th>
								</tr>
							</thead>
						</table> 
						<!--<button type="button" class="btn btn-warning" name="btnSelectedUpdateSingle" id="btnSelectedUpdateSingle" /><i class="fa fa-pencil-square-o" aria-hidden="true">&nbsp;Update</i></button>-->
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
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin/user_program_mapping.js"></script>     