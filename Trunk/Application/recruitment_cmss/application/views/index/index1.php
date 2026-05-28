<style>
	body{
		background-image: url("<?php echo base_url(); ?>public/assets/images/bg1a.jpg");
	}
</style>
<div class="container" style="margin-top: 90px; padding-bottom: 50px;">
		<div class="row">
			<div class="col-lg-12" style="margin-bottom:10px;">
				<h3 style="margin-bottom:10px; color: #f9f94f;" align="center">Please Select the Institute</h3>
			</div>
			<form name="formFilterInstitutes" method="POST" action="">
			<div class="col-lg-12">
				
				<div class="form-group  horizontalsearchbar">
					<div class="col-md-1">
						<label for="" class="control-label" >Location: </label>
					</div>
					<div class="col-md-3">
						<select name="cmbLocation" class="form-control" id="cmbLocation"  >
							<option value="">All Location</option>

						</select>
					</div>	
					<div class="col-md-1">
						<label for="" class="control-label" >Institute: </label>
					</div>
					<div class="col-md-3">
						<select name="cmbInstitute" class="form-control" id="cmbInstitute"  >
							<option value="">All Institute</option>
						</select>
					</div>
					<div class="col-md-2 col-sm-offset-2">
						<button type="submit" class="btn btn-primary" id="btnPersonalInfo" name="btnPersonalInfo">Search</button>
					</div>
				</div>
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
										 <a href="apply/institute_page/ins/<?=$ins?>" class="btn btn-primary">Proceed</a>
									</div>
								</div>
						</div>
						

<?php } 

?>


								

						
					</div>
					</ul>
				</div>
            </div>
			</form>
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