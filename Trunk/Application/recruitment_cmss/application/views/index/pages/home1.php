<style type="text/css">
	
	li{
		border-bottom: 1px dotted #1D5286;
		padding: 10px;
	  }
</style>
<link href="<?php echo base_url(); ?>public/assets/css/style.css" rel="stylesheet"> 
<section style="background: url(upload/image/svnirtar_bacakground.jpg) repeat; padding-top: 15px; padding-bottom: 15px;">
<div class="container-fluid">
  <div class="row">
   <div class="container">

  <div class="col-sm-3">
    <div class="col-sm-12" style="background: #fff; padding: 0;">
      <p align="center" style="border-bottom: 1px solid #DD362F; font-size: 16px; color: #202020; padding: 10px 5px 5px; font-weight: bold;"> <img src="upload/image/news_icon.png"> &nbsp;Latest Informations</p>

      <ul style="padding-left: 0; text-align: left; color:#000;">

      		<?php 
				foreach($latest_info as $row)
				{
				echo "<li><span style='color: #FF5B02; font-weight: bold;'><i class='fa fa-bell-o'></i> &nbsp; &nbsp;</span><a href='#' style='cursor:pointer' onclick='viewLatestInfo(".$row['id'].")'>".$row['link_name']."</a></li>";
				} 
			?>


<!-- 
          &nbsp; Public Notice E Admit Card</li>
          <li><span style="color: #FF5B02; font-weight: bold;"><i class="fa fa-bell-o" aria-hidden="true"></i></span>&nbsp;&nbsp; Public Notice E Admit Card</li>
           <li><span style="color: #FF5B02; font-weight: bold;"><i class="fa fa-bell-o" aria-hidden="true"></i></span>&nbsp;&nbsp; Public Notice Equivalency of Question Papers</li>
            <li><span style="color: #FF5B02; font-weight: bold;"><i class="fa fa-bell-o" aria-hidden="true"></i></span>&nbsp;&nbsp; Public Notice Reporting Schedule</li>
            <li><span style="color: #FF5B02;font-weight: bold;"><i class="fa fa-bell-o" aria-hidden="true"></i></span>&nbsp;&nbsp; Corrigendum in Information Bulletin PGET</li>
            <li><span style="color: #FF5B02;  font-weight: bold;"><i class="fa fa-bell-o" aria-hidden="true"></i></span>&nbsp;&nbsp; Information Bulletin SV NIRTAR</li>
             <li><span style="color: #FF5B02; font-weight: bold;"><i class="fa fa-bell-o" aria-hidden="true"></i></span>&nbsp;&nbsp; Information Bulletin SV NIRTAR</li> -->
      </ul>
    </div>
  </div>




  <div class="col-sm-6" align="justify">
   
     <?php echo $institute[0]['institute_details'];?>
  </div>
   
 


    <div class="col-sm-3">
     
           <div class="col-sm-12" style="background: #fff; padding: 0;">
     <p align="center" style="border-bottom: 1px solid #DD362F; font-size: 16px; color: #202020; padding: 10px 5px 5px; font-weight: bold;"><span><i class="fa fa-bullhorn"></i></span> &nbsp;News &amp; Events</p>

      <ul style="padding-left: 0; text-align: left;">
     <marquee direction="up" behavior="scroll" height="168px" scrollamount="3" onmouseover="this.stop();" onmouseout="this.start();">  
     		<?php
				foreach($news_details as $row)
				{																	
				  echo "<li>".$row['news_details']."</li>";
				} 
			?>       
       </marquee>
      </ul>
    </div>


    <div class="col-sm-12" style="background: #fff; padding: 0; margin-top:25px;">
     <p align="center" style="border-bottom: 1px solid #DD362F; font-size: 16px; color: #202020; padding: 10px 5px 5px; font-weight: bold;"> <img src="upload/image/link_icon.png"> &nbsp;Quick Links</p>

      <ul style="padding-left: 0; text-align: left;">
         <li><span style="color: #FF5B02;"><i class="fa fa-hand-o-right"></i></span> &nbsp; &nbsp;<a href="http://www.svnirtar.nic.in/" target="_blank"> &nbsp; SVNIRTAR</a></li>
         <li><span style="color: #FF5B02;"><i class="fa fa-hand-o-right"></i></span> &nbsp; &nbsp;<a href="http://niohkol.nic.in/" target="_blank">&nbsp; CET-2018</a></li>          
      </ul>
    </div>

 


  </div>

 </div>

</div>
</div>

</section>

<div class="modal fade" id="date" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
    	<div class="modal-content">
    		<div class="modal-header" style="background-color: #00008B;">
    			<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;padding-left: 90%;"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title" id="myModalLabel"style="color:#E4791A;"><b> IMPORTANT DATES</b></h4>
      		</div>
      		<div class="modal-body" style="height: 490px;">
	      		<div class="col-sm-12">
	      			<div class="row">
	      				<div class="col-md-1">
	      					<span><i class="fa fa-share" aria-hidden="true" style="color:#0054ff;margin-top: 12px;margin-left: 18px;"></i></span>
	      				</div>
						<div class="col-md-6">
							<h4 align="justify" style="color: #0054ff;font-size: 14px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;"> Availability of CIPET-JEE 2018 Application Forms Can be filled on-line or downloaded form <a href="www.cipet.gov.in">www.cipet.gov.in</a></h4>
						</div>
						<div class="col-md-1">
							<h4 style="color: #0054ff;">:</h4>
						</div>
						<div class="col-md-4">
							<h4 style="color: #0054ff;padding-right:10px;padding-right:20px;    margin-left: -15px; font-size: 14px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;"><b>Last week of February 2018</b></h4>
						</div>
					</div>
					<div class="row">
	      				<div class="col-md-1">
	      					<span><i class="fa fa-share" aria-hidden="true" style="color:#0054ff;margin-top: 12px;margin-left: 18px;"></i></span>
	      				</div>
						<div class="col-md-6">
							<h4 align="justify" style="color: #0054ff;font-size: 14px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;"> Last date for issue and receipt of duly filled in Application forms</h4>
						</div>
						<div class="col-md-1">
							<h4 style="color: #0054ff;">:</h4>
						</div>
						<div class="col-md-4">
							<h4  style="color: #0054ff;padding-right:10px;    margin-left: -15px;font-size: 14px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;"><b>12<sup>th</sup> May 2018</b></h4>
						</div>
					</div>
					<div class="row">
	      				<div class="col-md-1">
	      					<span><i class="fa fa-share" aria-hidden="true" style="color:#0054ff;margin-top: 12px;margin-left: 18px;"></i></span>
	      				</div>
						<div class="col-md-6">
							<h4 align="justify" style="color: #0054ff;font-size: 14px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;"> Issue of JEE Hall Tickets(for eligible candidates) - Can be downloaded from <a href="www.cipet.gov.in">www.cipet.gov.in</a></h4>
						</div>
						<div class="col-md-1">
							<h4 style="color: #0054ff;">:</h4>
						</div>
						<div class="col-md-4">
							<h4  style="color: #0054ff;padding-right:10px;    margin-left: -15px;font-size: 14px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;"><b>Third week of May 2018</b></h4>
						</div>
					</div>
					<div class="row">
	      				<div class="col-md-1">
	      					<span><i class="fa fa-share" aria-hidden="true" style="color:#0054ff;margin-top: 12px;margin-left: 18px;"></i></span>
	      				</div>
						<div class="col-md-6">
							<h4 align="justify" style="color: #0054ff;font-size: 14px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;"> Date of Joint Entrance Examination(JEE)</h4>
						</div>
						<div class="col-md-1">
							<h4 style="color: #0054ff;">:</h4>
						</div>
						<div class="col-md-4">
							<h4  style="color: #0054ff;padding-right:10px;    margin-left: -15px;font-size: 14px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;"><b>3<sup>rd</sup> June 2018</b></h4>
						</div>
					</div>
					<div class="row">
	      				<div class="col-md-1">
	      					<span><i class="fa fa-share" aria-hidden="true" style="color:#0054ff;margin-top: 12px;margin-left: 18px;"></i></span>
	      				</div>
						<div class="col-md-6">
							<h4 align="justify" style="color: #0054ff;font-size: 14px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;"> Release of JEE Result Can be Downloaded from <a href="www.cipet.gov.in">www.cipet.gov.in</a></h4>
						</div>
						<div class="col-md-1">
							<h4 style="color: #0054ff;">:</h4>
						</div>
						<div class="col-md-4">
							<h4  style="color: #0054ff;padding-right:10px;    margin-left: -15px;font-size: 14px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;"><b>Third week of June 2018</b></h4>
						</div>
					</div>
					<div class="row">
	      				<div class="col-md-1">
	      					<span><i class="fa fa-share" aria-hidden="true" style="color:#0054ff;margin-top: 12px;margin-left: 18px;"></i></span>
	      				</div>
						<div class="col-md-6">
							<h4 align="justify" style="color: #0054ff;font-size: 14px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;"> Issue of Admission Call Letters(for selected candidates)- Can be downloaded form <a href="www.cipet.gov.in">www.cipet.gov.in</a></h4>
						</div>
						<div class="col-md-1">
							<h4 style="color: #0054ff;">:</h4>
						</div>
						<div class="col-md-4">
							<h4  style="color: #0054ff;padding-right:10px;    margin-left: -15px;font-size: 14px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;"><b>Last week of June 2018</b></h4>
						</div>
					</div>
					<div class="row">
	      				<div class="col-md-1">
	      					<span><i class="fa fa-share" aria-hidden="true" style="color:#0054ff;margin-top: 12px;margin-left: 18px;"></i></span>
	      				</div>
						<div class="col-md-6">
							<h4 align="justify" style="color: #0054ff;font-size: 14px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;"><b> New session (2018-19) begins</b></h4>
						</div>
						<div class="col-md-1">
							<h4 style="color: #0054ff;">:</h4>
						</div>
						<div class="col-md-4">
							<h4  style="color: #0054ff;padding-right:10px;    margin-left: -15px;font-size: 14px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;"><b>August 1, 2018</b></h4>
						</div>
					</div>
	      		</div>
	    	</div>
    	</div>
   	</div> 
</div>
<script>
	


</script>

