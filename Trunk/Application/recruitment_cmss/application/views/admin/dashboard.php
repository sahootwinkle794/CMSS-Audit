	
	
	<!--<link href="<?php echo base_url(); ?>public/template_lib/plugins/morris/morris-0.4.3.min.css" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="../css/plugins/morris/morris-0.4.3.min.css" />-->
	<style>
		tspan
		{
			font-weight:normal;
		}
		.imgwrapper
		{
			width:70%;
		}
		.panel div:hover {
		  	background-color: #fef5da;
		}
		a{
			color: #a61515;
		}
		.dash_hover div:hover {
		  	background-color: #fff;;
		}
	</style>
	<?php 
		$key = $this->session->userdata('key');
		if($key == '')
		{
			$this->session->set_userdata('key',uniqid());
		}
		
		foreach($all_program_list as $row)
		{
			$program_group_list[] = $row;
			$sel_program_group = $program_group_list[0]['program_group'];
		}
	?>
	<div class="content-wrapper">
		
        <div class="col-sm-12">
    		<div class="col-sm-6" style="padding-bottom: 10px;">    	
		        <section class="content-header" style="color: #000;">
		        	<h1>
			        	Application Statistics
			    	</h1>
				</section> 
			</div>	   	
	    	<div class="col-sm-6" style="padding-top: 5px;">
				<!--<label for="" class="control-label col-sm-2" style="text-align:left;" id="cmbPrograml">Post:</label>-->
				<div class="col-sm-8 pull-right">
					<select class="form-control" name="cmbPostFilter" id="cmbPostFilter" onchange="post_filter()">
						<option value='0'>Search by Post</option>
					</select>
				</div>
			</div>
		</div>		
				    
    	<br>
        <!--<div class="row">
        	<div class="col-sm-2">
			</div>
			<div class="col-md-8">
				<div class="panel panel-default">	
					<div class="panel-body box box-info">
						<div class="col-md-12">
							<section class="" id="">
								<div class="col-sm-12">
									<label for="" class="control-label col-sm-2" style="text-align:left;" id="cmbPrograml">Post:</label>
									<div class="col-sm-8">
										<select class="form-control" name="cmbPostFilter" id="cmbPostFilter" onchange="post_filter()">
											<option value=''>Select Post</option>
										</select>
									</div>
								</div>
							</section>
						</div>
					</div>	
				</div>
			</div>
			<div class="col-sm-2">
			</div>
		</div>-->
		<!--<div class="col-lg-12">
			<div style="height:100px;width:100%;">&nbsp;
				<div class="col-sm-12">
	    			<label for="" class="control-label col-sm-2" style="text-align:left;" id="cmbPrograml">Post:</label>
					<div class="col-sm-6">
						<select class="form-control" name="cmbPostFilter" id="cmbPostFilter">
							<option value=''>Select Post</option>
						</select>
					</div>
				</div>	
			</div>	
		</div>-->
		<!--<div class="row">
			<div class="col-lg-6 " style="padding-top:0px;">
				<div class="panel panel-default">	
					<div class="panel-body box box-warning">
			    		<div class="col-lg-12">
			    			<div style="height:100px;width:100%;">&nbsp;
			    				<div class="col-sm-12">
					    			<label for="" class="control-label col-sm-2" style="text-align:left;" id="cmbPrograml">Post:</label>
									<div class="col-sm-8">
										<select class="form-control" name="cmbPostFilter" id="cmbPostFilter">
											<option value=''>Select Post</option>
										</select>
									</div>
								</div>	
							</div>	
			    		</div>
			    	</div>
		    	</div>
	    	</div>	
		</div>--> 
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">	
					<div class="panel-body box box-success">
						<div class="col-md-12">
							<section class="" id="secDashboard">
								
							</section>
						</div>
					</div>	
				</div>
			</div>
		</div>    	
		<div class="row">
			<div class="col-lg-8 " style="padding-top:0px;">
				<div class="panel panel-default">	
					<div class="panel-body box box-warning">
			    		<div class="col-lg-12">
			    			<!--<div class="divApplicantGraph" id="divApplicantGraph" style="height:350px;width:100%;">&nbsp;</div>-->
			    			<div class="col-lg-12" id="" style="height:350px;width:100%;">&nbsp;
			    				<h4 style="margin-top: 0px; margin-bottom: 35px;">Filter by Gender:</h4>
			    				<div class="col-lg-4">
			    					<a href="javascript:void(0);" onclick="appl_piechart('F')">
			    						<img class="img-responsive imgwrapper img-circle" src="<?php echo base_url(); ?>public/photos/woman.png" alt="">
			    					</a>
			    					<br>
			    					<div class="col-lg-12">
			    						<span style="font-size: large;color: #1414ee;padding-left: 0px;">Female : <span id="spnRegF"></span></span>
			    						<br><br>
			    						<!--<span>Total Applicants:</span>
			    						<span id="spnRegF"></span>-->
			    					</div>
			    				</div>
			    				<div class="col-lg-4">
			    					<a href="javascript:void(0);" onclick="appl_piechart('M')">
			    						<img class="img-responsive imgwrapper img-circle" src="<?php echo base_url(); ?>public/photos/man.png" alt="">
			    					</a>
			    					<br>
			    					<div class="col-lg-12">
			    						<span style="font-size: large;color: #1414ee;padding-left: 0px;">Male : <span id="spnRegM"></span></span>
			    						<br><br>
			    						<!--<span>Total Applicants:</span>
			    						<span id="spnRegM"></span>-->
			    					</div>
			    				</div>
			    				<div class="col-lg-4">
			    					<a href="javascript:void(0);" onclick="appl_piechart('T')">
			    						<img class="img-responsive imgwrapper img-circle" src="<?php echo base_url(); ?>public/photos/transgender.png" alt="">
			    					</a>
			    					<br>
			    					<div class="col-lg-12">
			    						<span style="font-size: large;color: #1414ee;padding-left: 0px;">Transgender : <span id="spnRegT"></span></span>
			    						<br><br>
			    						<!--<span>Total Applicants:</span>
			    						<span id="spnRegM"></span>-->
			    					</div>
			    				</div>
			    			</div>
			    		</div>
			    	</div>
		    	</div>
	    	</div>	
			<div class="col-lg-4 " style="padding-top:0px;">
				<div class="panel panel-default">	
					<div class="panel-body box box-danger">
			    		<div class="col-lg-12">
			    			<div class="divPieGraph" id="divPieGraph" style="height:350px;width:100%;">&nbsp;</div>
			    		</div>
			    	</div>
		    	</div>
	    	</div>	
		</div>
		<div class="row">
			<div class="col-lg-12 " style="padding-top:0px;">
				<div class="panel panel-default">	
					<div class="panel-body box box-info">
			    		<div class="col-lg-12">
			    			<div class="divMap" id="divMap" style="height:450px;width:100%;">&nbsp;</div>
			    		</div>
			    	
			        </div>
		    	</div>
	    	</div>	
		</div>
		
		<div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
			<div class="modal-dialog" style="width: 70%;">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							&times;
						</button>
						<h4 class="modal-title" id="myModalLabel"></h4>
					</div>
					<div class="modal-body">
						<form class="form-horizontal" role="form" id = "frmShowProfile" name = "frmShowProfile">
							<table class="table table-striped table-bordered"  id="tblProfile" width="100%">
								<thead>
									<tr>
										<th >#</th>
										<th >Name</th>
										<th >Mobile</th>
										<th >Email Id</th>
										<th >DOB</th>
										<th >Post</th>
									</tr>
								</thead>
								<tbody>

								</tbody>
							</table>
						</form>
					</div>	
					<!--<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>  
					</div>-->
				</div>
			</div>
		</div>
	</div>
	<link href="<?php echo base_url(); ?>public/assets/js/buttons.dataTables.min.css" type="text/css" />
	<script src="<?php echo base_url(); ?>public/assets/js/dataTables.buttons.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>public/assets/js/jszip.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>public/assets/js/buttons.html5.min.js" type="text/javascript"></script>
	<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin/dashboard.js"></script>
	<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/highcharts/highcharts.js"></script>
	<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/highcharts/exporting.js"></script>
	<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/highcharts/export-data.js"></script>
	<script>
		/*TO DISABLE BROWSER BACK BUTTON IN THIS PARTICULAR PAGE START */
        history.pushState(null, null, document.URL);
        window.addEventListener('popstate', function () {
            history.pushState(null, null, document.URL);
        });
        /*TO DISABLE BROWSER BACK BUTTON IN THIS PARTICULAR PAGE END */

	</script>