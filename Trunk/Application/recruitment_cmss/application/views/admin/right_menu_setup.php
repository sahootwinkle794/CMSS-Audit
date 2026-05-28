<div class="content-wrapper">
	<!--<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">News and Announcements</h1>
        </div>
    </div>-->
    <section class="content-header">
      	<h1>
        	Manage Document
      	</h1>
    </section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-lg-12" style="padding-top:0px;">
				<div class="panel panel-default">	
					<div class="panel-body box box-default">
						<div style="border-radius:0px;border: 0px inset;padding-left:20px;padding-right:20px;padding-top:0px;">
						
							<form class="form-horizontal" method="post" role="form" id="frmNewsEvents" name="frmNewsEvents">
								<input type="hidden" name="hidTemplate" id="hidTemplate" value=""/>
								
							    <div class="form-group"
									<input type="hidden" name="removeid" id="removeid" value="" />
									<table class="table table-striped table-bordered " id="tbnews_events">
										<thead>
											<tr>
												<th style="text-align: left">Sl. No.</th>
												<th style="text-align: left" hidden>Id</th>
												<th style="text-align: left" hidden>Type Id</th>
												<th style="text-align: left">Document Type</th>
												<th style="text-align: left">Document Title</th>
												<th style="text-align: left"hidden>Upload Type</th>
												<th style="text-align: left" hidden>Link Name</th>
												<th style="text-align: left"hidden >Published Date</th>
												<th >link</th>
												<th >Status</th>
												<th style="text-align: left" width="10%">Action</th>	
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
						    </form>	
						</div>
					</div>
				</div>
			</div>
		</div>
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog" style="width: 50%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
				&times;</button>
				<h4 class="modal-title" id="myModalLabelHeader"> </h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" id="newsEventsForm" name="newsEventsForm" enctype="multipart/form-data">
					<input type="hidden" name="hidCsrfToken" id="hidCsrfToken" value="<?php echo generateToken('newsEventsForm');?>"/>
					<div id="errorlog" style="display: none; color: red; font-size: 12px;"></div>
					<input type="hidden" id="hidid" name="hidid" value=""/>
					<input type="hidden" id="hidOperType" name="hidOperType" value="add_news_events"/>
					
					<div class="form-group">
						<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i>Document Type</label>
						<div class="col-sm-9">
							<select class="form-control tooltips" id="txtMenu" name="txtMenu" title="Select Document Type"></select>
						</div>
					</div>
					<div class="form-group">
						<label for="txtNewsEvents" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i>Document Title</label>
						<div class="col-sm-9">
							<input type="text" class="form-control tooltips" id="txtNewsEvents" name="txtNewsEvents">
						</div>
					</div>
					<div class="form-group">
						<label for="radioUpload" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Upload: </label>
						<div class="col-sm-9">
							<input type="radio" name="radioUpload" id="radioUploadpdf" value="PDF"> Upload Pdf<br>
  							<input type="radio" name="radioUpload" id="radioUploadurl" value="URL"> Upload URL<br>
						</div>
					</div>
					<div id="filebox" class="form-group" style="display: none">
					    <label class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Upload Pdf:</label>
						<div class="col-sm-9 input-file" >
							<input type="file" class="form-control" id="filePdf" name="filePdf" />
							File-Type: pdf<br />
							Max Size: 20 MB
						</div>
					</div>
					<div id="textbox" class="form-group" style="display: none">
					    <label class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Upload URL:</label>
					    <div class="col-sm-9">
						    <textarea id="textareaLink" name="textareaLink" style="width: 360px; height: 100px;" class=" form-control"></textarea> 
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Record Status</label>
						<div class="col-sm-9">
							<select class="form-control tooltips" id="cmbRecordStatus" name="cmbRecordStatus" title="Select Status">
								<option value="1" selected>Active</option>
								<option value="0" >Inactive</option>
							</select>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary" id="savecadremaster"><i class="fa fa-save"></i>  Save</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
					</div>
				</form>
			</div>	
		</div>
	</div>
</div>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin/right_menu_setup.js"></script>