<?php
	date_default_timezone_set('Asia/Kolkata');
    $date = date("d-m-Y");;
	/* ==================XXXXXXXXXXXXXXXXXXXXXXXX=============RESULT DETAILS==============XXXXXXXXXXXXXXXXXXX================*/
		//$program_name = isset($program_detail[0]['program_name'])?$program_detail[0]['program_name']:'';
		$program_name = isset($applicant_data['program_name'])?$applicant_data['program_name']:'';
		$applicant_name = isset($applicant_data['full_name'])?$applicant_data['full_name']:'';
		$applicant_id = isset($applicant_data['omr_no'])?$applicant_data['omr_no']:'';
		$reg_user_id = isset($applicant_data['reg_user_id'])?$applicant_data['reg_user_id']:'';
		$appl_no = isset($applicant_data['appl_no'])?$applicant_data['appl_no']:'';
		
		
		$instruction = isset($appiontment_data['instructions'])?$appiontment_data['instructions']:'';
		$authorised_name = isset($appiontment_data['authorised_name'])?$appiontment_data['authorised_name']:'';
		$authorised_sign = isset($appiontment_data['authorised_sign'])?$appiontment_data['authorised_sign']:'';
		$ins = str_replace("<p>","",$instruction);
		$ins = str_replace("</p>","",$ins);
		$instructions = html_entity_decode($ins);
		
		$header_logo = base_url()."public/assets/images/icon/Header for APSSB.png";
		
	/* ==================XXXXXXXXXXXXXXXXXXXXXXXX=============OTHER DETAILS==============XXXXXXXXXXXXXXXXXXX================*/
	
			echo '<div  class="panel panel-primary" style="border:groove" >
        	   			<div class="panel panel-default" >
	        	   			<div class="panel-heading" style="text-align: center;font-size: 18px;padding: 2px 15px;">
	        	   			<table style="width:100%;background-color:#fff;">            
								<tr>
									<td style="width:5%;text-align: center;vertical-align:middle;">
									<img src="'.$header_logo.'" /></td>
													            
								</tr>		
							</table>
	      					<h3 style="font-family:CenturyGothic, AppleGothic, sans-serif;"><center><b>Letter of Appointment</b></center></h3>
	        				<hr></div>	
	        			</div> <br /> <br />
	        			<table style="width:100%;background-color:#fff;font-size: 18px;">				
				<tr>
					<td style="width: 36%; line-height:2.0em; padding-left:15px;" >
						
							<p style="text-align: right;"><b>Date: </b>'.$date.'</P><br />
							Dear '.ucwords(strtolower($applicant_name)).',
							<p style="margin-top:-5px;">Appointment for the post of <b>'.$program_name.'</b></p><br />
						
					</td>	
													 				 							
		 		</tr>		 				 		
				</table>
				'.$instructions.'
				<table style="width:100%;background-color:#fff;">            
					<tr>
						<td style="width:5%;text-align: right;vertical-align:middle; padding-right:20px;">
						<img style="width:40%;" src="'.$authorised_sign.'" /></td>
										            
					</tr>		
				</table>
		</div>';

?>				
