<div class="content-wrapper">
	<!--<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">News and Announcements</h1>
        </div>
    </div>-->
    <section class="content-header">
      	<h1>
        	FAQ
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
						
							<form class="form-horizontal" method="post" role="form" id="frmfaq" name="frmfaq">
								<input type="hidden" name="hidTemplate" id="hidTemplate" value=""/>
								
							    <div class="form-group"
									<input type="hidden" name="removeid" id="removeid" value="" />
									<table class="table table-striped table-bordered " id="tblfaq">
										<thead>
											<tr>
												<th >#</th>
												<th  hidden>Id</th>
												<th >Question</th>
												<th >Answer</th>
												<th >Action</th>	
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
				<form class="form-horizontal" id="faqForm" name="faqForm">
					<div id="errorlog" style="display: none; color: red; font-size: 12px;"></div>
					<input type="hidden" id="hidid" name="hidid" value=""/>
					<input type="hidden" id="hidOperType" name="hidOperType" value="add_faq"/>
					<div class="form-group">
						<label for="txtQues" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i>Question</label>
						<div class="col-sm-9">
							<textarea name="txtQues" id="txtQues" class="form-control"></textarea>
							<!--<input type="text" class="form-control tooltips" id="txtfeedback" name="txtfeedback">-->
						</div>
					</div>
					<div class="form-group">
						<label for="txtAns" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i>Answer</label>
						<div class="col-sm-9">
							<textarea name="txtAns" id="txtAns" class="form-control"></textarea>
							<!--<input type="text" class="form-control tooltips" id="txtfeedback" name="txtfeedback">-->
						</div>
					</div>
					<!--<div class="form-group">
						<label for="radioType" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Type:</label>
						<div class="col-sm-9">
							<input type="radio" name="radioType" value="NEWS"> News<br>
  							<input type="radio" name="radioType" value="ANNOUNCEMENT"> Announcement<br>
						</div>
					</div>-->
					<!--<div class="form-group">
						<label for="txtDate" class="col-sm-3 control-label">Published Date:</label>
						<div class="col-sm-9">
							<input type="text" class="form-control tooltips" id="txtDate" name="txtDate">
						</div>
					</div>-->
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary" id="savecadremaster"><i class="fa fa-save"></i>  Save</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
					</div>
				</form>
			</div>	
		</div>
	</div>
</div>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin/faq.js"></script>