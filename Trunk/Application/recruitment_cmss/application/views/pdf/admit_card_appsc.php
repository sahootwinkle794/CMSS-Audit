<?php
if($type == 'ADMIT_CARD')
{
	$size_of_courses = sizeof($courseDetails);
	$exam_center = $assigned_exam_center_code;
	foreach($instituteDetails as $row)
	{
		$institue_logo = $row['logo_url'];
		$institute_name = $row['institute_name'];
	}
	foreach($courseTimingDetails as $row)
	{
		$timing_morning_session = $row['timing_morning_session'];
		$timing_evening_session = $row['timing_evening_session'];
	}
	foreach($applicantSRow as $applicantRow)
	{
		$sel_program_code = $applicantRow['applied_program'];	
		$exam_center_address = $applicantRow['exam_center_address'];
		$controller_name = $applicantRow['controller_name'];
		$exam_vanue = $applicantRow['exam_vanue'];
		$controller_mobile_no = $applicantRow['controller_mobile_no'];
		$controller_email = $applicantRow['controller_email'];
		$controller_signature = $applicantRow['controller_signature'];
		$centre_name = $applicantRow['exam_centre_name'];
		$program_name = $applicantRow['program_name'];
		$year = $applicantRow['year'];
		$exam_schedul = $applicantRow['exam_schedule'];
		$examination_date = $applicantRow['examination_date'];
		$appl_no = $applicantRow['appl_no'];
		$full_name = $applicantRow['full_name'];
		$roll_no = $applicantRow['omr_no'];
		$instructions = $applicantRow['exam_instructions'];
		$controller_signature = BASE_URL."public/assets/images/logo/".$controller_signature;
		$html = '';
		$photo = "";
		$signature = "";
		
		$photo = $applicantRow['passport_path'];
		$signature = $applicantRow['signature_path'];
		$header_logo = base_url()."public/assets/images/icon/logo.png";
			
	echo '<table width="100%" style="border-collapse: collapse;font-family:Montserrat !important;">
			<tr>
				<td style="width:95%;text-align: center;padding-left:-20px;">
					
					<img src="'.$header_logo.'" /></td>
					
				</td>
				
			</tr>
			<tr>
				<td style="width:95%;text-align: center;padding-left:-20px;">
					
					
					
					<h3><u>ADMIT CARD</u></h3>
					<h3>'.$program_name.' - '.$year.'</h3>
				</td>
			</tr>
		</table><br>
		<table width="100%" style="border-collapse: collapse;font-family:Montserrat !important;">
			<tr>
				<td style="width:80%;vertical-align: middle;" height="100" >
					<table width="100%" height="100%" border="1" style="border-collapse: collapse;font-family:Montserrat !important;font-weight:bold;font-size:14px;padding :2px 2px 2px 2px;">
						<tr>
							<td style="width:25%;text-align:center"><b>Name </b></td>
							<td style="width:75%;"><b>&nbsp;&nbsp;'.$full_name.'</b></td>
							<td rowspan = "2" style="width:20%;text-align: center;">
								<img style="vertical-align: top" src="'.$photo.'" width="100"  height="100" />
							</td>
						</tr>
						<tr>
							<td style="width:25%;text-align:center"><b>Roll No </b></td>
							<td style="width:75%;"><b>&nbsp;&nbsp;'.$roll_no.'</b></td>
						</tr>
					</table>
					
				</td>
				
			</tr>
		</table>
		<br />
		<table cellpadding="10" border="1" width="100%" style="border-collapse: collapse;font-family:Montserrat !important;">
			<tr>
				<td colspan = "5"><b><center>EXAMINATION SCHEDULE</center></b></td>
			</tr>
			<tr>
				<td rowspan = "2" width="25"> <b><center>Date of Exam </center></b></td>
				<td colspan = "2" width="50"> <b><center> Timing & Subject </b> </center></td>
				<td rowspan = "2" width="25"> <b><center> Venue </center></b></td>
			</tr>
			<tr>
				<td> <b><center>MORNING SESSION <br /> '.$timing_morning_session.'</center></b></td>
				<td> <b><center>EVENING SESSION <br /> '.$timing_evening_session.'</center></b></td>
			</tr>';
			$x = 1;
			foreach($courseDetails as $row)
			{
				$var1 = $row['date_of_exam'];
				$date_of_exam = date("d/m/Y", strtotime($var1) );
				echo '<tr>
						<td style="text-align:center" width="25"><b>'.$date_of_exam.'</b></td>
						<td style="text-align:center" width="25"><b>'.$row['morning_session'].'</b></td>
						<td style="text-align:center" width="25"><b>'.$row['evening_session'].'</td>';
						if($x == 1)
						{
				echo '<td style="text-align:center" rowspan='.$size_of_courses.'><b>'.$exam_vanue.'</td>';
							$x++;		
						}
				echo'
					</tr>';
			}
			echo '
		</table>
		<br />
		<table style="width:100%;background-color:#fff;font-size: 16px;">
			<tr>
				<td colspan="2" style="width:25%;"><b><h2><u>Important Instructions</u></h2></b></td>																																	
			</tr>
			<tr>					
				<td colspan="2" style="width:100%;text-align:justify;font-size: 16px;">
					'.$instructions.'
					
				</td>	
			</tr>
			<tr>
				<td>
					<p> &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; No TA/DA is admissible for appearing in the examination.</p>
				</td>	
				<td>
					<img style="vertical-align: top;text-align:center" src="'.$controller_signature.'" width="100"  height="100" />
				</td>																							
			</tr>
			<tr>
				<td>
				</td>
				<td>
					<p style="text-align:center">'.$controller_name.'</p>
				</td>
			</tr>
			
			<tr>
				<td>
					<p style="font-size: 20px;"><u><b> Please read the Instructions printed overleaf carefully.</b></u></p>
				</td>
				<td><p style="font-size: 18px;text-align:center"><u>Secretary</u>	</td>																									
			</tr>
										
		</table>
	';		
	}
}
?>			
