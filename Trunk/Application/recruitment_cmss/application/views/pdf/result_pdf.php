<?php
if($type == 'TOP')
{	
	/* ==================XXXXXXXXXXXXXXXXXXXXXXXX=============RESULT DETAILS==============XXXXXXXXXXXXXXXXXXX================*/
		$program_name = isset($program_detail[0]['program_name'])?$program_detail[0]['program_name']:'';
		$applicant_name = isset($applicant_detail[0]['applicant_name'])?$applicant_detail[0]['applicant_name']:'';
		$applicant_id = isset($applicant_detail[0]['applicant_id'])?$applicant_detail[0]['applicant_id']:'';
		$appl_no = isset($applicant_detail[0]['appl_no'])?$applicant_detail[0]['appl_no']:'';
		$mark= isset($applicant_detail[0]['value'])?$applicant_detail[0]['value']:'';
		$result = isset($applicant_detail[0]['field'])?$applicant_detail[0]['field']:'';
	/* ==================XXXXXXXXXXXXXXXXXXXXXXXX=============OTHER DETAILS==============XXXXXXXXXXXXXXXXXXX================*/
	
			echo '<div  class="panel panel-primary" style="border:groove" >
        	   			<div class="panel panel-default" >
	        	   			<div class="panel-heading" style="background-color:	#D3D3D3;border-color:#D3D3D3; color: #000000;text-align: center;padding: 2px 15px;">
	      					<h1 style="font-family:CenturyGothic, AppleGothic, sans-serif;"><center><b>'.$program_name.'</b></center></h1>
	        				</div>	
	        			</div> <br /> <br />
        				
	        				<table  style="font-size:20px; margin-top:-2%"align="center">
	        					<tr>
							        <td style="width:23%"><b>Name</b>&nbsp; </td>
							         <td style="width:25%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> :</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
							        <td>&nbsp;'.$applicant_name.'</td><br /> 
							    </tr> 
							    <tr>
							    	<td><b>Roll No</b> &nbsp;</td>
							         <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> :</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
							        <td>&nbsp;'.$applicant_id.'</td><br />
							    </tr>  
							    <tr>
							    	<td><b>Appl No</b> &nbsp;</td>
							         <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> :</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
							        <td>&nbsp;'.$appl_no.'</td><br />
							    </tr>
							</table>  <br />
				       <div class="panel panel-default" >
	        	   			<div class="panel-heading" style="background-color:	#D3D3D3;border-color:#D3D3D3; color: #000000;text-align: center;padding: 2px 15px;">
      						<h2 style="font-family:CenturyGothic, AppleGothic, sans-serif;; ">RESULT DETAILS</h2>
        					</div>
        				</div> <br />
					        <table style="font-size:20px; margin-top:-1%"align="center">
	        					<tr>
							        <td style="width:16%"><b>Mark</b> &nbsp;</td>
							        <td style="width:18%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> :</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
							        <td style="width:40%">&nbsp;'.$mark.'</td>
							    </tr><br /> 
							    <tr>
							    	<td><b>Result</b> &nbsp;</td>
							        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> :</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
							        <td>&nbsp;'.$result.'</td>
							    </tr>  <br />
							</table>  <br />
					</div>';
}
?>				
