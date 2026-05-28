<?php $base_url =  base_url();?>
<style>
@font-face {
    font-family: myFirstFont;
    src: url("<?php echo $base_url ?>upload/fonts/Montserrat/Montserrat-Regular.ttf");
}
body{
	font-family: myFirstFont;
	font-size: 12px;
}
.navbar-custom-menu > .navbar-nav > li {

	    position: relative;
	    display: none;

	}
</style>
<?php
$counter = 0;
$now = date("d-m-Y h:i A");
$today = date("d-m-Y");
if($type == 'ADMIT_CARD')
{
	$slno = 1;
	$nextpage = 1;

		//$master_name = $applicantSRow[0]['course_name'];
		$exam_schedule = $applicantSRow[0]['exam_schedule'];
		$exam_vanue = $applicantSRow[0]['exam_vanue'];				
		$examination_date = $applicantSRow[0]['examination_date'];				
		$exam_centre_name = $applicantSRow[0]['exam_centre_name'];				
		$institute_name = $applicantSRow[0]['institute_name'];				
		$range = sizeof($applicantSRow);				
		$program_code = $applicantSRow[0]['program_name'];				
		$roll_no1 = $applicantSRow[0]['omr_no'];
		$roll_no2 = $roll_no1 + $range;
		$roll_no2 = $roll_no2 - 1;
		echo '<html><body><br /><br /><br /><table style="width:100%;background-color:#fff;line-height:1.5;">
				<tr >
					<td colspan="2" align="center"><h3><b>'.strtoupper($institute_name).'</b></h3></td>															
				</tr>
				<tr >
					<td  colspan="2" align="center"><u> ATTENDANCE SHEET FOR EXAM '.strtoupper($program_code).'</u></td>															
				</tr>
				<tr>
					<td align="left">Exam Venue : <b>'.$exam_vanue.'</b></td>
					<td align="right">Date of Exam : <b>'.$examination_date.'</b></td>
				</tr>
				<tr>
					<td  colspan="2" >Roll No. Range : <b>'.$roll_no1.' - '.$roll_no2.'</b></td>
				</tr>
				
			</table><br />';
		//echo(sizeof($applicantSRow));die();
		foreach($applicantSRow as $applicantRow)
			{	
				$nextpage ++;
				$roll_no = $applicantRow['omr_no'];
				$appl_no = $applicantRow['appl_no'];
				$full_name = $applicantRow['full_name'];
				$year = $applicantRow['year'];
				$sel_program_code = $applicantRow['applied_program'];
				$html = '';
				$photo = "";
				$signature = "";
				
				/*if($applicantRow['passport_path'] != '')
			    {
					$arr = explode('/',$applicantRow['passport_path']);
					$pho = end($arr);
					$pho = DOCUMENT_UPLOAD_URL."/DOCUMENTS/".$sel_program_code."/".$applicantRow['appl_no']."/".$photo;
			    }
				if($applicantRow['signature_path'] != '')
			    {
					$arr = explode('/',$applicantRow['signature_path']);
					$sign = end($arr);
					$sign = DOCUMENT_UPLOAD_URL."/DOCUMENTS/".$sel_program_code."/".$applicantRow['appl_no']."/".$sign;
			    }*/
			   /* if($applicantRow['passport_path'] != '')
			    {
					$arr = explode('/',$applicantRow['passport_path']);
					$pho = end($arr);
					echo $pho = DOCUMENT_UPLOAD_URL."/".$sel_program_code."/".$year."/".$applicantRow['appl_no']."/".$photo; die();
			    }
				if($applicantRow['signature_path'] != '')
			    {
					$arr = explode('/',$applicantRow['signature_path']);
					$sign = end($arr);
					$sign = DOCUMENT_UPLOAD_URL."/".$sel_program_code."/".$year."/".$applicantRow['appl_no']."/".$sign;
			    }
				if(file_exists($pho))*/
					$photo = $applicantRow['passport_path'];
				
				/*if(file_exists($sign))*/
					$signature = $applicantRow['signature_path'];									
							
				echo '<table border = "1" style="width:100%;border-collapse: collapse;background-color:#fff;font-size: 12px; ">				
				<tr>
					<td rowspan = "2" style="width:130px">
						<img class="" src="'.$photo.'" style="padding:10px;width:110px; height: 135px;"/>
					</td>
					<td style="width:20%; line-height: 2.0em;" >
						<table border = "0" style="width:100%;text-align:center;border:0 solid black;background-color:#fff;font-size: 12px;">				
							<tr>
								<td>
									Roll No : <b> '.$roll_no.'</b>
								</td>
							</tr>
					 		<tr>	
								<td> 
									<b>'.$full_name.'</b>
								</td>
								
					 		</tr>				 		
						</table>
					</td>	
					<td style=" padding-left:5px;width:40%;border:1px solid black;"> 
						<table border = "0" style="line-height:2;width:100%;text-align:left;background-color:#fff;font-size: 12px;">				
							<tr>
								<td width ="25%">
									Category: APST 
								</td>
								<td width ="25%" style="height:20px;width:20px;border:1px solid green">
								</td>
								<td width ="20%" style="padding-left:10px;"> 
									Unreserved 
								</td>
								<td  width ="25%" style="height:20px;width:20px;border:1px solid green">
								</td>
								
					 		</tr>
					 		<tr>
								<td colspan = "4" >
									Date of Birth : ............................................. 
								</td>
					 		</tr>	
					 		<tr>
								<td>
									Quota: PWD 
								</td>
								<td style="height:20px;width:20px;border:1px solid green">
									
								</td>
								<td style="padding-left:10px;"> 
									Not Applicable
								</td>
								<td style="height:20px;width:20px;border:1px solid green">
									
								</td>
								
					 		</tr>		 				 		
						</table>
					</td>
					<td style=" line-height:2.0em;width:15%;"> 
						<table border = "1" style="border-collapse: collapse;width:100%;text-align:center;background-color:#fff;font-size: 12px;">				
							<tr>
								<td style="height:10px">
									OMR serial Number
								</td>
							</tr>
							<tr>	
								<td style="height:40px">
									
								</td>
							</tr>
							<tr>	
								<td style="height:10px"> 
									Question booklet Series
								</td>
							</tr>
							<tr>		
								<td style="height:40px">
									
								</td>
					 		</tr> 				 		
						</table>
					</td>							 				 							
		 		</tr>
		 		
				<tr>				
					<td style="width:165px;"><img src="'.$signature.'" style="width:160px; height: 50px;"/></td> 
					<td style=" line-height:2.0em;"> 
						<table border = "0" style="border-collapse: collapse;width:100%;text-align:center;background-color:#fff;font-size: 12px;">				
							<tr>
								<td >
									Candidate’s Signature
								</td>
							</tr>
							<tr>	
								<td style="height:30px">
									
								</td>
							</tr>			 		
						</table>
					</td>
					<td style=" line-height:2.0em;border:1px solid black;"> 
						<table border = "0" style="border-collapse: collapse;width:100%;text-align:center;background-color:#fff;font-size: 12px;">				
							<tr>
								<td >
									Invigilator’s  Signature
								</td>
							</tr>
							<tr>	
								<td style="height:30px">
									
								</td>
							</tr>			 		
						</table>
					</td>								
				</tr>				 				 		
				</table>';
		 		$slno ++;
			};
			echo '<table style="margin-right:10px;width:100%;background-color:#fff;font-size: 14px;">            
												
							<tr>
								<td style="width:50%;height:50px;text-align:right;vertical-align:middle;"></td> 					
							</tr>
							<tr>
								<td style="width:50%;text-align:right;vertical-align:middle;">Signature of the Centre Superintendent</td> 					
							</tr>			
						</table></body></html>';
			
			//$mpdf->WriteHTML($html); 
		/* $counter++;
	     if($counter < count($applicantSRow))
	   		$mpdf->AddPage();*/

}

?>			
