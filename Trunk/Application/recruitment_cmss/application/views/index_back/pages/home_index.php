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

<!--<link href="<?php echo base_url(); ?>public/assets/css/style.css" rel="stylesheet" /> 
<link href="<?php echo base_url(); ?>public/assets/css/apssb_style.css" rel="stylesheet" />-->

<style>
	.buttontop{
		color: #105a0a;
	    font-size: 17px;
	    background: linear-gradient(to bottom, #fffdd4, #fff78a);
	    width: 60%;
	    padding: 8px;
	    border-radius: 6px;
	    margin-top: 43px;
	    font-weight: 700;
	    padding-left: 26px;
	    text-align: left;
	    cursor: pointer;
	}
	.buttonlast{
		color:#105a0a;
	    font-size: 17px;
	    background: linear-gradient(to bottom, #fffdd4, #fff78a);
	    width: 60%;
	    padding: 8px;
	    border-radius: 6px;
	    margin-top: 15px;
	    font-weight: 700;
	    padding-left: 26px;
	    text-align: left;
	    cursor: pointer;
	}
	.calender{
		color: #fff;
	    font-size: 18px;
	    background: linear-gradient(to bottom, #062f63,#062f63);
	    width: 100%;
	    padding: 22px;
	    border-radius: 7px;
	    text-align: center;
	    margin-top: 0px !important;
	}
	.img-style{
		width: 100%;
	   /* box-shadow: 2px 2px 5px 0px #e5e5e5;*/
	   box-shadow: 2px 2px 6px 1px #cccccccf;
	    border-radius: 6px;
	    margin-top: 7px;
	}
	.news{
		background-color: #fb511e !important;
	    height: 50px;
	    border-top-left-radius: 7px;
	    border-top-right-radius: 7px;
	    
	}
	.button-black {
	    color: #ffffff;
	    width: 85px;
	    height: 49px;
	    margin-top: -10px;
	    background: #000000;
	    border: 1px solid #d25c42;
	    margin-right: -15px;
	    border-top-right-radius: 7px;
	}
	.box_square_large {
	    width: 70px;
	    height: 58px;
	    background: #000000;
	    border-radius: 10px;
	}
	.dat{
	    font-size: 15px;
	    margin-top: 1px;
	    position: absolute;
	    margin-left: -2px;
	}
	.mon{
		 white-space: nowrap;
	    margin-left: -20px;
	    position: absolute;
	    margin-top: 25px;
	    font-size: 12px;
	}
	.notice{
		color: #000000;
    	font-size: 16px;
	}
	hr {
	    margin-top: 10px;
	    margin-bottom: 10px;
	    border-top: 1px solid #dad9d9;
	    margin-left: 12px;
	    width: 97%;
	}
	
</style>
<style>
	.accordion {
	  width: 100%;
	  height: 250px;
	  overflow: hidden;
	  margin: 20px auto;
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
	.image-gallery{
		height: 40px;
		border-radius: 20px;
		border: 2px solid #ffab4b;
		background: #orange;
		color: #451e0f;
		width: 25%;
		font-weight: 600;
		font-size: 18px;
		background: #fec689;
		z-index: 1;
	}
	.image-bar{
		position: absolute;
	    width: 73%;
	    display: inline-block;
	    border: 2px solid #ffa849;
	    min-height: 1px;
	    margin-top: 17px;
	}
	.note{
	    background-color: #4c030b !important;
	    height: 50px;
	    border-top-left-radius: 7px;
	    border-top-right-radius: 7px;
	
	}
	@media (max-width: 1286px)
	{
		.buttontop{
			width: 80%;
		}
		.buttonlast{
			width: 80%;
		}
	}

</style>
<a id="back2Top" title="Back to top" href="#" style="display: block;"><i class="fa fa-angle-up" aria-hidden="true"></i></a>


<section style=" position: relative;background:url('<?php echo base_url(); ?>public/assets/images/APSSB/Background.png'); background-size: cover; min-height:730px;">
	<div class="container-fluid widthrow">
		<div class="row">
			<div class="hidden-xs col-sm-1 col-md-1 col-lg-1 col-xl-1"></div>
			<div class="col-xs-12 col-sm-5 col-md-7 col-lg-7 col-xl-7" style="padding-right: 5px;padding-left: 5px;">
				<img class="img-responsive" style="width: 100%; height: 205px;" src="<?php echo base_url()?>public/assets/images/apssb-web/Group_31.png">
				
			</div> 
			<div class="col-xs-12 col-sm-5 col-md-3 col-lg-3 col-xl-3" style="background: url(<?php echo base_url()?>public/assets/images/apssb-web/login_BG.png) no-repeat;background-size: cover; margin-left: 3px; margin-right:3px;height: 205px;border-radius: 10px;">
				<center>
					<div  class="buttontop" id="login">
						<!--<span class="fa-stack fa-sm">
						  <i class="fa fa-circle-o fa-stack-2x"></i>-->
						  <i class="fa fa-sign-in" style="color:green"></i>
						<!--</span>-->&nbsp;&nbsp;Login
					</div>
					<div  class="buttonlast" id="registration">
						<!--<span class="fa-stack fa-sm">
						  <i class="fa fa-circle-o fa-stack-2x"></i>-->
						  <i class="fa fa-user-plus" style="color:green"></i>
						<!--</span>-->&nbsp;&nbsp;Register Now
					</div>
				</center>		
			</div>
			<div class="hidden-xs col-sm-1 col-md-1 col-lg-1 col-xl-1"></div>
		</div>
		<div class="row">
			<div class="hidden-xs col-sm-1 col-md-1 col-lg-1 col-xl-1"></div>
				<div class="col-xs-12 col-sm-5 col-md-7 col-lg-7 col-xl-7" style="padding-right: 5px;padding-left: 5px;">
			 	<div class="panel panel-default " style="border-color: #fff;box-shadow: 0px 0px 5px 2px #dadadacf;margin-top: 7px;">
					<div class="panel-heading news">
						<h4 class="panel-title" style="color: #fff;cursor: pointer;"><img src="<?php echo base_url()?>public/assets/images/APSSB/Apply.png">&nbsp;&nbsp;Latest News
							<!--<button type="button" title="View All" id="viewAll" data-target="#newsModal" data-placement="top" data-toggle="tooltip" class="pull-right button-black" >
									View All 
							</button>-->
						</h4>
					</div>
					<!--<marquee direction="up" behavior="scroll" scrollamount="3" onmouseover="this.stop();" onmouseout="this.start();" style="color: #00264a;text-align: justify;">
					-->	<div class="" style=" height: 443px;">
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
								if($count <= 1)
								{
							?>
				        		<div class=" row article-div notice-text" style="/*box-shadow:0 2px 2px 0 rgba(0,0,0,0.10), 0 1px 20px 0 rgba(0,0,0,0.10);*/ height: auto;margin-top: 1%;">
				        				<div class="col-xs-4 col-sm-4 col-md-2 col-lg-2 col-xl-2">
					        			<article>
						        			<div class="row box_square_large">
						        				<div class="col-sm-12">
						        					<div class="col-sm-4" style="color:#fff;padding-top:19px">
						        						<h2 style="color:#fff;font-size:20px;margin-left:-10px;margin-top:10px;"></h2>
						        					</div>
						        					<div class="col-sm-8" style="color:#fff;margin-top:-23px">
						        						<span class="dat"><?=$date?></span>
						        						<span class="mon"><?= $month ?> <?= $year ?></span>
						        					</div>
						        					
									        	</div>
									        	
						        			</div>
					        			</article>
				        			</div>
				        			<div class="col-xs-8 col-sm-8 col-md-10 col-lg-10 col-xl-10">
					        			<aside style="margin-top: 0px;">
					        			<p><a class="notice" href="<?=$link_path!=''?$link_path:'#' ?>" target="_blank"><?= $news ?></a></p><!--
					        				<p class="notice"><a href=" " ></a>APPS Combined Competitive Examination Rules,2001</p>-->
					        			</aside>
				        			</div>
				        			
				        		</div>
				        		
				        		<hr>
			        		
			        	<?php 
		        				
								}
								$count++;
				        	} 
				        ?>	
				        </div>
			      <!--	</marquee> -->
		    	</div> 
				 
			
			</div>
			<div class="col-xs-12 col-sm-5 col-md-3 col-lg-3 col-xl-3" style="padding-right: 5px;padding-left: 5px; margin-top: 7px;">
				<div class="row">
					<div class=" img-style calender">Examination Calender</div>
				</div>
				<div class="row">
					<a class="notice" href="https://gandhi.gov.in/" target="_blank"><img class="img-responsive img-style" src="<?php echo base_url()?>public/assets/images/apssb-web/150_years_of.png"></a>
				</div>
				<div class="row" >
					<a class="notice" href="https://www.ncs.gov.in/" target="_blank"><img class="img-responsive img-style"  src="<?php echo base_url()?>public/assets/images/apssb-web/National_CS.png"></a>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="padding-right: 5px;padding-left: 5px;">
					 	<div class="panel panel-default " style="border-color: #fff;box-shadow: 0px 0px 5px 2px #dadadacf;margin-top: 7px;">
							<div class="panel-heading note">
								<h4 class="panel-title" style="color: #fff;cursor: pointer;"><img src="<?php echo base_url()?>public/assets/images/APSSB/Apply.png">&nbsp;&nbsp;Notice
								</h4>
							</div>
					        	<div class="" style=" height: 175px;">
						        		<div class="row">
						        			<div class="col-xs-11 col-sm-11 col-md-11 col-lg-11 col-xl-11">
							        			<marquee direction="up" behavior="scroll" scrollamount="3" onmouseover="this.stop();" onmouseout="this.start();" style="height:175px;color: #00264a;text-align: justify;">
												<?php
														foreach($announcements as $row)
														{																	
														  echo $row['news_details'];
														  echo "<hr>";
														}
													
													 
												?>  
											</marquee>
						        			</div>
						        		</div>
						        </div>
				    	</div> 
					</div>	
				</div>
				
				<!--<div class="row" >
					<a class="notice" href="#" target="_blank"><img class="img-responsive img-style"src="<?php echo base_url()?>public/assets/images/apssb-web/Ek_Bharat.png"></a>
				</div>-->
		     </div>
			<div class="hidden-xs col-sm-1 col-md-1 col-lg-1 col-xl-1"></div>
			
		</div>
		<!--
		<div class="row">
			<div class="hidden-xs col-sm-1 col-md-1 col-lg-1 col-xl-1"></div>
			<div class="col-sm-12 col-sm-10 col-md-10 col-lg-10 col-xl-10 ">
				<button type="button" class = "image-gallery" <i class="fa fa-photo"></i> Image Gallery</button>
					<div  class="image-bar"></div>
					<div class="container">
					<body>
						<div class="accordion">
						  <ul>
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
			<div class="hidden-xs col-sm-1 col-md-1 col-lg-1 col-xl-1"></div>
		</div>
		-->
	</div>
	
</section>
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
	    var delayb4scroll=1000//Specify initial delay before marquee starts to scroll on page (2000=2 seconds)
         var marqueespeed=1 //Specify marquee scroll speed (larger is faster 1-10)
         var pauseit=1 //Pause marquee onMousever (0=no. 1=yes)?
         var copyspeed=marqueespeed
         var pausespeed=(pauseit==0)? copyspeed: 0
         var actualheight=''
         function scrollmarquee(){
         if (parseInt(cross_marquee.style.top)>(actualheight*(-1)+8))
         cross_marquee.style.top=parseInt(cross_marquee.style.top)-copyspeed+"px"
         else
         cross_marquee.style.top=parseInt(marqueeheight)+8+"px"
         }
         function initializemarquee(){
         cross_marquee=document.getElementById("vmarquee")
         cross_marquee.style.top=0
         marqueeheight=document.getElementById("marqueecontainer").offsetHeight
         actualheight=cross_marquee.offsetHeight
         if (window.opera || navigator.userAgent.indexOf("Netscape/7")!=-1){ //if Opera or Netscape 7x, add scrollbars to scroll and exit
         cross_marquee.style.height=marqueeheight+"px"
         cross_marquee.style.overflow="scroll"
         return
         }
         setTimeout('lefttime=setInterval("scrollmarquee()",30)', delayb4scroll)
         }
         if (window.addEventListener)
         window.addEventListener("load", initializemarquee, false)
         else if (window.attachEvent)
         window.attachEvent("onload", initializemarquee)
         else if (document.getElementById)
         window.onload=initializemarquee

});
</script>	
<script>
	function enable_logout(logoutopt){
		if(logoutopt=='YES'){
			confirmReturn = confirm("You have already sign-in with another system");
			if(confirmReturn){
				 $.ajax({
					url:base_url+"ajax_controller/logout_all_system",
					type:"post",
					data:{ txtPhoneNo:$('#txtCandidatePhone').val() },
					success:function(response){ 
						window.location.reload();	
					},
					error:function(){
						toastr.error("We are unable to Process.Please contact Support");
					}
				});
			}
		}
	}
	$("body").on('click','.toggle-password',function(){
	    $(this).toggleClass("fa-eye fa-eye-slash");

	    var input_type = document.getElementById('txtPassword1');
		//alert(input);
	    if (input_type.type === "password") {
	        input_type.type="text";
	    } else {
	        input_type.type="password";
	    }
	});
	$("body").on('click','.toggle-password_login',function(){
	    $(this).toggleClass("fa-eye fa-eye-slash");

	    var input_type = document.getElementById('txtPwd');
		//alert(input);
	    if (input_type.type === "password") {
	        input_type.type="text";
	    } else {
	        input_type.type="password";
	    }
	});

	$(document).ajaxSend(function(){
	    $('.loadingRPimage').fadeIn(250);
	});
	$(document).ajaxComplete(function(){
	    $('.loadingRPimage').fadeOut(250);
	});
	function isNumberKey(evt)
	{
	  var charCode = (evt.which) ? evt.which : evt.keyCode;
	  if (charCode != 46 && charCode > 31 
	    && (charCode < 48 || charCode > 57))
	     return false;

	  return true;
	}
	$("#newPassword").hide();
	
	$("#txtEmailId").change(function(){
		if($("#txtEmailId").val() != '')
		{
			if($("#txtCandidatePhone").val() == '')
			{
				var institutedata =
				{
					mail_id:$('#txtEmailId').val()
				};
				$.ajax({
					url:base_url+"ajax_controller/get_mobile_no",
					type:"post",
					data:institutedata,
					success:function(response){ 
						var result = JSON.parse(response);
						$("#hidMobileNo").val(result.mobile);
						//alert($("#hidMobileNo").val());
				  	},
				  	error:function(){
				   		toastr.error("We are unable to Process.Please contact Support");
				  	}
				});
			}
		}
	});
	$('#btnlogin').click(function(){ 
		
		if($("#txtCandidatePhone").val() == '' && $("#txtEmailId").val() == '')
		{
			$('#frmApply').data('bootstrapValidator').updateStatus('txtCandidatePhone', 'NOT_VALIDATED', null).validateField('txtCandidatePhone');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtPwd', 'NOT_VALIDATED', null).validateField('txtPwd');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtCaptcha', 'NOT_VALIDATED', null).validateField('txtCaptcha');
			//toastr.error("Please enter username and password");
			$("#txtCandidatePhone").focus();
			return false;
		}
		if($("#txtPwd").val() == '')
		{
			$('#frmApply').data('bootstrapValidator').updateStatus('txtCandidatePhone', 'NOT_VALIDATED', null).validateField('txtCandidatePhone');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtPwd', 'NOT_VALIDATED', null).validateField('txtPwd');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtCaptcha', 'NOT_VALIDATED', null).validateField('txtCaptcha');
			//toastr.error("Please enter username and password");
			$("#txtPwd").focus();
			return false;
		}
		if($("#txtCaptcha").val() == '')
		{
			$('#frmApply').data('bootstrapValidator').updateStatus('txtCandidatePhone', 'NOT_VALIDATED', null).validateField('txtCandidatePhone');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtPwd', 'NOT_VALIDATED', null).validateField('txtPwd');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtCaptcha', 'NOT_VALIDATED', null).validateField('txtCaptcha');
			//toastr.error("Please enter username and password");
			$("#txtCaptcha").focus();
			return false;
		} 
		md5KeyValue = "<?php echo $this->session->userdata('key');?>";
		
		var reg_user_id = document.getElementById("txtCandidatePhone").value;
		
		if(reg_user_id == '' || reg_user_id == null)
		{   
			var reg_user_id = $("#hidMobileNo").val();
			//alert(reg_user_id);
			
			
		}  
		//alert(reg_user_id);
		var confirmpassword = document.getElementById("txtPwd").value; 

		var encSaltSHAPassConfirm = encryptSha2LoginPassword(md5KeyValue,reg_user_id,confirmpassword);
		
		document.getElementById("txtPwd").value = encSaltSHAPassConfirm; //changed
		/*alert(reg_user_id);
		alert(confirmpassword);
		alert(encSaltSHAPassConfirm);*/
		//alert(encSaltSHAPassConfirm);
		
		return true;
	});

	/*$('#txtEmail').change(function(){
		var institutedata =
		{
			txtEmail:$('#txtEmail').val(),
			insCode:$('#insCode').val()
		};		
		$.ajax({
			url:base_url+"ajax_controller/check_email",
			type:"post",
			data:institutedata,
			success:function(response){  
				
				var res1 = JSON.parse(response);
				if(res1.present != 0)
				{
					toastr.error("Email Already Exists");
					$('#txtEmail').val('');
					$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtEmail', 'NOT_VALIDATED', null).validateField('txtEmail');
					$("#txtEmail").focus();
				}
				
				
			},
			error:function(){
				toastr.error("We are unable to Process.Please contact Support");
			}
		});
	});*/

	$('#registration').click(function(){
		refresh_captcha3();
		$('#frmApplyNew').bootstrapValidator('resetForm', true);
		$('#loginModal').modal('hide');
		$('#AdminloginModal').modal('hide');
		$('#forgotPasswordModal').modal('hide');
		$('#registrationModal').modal('show');
		$('#registrationModal').on('shown.bs.modal', function () 
		{ 
			$('#txtFirstName').focus(); // Focusing the textbox
		})
	});
	$('#login').click(function(){
		refresh_captcha4();
		$('#frm_login').data('bootstrapValidator').resetForm(true);
		$('#loginModal').modal('show');
		$('#AdminloginModal').modal('hide');
		$('#registrationModal').modal('hide');
		$('#forgotPasswordModal').modal('hide');
		$('#loginModal').on('shown.bs.modal', function () 
		{ 
			$('#txtCandidatePhone').focus(); // Focusing the textbox
		})
	});
	$('#registerAlreadyUser').click(function(){
		refresh_captcha4();
		$('#frm_login').data('bootstrapValidator').resetForm(true);
		$('#loginModal').modal('show');
		$('#AdminloginModal').modal('hide');
		$('#forgotPasswordModal').modal('hide');
		$('#registrationModal').modal('hide');
		$('#loginModal').on('shown.bs.modal', function () 
		{ 
			$('#txtCandidatePhone').focus(); // Focusing the textbox
		})
	});
	
	$('#loginNewUser').click(function(){ 
		refresh_captcha3();
		$('#frmApplyNew').bootstrapValidator('resetForm', true);
		$('#loginModal').modal('hide');
		$('#AdminloginModal').modal('hide');
		$('#forgotPasswordModal').modal('hide');
		$('#registrationModal').modal('show');
		$('#registrationModal').on('shown.bs.modal', function () 
		{ 
			$('#txtFirstName').focus(); // Focusing the textbox
		})
		
	});

	$('#forgotNewUser').click(function(){ 
		refresh_captcha3();
		$('#frmApplyNew').bootstrapValidator('resetForm', true);
		$('#loginModal').modal('hide');
		$('#AdminloginModal').modal('hide');
		$('#forgotPasswordModal').modal('hide');
		$('#registrationModal').modal('show');
		$('#registrationModal').on('shown.bs.modal', function () 
		{ 
			$('#txtFirstName').focus(); // Focusing the textbox
		})
		
	});

	$('#btnChangePassword').click(function(){ 
		if($("#txtOTPfp").val() == '')
		{
			$('#frmForgotPassword').data('bootstrapValidator').updateStatus('txtOTPfp', 'NOT_VALIDATED', null).validateField('txtOTPfp');
			$('#frmForgotPassword').focus(); // Focusing the textbox
		}
		else
		{
			var institutedata =
			{
				txtOTP:$('#txtOTPfp').val()
			};		
			$.ajax({
				url:base_url+"ajax_controller/check_forgot_password_otp",
				type:"post",
				data:institutedata,
				success:function(response){  
					
					var res1 = JSON.parse(response);
					if(res1.status == "SUCCESS")
					{
						$('#loginModal').modal('hide');
						$('#AdminloginModal').modal('hide');
						$('#forgotPasswordModal').modal('hide');
						$('#registrationModal').modal('hide');
						$('#newPasswordModal').modal('show');
						refresh_captcha6();
						$("#newPassword").show();		
						var phone_no = $("#txtForgotCandidatePhone").val();
						var mail_id = $("#txtForgotEmail").val();
						$('#hidRegUserId').val(phone_no);					
						$('#hidMailId').val(mail_id);	
						
					}
					else
					{
						toastr.error(res1.msg);
						$("#txtOTPfp").val('');
						$('#frmForgotPassword').data('bootstrapValidator').updateStatus('txtOTPfp', 'NOT_VALIDATED', null).validateField('txtOTPfp');
						
					}
					
				},
				error:function(){
					toastr.error("We are unable to Process.Please contact Support");
				}
			});
		}
		
	});
	$('#loginForgotPassword').click(function(){ 
		refresh_captcha5();
		$('#frmForgotPassword').bootstrapValidator('resetForm', true);
		$('#loginModal').modal('hide');
		$("#newPassword").hide();
		$('#AdminloginModal').modal('hide');
		$('#registrationModal').modal('hide');
		$('#forgotPasswordModal').modal('show');
		$('#forgotPasswordModal').on('shown.bs.modal', function () 
		{ 
			$('#txtForgotCandidatePhone').focus(); // Focusing the textbox
		})
		
	});

	$('#btnChangePwd').click(function(){ 
		var errorMessage = "";
		var message='<div>';
		if($("#txtPassword2").val() == '')
		{
			$('#frmNewPassword').data('bootstrapValidator').updateStatus('txtPassword2', 'NOT_VALIDATED', null).validateField('txtPassword2');
			$('#frmNewPassword').data('bootstrapValidator').updateStatus('txtConfirmPassword2', 'NOT_VALIDATED', null).validateField('txtConfirmPassword2');
			$('#frmNewPassword').data('bootstrapValidator').updateStatus('txtCaptcha6', 'NOT_VALIDATED', null).validateField('txtCaptcha6');
			//toastr.error("Please enter username and password");
			$("#txtPassword2").focus();
			return false;
		}
		if($("#txtConfirmPassword2").val() == '')
		{
			$('#frmNewPassword').data('bootstrapValidator').updateStatus('txtPassword2', 'NOT_VALIDATED', null).validateField('txtPassword2');
			$('#frmNewPassword').data('bootstrapValidator').updateStatus('txtConfirmPassword2', 'NOT_VALIDATED', null).validateField('txtConfirmPassword2');
			$('#frmNewPassword').data('bootstrapValidator').updateStatus('txtCaptcha6', 'NOT_VALIDATED', null).validateField('txtCaptcha6');
			//toastr.error("Please enter username and password");
			$("#txtConfirmPassword2").focus();
			return false;
		}
		if($("#txtCaptcha6").val() == '')
		{
			$('#frmNewPassword').data('bootstrapValidator').updateStatus('txtPassword2', 'NOT_VALIDATED', null).validateField('txtPassword2');
			$('#frmNewPassword').data('bootstrapValidator').updateStatus('txtConfirmPassword2', 'NOT_VALIDATED', null).validateField('txtConfirmPassword2');
			$('#frmNewPassword').data('bootstrapValidator').updateStatus('txtCaptcha6', 'NOT_VALIDATED', null).validateField('txtCaptcha6');
			//toastr.error("Please enter username and password");
			$("#txtCaptcha6").focus();
			return false;
		}
		
		
		var reg_user_id = document.getElementById("hidRegUserId").value; 
		var txtNewPassword1 = document.getElementById("txtPassword2").value; 
		var encSaltSHAPassMobile = encryptShaPassCode(reg_user_id,txtNewPassword1);
		$('#txtPassword2').val(encSaltSHAPassMobile);
		$('#txtConfirmPassword2').val(encSaltSHAPassMobile);
		
		return true;
		
	});
	/*var cmbState = "<?=$cmbState?>";
	$.ajax({
		url:base_url+"ajax_controller/select_state_details",
		type:"post",
		//data:institutedata,
		success:function(response){  
			var options = "<option value =''>Select State</option>";
			var res1 = JSON.parse(response);
			
			//alert(res1[0].state_code);
			for( i = 0;i< res1.length ;i++){
				if(res1[i].state_code == cmbState){
							selected='selected';
						}else{
							selected='';
						}
				options = options + "<option value="+res1[i].state_code+" "+selected+">"+res1[i].state_name+"</option>";
			}
			$('#cmbState').html("");   //campusid from academicPeriod
			$('#cmbState').append(options);
			
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});*/
	// Login Captcha
	$.ajax({
	  url:base_url+"ajax_controller/create_captcha",
	  type:"post",
	  success:function(response){ 
	   var value = 'hello';
	   refresh = base_url + 'public/assets/images/refresh.png';
	   var res = response + '&nbsp;<a href="javascript:void(0);" class="refreshCaptcha4" onclick="refresh_captcha4()"  id="refreshCaptcha4" ><img src="'+refresh+'"/></a>';
	   $("#captImg4").html(res); 
	   //$("#captImg1").html(res); 
	  },
	  error:function(){
	   toastr.error("We are unable to Process.Please contact Support");
	  }
	});
	function refresh_captcha4()
	{
	   $.get(base_url+'ajax_controller/refresh_captcha', function(data){
	   refresh = base_url + 'public/assets/images/refresh.png';
	   var data = data + '&nbsp;<a href="javascript:void(0);" class="refreshCaptcha4" onclick="refresh_captcha4()"  id="refreshCaptcha4" ><img src="'+refresh+'"/></a>';
	   	$("#captImg4").html(data);
	   });
	   	$("#txtCaptcha").val('');
	   $('#frm_login').bootstrapValidator('updateStatus', 'txtCaptcha', 'NOT_VALIDATED').bootstrapValidator('validateField', 'txtCaptcha');
	   }
	// Registration Captcha
	$.ajax({
	  url:base_url+"ajax_controller/create_captcha",
	  type:"post",
	  success:function(response){ 
	   var value = 'hello';
	   refresh = base_url + 'public/assets/images/refresh.png';
	   var res = response + '&nbsp;<a href="javascript:void(0);" class="refreshCaptcha3" onclick="refresh_captcha3()"  id="refreshCaptcha3" ><img src="'+refresh+'"/></a>';
	   $("#captImg3").html(res); 
	   //$("#captImg1").html(res); 
	  },
	  error:function(){
	   toastr.error("We are unable to Process.Please contact Support");
	  }
	});
	function refresh_captcha3()
	{
	   $.get(base_url+'ajax_controller/refresh_captcha', function(data){
	   refresh = base_url + 'public/assets/images/refresh.png';
	   var data = data + '&nbsp;<a href="javascript:void(0);" class="refreshCaptcha3" onclick="refresh_captcha3()"  id="refreshCaptcha3" ><img src="'+refresh+'"/></a>';
	   	$("#captImg3").html(data);
	   });
	   $("#txtCaptcha1").val('');
	   $('#frmApplyNew').bootstrapValidator('updateStatus', 'txtCaptcha1', 'NOT_VALIDATED').bootstrapValidator('validateField', 'txtCaptcha1');
	   //$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtCaptcha1', 'NOT_VALIDATED', null).validateField('txtCaptcha1');
	}

	// Forgot Password Captcha
	$.ajax({
	  url:base_url+"ajax_controller/create_captcha",
	  type:"post",
	  success:function(response){ 
	   var value = 'hello';
	   refresh = base_url + 'public/assets/images/refresh.png';
	   var res = response + '&nbsp;<a href="javascript:void(0);" class="refreshCaptcha5" onclick="refresh_captcha5()"  id="refreshCaptcha5" ><img src="'+refresh+'"/></a>';
	   $("#captImg5").html(res); 
	   //$("#captImg1").html(res); 
	  },
	  error:function(){
	   toastr.error("We are unable to Process.Please contact Support");
	  }
	});
	function refresh_captcha5()
	{
	   $.get(base_url+'ajax_controller/refresh_captcha', function(data){
	   refresh = base_url + 'public/assets/images/refresh.png';
	   var data = data + '&nbsp;<a href="javascript:void(0);" class="refreshCaptcha5" onclick="refresh_captcha5()"  id="refreshCaptcha5" ><img src="'+refresh+'"/></a>';
	   	$("#captImg5").html(data);
	   });
	   $("#txtCaptcha5").val('');
	   $('#frmForgotPassword').data('bootstrapValidator').updateStatus('txtCaptcha5', 'NOT_VALIDATED', null).validateField('txtCaptcha5');
	}
	
	// New Password Captcha
	$.ajax({
	  url:base_url+"ajax_controller/create_captcha",
	  type:"post",
	  success:function(response){ 
	   var value = 'hello';
	   refresh = base_url + 'public/assets/images/refresh.png';
	   var res = response + '&nbsp;<a href="javascript:void(0);" class="refreshCaptcha6" onclick="refresh_captcha6()"  id="refreshCaptcha6" ><img src="'+refresh+'"/></a>';
	   $("#captImg6").html(res); 
	   //$("#captImg1").html(res); 
	  },
	  error:function(){
	   toastr.error("We are unable to Process.Please contact Support");
	  }
	});
	function refresh_captcha6()
	{
	   $.get(base_url+'ajax_controller/refresh_captcha', function(data){
	   refresh = base_url + 'public/assets/images/refresh.png';
	   var data = data + '&nbsp;<a href="javascript:void(0);" class="refreshCaptcha6" onclick="refresh_captcha6()"  id="refreshCaptcha6" ><img src="'+refresh+'"/></a>';
	   	$("#captImg6").html(data);
	   });
	   $("#txtCaptcha6").val('');
	   $('#frmNewPassword').data('bootstrapValidator').updateStatus('txtCaptcha6', 'NOT_VALIDATED', null).validateField('txtCaptcha6');
	}
	
	$('input[type="checkbox"]').on('change', function(e){
   		if(e.target.checked){
    		$('#chkbox').modal();
   		}
	});
	function validate_forgot_password(){
		
		if((document.getElementById('txtForgotCandidatePhone').value == '' || document.getElementById('txtForgotCandidatePhone').value == null) && (document.getElementById('txtForgotEmail').value == '' || document.getElementById('txtForgotEmail').value == null))
		{
			toastr.error("Mobile No Or Email Id One of Them is Required");
			return false;
		}
		return true;
	}
	function validate(){
		var errorMessage = "";
		var message='<div>';
		if($("#txtFirstName").val() == '')
		{
			$('#frmApply').data('bootstrapValidator').updateStatus('txtFirstName', 'NOT_VALIDATED', null).validateField('txtFirstName');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtLastName', 'NOT_VALIDATED', null).validateField('txtLastName');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtdob1', 'NOT_VALIDATED', null).validateField('txtdob1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtCandidatePhone1', 'NOT_VALIDATED', null).validateField('txtCandidatePhone1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtEmail', 'NOT_VALIDATED', null).validateField('txtEmail');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtPassword1', 'NOT_VALIDATED', null).validateField('txtPassword1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtConfirmPassword', 'NOT_VALIDATED', null).validateField('txtConfirmPassword');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtCaptcha1', 'NOT_VALIDATED', null).validateField('txtCaptcha1');
			//toastr.error("Please enter username and password");
			$("#txtFirstName").focus();
			return false;
		}
		if($("#txtLastName").val() == '')
		{
			$('#frmApply').data('bootstrapValidator').updateStatus('txtFirstName', 'NOT_VALIDATED', null).validateField('txtFirstName');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtLastName', 'NOT_VALIDATED', null).validateField('txtLastName');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtdob1', 'NOT_VALIDATED', null).validateField('txtdob1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtCandidatePhone1', 'NOT_VALIDATED', null).validateField('txtCandidatePhone1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtEmail', 'NOT_VALIDATED', null).validateField('txtEmail');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtPassword1', 'NOT_VALIDATED', null).validateField('txtPassword1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtConfirmPassword', 'NOT_VALIDATED', null).validateField('txtConfirmPassword');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtCaptcha1', 'NOT_VALIDATED', null).validateField('txtCaptcha1');
			//toastr.error("Please enter username and password");
			$("#txtLastName").focus();
			return false;
		}
		if($("#txtdob1").val() == '')
		{
			$('#frmApply').data('bootstrapValidator').updateStatus('txtFirstName', 'NOT_VALIDATED', null).validateField('txtFirstName');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtLastName', 'NOT_VALIDATED', null).validateField('txtLastName');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtdob1', 'NOT_VALIDATED', null).validateField('txtdob1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtCandidatePhone1', 'NOT_VALIDATED', null).validateField('txtCandidatePhone1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtEmail', 'NOT_VALIDATED', null).validateField('txtEmail');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtPassword1', 'NOT_VALIDATED', null).validateField('txtPassword1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtConfirmPassword', 'NOT_VALIDATED', null).validateField('txtConfirmPassword');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtCaptcha1', 'NOT_VALIDATED', null).validateField('txtCaptcha1');
			//toastr.error("Please enter username and password");
			$("#txtdob1").focus();
			return false;
		}
		
		if($("#txtCandidatePhone1").val() == '')
		{
			$('#frmApply').data('bootstrapValidator').updateStatus('txtFirstName', 'NOT_VALIDATED', null).validateField('txtFirstName');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtLastName', 'NOT_VALIDATED', null).validateField('txtLastName');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtdob1', 'NOT_VALIDATED', null).validateField('txtdob1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtCandidatePhone1', 'NOT_VALIDATED', null).validateField('txtCandidatePhone1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtEmail', 'NOT_VALIDATED', null).validateField('txtEmail');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtPassword1', 'NOT_VALIDATED', null).validateField('txtPassword1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtConfirmPassword', 'NOT_VALIDATED', null).validateField('txtConfirmPassword');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtCaptcha1', 'NOT_VALIDATED', null).validateField('txtCaptcha1');
			//toastr.error("Please enter username and password");
			$("#txtCandidatePhone1").focus();
			return false;
		}
		
		if($("#txtEmail").val() == '')
		{
			$('#frmApply').data('bootstrapValidator').updateStatus('txtFirstName', 'NOT_VALIDATED', null).validateField('txtFirstName');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtLastName', 'NOT_VALIDATED', null).validateField('txtLastName');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtdob1', 'NOT_VALIDATED', null).validateField('txtdob1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtCandidatePhone1', 'NOT_VALIDATED', null).validateField('txtCandidatePhone1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtEmail', 'NOT_VALIDATED', null).validateField('txtEmail');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtPassword1', 'NOT_VALIDATED', null).validateField('txtPassword1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtConfirmPassword', 'NOT_VALIDATED', null).validateField('txtConfirmPassword');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtCaptcha1', 'NOT_VALIDATED', null).validateField('txtCaptcha1');
			//toastr.error("Please enter username and password");
			$("#txtEmail").focus();
			return false;
		}
		
		if($("#txtPassword1").val() == '')
		{
			$('#frmApply').data('bootstrapValidator').updateStatus('txtFirstName', 'NOT_VALIDATED', null).validateField('txtFirstName');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtLastName', 'NOT_VALIDATED', null).validateField('txtLastName');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtdob1', 'NOT_VALIDATED', null).validateField('txtdob1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtCandidatePhone1', 'NOT_VALIDATED', null).validateField('txtCandidatePhone1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtEmail', 'NOT_VALIDATED', null).validateField('txtEmail');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtPassword1', 'NOT_VALIDATED', null).validateField('txtPassword1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtConfirmPassword', 'NOT_VALIDATED', null).validateField('txtConfirmPassword');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtCaptcha1', 'NOT_VALIDATED', null).validateField('txtCaptcha1');
			//toastr.error("Please enter username and password");
			$("#txtPassword1").focus();
			return false;
		}
		if($("#txtConfirmPassword").val() == '')
		{
			$('#frmApply').data('bootstrapValidator').updateStatus('txtFirstName', 'NOT_VALIDATED', null).validateField('txtFirstName');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtLastName', 'NOT_VALIDATED', null).validateField('txtLastName');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtdob1', 'NOT_VALIDATED', null).validateField('txtdob1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtCandidatePhone1', 'NOT_VALIDATED', null).validateField('txtCandidatePhone1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtEmail', 'NOT_VALIDATED', null).validateField('txtEmail');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtPassword1', 'NOT_VALIDATED', null).validateField('txtPassword1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtConfirmPassword', 'NOT_VALIDATED', null).validateField('txtConfirmPassword');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtCaptcha1', 'NOT_VALIDATED', null).validateField('txtCaptcha1');
			//toastr.error("Please enter username and password");
			$("#txtConfirmPassword").focus();
			return false;
		}
		if($("#txtCaptcha1").val() == '')
		{
			$('#frmApply').data('bootstrapValidator').updateStatus('txtFirstName', 'NOT_VALIDATED', null).validateField('txtFirstName');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtLastName', 'NOT_VALIDATED', null).validateField('txtLastName');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtdob1', 'NOT_VALIDATED', null).validateField('txtdob1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtCandidatePhone1', 'NOT_VALIDATED', null).validateField('txtCandidatePhone1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtEmail', 'NOT_VALIDATED', null).validateField('txtEmail');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtPassword1', 'NOT_VALIDATED', null).validateField('txtPassword1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtConfirmPassword', 'NOT_VALIDATED', null).validateField('txtConfirmPassword');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtCaptcha1', 'NOT_VALIDATED', null).validateField('txtCaptcha1');
			//toastr.error("Please enter username and password");
			$("#txtCaptcha1").focus();
			return false;
		}
		if($("#txtPassword1").val() != $("#txtConfirmPassword").val())
		{
			/*$("#txtPassword1").val('');*/
			$("#txtConfirmPassword").val('');
			$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtPassword1', 'NOT_VALIDATED', null).validateField('txtPassword1');
			$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtConfirmPassword', 'NOT_VALIDATED', null).validateField('txtConfirmPassword');
			
		}
		else
		{
			var reg_user_id = document.getElementById("txtCandidatePhone1").value; 
			var txtNewPassword1 = document.getElementById("txtPassword1").value; 
			var encSaltSHAPassMobile = encryptShaPassCode(reg_user_id,txtNewPassword1);
			$('#txtPassword1').val(encSaltSHAPassMobile);
			$('#txtConfirmPassword').val(encSaltSHAPassMobile);
		}
		
		return true;
			
	}
	$('#resendOTP').click(function(){ 
		var institutedata =
		{
			txtForgotCandidatePhone:$('#txtForgotCandidatePhone').val(),
			txtForgotEmail:$('#txtForgotEmail').val(),
			insCode:$('#insCode').val()
		};
		$.ajax({
			url:base_url+"Index/registration_forgot_password",
			type:"post",
			data:institutedata,
			success:function(response)
			{  
				var result = JSON.parse(response);
				if(result.status == "SUCCESS")
				{
					refresh_captcha6();
					$("#newPassword").show();		
					var phone_no = $("#txtForgotCandidatePhone").val();
					var mail_id = $("#txtForgotEmail").val();
					$('#hidRegUserId').val(phone_no);					
					$('#hidMailId').val(mail_id);					
				}
				else 
				{
					if(result.msg == 'Invalid Captcha. Please try again.')
					{
						toastr.error(result.msg);	
						$("#txtCaptcha5").val('');
						$('#frmForgotPassword').data('bootstrapValidator').updateStatus('txtCaptcha5', 'NOT_VALIDATED', null).validateField('txtCaptcha5');
						refresh_captcha5();
						$('.loadingRPimage').fadeIn(250);
					}
					else
					{
						toastr.error(result.msg);	
						$('.loadingRPimage').fadeIn(250);
					}
					
				}
				
			},
			error:function()
			{
				toastr.error('Unable to Save.Please Try Again ');	
			}
		});
		
	});
	function login(program_code){
		$("#hidProgramCode").val(program_code);
		refresh_captcha4();
		$('#frm_login').data('bootstrapValidator').resetForm(true);
		$('#loginModal').modal('show');
		$('#AdminloginModal').modal('hide');
		$('#registrationModal').modal('hide');
		$('#forgotPasswordModal').modal('hide');
		$('#loginModal').on('shown.bs.modal', function () 
		{ 
			$('#txtCandidatePhone').focus(); // Focusing the textbox
		})
	}
	$(document).ready(function() {
		$("#txtFirstName").focus();
		function blink_text() {
		    $('.blink').fadeOut(500);
		    $('.blink').fadeIn(500);
		}
		setInterval(blink_text, 4500);

		$('[data-toggle="tooltip"]').tooltip(); //for tooltip
		// for disable write click and copy past  code start
			
		$(document).bind("contextmenu",function(e){
		   return false;
		});
		$('body').bind('cut copy paste', function (e) {
	        e.preventDefault();
	    });
		
		
		$('#frmForgotPassword').bootstrapValidator({
	        message: 'This value is not valid',
			submitButtons: 'button[type="submit"]',
			submitHandler: function(validator, form, submitButton) 
			{
				var formData = new FormData(document.getElementById("frmForgotPassword"));
				var insEncCode = $("#insEncCode").val();
				$.ajax({
					url:base_url+"Index/registration_forgot_password",
					type:"post",
					data:formData,
					cache: false,
			        contentType: false,
			        processData: false,
					success:function(response)
					{  
						var result = JSON.parse(response);
						if(result.status == "SUCCESS")
						{
							refresh_captcha6();
							swal({
								title: "OTP",
								text: "Please check your Mail id or Mobile for OTP. To change your password OTP is mandatory",
								//type: "success"
								},
								function(isConfirm) {
								  if (isConfirm) {
								    $("#newPassword").show();
								  }
								});
									
							var phone_no = $("#txtForgotCandidatePhone").val();
							var mail_id = $("#txtForgotEmail").val();
							$('#hidRegUserId').val(phone_no);					
							$('#hidMailId').val(mail_id);					
						}
						else 
						{
							if(result.msg == 'Invalid Captcha. Please try again.')
							{
								toastr.error(result.msg);	
								$("#txtCaptcha5").val('');
								$('#frmForgotPassword').data('bootstrapValidator').updateStatus('txtCaptcha5', 'NOT_VALIDATED', null).validateField('txtCaptcha5');
								refresh_captcha5();
								$('.loadingRPimage').fadeIn(250);
							}
							else
							{
								toastr.error(result.msg);	
								$('.loadingRPimage').fadeIn(250);
							}
							
						}
						
					},
					error:function()
					{
						toastr.error('Unable to Save.Please Try Again ');	
					}
				});
			},
	        fields: {
	        
				txtForgotCandidatePhone: {
	                validators: {
	                	/*notEmpty: {
	                        message: 'Please Enter Mobile No'
	                    },*/
	                    integer:{
							message:'Only numbers are allowed'
						}, 
						stringLength: {
							max: 10,
							min: 10,
							message: 'Mobile no must be 10 characters'
						}
	                }
	            },
				txtForgotEmail: {
	                validators: {
	                   
						emailAddress: {
	                        message: 'The value is not a valid email address'
	                    }
	                }
	            },
				txtCaptcha5: {
	                validators: {
	                    notEmpty: {
	                        message: 'Please Enter Captcha'
	                    },
	                    
						regexp: {
	                        regexp: /^([A-Za-z0-9]+)$/,
	                        message: "Special characters are not allowed"
						}, 
						stringLength: {
							max: 6,
							min: 6,
							message: 'Captcha must be 6 characters'
						}
	                }
	            },
				txtOTP: {
	                validators: {
	                    notEmpty: {
	                        message: 'Please Enter OTP'
	                    },
	                    integer:{
							message:'Only numbers are allowed'
						}, 
						stringLength: {
							max: 4,
							min: 4,
							message: 'OTP must be 4 characters'
						}
	                }
	            }
			}	
      	});	
		$('#frmNewPassword').bootstrapValidator({
	        message: 'This value is not valid',
			submitButtons: 'button[type="submit"]',
			submitHandler: function(validator, form, submitButton) 
			{
				var formData = new FormData(document.getElementById("frmNewPassword"));
				
				$.ajax({
					url:base_url+"Index/registration_new_password",
					type:"post",
					data:formData,
					cache: false,
			        contentType: false,
			        processData: false,
					success:function(response)
					{  
						var result = JSON.parse(response);
						if(result.status == "SUCCESS")
						{
							swal({
								title: "Password",
								text: "Congratulation!!! Your password has been changed successfully.",
								//type: "success"
							},
							function(isConfirm) {
							  if (isConfirm) {
							   $('#newPasswordModal').modal('hide');
							    location.reload();
							   /*$('#loginModal').modal('show');
							    refresh_captcha4();*/
							  return false;
							  } 
							});
							
						}
						else 
						{
							if(result.status == 'captchaerror')
							{
								toastr.error(result.msg);	
								$("#txtPassword2").val('');
								$("#txtConfirmPassword2").val('');
								$("#txtCaptcha6").val('');
								$('#frmNewPassword').data('bootstrapValidator').updateStatus('txtPassword2', 'NOT_VALIDATED', null).validateField('txtPassword2');
								$('#frmNewPassword').data('bootstrapValidator').updateStatus('txtConfirmPassword2', 'NOT_VALIDATED', null).validateField('txtConfirmPassword2');
								$('#frmNewPassword').data('bootstrapValidator').updateStatus('txtCaptcha6', 'NOT_VALIDATED', null).validateField('txtCaptcha6');
								refresh_captcha6();
								$('.loadingRPimage').fadeIn(250);
							}
							else
							{
								toastr.error(result.msg);	
								$("#txtPassword2").val('');
								$("#txtConfirmPassword2").val('');
								$('#frmNewPassword').data('bootstrapValidator').updateStatus('txtPassword2', 'NOT_VALIDATED', null).validateField('txtPassword2');
								$('#frmNewPassword').data('bootstrapValidator').updateStatus('txtConfirmPassword2', 'NOT_VALIDATED', null).validateField('txtConfirmPassword2');
								$('.loadingRPimage').fadeIn(250);
							}
						}
						
					},
					error:function()
					{
						toastr.error('Unable to Save.Please Try Again ');	
					}
				});
			},
	        fields: {
				txtPassword2: {
					validators: {
						notEmpty: {
							message: 'This field can\'t left blank'
						},
	            		regexp: {
							regexp: /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[$@!%?&]).{6,12}$/,
							message: "The password should contain Minimum 6 and Maximum 12 characters at least 1 Uppercase Alphabet, 1 Lowercase Alphabet, 1 Number and 1 Special Character:"
						}/*,
						identical: {
		                    field: 'txtConfirmPassword2',
		                    message: 'New password and its confirm are not the same'
	                	}*/
					}
				},
				txtConfirmPassword2: {
					validators: {
						notEmpty: {
							message: 'This field can\'t left blank'
						},
						identical: {
		                    field: 'txtPassword2',
		                    message: 'New password and its confirm are not the same'
	                	}
					}
				},
				txtCaptcha6: {
	                validators: {
	                	notEmpty: {
	                        message: "Please Enter Captcha"
						},
	                    
						regexp: {
	                        regexp: /^([A-Za-z0-9]+)$/,
	                        message: "Special characters are not allowed"
						}, 
						stringLength: {
							max: 6,
							min: 6,
							message: 'Captcha must be 6 characters'
						}
	                }
	            }	
			}
		});
		$("#txtPassword2").change(function(){
			$('#frmNewPassword').data('bootstrapValidator').updateStatus('txtConfirmPassword2', 'NOT_VALIDATED', null).validateField('txtConfirmPassword2');	
		});
		$('#frm_login').bootstrapValidator({
	        message: 'This value is not valid',
	       /* feedbackIcons: {
	            valid: 'glyphicon glyphicon-ok',
	            invalid: 'glyphicon glyphicon-remove',
	            validating: 'glyphicon glyphicon-refresh'
	        },*/
			submitButtons: 'button[type="submit"]',
			submitHandler: function(validator, form, submitButton) 
			{
				
				if((document.getElementById('txtCandidatePhone').value == '' || document.getElementById('txtCandidatePhone').value == null) && (document.getElementById('txtEmailId').value == '' || document.getElementById('txtEmailId').value == null))
				{
					toastr.error("Mobile No Or Email Id One of Them is Required");
				}
				else
				{	
					document.getElementById('txtPwd').type="password";
					var formData = new FormData(document.getElementById("frm_login"));
					var insEncCode = $("#insEncCode").val();
					$.ajax({
						url:base_url+"Index/registration_login",
						type:"post",
						data:formData,
						cache: false,
				        contentType: false,
				        processData: false,
						success:function(response)
						{  
							var result = JSON.parse(response);
							if(result.status == "SUCCESS")
							{ 
								var program_code = $("#hidProgramCode").val();
								if(program_code == '')
								{ //alert(result.enc_ins);
									window.open(base_url+"apply/institute_page/ins/"+result.enc_ins,"_self");
								} 
								else
								{ 
									window.open(base_url+"apply/institute_page/ins/"+result.enc_ins+"/program_code/"+program_code,"_self");
								}
							}
							else 
							{
								if(result.msg == 'Invalid Captcha. Please try again.')
								{
									toastr.error(result.msg);	
									$("#txtPwd").val('');
									$("#txtCaptcha").val('');
									$('#frm_login').data('bootstrapValidator').updateStatus('txtPwd', 'NOT_VALIDATED', null).validateField('txtPwd');
									$('#frm_login').data('bootstrapValidator').updateStatus('txtCaptcha', 'NOT_VALIDATED', null).validateField('txtCaptcha');
									refresh_captcha4();
									$('.loadingRPimage').fadeIn(250);
								}
								else
								{
									toastr.error(result.msg);	
									$("#txtPwd").val('');
									$("#txtCaptcha").val('');
									$('#frm_login').data('bootstrapValidator').updateStatus('txtPwd', 'NOT_VALIDATED', null).validateField('txtPwd');
									$('#frm_login').data('bootstrapValidator').updateStatus('txtCaptcha', 'NOT_VALIDATED', null).validateField('txtCaptcha');
									refresh_captcha4();
									enable_logout(result.logoutopt);
									//$('.loadingRPimage').fadeIn(250);
								}
								
							}
							
						},
						error:function()
						{
							toastr.error('Unable to Save.Please Try Again ');	
						}
					});
				}	
			},
	        fields: {
					txtCandidatePhone: {
	                validators: {
	                    integer:{
							message:'Only numbers are allowed'
						}, 
						stringLength: {
							max: 11,
							min: 10,
							message: 'Mobile no must be 10 characters'
						}
	                }
	            },	
	            
				txtEmailId: {
	                validators: {
	                   
						emailAddress: {
	                        message: 'The value is not a valid email address'
	                    }
	                }
	            },	
				txtPwd: {
	                validators: {
	                    notEmpty: {
	                        message: 'Required'
	                    }
	                }
	            },
				txtCaptcha: {
	                validators: {
	                    notEmpty: {
	                        message: 'Please Enter Captcha'
	                    }
	                }
	            }
			}	
      	});	
      	$('#resendOtpReg').click(function(){ 
			var institutedata =
			{
				txtMobileNo:$('#txtMobileNo').val(),
				txtEmail:$('#txtEmail').val(),
				hidInstitute:$('#hidInstitute').val(),
				txtFirstName:$('#txtFirstName').val(),
				txtMiddleName:$('#txtMiddleName').val(),
				txtLastName:$('#txtLastName').val()
			};
			$.ajax({
				url:base_url+"ajax_controller/send_pro_otp",
				type:"post",
				data:institutedata,
				success:function(response)
				{  
					var obj = jQuery.parseJSON(response);
						
					if(obj.status == true)
					{
						var otp = obj.otp;
						$("#hidOTP").val(otp);
			 			$('#OTPForm').data('bootstrapValidator').resetForm(true);
					}
					else
					{
						
						if(obj.status == 'captchaerror')
						{
							$("#txtPassword1").val('');
							$("#txtConfirmPassword").val('');
							$("#txtCaptcha1").val('');
							$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtPassword1', 'NOT_VALIDATED', null).validateField('txtPassword1');
							$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtConfirmPassword', 'NOT_VALIDATED', null).validateField('txtConfirmPassword');
							$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtCaptcha1', 'NOT_VALIDATED', null).validateField('txtCaptcha1');
							toastr.error(obj.msg);
						}
						else
						{
							toastr.error(obj.msg);
						}
					}
				},
				error:function()
				{
					toastr.error('Unable to Save.Please Try Again ');	
				}
			});
			
		});
	
      	$('#OTPForm').bootstrapValidator({
	        message: 'This value is not valid',
	        submitButtons: 'button[type="submit"]',
			submitHandler: function(validator, form, submitButton) 
			{
				var formData = $('#frmApplyNew, #OTPForm').serialize();
				//ajax call to server
				$.ajax({
					url:base_url+"ajax_controller/check_otp_data",
					type:"post",
					data:formData,
					success:function(response)
					{  
						var obj = jQuery.parseJSON(response);
						if(obj.status == true)
						{
							//alert("hello");
							
							var formData = new FormData(document.getElementById("frmApplyNew"));
							//alert(formData);return;
							$("#modalOtp").modal('hide');
							$.ajax({
								url:base_url+"Index/registration",
								type:"post",
								data:formData, 
								cache: false,
						        contentType: false,
						        processData: false,
								success:function(response)
								{  
									var result = JSON.parse(response);
									if(result.status == "SUCCESS")
									{
										swal({
											title: "Registration",
											text: "Congratulation!!! Your registration successfully completed. Please check your mail or sms for details.",
											//type: "success"
										},
										function(isConfirm) { 
										  if (isConfirm) {
										   $('#registrationModal').modal('hide');
										   $('#frm_login').bootstrapValidator('resetForm', true);
										   refresh_captcha4();
										   //setTimeout(function() { $('#registrationModal').modal('hide'); }, 2000);
										   $('#loginModal').modal('show')
										   //setTimeout(function() { $('#loginModal').modal('show')}, 2000);
										  }
										});
										
									}
									else 
									{
										if(result.status == 'captchaerror')
										{
											toastr.error(result.msg);	
											$("#txtCaptcha1").val('');
											$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtCaptcha1', 'NOT_VALIDATED', null).validateField('txtCaptcha1');
											refresh_captcha3();
											$('.loadingRPimage').fadeIn(250);
										}
										else if(result.status == 'ERROR')
										{
											toastr.error(result.msg);	
											$("#txtPassword1").val('');
											$("#txtConfirmPassword").val('');
											$("#txtCandidatePhone1").val('');
											$("#txtCaptcha1").val('');
											refresh_captcha3();
											$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtCandidatePhone1', 'NOT_VALIDATED', null).validateField('txtCandidatePhone1');
											$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtPassword1', 'NOT_VALIDATED', null).validateField('txtPassword1');
											$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtConfirmPassword', 'NOT_VALIDATED', null).validateField('txtConfirmPassword');
											$('.loadingRPimage').fadeIn(250);
											
										}
										else
										{
											toastr.error(result.msg);	
											$("#txtPassword1").val('');
											$("#txtConfirmPassword").val('');
											$("#txtEmail").val('');
											$("#txtCaptcha1").val('');
											refresh_captcha3();
											$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtEmail', 'NOT_VALIDATED', null).validateField('txtEmail');
											$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtPassword1', 'NOT_VALIDATED', null).validateField('txtPassword1');
											$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtConfirmPassword', 'NOT_VALIDATED', null).validateField('txtConfirmPassword');
											$('.loadingRPimage').fadeIn(250);
										}
									}
									
								},
								error:function()
								{
									toastr.error('Unable to Save.Please Try Again ');	
								}
							});
						}
						else
						{
							toastr.error(obj.msg);
						}
						
					},
					error:function()
					{
						toastr.error('Unable to Save.Please Try Again ');	
					}
				});
			},
			fields: { 
				txtOTP: {
	                validators: {
	                	notEmpty: {
	                        message: 'Please Enter First Name'
	                    }, 
						stringLength: {
							min: 4,
							max: 4,
							message: 'OTP Should be 4 character'
						}
	                }
	            }
	        }
	    });
	
		$('#frmApplyNew').bootstrapValidator({
	        message: 'This value is not valid',
	        /*feedbackIcons: {
	            valid: 'glyphicon glyphicon-ok',
	            invalid: 'glyphicon glyphicon-remove',
	            validating: 'glyphicon glyphicon-refresh'
	        },*/
			submitButtons: 'button[type="submit"]',
			submitHandler: function(validator, form, submitButton) 
			{
				document.getElementById('txtPassword1').type="password";
				var formData = new FormData(document.getElementById("frmApplyNew"));
				//alert(formData);
				$.ajax({
					url:base_url+"ajax_controller/send_pro_otp",
					type:"post", 
					data:formData,
					cache: false,
			        contentType: false,
			        processData: false,
					success:function(response)
					{  
						var obj = jQuery.parseJSON(response);
						
						if(obj.status == true)
						{
							var otp = obj.otp;
							$("#hidOTP").val(otp);
				 			$('#OTPForm').data('bootstrapValidator').resetForm(true);
							$("#modalOtp").modal('show');
						}
						else
						{
							
							if(obj.status == 'captchaerror')
							{
								$("#txtPassword1").val('');
								$("#txtConfirmPassword").val('');
								$("#txtCaptcha1").val('');
								$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtPassword1', 'NOT_VALIDATED', null).validateField('txtPassword1');
								$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtConfirmPassword', 'NOT_VALIDATED', null).validateField('txtConfirmPassword');
								$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtCaptcha1', 'NOT_VALIDATED', null).validateField('txtCaptcha1');
								toastr.error(obj.msg);
							}
							else
							{
								toastr.error(obj.msg);
							}
						}
						
					},
					error:function()
					{
						toastr.error('Unable to Save.Please Try Again ');	
					}
				});
			},
	        fields: {
				txtFirstName: {
	                validators: {
	                	notEmpty: {
	                        message: "Please Enter First Name"
						},
						regexp: {
	                        regexp: /^([A-Za-z ]+)$/,
	                        message: "Special characters and Numbers are not allowed"
						}, 
						stringLength: {
							max: 50,
							min: 1,
							message: 'First name must be 1 to 50 characters'
						}
	                }
	            },
				txtMiddleName: {
	                validators: {
	                    regexp: {
	                        regexp: /^([A-Za-z ]+)$/,
	                        message: "Special characters and Numbers are not allowed"
						}, 
						stringLength: {
							max: 50,
							min: 0,
							message: 'Middle name must be 0 to 50 characters'
						}
	                }
	            },
				txtLastName: {
	                validators: {
	                	notEmpty: {
	                        message: "Please Enter Last Name"
						},
						regexp: {
	                        regexp: /^([A-Za-z ]+)$/,
	                        message: "Special characters and Numbers are not allowed"
						}, 
						stringLength: {
							max: 50, 
							min: 1,
							message: 'Last name must be 1 to 50 characters'
						}
	                }
	            },
				agree: {
	                validators: {
						notEmpty: {
	                        message: "Please check the term and condition"
						}
	                }
	            },
				txtdob1: {
	                validators: {
						notEmpty: {
	                        message: "Please Enter Date of Birth"
						}
	                }
	            },
	            
				txtCandidatePhone1: {
	                validators: {
	                	notEmpty: {
	                        message: "Please Enter Mobile No"
						},
						integer: {
								message: 'The value can contain only numbers'
							}, 
						stringLength: {
							max: 10,
							min: 10,
							message: 'Phone no must be 10 characters'
						}
					}
				},
	            txtEmail: {
	                validators: {
	                	notEmpty: {
	                        message: "Please Enter Email"
						},
						emailAddress: {
	                        message: 'The value is not a valid email address'
	                    }
	                }
	            },
	            
				txtPassword1: {
					validators: {
						notEmpty: {
							message: 'This field can\'t left blank'
						},
	            		regexp: {
							regexp: /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[$@!%?&]).{6,12}$/,
							message: "The password should contain Minimum 6 and Maximum 12 characters at least 1 Uppercase Alphabet, 1 Lowercase Alphabet, 1 Number and 1 Special Character:"
						}/*,
						identical: {
		                    field: 'txtConfirmPassword',
		                    message: 'New password and its confirm are not the same'
	                	}*/
					}
				},
				txtConfirmPassword: {
					validators: {
						notEmpty: {
							message: 'This field can\'t left blank'
						},
						identical: {
		                    field: 'txtPassword1',
		                    message: 'New password and its confirm are not the same'
	                	}
					}
				},
				txtCaptcha1: {
	                validators: {
	                	notEmpty: {
	                        message: "Please Enter Captcha"
						},
	                    
						regexp: {
	                        regexp: /^([A-Za-z0-9]+)$/,
	                        message: "Special characters are not allowed"
						}, 
						stringLength: {
							max: 6,
							min: 6,
							message: 'Captcha must be 6 characters'
						}
	                }
	            }	/*,
	            cmbState: {
	                validators: {
	                    notEmpty: {
	                        message: 'Please Enter State'
	                    }
					}
				}*/
			}
		});
		$("#txtPassword1").change(function(){
			$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtConfirmPassword', 'NOT_VALIDATED', null).validateField('txtConfirmPassword');	
		});
		var today = new Date();
		var dd = today.getDate();
		var mm = today.getMonth()+1; //January is 0!

		var yyyy = today.getFullYear();
		if(dd<10){
		    dd='0'+dd;
		} 
		if(mm<10){
		    mm='0'+mm;
		} 
		var today = dd+'-'+mm+'-'+yyyy;
		var min_Date = '';
		var max_Date = '';
		if($('#birthStartDate').val() == '' || $('#birthStartDate').val() == null)
		{
			min_Date = '01-01-1900';
		}
		else
		{
			min_Date = $('#birthStartDate').val();
		}
		
		if($('#birthEndDate').val() == '' || $('#birthEndDate').val() == null)
		{
			max_Date = today;
		}
		else
		{
			max_Date = $('#birthEndDate').val();
		}
		$('#txtdob1').datepicker({ 
			format: 'dd-mm-yyyy',
			startDate: min_Date,
			endDate: max_Date,
			autoclose:true,
			//yearRange: '1980:2003'
		}).on('changeDate', function(e) { 
			$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtdob1', 'NOT_VALIDATED', null).validateField('txtdob1');
			//$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtdob1', 'VALID', null);
		});
		$('#txtdob').datepicker({ 
			format: 'dd-mm-yyyy',
			startDate: min_Date,
			autoclose:true,
			endDate: max_Date,
			//yearRange: '1980:2003'
		}).on('changeDate', function(e) { 
			$('#frm_login').data('bootstrapValidator').updateStatus('txtdob', 'NOT_VALIDATED', null).validateField('txtdob');
			//$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtdob1', 'VALID', null);
		});
		$("#txtCandidatePhone1").change(function(){
		
			var institutedata = {
				mobile_no : $("#txtCandidatePhone1").val()
			};
			$.ajax({
				url:base_url+"ajax_controller/check_mobile_no",
				type:"post",
				data:institutedata,
				success:function(response)
				{  
					var obj = jQuery.parseJSON(response);
					if(obj.status != true) 
					{
						$("#txtCandidatePhone1").val('');
						$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtCandidatePhone1', 'NOT_VALIDATED', null).validateField('txtCandidatePhone1');
						$("#txtCandidatePhone1").focus();
						toastr.error(obj.msg);
					}
					
				},
				error:function()
				{
					toastr.error('Unable to Save.Please Try Again ');	
				}
			});
		});
		$("#txtEmail").change(function(){
			var institutedata = {
				email_id : $("#txtEmail").val()
			};
			$.ajax({
				url:base_url+"ajax_controller/check_email_id",
				type:"post",
				data:institutedata,
				success:function(response)
				{  
					var obj = jQuery.parseJSON(response);
					if(obj.status != true)
					{
						$("#txtEmail").val('');
						$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtEmail', 'NOT_VALIDATED', null).validateField('txtEmail');
						$("#txtEmail").focus();
						toastr.error(obj.msg);
					}
					
				},
				error:function()
				{
					toastr.error('Unable to Save.Please Try Again ');	
				}
			});
		});
		//$('#txtdob1').datepick({yearRange: '1980:2003'}); 
    
	
		//$('#txtdob1').datepick({yearRange: '1980:2003'}); 
    });
	
	
</script>	
	
	
	
	 
	
	
	
	
	
	
	
	
	
	
	
	