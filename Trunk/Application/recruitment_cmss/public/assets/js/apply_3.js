function readURL(width,height,id) {
    if (document.getElementById("file"+id).files && document.getElementById("file"+id).files[0]) {
        var reader = new FileReader();
           
         reader.onload = function (e) { 
           
			var image = new Image();
 
            //Set the Base64 string return from FileReader as source.
            image.src = e.target.result;
                   
            //Validate the File Height and Width.
            image.onload = function () {
                var image_height = this.height;
                var image_width = this.width;
                
                if(id == 'PWD' || id == 'GRAD' || id == 'CASTE' || id == 'CLXII'  || id == 'CLX' || id == 'EWS' || id == 'EXPCERT' || id == 'EXPCERT2' || id == 'EXPCERT3' || id == 'EXPCERT4' || id == 'EXPCERT5' || id == 'EXPCERT6' || id == 'EXPCERT7') 
                {
					if (image_height > 600 || image_width > 750) {
	                document.getElementById("divMessage"+id).innerHTML="Error : Height and Width must not exceed 600px and 750px ";
	                $("#file"+id).val("");
					$('#img'+id).attr('src','');
					$('#img'+id).attr('height','0');
					$('#img'+id).attr('width','0');
	                }
	                else if(image_height < 600 || image_width < 750)
	                {
						document.getElementById("divMessage"+id).innerHTML="Error : Height and Width must not below 600px and 750px ";
	                    $("#file"+id).val("");
						$('#img'+id).attr('src','');
						$('#img'+id).attr('height','0');
						$('#img'+id).attr('width','0');
					}
	                else
	                {
						$('#img'+id).attr('src', e.target.result);
						$('#img'+id).attr('height',height);
						$('#img'+id).attr('width',width);
					}
				}
				else
				{
					if (image_height > height || image_width > width) {
	                document.getElementById("divMessage"+id).innerHTML="Error : Height and Width must not exceed "+height+" and "+width+"";
	                $("#file"+id).val("");
					$('#img'+id).attr('src','');
					$('#img'+id).attr('height','0');
					$('#img'+id).attr('width','0');
	                }
	                else if(image_height < height || image_width < width)
	                {
						document.getElementById("divMessage"+id).innerHTML="Error : Height and Width must not below "+height+" and "+width+"";
	                    $("#file"+id).val("");
						$('#img'+id).attr('src','');
						$('#img'+id).attr('height','0');
						$('#img'+id).attr('width','0');
					}
	                else
	                {
	                	//alert(1);
						$('#img'+id).attr('src', e.target.result);
						$('#img'+id).attr('height',height);
						$('#img'+id).attr('width',width);
					}
				}
                
               
            };
        } 
        
        reader.readAsDataURL(document.getElementById("file"+id).files[0]);
    }
}
function readURLDOC(width,height,id) {
    if (document.getElementById("file"+id).files && document.getElementById("file"+id).files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#img'+id).attr('src',base_url+'downloads/doc_icon.png' );
			$('#img'+id).attr('height',100);
			$('#img'+id).attr('width',100);
        }
        
        reader.readAsDataURL(document.getElementById("file"+id).files[0]);
    }
}
function showImage(id,width,height,size,type)
{
	
	var file = document.getElementById("file"+id).files[0];
	var sFileName = file.name;
    var sFileExtension = sFileName.split('.')[sFileName.split('.').length - 1].toLowerCase();
    var iFileSize = file.size;
    if((type == 'IMG') && (sFileExtension != "jpg" && sFileExtension != "jpeg" && sFileExtension != "png" && sFileExtension != "JPG" && sFileExtension != "JPEG" && sFileExtension != "PNG" ))
    {
		document.getElementById("divMessage"+id).innerHTML="Error : Invalid File Format";
		check_errors();
		//$('#btndocumentUpload').attr('disabled', true);
	}
	else if((type == 'DOC') && (sFileExtension != "pdf" && sFileExtension != "PDF"   && sFileExtension != "xls" && sFileExtension != "xlsx" && sFileExtension != "DOC"  && sFileExtension != "doc" && sFileExtension != "docx" && sFileExtension != "DOCX"))
	{
		document.getElementById("divMessage"+id).innerHTML="Error : Invalid File Format";
		check_errors();
		//$('#btndocumentUpload').attr('disabled', true);
		
	}
	else
	{
		
		if (sFileExtension == "jpg" || sFileExtension == "jpeg" || sFileExtension == "png")
		{ 
			if(iFileSize <= size*1024)
			{
			  	document.getElementById("divMessage"+id).innerHTML="";
			  	readURL(width,height,id);
				check_errors();
			  	
				/*$('#btndocumentUpload').attr('disabled', false);*/
			}
			else
			{
				
				//$('#btndocumentUpload').attr('disabled', true);
				document.getElementById("divMessage"+id).innerHTML="Error : File size exceeds "+size+" KB";
				$("#file"+id).val("");
				$('#img'+id).attr('src','');
				$('#img'+id).attr('height','0');
				$('#img'+id).attr('width','0');
				check_errors();
				
			}
	    }
		else if (sFileExtension == "pdf" || sFileExtension == "PDF"   || sFileExtension == "xls" || sFileExtension == "xlsx" || sFileExtension == "DOC"  || sFileExtension == "doc" || sFileExtension == "docx"|| sFileExtension == "DOCX")
		{ 
			if(iFileSize <= size*1024)
			{
			  	document.getElementById("divMessage"+id).innerHTML="";
			  	readURLDOC(width,height,id);
				check_errors();
				/*$('#btndocumentUpload').attr('disabled', false);*/
			}
			else
			{
				
				//$('#btndocumentUpload').attr('disabled', true);
				document.getElementById("divMessage"+id).innerHTML="Error : File size exceeds "+size+" KB";
				$("#file"+id).val("");
				$('#img'+id).attr('src','');
				$('#img'+id).attr('height','0');
				$('#img'+id).attr('width','0');
				check_errors();
			}
	    }
		else
		{
			document.getElementById("divMessage"+id).innerHTML="Error : Invalid File Format";
			//$('#btndocumentUpload').attr('disabled', true);
			$("#file"+id).val("");
			$('#img'+id).attr('src','');
			$('#img'+id).attr('height','0');
			$('#img'+id).attr('width','0');
			check_errors();
		}
	}
    
}
$(document).ready(function() {
	check_errors();
});
	
