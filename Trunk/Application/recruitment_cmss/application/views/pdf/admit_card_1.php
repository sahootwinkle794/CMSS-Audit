<?php
/*$counter = 0;
$now = date("d-m-Y h:i A");
$today = date("d-m-Y");*/
if($type == 'ADMIT_CARD')
{
	foreach($instituteDetails as $row)
	{
		$institue_logo = $row['logo_url'];
	}
	foreach($applicantSRow as $applicantRow)
	{
		$sel_program_code = $applicantRow['applied_program'];	
		$exam_center_address = $applicantRow['exam_center_address'];
		$controller_name = $applicantRow['controller_name'];
		$exam_vanue = $applicantRow['exam_vanue'];
		$controller_mobile_no = $applicantRow['controller_mobile_no'];
		$controller_email = $applicantRow['controller_email'];
		$centre_name = $applicantRow['exam_centre_name'];
		$course_name = $applicantRow['program_name'];
		$exam_schedul = $applicantRow['exam_schedule'];
		$examination_date = $applicantRow['examination_date'];
		$appl_no = $applicantRow['appl_no'];
		$full_name = $applicantRow['full_name'];
		$roll_no = $applicantRow['omr_no'];
		if($sel_program_code == 'DRP_CIPET' || $sel_program_code == 'PGT_CIPET'){
			$course_name = "Diploma in Plastics Mould Technology (DPMT)/Diploma in Plastics Technology (DPT)";
		}
		//echo $sel_program_code;die();
		$html = '';
		$photo = "";
		$signature = "";
		
		$photo = $applicantRow['passport_path'];
		$signature = $applicantRow['signature_path'];
		//$pho = BASE_ADM_URL."/DOCUMENTS/".$sel_program_code."/".$applicantRow['appl_no']."/".$photo;
		//ECHO $pho;
		/*if($applicantRow['passport_path'] != '')
	    {
	    	$photo = $applicantRow['passport_path'];
			//$arr = explode('/',$applicantRow['passport_path']);
			//$pho = end($arr);
			
	    }*/
		/*if($applicantRow['signature_path'] != '')
	    {
			$arr = explode('/',$applicantRow['signature_path']);
			$sign = end($arr);
			$sign = DOCUMENT_UPLOAD_URL."/DOCUMENTS/".$sel_program_code."/".$applicantRow['appl_no']."/".$sign;
	    }*/
	    //ECHO $pho;
		/*if(file_exists($pho))
			$photo = $applicantRow['passport_path'];
		
		if(file_exists($sign))
			$signature = $applicantRow['signature_path'];*/
			
	echo '<table style="width:100%;border:1 solid #F04178;background-color:#fff;">            
			<tr>
				<td style="width:5%;text-align: left;vertical-align:middle;">
				<img src="'.base_url().'public/assets/images/'.$institue_logo.'" /></td>
								            
			</tr>		
			</table>
			<table><tr><td><p style="font-size:8px;">
					           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;					           
					           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;					           
					           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;					           
					           					           
						<barcode code="'.$applicantRow['appl_no'].'" type="C128A" size="0.5" height="1.3" /> 	
					</p></td></tr></table>
			<table style="width:100%;padding-left:20px;border:1 solid #F04178;background-color:#fff;font-size: 13px;">
				<tr>
					<td style="width:80%">
						<table style="width:100%;padding:-2px;padding-bottom:1px; border:0 solid #F04178;background-color:#fff;font-size: 13px;line-height:1.5em;">
						<tr>
							<td style="width:27%;border:1 solid #F04178;background-color:#fff;" colspan = 2><span style="color:#992649">Register Number :</span> '.$roll_no.'</td>			
						</tr>
						<tr>
							<td style="width:27%;border:1 solid #F04178;background-color:#fff;"><span style="color:#992649">Course Code :</span> '.$course_name.'</td>					
							<td style="width:27%;border:1 solid #F04178;background-color:#fff;"><span style="color:#992649">Time :</span> '.$exam_schedul.'</td>																					
						</tr>							
						</table>						
						<table style="width:100%;border:1 solid #F04178;background-color:#fff;font-size: 13px;">
							<tr>
								<td style="width:33%;height:50px;vertical-align: top;"><span style="color:#992649">Examination Centre :</span> <b>'.$centre_name.'</b></td>																												
							</tr>
							<tr>
								<td style="width:33%;height:50px;vertical-align: top;"><span style="color:#992649">Examination Venue :</span> <b>'.$exam_vanue.'</b></td>																												
							</tr>
							<tr>
								<td style="width:33%;height:50px;vertical-align: top;">'.$exam_center_address.'</td>																												
							</tr>
							<tr>
								<td style="width:33%;height:50px;vertical-align: top;"><span style="color:#992649">Examination Contact Details :</span> <b><br/>'.$controller_name.'<br/>'.$controller_mobile_no.'<br/>'.$controller_email.'</b></td>																												
							</tr>
							
							<tr>
								<td style="width:33%;height:50px;vertical-align: top;">'.$exam_center_contact.'</td>																												
							</tr>						
						</table>																	
						<table style="margin-top:3px;width:100%;border:1 solid #F04178;background-color:#fff;font-size: 13px;">
							<tr>
								<td style="width:25%;height:120px;vertical-align: top;"><span style="color:#992649">Name of the Candidate :</span> '.$full_name.'</td>																												
							</tr>
														
						</table>
					</td>
					<td style="width:20%">
						<table style="width:100%;height:100px;border:0 solid #F04178;background-color:#fff;">													
							<tr>									
								<td style="text-align:center;font-size: 13px;color:#992649" ><b>PHOTO</b><br/>
								<img src="'.$photo.'" style="width:13%; height:12%;padding:1%;border:1 solid #F04178;background-color:#fff;"/></td>																								
							</tr>
							<table><tr><td><br/></td></tr></table>
							<tr>									
								<td style="text-align:center;font-size: 10px;color:#992649" ><img src="'.$signature.'" style="width:13%; height: 3%;padding:1%;border:1 solid #F04178;background-color:#fff;"/>
								<br/><b><i>Signature of Candidate</b></i></td>																								
							</tr>
							<table><tr><td><br/></td></tr></table>
							<tr>									
								<td style="text-align:center;font-size: 10px;color:#992649" ><img src="'.base_url().'upload/image/PriSign.png" style="width:13%; height: 3%;padding:1%;border:1 solid #F04178;background-color:#fff;"/>
								<br/><b><i>Manager (Academics)</i></b></td>																								
							</tr>														
						</table>
					</td>
				</tr>				
			</table>			
			<table><tr><td><br/></td></tr></table>
			<table style="width:100%;border:1 solid #F04178;background-color:#fff;font-size: 13px;">
				<tr>
					<td style="width:25%;text-align:center;color:#636363"><b><h5><u>INSTRUCTIONS TO CANDIDATES</u></5></b></td>																																	
				</tr>
				<tr>					
					<td style="width:100%;text-align:justify;color:#992649">
						<ol style="list-style-type:lower-alpha;">
						 
						 <li>Print out of hall ticket/admit card is mandatory.
<ul><li>a.	Electronic form of hall ticket/admit card will not be accepted.</li></ul>
</li>					
						 <li>Candidates will be permitted to the examination hall on production of the hall ticket /admit card.</li>
						 <li>No candidate will be allowed to enter the examination hall after “TEN” minutes from the commencement of the examination and No candidate will be allowed to re-enter the examination hall once he/she leaves during the examination session.</li>
						 <li>No candidate will be permitted to leave the examination hall during the first thirty minutes from the commencement of the examination.</li>
						 <li>No candidate shall be permitted inside the examination hall with books, papers, manuscripts, calculators, mobile phone, etc.</li>
						 <li>Adoption of any kind of unfair means at the time of examination or taking part in act of impersonation will render the applicant liable for cancellation of his/her script and forfeit his / her claim of admission.  Decision of the examiner shall be final and binding.</li>
						 <li>For the CBT your user id is your registered mobile number & your password is your date of birth.</li>
						 <li>There will be a timer in front of you during the test.  Just make sure you devote sufficient time for each section as planned.</li>
						 <li>There will be 60 questions for each course and the exam duration will be of 60 minutes. However, you are requested to enter the exam hall before 30 minutes to login and read the instructions and be comfortable. No extra time will be given.</li>
						 <li>The question portal will shut down automatically after completion of the exam time.</li>	 
						</ol>
						<p>&nbsp;</p>
						<p style="width:100%;text-align:center;color:#636363"><b>IMP: Valid photo ID to be furnished during entry (Photo ID, Aadhaar Card, School identity card, DL or Any other admit card with photo)</b></p>
						<p>&nbsp;</p>
					</td>																												
				</tr>
											
			</table>';	
			/*$mpdf->WriteHTML($html);
		 $counter++;
	     if($counter < count($applicantSRow))
	   		$mpdf->AddPage();*/	
	}
}
?>			
