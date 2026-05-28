	<link href="<?php echo base_url(); ?>public/assets/css/bootstrap.css" rel="stylesheet">
   <link rel="stylesheet" href="<?php echo base_url(); ?>public/template_lib/plugins/font-awesome/css/font-awesome.min.css">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>public/assets/css/main.css" rel="stylesheet">
	<style>
		
		
		ul { padding-left:20px; list-style:none; }
		.news li { margin-bottom:35px; font-size:19px;}
		.news li:before {    
			font-family: 'FontAwesome';
			content: "\f101";
			margin:0 5px 0 -15px;
			color:#9D426B;
			font-size:19px;
		}
		.btn-primary
		{
			background-color:#002364;
		}
		.box
		{
		 
		  margin: 0px 0px 30px 0px;
		  float: left;
		  width: 90%;
		  height:140px;
		  font-size: 14px;
		  margin:14% 0 -58% 0px;
		  background-color: #EDB604;
		  overflow:hidden;
		  opacity:0.5;
		  border: 1px groove;
		  
		}
		.img-circle 
		{
    		border-radius: 50%;
			background-color:#ffffff;
		}
		.msgbox
		{
		 
		  margin: 0px 0px 30px 0px;
		  float: left;
		  width: 98%;
		  height:100px;
		  font-size: 14px;
		  margin:0px 0 -58% 0px;
		  background-color: #EDB604;
		  overflow:hidden;
		  opacity:0.5;
		  border: 1px groove;
		  
		}
		.box-content
		{
		  color: #000000;
		  padding: 3px;
		  z-index: 20;
		}
		.control-label
		{
			 color: #002364;
			 padding-top:3px;
		}
		.horizontalsearchbar {
		    background: #ABED04 none repeat scroll 0 0;
		    border-bottom: 1px solid #dedede;
		    height: 50px;
		    opacity: 0.7;
		    padding: 10px 0 0 17px;
		    width: 94%;
			z-index:10;
			margin-left:3%;
			border-radius:10px; 
			border:1px solid #d3d3d3;
		}
		#loginBarHandle {
		    color: #f2faf7;
		    font-size: 11px;
		    line-height: 20px;
		    text-align: center;
		}
		#loginBarHandle {
		    background-color: #002364;
		    border-bottom-left-radius: 10px;
		    border-bottom-right-radius: 10px;
		    bottom: 10px;
		    box-shadow: 0 2px 5px #002364;
		    color: #f2faf7;
		    font-size: 13px;
		    line-height: 20px;
		    margin-right: 20px;
		    padding: 0 10px;
		    position: absolute;
		    right: 0;
		    text-align: center;
		    z-index: 1;
		}
		#loginBar {
		    background-color: #022a17;
		    color: #f2faf7;
		    font-size: 13px;
		    line-height: 20px;
		    margin-right: 20px;
		    padding: 0 10px;
		    position: absolute;
		    right: 0;
		    text-align: center;
		    z-index: 1;
		}
		#header-data{
		    padding-top: -20px;
		}
	</style>
	<div class="container" style="margin-top: 90px; padding-bottom: 50px;">
		<div class="row">
			<div class="col-lg-12" style="margin-bottom:10px;">
				<h3 style="margin-bottom:10px; color: #f9f94f;" align="center">Please Select the Institute</h3>
			</div>
			<form name="formFilterInstitutes" method="POST" action="">
				<div class="col-lg-12">
					
					
				</div>
				<div class="col-lg-12">
					<div style="overflow:auto;  height:350px;">
						<ul class="news">
							
<?php 

	foreach($institute as $row){ 
		$inscode = $row['institute_code'];
		$ins =  encrypt_decrypt('encrypt', $inscode);
		$insname = $row['institute_name'];
		$logo = $row['logo_url'];	

?>
							<div class="col-md-3">
								<div class="box">
									<div class="col-sm-12"><div style="height: 60px;border-bottom: 1px solid #000000;"></div></div>
									<!--<div class="col-sm-6" style="border-right: 1px solid #dedede;"></div>
									<div class="col-sm-6" style="border-right: 1px solid #dedede;"></div>	-->
								<div class="box-content">
									
								<!--<figure title="Last Date to apply"><strong><?=$dt?></strong><?=$my?></figure>-->
								
								<!--<p><a href="apply-1.php?admid=<?php echo $admid; ?>">Apply Now</a></p>-->
								</div>
								</div>
								<div class="row" style="width:98%">
										<div class="col-sm-12" align="center" style="height:60px;">
											 <b><h5 style="word-wrap: break-word;color: #ffffff"><?=$insname ?></h5></b>
										</div>
										<div class="col-sm-6" align="left" style="margin-top: 5%;margin-left: 2%">
											 <img  src="<?php echo base_url(); ?>public/assets/images/logo/<?=$logo?>" height="60px" width="95%"></img>
										</div>
										<div class="col-sm-5" style="margin-top: 10%">
											 <a href="Index/institute_index/ins/<?=$inscode?>" class="btn btn-primary">Proceed</a>
										</div>
									</div>
							</div>
						

<?php } 

?>


								

						</ul>	
					</div>
					
				</div>
			</form>
        </div>
			
    </div>
	</div>
	<script src="assets/js/jquery-1.11.1.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script>
		$("#cmbLocation").change(function (){
			var location = $("#cmbLocation").val();
			if(location != '')
			{
				$("#cmbInstitute").html("<option>Loading...</option>");
				$("#cmbInstitute").attr('disabled', 'disabled');
				$('#cmbInstitute').val("Loading...");
				$.ajax({
					url:"db_index.php?type=SELECT_INSTITUTE&location="+location,
					mType:"get",
					success:function(response){ 
						$("#spanProcessingInstitute").hide(); 
						var options = "<option value =''>All Institute</option>";
						var res1 = JSON.parse(response);
						$.each(res1.aaData,function(i,data){
							options = options + "<option value="+data.institute_code+">"+data.institute_name+"</option>";
							
						});
									
						
						$('#cmbInstitute').html("");   //campusid from academicPeriod
						$('#cmbInstitute').append(options);
						$('#cmbInstitute').removeAttr('disabled');
						
						//alert("hello");		
					},
					error:function(){
						toastr.error("We are unable to Process.Please contact Support");
					}
				});
			}
			else
			{
				$("#cmbInstitute").html("<option>Loading...</option>");
				$("#cmbInstitute").attr('disabled', 'disabled');
				$('#cmbInstitute').val("Loading...");
				$.ajax({
					url:"db_index.php?type=SELECT_ALL_INSTITUTE",
					mType:"get",
					success:function(response){ 
						$("#spanProcessingInstitute").hide(); 
						var options = "<option value =''>All Institute</option>";
						var res1 = JSON.parse(response);
						$.each(res1.aaData,function(i,data){
							options = options + "<option value="+data.institute_code+">"+data.institute_name+"</option>";
							
						});
									
						
						$('#cmbInstitute').html("");   //campusid from academicPeriod
						$('#cmbInstitute').append(options);
						$('#cmbInstitute').removeAttr('disabled');
						
						//alert("hello");		
					},
					error:function(){
						toastr.error("We are unable to Process.Please contact Support");
					}
				});
				
			}
		});
	</script>
  </body>
</html>