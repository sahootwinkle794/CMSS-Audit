<style>
	.folder .select {
		cursor: pointer;
	}
	.btn-accps, .btn-accps:active, .btn-accps:focus {
	    background-color: green;
	    border: 1px solid green;
	    color: #fff;
	    font-weight: 900;
	    padding: 2px 7px;
	}
	div.vertical-line{
	    width: 1px; 
	    background-color: black; 
	    height: 100%; 
	   	 
	}
	.leaveType {
	    font-weight: bold;
		color: #1073e3;
	}
	.fileContent
	{
		padding-top: 15px;
		height: 72px;
	}
	.fileContent:hover{
       	/*background-color: #c2c2c24d;*/
       	background-color: rgba(0, 0, 0, 0.1);
		padding: 5px;
		border-radius: 5px;
		border-bottom: 1px dashed #000;
    }
    .form-horizontal .control-label {
   		text-align: left;
	}
	.folderClick:hover,
	.folderClick:focus {
	  box-shadow: 0 0.5em 0.5em -0.4em var(--hover);
	  transform: translateY(-0.25em);
	}
	legend{
		margin-bottom: 3px;
	}
	.form-horizontal {
	    padding: 0px 0px 3px 35px;
	}
	.multiselect-search
	{
		
		border: 0px;

		background-image: linear-gradient(#673AB7, #673AB7), linear-gradient(#737373, #737373);

		background-size: 0 2px, 100% 1px;

		background-repeat: no-repeat;

		background-position: center bottom, center calc(100% - 1px);

		background-color: transparent;

		transition: background 0.2s ease-out;

		float: none;

		font-weight: 400;

		outline: 0px !important;

		box-shadow: none;
	}
</style>
<div class="content-wrapper">
	<!--<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Folder List</h1>
        </div>
    </div>-->
    <section class="content-header">
      	<h1>
        	Folder List
      	</h1>
    </section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-lg-12" style="padding-top:0px;">
				<div class="panel panel-default">	
					<div class="panel-body box box-default">
						
						<div style="border-radius:0px;border: 0px inset;padding-left:20px;padding-right:20px;padding-top:0px;">
							<div style="height: 170px; padding-top: 10px; overflow-y: auto;">
							    <div class="row" style="width: 100%;">
							    	
									<div id="filter" class="dataTables_filter pull-right form-inline" style="padding-left: 25px;">
										<label class="focused">Search:
											<input type="search" class="form-control input-sm" placeholder="" id="search-folder" >
										</label>
									</div>
									<div class="pull-right form-inline">
								    	<button class="btn btn-sm btn-success" type="button" onclick="btnAddFolder()"><i class="fa fa-plus"></i> Add Folder</button>
								    </div>
								</div>
									
								<div class="row folder col-md-12" id="divFolderList">
									<!--<?php foreach($get_folder_detail as $row){ ?>
										<div class="col-md-1 folderClick"  onclick="fileShow(`<?=$row['folder_id']?>`,`<?=$row['folder_name']?>`)">
											<div class="text-center select">
												<i class="fa fa-folder fa-3x" style="color: #f5a939;"></i>
												<span class="icon-name row" style="color: black;"><?=$row['folder_name']?></span>
											</div>
										</div>	
									<?php } ?>-->
								</div>
							</div>
							<!--<hr>-->	
							<div class="row">
								<fieldset class="col-md-6" id="fileView" style="border: 1px solid black;padding: 0px 25px;border-radius: 6px;height: 329px;overflow-x: auto;">
									<legend style="width: auto"><span class="label" id="spanFoldername" style="background-color:#454545">File Name</span></legend>
									<div class="demo-animation">
										<div class="js-animating-object animated zoomInDown">
											<div class="row">
												<div class="title text-left pull-left" style="padding-left: 15px;font-size: 20px;">
													File List :&nbsp;&nbsp;&nbsp;<button class="btn btn-sm btn-success" type="button" id="btnAddFile" onclick="btnAddFile()"><i class="fa fa-plus"></i> Add File</button>
												</div>
												<div id="filter" class="dataTables_filter pull-right form-inline">
													<label class="focused">Search:
														<input type="search" class="form-control input-sm" placeholder="" id="search-file" >
													</label>
												</div>
											</div>
						           			<div class="scroll" id="file_div" style="padding-top: 10px; cursor: pointer;" >
							           			<!--<div class="fileContent" onclick="fileDetail()">
							           				<input type="hidden" value="71" class="display-none">
							           				<div class="fileIcon">
							           					<i class="icon-display fa fa-file-text"></i>
							           				</div>
							           				<div class="fileBody">
							           					GDMS_NST_40_1.pdf<span class="pull-right leaveType">View Details</span>
							           				</div>
							           				<div class="fileBodyFoot">
							           					<div class="pull-left fileSub">
							           						<span class="createdDate">Created By: <span>XYZ </span></span>
							           					</div>
							           					<div class="pull-right fileSub">
							           						<span class="createdDate">Created On: <span>16-03-2018 11:46:25</span></span>
							           					</div>
							           				</div>
							           			</div>
							           			<div class="fileContent" onclick="fileDetail()">
							           				<input type="hidden" value="71" class="display-none">
							           				<div class="fileIcon">
							           					<i class="icon-display fa fa-file-text"></i>
							           				</div>
							           				<div class="fileBody">
							           					GDMS_NST_40_1.pdf<span class="pull-right leaveType">View Details</span>
							           				</div>
							           				<div class="fileBodyFoot">
							           					<div class="pull-left fileSub">
							           						<span class="createdDate">Created By: <span>XYZ </span></span>
							           					</div>
							           					<div class="pull-right fileSub">
							           						<span class="createdDate">Created On: <span>16-03-2018 11:46:25</span></span>
							           					</div>
							           				</div>
							           			</div>
							           			<div class="fileContent" onclick="fileDetail()">
							           				<input type="hidden" value="71" class="display-none">
							           				<div class="fileIcon">
							           					<i class="icon-display fa fa-file-text"></i>
							           				</div>
							           				<div class="fileBody">
							           					GDMS_NST_40_1.pdf<span class="pull-right leaveType">View Details</span>
							           				</div>
							           				<div class="fileBodyFoot">
							           					<div class="pull-left fileSub">
							           						<span class="createdDate">Created By: <span>XYZ </span></span>
							           					</div>
							           					<div class="pull-right fileSub">
							           						<span class="createdDate">Created On: <span>16-03-2018 11:46:25</span></span>
							           					</div>
							           				</div>
							           			</div>-->
												
						           			</div>
										</div>
									</div>
								</fieldset>
								<div class="js-animating-object animated fadeInRight display-none" id="fileDetailView">
									
									<fieldset class="col-md-6" style="border: 1px solid black;padding: 0px 25px;border-radius: 6px;height: 329px;">
										<legend style="width: auto"><span class="label" id="spanFileName" style="background-color:#454545">File Name</span></legend>
										<div class="title">
										  	<span id="file_name" style="font-size: 20px;"> File Details :</span>
									  		<div class="pull-right" style="margin-bottom: 20px;">
										  		<a href="#" target="_blank" class="btn btn-accps waves-effect" title="View PDF" id="viePdfFile"  style="box-shadow: 0 2px 5px rgba(0,0,0,.16);">
										 			<i class="icon-display fa fa-file-pdf-o"></i>
										  		</a>
										  		<!--<a href="javascript:void(0);" id="downloadAll">
												   	<button class="btn btn-accps waves-effect" title="Download All Attachment" style="box-shadow: 0 2px 5px rgba(0,0,0,.16);">
												 	  	<i class="icon-display fa fa-download"></i>
												  	</button>
										  		</a>-->
										  	</div>
										</div>
										<div class="cardBody slideW">
					           				<table class="table" id="" width="100%">
						                      	<tbody class="black padding-recpps">
													<tr>
														<td class="font-bold">Folder Name</td>
														<td class="col-black">: </td>
														<td class="col-black" id="folder_name_view">Folder 1 </td>
													</tr>	
													<tr>
														<td class="font-bold">File Name</td>
														<td class="col-black">: </td>
														<td class="col-black" id="file_name_view">GDMS_NST_40_1.pdf</td>
													</tr>
													<tr>
														<td class="font-bold">File Type</td>
														<td class="col-black">: </td>
														<td class="col-black" id="file_type_view">PDF </td>
													</tr>
													<tr>	
														<td class="font-bold">Created On</td>
														<td class="col-black">: </td>
														<td class="col-black" id="file_createdon_view">16-03-2018 11:46:25 </td>
													</tr>	
													<tr>
														<td class="font-bold">File Size</td>
														<td class="col-black">: </td>
														<td class="col-black" id="file_size_view">1MB </td>
													</tr>
														
													<tr>
														<td class="font-bold">File Desc.</td>
														<td class="col-black">: </td>
														<td class="col-black" id="file_desc_view">File contain detail information </td>
													</tr>
												</tbody>
											</table>
						           		</div>
									</fieldset>
								</div>
							</div>
						</div>
					</div>
				</div>		
			</div>
		</div>
		<!--ADD FOLDER MODAL-->
		<div class="modal fade" id="modalAddFolder" tabindex="-1" Resource="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
			<div class="modal-dialog" style="width: 50%;">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							&times;
						</button>
						<h4 class="modal-title" id="myModalLabelCounsellingPeriod">Add Folder</h4>
					</div>
					<div class="modal-body">
						<form class="form-horizontal" Resource="form"  id="frmAddFolder" name="frmAddFolder">
							<div class="form-group">
								<label class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Folder Name</label>
								<div class="col-sm-8">
									<input type="text" class="form-control tooltips" id="txtFolderName" name="txtFolderName" maxlength="100"  title="Folder Name">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Role Access</label>
								<div class="col-sm-8">
									<select class="form-control" id="cmbRole" name="cmbRole[]" multiple>
										<?php foreach($role as $row)
										{ ?>
											<option value="<?=$row['role_code']?>"><?=$row['role_name']?></option> 
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Folder Description</label>
								<div class="col-sm-8">
									<textarea  class="form-control tooltips" id="txtFolderDesc" name="txtFolderDesc" ></textarea>
								</div>
							</div>
							
							<div class="modal-footer">
								<button type="submit" class="btn btn-primary" id="btnSaveCounsellingPeriod"><i class="fa fa-save"></i>  Save</button>
								<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
							</div>
						</form>
					</div>	
				</div>
			</div>
		</div>
		<!--ADD FILE MODAL-->
		<div class="modal fade" id="modalAddFile" tabindex="-1" Resource="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
			<div class="modal-dialog" style="width: 50%;">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							&times;
						</button>
						<h4 class="modal-title" id="myModalLabelFileHeader">Add File</h4>
					</div>
					<div class="modal-body">
						<form class="form-horizontal" Resource="form"  id="frmAddFile" name="frmAddFile">
							<input type="hidden" value="" id="hidFolderId" name="hidFolderId">
							<!--<input type="hidden" value="" id="hidFileSize" name="hidFileSize">-->
							<div class="form-group">
								<label class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> File Name:</label>
								<div class="col-sm-8">
									<input type="text" class="form-control tooltips" id="txtFileName" name="txtFileName" maxlength="100"  title="File Name">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> File:</label>
								<div class="col-sm-8">
									<input type="file" class="form-control tooltips" id="fileName" name="fileName">
									File-Type: jpg,jpeg,png,pdf,JPG,JPEG,PNG,PDF<br />
									Max Size: 10 MB
								</div>
							</div>
							
							<div class="form-group">
								<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> File Description:</label>
								<div class="col-sm-8">
									<textarea  class="form-control tooltips" id="txtFileDesc" name="txtFileDesc" ></textarea>
								</div>
							</div>
							
							<div class="modal-footer">
								<button type="submit" class="btn btn-primary" id="btnSaveCounsellingPeriod"><i class="fa fa-save"></i>  Save</button>
								<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
							</div>
						</form>
					</div>	
				</div>
			</div>
		</div>
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin/folder_list.js"></script>