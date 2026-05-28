<div class="content-wrapper">
	<!--<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">News and Announcements</h1>
        </div>
    </div>-->
    <section class="content-header">
      	<h1>
        	News and Announcements
      	</h1>
    </section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-lg-12" style="padding-top:0px;">
				<div class="panel panel-default">	
					<div class="panel-body box box-default">
						<!--<button type='button' id='btnAdd' class='btn btn-info btn-sm btn-circle pull-left tooltipTable' onclick='add_news_events()' title='Add'><i class='fa fa-plus'></i></button><br><br>-->
						<div style="border-radius:0px;border: 0px inset;padding-left:20px;padding-right:20px;padding-top:0px;">
						
							<form class="form-horizontal" method="post" role="form" id="frmNewsEvents" name="frmNewsEvents">
								<input type="hidden" name="hidTemplate" id="hidTemplate" value=""/>
								
							    <div class="form-group"
									<input type="hidden" name="removeid" id="removeid" value="" />
									<table class="table table-striped table-bordered " id="tbnews_events">
										<thead>
											<tr>
												<th >#</th>
												<th  hidden>Id</th>
												<th >News/Announcements</th>
												<th >Type</th>
												<th hidden>Upload Type</th>
												<th hidden>Link Name</th>
												<th >Published Date</th>
												<th >link</th>
												<th width="10%">Action</th>	
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
					<div id="errorlog" style="display: none; color: red; font-size: 12px;"></div>
					<input type="hidden" id="hidType" name="hidType" value=""/>
					<input type="hidden" id="hidid" name="hidid" value=""/>
					<input type="hidden" id="hidOperType" name="hidOperType" value="add_news_events"/>
					<div class="form-group">
						<label for="txtNewsEvents" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i>News/Announcement</label>
						<div class="col-sm-9">
							<textarea name="txtNewsEvents" id="txtNewsEvents" class="form-control"></textarea>
							<!--<input type="text" class="form-control tooltips" id="txtfeedback" name="txtfeedback">-->
						</div>
					</div>
					<div class="form-group">
						<label for="radioType" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Type:</label>
						<div class="col-sm-9">
							<input type="radio" id = "radioNews" name="radioType" value="NEWS"> News<br>
  							<input type="radio" id = "radioAnnouncement"name="radioType" value="ANNOUNCEMENT"> Announcement<br>
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
							File-Type: pdf / PDF<br />
							File-Size: 5Mb Max
						</div>
					    <!--<textarea  id="textareaLink1" name="textbox1" class="col-sm-6 "></textarea>-->
					</div>
					<div id="textbox" class="form-group" style="display: none">
					    <label class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Upload URL:</label>
					    <div class="col-sm-9">
						    <textarea id="textareaLink" name="textareaLink" style="width: 360px; height: 100px;" class=" form-control"></textarea> 
						</div>
					</div>
					<div class="form-group">
						<label for="txtDate" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i>Published Date:</label>
						<div class="col-sm-9">
							<input type="text" class="form-control tooltips" id="txtDate" name="txtDate">
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
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin/news_announcements.js"></script>