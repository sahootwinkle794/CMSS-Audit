<div class="content-wrapper">
	<div class="form-group" style="margin-top: 20px;">
		<label class="col-sm-2 control-label"><i style="color:red;font-size:18px;">*</i> Post</label>
		<div class="col-sm-3">
			<select class="form-control" id="cmbProgram" name="cmbProgram"></select>
		</div>
		<label class="col-sm-2 control-label"><i style="color:red;font-size:18px;">*</i> Invigilators per venue</label>
		<div class="col-sm-1">
			<input type="text" id="txtNoOfInvi" name="txtNoOfInvi"/>
		</div>
		<div class="col-sm-2" style="margin-left: 100px">
			<button type="submit"  class="btn btn-success" id="btnRandomize" name="btnRandomize"><i class="fa fa-check-square-o"></i> &nbsp;Randomize</button>
		</div>
		<!--<div class="col-sm-2 ">
			<button type="submit"  class="btn btn-danger" id="btnDelete" name="btnDelete"><i class="fa fa-trash"></i> &nbsp;Delete</button>
		</div>-->
	</div>
    <!-- Main content -->
    <section class="content" style="margin-top: 6%;">
		<div class="row">
			<div class="col-lg-12" style="padding-top:0px;">
				<div class="panel panel-default">	
					<div class="panel-body box box-default">
						<div style="border-radius:0px;border: 0px inset;padding-left:20px;padding-right:20px;padding-top:0px;">
							<table class="table table-striped table-bordered " id="dtblApplicationDetail">
								<thead>
									<tr>
										<th >#</th>
										<!--<th hidden="">Post Code</th>-->
										<th >Post</th>
										<!--<th hidden="">Exam Venue Code</th>-->
										<th >Exam Venue </th>
										<th hidden="">Invigilator Code</th>
										<th >Invigilator</th>
										
									</tr>
								</thead>
								<tbody>
								
								</tbody>
							</table>
							
						</div>
					</div>
				</div>
			</div>
		</div>
		
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<link href="<?php echo base_url(); ?>public/assets/js/buttons.dataTables.min.css" type="text/css" />
<script src="<?php echo base_url(); ?>public/assets/js/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>public/assets/js/buttons.flash.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>public/assets/js/jszip.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>public/assets/js/pdfmake.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>public/assets/js/vfs_fonts.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>public/assets/js/buttons.html5.min.js" type="text/javascript"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin/venue_wise_invigilators.js"></script>

   