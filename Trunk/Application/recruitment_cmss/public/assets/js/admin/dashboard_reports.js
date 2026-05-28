$(document).ready(function(){
	var program_code = $("#program_code").val();
	var base_url = $("#base_url").val();
	var selDate = $( "input[name='txtTransDate']" ).val();
	$("#btnExport").click(function(){
		window.open(base_url+"admin/excel_sc_st_obc/"+program_code,"winadmicardapplicant","left=0,top=0,width=1024,height=700,scrollbars=1,menubar=0,status=0,toolbar=0").focus();
	});
	$("#btnExportOnline").click(function(){
		window.open(base_url+"admin/excel_onlinepayment/"+program_code+"/"+selDate,"winadmicardapplicant","left=0,top=0,width=1024,height=700,scrollbars=1,menubar=0,status=0,toolbar=0").focus();
	});
}); 