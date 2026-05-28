			<div class="content-wrapper">
				<section class="content-header">
			      	<h1>
			        	Upload Scanned Copy
			      	</h1>
			    </section>
				
				<!-- Main content -->
			    <section class="content">
					<div class="row">
							<div class="col-lg-12">
								<!--<div class="panel-body">-->
								<div class="nav-tabs-custom box box-default">
	           						<div class="tab-content">
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
										<label for="" class="control-label col-sm-1" style="text-align:left;">Round:</label>
										<div class="col-sm-2">
											<select class="form-control" name="cmbRound" id="cmbRound">
												
											</select>
										</div>
										<div id="bulk" class="col-sm-1" >
											<button type="button" class="btn btn-info tooltips" name="btnbulk" id="btnbulk" title="Bulk Upload"><i class="fa fa-upload"></i> Bulk Upload</button>
										</div>
									</div>
										<br /><br /><br />
										<div class="chart tab-pane in active" id="assign">
											<form class="form-horizontal" role="form" id="frmMenuAssign" name="frmMenuAssign" method="post" enctype="multipart/form-data">
												
												<div class="col-lg-12">
													<table class="table table-striped table-bordered" id="dtblProgramMenu" width="100%">
														<thead>
															<tr>
																<th >#</th>
																<th >Name</th>
																<th >Appl No</th>
																<th >Status</th>
																<th >Answer Key Challenge</th>
																<th >Action</th>
																<th hidden="hidden" >ID</th><!-- id will be hide -->
															</tr>
														</thead>
													</table>
													
													
												</div>
											</form>
										</div>	
									</div>
								</div>
							</div>
							<form name="frmUpload" method="POST" id="frmUpload" >
								<div class="modal fade" id="divModalStudent" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">					
									<div class="modal-dialog" style="width:60%">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title"><center><h2>UPLOAD FILE</h2></center></h4>
													
											</div>             										
											<div class="modal-body">
												<input type = "hidden" name = "hidapplno" id="hidapplno">
												<input type = "hidden" name = "hidAppliedProgram" id="hidAppliedProgram">
												<div class="form-group" style="left: 10%">
													<label for="Upload">Upload Scanned Sheet</label>
												    <input style="width: 80%;" class="form-control" id="file" name="file" type="file">
												   
												    <span style="color: #1189c4;"> All The documents should be .jpg/.png/.jpeg/.pdf/.doc/.docx/.JPG/.PNG/.JPEG/.PDF/.DOC/.DOCX format </span>
												    <div id="signMessage3" style="color:red;font-size:16px;"></div>
												</div>
												<div class="modal-footer">
												
													<button type="submit" class="btn btn-success" name="btnAssign" id="btnAssign" /><i class="fa fa-check-square-o" aria-hidden="true">&nbsp;Upload</i></<button>
													<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>  
												</div>
											</div>	
										</div>		
									</div>
								</div>
							</form>
							<form name="frmbulkUpload" method="POST" id="frmbulkUpload" enctype="multipart/form-data" >
								<div class="modal fade" id="divModalbulkStudent" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">					
									<div class="modal-dialog" style="width:60%">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title"><center><h2>UPLOAD ZIP FILE</h2></center></h4>
											</div>             										
											<div class="modal-body">
												<input type = "hidden" name = "hidapplnobulk" id="hidapplnobulk">
												<input type = "hidden" name = "hidAppliedProgrambulk" id="hidAppliedProgrambulk">
												<input type = "hidden" name = "hidRoundbulk" id="hidRoundbulk">
												
												<div class="form-group" style="margin-left: 10%">
													<label for="Upload">Upload Scanned Sheet</label>
												    <input style="width: 80%;" class="form-control" id="filebulk" name="filebulk" type="file">
												    <br />
												    <div id="signMessage2" style="color:red;font-size:16px;"></div>
												</div>
												<div class="modal-footer">
												
													<button type="submit" class="btn btn-success" name="btnAssignbulk" id="btnAssignbulk" /><i class="fa fa-check-square-o" aria-hidden="true">&nbsp;Upload</i></<button>
													<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>  
												</div>
											</div>	
										</div>		
									</div>
								</div>
							</form>
						<!--</form>-->
					</div><!-- /.row -->
				</section>
			</div><!-- /#page-wrapper -->
			<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin/upload_scanned_copy.js"></script>	
			<!--<script type="text/javascript" language="javascript" src="https://rawgit.com/nghuuphuoc/bootstrapvalidator/master/dist/js/bootstrapValidator.min.js"</script>	
			<script type="text/javascript" language="javascript" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"</script>	-->