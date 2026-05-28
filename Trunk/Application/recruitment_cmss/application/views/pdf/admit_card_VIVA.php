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
	$size_of_courses = sizeof($subjectDetails);
	//print_r($subjectDetails);
	$exam_center = $assigned_exam_center_code;
	foreach($courseTimingDetails as $row)
	{
		$timing_morning_session = $row['timing_morning_session'];
		$timing_evening_session = $row['timing_evening_session'];
	}
	//$size_of_courses = sizeof($courseDetails);
	//print_r($applicantSRow);return;
	foreach($applicantSRow as $applicantRow)
	{
		$sel_program_code = $applicantRow['applied_program'];	
		$year = $applicantRow['year'];	
		$exam_center_address = $applicantRow['exam_center_address'];
		$controller_name = $applicantRow['controller_name'];
		$controller_signature = $applicantRow['controller_signature'];
		$exam_vanue = $applicantRow['exam_vanue']; 
		$controller_mobile_no = $applicantRow['controller_mobile_no'];
		$controller_email = $applicantRow['controller_email'];
		$centre_name = $applicantRow['exam_centre_name'];
		$course_name = $applicantRow['program_name'];
		$exam_schedul = $applicantRow['exam_schedule'];
		$examination_date = $applicantRow['examination_date'];
		$appl_no = $applicantRow['appl_no'];
		$full_name = $applicantRow['full_name'];
		$dob = $applicantRow['dob'];
		$exam_type = $applicantRow['template_code'];
		if($exam_type == 'written'){
			$exam_type = 'Written Exam';
		}
		if($exam_type == 'VIVA'){
			$exam_type = 'Viva';
		}
		$is_reserved_quota = $applicantRow['is_reserved_quota'];
		if($is_reserved_quota == '' || $is_reserved_quota == 'Not Applicable (NA)' || $is_reserved_quota == 'Not Applicable' || $is_reserved_quota == 'Nill' || $is_reserved_quota == 'No' || $is_reserved_quota == 'NULL'){
			$is_reserved_quota = 'NA';
		}
		$rel_name = $applicantRow['rel_name'];
		$category = $applicantRow['category_name'];
		$exam_instructions = $applicantRow['exam_instructions'];
		$roll_no = $applicantRow['omr_no'];
		$exam_shift = $applicantRow['exam_shift'];
		$reporting_time = $applicantRow['reporting_time'];
		$exam_start_time = $applicantRow['exam_start_time'];
		$gate_closing_time = $applicantRow['gate_closing_time'];
		if($sel_program_code == 'DRP_CIPET' || $sel_program_code == 'PGT_CIPET'){
			$course_name = "Diploma in Plastics Mould Technology (DPMT)/Diploma in Plastics Technology (DPT)";
		}
		//echo $sel_program_code;die();
		$html = '';
		$photo = "";
		$signature = "";
		
		$userPhoto = $applicantRow['passport_path'];
		$signature = $applicantRow['signature_path'];
		//echo $signature;die();
		$sel_program=explode("_",$sel_program_code);
		$exam_code=$sel_program[0];
		
		
		$exam_date=explode("-",$examination_date);
		$exam_year=$exam_date[2];
		
		
		$split=explode(" ",$exam_start_time);
		$date=$split[0];
		$date_format=$split[1];
		$time = strtotime($date);
		$close_time = date("H:i", strtotime('-30 minutes', $time));
		$controller_signature = BASE_URL."public/assets/images/logo/".$controller_signature;
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
		/*$header_logo = base_url()."public/assets/images/icon/Header for APSSB.png";*/
		$header_logo = base_url()."public/assets/images/icon/header_logo.png";
		$arrow = base_url()."public/assets/images/icon/arrow.png";
			
	echo '<style>
			@import url("https://fonts.googleapis.com/css?family=Monda|Montserrat|Open+Sans|Poppins&display=swap");
			@font-face {
			    font-family: Montserrat !important;
			}
			table{
				font-family:Montserrat !important;
			}
		</style>
		<table style="width:100%;background-color:#fff;">            
			<tr>
				<td style="width:100%;text-align: center;vertical-align:middle;">
				<img src="'.$header_logo.'" /></td>
								            
			</tr>
			<tr>
				
				<td style="width:100%;background-color:#fff;font-size: 15px;"><center><b>ARUNACHAL PRADESH STAFF SELECTION BOARD</b></center></td>			
								            
			</tr>
			<tr>
				
				<td style="width:100%;background-color:#fff;font-size: 15px;"><center>GOVERNMENT OF ARUNACHAL PRADESH</center></td>			
								            
			</tr>
			<tr>
				
				<td style="width:100%;background-color:#fff;font-size: 15px;"><center>C SECTOR, ITANAGAR</center></td>			
								            
			</tr>
			<tr>
				
				<td style="width:100%;background-color:#fff;font-size: 15px;"><center>Examination for Technical post under TRIHMS, 2020</center></td>			
								            
			</tr>
			<tr>
				
				<td style="width:100%;background-color:#fff;font-size: 15px;"><center>'.$exam_code.'</center></td>			
								            
			</tr>
			<tr>
				
				<td style="width:100%;background-color:#fff;font-size: 15px;"><center><b>e-ADMIT CARD</b></center></td>			
								            
			</tr>		
		</table>
			
			<table border="1" style="width:100%;padding-left:15px;border-collapse: collapse;background-color:#fff;font-size: 16px;line-height:3; ">
				<tr>
					<td width="20%"><center>Date of Exam </center></td>			
					<td width="20%"><center><b>'.$examination_date.'</b></center></td>			
					<td width="20%"><center>Reporting time</center></td>			
					<td width="20%" ><center><b>'.$reporting_time.'</b></center></td>			
					<td width="20%"><center>Gate closing time</center></td>			
					<td width="20%"><center><b>'.$gate_closing_time.'</b></center></td>			
				</tr>
				<tr >
					<td ><center>Post name</center></td>			
					<td colspan = "3" ><center><b>'.$course_name.'</b></center></td>
					<td colspan = "2" rowspan = "4" style="width:20%;background-color:#fff;border:1px solid black"><center><img src="'.$userPhoto.'"  height="205" width="200" /></center></td>				
						
				</tr>
				<tr >
					<td ><center>Applicant Id</center></td>			
					<td colspan = "3" ><center><b>'.$appl_no.'</b></center></td>
							
				</tr>
				<tr >
					<td ><center>Roll No.</center></td>			
					<td colspan = "3" ><center><b>'.$roll_no.'</b></center></td>
							
				</tr>
				<tr >
					<td ><center>Candidate’s Name</center></td>			
					<td colspan = "3" ><center><b>'.$full_name.'</b></center></td>
							
				</tr>
				<tr >
					<td ><center>Date of Birth</center></td>			
					<td colspan = "3" ><center><b>'.$dob.'</b></center></td>
					<td colspan = "2" rowspan = "3" style="width:20%;background-color:#fff;border:1px solid black"><center><img src="'.$signature.'"  height="205" width="200" /></center></td>				
							
				</tr>
				<tr >
					<td ><center>Category</center></td>			
					<td colspan = "3" ><center><b>'.$category.'</b></center></td>
							
				</tr> 
				<tr > 
					<td ><center>Quota</center></td>			
					<td colspan = "3" ><center><b>'.$is_reserved_quota.'</b></center></td>
							
				</tr>
				<tr>
					<td style="width:100%;background-color:#fff;font-size: 15px;" colspan = "6"><center>Exam Venue</center></td>			
				</tr>
				<tr>
					<td style="width:100%;background-color:#fff;font-size: 15px;" colspan = "6"><center><b>'.$exam_vanue .'</b></center></td>			
				</tr>		
			</table>
			<br>
			<br>
			<table border="1" style="width:100%;padding-left:15px;border-collapse: collapse;background-color:#fff;font-size: 15px;line-height:1.5; ">
				<tr>
					<td width="20%">Subject</td>				
					<td width="20%"><center>Marks</center></td>					
					<td width="20%"><center>Time allowed</center></td>	
				</tr>';
				$x = 1;
				foreach($subjectDetails as $row)
				{
				echo '<tr >
					<td>'.$row['course_name'].'</td>			
					<td><center>'.$row['total_mark'].'</center></td>';
					if($x == 1)
					{
					echo ' <td rowspan='.$size_of_courses.'><center>'.$row['timing'].'</center></td>';
					$x++;	
					}
					echo '</tr>';
				}		
				echo '</table>			
			<br>
			<table style="width:100%;background-color:#fff;line-height:3;">            
				
				<tr>
					
					   <td  colspan = "2" style="width:100%;background-color:#fff;font-size: 15px;">The candidate should bring a <b><u>valid photo ID proof (in original)</u></b> for verification.</td>			
									            
				</tr>
				<tr>
					
					<td colspan = "2" style="width:100%;background-color:#fff;font-size: 15px;">The candidate is advised to go through the instructions in the next page.</td>			
									            
				</tr>
				<tr>
					<td style="width:60%;">
					</td>
					<td style="width:200px;height:50px;background-color:#fff;border:1px solid black;" >
						<img style="vertical-align: top;text-align:center" src="'.$controller_signature.'" width="180"  height="60" />
					</td>				            
				</tr>
				
				
			</table>
			<br>
			<br>
			
			<table border="1" style="width:100%;padding-left:15px;border-collapse: collapse;background-color:#fff;font-size: 15px;">
			
				
				<tr >
						
					<td style="width:100%;background-color:#fff;font-size: 14px;line-height:1.4 ;text-align:justify;padding:20px" ><span style="font-size:15px;font-weight:bold;">INSTRUCTIONS FOR CANDIDATES :</span><br>'.$exam_instructions.'</td>		
				</tr>
							
			</table>
			';	
			
			/*$mpdf->WriteHTML($html);
		 $counter++;
	     if($counter < count($applicantSRow))
	   		$mpdf->AddPage();*/	
	}
}
?>			
