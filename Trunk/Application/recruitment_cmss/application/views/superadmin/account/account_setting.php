<!-- File API -->
		<link href="<?php echo base_url(); ?>public/template_lib/plugins/jquery.fileapi/statics/main.css" rel="stylesheet" type="text/css"/>
		<link href="<?php echo base_url(); ?>public/template_lib/plugins/jquery.fileapi/jcrop/jquery.Jcrop.min.css" rel="stylesheet" type="text/css"/>
		<script src="<?php echo base_url(); ?>public/template_lib/plugins/jquery.fileapi/FileAPI/FileAPI.min.js"></script>
		<script src="<?php echo base_url(); ?>public/template_lib/plugins/jquery.fileapi/FileAPI/FileAPI.exif.js"></script>
		<script src="<?php echo base_url(); ?>public/template_lib/plugins/jquery.fileapi/jquery.fileapi.js"></script>
		<script src="<?php echo base_url(); ?>public/template_lib/plugins/jquery.fileapi/jcrop/jquery.Jcrop.min.js"></script>
		<script src="<?php echo base_url(); ?>public/template_lib/plugins/jquery.fileapi/statics/jquery.modal.js"></script>
	<div class="content-wrapper">
	    <section class="content-header">
	      	<h1>Profile</h1>
	      	<ol class="breadcrumb">
	      		<li class="active">Profile</li>
			</ol>
	    </section>
	<!-- Main content -->
		<input type="hidden" name="hidSession" id="hidSession" value="" />
		<section class="content">  
			<div class="row">
            	<div class="col-md-6">
            		<div class="box" >
            			<div class="box-header">
            				<i class="fa fa-wrench"></i>
                            <h3 class="box-title">Change Password</h3>
            			</div><!-- /.box-header -->
            			<form role="form" method="post" action="" id="frmChangePassword">
                			<div class="box-body">
                				<div class="form-group">
                                    <label for="txtOldPassword">Old Password</label>
                                    <input type="password" class="form-control" id="txtOldPassword" name="txtOldPassword" placeholder="Old Password">
                                </div>
                                <div class="form-group">
                                    <label for="txtNewPassword1">New Password</label>
                                    <input type="password" class="form-control" id="txtNewPassword" name="txtNewPassword" placeholder="New Password">
                                </div>
                                <div class="form-group">
                                    <label for="txtRetypePassword">Retype New Password</label>
                                    <input type="password" class="form-control" id="txtRetypePassword" name="txtRetypePassword" placeholder="Retype New Password">
                                </div>
                                <div class="alert alert-success alert-dismissable" id="divMessage" style="display:none">
                                    <i class="fa fa-check"></i>
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <b><span id="spanMessageTitle"></span></b> <span id="spanMessage"></span>
                                </div>
                                <button type="submit" class="btn btn-primary" id="btnChangePassword" name="btnChangePassword">Change Password</button>
                            
                			</div><!-- /.box-body -->
                			
                        </form>
            		</div>
            	</div>
            	<div class="col-md-6">
            		<div class="box" style="height: 319px;">
            			<div class="box-header">
            				<i class="fa fa-user"></i>
                            <h3 class="box-title">Profile Image</h3>
            			</div><!-- /.box-header -->
            			<form role="form" method="post" action="" enctype="multipart/form-data" id="form2">
                			<div class="box-body">
                				<div id="userpic" class="userpic">
                					<!--<img src="<?php echo base_url(); ?>public/photos/default.png" class="img-circle" alt="Ashish">-->
								    <div class="js-preview userpic__preview">
								    </div>
								    <div class="btn btn-success js-fileapi-wrapper" style="display: none">
								        <div class="js-browse">
								         	<span class="btn-txt">Choose</span>
								         	<input name="filedata" type="file">
								      	</div>
								      	<div class="js-upload" style="display: none;">
									         <div class="progress progress-success">
									         	<div class="js-progress bar"></div>
									         </div>
								         	<span class="btn-txt">Uploading</span>
								      	</div>
								    </div>
								</div>
                			</div><!-- /.box-body -->
                        </form>
            		</div>
            	</div>
        	</div>
        </section><!-- /.content -->
	<!-- /.content -->
	</div>
	<!-- /.content-wrapper -->
	<div id="popup" class="popup" style="display: none;">
		<div class="popup__body"><div class="js-img"></div></div>
		<div style="margin: 0 0 5px; text-align: center;">
			<div class="js-upload btn btn_browse btn_browse_small">Upload</div>
		</div>
	</div>
		