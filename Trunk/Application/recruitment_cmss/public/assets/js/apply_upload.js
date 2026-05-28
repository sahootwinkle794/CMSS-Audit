function readURL(width,height,id) {
    if (document.getElementById("file"+id).files && document.getElementById("file"+id).files[0]) {
        var reader = new FileReader();
           
        reader.onload = function (e) {
            $('#img'+id).attr('src', e.target.result);
			$('#img'+id).attr('height',height);
			$('#img'+id).attr('width',width);
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
function showImage(id,width,height,size)
{
	var file = document.getElementById("file"+id).files[0];
	var sFileName = file.name;
    var sFileExtension = sFileName.split('.')[sFileName.split('.').length - 1].toLowerCase();
    var iFileSize = file.size;
    if (sFileExtension == "jpg" || sFileExtension == "jpeg" || sFileExtension == "png")
	{ 
		if(iFileSize <= size*1024)
		{
		  	document.getElementById("divMessage"+id).innerHTML="";
		  	readURL(width,height,id);
		}
		else
		{
			document.getElementById("divMessage"+id).innerHTML="Error : File size exceeds "+size+" KB";
			$("#file"+id).val("");
			$('#img'+id).attr('src','');
			$('#img'+id).attr('height','0');
			$('#img'+id).attr('width','0');
		}
    }
	else if (sFileExtension == "pdf" || sFileExtension == "PDF"   || sFileExtension == "xls" || sFileExtension == "xlsx" || sFileExtension == "DOC"  || sFileExtension == "doc" || sFileExtension == "docx"|| sFileExtension == "DOCX")
	{ 
		if(iFileSize <= size*1024)
		{
		  	document.getElementById("divMessage"+id).innerHTML="";
		  	readURLDOC(width,height,id);
		}
		else
		{
			document.getElementById("divMessage"+id).innerHTML="Error : File size exceeds "+size+" KB";
			$("#file"+id).val("");
			$('#img'+id).attr('src','');
			$('#img'+id).attr('height','0');
			$('#img'+id).attr('width','0');
		}
    }
	else
	{
		document.getElementById("divMessage"+id).innerHTML="Error : Invalid File Format";
		$("#file"+id).val("");
		$('#img'+id).attr('src','');
		$('#img'+id).attr('height','0');
		$('#img'+id).attr('width','0');
	}
}

/*$('#formApply').on('click', function (event) {
	
	
	
	});
*/	