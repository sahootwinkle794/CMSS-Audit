<?php
$counter = 0;
$now = date("d-m-Y h:i A");
$today = date("d-m-Y");
$html = '';
$publish_date='';
$program = $applicant_data['program_name'];
if($program == 'Postgraduate Diploma in Plastics Testing and Quality Control (PGD-PTQC)'){
	$program = 'Postgraduate Diploma in Plastics Processing & Testing (PGD-PPT)';
}
?>			
<!DOCTYPE html>
	<html lang="hi">
	<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

	<meta http-equiv="Content-Language" content="hi">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<style>
		body{
			background-image: url("<?=base_url()?>/upload/image/bor_certificate.jpg");
			background-position: center;
   
    /*background-repeat: no-repeat;*/
    background-size: cover;
		}
	</style>
	</head>
	<body>
	<div >

<table width="100%" style="border-collapse: collapse;font-family:Arial;">
					
					<tr>
						<td colspan="3" style="text-align:center; vertical-align:middle;padding-bottom: 10px;">
							<h3>COUNSELLING CUM PROVISIONAL ADMISSION LETTER </h3>
						</td>						
					
					</tr>
					<tr>
						<td style="width: 30%;text-align: left;vertical-align:middle;">HO/AC/ADM/2018/<?=$applicant_data['letter_slno']?></td>
						<td style="width: 40%;text-align: center;padding-left:-30px;">&nbsp;</td>
						<td style="width: 30%;text-align: right;vertical-align:middle;">17/07/2018</td>					
					</tr>
					<tr>
						<td colspan="3" style="padding-top: 10px;padding-bottom: 10px;">To,<br /> <i><?=$applicant_data['full_name']?><br /><?=$applicant_data['address']?></i></td>					
					</tr>
					<tr>
						<td style="width: 40%;text-align: left;vertical-align:middle;">Regd No: <b><i><?=$applicant_data['appl_no']?></i></b> </td>
						<td style="width: 20%;text-align: center;padding-left:-30px;">&nbsp;</td>
						<td style="width: 30%;text-align: right;vertical-align:middle;">Category: <b><i><?=$applicant_data['category_name']?></i></b> </td>					
					</tr>
					<tr>
						<td colspan="3" style="text-align:left; vertical-align:middle;padding-top: 10px;padding-bottom: 10px;"><b>Sub :</b> Counselling for Provisional Admission into <b><i><?=$program?></i></b> Course – reg.</td>					
					</tr>
					<tr>
						<td colspan="3" style="text-align:justified; vertical-align:middle;">Congratulations! based on the admission criteria, you have been selected for joining CIPET course as detailed below : </td>				
					</tr>
					<tr>
						<td colspan="3" style="text-align:justified; vertical-align:middle;padding-top: 10px;padding-bottom: 10px;"><b>1. Course:</b> <b><i><?=$program?></i></b></td>				
					</tr>
					<tr>
						<td colspan="3" style="text-align:justified; vertical-align:middle;padding-top: 10px;padding-bottom: 10px;"><b>2. Center:</b> <b><i><?=$applicant_data['counselling_venue']?></i></b></td></td>		
					</tr>
					<tr>
						<td colspan="3" style="text-align:left; vertical-align:middle;padding-top: 10px;padding-bottom: 10px;"><b>You are hereby informed to join the course on or before 30/07/2018, 2:00 p.m., failing which, your seat will be allotted to the next candidate in the waiting list.</b> </td>				
					</tr>
					<tr>
						<td colspan="3" style="text-align:justified; vertical-align:middle;padding-top: 10px;padding-bottom: 10px;"><b>You are advised to confirm by return email to the concerned CIPET Centre and copy to Head Office email-ID ( hocipet2018@gmail.com ).</b></td>				
					</tr>
					<tr>
						<td colspan="3" style="text-align:justified; vertical-align:middle;">Please bring the following original documents for verification during counselling:
<br /><br />
						<ol>
						<li>Mark sheets of entry qualification</li>
						<li>Passing / Provisional / Degree certificate</li>
						<li>Birth certificate</li>
						<li>Transfer certificate</li>
						<li>SC/ST certificate (if applicable)</li>
						<li>OBC (Non-Creamy Layer) certificate (if applicable)</li>
						<li>Three stamp size photographs</li>
						<li>Appropriate certificate by Physically Challenged candidates as a proof for claim.</li>									
						</ol></td>				
					</tr>
					<tr>
						<td colspan="3" style="text-align:justified; vertical-align:middle;padding-top: 10px;padding-bottom: 10px;">The hostel allotment will be done on first come first serve basis subject to fulfilling the criteria decided by the concerned centre. </td>				
					</tr>	
					<tr>
						<td colspan="3" style="text-align:justified; vertical-align:middle;padding-top: 10px;padding-bottom: 10px;">Any failure to report on the mentioned date may lead to cancellation of admission.   In the event of any information furnished in the online application and submission of documents are found to be false, your admission is liable to be cancelled. </td>				
					</tr>	
					<tr>
						<td colspan="3" style="text-align:justified; vertical-align:middle;padding-top: 10px;padding-bottom: 10px;">Regarding fees, you are informed to deposit all the required fees towards admission into CIPET diploma programs in the form of Demand Draft drawn in favour of CIPET or pay by cash/ Debit card / Credit Card/ ATM Card  as per enclosed schedule of fees.  </td>				
					</tr>	
					<tr>
						<td colspan="3" style="text-align:justified; vertical-align:middle;padding-top: 10px;"><img src="<?php echo base_url() ?>upload/image/PriSign.png" style="width:13%; height: 5%;"/><br /><b>Manager (Academics)</b><br /><b>Chairman – CIPET JEE</b><br />Encl.: Schedule of Fees</td>				
					</tr>					
					
				</table>

	


		
	</div>
	<br />
	<div >
		<h4 align="center">Fee Structure for first year Diploma / Post Diploma / Post Graduate Diploma (2018-19)</h4>
		<table border="1" cellspacing="0">
			<tr>
				<th>Course</th>
				<th>Semester Course Fee</th>
				<th>Semester Exam Fee</th>
				<th>Caution Money Deposit</th>
				<th>Insurance Premium per year</th>
				<th>CIPET Alumni Fee</th>
				<th>Admission Fee</th>
				<th>Total Rs.</th>
			</tr>
			<?php if($applicant_data['applied_program']=='PGRT_CIPET'){ ?>
				<tr>
					<td style="text-align: center">PGD-PPT</td>
					<td style="text-align: center">20,000</td>
					<td style="text-align: center">1400</td>
					<td style="text-align: center">500</td>
					<td style="text-align: center">100</td>
					<td style="text-align: center">150</td>
					<td style="text-align: center">1500</td>
					<td style="text-align: center">23,650</td>
				</tr>
			<?php }else if($applicant_data['applied_program']=='TGTR_CIPET'){ ?>								
				<tr>
					<td style="text-align: center">PGD-PPT</td>
					<td style="text-align: center">20,000</td>
					<td style="text-align: center">1400</td>
					<td style="text-align: center">500</td>
					<td style="text-align: center">100</td>
					<td style="text-align: center">150</td>
					<td style="text-align: center">1500</td>
					<td style="text-align: center">23,650</td>
				</tr>
			<?php }else if($applicant_data['applied_program']=='PGTR_CIPET'){ ?>
				<tr>
					<td style="text-align: center">PD-PMD with CAD/CAM</td>
					<td style="text-align: center">20,000</td>
					<td style="text-align: center">1400</td>
					<td style="text-align: center">500</td>
					<td style="text-align: center">100</td>
					<td style="text-align: center">150</td>
					<td style="text-align: center">1500</td>
					<td style="text-align: center">23,650</td>
				</tr>
			<?php }else if($applicant_data['applied_program']=='DRP_CIPET'){ ?>
				<tr>
					<td style="text-align: center">DPMT</td>
					<td style="text-align: center">16,700</td>
					<td style="text-align: center">1600</td>
					<td style="text-align: center">500</td>
					<td style="text-align: center">100</td>
					<td style="text-align: center">150</td>
					<td style="text-align: center">1500</td>
					<td style="text-align: center">20,550</td>
				</tr>
			<?php }else if($applicant_data['applied_program']=='PGT_CIPET'){ ?>
				<tr>
					<td style="text-align: center">DPT</td>
					<td style="text-align: center">16,700</td>
					<td style="text-align: center">1600</td>
					<td style="text-align: center">500</td>
					<td style="text-align: center">100</td>
					<td style="text-align: center">150</td>
					<td style="text-align: center">1500</td>
					<td style="text-align: center">20,550</td>
				</tr>
			<?php }else { ?>
				<tr>
					<td colspan="8" style="text-align: center">No Fee</td>
				</tr>
			<?php } ?>
		</table>
	</div><br /><br />
	<span>Hostel fee as detailed below: </span>
	<ul type="disc">
		<li>Hostel Room rent including all amenities : Rs.10,000.00  (Ten Thousand ) per candidate / Semester (will be collected as an advance)</li>
		<li>Hostel mess fee will be extra and charged as per actual on monthly basis.</li>
		<li>Caution Money Deposit (Refundable): Rs.1000/-(To be paid at the time of hostel admission)</li>
		<li>The fees towards issue of uniform will be extra and collected at the time of admission</li>								
	</ul>
	</body></html>