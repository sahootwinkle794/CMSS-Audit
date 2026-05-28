 <?php 
 	//ini_set("allow_url_include", true);
 	$base_url = base_url();
 	//require($base_url "public/assets/css/apssb_style.php");
 	//include_once ('apssb_style.php');
 	//include base_url().'public/assets/css/apssb_style.php';
	//$inscode1 = $this->session->set_userdata('ins_code', $institute);
	$logo = '';
	$inscode = '';
	$ins = '';
	$insname = '';
	foreach($institute as $row){ 
		$ins_code = $row['institute_code'];
		$institute_code = encrypt_decrypt('encrypt',$ins_code);
		$ins_type = $row['type'];
	}
	if($ins_type == "RECRUITMENT")
	{
		$img = "online_recruitment.png";
	}
	else
	{
		$img = "online_admision.png";
	}
?>

<link href="<?php echo base_url(); ?>public/assets/css/style.css" rel="stylesheet" /> 
<link href="<?php echo base_url(); ?>public/assets/css/apssb_style.css" rel="stylesheet" />
<style>
	.accordion {
	  width: 100%;
	  height: 250px;
	  overflow: hidden;
	  margin: 60px auto;
	}

	.accordion ul {
	  width: 100%;
	  display: table;
	  table-layout: fixed;
	  margin: 0;
	  padding: 0;
	}

	.accordion ul li {
	  display: table-cell;
	  vertical-align: bottom;
	  position: relative;
	  width: 16.666%;
	  height: 250px;
	  background-repeat: no-repeat;
	  background-position: center center;
	  transition: all 500ms ease;
	}

	.accordion ul li div {
	  display: block;
	  overflow: hidden;
	  width: 100%;
	}

	.accordion ul li div a {
	  display: block;
	  height: 250px;
	  width: 100%;
	  position: relative;
	  z-index: 5;
	  vertical-align: bottom;
	  padding: 15px 20px;
	  box-sizing: border-box;
	  color: #fff;
	  text-decoration: none;
	  font-family: Open Sans, sans-serif;
	  transition: all 200ms ease;
	}

	.accordion ul li div a * {
	  opacity: 0;
	  margin: 0;
	  width: 100%;
	  text-overflow: ellipsis;
	  position: relative;
	  z-index: 5;
	  white-space: nowrap;
	  overflow: hidden;
	  -webkit-transform: translateX(-20px);
	  transform: translateX(-20px);
	  -webkit-transition: all 400ms ease;
	  transition: all 400ms ease;
	}

	.accordion ul li div a h2 {
	  font-family: Montserrat, sans-serif;
	  text-overflow: clip;
	  font-size: 24px;
	  text-transform: uppercase;
	  margin-bottom: 2px;
	}
	a {

	    color: #451f12;

	}
	.accordion ul li div a p {
	  font-size: 13.5px;
	}

	.accordion ul li:nth-child(1){background-image:url("<?php echo base_url(); ?>upload/image/AP_1.jpg")}

	.accordion ul li:nth-child(2) { background-image:url("<?php echo base_url(); ?>upload/image/AP_2.jpeg") }

	.accordion ul li:nth-child(3) { background-image:url("<?php echo base_url(); ?>upload/image/AP_3.jpeg") }

	.accordion ul li:nth-child(4) { background-image:url("<?php echo base_url(); ?>upload/image/AP_4.jpg") }

	.accordion ul li:nth-child(5) { background-image:url("<?php echo base_url(); ?>upload/image/AP_5.jpeg") }

	.accordion ul li:nth-child(6) { background-image: url("<?php echo base_url(); ?>upload/image/AP_6.jpg")}

	.accordion ul li:nth-child(7) {  background-image:url("<?php echo base_url(); ?>upload/image/AP_7.jpg") }

	.accordion ul li:nth-child(8) { background-image:url("<?php echo base_url(); ?>upload/image/AP_8.jpg") }

	.accordion ul:hover li { width: 8%; }

	.accordion ul:hover li:hover { width: 30%;}

	.accordion ul:hover li:hover a { background: rgba(0, 0, 0, 0); }

	.accordion ul:hover li:hover a * {
	  opacity: 1;
	  -webkit-transform: translateX(0);
	  transform: translateX(0);
	}
	
	.widthrow{
		width:98%;
		margin: 10px auto;
	}
	.widthcol{
		width: 69%;
	}
	@media screen and (max-width:680px) {
		.chairman {
		    /* height: 340px; */
		    width: 100% !important;
		    margin: 0 auto;
		    left: -1.5%;
		}
		.widthrow{
			width:100%;
			margin: 10px auto;
		}
		.widthcol{
			width: 100%;
		}
		.left{
			left: -1.5%;
		}
	}
	@media screen and (min-width:768px) {
		
		.widthcol{
			width: 48%;
		}
		.image-bar{
			
			margin-left: 158px;
		}
	}
	
</style>

<a id="back2Top" title="Back to top" href="#" style="display: block;"><i class="fa fa-angle-up" aria-hidden="true"></i></a>
<section style="background: #F0E1BA; background-size: cover;">
	
	
       	
       	<div class="row annc-row" >
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 Ann">
	            <div class="hidden-sm hidden-xs col-md-1 col-lg-1 col-xl-1 ">
	            	<label class="imgLabel-1" ><img src="<?php echo base_url()?>upload/image/ann.png"></label>
	            </div>
	            <div class="col-sm-12 col-xs-12 col-md-11 col-lg-11 col-xl-11 ">	
					<label style="font-size: 15px">
						<marquee direction="left" behavior="scroll" scrollamount="3" onmouseover="this.stop();" onmouseout="this.start();" style="color: white; padding-top: 0px;">
							<?php
								if(isset($announcements)){
									foreach($announcements as $row)
									{																	
									  echo $row['news_details'];
									  echo "&nbsp;&nbsp;|&nbsp;&nbsp;";
									}
								}
								 
							?>  
						</marquee>
					</label>
				</div>
			</div>
       	</div>
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-8 col-xl-8" style="padding-right: 7px;padding-left: 0px;">
				
				<img class="mgandhi" src="<?php echo base_url()?>public/assets/images/APSSB/Slider 1.png">
				
			</div>
			<?php 
				foreach($chairman_details as $row)
				{
					$name = $row['name'];
					$message = $row['message'];
					$profile_photo = $row['profile_photo'];
				}
				 ?>
			
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-4 chairman" style="background: url(<?php echo base_url()?>public/assets/images/APSSB/ch_bg.png) no-repeat;background-size: cover; left: 1% ">
				
				<center><img  class= "img-circle img-responsive " style="height: 145px; margin: 30px auto;" src="<?=$profile_photo?>">
		
				<p  style="color:white; font-size: 18px;"><?=$name?></p>
				<p style="color:white;">Honble Chief Minister</p>
				<p style="color:white; cursor: pointer;"onclick="about_chirman();"> Message</p></center>
            
		     </div>
		</div>
		
		
		
</section>

<section style=" background:url('<?php echo base_url(); ?>public/assets/images/APSSB/bg2.png'); background-size: cover; min-height:920px;">
	<div class="container-fluid widthrow">
		<div class="row" >
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 " style="width: 103%;">
			<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4 chairman"  style="background: url(<?php echo base_url()?>public/assets/images/APSSB/ch_bg.png) no-repeat;background-size: cover; ">
				
		    	<?php 
				foreach($chairman_details as $row)
				{
					$name = $row['name'];
					$message = $row['message'];
					$profile_photo = $row['profile_photo'];
				}
				 ?>
				
				
				<center>
					<img  class= "img-circle img-responsive " style="height: 145px; margin: 30px auto;" src="<?php echo base_url(); ?>public/photos/secretary.jpeg">
					<p  style="color:white; font-size: 18px;">Mr. Naresh Kumar, IAS </p>
					<p style="color:white;">Chief Secretary</p>
				<!--<p style="color:white;"onclick="about_chirman();"> Message</p>-->
				</center>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-8 col-lg-8 col-xl-8 left ">
				<div class="panel panel-default " style="border-color: #fff;">
					<div class="panel-heading" style="background-color:#7b3c2d;height:40px;">
						<h4 class="panel-title" style="color: #fff;cursor: pointer;"><img src="<?php echo base_url()?>public/assets/images/APSSB/Apply.png"> NOTICE
							<button type="button" title="View All" id="viewAll" data-target="#newsModal" data-placement="top" data-toggle="tooltip" class="pull-right button-black" >
									View All 
							</button>
						</h4>
					</div>
					
			        	<div class="" style=" height: 300px; overflow-y: auto;overflow-x: hidden;">
			        		<?php 
			        		$count = 1;
			        		foreach($news_details as $row)
							{ 
								$created_date = $row['created_on'];
								$arr_date = explode("-",$created_date);
								$date = $arr_date[0];
								$month = $arr_date[1];
								$year = $arr_date[2];
								$news = $row['news_details'];
							    $link_path= $row['link_path'];
								if($count <= 10)
								{
							?>
				        		<div class=" row article-div notice-text" style="box-shadow:0 2px 2px 0 rgba(0,0,0,0.10), 0 1px 20px 0 rgba(0,0,0,0.10); height: auto;margin-top: 3%;">
				        			<div class="col-xs-4 col-sm-4 col-md-2 col-lg-2 col-xl-2">
					        			<article>
						        			<div class="row box_square_large">
						        				<div class="col-sm-12">
						        					<div class="col-sm-4" style="color:#fff;padding-top:10px">
						        						<h2 style="color:#fff;font-size:20px;margin-left:-10px;margin-top:10px;"></h2>
						        					</div>
						        					<div class="col-sm-8" style="color:#fff;margin-top:-23px">
						        						<span style="margin-top: 11px;position: absolute;margin-left: 7px;"><?=$date?></span>
						        						<span style="display: inline-block;white-space: nowrap;margin-left: -17px;position: absolute;margin-top: 28px;"><?= $month ?> <?= $year ?></span>
						        					</div>
						        					
									        	</div>
						        			</div>
					        			</article>
				        			</div>
				        			<div class="col-xs-8 col-sm-8 col-md-10 col-lg-10 col-xl-10">
					        			<aside style="margin-top: 25px;">
					        			<p class="notice_1"><a href="<?=$link_path!=''?$link_path:'#' ?>" target="_blank"><?= $news ?></a></p><!--
					        				<p class="notice"><a href=" " ></a>APPS Combined Competitive Examination Rules,2001</p>-->
					        			</aside>
				        			</div>
				        		</div>
			        		
			        	<?php 
		        				
								}
								$count++;
				        	} 
				        ?>	
				        </div>
			      	
		    	</div> 
				
			</div>
			
		</div>
		</div>
		<div class="row" style="padding:30px 0;width:93%;margin:-30px auto;height: auto;">
			<div class="col-md-12">
				
				<div class="col-md-12 " style="margin-left: -1%;padding-right: 2%;" >
					<div class="row" style="padding:0">
						<div class="col-md-4 nopad" style="padding-left: 0">
							<div  class="box-color">
								<img  class="box-image" src="<?php echo base_url()?>public/assets/images/APSSB/Applications.png">
								<label class="box-text">Applications</label>
							</div>
						</div>
						
						<div class="col-md-4 nopad">
							<div  class="box-color" >
								<img  class="box-image" src="<?php echo base_url()?>public/assets/images/APSSB/examination.png">
								<label class="box-text">Examinations</label>
							</div>
						</div>
						
						<div class="col-md-4 nopad">
							<div class="box-color" >
								<img  class="box-image" src="<?php echo base_url()?>public/assets/images/APSSB/prev qust.png">
								<p onclick="previous_question();" class="box-text" style="margin-left: 37px;margin-top: -13px">Previous Year Question Paper</p>
							</div>
						</div>
						<!--<div class="col-md-3 nopad">
							<div  class="box-color" >
								<img  class="box-image" src="<?php echo base_url()?>public/assets/images/APSSB/telephone.png">
								<p onclick="Telephone_data();" class="box-text" style="margin-left: 30px; margin-top: 0px;">Telephone Directory</p>
							</div>
						</div>	-->
					</div>
					<div class="hidden-xs col-sm-12 col-md-12 col-lg-12 col-xl-12 " style="padding:20px 0;width:100%;margin-left: -1%;padding-right: 2%;">
						<button type="button" class = "image-gallery" <i class="fa fa-photo"></i> Image Gallery</button>
							<div  class="image-bar"></div>
								<div class="container" style="padding-left: 0px; padding-right: 0px; width: 100%;">
									
										<body>
											<div class="accordion">
											  <ul>
											    <li>
											      <div> <a href="#"><!--
											        <h2>Title 1</h2>
											        <p>Description 1</p>-->
											        </a> </div>
											    </li>
											    <li>
											      <div> <a href="#">
											        </a> </div>
											    </li>
											    <li>
											      <div> <a href="#">
											        </a> </div>
											    </li>
											    <li>
											      <div> <a href="#">
											        </a> </div>
											    </li>
											    <li>
											      <div> <a href="#">
											        </a> </div>
											    </li>
											    <li>
											      <div> <a href="#">
											        
											        </a> </div>
											    </li>
											    <li>
											      <div> <a href="#">
											        </a> </div>
											    </li>
											    <li>
											      <div> <a href="#">
											        </a> </div>
											    </li>
											  </ul>
											</div>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-46156385-1', 'cssscript.com');
  ga('send', 'pageview');

</script>
</body>
 
						</div>
					</div>
				</div>
					
				
	
			</div>
		</div>
	</div>
	<div class="modal fade" id="newsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
		<div class="modal-dialog"style="width:100%;">
			<div class="modal-content"> <!--style="background-repeat: no-repeat; background:url(<?php echo base_url(); ?>public/photos/rink_background.jpg)"-->
				<div class="modal-header">
					<button type="button" class="close"  style="position: unset;font-size:25px" data-dismiss="modal" aria-hidden="true">
						&times;
					</button>
					<!--<h3 style="text-align: center;color: black;">All News</h3>-->
				</div>
				<div class="modal-body" >
					
					<div class="panel panel-default " style="border-color: #fff;">
					<div class="panel-heading" style="background-color:#7b3c2d;height:40px;">
						<h4 class="panel-title" style="color: #fff;cursor: pointer;"><img src="<?php echo base_url()?>public/assets/images/APSSB/Apply.png"> NOTICE
						
						</h4>
					</div>
			        
						
				        	<div class="panel-body" style="background-repeat: no-repeat; background:url(<?php echo base_url(); ?>public/photos/rink_background.jpg);height: 300px;overflow-y: scroll;margin-bottom: -22px;">
				        		<?php 
				        		foreach($news_details as $row)
								{ 
									$created_date = $row['created_on'];
									$arr_date = explode("-",$created_date);
									$date = $arr_date[0];
									$month = $arr_date[1];
									$year = $arr_date[2];
									$news = $row['news_details'];
									$link_path= $row['link_path'];
								?>
				        		<div class="article-div notice-text" style="box-shadow:0 2px 2px 0 rgba(0,0,0,0.10), 0 1px 20px 0 rgba(0,0,0,0.10); height: 30%;margin-top: 3%;">
			        			<article>
				        			<div class="row box_square_large_1">
				        				<div class="col-sm-12">
				        					<div class="col-sm-4" style="color:#fff;padding-top:10px">
				        						<h2 style="color:#fff;font-size:20px;margin-left:-10px;margin-top:10px;"></h2>
				        					</div>
				        					<div class="col-sm-8" style="color:#fff;margin-top:-23px">
				        						<span style="margin-top: 11px;position: absolute;margin-left: 7px;"><?=$date?></span>
				        						<span style="display: inline-block;white-space: nowrap;margin-left: -17px;position: absolute;margin-top: 28px;"><?= $month ?> <?= $year ?></span>
				        					</div>
				        					
							        	</div>
				        			</div>
			        				
			        			</article>
			        			<aside style="margin-top: 8px;">
			        			<p class="notice"><a href="<?=$link_path!=''?$link_path:'#' ?>" target="_blank"><?= $news ?></a></p><!--
			        				<p class="notice"><a href=" " ></a>APPS Combined Competitive Examination Rules,2001</p>-->
			        			</aside>
			        		</div>
				        		<?php 
						        	} 
						        ?>
					        </div>
				      	
			    	</div> 

							
							
					</div>
				</div>
			</div>
	</div>
</section>

<div class="modal fade" id="Telephone_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" style="width: 100%;min-width: 58%">
    	<div class="modal-content" style="background-size: 211% !important; max-height: 400px; background:url(<?php echo base_url(); ?>public/photos/rink_background.jpg)">
				<div class="modal-header">
					
					<button type="button" class="close"  style="position: unset;font-size:37px" data-dismiss="modal" aria-hidden="true">
						&times;
					</button>
					<h3 style="text-align: center;">Telephone Directory</h3>
				</div>
      		<div class="modal-body" style="min-height: 790px; margin-top: 18px;">
	      		<div class="col-sm-12">
	      			<div id="container" style="overflow-y: auto;height: 750px;" >
	      			
		      			<table border="1" cellpadding="2" cellspacing="0" style="border-collapse: collapse;  margin-left: 20px; overflow-y: auto" bordercolor="#111111" width="700" id="AutoNumber10">
         					<tr>
							    <td width="23%" align="center" bgcolor="#eee9cb" rowspan="2" height="21">
								    <span style="text-transform: uppercase; font-weight:700;">
								    <font face="Verdana" size="2" color="#000080">NAME</font></span>
							    </td>
							    <td width="31%" align="center" bgcolor="#eee9cb" rowspan="2" height="21">
								    <span style="text-transform: uppercase; font-weight:700">
								    <font face="Verdana" size="2" color="#000080">DESIGNATION</font></span>
							    </td>
							    <td width="48%" align="center" bgcolor="#eee9cb" colspan="2" height="16"><b>
							    	<font size="2" face="Verdana" color="#000080">TELEPHONE NUMBER</font></b>
							    </td>
							</tr>
							<tr>
							    <td width="15%" align="center" bgcolor="#eee9cb" height="1">
								    <span style=" font-weight:700">
								    <font face="Verdana" size="2" color="#000080">OFFICE </font></span>
							    </td>
							    
							    <td width="19%" align="center" bgcolor="#eee9cb" height="1">
								    <span style="text-transform: uppercase; font-weight:700">
								    <font face="Verdana" size="2" color="#000080">MOBILE </font></span>
							    </td>
         					</tr>
         					
         						<?php 
         							foreach($telephone_details as $row)
         							{
         								$name = $row['name'];
         								$designation = $row['designation'];
         								$office_no = $row['office_no'];
         								$mobile_no = $row['mobile_no'];
         								
         							 ?>
         							 <tr>
										<td style="text-transform: uppercase; font-size: 11px; text-align: center;font-weight: bold;"><?=$name?></td>
										<td style="text-transform: uppercase;font-size: 11px;text-align: center; font-weight: bold;"><?=$designation?></td>
										<td style="text-align: center; font-weight: bold;"><?=$office_no?></td>
										<td style="text-align: center; font-weight: bold;"><?=$mobile_no?></td>
									</tr>
									
										
									<?php } ?>
         							
         					
         				</table>
		      			
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="question_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" style="width: 100%;min-width: 58%">
    	<div class="modal-content" style="background-size: 211% !important; max-height: 400px;  background:url(<?php echo base_url(); ?>public/photos/rink_background.jpg)">
				<div class="modal-header">
					<h3 style="text-align: center;">Previous year Question Papers</h3>
					<button type="button" class="close"  style="padding-left: 95%; margin-top: -50px;" data-dismiss="modal" aria-hidden="true">
						&times;
					</button>
				</div>
      		<div class="modal-body" style="min-height: 790px; margin-top: 18px;">
	      		<div class="col-sm-12">
	      			<div id="container" style="overflow-y: auto;height: 750px;" >
	      				<table border="1" cellpadding="2" cellspacing="0" style="border-collapse: collapse; margin-left: 20px; overflow-y: auto" bordercolor="#111111" width="700" id="AutoNumber11">
         					<tr>
							    <td width="20%" align="center" bgcolor="#eee9cb"  height="35">
								    <span style="text-transform: uppercase; font-weight:700; text-align: center;">
								    <font face="Verdana" size="2" color="#000080">Question papers</font></span>
							    </td>
							    <td width="30%" align="center" bgcolor="#eee9cb" height="35">
								    <span style="text-transform: uppercase; font-weight:700">
								    <font face="Verdana" size="2" color="#000080">URL</font></span>
							    </td>
							 </tr>
							 
							 <?php 
         							foreach($question_details as $row)
         							{
         								$ques_set = $row['ques_set'];
         								$link_path = $row['link_path'];
         							 ?>
         							 <tr>
										
										<td style="text-align: center; height:35;"><?=$ques_set?></td>
										<td style="text-align: center; height:35;">
											<a href="<?=$link_path?>" target="_blank" >Click Here</a>
										</td>
									</tr>
									
										
									<?php } ?>
							
         				</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="chairman_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" style="width: 100%;min-width: 58%">
    	<div class="modal-content back-img" style="">
				<div class="modal-header" style="border-bottom: 0px;">
					
					<button type="button" class="close"  style="position: unset;font-size:37px" data-dismiss="modal" aria-hidden="true">
						&times;
					</button>
					<h3 style="text-align: center;">Message From Chief Minister's Desk</h3>
				</div>
				<?php 
				foreach($chairman_details as $row)
				{
					$name = $row['name'];
					$message = $row['message'];
					$profile_photo = $row['profile_photo'];
				}
				 ?>
      		<div class="modal-body" style="min-height: 790px; margin-top: 18px;">
	      		<div class="col-sm-12">
	      			<div id="container" style="overflow-y: auto;height: 750px;" >
	      				<div class="img-box1" style="">
	      					<img style="width: 100%; height: 100%;" class="img-circle" src="<?=$profile_photo?>"/>
	      				</div>
	      				<div style="margin-top: 75px;">      						
							<p class="title" style="text-align: center; font-size: 18px;"><?=$name?></p>
							<p class="title" style="text-align: center;">Chief Minister </p>
							<p style="text-align: justify;width: 90%;padding: 25px;margin-left: 34px;"><?=$message?></p>										
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="chief_sec_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" style="width: 100%;min-width: 58%">
    	<div class="modal-content back-img" style="">
				<div class="modal-header" style="border-bottom: 0px;">
					
					<button type="button" class="close"  style="position: unset;font-size:37px" data-dismiss="modal" aria-hidden="true">
						&times;
					</button>
					<h3 style="text-align: center;">Message From Chief Secretery's Desk</h3>
				</div>
				
				<?php 
				foreach($chairman_details as $row)
				{
					$name = $row['name'];
					$message = $row['message'];
					$profile_photo = $row['profile_photo'];
				}
				 ?>
				 
      		<div class="modal-body" style="min-height: 790px; margin-top: 18px;">
	      		<div class="col-sm-12">
	      			<div id="container" style="overflow-y: auto;height: 750px;" >
	      				<div class="img-box1">
	      					<img style="width: 100%; height: 100%;" class="img-circle" src="<?php echo base_url()?>public/assets/images/chairman_photo/CS.jpeg"/>
	      				</div>
	      				<div style="margin-top: 75px;">      						
							<p class="title" style="text-align: center; font-size: 18px;">Mr.Naresh Kumar, IAS </p>
							<p class="title" style="text-align: center;">Chief Secretary </p>
							<p style="text-align: justify; overflow : hidden;width: 90%;padding: 25px;margin-left: 34px;"></p>										
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>	
<script>
	$("#viewAll").click(function(){
		$("#newsModal").modal('show');
	});
	
	function Telephone_data(){
		$("#Telephone_modal").modal('show');
	}
	function previous_question(){
		$("#question_modal").modal('show');
		
	}
	function about_chirman(){
		$("#chairman_modal").modal('show');
		
	}
	function about_chief_sec(){
		$("#chief_sec_modal").modal('show');
		
	}
	 $("document").ready(function($){
    var nav = $('#back2top');

  /* $(window).scroll(function () {
        if ($(this).scrollTop() > 125) {
            nav.addClass("f-hide");
        } else {
            nav.removeClass("f-hide");
        }
    });*/
    /*$(window).scroll(function() {
	    var height = $(window).scrollTop();
	    if (height > 100) {
	        $('#back2Top').fadeIn();
	    } else {
	        $('#back2Top').fadeOut();
	    }
	});*/
	/*$(document).ready(function() {
	    $("#back2Top").click(function(event) {
	        event.preventDefault();
	        $("html, body").animate({ scrollTop: 0 }, "slow");
	        return false;
	    });*/

});
});
</script>	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	