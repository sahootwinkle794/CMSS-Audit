


<!-- iCheck for checkboxes and radio inputs -->
 <link rel="stylesheet" href="<?php echo base_url(); ?>public/template_lib/plugins/iCheck/all.css">
<!-- iCheck 1.0.1 -->
<script src="<?php echo base_url(); ?>public/template_lib/plugins/iCheck/icheck.min.js"></script>
<!--********************************************************** CONTENT PART ************************************************************************************************************** -->	
	
	<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" >
	<section class="content-header">
      	<h1>Manage Resource</h1>
      	<ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-gears"></i> Setting</a></li>
        	<li class="active"><a href="#"><i class="fa fa-server"></i> Manage Resource</a></li>
        </ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="nav-tabs-custom">
					<!-- Tabs within a box -->
					<ul class="nav nav-tabs" role="tablist" id="myTab">
						<li id="resourceTab" class="active"><a href="#tabResource" data-toggle='tab'>Resource </a></li>
						<li id="roleTab"><a href="#tabRole" data-toggle='tab'>Role</a></li>
						<li id="menuTab"><a href="#tabMenu" data-toggle='tab'>Menu</a></li>
						<!--<li><a href="#tabDoucument" data-toggle='tab'>Doucument</a></li>-->
						<!--<li><a href="#tabSession" data-toggle='tab'>Session</a></li>-->
					</ul>
		            <!-- /.box-header -->
		            <div class="tab-content no-padding">
					<!-- Resource Tab -->
					 	<div class="chart tab-pane active" id="tabResource" style="position: relative; ">
					 		<div class="col-xs-12 col-sm-12 col-md-12" style="padding-top: 15px;">
						 		<div class="row">
							        <div class="col-xs-12 col-sm-12 col-md-9">
							          	<div class="box box-primary">
								            <div class="box-body">
								            	<div class="col-lg-12 col-xs-12">
							           				<table id="dtblresourcemaster" class="table table-bordered table-hover">
										                <thead>
									                        <tr>
									                            <th>Sl No</th>
									                            <th hidden="hidden">Code</th>
									                            <th>Link</th>
									                            <th>Name</th>
									                            <th hidden="hidden">ID</th>
									                           	<th>Action</th>
									                        </tr>
									                    </thead>
										            </table>
												</div>
								           	</div>
							          	</div>
							        </div>
							        <div class="col-xs-12 col-sm-12 col-md-3" id="manage_resource">
							        	<div class="box box-danger">
							        		<?php echo form_open(null, array('id'=>'frm_resource' ,'enctype'=>"multipart/form-data")); ?>
									            <div class="box-body">
									            	<h4 style="background-color:#f7f7f7; font-size: 18px; text-align: center; padding: 7px 10px; margin-top: 0;">
							                         <span id="span_addresource">  Add Resource</span>
							                        </h4>
							                        <div id="errorlog_resorce" style="display: none; color: red; font-size: 9px;"></div>
							                        <input type="hidden" value="add_resource" name="op_type_resource" id="op_type_resource">
							                        
							                        <input type="hidden" value="" name="resource_code" id="resource_code">
							                        
													<!--<div class="form-group">
														<label>Code :</label>
														<input type="text" class="form-control" name="txtresourcecode" id="txtresourcecode" placeholder="Resource Code" value="<?php echo set_value('txtresourcecode'); ?>"  data-bv-field="txtresourcecode">
														<input type="hidden" value="" name="hidtxtresourcecode" id="hidtxtresourcecode">
													</div>-->
													<div class="form-group">
														<label>Link :</label>
														<input type="text" class="form-control" name="txtresourcelink" id="txtresourcelink" placeholder="Resource Link" value="<?php echo set_value('txtresourcelink'); ?>"  data-bv-field="txtresourcelink">
														<input type="hidden" value="" name="hidtxtresourcelink" id="hidtxtresourcelink">
													</div>
													<div class="form-group">
														<label>Name :</label>
														<input type="text" class="form-control" name="txtresourceName" id="txtresourceName" placeholder="Resource Name" value="<?php echo set_value('txtresourceName'); ?>"  data-bv-field="txtresourceName">
														<input type="hidden" value="" name="hidtxtroleName" id="hidtxtroleName">
													</div>
									            </div>
									            <div class="box-footer with-border">
										          	<div class="box-tools pull-right">
										          		<button type="submit" class="btn bg-olive btn-flat" id="resource_btn"><i class='fa fa-paper-plane'></i> Add</button>
										          		<button type="button" class="btn btn-default" id="resource_reset"><i class="fa fa-refresh"></i> Reset</button>
										          	</div>
									        	</div>
								            </form>
								        </div>
							        </div>
							    </div>
							</div>
					    </div>
					    <!-- End Resource tab -->
					    
					    <!-- Role Tab -->
					 	<div class="chart tab-pane" id="tabRole" style="position: relative; ">
					 		<div class="col-xs-12 col-sm-12 col-md-12" style="padding-top: 15px;">
						 		<div class="row">
							        <div class="col-xs-12 col-sm-12 col-md-9">
							          	<div class="box box-primary">
								            <div class="box-body">
								            	<div class="col-lg-12 col-xs-12">
							           				<table id="dtblrolemaster" class="table table-bordered table-hover">
										                <thead>
									                        <tr>
									                            <th>Sl No</th>
									                            <th>Code</th>
									                            <th>Name</th>
									                            <th>Landing Page</th>
									                            <th hidden="hidden">Landing Page</th>
									                           	<th>Action</th>
									                        </tr>
									                    </thead>
										            </table>
												</div>
								           	</div>
							          	</div>
							        </div>
							        <div class="col-xs-12 col-sm-12 col-md-3" id="manage_role">
							        	<div class="box box-danger">
							        		<?php echo form_open(null, array('id'=>'frm_role' ,'enctype'=>"multipart/form-data")); ?>
									            <div class="box-body">
									            	<h4 style="background-color:#f7f7f7; font-size: 18px; text-align: center; padding: 7px 10px; margin-top: 0;">
							                         <span id="span_addrole">  Add Role</span>
							                        </h4>
							                        <div id="errorlog" style="display: none; color: red; font-size: 9px;"></div>
							                        <input type="hidden" value="add_role" name="op_type_role" id="op_type_role">
													<div class="form-group">
														<label>Code :</label>
														<input type="text" class="form-control" name="txtrolecode" id="txtrolecode" placeholder="Role Code" value=""  onblur="this.value=this.value.toUpperCase()" data-bv-field="txtrolecode">
														<input type="hidden" value="" name="hidtxtrolecode" id="hidtxtrolecode">
													</div>
													
													<div class="form-group">
														<label>Name :</label>
														<input type="text" class="form-control" name="txtroleName" id="txtroleName" placeholder="Role Name" value=""  data-bv-field="txtroleName">
														<input type="hidden" value="" name="hidtxtroleName" id="hidtxtroleName">
													</div>
													<div class="form-group">
														<label> Landing Page :</label>
														<select class="form-control " id="txtLandingPage" name="txtLandingPage" >
							            					<option value="">----SELECT----</option>
							            					<?php  foreach( $all_resource_data as $row ) { ?>
							            					<option value="<?= $row['resource_code']?>"><?= $row['resource_name']?></option>
							            					<?php } ?>
								            			</select>
													</div>
									            </div>
									            <div class="box-footer with-border">
										          	<div class="box-tools pull-right">
										          		<button type="submit" class="btn bg-olive btn-flat" id="role_btn"><i class='fa fa-paper-plane'></i> Add</button>
										          		<button type="button" class="btn btn-default" id="role_reset" ><i class="fa fa-refresh"></i> Reset</button>
										          	</div>
											    </div>
								            </form>
								        </div>
							        </div>
							    </div>
							</div>
					    </div> <!-- End Role tab -->
					    <!-- Menu Tab -->
					 	<div class="chart tab-pane" id="tabMenu" style="position: relative; ">
					 		<?php echo form_open(null, array('name'=>'frmMenu', 'id'=>'frmMenu','enctype'=>"multipart/form-data")); ?>
						 		<div class="col-xs-12 col-sm-12 col-md-9" style="padding-top: 15px;">
						          	<div class="box box-primary">
							            <div class="box-body">
						             		<div class="row">
								             	<input type="hidden" id="op_type" name="op_type" value="add_menu">
						            			<label class="control-label col-sm-2">Role :</label>
						            			<div class="col-sm-3">
						            				<select class="form-control" id="cmbMenuRole" name="cmbMenuRole" data-target = "#cmbMenuParent" data-type = "GET_LINK_URL" >
						            					<option value="">Select Role</option>
						            					<?php
							                                if (isset($all_role_data) && !empty($all_role_data)):
							                                    foreach ($all_role_data as $role):
							                                        ?>                                                           
							                                        <?php if (isset($role['parent_data'])) { ?>
							                                            <option data-info='<?php
							                                            if (isset($role['parent_data'])): echo json_encode($role['parent_data']);
							                                            endif;
							                                            ?>' value="<?php echo $role['role_code']; ?>" ><?php echo $role['role_name'] ?></option>
							                                        <?php }else { ?>                                       
							                                            <option data-info='' value="<?php echo $role['role_code']; ?>"><?php echo $role['role_name'] ?></option>
							                                        <?php } ?>                                                                                                                       
							                                        <?php
							                                    endforeach;
							                                endif;
							                                ?>
						            				</select>
						            			</div>
						            			<label class="control-label col-sm-2">Copy To :</label>
						            			<div class="col-sm-3">
						            				<select class="form-control" id="cmbMenuCopyTo" name="cmbMenuCopyTo" >
						            					<option value="">Select</option>
							            				<?php if (isset($all_role_data) && !empty($all_role_data)):
		                                    				foreach ($all_role_data as $role):
		                                    			?> 
	                                        			<option data-info='' value="<?php echo $role['role_code']; ?>"><?php echo $role['role_name'] ?></option>
					                                <?php
					                                    endforeach;
					                                endif;
					                                ?>
						            				</select>
						            			</div>
						            			<div class="col-sm-2">
						            				<button class="btn  btn-primary tooltips btn-circle" title="Copy Menu"  type="button" id="btnMenuCopy" name="btnMenuCopy"><i class="fa fa-copy"></i></button>
						            				<button class="btn  btn-success tooltips btn-circle" title="Menu preview" type="button" id="btnMenuPreview" name="btnMenuPreview"><i class="fa fa-eye"></i></button>
						            			</div>
						            		</div>
						            		<div class="table-responsive" style="padding-top: 2%;">
							            		<table id="dtblMenu" class="table table-condensed table-striped table-bordered" ">
									                <thead>
								                        <tr>
								                            <th>#</th>
								                            <th>Role</th>
								                            <th>Link Text</th>
								                            <th>Resource Name</th>
								                            <th hidden>Parent id</th>
								                            <th>Parent</th>
								                            <th>Menu Sl No</th>
								                            <th>Has Child</th>
								                            <th>Is Last Child</th>
								                            <th>Access</th>
								                            <th>Action</th>
								                        </tr>
								                    </thead>
								               </table>
								            </div>
									    </div>
					  				</div>
						        </div>
						       	<div class="col-xs-12 col-sm-12 col-md-3 " style="padding-top: 15px;">
						        	<div class="box box-danger">
							            <div class="box-body">
							            	<h4 style="background-color:#f7f7f7; font-size: 18px; text-align: center; padding: 7px 10px; margin-top: 0;">
					                            <span id="spanMenu" >Add Menu</span>
					                        </h4>
					                        <div id="errorlog" style="display: none; color: red; font-size: 9px;"></div>
					                        <div class="form-group">
												<label>Link Text</label>
												<input type="text" class="form-control" name="txtmenulinktext" id="txtmenulinktext" placeholder="Link Text"   data-bv-field="txtmenulinktext">
												<input type="hidden" value="" name="hidmenulinktext" id="hidmenulinktext">
											</div>
											<div class="form-group">
												<label>Link Url</label>
												<select class="form-control" id="cmbMenuLinkURL" name="cmbMenuLinkURL">
					            					<option value="">Select</option>
					            					<option value="#">#</option>
							            				<?php if (isset($all_link_url_data) && !empty($all_link_url_data)):
		                                    				foreach ($all_link_url_data as $link):
		                                    			?> 
	                                        			<option data-info='' value="<?php echo $link['resource_code']; ?>"><?php echo $link['resource_name'] ?></option>
					                                <?php
					                                    endforeach;
					                                endif;
					                                ?>
					            				</select>
					            				<input type="hidden" value="" name="hidMenuId" id="hidMenuId">
											</div>
											<div class="form-group">
												<label>Parent</label>
												<select class="form-control" id="cmbMenuParent" name="cmbMenuParent" ></select>
					            				<input type="hidden" value="" name="hidParent" id="hidParent">
											</div>
											<div class="form-group">
												<label>Menu Sl No</label>
												<input type="text" class="form-control" name="txtMenuslno" id="txtMenuslno" placeholder="Menu Sl No"  data-bv-field="txtMenuslno">
												<input type="hidden"  name="hidParent" id="hidParent">
											</div>
											<div class="form-group">
												<label  class="col-sm-6">Has Child</label>
												<input type="checkbox" class="flat-red" name="txtHaschild" id="txtHaschild" value="Yes">
											</div>
											<div class="form-group">
												<label class="col-sm-6">Is Last Child</label>
												<input type="checkbox" class="flat-red" name="txtislastchild" id="txtislastchild" value="Yes" >
											</div>
											<div class="form-group">
												<label>Open in new Window</label>
												<select class="form-control" id="txtNewWindow" name="txtNewWindow" >
					            					<option value="_self">Parent Window</option>
					            					<option value="_blank">New Window</option>
					            				</select>
											</div>
											<div class="form-group">
												<label>Icon class</label>
												<input type="text" class="form-control" name="txtIconClass" id="txtIconClass" title="Icon Class" placeholder="Icon Class" >
											</div>
											<div class="form-group">
												<label>Access Type</label>
												<select class="form-control" id="cmbMenuAccess" name="cmbMenuAccess" >
					            					<option value="">----SELECT----</option>
					            					<option value="R">Read</option>
					            					<option value="W">Write</option>
					            				</select>
					            				<input type="hidden" name="hidMenuAccess" id="hidMenuAccess">
											</div>
										</div>
										<div class="box-footer with-border">
											<div class="form-action box-tools pull-right">
												<div class="row">
													<button type="submit" class="btn bg-olive btn-flat" id="btnMenuSubmit" name="btnMenuSubmit"><i class="fa fa-paper-plane"></i> Add</button>
													<button type="button"  class="btn btn-default" id="btnMenuReset" name="btnMenuReset"><i class="fa fa-refresh"></i> Reset</button>
												</div>
											</div>
							            </div>
							        </div>
						        </div>
						   <?php echo form_close();?>
					    </div><!-- End Menu tab -->
					</div>
				</div>
	    	</div>
	    </div>
	</section>
</div>
<script> var base_url = '<?php echo base_url(); ?>';</script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/manage_resource.js?v=<?php rand() ?>"></script>
<script type="text/javascript"> 
$('#roleTab').click(function() {
    location.reload();
}); 
$('#resourceTab').click(function() {
    location.reload();
});
$('#menuTab').click(function() {
    location.reload();
});

$('a[data-toggle="tab"]').on('show.bs.tab', function(e) {

    localStorage.setItem('activeTab', $(e.target).attr('href'));
    

});

var activeTab = localStorage.getItem('activeTab');

if(activeTab){
	
    $('#myTab a[href="' + activeTab + '"]').tab('show');

}



</script>	