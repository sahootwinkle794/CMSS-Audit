<style>
	.form-horizontal {
	    padding: 0px 10px 3px 35px;
	}
	.bootstrap-select > .btn {

    width: 88%;
    padding-right: 25px;

}
</style>			
			<input type="hidden" id = "hidBaseAsmUrl" name="hidBaseAsmUrl" value="<?=BASE_ADM_URL?>" />
			<div class="content-wrapper">
				<div class="row">
					<!--<div class="col-lg-12">
						<h1 class="page-header">Organization Setup:</h1>
					</div>-->
					<!--<section class="content-header">
				      	<h1>
				        	Organization Setup
				      	</h1>
				    </section>-->
					<div class="col-lg-12">
						<!--<div class="panel with-nav-tabs panel-primary">
            				<div class="panel-heading">-->
            				<div class="nav-tabs-custom box box-default">
								<ul class="nav nav-tabs" role="tablist">
									<li class="active"><a href="#institute" data-toggle='tab'><b>Organization</b></a></li>
									<!--<li><a href="#institute_image_setup" data-toggle='tab'><b>Institute Image Setup</b></a></li>
									<li><a href="#application_mode" data-toggle='tab'><b>Application Mode</b></a></li>
									<li><a href="#payment_mode" data-toggle='tab'><b>Payment Mode</b></a></li>-->
									<li><a href="#exam_center" data-toggle='tab'><b>Exam Center</b></a></li>
								</ul>
							<!--</div>
							<div class="panel-body">-->
		           				<div class="tab-content">
									<div class="chart tab-pane in active" id="institute">
										<!--<div class="col-lg-12">
											<h1 class="page-header">Define Institute:</h1>
										</div>-->
										<div class="col-lg-12">
											<table class="table table-striped table-bordered" id="institutedetails" width="100%">
												<thead>
													<tr>
														<th class="text-left">#</th>
														<th class="text-left">Name</th>
														<th class="text-left">Code</th>
														<th class="text-left">Type</th>
														
														<th class="text-left">Logo URL</th>
														<th class="text-left">Mobile no.</th>
														
														<th class="text-left">Image</th>
														<th class="text-left" >Status</th>
														<th class="text-left">Logo</th>
														<th class="text-left">Location</th>
														<th class="text-left">Action</th> 
														
													</tr>
												</thead>
												<tbody>
												</tbody>
											</table>
										</div>
									</div>
									<div class="modal fade" id="instituteaddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
														&times;
													</button>
													<h4 class="modal-title" style="text-align: center;color: black;" id="myModalLabel">Add Organization</h4>
												</div>
												<div class="modal-body" style = "padding: 0px;">
													<?php echo form_open(null, array('class'=>'form-horizontal', 'id'=>'instmanageformid' ,'enctype'=>"multipart/form-data")); ?>
														<div id="errorlogInstitute" style="display: none; color: red; font-size: 12px;"></div>
													<div class="row">	
														<div class="col-sm-6">
															<div class="form-group">
																<input type="hidden" id="op_type" name="op_type" value="add_institute">
																<label for="inputname" class="col-sm-4 control-label">Name</label>
																<div class="col-sm-8">
																	<input type="text" class="form-control tooltips" id="institutename" name="institutename" title="Name of Organization" maxlength = "100" placeholder="Name of Organization">
																</div>
															</div>
														</div>
														<div class="col-sm-6">
															<div class="form-group">
																<label for="" class="col-sm-4 control-label">Code</label>
																<div class="col-sm-8">
																	<input type="text" class="form-control tooltips" id="institutecode" name="institutecode" placeholder="Code of Organization" title="Code Of Organization">
																</div>
															</div>
														</div>
													</div>
													<div class="row">	
														<div class="col-sm-6">
															<div class="form-group">
																<label for="" class="col-sm-4 control-label">Type</label>
																<div class="col-sm-8">
																	<input type="text" class="form-control tooltips" id="txtinstituteType" maxlength = "30" name="txtinstituteType" placeholder="Type of Organization" title="Type Of Organization">
																</div>
															</div>
														</div>
														<div class="col-sm-6">	
															<div class="form-group">
																<label for="" class="col-sm-4 control-label">Web Address</label>
																<div class="col-sm-8">
																	<input type="text" class="form-control tooltips" id="txtWebaddress" name="txtWebaddress" maxlength = "200" placeholder="Web site Address" title="Web site Address">
																</div>
															</div>
														</div>
													</div>
													<div class="row">	
														<div class="col-sm-6">
															<div class="form-group">
																<label for="" class="col-sm-4 control-label">Mobile no.</label>
																<div class="col-sm-8">
																	<input type="text" class="form-control tooltips" id="txtContactNo" name="txtContactNo" maxlength = "10" placeholder="Mobile no." title="Mobile no.">
																</div>
															</div>
														</div>
														<div class="col-sm-6">	
															<div class="form-group">
																<label for="" class="col-sm-4 control-label">E-Mail</label>
																<div class="col-sm-8">
																	<input type="text" class="form-control tooltips" id="txtinstituteEmail" name="txtinstituteEmail" maxlength = "200" placeholder="Email ID" title="Email ID Of Organization">
																</div>
															</div>
														</div>
													</div>
														
													<div class="row">	
														<div class="col-sm-6">
															<div class="form-group">
																<label for="" class="col-sm-4 control-label">Location</label>
																<div class="col-sm-8">
																	<input type="text" class="form-control tooltips" id="txtLocation" name="txtLocation" maxlength = "100" placeholder="Location" title="Location">
																</div>
															</div>
														</div>
														<div class="col-sm-6">	
															<div class="form-group">
																<label for="" class="col-sm-4 control-label">Logo</label>
																<div class="col-sm-8">
																	<input type="file" class="form-control" id="fileinstitutelogo" name="fileinstitutelogo" >
																</div>
																<label for="" class="col-sm-offset-4 control-label" style="color: red;">(Dimensions of Logo should be 60*60)</label>
															</div>
														</div>
													</div>	
														
													<div class="row">	
														<div class="col-sm-6">
															<div class="form-group">
																<label for="" class="col-sm-4 control-label">Status</label>
																<div class="col-sm-8">
																	<select class="form-control" id="cmbRecordStatus" name="cmbRecordStatus">
																		<option value="1">ACTIVE</option>
																		<option value="0">INACTIVE</option>
																	</select>
																</div>
															</div>
														</div>
														<div class="col-sm-6">	
															<div class="form-group">
																<label for="" class="col-sm-4 control-label">Program Structure</label>
																<div class="col-sm-8">
																	<select class="form-control" id="cmbProgStruct" name="cmbProgStruct">
																		<option value="">Select</option>
																		<option value="YES">Yes</option>
																		<option value="NO">No</option>
																	</select>
																</div>
															</div>
														</div>
													</div>		
														<!---->
													<div class="row">	
														<div class="col-sm-6">
															<div class="form-group">
																<label for="" class="col-sm-4 control-label">Admin Name</label>
																<div class="col-sm-8">
																	<input type="text" class="form-control tooltips" id="instituteadmindisplayname" maxlength = "100" name="instituteadmindisplayname" title="Display Name" placeholder="Admin Display Name">
																</div>
															</div>
														</div>
														<div class="col-sm-6">	
															<div class="form-group">
																<label for="inputname" class="col-sm-4 control-label">Admin Username</label>
																<div class="col-sm-8">
																	<input type="text" class="form-control tooltips" id="instituteadminusername" name="instituteadminusername" title="Username of Organization admin" placeholder="Username of Organization admin">
																</div>
															</div>
														</div>
													</div>		
														
													<div class="row">	
														<div class="col-sm-6">
															<div class="form-group">
																<label for="" class="col-sm-4 control-label">Address</label>
																<div class="col-sm-8">
																	<textarea class="form-control tooltips" id="txtAddress" name="txtAddress" placeholder="Address of the Organization" title="Address Of the Organization"></textarea>
																</div>
															</div>
														</div>
														
													</div>
													<div class="row">	
															<div class="form-group">
																<label for="" class="col-sm-2 control-label">Organization Image</label>
																<div class="col-sm-4">
																	<input type="file" id="fileInstituteImage" name="fileInstituteImage" class="form-control"/>
																	File-Type: jpg, jpeg, png<br />
																	File-Size: 400kb Max<br />
																	Dimension: 750*250 pixels
																	<div id="signMessage" style="color:red;font-size:16px;"></div>
																</div>
																<div class="col-sm-6">
																	<img id='imageDisplayarea' src='' style='margin-left:50px;margin-right:50px;margin-bottom: 20px;' width='200' height='100' />
																</div>
																
															</div>
													</div>
													<div class="row">	
														<div class="col-sm-10">
															
														</div>
														<div class="col-sm-2">	
															<div class="form-group">
															    <span id="spanProcessingInstitute" style="display: none">Processing... <img src="<?php echo base_url(); ?>public/assets/images/bx_loader.gif" /></span>
																<button type="submit" class="btn btn-primary" id="institutemanageaddsave"><i class="fa fa-save"></i>  Save</button>
																<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
															</div>
														</div>
													</div>		
													
												</form>
												</div>	
											</div>
										</div>
									</div>
									<div class="modal fade" id="instituteeditmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
														&times;
													</button>
													<h4 class="modal-title" id="myModalLabel">Edit Organization</h4>
												</div>
												<div class="modal-body">
													<form class="form-horizontal" role="form" id="instmanageeditformid" enctype="multipart/form-data">
														
														<div id="errorlogInstituteEdit" style="display: none; color: red; font-size: 12px;"></div>
														<div class="row col-sm-12 col-xs-12 ">
															<div class="col-sm-6 col-xs-6">
																<div class="form-group">
																	<input type="hidden" id="op_type_institute" name="op_type_institute" value="edit_institute">
																	<input type="hidden" id="instituteeditcode" name="instituteeditcode">
																	<label for="inputname" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> Name</label>
																	<div class="col-sm-8">
																		<input type="text" class="form-control" onkeyup="changeCase(this)"  id="instituteeditname" name="instituteeditname" placeholder="Name of Organization">
																	</div>
																</div>
																<!--<div class="form-group">
																	<label for="" class="col-sm-4 control-label">Type</label>
																	<div class="col-sm-8">
																		<input type="text" class="form-control tooltips" id="txtinstituteTypeEdit" name="txtinstituteTypeEdit" >
																	</div>
																</div>-->
																<div class="form-group">
																	<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> Location</label>
																	<div class="col-sm-8">
																		<input type="text" class="form-control tooltips" onkeyup="changeCase(this)" maxlength = "50"  id="txtLocationEdit" name="txtLocationEdit">
																	</div>
																</div>
																<div class="form-group">
																	<label for="" class="col-sm-4 control-label">&nbsp;&nbsp;&nbsp;Address</label>
																	<div class="col-sm-8">
																		<textarea class="form-control tooltips" id="instituteeditAddress" onkeyup="changeCase(this)"  name="instituteeditAddress" placeholder="Address of the Organization" title="Address Of the Organization"></textarea>
																	</div>
																</div>
																<div class="form-group">
																	<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> Logo</label>
																	<div class="col-sm-8">
																		<input type="file" class="form-control" id="fileinstitutelogoEdit" name="fileinstitutelogoEdit" >
																		File-Type: jpg, jpeg, png<br />
																		File-Size: 400kb Max<br />
																		Dimension: 400*400 pixels
																	</div>
																	<!--<label for="" class="col-sm-offset-4 control-label" style="color: red;">(Dimensions of Logo should be 400px*400px)</label>
																	--><div id="signMessageEdit1" style="color:red;font-size:16px;"></div>
																</div>
																
																
																
																
															</div>	
															<div class="col-sm-6 col-xs-6">
																<div class="form-group">
																	<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> Admin Display &nbsp;&nbsp;&nbsp;Name</label>
																	<div class="col-sm-8">
																		<input type="text" class="form-control" id="instituteadmindisplaynameEdit" maxlength = "50" name="instituteadmindisplaynameEdit" placeholder="Display Name">
																	</div>
																</div>
																<div class="form-group">
																	<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> Mobile no.</label>
																	<div class="col-sm-8">
																		<input type="text" class="form-control tooltips" id="txtContactNoEdit" name="txtContactNoEdit" maxlength = "10">
																	</div>
																</div>
																<div class="form-group">
																	<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> E-Mail</label>
																	<div class="col-sm-8">
																		<input type="text" class="form-control tooltips" id="txtinstituteEmailEdit" maxlength = "200" name="txtinstituteEmailEdit" placeholder="Email ID edit" title="Email ID Of Organization Edit">
																	</div>
																</div>
																<div class="form-group">
																	<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> Web Address</label>
																	<div class="col-sm-8">
																		<input type="text" class="form-control tooltips" id="txtWebaddressEdit" name="txtWebaddressEdit" maxlength = "200">
																	</div>
																</div>
																<!--<div class="form-group">
																	<label for="inputname" class="col-sm-4 control-label">Admin Username</label>
																	<div class="col-sm-8">
																		<input type="text" class="form-control" id="instituteadminusernameEdit" name="instituteadminusernameEdit" placeholder="Username of Organization admin">
																	</div>
																</div>-->
																
																<!--<div class="form-group">
																	<label for="" class="col-sm-2 control-label">Organization Image</label>
																	<div class="col-sm-4">
																		<input type="file" id="fileInstituteImageEdit" name="fileInstituteImageEdit" class="form-control"/>
																		File-Type: jpg, jpeg, png<br />
																		File-Size: 400kb Max<br />
																		Dimension: 750*250 pixels
																		<div id="signMessageEdit" style="color:red;font-size:16px;"></div>
																	</div>
																	<div class="col-sm-6">
																		<img id='imageDisplayareaEdit' src='' style='margin-left:50px;margin-right:50px;' width='200' height='100' />
																	</div>
																	
																</div>-->
																<!--<div class="form-group">
																	<label for="" class="col-sm-4 control-label">Status</label>
																	<div class="col-sm-8">
																		<select class="form-control" id="cmbRecordStatusEdit" name="cmbRecordStatusEdit">
																			<option value="1">ACTIVE</option>
																			<option value="0">INACTIVE</option>
																		</select>
																	</div>
																</div>-->
																<!--<div class="form-group">
																	<label for="" class="col-sm-4 control-label">Program Structure</label>
																	<div class="col-sm-8">
																		<select class="form-control" id="cmbProgStructEdit" name="cmbProgStructEdit">
																			<option value="">Select</option>
																			<option value="YES">Yes</option>
																			<option value="NO">No</option>
																		</select>
																	</div>
																</div>-->
																
															</div>
														</div>		
																<div class="modal-footer">
																    <span id="spanProcessingInstituteEdit" style="display: none">Processing... <img src="<?php echo base_url(); ?>public/assets/images/bx_loader.gif" /></span>
																	<button type="submit" class="btn btn-primary" id="institutemanageeditsave">	<i class="fa fa-save"></i>  Save</button>
																	<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>
																</div>
															
															
														
													</form>
												</div>	
											</div>
										</div>
									</div>
									<div class="modal fade" id="institutedeletemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
														&times;
													</button>
													<h4 class="modal-title" id="myModalLabel">Delete record</h4>
												</div>
												<div class="modal-body">
													<center><h2>Do You Want to Delete This Record?</h2></center>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-danger" id="institutemanagedeleterec">Delete</button>
													<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>
												</div>
											</div>
										</div>
									</div>
									<!-- FOR Organization IMAGE SETUP TAB -->
									<div class="chart tab-pane" id="institute_image_setup">
									
										<div class="col-lg-12">
											<h1 class="page-header">Assign Image to Organization:</h1>
										</div>
										<div class="col-lg-12">
											<button id="assignNewImageToInstitutebtn" class="btn btn-success btn-circle" ><i class="fa fa-plus"></i></button>
										</div>
										<div class="col-lg-12">
											<table class="table table-striped table-bordered" id="dtblInstituteImageSetup" width="100%">
												<thead>
													<tr>
														<th >#</th>
														<th >Organization Code</th>
														<th >Organization Name</th>
														<th >Slider 1</th>
														<th >Slider 2</th>
														<th >Slider 3</th>
														<th >Action</th>
														
													</tr>
												</thead>
												<tbody>
												</tbody>
											</table>
											
										</div>
										
									</div>
									
									
									<!--Organization IMAGE SETUP ADD MODAL-->
									
									<div class="modal fade" id="instituteimageaddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
										<div class="modal-dialog">
											<div class="modal-content" style="width: 662px;">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
														&times;
													</button>
													<h4 class="modal-title" id="myModalLabel">Add Images to Organization</h4>
												</div>
												<div class="modal-body" style="width: 600px;">
													<?php echo form_open(null, array('class'=>'form-horizontal', 'id'=>'instimageaddformid' ,'enctype'=>"multipart/form-data")); ?>
														<div id="errorlogImageInstitute" style="display: none; color: red; font-size: 12px;"></div>
														
														<!---->
														<div class="form-group">
															<label for="inputname" class="col-sm-2 control-label">Organization Name</label>
															<div class="col-sm-6">
																<select class="form-control tooltips " data-live-search="true" id="cmbInstituteNameAdd" name="cmbInstituteNameAdd" title="Choose Application" >
																	
																</select>
															</div>
														</div>
														
														<div class="form-group">
															<label for="" class="col-sm-2 control-label">Organization Image</label>
															<div class="col-sm-5">
																<input type="file" id="fileInstituteImage1" name="fileInstituteImage1" class="form-control"/>
																File-Type: jpg, jpeg, png<br />
																File-Size: 400kb Max<br />
																Dimension: 508*381 pixels
																<div id="signMessage1" style="color:red;font-size:16px;"></div>
															</div>
															<div class="col-sm-5">
																<img id='imageDisplayarea1' src='' style='margin-left:50px;margin-right:50px;margin-bottom: 20px;' width='200' height='100' />
															</div>
															
														</div>
														<div class="form-group">
															<label for="" class="col-sm-2 control-label">Organization Image</label>
															<div class="col-sm-5">
																<input type="file" id="fileInstituteImage2" name="fileInstituteImage2" class="form-control"/>
																File-Type: jpg, jpeg, png<br />
																File-Size: 400kb Max<br />
																Dimension: 508*381 pixels
																<div id="signMessage2" style="color:red;font-size:16px;"></div>
															</div>
															<div class="col-sm-5">
																<img id='imageDisplayarea2' src='' style='margin-left:50px;margin-right:50px;margin-bottom: 20px;' width='200' height='100' />
															</div>
															
														</div>
														<div class="form-group">
															<label for="" class="col-sm-2 control-label">Organization Image</label>
															<div class="col-sm-5">
																<input type="file" id="fileInstituteImage3" name="fileInstituteImage3" class="form-control"/>
																File-Type: jpg, jpeg, png<br />
																File-Size: 400kb Max<br />
																Dimension: 508*381 pixels
																<div id="signMessage3" style="color:red;font-size:16px;"></div>
															</div>
															<div class="col-sm-5">
																<img id='imageDisplayarea3' src='' style='margin-left:50px;margin-right:50px;margin-bottom: 20px;' width='200' height='100' />
															</div>
															
														</div>
														
														<div class="form-group modal-footer">
														    <span id="spanProcessingInstituteImage" style="display: none">Processing... <img src="<?php echo base_url(); ?>public/assets/images/bx_loader.gif" /></span>
															<button type="submit" class="btn btn-primary" id="institutimageaddsave"><i class="fa fa-save"></i>  Save</button>
															<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
														</div>
													</form>
												</div>	
											</div>
										</div>
									</div>
									<!--Organization IMAGE SETUP EDIT MODAL-->
									<div class="modal fade" id="instituteimageeditmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
										<div class="modal-dialog" style="width: 662px">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
														&times;
													</button>
													<h4 class="modal-title" id="myModalLabel">Edit Organization Image</h4>
												</div>
												<div class="modal-body">
													<form class="form-horizontal" role="form" id="instimageeditformid" enctype="multipart/form-data">
														
														<input type="hidden" id="op_img_institute" name="op_img_institute" value="edit_institute_image">
														<input type="hidden" id="hid_img_code" name="hid_img_code" value="edit_institute_image_code">
														<div id="errorlogInstituteEdit" style="display: none; color: red; font-size: 12px;"></div>
														<!--<div class="form-group">
															
															<label for="inputname" class="col-sm-3 control-label">Organization Name</label>
															
														</div>-->
														
														
														<div class="form-group">
															<label for="inputname" class="col-sm-2 control-label">Organization Name</label>
															<div class="col-sm-6">
																<!--<select class="form-control tooltips " data-live-search="true" id="cmbInstituteImageNameEdit" name="cmbInstituteImageNameEdit" title="Choose Application" >
																	
																</select>-->
																<select class="form-control selectpicker" data-live-search="true" id="cmbInstituteImageNameEdit" name="cmbInstituteImageNameEdit" title="Choose Application">	
																</select>
															</div>
														</div>
														
														
														<div class="form-group">
															<label for="" class="col-sm-2 control-label">Slider 1 Image</label>
															<div class="col-sm-4">
																<input type="file" id="fileInstituteImageEdit1" name="fileInstituteImageEdit1" class="form-control"/>
																File-Type: jpg, jpeg, png<br />
																File-Size: 400kb Max<br />
																Dimension: 508*381 pixels
																<div id="signMessageEdit1" style="color:red;font-size:16px;"></div>
															</div>
															<div class="col-sm-6">
																<img id='imageDisplayareaEdit1' src='' style='margin-left:50px;margin-right:50px;margin-bottom: 20px;' width='200' height='100' />
															</div>
															
														</div>
														<div class="form-group">
															<label for="" class="col-sm-2 control-label">Slider 2 Image</label>
															<div class="col-sm-4">
																<input type="file" id="fileInstituteImageEdit2" name="fileInstituteImageEdit2" class="form-control"/>
																File-Type: jpg, jpeg, png<br />
																File-Size: 400kb Max<br />
																Dimension: 508*381 pixels
																<div id="signMessageEdit2" style="color:red;font-size:16px;"></div>
															</div>
															<div class="col-sm-6">
																<img id='imageDisplayareaEdit2' src='' style='margin-left:50px;margin-right:50px;margin-bottom: 20px;' width='200' height='100' />
															</div>
															
														</div>
														<div class="form-group">
															<label for="" class="col-sm-2 control-label">Slider 3 Image</label>
															<div class="col-sm-4">
																<input type="file" id="fileInstituteImageEdit3" name="fileInstituteImageEdit3" class="form-control"/>
																File-Type: jpg, jpeg, png<br />
																File-Size: 400kb Max<br />
																Dimension: 508*381 pixels
																<div id="signMessageEdit3" style="color:red;font-size:16px;"></div>
															</div>
															<div class="col-sm-6">
																<img id='imageDisplayareaEdit3' src='' style='margin-left:50px;margin-right:50px;margin-bottom: 20px;' width='200' height='100' />
															</div>
															
														</div>
														
														<div class="form-group modal-footer">
														    <span id="spanProcessingInstituteImageEdit" style="display: none">Processing... <img src="<?php echo base_url(); ?>public/assets/images/bx_loader.gif" /></span>
															<button type="submit" class="btn btn-primary" id="instituteimageeditsave"><i class="fa fa-save"></i>  Save</button>
															<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
														</div>
													</form>
												</div>	
											</div>
										</div>
									</div>
									
									
									
									
									
									<!--Organization IMAGE SETUP ENDS-->
									<!-- FOR APPLICATION MODE TAB -->
									<div class="chart tab-pane" id="application_mode">
									
										<div class="col-lg-12">
											<h1 class="page-header">Assign Application Mode:</h1>
										</div>
										
										<div class="col-lg-12">
											<table class="table table-striped table-bordered" id="dtblApplicationMode" width="100%">
												<thead>
													<tr>
														<th >#</th>
														<th >Organization Code</th>
														<th >Organization Name</th>
														<th >Online Mode</th>
														<th >Offline Mode</th>
														<th >Mode</th>
													</tr>
												</thead>
												<tbody>

												</tbody>
											</table>
										</div>
									</div>
									<div class="modal fade" id="applicationeditmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
										<div class="modal-dialog" style="width: 50%;">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
														&times;
													</button>
													<h4 class="modal-title" id="myModalLabel">Edit Application Mode</h4>
												</div>
												<div class="modal-body">
													<form class="form-horizontal" role="form" id="frmApplicationModeEdit">
														<input type="hidden" name="hidInstituteCode" id="hidInstituteCode" value="" />
														<input type="hidden" name="hidOnlineMode" id="hidOnlineMode" value="" />
														<input type="hidden" name="hidOfflineMode" id="hidOfflineMode" value="" />
														<input type="hidden" name="hidOfflineMode" id="hidOfflineMode" value="" />
														<input type="hidden" id="op_type_application" name="op_type_application" value="edit_application_mode">
														<h4>Application Modes</h4>
														<div class="form-group">
															<div class="col-sm-12 col-sm-offset-4">
																<input type="checkbox"  id="chkOnlineMode" name="chkOnlineMode" value="1" onclick="return false"  />&nbsp;&nbsp;<label>Online Mode</label>
															</div>
														</div>
														<div class="form-group">
															
															<div class="col-sm-12 col-sm-offset-4">
																<input type="checkbox" id="chkOfflineMode" name="chkOfflineMode" value="1" >&nbsp;&nbsp;<label>Offline Mode(On the Counter)</label>
															</div>
														</div>
														<div class="modal-footer">
															<button type="submit" class="btn btn-primary" id="institutemanageeditsave">	<i class="fa fa-save"></i>  Save</button>
															<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>
														</div>
													</form>
												</div>	
											</div>
										</div>
									</div>
									
									
									
									
									
									<!-- FOR PAYMENT MODE TAB -->
									<div class="chart tab-pane" id="payment_mode">
										<div class="col-lg-12">
											<h1 class="page-header">Assign Payment Mode:</h1>
										</div>
										<div class="col-lg-12">
											<table class="table table-striped table-bordered" id="dtblPaymentMode" width="100%">
												<thead>
													<tr>
														<th >#</th>
														<th >Organization Code</th>
														<th >Organization Name</th>
														<th >Mode</th>
														<th >Modes</th>
														
													</tr>
												</thead>
												<tbody>
												</tbody>
											</table>
										</div>
									</div>
									<div class="modal fade" id="paymenteditmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
										<div class="modal-dialog"style="width: 50%;">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
														&times;
													</button>
													<h4 class="modal-title" id="myModalLabel">Edit Payment Mode</h4>
												</div>
												<div class="modal-body">
													<form class="form-horizontal" role="form" id="frmPaymentModeEdit">
														<input type="hidden" name="hidPaymentCode" id="hidPaymentCode" value="" />
														<div class="form-group">
															<label class="col-sm-12 control-label" for="" style="text-align:left;" style="font-size:15px;">Payment Modes:</label>
														</div>
														<div class="form-group">
															<div class="col-sm-10 col-sm-offset-2">
																<div id = "divPaymentModes">
																</div>
															</div>
														</div>
														<div class="modal-footer">
															<button type="submit" class="btn btn-primary" id="paymneteditsave">	<i class="fa fa-save"></i>  Save</button>
															<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>
														</div>
													</form>
												</div>	
											</div>
										</div>
									</div>		
									<!-- FOR EXAM CENTRE TAB -->
									<div class="chart tab-pane" id="exam_center">
										<div class="col-lg-12">
											<table class="table table-striped table-bordered" id="dtblExamCenterSetup" width="100%">
												<thead>
													<tr>
														<th >#</th>
														<th >Organization Code</th>
														<th >Organization Name</th>
														<th >Payment Mode</th>
														<th >Exam Center</th>
														<th >Id</th>
														<th >Action</th>
														
													</tr>
												</thead>
												<tbody>

												</tbody>
											</table>
										</div>
									</div>
									<div class="modal fade" id="examCenterSetupAddmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
										<div class="modal-dialog" style="width: 50%;">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
														&times;
													</button>
													<h4 class="modal-title" id="myModalLabel">Add Exam Center</h4>
												</div>
												<div class="modal-body">
													<form class="form-horizontal" role="form" id="frmExamCenterSetupAdd">
														<input type="hidden" name="hidExamcenterAdd" id="hidExamcenterAdd" value="" />
														<div class="form-group">
															<label for="inputname" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Organization</label>
															<div class="col-sm-6">
																<select class="form-control "  id="cmbInstituteforExamAdd" name="cmbInstituteforExamAdd">
																	
																</select>
																
															</div>
														</div>
														<div class="form-group">
															<label for="inputname" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Exam Center</label>
															<div class="col-sm-6">
																<select class="form-control tooltips " data-live-search="true" id="cmbExamCenterAdd" name="cmbExamCenterAdd[]" title="Choose Exam Center" multiple="multiple">
																	
																</select>
															</div>
														</div>
														<div class="modal-footer">
															<button type="submit" class="btn btn-primary" id="examCenterAddsave"><i class="fa fa-save"></i>  Save</button>
															<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>
														</div>
													</form>
												</div>	
											</div>
										</div>
									</div>
									<div class="modal fade" id="examCenterSetupEditmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
										<div class="modal-dialog" style="width: 50%;">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
														&times;
													</button>
													<h4 class="modal-title" id="myModalLabel">Edit Exam Center</h4>
												</div>
												<div class="modal-body">
													<form class="form-horizontal" role="form" id="frmExamCenterSetupEdit">
														<input type="hidden" name="hidExamCenterId" id="hidExamCenterId" value="" />
														<div class="form-group">
															<label for="inputname" class="col-sm-3 control-label">Organization :</label>
															<div class="col-sm-9 control-label" style="text-align: left;font-size: 15px;font-weight: bold;color: #18618c;">
																<span  class="" id="instituteForExmCentreEdit" name="instituteForExmCentreEdit" ></span>
															</div>
														</div>
														<div class="form-group">
															<div class="col-lg-12">
																<table class="table table-striped table-bordered" id="dtblExamCenterEdit" width="100%">
																	<thead>
																		<tr>
																			<th >Sl No</th>
																			<th >Exam Center</th>
																			<th  hidden="hidden">Id</th>
																			<th >Action</th>
																			
																		</tr>
																	</thead>
																	<tbody>

																	</tbody>
																</table>
															</div>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
														</div>
														
													</form>
												</div>	
											</div>
										</div>
									</div>
									<div class="modal fade" id="centredeletemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
														&times;
													</button>
													<h4 class="modal-title" id="myModalLabel">Delete record</h4>
												</div>
												<div class="modal-body">
													<center><h2>Do You Want to Delete This Record?</h2></center>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-danger" id="examcentredeleterec">Delete</button>
													<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>
												</div>
											</div>
										</div>
									</div>		
								</div>
							<!--</div>
						</div>-->
					</div>
				</div>
			</div>
			
			<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/superadmin/institute_setup.js"></script>
			