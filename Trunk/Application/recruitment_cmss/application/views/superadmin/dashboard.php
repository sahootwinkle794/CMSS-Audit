
	<?php 
		foreach($active_institute_list as $institute)
		{
			$active_institute_count = $institute['active_institute_count'];
		}
		foreach($inactive_institute_list as $institute)
		{
			$inactive_institute_count = $institute['active_institute_count'];
		}
		$total_institute = $active_institute_count + $inactive_institute_count;
		foreach($get_users_applicant as $row)
		{
			$applicant_count = $row['applicant_count'];
		}
		foreach($get_users_admin as $row)
		{
			$user_count = $row['user_count'];
		}
		$total_user = $applicant_count + $user_count;
		//print_r($get_user_loggedin_applicant);
		foreach($get_user_loggedin_applicant as $row)
		{
			$login_count_applicant = $row['login_count_applicant'];
		}
		foreach($get_user_loggedin_admin as $row)
		{
			$login_count_admin = $row['login_count'];
		}
		$total_login_count = $login_count_admin;
		foreach($get_today_collection as $row)
		{
			$total_collection = $row['total_collection'];
		}
		$today = date('d-m-Y');
	?>
	<!-- Content Wrapper. Contains page content -->
	
	<div class="content-wrapper">
		<!--<div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Dashboard</h1>
            </div>
        </div>-->
        <div class="col-sm-12">
    		<div class="col-sm-6" style="padding-bottom: 10px;">    	
		        <section class="content-header" style="color: #000;">
		        	<h1>
			        	Application Statistics
			    	</h1>
				</section> 
			</div>	   	
	    	<!--<div class="col-sm-6" style="padding-top: 5px;">
				<div class="col-sm-8 pull-right">
					<select class="form-control" name="cmbPostFilter" id="cmbPostFilter" onchange="post_filter()">
						<option value='0'>Search by Post</option>
					</select>
				</div>
			</div>-->
		</div>	
        
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">	
					<div class="panel-body box box-success">
						<div class="col-md-12">
							<div class="col-lg-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-institution fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div>Organizations: <span class="h3"><?=$total_institute?></span></div>
                                <div>Active: <span class="h3"><?=$active_institute_count?></span></div>
                                <div>Inactive: <span class="h3"><?=$inactive_institute_count?></span></div>
                            </div>
                        </div>
                    </div>
                    <a href="<?=base_url()?>superadmin/manage_institute">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-user fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div>User: <span class="h3"><?=$total_user?></span></div>
                                <div>Applicant: <span class="h3"><?=$applicant_count?></span></div>
                                <div>Admin: <span class="h3"><?=$user_count?></span></div>
                            </div>
                        </div>
                    </div>
                    <a href="<?=base_url()?>superadmin/report_all_users" >
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-sign-in fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div>Login Details: <span class="h3"></span></div>
                                <div>Applicant: <span class="h3"><?=$login_count_applicant?></span></div>
                                <div>Admin: <span class="h3"><?=$login_count_admin?></span></div>
                            </div>
                        </div>
                    </div>
                   <a href="<?=base_url()?>superadmin/report_all_logins"   >
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-red">
                    <div class="panel-heading" style="height: 102px;">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-money fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right" style="margin-top: 10px;">
                            <div>Total Collection: <span class="h3"><?=$total_collection?></span></div>
							
							<br>
                                
                                <!--<div>Today: <span class="h4"> <?=$today?> </span></div><br/>-->
                                <!--<div>Collection: <span class="h3"><?=$total_collection?></span></div>-->
                            </div>
                        </div>
                    </div>
                     <a href="<?=base_url()?>superadmin/payment_verification">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
						</div>
					</div>	
				</div>
			</div>
		</div>
            
        </div>
    </div>    
	<script type="text/javascript">
		    function showReport(reporturl)
		    {
				//alert(reporturl);
		    	var w;
		    	w = window.open(reporturl, "winreport","status=0, menubar=0, scrollbars=1, resizable=1, width=980, height=600");
		    	w.focus();
		    }
    </script>
	