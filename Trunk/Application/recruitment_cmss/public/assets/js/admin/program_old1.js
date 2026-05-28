$(document).ready(function(){
	var isDelete= false;
	var isEdit = false;
	var isPublish = false;
	var oTable;
	var isArchive = false;
	var session = $('#hidSessionCode').val();
	//alert(new Date().getFullYear());
	var programMaster = $('#tblProgramMaster').dataTable({
		"ajax":
		{
			"url": base_url+"/ajax_controller/get_program_table_data",
			"type": "POST",
			"data": ''
		},
		"bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth": false,
		/*"sDom":"<'row'<'col-xs-4 addCoursebtn'><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-9' <'row'<'col-xs-7 addCopybtn'> <'col-xs-5' i>>><'col-xs-3'p>>",*/
		"sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-7 institutegroupbutton' >>><'col-xs-6'p>>",
		"aoColumns": [
						{ "sName": "#", "sWidth": "3%" },
						{ "sName": "program_group", "sWidth": "12%" },
						{ "sName": "progcode", "bVisible":false },
						{ "sName": "program_name", "sWidth": "8%" },
						{ "sName": "program_desc", "bVisible":false },
						{ "sName": "program_duration","bVisible":false },
						{ "sName": "YEAR", "sWidth": "5%"},
						{ "sName": "sl_no", "bVisible":false },
						{ "sName": "File Name","sWidth":"10%"},/*"mRender": function( data, type, full ) {
							return '<a href="'+base_url+'Apply/'+data+'" target="_blank" style="color:blue">'+data+'</a>';
						} },*/
						{ "sName": "p_start_date","sWidth": "12%" },
						{ "sName": "p_end_date","sWidth": "10%" },
						{"sName": "publish_status","sClass": "alignCenter", "sWidth": "5%",
						"mRender": function( data, type, full ) {
							return '<img src="'+base_url+'public/assets/images/'+ data +'.png" ></img>';
						} 
						},
						{ "sName": "Action","sClass": "alignCenter",data:null,"sWidth": "10%", "sDefaultContent": "<button class='btn btn-warning  tooltipTable btn-circle' title='Edit' id = 'btnEditProgram' onclick='edit(event);'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button>&nbsp;&nbsp;<button id='btnDeleteProgram' title='Delete' class='btn btn-danger tooltipTable btn-circle' onclick='deleteRow(event);'><i class='fa fa-trash-o' aria-hidden='true'></i></button>&nbsp;&nbsp;<button id='btnPublish' title='Publish' class='btn btn-success tooltipTable btn-circle' onclick='publishRow(event);'><i class='fa fa-check' aria-hidden='true'></i></button>"},
						{ "sName": "Online Transaction No", "bVisible":false },
						{ "sName": "OMR No", "bVisible":false },
						{ "sName": "template_code","bVisible":false },
						{ "sName": "Apply Start Date","bVisible":false },
						{ "sName": "Apply End Date","bVisible":false },
						{ "sName": "Program Date", "bVisible":false },
						{ "sName": "Apply_Date", "bVisible":false},
						{ "sName": "program_code","bVisible":false },
						{ "sName": "elective_subjects","bVisible":false },
						{ "sName": "sequence_code","bVisible":false },
						{ "sName": "sequence_no","bVisible":false },
						{ "sName": "birth_start_date","bVisible":false },
						{ "sName": "birth_end_date","bVisible":false },
						{ "sName": "admitcard_start_date","bVisible":false },
						{ "sName": "admitcard_end_date","bVisible":false },
						{ "sName": "registration_template_code","bVisible":false },
						{ "sName": "registration_file_name","bVisible":false },
						{ "sName": "status","bVisible":false },
						{ "sName": "qualification","bVisible":false },
						{ "sName": "min_mark","bVisible":false }
						
						
        ],
        "fnDrawCallback": function(oSettings, json) 
       	{
     		$('.tooltipTable').tooltipster( {
	         	theme: 'tooltipster-punk',
	      		animation: 'grow',
	        	delay: 200, 
	         	touchDevices: false,
	         	trigger: 'hover'
      		} );          
  		}
	});
	/*$("div.addCoursebtn").html('<button id="btnAddProgram" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>&nbsp;</div>');*/
	/*$("div.addCoursebtn").html('<button class="btn btn-info tooltips btn-circle" title="Add" id="btnAddProgram"><i class="fa fa-plus" aria-hidden="true"></i></button>');*/
	/*$("div.addCopybtn").html('<button type="submit" class="btn btn-success tooltips" id="btnCopyProgram" title="Copy"><i class="fa fa-files-o" aria-hidden="true">&nbsp;Copy</i></button>&nbsp;&nbsp;');*/
	/*$("div.addCopybtn").html('<button id="btnCopyProgram" class="btn btn-success"><i class="fa fa-files-o" aria-hidden="true"></i>&nbsp; Copy</button>&nbsp;</div>');*/
	$("div.institutegroupbutton").html('<button id="btnAddProgram" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>&nbsp;<button class="btn btn-primary" id="btnCopyProgram"><i class="fa fa-edit"></i> Copy</button></div>');
	var programMaster_old = $('#tblProgramMasterOld').dataTable({
		"ajax":
		{
			"url": base_url+"/ajax_controller/SELECT_OLD",
			"type": "POST",
			"data": ''
		},
		"bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
		"bDestroy":false,
        "bInfo": true,
        "bAutoWidth": false,
		"sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-6 addArchivebtn' >>><'col-xs-6'p>>",
		"aoColumns": [
						 
	                     { "sName": "#", "sWidth": "5%" },
	                     { "sName": "program_group", "sWidth": "12%" },
	                     { "sName": "progcode", "bVisible":false },
	                     { "sName": "program_name", "sWidth": "10%" },
	                     { "sName": "year", "sWidth": "5%"},
						 { "sName": "sl_no", "bVisible":false },
						 { "sName": "File Name","sWidth":"10%"},/*,"mRender": function( data, type, full ) {
							return '<a href="'+base_url+'Apply/'+data+'" target="_blank" style="color:blue">'+data+'</a>';
						} },*/
						 { "sName": "p_start_date","sWidth": "12%" },
						 { "sName": "p_end_date","sWidth": "10%" },
						 {"sName": "publish_status","sClass": "alignCenter", "sWidth": "5%",
						    "mRender": function( data, type, full ) {
				                return '<img src="'+base_url+'public/assets/images/'+ data +'.png" ></img>';
				            } 
						 },
						 { "sName": "Action","sClass": "alignCenter",data:null,"sWidth": "10%", "sDefaultContent": "<button class='btn btn-warning  tooltipTable btn-circle' title='Edit' id = 'btnEditProgramOld' onclick='editold(event);'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button>&nbsp;&nbsp;<button id='btnDeleteProgramOld' title='Delete' class='btn btn-danger tooltipTable btn-circle' onclick='deleteRowold(event);'><i class='fa fa-trash-o' aria-hidden='true'></i></button>"},
						 { "sName": "Online Transaction No", "bVisible":false },
						 { "sName": "OMR No", "bVisible":false },
						 { "sName": "template_code","bVisible":false },
						 { "sName": "Apply Start Date","bVisible":false },
						 { "sName": "Apply End Date","bVisible":false },
						 { "sName": "Program Date", "bVisible":false },
						 { "sName": "Apply_Date", "bVisible":false},
	                     { "sName": "program_code","bVisible":false },
						 { "sName": "elective_subjects","bVisible":false },
						 { "sName": "sequence_code","bVisible":false },
						 { "sName": "sequence_no","bVisible":false },
						 { "sName": "birth_start_date","bVisible":false },
						 { "sName": "birth_end_date","bVisible":false },
						 { "sName": "admitcard_start_date","bVisible":false },
						 { "sName": "admitcard_end_date","bVisible":false },
						 { "sName": "registration_template_code","bVisible":false },
						 { "sName": "status","bVisible":false },
						 { "sName": "qualification","bVisible":false },
						 { "sName": "min_mark","bVisible":false }
        ],
        "fnDrawCallback": function(oSettings, json) 
       	{
     		$('.tooltipTable').tooltipster( {
	         	theme: 'tooltipster-punk',
	      		animation: 'grow',
	        	delay: 200, 
	         	touchDevices: false,
	         	trigger: 'hover'
      		} );          
  		}
	});
	//$("div.addArchivebtn").html('<button type="submit" class="btn btn-success tooltips" id="btnArchiveProgram" title="Archive"><i class="fa fa-file-archive-o" aria-hidden="true">&nbsp;Archive</i></button>&nbsp;&nbsp;');
	load_old_table();
	//load_additional_table();
	var programAdditional = $('#tblProgramAdditional').dataTable({
		"ajax":
		{
			"url": base_url+"/ajax_controller/get_program_additional_data",
			"type": "POST",
			"data": ''
		},
		"bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bDestroy":true,
        "bInfo": true,
        "bAutoWidth": false,
		/*"sDom":"<'row'<'col-xs-4 addAdditionalbtn'><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-9' <'row'<'col-xs-7'> <'col-xs-5' i>>><'col-xs-3'p>>",*/
		"sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-7 addAdditionalbtn' >>><'col-xs-6'p>>", 
		"aoColumns": [
						{ "sName": "#", "sWidth": "5%" },
						{ "sName": "program_code", "bVisible":false },
						{ "sName": "program_name", "sWidth": "15%" },
						{ "sName": "classifiction", "sWidth": "15%"  },
						{ "sName": "ministry","sWidth": "15%"  },
						{ "sName": "department", "sWidth": "15%"},
						{ "sName": "organisation", "sWidth": "15%"},
						{ "sName": "pay_scale", "bVisible":false },
						{ "sName": "age", "bVisible":false },
						{ "sName": "qualification", "bVisible":false },
						{ "sName": "desirable_qualification", "bVisible":false },
						{ "sName": "duties", "bVisible":false },
						{ "sName": "probotion_period", "bVisible":false },
						{ "sName": "head_quarter", "bVisible":false },
						{ "sName": "other_detail", "bVisible":false },
						{ "sName": "link", "sWidth": "10%","sClass":"alignCenter", "data":null, "sDefaultContent": "<button  type = 'button' class='btn btn-info btn-sm btn-circle tooltipTable' onclick='viewLatestInformation(event)' title='View' ><i class='fa fa-info-circle'></i></button>" },
						{ "sName": "link_path", "bVisible":false },
						{ "sName": "Action","sClass": "alignCenter",data:null,"sWidth": "12%", "sDefaultContent": "<button class='btn btn-warning  tooltipTable btn-circle' title='Edit' id = 'btnEditAdditional' onclick='edit_additional(event);'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button>&nbsp;<button id='btnDeleteAdditional' title='Delete' class='btn btn-danger tooltipTable btn-circle' onclick='deleteRowAdditional(event);'><i class='fa fa-trash-o' aria-hidden='true'></i></button>"},
						
						
        ],
        "fnDrawCallback": function(oSettings, json) 
       	{
     		$('.tooltipTable').tooltipster( {
	         	theme: 'tooltipster-punk',
	      		animation: 'grow',
	        	delay: 200, 
	         	touchDevices: false,
	         	trigger: 'hover'
      		} );          
  		}
	});
	$("div.addAdditionalbtn").html('<button id="btnAddAdditional" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>&nbsp;</div>');
	/*$("div.addAdditionalbtn").html('<button class="btn btn-info tooltips btn-circle" title="Add" id="btnAddAdditional"><i class="fa fa-plus" aria-hidden="true"></i></button>');*/
	$('#btnAddAdditional').click(function(){
		$('#cmbAdditionalProgram').prop('disabled', false);
		$('#frmAdditionalData').data('bootstrapValidator').resetForm(true);//Reseting the tick marks before opening add modal	
		$('#hidUniqueidAdditional').val("");
		$('#txtClassification').val("");
		$('#txtMinistry').val("");
		$('#txtDepartment').val("");
		$('#txtOrganisation').val("");
		$('#txtPayScale').val("");
		$('#txtAge').val("");
		$('#txtEsQualification').val("");
		$('#txtDesireQualification').val("");
		$('#radioUpload').attr('checked',false);
		$('#divUpload').hide();
		$('#divWrite').hide();
		$('#txtDuties').val("");
		$('#txtProbPeriod').val("");
		$('#txtHeadQuarter').val("");
		$('#txtOtherDetail').val("");
		
		$('#programAdditionalModal').modal('show');
		$('#programAdditionalModal').on('shown.bs.modal', function () 
		{ 
			$('#txtClassification').focus(); // Focusing the textbox
		})
	});
/*****AJAX CALL TO GET DATA FROM DATABASE(FOR SELECT OPTIONS)**********/
	// get group name from database
	$.ajax({
		url:base_url+"ajax_controller/select_cmbgroup_data",
		type:"post",
		success:function(response){  
			var options = "<option value=''>Select</option>";
			var res1 = JSON.parse(response);
			$.each(res1.aaData,function(i,data){
				options = options + "<option value='"+data.program_group_code+"'>"+data.program_group_name+"</option>";
				
			});
			$('#cmbProgramGroup').html("");   //campusid from academicPeriod
			$('#cmbProgramGroup').append(options);
			$('#cmbProgramGroupCopy').html("");   //campusid from academicPeriod
			$('#cmbProgramGroupCopy').append(options);
			$('#cmbProgramGroupEdit').html("");   //campusid from academicPeriod
			$('#cmbProgramGroupEdit').append(options);		
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
	
	// get template code from database
	$.ajax({
		url:base_url+"ajax_controller/select_cmbtemplate_data",
		type:"post",
		success:function(response){  
			var options = "<option value=''>Select</option>";
			//alert(response);
			var res1 = JSON.parse(response);
			$.each(res1.aaData,function(i,data){
				options = options + "<option value="+data.template_code+">"+data.template_name+"</option>";
				
			});
			$('#cmbTemplate').html("");   //campusid from academicPeriod
			$('#cmbTemplate').append(options);
			
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
	$.ajax({
		url:base_url+"ajax_controller/select_program_qualification",
		type:"post",
		success:function(response){  
			var options = "<option value=''>Select</option>";
			//alert(response);
			var res1 = JSON.parse(response);
			$.each(res1.aaData,function(i,data){
				options = options + "<option value="+data.qualification_code+">"+data.qualification_name+"</option>";
				
			});
			$('#cmbProgramQualification').html("");   //campusid from academicPeriod
			$('#cmbProgramQualification').append(options);
			$('#cmbProgramQualificationEdit').html("");   //campusid from academicPeriod
			$('#cmbProgramQualificationEdit').append(options);
			
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
	$.ajax({
		url:base_url+"ajax_controller/select_cmbtemplate_data",
		type:"post",
		success:function(response){  
			var options = "<option value=''>Select</option>";
			var res1 = JSON.parse(response);
			$.each(res1.aaData,function(i,data){
				options = options + "<option value="+data.template_code+">"+data.template_name+"</option>";
				
			});
			$('#cmbTemplateEdit').html("");   //campusid from academicPeriod
			$('#cmbTemplateEdit').append(options);
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
	$.ajax({
		url:base_url+"ajax_controller/select_cmbtemplate_reg_data",
		mType:"get",
		success:function(response){  
			var options = "<option value=''>Select</option>";
			var res1 = JSON.parse(response);
			$.each(res1.aaData,function(i,data){
				options = options + "<option value="+data.template_code+">"+data.template_name+"</option>";
				
			});
			$('#cmbRegistrationTemplate').html("");   //campusid from academicPeriod
			$('#cmbRegistrationTemplate').append(options);		
			$('#cmbRegistrationTemplateEdit').html("");   //campusid from academicPeriod
			$('#cmbRegistrationTemplateEdit').append(options);		
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
	$.ajax({
		"url": base_url+"/ajax_controller/get_program_table_data",
		type:"POST",
		data : '',
		success:function(response)
		{
			//alert("hello");  				
			var res1 = JSON.parse(response);					
			var options = "<option value=''>Select</option>";
		    $.each(res1.aaData,function(i,data)
		    {
		    	options = options + "<option value='"+data.program_code+"'>"+data.program_name+"</option>";
		    });
		    $('#cmbAdditionalProgram').html("");   
			$('#cmbAdditionalProgram').append(options);
			$('#cmbAdditionalProgram').html(options);	
		},
		error:function()
		{
			toastr.error("We are unable to Process.Please contact Support");
		}
	});		
	// FOR EDIT BUTTON(select from database)
	// get template code from database
	/*$.ajax({
		url:base_url+"ajax_controller/select_template_data",
		type:"pos",
		data:{type:"SELECT",_s:session},
		success:function(response){  
			var options = "";
			var res1 = JSON.parse(response);
			$.each(res1.aaData,function(i,data){
				options = options + "<option value="+data.template_code+">"+data.template_name+"</option>";
			});
			$('#cmbTemplateEdit').html("");   //campusid from academicPeriod
			$('#cmbTemplateEdit').append(options);		
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});*/
					
/*****END OF AJAX CALL TO GET DATA FROM DATABASE**********/
//*** *********** CHANGE BY ME*************************
	$('#btnAddProgram').click(function(){
		$('#frmAddProgram').data('bootstrapValidator').resetForm(true);//Reseting the tick marks before opening add modal	
		$('#txtProgramCode').val("");
		$('#cmbProgramGroup').val("");
		$('#taElectiveSubjects').val("");
		$('#txtProgramName').val("");
		//$('#txtYear').val("");
		$('#txtSlno').val("");
		$('#txtOnlineTransactionNo').val("");
		//$('#txtOmrNo').val("");
		$('#cmbStatus').val("");
		$('#cmbTemplate').val("");
		$('#txtProgramDate').val("");
		$('#txtAppDate').val("");
		$('#txtStartdate').val("");
		$('#txtAdmitCardEnddate').val("");
		$('#txtAdmitCardStartdate').val("");
		$('#txtEnddate').val("");
		$('#txtAgeStartdate').val("");
		$('#txtAgeEnddate').val("");
		$('#txtSeqCode').val("");
		$('#txtSeqno').val("");
		$("#txtYear").val(new Date().getFullYear());
		$("#txtOmrNo").val('001');
		$('#programAddModal').modal('show');
		$('#programAddModal').on('shown.bs.modal', function () 
		{ 
			$('#txtProgramCode').focus(); // Focusing the textbox
		})
	});
	$('#btnCopyProgram').click(function(){
		$('#frmCopyProgram').data('bootstrapValidator').resetForm(true);//Reseting the tick marks before opening add modal	
		$('#txtProgramCodeCopy').val("");
		$('#cmbProgramGroupCopy').val("");
		$('#txtProgramNameCopy').val("");
		$('#cmbCopyFrom').val("");
		$('#txtStartdateCopy').val("");
		$('#txtEnddateCopy').val("");
		$('#txtAgeStartdateCopy').val("");
		$('#txtAdmitCardStartdateCopy').val("");
		$('#txtAdmitCardEnddateCopy').val("");
		$('#txtAgeEnddateCopy').val("");
		$('#txtAppEnddateCopy').val("");
		$('#programCopyModal').modal('show');
		$('#programCopyModal').on('shown.bs.modal', function () 
		{ 
			$('#txtProgramCode').focus(); // Focusing the textbox
		})
		select_program();
		select_program_group();
	});
	
	$('#tblProgramMaster tbody').on('click', function (event) {	
		isPublish = true;	
		$('#spanLoadMenu').show();
		$('#spanProgramMenu').hide();
		$('#spanActiveProgramMenu').hide();
		$('#spanShowProgramMenu').hide();
		$('#spanLoadFee').show();
		$('#spanProgramFee').hide();
		$('#spanLoadDocument').show();
		$('#spanProgramDocuments').hide();
		$('#spanLoadCategory').show();
		$('#spanProgramCategory').hide();
		$('#spanLoadExamCentre').show();
		$('#spanProgramExamCentre').hide();
		$('#spanLoadCategory').show();
		$('#spanProgramCategory').hide();
		$('#spanLoadSms').show();
		$('#spanProgramSms').hide();
		$('#spanLoadChallan').show();
		$('#spanProgramChallan').hide();
			
			$(programMaster.fnSettings().aoData).each(function (){
			$(this.nTr).removeClass('success');
			
		});
   		/*$('#frmProgramEdit').bootstrapValidator('resetForm', true);
		$('#frmProgramEdit').data('bootstrapValidator').resetForm(true);*/
		//alert(event.target.parentNode.parentNode);
		
		
		if(event.target.tagName == "BUTTON" || event.target.tagName == "A" || event.target.tagName == "IMG")
	  		row = event.target.parentNode.parentNode;
		else if(event.target.tagName == "I")
	  		row = event.target.parentNode.parentNode.parentNode; 
	  	else
	  		row = event.target.parentNode;
		$(row).addClass('success');
		var programCode = programMaster.fnGetData( event.target.parentNode )[2];//GETTING DATA FOR HIDDEN COLUMN
		/*$('#publishDrive').html('<i>'+programMaster.fnGetData( event.target.parentNode )[1]+'</i>');
		$('#publishName').html('<i>'+programMaster.fnGetData( event.target.parentNode )[3]+'</i>');
		$('#publishDesc').html('<i>'+programMaster.fnGetData( event.target.parentNode )[4]+'</i>');
		$('#publishAppFrom').html('<i>'+programMaster.fnGetData( event.target.parentNode )[9]+'</i>');
		$('#publishAppTo').html('<i>'+programMaster.fnGetData( event.target.parentNode )[10]+'</i>');
		$('#publishStatus').html('<i>'+programMaster.fnGetData( event.target.parentNode )[27]+'</i>');
		$('#publishPostFrom').html('<i>'+programMaster.fnGetData( event.target.parentNode )[15]+'</i>');
		$('#publishPostTo').html('<i>'+programMaster.fnGetData( event.target.parentNode )[16]+'</i>');
		
		if(programMaster.fnGetData( event.target.parentNode )[24] == null)
		{
			$('#publishBirthFrom').html('-');
		}
		else
		{
			$('#publishBirthFrom').html('<i>'+programMaster.fnGetData( event.target.parentNode )[24]+'</i>');
		}
		if(programMaster.fnGetData( event.target.parentNode )[25] == null)
		{
			$('#publishBirthTo').html('-');
		}
		else
		{
			$('#publishBirthTo').html('<i>'+programMaster.fnGetData( event.target.parentNode )[25]+'</i>');
		}
		
		var programCode = programMaster.fnGetData( event.target.parentNode )[2];//GETTING DATA FOR HIDDEN COLUMN
		var programstartdate = programMaster.fnGetData( event.target.parentNode )[8];
		var programenddate = programMaster.fnGetData( event.target.parentNode )[9];
		var applystartdate = programMaster.fnGetData( event.target.parentNode )[11];
		var applyenddate = programMaster.fnGetData( event.target.parentNode )[12];
		var template_code = programMaster.fnGetData( event.target.parentNode )[15];
		var sequence_code = programMaster.fnGetData( event.target.parentNode )[19];
		var sequence_no = programMaster.fnGetData( event.target.parentNode )[20];
		var birthstartdate = programMaster.fnGetData( event.target.parentNode )[21];
		var birthenddate = programMaster.fnGetData( event.target.parentNode )[22];
		
		$('#hidUniqueidEdit').val(programCode);*/
		$('#hidProgram').val(programCode);
		countProgramMenu(programCode);
		countActiveProgramMenu(programCode);
		countShowProgramMenu(programCode);
		$('#spanLoadMenu').hide();
		$('#spanProgramMenu').show();
		$('#spanActiveProgramMenu').show();
		$('#spanShowProgramMenu').show();
		countZeroFeeCategory(programCode);
		countInactiveDocuments(programCode);
		countChallan(programCode);
		countExamCentre(programCode);
		countInActiveSmsType(programCode);
		countInActiveCategory(programCode);
	});
	
	$('#btnPublishProgram').click(function(){
		if(isPublish)
		{
			$('#programPublishModal').modal('show');
			$('#programPublishRecord').click(function()
			{
				$('#programPublishModal').modal('hide');		
				var institutedata=
				{
					programCode:$('#hidUniqueidEdit').val()
				};		
				//ajax call to server
				$.ajax({
					url:base_url+"ajax_controller/publish",
					type:"post",
					data:institutedata,
					success:function(response)
					{  
						var result = JSON.parse(response);
						if(result.status=='SUCCESS')
						{
							var dtblProgram = $("#tblProgramMaster").DataTable();
							dtblProgram.ajax.reload();
							toastr.success(result.msg);	
							isPublish= false;
						}
						else
						{
							toastr.error(result.msg);
							var dtblProgram = $("#tblProgramMaster").DataTable();
							dtblProgram.ajax.reload();
							isPublish= false;
						}
					},
					error:function()
					{
						toastr.error('Unable to process please contact support');
					}
				});		
			});
		}
		else{
			toastr.error("Please Select a record");
		}
	});
	
	$('#programPublishModal').on('hidden.bs.modal', function (e) {
 		$('#frmProgramPublish').data('bootstrapValidator').resetForm(true);
 		$(programMaster.fnSettings().aoData).each(function ()
		{
			$(this.nTr).removeClass('success');
		});
		isPublish= false;
	})
	$('#tblProgramMasterOld tbody').on('click', function (event) {
		$(programMaster_old.fnSettings().aoData).each(function (){
			$(this.nTr).removeClass('success');
		});	
		isArchive = true;	
		if(event.target.tagName == "BUTTON" || event.target.tagName == "A" || event.target.tagName == "IMG")
	  		row = event.target.parentNode.parentNode;
		else if(event.target.tagName == "I")
	  		row = event.target.parentNode.parentNode.parentNode; 
	  	else
	  		row = event.target.parentNode;
		$(row).addClass('success');
		var programCode = programMaster_old.fnGetData( event.target.parentNode )[2];//GETTING DATA FOR HIDDEN COLUMN	
		$("#hidProgram12").val(programCode);
	});
	$('#btnArchiveProgram').click(function(){
		if(isArchive)
		{
		  	swal({
				title: "Are you sure?",
				text: "You want to move the program to archive !",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Yes, Archive it!",
				cancelButtonText: "No, cancel",
				closeOnConfirm: false,
				closeOnCancel: true
			},
			function(isConfirm){
				if (isConfirm) {
					archive_program();
					swal("Archiving", "Program has been moving to archive.", "success");
				} else {
					swal("Cancelled", "Not moved ", "error");
				}
			});
		    function archive_program(){
				var program = $('#hidProgram12').val();
				var institutedata=
				{
					program_code:program
				};			
				//ajax call to server
				$.ajax({
					url:base_url+"ajax_controller/archieve",
					type:"post",
					data:institutedata,
					success:function(response)
					{  
						var res = JSON.parse(response); 
						if(res.dbStatus == 'SUCCESS')
						{
							toastr.success(res.dbMessage);
							load_old_table();
						}
						else
						{
							toastr.error(res.dbMessage);
						}				 
					},
					error:function()
					{
						toastr.error('Unable to process please contact support');
					}
				});	
			}
		}
		else{
			toastr.error("Please Select a record");
		}
	});
	var param ="";
	
	$("input[type='radio']").change(function(){
		if($(this).val()=="PDF")
		{
		    $("#divUpload").show();
		    $("#divWrite").hide(); 
		    
		}
		else
		{
		     $("#divWrite").show(); 
		     $("#divUpload").hide(); 
		}
	});
	//ADD RECORD WITH VALIDATION
	$('#frmAddProgram').bootstrapValidator({
		message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton) 
		{
			/*txtAppStartdate=$("#txtAppDate").val();
		    txtEligibledate=$("#txtEligibleDate").val();
		    txtProgramdate=$("#txtProgramDate").val();
		    alert($('#txtAgeStartdate').val());
		    alert($('#txtAgeEnddate').val());*/
		   var txtAgeStartdate = $('#txtAgeStartdate').val();
			var newdate = txtAgeStartdate.split("-").reverse().join("-");
			var txtAgeEnddate = $('#txtAgeEnddate').val();
			var newdate1 = txtAgeEnddate.split("-").reverse().join("-");
			date1 = new Date(newdate);
			date2 = new Date(newdate1);
		
			if(date1 >= date2)
			{
				toastr.error('Birth start date should be greater than birth end date');
			}
		    var year = new Date().getFullYear();
			$("#txtYear").val(year);
			$("#txtOmrNo").val('001');
			$("#spanProcessingProgram").show();
			var institutedata={
				cmbProgramGroup:$('#cmbProgramGroup').val(),
				txtProgramCode:$('#txtProgramCode').val(),
				txtProgramName:$('#txtProgramName').val(),
				txtYear:$('#txtYear').val(),
				txtSlno:$('#txtSlno').val(),
				txtSeqCode:$('#txtSeqCode').val(),
				txtSeqno:$('#txtSeqno').val(),
				taElectiveSubjects:$('#taElectiveSubjects').val(),
				taProgramDescription:$('#taProgramDescription').val(),
				txtProgramDuration:$('#txtProgramDuration').val(),
				txtOnlineTransactionNo:$('#txtOnlineTransactionNo').val(),
				txtOmrNo:$('#txtOmrNo').val(),
				cmbStatus:$('#cmbStatus').val(),
				cmbRegistrationTemplate:$('#cmbRegistrationTemplate').val(),
				cmbTemplate:$('#cmbTemplate').val(),
				//***************************CHANGED**********************************
				txtStartdate:$('#txtStartdate').val(),
				txtEnddate:$('#txtEnddate').val(),
				txtAgeStartdate:$('#txtAgeStartdate').val(),
				txtAgeEnddate:$('#txtAgeEnddate').val(),
				txtAppStartdate:$('#txtAppStartdate').val(),
				txtAppEnddate:$('#txtAppEnddate').val(),
				txtAdmitCardStartdate:$("#txtAdmitCardStartdate").val(),
				txtAdmitCardEnddate:$("#txtAdmitCardEnddate").val(),
				cmbProgramQualification:$("#cmbProgramQualification").val(),
				txtPercenatge:$("#txtPercenatge").val(),
				/*txtStartdate:$("#txtProgramDate").val(),
				txtEligibledate:$("#txtEligibleDate").val(),
				txtAppStartdate:$("#txtAppDate").val(),*/
				hidCsrfToken:$("#hidCsrfToken").val()
			};
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/insert_program_data",
				type:"post",
				data:institutedata,
				success:function(response){  
					var result = JSON.parse(response);
					var isPublish = false;
					if(result.dbStatus=='SUCCESS')
					{
						$("#spanProcessingProgram").hide();
						var dtblProgram = $("#tblProgramMaster").DataTable();
						load_old_table();
			 			dtblProgram.ajax.reload();
			 			$('#frmAddProgram').data('bootstrapValidator').resetForm(true);	
						$('#txtProgramCode').val("");
						$('#cmbProgramGroup').val("");
						$('#taElectiveSubjects').val("");
						$('#taProgramDescription').val("");
						$('#taProgramDescription').val("");
						$('#txtProgramName').val("");
						$('#txtYear').val("");
						$('#txtSlno').val("");
						$('#txtOnlineTransactionNo').val("");
						$('#txtOmrNo').val("");
						$('#cmbStatus').val("");
						$('#cmbTemplate').val("");
						$('#txtStartdate').val("");
						$('#txtEnddate').val("");
						$('#txtAgeStartdate').val("");
						$('#txtAgeEnddate').val("");
						$('#txtAppStartdate').val("");
						$('#txtAppEnddate').val("");
						$('#cmbProgramQualification').val("");
						$('#txtPercenatge').val("");
						
						/*$('#txtProgramDate').val("");
						$('#txtAppDate').val("");
						$('#txtStartdate').val("");
						$('#txtEnddate').val("");
						$('#txtAgeStartdate').val("");
						$('#txtAgeEnddate').val("");*/
						$('#txtSeqCode').val("");
						$('#txtSeqno').val("");
						$.ajax({
							"url": base_url+"/ajax_controller/get_program_table_data",
							type:"POST",
							data : '',
							success:function(response)
							{  				
								var res1 = JSON.parse(response);					
								var options = "<option value=''>Select</option>";
							    $.each(res1.aaData,function(i,data)
							    {
							    	options = options + "<option value='"+data.program_code+"'>"+data.program_name+"</option>";
							    });
							    $('#cmbAdditionalProgram').html("");   
								$('#cmbAdditionalProgram').append(options);
							},
							error:function()
							{
								toastr.error("We are unable to Process.Please contact Support");
							}
						});
						toastr.success(result.dbMessage);	
					}
					else
					{
						toastr.error(result.dbMessage);
						$("#spanProcessingProgram").hide();
						var dtblProgram = $("#tblProgramMaster").DataTable();
						load_old_table();
			 			dtblProgram.ajax.reload();
			 			$('#frmAddProgram').data('bootstrapValidator').resetForm(true);	
					}			
				},
				error:function(){
					toastr.error('Unable to process please contact support');
				}
			});//end of ajax call	
		},
		fields: {
			txtProgramCode: {							//form input type name
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
					regexp: {
						regexp: /^([A-Za-z0-9\s]+)$/i,
						message: "Special characters are not allowed"
					},
					stringLength: {
						max: 8,
						message: 'Code should not be more then 8 characters'
						}
				}
			},
			txtProgramName: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
					regexp: {
						regexp: /^([A-Za-z0-9\s]+)$/i,
						message: "Special characters are not allowed"
					}
				}
			},
			cmbProgramGroup: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			txtYear: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
					digits: {
					message: 'The value can contain only digits'
					},
					stringLength: {
						min: 4,
						max: 4,
						message: 'Year should not be more then 4 characters'
						}
				}
			},
			cmbProgramQualification: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			txtPercenatge: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
					digits: {
					message: 'The value can contain only digits'
					},
					lessThan: {
                        value: 101,
                        message: 'must be less than or equal to 100'
                    }
               }
			},
			txtSlno: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
					digits: {
					message: 'The value can contain only digits'
					}
				}
			},
			txtOnlineTransactionNo: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
					digits: {
					message: 'The value can contain only digits'
					}
				}
			},
			txtOmrNo: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
					digits: {
					message: 'The value can contain only digits'
					}
				}
			},
			txtProgramDuration: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
					digits: {
					message: 'The value can contain only digits'
					}
				}
			},
			cmbStatus: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			cmbRegistrationTemplate: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			cmbTemplate: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			txtStartdate: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			txtEnddate: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			txtAppStartdate: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			txtAppEnddate: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			txtAdmitCardEnddate: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			txtAdmitCardStartdate: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			}
		}
	});
	$('#frmAdditionalData').bootstrapValidator({
		message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton) 
		{
			/*txtAppStartdate=$("#txtAppDate").val();
		    txtEligibledate=$("#txtEligibleDate").val();
		    txtProgramdate=$("#txtProgramDate").val();*/
		    var formData = new FormData(document.getElementById("frmAdditionalData"));
			$("#spanProcessingProgram").show();
			
			var unique_key = $("#hidUniqueidAdditional").val();
			
			if(unique_key != '' && unique_key != 'undefined')
			{
				var action = 'update_additional_data';
			}
			else
			{
				var action = 'insert_additional_data';
			}
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/"+action,
				type:"post",
				data:formData,
				cache: false,
		        contentType: false,
		        processData: false,
				success:function(response){  
					var result = JSON.parse(response);
					if(result.status=='SUCCESS')
					{
						$("#spanProcessingProgram").hide();
						
						load_additional_table();
			 			if(unique_key != '' && unique_key != 'undefined')
						{
							$('#programAdditionalModal').modal('hide');
						}
			 			$('#frmAdditionalData').data('bootstrapValidator').resetForm(true);//Reseting the tick marks before opening add modal	
						$('#hidUniqueidAdditional').val("");
						$('#radioUpload').attr('checked',false);
						$('#txtClassification').val("");
						$('#txtMinistry').val("");
						$('#txtDepartment').val("");
						$('#txtOrganisation').val("");
						$('#txtPayScale').val("");
						$('#txtAge').val("");
						$('#txtEsQualification').val("");
						$('#txtDesireQualification').val("");
						$('#txtDuties').val("");
						$('#txtProbPeriod').val("");
						$('#txtHeadQuarter').val("");
						$('#txtOtherDetail').val("");
						toastr.success(result.msg);	
						
					}
					else
					{
						toastr.error(result.msg);
						$("#spanProcessingProgram").hide();
						var dtblProgram = $("#tblProgramMaster").DataTable();
						load_old_table();
			 			dtblProgram.ajax.reload();
			 			$('#frmAddProgram').data('bootstrapValidator').resetForm(true);	
					}			
				},
				error:function(){
					toastr.error('Unable to process please contact support');
				}
			});//end of ajax call	
		},
		fields: {
			cmbAdditionalProgram: {							//form input type name
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			radioUpload: {							//form input type name
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			filePdf: {							//form input type name
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
					file: {
	          			extension: 'pdf', 
	          			type: 'application/pdf',
	          			maxSize: 1024*1024,  //for 5mb
	         	 		message: 'The selected file is not valid, it should be pdf and maximum 1MB.'
	    			}
				}
			},
			
		}

	});
	$('#frmCopyProgram').bootstrapValidator({
		excluded: [':disabled'],
		message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton) 
		{	
			var txtAgeStartdate = $('#txtAgeStartdate').val();
			var newdate = txtAgeStartdate.split("-").reverse().join("-");
			var txtAgeEnddate = $('#txtAgeEnddate').val();
			var newdate1 = txtAgeEnddate.split("-").reverse().join("-");
			date1 = new Date(newdate);
			date2 = new Date(newdate1);
		
			if(date1 >= date2)
			{
				toastr.error('Eligibility From date should be greater than Eligibility Upto date');
			}
			//alert($('#cmbCopyFrom').val());
			$("#spanProcessingProgram").show();
			var institutedata={
				cmbProgramGroupCopy:$('#cmbProgramGroupCopy').val(),
				txtProgramNameCopy:$('#txtProgramNameCopy').val(),
				cmbCopyFrom:$('#cmbCopyFrom').val(),
				txtStartdateCopy:$('#txtStartdateCopy').val(),
				txtAdmitCardEnddateCopy:$('#txtAdmitCardEnddateCopy').val(),
				txtAdmitCardStartdateCopy:$('#txtAdmitCardStartdateCopy').val(),
				txtAgeStartdateCopy:$('#txtAgeStartdateCopy').val(),
				txtAgeEnddateCopy:$('#txtAgeEnddateCopy').val(),
				txtEnddateCopy:$('#txtEnddateCopy').val(),
				txtAppStartdateCopy:$('#txtAppStartdateCopy').val(),
				txtAppEnddateCopy:$('#txtAppEnddateCopy').val()
			};
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/insert_copy_data",
				type:"post",
				data:institutedata,
				success:function(response){ 
					$("#spanProcessingProgram").hide(); 
					var result = JSON.parse(response);
					if(result.dbStatus=='SUCCESS')
					{
						var dtblProgram = $("#tblProgramMaster").DataTable();
			 			dtblProgram.ajax.reload();
			 			$('#frmCopyProgram').data('bootstrapValidator').resetForm(true);	
						toastr.success(result.dbMessage);
					}
					else
					{
						toastr.error(result.dbMessage);
						var dtblProgram = $("#tblProgramMaster").DataTable();
			 			dtblProgram.ajax.reload();
			 			$('#frmCopyProgram').data('bootstrapValidator').resetForm(true);
			 			$('#txtAgeStartdateCopy').val("");
			 			$('#txtAgeEnddateCopy').val("");
					}
				},
				error:function(){
					toastr.error('Unable to process please contact support');
				}
			});//end of ajax call
			select_program();
			select_program_group();	
		},
		fields: {
			txtProgramCodeCopy: {							//form input type name
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
					regexp: {
						regexp: /^([A-Za-z0-9\s]+)$/i,
						message: "Special characters are not allowed"
					},
					stringLength: {
						max: 8,
						message: 'Code should not be more then 8 characters'
					}
				}
			},
			txtProgramNameCopy: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			txtStartdateCopy: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			txtEnddateCopy: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			txtAppStartdateCopy: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			txtAppEnddateCopy: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			txtAdmitCardStartdateCopy: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			txtAdmitCardEnddateCopy: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			cmbCopyFrom: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			cmbProgramGroupCopy: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			}
		}
	});
	
	/*Select Year*/
	$('#old_tab').click(function(){
		$.ajax({
			url:base_url+"ajax_controller/select_year",
			mType:"get",
			success:function(response){  
				var options = "<option value =''>Select</option>";
				var res1 = JSON.parse(response);
				$.each(res1.aaData,function(i,data){
					options = options + "<option value="+data.year+">"+data.year+"</option>";
					
				});
				$('#cmbYear').html("");   //campusid from academicPeriod
				$('#cmbYear').append(options);	
			},
			error:function(){
				toastr.error("We are unable to Process.Please contact Support");
			}
		});	
	});	
	$('#btnView').click(function(){
		var template = $('#cmbTemplate').val();
		var institutedata = {
		template_code: template
		};
		
		if(template == '')
		{ 
			toastr.error('Please Select a Template to View');
		}
		else{ 
			$.ajax({
				url:base_url+"ajax_controller/select_template_file",
				type:"post",
				data:institutedata,
				success:function(response){  
					var res1 = JSON.parse(response);//alert(res1[0].file_name);return;
					//var url = base_url+'admin/view_'+res1[0].file_name;alert(url);return;
					window.open(base_url+'Apply/view_'+res1[0].file_name);
				},
				error:function(){
					toastr.error("We are unable to Process.Please contact Support");
				}
			});	
		}
	});
	$('#btnViewEdit').click(function(){
		var template = $('#cmbTemplateEdit').val();
		var institutedata = {
		template_code: template
		};
		
		if(template == '')
		{
			toastr.error('Please Select a Template to View');
		}
		else{
			$.ajax({
				url:base_url+"ajax_controller/select_template_file",
				type:"post",
				data:institutedata,
				success:function(response){  
					var res1 = JSON.parse(response);//alert(res1[0].file_name);return;
					//var url = base_url+'admin/view_'+res1[0].file_name;alert(url);return;
					window.open(base_url+'Apply/view_'+res1[0].file_name);
				},
				error:function(){
					toastr.error("We are unable to Process.Please contact Support");
				}
			});	
		}
	});
	$('#btnRegistrationView').click(function(){
		var templateRegistration = $('#cmbRegistrationTemplate').val();
		if(templateRegistration == ''){
			toastr.error('Please Select a Template to View');
		}
		else{
			$.ajax({
				url:"program_db.php",
				mType:"get",
				data:{type:"VIEW_REGISTRATION_TEMPLATE",templateRegistration:templateRegistration,_s:session},
				success:function(response){  
					var res1 = JSON.parse(response);
					$.each(res1.aaData,function(i,data){
						window.open("../../"+data);
					});	
				},
				error:function(){
					toastr.error("We are unable to Process.Please contact Support");
				}
			});	
		}
	});
	$('#btnRegistrationViewEdit').click(function(){
		var templateRegistrationEdit = $('#cmbRegistrationTemplateEdit').val();
		$.ajax({
			url:"program_db.php",
			mType:"get",
			data:{type:"VIEW_REGISTRATION_TEMPLATE_EDIT",templateRegistrationEdit:templateRegistrationEdit,_s:session},
			success:function(response){  
				var res1 = JSON.parse(response);
				$.each(res1.aaData,function(i,data){
					window.open("../../"+data);
				});	
			},
			error:function(){
				toastr.error("We are unable to Process.Please contact Support");
			}
		});	
	});
	// CHECKING DUPLICATION OF INSTITUTE CODE 
	$('#txtProgramCode').on("change",function(event)
	{
		if($(event.target).val() != "" && $(event.target).val() != undefined)
		{
			var institutedata=
			{
				txtProgramCode:$(event.target).val(),
				validateprogramcode:true,
				type:"CHKDUCPLICATE",
				_s:session
			};
		   //ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/CHKDUCPLICATE",
				type:"post",
				data:institutedata,
				success:function(response)
				{
					var res1 = JSON.parse(response);
					if(res1.status>="1")
					{
					 	$(event.target).val("");
					 	$('#frmAddProgram').data('bootstrapValidator').updateStatus('txtProgramCode', 'INVALID', null);
						toastr.error('Code Already Used');
						$(event.target).focus();					
					}
					else
					{
						return false;
					}
				},  
				error:function()
				{
					toastr.error('Unable to process please contact support');
				}
			}); 
		}
	}); 
	$('#txtProgramName').on("change",function(event)
	{
		if($(event.target).val() != "" && $(event.target).val() != undefined)
		{
			var institutedata=
			{
				txtProgramName:$(event.target).val(),
				validateprogramcode:true,
				type:"CHKDUCPLICATE",
				_s:session
			};
		   //ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/CHKDUCPLICATE_program_name",
				type:"post",
				data:institutedata,
				success:function(response)
				{
					var res1 = JSON.parse(response);
					if(res1.status>="1")
					{
					 	$(event.target).val("");
					 	$('#frmAddProgram').data('bootstrapValidator').updateStatus('txtProgramName', 'INVALID', null);
						toastr.error('Program Name Already Used');
						$(event.target).focus();					
					}
					else
					{
						return false;
					}
				},  
				error:function()
				{
					toastr.error('Unable to process please contact support');
				}
			}); 
		}
	}); 

	$('#txtProgramCodeCopy').on("change",function(event)
	{
		if($(event.target).val() != "" && $(event.target).val() != undefined)
		{
			var institutedata=
			{
				txtProgramCodeCopy:$(event.target).val(),
				validateprogramcode:true,
				type:"CHKDUCPLICATE",
				_s:session
			};
		   //ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/CHKDUCPLICATECOPY",
				type:"post",
				data:institutedata,
				success:function(response)
				{
					var res1 = JSON.parse(response);
					if(res1.status>="1")
					{
					 	$(event.target).val("");
					 	$('#frmAddProgram').data('bootstrapValidator').updateStatus('txtProgramCode', 'INVALID', null);
						toastr.error('Code Already Used');
						$(event.target).focus();					
					}
					else
					{
						return false;
					}
				},  
				error:function()
				{
					toastr.error('Unable to process please contact support');
				}
			}); 
		}
	}); 	
	// CHECKING DUPLICATION OF INSTITUTE CODE FOR EDIT
	$('#txtProgramCodeEdit').on("change",function(event)
	{
		if($(event.target).val() != "" && $(event.target).val() != undefined)
		{
			var institutedata=
			{
				txtProgramCodeEdit:$(event.target).val(),
				validateprogramcode:true
			};
		   //ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/CHKEDITDUCPLICATE",
				type:"post",
				data:institutedata,
				success:function(response)
				{
					var res1 = JSON.parse(response);
					if(res1.status>="1")
					{
					 	$(event.target).val("");
					 	$('#frmProgramEdit').data('bootstrapValidator').updateStatus('txtProgramCodeEdit', 'INVALID', null);
						toastr.error('Code Already Used');
						$(event.target).focus();					
					}
					else
					{
						return false;
					}
				},  
				error:function()
				{
					toastr.error('Unable to process please contact support');
				}
			}); 
		}
	}); 
	
	$('#txtStartdate').datepicker({
	    autoclose:true,
	    clearBtn:true,
	    format:'dd-mm-yyyy'
	    
	}).on('changeDate', function (selected) {
		$('#frmAddProgram').data('bootstrapValidator').updateStatus('txtStartdate', 'NOT_VALIDATED', null).validateField('txtStartdate');
	    var startDate = new Date(selected.date.valueOf());
	    $('#txtEnddate').datepicker('setStartDate', startDate);
	    
	}).on('clearDate', function (selected) {
		$('#frmAddProgram').data('bootstrapValidator').updateStatus('txtStartdate', 'NOT_VALIDATED',null).validateField('txtStartdate');
	    $('#txtEnddate').datepicker('setStartDate', null);
	    
	});
	$('#txtAdmitCardStartdate').datepicker({
	    autoclose:true,
	    clearBtn:true,
	    format:'dd-mm-yyyy'
	    
	}).on('changeDate', function (selected) {
		$('#frmAddProgram').data('bootstrapValidator').updateStatus('txtAdmitCardStartdate', 'NOT_VALIDATED').validateField('txtAdmitCardStartdate');
	    var startDate = new Date(selected.date.valueOf());
	    $('#txtAdmitCardEnddate').datepicker('setStartDate', startDate);
	    
	}).on('clearDate', function (selected) {
		$('#frmAddProgram').data('bootstrapValidator').updateStatus('txtAdmitCardStartdate', 'NOT_VALIDATED').validateField('txtAdmitCardStartdate');
	    $('#txtAdmitCardEnddate').datepicker('setStartDate', null);
	});
	$('#txtAdmitCardStartdateCopy').datepicker({
	    autoclose:true,
	    clearBtn:true,
	    format:'dd-mm-yyyy'
	    
	}).on('changeDate', function (selected) {
		$('#frmCopyProgram').data('bootstrapValidator').updateStatus('txtAdmitCardStartdateCopy', 'NOT_VALIDATED').validateField('txtAdmitCardStartdateCopy');
	    var startDate = new Date(selected.date.valueOf());
	    $('#txtAdmitCardEnddateCopy').datepicker('setStartDate', startDate);
	    
	}).on('clearDate', function (selected) {
		$('#frmCopyProgram').data('bootstrapValidator').updateStatus('txtAdmitCardStartdateCopy', 'NOT_VALIDATED').validateField('txtAdmitCardStartdateCopy');
	    $('#txtAdmitCardEnddateCopy').datepicker('setStartDate', null);
	});
	$('#txtAdmitCardEnddateCopy').datepicker({
	    autoclose:true,
	    clearBtn:true,
	    format:'dd-mm-yyyy'
	    
	}).on('changeDate', function (selected) {
		$('#frmCopyProgram').data('bootstrapValidator').updateStatus('txtAdmitCardEnddateCopy', 'NOT_VALIDATED').validateField('txtAdmitCardEnddateCopy');
	    var startDate = new Date(selected.date.valueOf());
	    $('#txtAdmitCardEnddateCopy').datepicker('setStartDate', startDate);
	    
	}).on('clearDate', function (selected) {
		$('#frmCopyProgram').data('bootstrapValidator').updateStatus('txtAdmitCardEnddateCopy', 'NOT_VALIDATED').validateField('txtAdmitCardEnddateCopy');
	    $('#txtAdmitCardEnddateCopy').datepicker('setStartDate', null);
	});
	
	$('#txtEnddate').datepicker({
	    autoclose:true,
	    clearBtn:true,
	    format:'dd-mm-yyyy'
	    
	}).on('changeDate', function (selected) {
		$('#frmAddProgram').data('bootstrapValidator').updateStatus('txtEnddate', 'NOT_VALIDATED', null).validateField('txtEnddate');
	    var startDate = new Date(selected.date.valueOf());
	    $('#txtEnddate').datepicker('setStartDate', startDate);
	    
	}).on('clearDate', function (selected) {
		$('#frmAddProgram').data('bootstrapValidator').updateStatus('txtEnddate', 'NOT_VALIDATED', null).validateField('txtEnddate');
	    $('#txtEnddate').datepicker('setStartDate', null);
	});
	$('#txtAdmitCardEnddate').datepicker({
	    autoclose:true,
	    clearBtn:true,
	    format:'dd-mm-yyyy'
	    
	}).on('changeDate', function (selected) {
		$('#frmAddProgram').data('bootstrapValidator').updateStatus('txtAdmitCardEnddate', 'NOT_VALIDATED').validateField('txtAdmitCardEnddate');
	    var startDate = new Date(selected.date.valueOf());
	    $('#txtAdmitCardEnddate').datepicker('setStartDate', startDate);
	    
	}).on('clearDate', function (selected) {
		$('#frmAddProgram').data('bootstrapValidator').updateStatus('txtAdmitCardEnddate', 'NOT_VALIDATED').validateField('txtAdmitCardEnddate');
	    $('#txtAdmitCardEnddate').datepicker('setStartDate', null);
	});
	
	
	$('#txtAgeStartdate').datepicker({
	    autoclose:true,
	    clearBtn:true,
	    format:'dd-mm-yyyy'
	    
	}).datepicker('setEndDate', new Date()).on('changeDate', function (selected) {
			$('#frmAddProgram').data('bootstrapValidator').updateStatus('txtAgeStartdate', 'NOT_VALIDATED').validateField('txtAgeStartdate');
		    $("#txtAgeStartdate").datepicker().datepicker("setStartDate", startDate);
		}).on('clearDate', function (selected) {
		//$('#frmAddProgram').data('bootstrapValidator').updateStatus('txtAgeStartdate', 'NOT_VALIDATED').validateField('txtAgeStartdate');
	    $('#txtAgeEnddate').datepicker('setStartDate', null);
	});
	
	
	$('#txtAgeEnddate').datepicker({
	    autoclose:true,
	    clearBtn:true,
	    format:'dd-mm-yyyy'
	    
	}).datepicker('setEndDate', new Date()).on('changeDate', function (selected) {
			$('#frmAddProgram').data('bootstrapValidator').updateStatus('txtAgeEnddate', 'NOT_VALIDATED').validateField('txtAgeEnddate');
		    $("#txtAgeEnddate").datepicker().datepicker("setStartDate", startDate);
		}).on('clearDate', function (selected) {
		//$('#frmAddProgram').data('bootstrapValidator').updateStatus('txtAgeEnddate', 'NOT_VALIDATED').validateField('txtAgeEnddate');
	    $('#txtAgeEnddate').datepicker('setStartDate', null);
	});
	$('#txtAgeStartdateCopy').datepicker({
	    autoclose:true,
	    clearBtn:true,
	    format:'dd-mm-yyyy'
	    
	}).on('changeDate', function (selected) {
		//$('#frmCopyProgram').data('bootstrapValidator').updateStatus('txtAgeStartdateCopy', 'NOT_VALIDATED').validateField('txtAgeStartdateCopy');
	    var startDate = new Date(selected.date.valueOf());
	    $('#txtAgeEnddateCopy').datepicker('setStartDate', startDate);
	}).on('clearDate', function (selected) {
		//$('#frmCopyProgram').data('bootstrapValidator').updateStatus('txtAgeStartdateCopy', 'NOT_VALIDATED').validateField('txtAgeStartdateCopy');
	    $('#txtAgeEnddateCopy').datepicker('setStartDate', null);
	});
	
	
	$('#txtAgeEnddateCopy').datepicker({
	    autoclose:true,
	    clearBtn:true,
	    format:'dd-mm-yyyy'
	    
	}).on('changeDate', function (selected) {
		//$('#frmCopyProgram').data('bootstrapValidator').updateStatus('txtAgeEnddateCopy', 'NOT_VALIDATED').validateField('txtAgeEnddateCopy');
	    var startDate = new Date(selected.date.valueOf());
	    $('#txtAgeEnddateCopy').datepicker('setStartDate', startDate);
	}).on('clearDate', function (selected) {
		//$('#frmCopyProgram').data('bootstrapValidator').updateStatus('txtAgeEnddateCopy', 'NOT_VALIDATED').validateField('txtAgeEnddateCopy');
	    $('#txtAgeEnddateCopy').datepicker('setStartDate', null);
	});
	
	
	$('#txtStartdateEdit').datepicker({
	    autoclose:true,
	    clearBtn:true,
	    format:'dd-mm-yyyy'
	    
	}).on('changeDate', function (selected) {
		$('#frmProgramEdit').data('bootstrapValidator').updateStatus('txtStartdateEdit', 'NOT_VALIDATED').validateField('txtStartdateEdit');
	    var startDate = new Date(selected.date.valueOf());
	    $('#txtEnddateEdit').datepicker('setStartDate', startDate);
	}).on('clearDate', function (selected) {
		$('#frmProgramEdit').data('bootstrapValidator').updateStatus('txtStartdateEdit', 'NOT_VALIDATED').validateField('txtStartdateEdit');
	    $('#txtEnddateEdit').datepicker('setStartDate', null);
	});
	$('#txtAdmitCardStartdateEdit').datepicker({
	    autoclose:true,
	    clearBtn:true,
	    format:'dd-mm-yyyy'
	    
	}).on('changeDate', function (selected) {
		$('#frmProgramEdit').data('bootstrapValidator').updateStatus('txtAdmitCardStartdateEdit', 'NOT_VALIDATED').validateField('txtAdmitCardStartdateEdit');
	    var startDate = new Date(selected.date.valueOf());
	    $('#txtAdmitCardEnddateEdit').datepicker('setStartDate', startDate);
	}).on('clearDate', function (selected) {
		$('#frmProgramEdit').data('bootstrapValidator').updateStatus('txtAdmitCardStartdateEdit', 'NOT_VALIDATED').validateField('txtAdmitCardStartdateEdit');
	    $('#txtAdmitCardEnddateEdit').datepicker('setStartDate', null);
	});
	
	
	$('#txtEnddateEdit').datepicker({
	    autoclose:true,
	    clearBtn:true,
	    format:'dd-mm-yyyy'
	    
	}).on('changeDate', function (selected) {
		$('#frmProgramEdit').data('bootstrapValidator').updateStatus('txtEnddateEdit', 'NOT_VALIDATED').validateField('txtEnddateEdit');
	    var startDate = new Date(selected.date.valueOf());
	    $('#txtEnddateEdit').datepicker('setStartDate', startDate);
	}).on('clearDate', function (selected) {
		$('#frmProgramEdit').data('bootstrapValidator').updateStatus('txtEnddateEdit', 'NOT_VALIDATED').validateField('txtEnddateEdit');
	    $('#txtEnddateEdit').datepicker('setStartDate', null);
	});
	$('#txtAdmitCardEnddateEdit').datepicker({
	    autoclose:true,
	    clearBtn:true,
	    format:'dd-mm-yyyy'
	    
	}).on('changeDate', function (selected) {
		$('#frmProgramEdit').data('bootstrapValidator').updateStatus('txtAdmitCardEnddateEdit', 'NOT_VALIDATED').validateField('txtAdmitCardEnddateEdit');
	    var startDate = new Date(selected.date.valueOf());
	    $('#txtAdmitCardEnddateEdit').datepicker('setStartDate', startDate);
	}).on('clearDate', function (selected) {
		$('#frmProgramEdit').data('bootstrapValidator').updateStatus('txtAdmitCardEnddateEdit', 'NOT_VALIDATED').validateField('txtAdmitCardEnddateEdit');
	    $('#txtAdmitCardEnddateEdit').datepicker('setStartDate', null);
	});
	
	
	$('#txtAgeStartdateEdit').datepicker({
	    autoclose:true,
	    clearBtn:true,
	    format:'dd-mm-yyyy'
	    
	}).on('changeDate', function (selected) {
		//$('#frmProgramEdit').data('bootstrapValidator').updateStatus('txtAgeStartdateEdit', 'NOT_VALIDATED').validateField('txtAgeStartdateEdit');
	    var startDate = new Date(selected.date.valueOf());
	    $('#txtAgeEnddateEdit').datepicker('setStartDate', startDate);
	}).on('clearDate', function (selected) {
		//$('#frmProgramEdit').data('bootstrapValidator').updateStatus('txtAgeStartdateEdit', 'NOT_VALIDATED').validateField('txtAgeStartdateEdit');
	    $('#txtAgeEnddateEdit').datepicker('setStartDate', null);
	});
	
	
	$('#txtAgeEnddateEdit').datepicker({
	    autoclose:true,
	    clearBtn:true,
	    format:'dd-mm-yyyy'
	    
	}).on('changeDate', function (selected) {
		//$('#frmProgramEdit').data('bootstrapValidator').updateStatus('txtAgeEnddateEdit', 'NOT_VALIDATED').validateField('txtAgeEnddateEdit');
	    var startDate = new Date(selected.date.valueOf());
	    $('#txtAgeEnddateEdit').datepicker('setStartDate', startDate);
	}).on('clearDate', function (selected) {
		//$('#frmProgramEdit').data('bootstrapValidator').updateStatus('txtAgeEnddateEdit', 'NOT_VALIDATED').validateField('txtAgeEnddateEdit');
	    $('#txtAgeEnddateEdit').datepicker('setStartDate', null);
	});
	
	
	$('#txtAppStartdate').datepicker({
	    autoclose:true,
	    clearBtn:true,
	    format:'dd-mm-yyyy'
	    
	}).on('changeDate', function (selected) {
		$('#frmAddProgram').data('bootstrapValidator').updateStatus('txtAppStartdate', 'NOT_VALIDATED').validateField('txtAppStartdate');
	    var startDate = new Date(selected.date.valueOf());
	    $('#txtAppEnddate').datepicker('setStartDate', startDate);
	}).on('clearDate', function (selected) {
		$('#frmAddProgram').data('bootstrapValidator').updateStatus('txtAppStartdate', 'NOT_VALIDATED').validateField('txtAppStartdate');
	    $('#txtAppEnddate').datepicker('setStartDate', null);
	});
	
	
	$('#txtAppEnddate').datepicker({
	    autoclose:true,
	    clearBtn:true,
	    format:'dd-mm-yyyy'
	    
	}).on('changeDate', function (selected) {
		$('#frmAddProgram').data('bootstrapValidator').updateStatus('txtAppEnddate', 'NOT_VALIDATED').validateField('txtAppEnddate');
	    var startDate = new Date(selected.date.valueOf());
	    $('#txtAppEnddate').datepicker('setStartDate', startDate);
	}).on('clearDate', function (selected) {
		$('#frmAddProgram').data('bootstrapValidator').updateStatus('txtAppEnddate', 'NOT_VALIDATED').validateField('txtAppEnddate');
	    $('#txtAppEnddate').datepicker('setStartDate', null);
	});
	
	
	$('#txtAppStartdateEdit').datepicker({
	    autoclose:true,
	    clearBtn:true,
	    format:'dd-mm-yyyy'
	    
	}).on('changeDate', function (selected) {
		$('#frmProgramEdit').data('bootstrapValidator').updateStatus('txtAppStartdateEdit', 'NOT_VALIDATED').validateField('txtAppStartdateEdit');
	    var startDate = new Date(selected.date.valueOf());
	    $('#txtAppEnddateEdit').datepicker('setStartDate', startDate);
	}).on('clearDate', function (selected) {
		$('#frmProgramEdit').data('bootstrapValidator').updateStatus('txtAppStartdateEdit', 'NOT_VALIDATED').validateField('txtAppStartdateEdit');
	    $('#txtAppEnddateEdit').datepicker('setStartDate', null);
	});
	
	
	$('#txtAppEnddateEdit').datepicker({
	    autoclose:true,
	    clearBtn:true,
	    format:'dd-mm-yyyy'
	    
	}).on('changeDate', function (selected) {
		$('#frmProgramEdit').data('bootstrapValidator').updateStatus('txtAppEnddateEdit', 'NOT_VALIDATED').validateField('txtAppEnddateEdit');
	    var startDate = new Date(selected.date.valueOf());
	    $('#txtAppEnddateEdit').datepicker('setStartDate', startDate);
	}).on('clearDate', function (selected) {
		$('#frmProgramEdit').data('bootstrapValidator').updateStatus('txtAppEnddateEdit', 'NOT_VALIDATED').validateField('txtAppEnddateEdit');
	    $('#txtAppEnddateEdit').datepicker('setStartDate', null);
	});
	
	
	$('#txtStartdateCopy').datepicker({
	    autoclose:true,
	    clearBtn:true,
	    format:'dd-mm-yyyy'
	    
	}).on('changeDate', function (selected) {
		$('#frmCopyProgram').data('bootstrapValidator').updateStatus('txtStartdateCopy', 'NOT_VALIDATED').validateField('txtStartdateCopy');
	    var startDate = new Date(selected.date.valueOf());
	    $('#txtEnddateCopy').datepicker('setStartDate', startDate);
	}).on('clearDate', function (selected) {
		$('#frmCopyProgram').data('bootstrapValidator').updateStatus('txtStartdateCopy', 'NOT_VALIDATED').validateField('txtStartdateCopy');
	    $('#txtEnddateCopy').datepicker('setStartDate', null);
	});
	
	
	$('#txtEnddateCopy').datepicker({
	    autoclose:true,
	    clearBtn:true,
	    format:'dd-mm-yyyy'
	    
	}).on('changeDate', function (selected) {
		$('#frmCopyProgram').data('bootstrapValidator').updateStatus('txtEnddateCopy', 'NOT_VALIDATED').validateField('txtEnddateCopy');
	    var startDate = new Date(selected.date.valueOf());
	    $('#txtEnddateCopy').datepicker('setStartDate', startDate);
	}).on('clearDate', function (selected) {
		$('#frmCopyProgram').data('bootstrapValidator').updateStatus('txtEnddateCopy', 'NOT_VALIDATED').validateField('txtEnddateCopy');
	    $('#txtEnddateCopy').datepicker('setStartDate', null);
	});
	
	
	$('#txtAppStartdateCopy').datepicker({
	    autoclose:true,
	    clearBtn:true,
	    format:'dd-mm-yyyy'
	    
	}).on('changeDate', function (selected) {
		$('#frmCopyProgram').data('bootstrapValidator').updateStatus('txtAppStartdateCopy', 'NOT_VALIDATED').validateField('txtAppStartdateCopy');
	    var startDate = new Date(selected.date.valueOf());
	    $('#txtAppEnddateCopy').datepicker('setStartDate', startDate);
	}).on('clearDate', function (selected) {
		$('#frmCopyProgram').data('bootstrapValidator').updateStatus('txtAppStartdateCopy', 'NOT_VALIDATED').validateField('txtAppStartdateCopy');
	    $('#txtAppEnddateCopy').datepicker('setStartDate', null);
	});
	
	
	$('#txtAppEnddateCopy').datepicker({
	    autoclose:true,
	    clearBtn:true,
	    format:'dd-mm-yyyy'
	    
	}).on('changeDate', function (selected) {
		$('#frmCopyProgram').data('bootstrapValidator').updateStatus('txtAppEnddateCopy', 'NOT_VALIDATED').validateField('txtAppEnddateCopy');
	    var startDate = new Date(selected.date.valueOf());
	    $('#txtAppEnddateCopy').datepicker('setStartDate', startDate);
	}).on('clearDate', function (selected) {
		$('#frmCopyProgram').data('bootstrapValidator').updateStatus('txtAppEnddateCopy', 'NOT_VALIDATED').validateField('txtAppEnddateCopy');
	    $('#txtAppEnddateCopy').datepicker('setStartDate', null);
	});
	/*$('#txtStartdate').datepicker({
		dateFormat: 'dd-mm-yy',
		onSelect: function (date) {
            var date2 = $('#txtStartdate').datepicker('getDate');
			$('#frmAddProgram').bootstrapValidator('revalidateField', 'txtStartdate');
            date2.setDate(date2.getDate() + 1);
            $('#txtEnddate').datepicker('option', 'minDate', date2);
			$('#txtAppStartdate').datetimepicker('option', 'minDate', date2);
        }
	});
    $('#txtEnddate').datepicker({
		dateFormat: 'dd-mm-yy',
		onSelect: function (date) {
            var date2 = $('#txtEnddate').datepicker('getDate');
           // date2.setDate(date2.getDate() + 1);
           // $('#txtEnddate').datepicker('option', 'maxDate', date2);
			$('#txtAppStartdate').datetimepicker('option', 'maxDate', date2);
			$('#txtAppEnddate').datetimepicker('option', 'maxDate', date2);
        }
	});
	$('#txtAgeStartdate').datepicker({
		dateFormat: 'dd-mm-yy',
		onSelect: function (date) {
            var date2 = $('#txtAgeStartdate').datepicker('getDate');
            date2.setDate(date2.getDate() + 1);
            $('#txtAgeEnddate').datepicker('option', 'minDate', date2);
        }
	});
    $('#txtAgeEnddate').datepicker({
		dateFormat: 'dd-mm-yy',
		onSelect: function (date) {
            var date2 = $('#txtAgeEnddate').datepicker('getDate');
        }
	});
    $('#txtStartdateEdit').datepicker({
		dateFormat: 'dd-mm-yy',
		onSelect: function (date) {
            var date2 = $('#txtStartdateEdit').datepicker('getDate');
            date2.setDate(date2.getDate() + 1);
            $('#txtEnddateEdit').datepicker('option', 'minDate', date2);
			$('#txtAppStartdateEdit').datetimepicker('option', 'minDate', date2);
			
        }
	});
    $('#txtEnddateEdit').datepicker({
		dateFormat: 'dd-mm-yy',
		onSelect: function (date) {
            var date2 = $('#txtEnddateEdit').datepicker('getDate');
           // date2.setDate(date2.getDate() + 1);
           // $('#txtEnddate').datepicker('option', 'maxDate', date2);
			$('#txtAppStartdateEdit').datetimepicker('option', 'maxDate', date2);
			$('#txtAppEnddateEdit').datetimepicker('option', 'maxDate', date2);
        }
	}); 
	$('#txtAgeStartdateEdit').datepicker({
		dateFormat: 'dd-mm-yy',
		onSelect: function (date) {
            var date2 = $('#txtAgeStartdateEdit').datepicker('getDate');
            date2.setDate(date2.getDate() + 1);
            $('#txtAgeEnddateEdit').datepicker('option', 'minDate', date2);
        }
	});
    $('#txtAgeEnddateEdit').datepicker({
		dateFormat: 'dd-mm-yy',
		onSelect: function (date) {
            var date2 = $('#txtAgeEnddateEdit').datepicker('getDate');
           // date2.setDate(date2.getDate() + 1);
           // $('#txtEnddate').datepicker('option', 'maxDate', date2);
        }
	});
	$( "#txtAppStartdate" ).datetimepicker({
			dateFormat: 'dd-mm-yy',
			onSelect: function (date) {
            var date2 = $('#txtAppStartdate').datetimepicker('getDate');
            date2.setDate(date2.getDate() + 1);
            $('#txtAppEnddate').datetimepicker('option', 'minDate', date2);
			//$('#txtAppStartdate').datetimepicker('option', 'minDate', date2);
        	}
		});
	$( "#txtAppEnddate" ).datetimepicker({
		dateFormat: 'dd-mm-yy',
		
	});
	$( "#txtAppStartdateEdit" ).datetimepicker({
			dateFormat: 'dd-mm-yy',
			onSelect: function (date) {
            var date2 = $('#txtAppStartdateEdit').datetimepicker('getDate');
            date2.setDate(date2.getDate() + 1);
            $('#txtAppEnddateEdit').datetimepicker('option', 'minDate', date2);
			//$('#txtAppStartdate').datetimepicker('option', 'minDate', date2);
			
        	},
			onSelect: function (selectedDateTime){
				$( "#txtAppStartdateEdit" ).datetimepicker('option', 'minDate', $( "#txtAppStartdateEdit" ).datetimepicker('getDate') );
			}
		});
	$( "#txtAppEnddateEdit" ).datetimepicker({
			dateFormat: 'dd-mm-yy',
		});
	$('#txtStartdateCopy').datepicker({
		dateFormat: 'dd-mm-yy',
		onSelect: function (date) {
            var date2 = $('#txtStartdateCopy').datepicker('getDate');
			
            date2.setDate(date2.getDate() + 1);
            $('#txtEnddateCopy').datepicker('option', 'minDate', date2);
			$('#txtAppStartdateCopy').datetimepicker('option', 'minDate', date2);
			
        }
		 
	});
    $('#txtEnddateCopy').datepicker({
		dateFormat: 'dd-mm-yy',
		onSelect: function (date) {
            var date2 = $('#txtEnddateCopy').datepicker('getDate');
           // date2.setDate(date2.getDate() + 1);
           // $('#txtEnddate').datepicker('option', 'maxDate', date2);
			$('#txtAppStartdateCopy').datetimepicker('option', 'maxDate', date2);
			$('#txtAppEnddateCopy').datetimepicker('option', 'maxDate', date2);
			
        }
		
	});
	$( "#txtAppStartdateCopy" ).datetimepicker({
			dateFormat: 'dd-mm-yy',
			onSelect: function (date) {
            var date2 = $('#txtAppStartdateCopy').datetimepicker('getDate');
            date2.setDate(date2.getDate() + 1);
            $('#txtAppEnddateCopy').datetimepicker('option', 'minDate', date2);
			//$('#txtAppStartdate').datetimepicker('option', 'minDate', date2);
			
        	}
			
			
		});
	$( "#txtAppEnddateCopy" ).datetimepicker({
		dateFormat: 'dd-mm-yy',
		
		
	});*/
	
	
	
	/* CODE FOR TOOLTIP */
	$('.tooltips').tooltipster({
		theme: 'tooltipster-punk',
		animation: 'grow',
        delay: 200, 
        touchDevices: false,
        trigger: 'hover'
     });	
	/* END OF TOOLTIP */
	/* CODE FOR TOASTR */
	toastr.options = {
	  "closeButton": true,
	  "debug": false,
	  "progressBar": false,
	  "positionClass": "toast-bottom-right",//top-right,bottom-left,top-left,top-full-width,bottom-full-width,top-center,bottom-center
	  "onclick": null,
	  "showDuration": "20000",
	  "hideDuration": "1000",
	  "timeOut": "5000",
	  "extendedTimeOut": "1000",
	  "showEasing": "swing",
	  "hideEasing": "linear",
	  "showMethod": "fadeIn",
	  "hideMethod": "fadeOut"
	}
	/* END OF CODE FOR TOASTR*/	
	//Change year
	$('#cmbYear').change(function(){
		year = $('#cmbYear').val();
		if(year != '')
		{
			load_old_table();
		}
	});
});
function editold(event)
{
	var session = $('#hidSessionCode').val();
	var oTable = $('#tblProgramMasterOld').dataTable();
	var row;
	//alert(event.target.tagName);
	if(event.target.tagName == "BUTTON" || event.target.tagName == "A")
	  		row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
  		row = event.target.parentNode.parentNode.parentNode; 
  	else
  		row = event.target.parentNode;
	//$(row).addClass('success');
   	
    var programCode = oTable.fnGetData(row)['progcode'];//GETTING DATA FOR HIDDEN COLUMN
	var programstartdate = oTable.fnGetData(row)['program_start_date'];
	var programenddate = oTable.fnGetData(row)['program_end_date'];
	var applystartdate = oTable.fnGetData(row)['apply_start_date'];
	var applyenddate = oTable.fnGetData(row)['apply_end_date'];
	var admitcard_start_date = oTable.fnGetData(row)['admitcard_start_date'];
	var admitcard_end_date = oTable.fnGetData(row)['admitcard_end_date'];
	var template_code = oTable.fnGetData(row)['template_code'];
	//alert(template_code);
	var sequence_code = oTable.fnGetData(row)['sequence_code'];
	var sequence_no = oTable.fnGetData(row)['sequence_no'];
	var birthstartdate = oTable.fnGetData(row)['birth_start_date'];
	var birthenddate = oTable.fnGetData(row)['birth_end_date'];
	var registration_template_code = oTable.fnGetData(row)['reg_template_code'];
	var qualification = oTable.fnGetData(row)['qualification'];
	var min_mark = oTable.fnGetData(row)['min_mark'];
	$('#hidUniqueidEdit').val(programCode);//GETTING VALUE FOR HIDDEN COLUMN
	$('#txtProgramCodeEdit').val(oTable.fnGetData(row)['progcode']);
	$('#txtProgramNameEdit').val(oTable.fnGetData(row)['program_name']);
	$('#txtYearEdit').val(oTable.fnGetData(row)['year']);
	$('#txtSlnoEdit').val(oTable.fnGetData(row)['sl_no']);
	$('#txtOmrNo').val(oTable.fnGetData(row)['omr_no']);
	$('#txtStartdateEdit').val(programstartdate);
	$('#txtAgeStartdateEdit').val(birthstartdate);
	//$('#txtStartdateEdit').datepicker("setDate", programstartdate ).datepicker('update');
	$('#txtAgeEnddateEdit').val(birthenddate);
	$('#txtEnddateEdit').val(programenddate);
	$('#txtSeqCodeEdit').val(sequence_code);
	$('#txtSeqnoEdit').val(sequence_no);
	$('#cmbRegistrationTemplateEdit').val(registration_template_code);
	//$('#txtEnddateEdit').datepicker("setDate", programenddate ).datepicker('update');
	//alert(applystartdate);
	$('#txtAppStartdateEdit').val(applystartdate);
	$('#txtAdmitCardStartdateEdit').val(admitcard_start_date);
	$('#txtAdmitCardEnddateEdit').val(admitcard_end_date);
	$('#txtAppEnddateEdit').val(applyenddate);
	$('#cmbStatusEdit').val(oTable.fnGetData(row)['status']);
	$('#cmbProgramQualificationEdit').val(qualification);
	$('#txtPercenatgeEdit').val(oTable.fnGetData(row)['min_mark']);
	
//	alert($('#cmbStatusEdit').val());
	
	program_date = programstartdate+' - '+programenddate;
	birth_date = birthstartdate+' - '+birthenddate;
	
	//alert(program_date);
	
	
	
	$('#cmbProgramGroupEdit').val(oTable.fnGetData(row)['program_group']);
	$('#taElectiveSubjectsEdit').val(oTable.fnGetData(row)['elective_subjects']);
	$('#cmbTemplateEdit').val(template_code);
	$('#txtOnlineTransactionNoEdit').val(oTable.fnGetData(row)['online_payment_transaction_no']);
	
	
	
	$('#spanLoadMenu').hide();
	$('#spanProgramMenu').show();
	$('#spanActiveProgramMenu').show();
	$('#spanShowProgramMenu').show();
	
	
   	
	$('#programEditModal').modal('show');
	$('#frmProgramEdit').bootstrapValidator({
		message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton) 
		{
			$("#spanProcessingProgramEdit").show();
			var institutedata={
				hidUniqueidEdit:$('#hidUniqueidEdit').val(),
				cmbProgramGroupEdit:$('#cmbProgramGroupEdit').val(),
				taElectiveSubjectsEdit:$('#taElectiveSubjectsEdit').val(),
				txtProgramCodeEdit:$('#txtProgramCodeEdit').val(),
				txtProgramNameEdit:$('#txtProgramNameEdit').val(),
				txtYearEdit:$('#txtYearEdit').val(),
				txtSlnoEdit:$('#txtSlnoEdit').val(),
				txtSeqCodeEdit:$('#txtSeqCodeEdit').val(),
				cmbRegistrationTemplateEdit:$('#cmbRegistrationTemplateEdit').val(),
				txtSeqnoEdit:$('#txtSeqnoEdit').val(),
				txtOnlineTransactionNoEdit:$('#txtOnlineTransactionNoEdit').val(),
				txtOmrNoEdit:$('#txtOmrNoEdit').val(),
				cmbStatusEdit:'Active',
				cmbTemplateEdit:$('#cmbTemplateEdit').val(),
				txtStartdate:$("#txtProgramDateEdit").val(),
				txtAdmitCardStartdateEdit:$("#txtAdmitCardStartdateEdit").val(),
				txtAdmitCardEnddateEdit:$("#txtAdmitCardEnddateEdit").val(),
				txtEligibledate:$("#txtEligibleDateEdit").val(),
				txtAppStartdate:$("#txtAppDateEdit").val(),
				cmbProgramQualificationEdit:$('#cmbProgramQualificationEdit').val(),
				txtPercenatgeEdit:$('#txtPercenatgeEdit').val()
				
			};
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/edit_old",
				type:"post",
				data:institutedata,
				success:function(response){ 
					var result = JSON.parse(response);
					var isPublish = false;
					$(oTable.fnSettings().aoData).each(function ()
					{
						$(this.nTr).removeClass('success');
					});
					if(result.status=='SUCCESS')
					{
						$("#spanProcessingProgramEdit").hide();
						$('#programEditModal').modal('hide'); 
						var dtblProgram = $("#tblProgramMaster").DataTable();
						
			 			dtblProgram.ajax.reload();
			 			var dtblProgramOld = $("#tblProgramMasterOld").DataTable();
			 			dtblProgramOld.ajax.reload();
						toastr.success(result.msg);	
					}	
					else
					{
						toastr.error(result.msg);
						$("#spanProcessingProgramEdit").hide();
						$('#programEditModal').modal('hide'); 
						var dtblProgram = $("#tblProgramMaster").DataTable();
						
			 			dtblProgram.ajax.reload();
			 			var dtblProgramOld = $("#tblProgramMasterOld").DataTable();
			 			dtblProgramOld.ajax.reload();
					}
				},
				error:function(){
					toastr.error('Unable to process please contact support');
				}
			});
		},
		fields:{
			txtProgramCodeEdit: {							//form input type name
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
					regexp: {
						regexp: /^([A-Za-z0-9\s]+)$/i,
						message: "Special characters are not allowed"
					},
					stringLength: {
						max: 8,
						message: 'Code should not be more then 8 characters'
						}
				}
			},
			cmbProgramGroupEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			txtProgramNameEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			txtYearEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
					digits: {
					message: 'The value can contain only digits'
					},
					stringLength: {
						min: 4,
						max: 4,
						message: 'Year should not be more then 4 characters'
						}
				}
			},
			txtSlnoEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
					digits: {
					message: 'The value can contain only digits'
					}
				}
			},
			txtOnlineTransactionNoEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
					digits: {
					message: 'The value can contain only digits'
					}
				}
			},
			txtOmrNoEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
					digits: {
					message: 'The value can contain only digits'
					}
				}
			},
			cmbStatusEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			cmbProgramQualificationEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			txtPercenatgeEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
					digits: {
					message: 'The value can contain only digits'
					},
					lessThan: {
                        value: 101,
                        message: 'must be less than or equal to 100'
                    }
                }
			},
			cmbRegistrationTemplateEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			cmbTemplateEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			txtStartdateEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			txtEnddateEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			txtAppStartdateEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			txtAppEnddateEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			txtAdmitCardEnddateEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			txtAdmitCardStartdateEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			}
		}
			
	});
}
function deleteRowold(event)
{
	var session = $('#hidSessionCode').val();
	$('#programDeleteModal').modal('show');
	var oTable = $('#tblProgramMasterOld').dataTable();
	var row;
	if(event.target.tagName == "BUTTON" || event.target.tagName == "A")
	   row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
	   row = event.target.parentNode.parentNode.parentNode;	
	$('#hidUniqueidEdit').val( oTable.fnGetData(row)['progcode']);
	
}
$('#programDeleteRecord1').click(function()
{
	$('#programDeleteModal').modal('hide');	
	var institutedata=
	{
		programCode:$('#hidUniqueidEdit').val(),
		type:"DELETE"
	};		
	//ajax call to server
	$.ajax({
		url:base_url+"ajax_controller/delete_current",
		type:"post",
		data:institutedata,
		success:function(response)
		{  
			var result = JSON.parse(response);
			if(result.status=='SUCCESS')
			{	
				var dtblProgram = $("#tblProgramMaster").DataTable();
				load_old_table()
	 			dtblProgram.ajax.reload();
				toastr.success(result.msg);		
			}
			else
			{
				toastr.error(result.msg);	
				var dtblProgram = $("#tblProgramMaster").DataTable();
				load_old_table()
	 			dtblProgram.ajax.reload();	
			} 
		},
		error:function()
		{
			toastr.error('Unable to process please contact support');
		}
	});		
});
function edit(event)
{
	isPublish = false;
	var session = $('#hidSessionCode').val();
	var oTable = $('#tblProgramMaster').dataTable();
	var row;
	//alert(event.target.tagName);
	if(event.target.tagName == "BUTTON" || event.target.tagName == "A" || event.target.tagName == "IMG")
	  		row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
  		row = event.target.parentNode.parentNode.parentNode; 
  	else
  		row = event.target.parentNode;
	$(row).addClass('success');
	//$('#frmProgramEdit').data('bootstrapValidator').resetForm(true);
    var programCode = oTable.fnGetData(row)['progcode'];//GETTING DATA FOR HIDDEN COLUMN
	var programstartdate = oTable.fnGetData(row)['program_start_date'];
	var programenddate = oTable.fnGetData(row)['program_end_date'];
	var applystartdate = oTable.fnGetData(row)['apply_start_date'];
	var applyenddate = oTable.fnGetData(row)['apply_end_date'];
	var registration_template_code = oTable.fnGetData(row)['reg_template_code'];
	var template_code = oTable.fnGetData(row)['template_code'];
	var sequence_code = oTable.fnGetData(row)['sequence_code'];
	var sequence_no = oTable.fnGetData(row)['sequence_no'];
	var program_duration = oTable.fnGetData(row)['program_duration'];
	var program_description = oTable.fnGetData(row)['program_desc'];
	var admitcard_start_date = oTable.fnGetData(row)['admitcard_start_date'];
	var admitcard_end_date = oTable.fnGetData(row)['admitcard_end_date'];
	var qualification = oTable.fnGetData(row)['qualification'];
	var min_mark = oTable.fnGetData(row)['min_mark'];
	
	//alert(sequence_no);
	var birthstartdate = oTable.fnGetData(row)['birth_start_date'];
	var birthenddate = oTable.fnGetData(row)['birth_end_date'];
	$('#hidUniqueidEdit').val(programCode);//GETTING VALUE FOR HIDDEN COLUMN
	$('#txtProgramCodeEdit').val(oTable.fnGetData(row)['progcode']);
	$('#cmbProgramGroupEdit').val(oTable.fnGetData(row)['program_group_code']);
	$('#txtProgramNameEdit').val(oTable.fnGetData(row)['program_name']);
	$('#txtYearEdit').val(oTable.fnGetData(row)['year']);
	$('#txtSlnoEdit').val(oTable.fnGetData(row)['order']);
	//$('#txtSeqCodeEdit').val(oTable.fnGetData(row)['sequence_code']);
	$('#txtSeqCodeEdit').val(sequence_code);
	$('#txtStartdateEdit').val(programstartdate);
	$('#txtAgeStartdateEdit').val(birthstartdate);
	//$('#txtStartdateEdit').datepicker("setDate", programstartdate ).datepicker('update');
	$('#txtAgeEnddateEdit').val(birthenddate);
	$('#txtEnddateEdit').val(programenddate);
	$('#txtSeqnoEdit').val(sequence_no);
	/*alert(program_duration);
	alert(program_description);*/
	$('#txtProgramDurationEdit').val(program_duration);
	$('#taProgramDescriptionEdit').val(program_description);
	$('#txtAdmitCardStartdateEdit').val(admitcard_start_date);
	$('#txtAdmitCardEnddateEdit').val(admitcard_end_date);
	//$('#txtEnddateEdit').datepicker("setDate", programenddate ).datepicker('update');
	//alert(applystartdate);
	$('#txtAppStartdateEdit').val(applystartdate);
	$('#txtAppEnddateEdit').val(applyenddate);
	$('#cmbStatusEdit').val(oTable.fnGetData(row)['status']);
	$('#cmbProgramQualificationEdit').val(qualification);
	$('#txtPercenatgeEdit').val(oTable.fnGetData(row)['min_mark']);
	$('#cmbStatusEdit').val(oTable.fnGetData(row)['status']);
	
	program_date = programstartdate+' - '+programenddate;
	birth_date = birthstartdate+' - '+birthenddate;
	
	//alert(program_date);
	$('#txtProgramDateEdit').val(program_date);
	/*$('#txtProgramDateEdit').data('daterangepicker').setStartDate(applystartdate);
	$('#txtProgramDateEdit').data('daterangepicker').setEndDate(applyenddate);*/
	//alert(birth_date);
	if(birthstartdate != null && birthenddate != null)
	{
		$('#txtEligibleDateEdit').val(birth_date);
		/*$('#txtEligibleDateEdit').data('daterangepicker').setStartDate(birthstartdate);
		$('#txtEligibleDateEdit').data('daterangepicker').setEndDate(birthenddate);*/
	}
	
	apply_date = applystartdate+' - '+applyenddate;
	$('#txtAppDateEdit').val(apply_date);
	/*$('#txtAppDateEdit').data('daterangepicker').setStartDate(applystartdate);
	$('#txtAppDateEdit').data('daterangepicker').setEndDate(applyenddate);*/
	
	
	
	
	
	
	
	
	
	$('#txtOmrNoEdit').val(oTable.fnGetData(row)['omr_no']);
	//$('#txtProgramDurationEdit').val(oTable.fnGetData(row)['program_duration']);
	$('#cmbProgramGroupEdit').val(oTable.fnGetData(row)['program_group']);
	$('#taElectiveSubjectsEdit').val(oTable.fnGetData(row)['elective_subjects']);
	//$('#taProgramDescriptionEdit').val(oTable.fnGetData(row)['program_desc']);
	$('#cmbRegistrationTemplateEdit').val(registration_template_code);
	$('#cmbTemplateEdit').val(template_code);
	$('#txtOnlineTransactionNoEdit').val(oTable.fnGetData(row)['online_payment_transaction_no']);
	
	countProgramMenu(programCode);
	countActiveProgramMenu(programCode);
	countShowProgramMenu(programCode);
	
	$('#spanLoadMenu').hide();
	$('#spanProgramMenu').show();
	$('#spanActiveProgramMenu').show();
	$('#spanShowProgramMenu').show();
	countZeroFeeCategory(programCode);
	countInactiveDocuments(programCode);
	
	countChallan(programCode);
	
	countExamCentre(programCode);
	
	countInActiveSmsType(programCode);
	
	countInActiveCategory(programCode);
	
   	
	$('#programEditModal').modal('show');
	
	$('#frmProgramEdit').bootstrapValidator({
		message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton) 
		{
			$("#spanProcessingProgramEdit").show();
					
			var institutedata={
				hidUniqueidEdit:$('#hidUniqueidEdit').val(),
				cmbProgramGroupEdit:$('#cmbProgramGroupEdit').val(),
				taElectiveSubjectsEdit:$('#taElectiveSubjectsEdit').val(),
				txtProgramCodeEdit:$('#txtProgramCodeEdit').val(),
				txtProgramNameEdit:$('#txtProgramNameEdit').val(),
				txtProgramDurationEdit:$('#txtProgramDurationEdit').val(),
				taProgramDescriptionEdit:$('#taProgramDescriptionEdit').val(),
				txtYearEdit:$('#txtYearEdit').val(),
				txtSlnoEdit:$('#txtSlnoEdit').val(),
				txtSeqCodeEdit:$('#txtSeqCodeEdit').val(),
				txtSeqnoEdit:$('#txtSeqnoEdit').val(),
				txtOnlineTransactionNoEdit:$('#txtOnlineTransactionNoEdit').val(),
				txtOmrNoEdit:$('#txtOmrNoEdit').val(),
				cmbStatusEdit:$('#cmbStatusEdit').val(),
				cmbRegistrationTemplateEdit:$('#cmbRegistrationTemplateEdit').val(),
				cmbTemplateEdit:$('#cmbTemplateEdit').val(),
				txtStartdateEdit:$('#txtStartdateEdit').val(),
				txtEnddateEdit:$('#txtEnddateEdit').val(),
				txtAgeStartdateEdit:$('#txtAgeStartdateEdit').val(),
				txtAgeEnddateEdit:$('#txtAgeEnddateEdit').val(),
				txtAppStartdateEdit:$('#txtAppStartdateEdit').val(),
				txtAppEnddateEdit:$('#txtAppEnddateEdit').val(),
				cmbProgramQualificationEdit:$('#cmbProgramQualificationEdit').val(),
				txtPercenatgeEdit:$('#txtPercenatgeEdit').val(),
				/*txtStartdate:$("#txtProgramDateEdit").val(),
				txtEligibledate:$("#txtEligibleDateEdit").val(),
				txtAppStartdate:$("#txtAppDateEdit").val(),*/
				hidCsrfTokenEdit:$("#hidCsrfTokenEdit").val()
			};
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/edit_current",
				type:"post",
				data:institutedata,
				success:function(response){ 
					var result = JSON.parse(response);
					isPublish = false;
					if(result.status=='SUCCESS')
					{
						$("#spanProcessingProgramEdit").hide();
						$('#programEditModal').modal('hide'); 
						var dtblProgram = $("#tblProgramMaster").DataTable();
			 			dtblProgram.ajax.reload();
						toastr.success(result.msg);
				 		
						$('#frmProgramEdit').data('bootstrapValidator').resetForm(true);
					}
					else
					{
						$("#spanProcessingProgramEdit").hide();
						$('#programEditModal').modal('hide'); 
						var dtblProgram = $("#tblProgramMaster").DataTable();
			 			dtblProgram.ajax.reload();
			 			/*$(dtblProgram.fnSettings().aoData).each(function ()
						{
							$(this.nTr).removeClass('success');
							var isPublish = false;
						});*/
			 			$('#frmProgramEdit').data('bootstrapValidator').resetForm(true);
						toastr.error(result.msg);
					}		
				},
				error:function(){
					toastr.error('Unable to process please contact support');
				}
			});
		},
		fields:{
		
			txtProgramCodeEdit: {							//form input type name
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
					regexp: {
						regexp: /^([A-Za-z0-9\s]+)$/i,
						message: "Special characters are not allowed"
					},
					stringLength: {
						max: 8,
						message: 'Code should not be more then 8 characters'
						}
				}
			},
			cmbProgramGroupEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			txtProgramNameEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			txtProgramDurationEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
					digits: {
					message: 'The value can contain only digits'
					}
				}
			},
			txtYearEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
					digits: {
					message: 'The value can contain only digits'
					},
					stringLength: {
						min: 4,
						max: 4,
						message: 'Year should not be more then 4 characters'
						}
				}
			},
			txtSlnoEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
					digits: {
					message: 'The value can contain only digits'
					}
				}
			},
			txtOnlineTransactionNoEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
					digits: {
					message: 'The value can contain only digits'
					}
				}
			},
			txtOmrNoEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
					digits: {
					message: 'The value can contain only digits'
					}
				}
			},
			cmbStatusEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			cmbTemplateEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			cmbRegistrationTemplateEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			txtStartdateEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			txtEnddateEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			txtAppStartdateEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			txtAppEnddateEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			cmbProgramQualificationEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			txtPercenatgeEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
					digits: {
					message: 'The value can contain only digits'
					},
					lessThan: {
                        value: 101,
                        message: 'must be less than or equal to 100'
                    }
                }
			},
			txtAdmitCardStartdateEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			txtAdmitCardEnddateEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			}/*,
			txtAppStartdateEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			txtAppEnddateEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			}*/
		}
			
	});
}
function publishRow(event)
{
	isPublish = true;
	var session = $('#hidSessionCode').val();
	var oTable = $('#tblProgramMaster').dataTable();
	var row;
	//alert(event.target.tagName);
	if(event.target.tagName == "BUTTON" || event.target.tagName == "A" || event.target.tagName == "IMG")
	  		row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
  		row = event.target.parentNode.parentNode.parentNode; 
  	else
  		row = event.target.parentNode;
	$(row).addClass('success');
	//$('#frmProgramEdit').data('bootstrapValidator').resetForm(true);
	var programCode = oTable.fnGetData(row)['progcode'];//GETTING DATA FOR HIDDEN COLUMN
	$('#publishDrive').html('<i>'+oTable.fnGetData(row)['program_group_code']+'</i>');
	$('#publishName').html('<i>'+oTable.fnGetData(row)['program_name']+'</i>');
	$('#publishDesc').html('<i>'+oTable.fnGetData(row)['program_desc']+'</i>');
	$('#publishAppFrom').html('<i>'+oTable.fnGetData(row)['program_start_date']+'</i>');
	$('#publishAppTo').html('<i>'+oTable.fnGetData(row)['program_end_date']+'</i>');
	/*$('#publishStatus').html('<i>'+oTable.fnGetData(row)['program_group_code']+'</i>');*/
	$('#publishPostFrom').html('<i>'+oTable.fnGetData(row)['apply_start_date']+'</i>');
	$('#publishPostTo').html('<i>'+oTable.fnGetData(row)['apply_end_date']+'</i>');
	
	if(oTable.fnGetData(row)['birth_start_date'] == null)
	{
		$('#publishBirthFrom').html('-');
	}
	else
	{
		$('#publishBirthFrom').html('<i>'+oTable.fnGetData(row)['program_group_code']+'</i>');
	}
	if(oTable.fnGetData(row)['birth_end_date'] == null)
	{
		$('#publishBirthTo').html('-');
	}
	else
	{
		$('#publishBirthTo').html('<i>'+oTable.fnGetData(row)['birth_end_date']+'</i>');
	}
	
	/*var programCode = oTable.fnGetData( event.target.parentNode )[2];//GETTING DATA FOR HIDDEN COLUMN
	var programstartdate = oTable.fnGetData( event.target.parentNode )[8];
	var programenddate = oTable.fnGetData( event.target.parentNode )[9];
	var applystartdate = oTable.fnGetData( event.target.parentNode )[11];
	var applyenddate = oTable.fnGetData( event.target.parentNode )[12];
	var template_code = oTable.fnGetData( event.target.parentNode )[15];
	var sequence_code = oTable.fnGetData( event.target.parentNode )[19];
	var sequence_no = oTable.fnGetData( event.target.parentNode )[20];
	var birthstartdate = oTable.fnGetData( event.target.parentNode )[21];
	var birthenddate = oTable.fnGetData( event.target.parentNode )[22];*/
	
	$('#hidUniqueidEdit').val(programCode);
   	
	$('#programPublishModal').modal('show');
	
}
$('#programPublishRecord').click(function()
{
	$('#programPublishModal').modal('hide');		
	var institutedata=
	{
		programCode:$('#hidUniqueidEdit').val()
	};		
	//ajax call to server
	$.ajax({
		url:base_url+"ajax_controller/publish",
		type:"post",
		data:institutedata,
		success:function(response)
		{  
			var result = JSON.parse(response);
			if(result.status=='SUCCESS')
			{
				var dtblProgram = $("#tblProgramMaster").DataTable();
				dtblProgram.ajax.reload();
				toastr.success(result.msg);	
				$(row).removeClass('success');
				
				isPublish= false;
			}
			else
			{
				toastr.error(result.msg);
				var dtblProgram = $("#tblProgramMaster").DataTable();
				dtblProgram.ajax.reload();
				
				$(row).removeClass('success');
				isPublish= false;
			}
		},
		error:function()
		{
			toastr.error('Unable to process please contact support');
		}
	});		
});
function edit_additional(event)
{
	$('#frmAdditionalData').data('bootstrapValidator').resetForm(true);
	var session = $('#hidSessionCode').val();
	var oTable = $('#tblProgramAdditional').dataTable();
	var row;
	//alert(event.target.tagName);
	if(event.target.tagName == "BUTTON" || event.target.tagName == "A" || event.target.tagName == "IMG")
	  		row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
  		row = event.target.parentNode.parentNode.parentNode; 
  	else
  		row = event.target.parentNode;
	$(row).addClass('success');
   
    var program_code = oTable.fnGetData(row)['program_code'];//GETTING DATA FOR HIDDEN COLUMN
	var program_name = oTable.fnGetData(row)['program_name'];
	var classifiction = oTable.fnGetData(row)['classification'];
	var ministry = oTable.fnGetData(row)['ministry'];
	var department = oTable.fnGetData(row)['department'];
	var organisation = oTable.fnGetData(row)['organisation'];
	var pay_scale = oTable.fnGetData(row)['pay_scale'];
	var age = oTable.fnGetData(row)['age'];
	var qualification = oTable.fnGetData(row)['qualification'];
	var desirable_qualification = oTable.fnGetData(row)['desired_qualification'];
	var duties = oTable.fnGetData(row)['duties'];
	var probotion_period = oTable.fnGetData(row)['probotion_period'];
	var head_quarter = oTable.fnGetData(row)['head_quarter'];
	var other_detail = oTable.fnGetData(row)['other_details'];
	var link_path = oTable.fnGetData(row)['link_path'];
	
	//alert(program_code);
	$.ajax({
		"url": base_url+"/ajax_controller/get_program_table_data",
		type:"POST",
		data : '',
		success:function(response)
		{  				
			var res1 = JSON.parse(response);					
			var options = "<option value=''>Select</option>";
		    $.each(res1.aaData,function(i,data)
		    {
		    	options = options + "<option value='"+data.program_code+"'>"+data.program_name+"</option>";
		    });
		    $('#cmbAdditionalProgram').html("");   
			$('#cmbAdditionalProgram').append(options);
			$('#cmbAdditionalProgram').html(options);	
			$('#cmbAdditionalProgram').val(program_code);
		},
		error:function()
		{
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
	$('#hidUniqueidAdditional').val(program_code);
	//alert(link_path);
	if(link_path == '' || link_path == null || link_path == 'undefined')
	{
		$('#radioWrite').attr('checked', true);
		$('#divUpload').hide();
		$('#divWrite').show();
		$('#txtClassification').val(classifiction);
		$('#txtMinistry').val(ministry);
		$('#txtDepartment').val(department);
		$('#txtOrganisation').val(organisation);
		$('#txtPayScale').val(pay_scale);
		$('#txtAge').val(age);
		$('#txtEsQualification').val(qualification);
		$('#txtDesireQualification').val(desirable_qualification);
		$('#txtDuties').val(duties);
		$('#txtProbPeriod').val(probotion_period);
		$('#txtHeadQuarter').val(head_quarter);
		$('#txtOtherDetail').val(other_detail);
		
	}
	else
	{
		$('#radioUpload').attr('checked', true);
		$('#divUpload').show();
		$('#divWrite').hide();
		$('#txtClassification').val('');
		$('#txtMinistry').val('');
		$('#txtDepartment').val('');
		$('#txtOrganisation').val('');
		$('#txtPayScale').val('');
		$('#txtAge').val('');
		$('#txtEsQualification').val('');
		$('#txtDesireQualification').val('');
		$('#txtDuties').val('');
		$('#txtProbPeriod').val('');
		$('#txtHeadQuarter').val('');
		$('#txtOtherDetail').val('');
	}
	$('#cmbAdditionalProgram').prop('disabled', true);
	$('#cmbAdditionalProgram').val(program_code);
	
	
	
	
	$('#programAdditionalModal').modal('show');
	$('#programAdditionalModal').on('shown.bs.modal', function () 
	{ 
		$('#txtClassification').focus(); // Focusing the textbox
	})
	
}
function deleteRowAdditional(event)
{
	//$(instituteAdminTable.fnSettings().aoData).each(function ()
	var oTable = $('#tblProgramAdditional').dataTable();	
	$(oTable.fnSettings().aoData).each(function ()
	{
		$(this.nTr).removeClass('success');
	});		
	var row;
	if(event.target.tagName == "BUTTON")
		row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
		row = event.target.parentNode.parentNode.parentNode;
	var program_code = oTable.fnGetData(row)['program_code'];;
	//alert(record_id);
	$(row).addClass('success');
   
	swal({
	  title: "Are you sure?",
	  text: "you want to Delete the record!",
	  type: "warning",
	  showCancelButton: true,
	  confirmButtonColor: "#DD6B55",
	  confirmButtonText: "Yes, Delete it!",
	  cancelButtonText: "No, cancel",
	  closeOnConfirm: false,
	  closeOnCancel: true
	},
	function(isConfirm){
	  if (isConfirm) {
	  	delete_additional();
	    swal("Delete", "Record Deleted Successfully.", "success");
	  } else {
		    swal("Cancelled", "Not Deleted ", "error");
	  }
	});
    function delete_additional(){
		var institutedata=
		{
			hidEmpId:program_code,
		};		
		//ajax call to server
		$.ajax({
			url:base_url+"ajax_controller/delete_additional_info",
			type:"post",
			data:institutedata,
			success:function(response)
			{  
				//Load table function	
				load_additional_table();
				//Displying success message
				toastr.success('Record Deleted Successfully');							
			},
			error:function()
			{
				toastr.error('Unable to process please contact support');
			}
		});	
	}
		
	
}
function deleteRow(event)
{
	var session = $('#hidSessionCode').val();
	$('#programDeleteModal').modal('show');
	var oTable = $('#tblProgramMaster').dataTable();
	var row;
	if(event.target.tagName == "BUTTON" || event.target.tagName == "A")
	   row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
	   row = event.target.parentNode.parentNode.parentNode;	
	var programCode = oTable.fnGetData(row)['progcode'];
	$('#hidUniqueidEdit').val(programCode);
	
}

$('#programDeleteRecord').click(function()
{
	
	$('#programDeleteModal').modal('hide');	
	var institutedata=
	{
		programCode:$('#hidUniqueidEdit').val(),
	};		
	//ajax call to server
	$.ajax({
		url:base_url+"ajax_controller/delete_current",
		type:"post",
		data:institutedata,
		success:function(response)
		{  
			var dtblProgram = $("#tblProgramMaster").DataTable();
 			dtblProgram.ajax.reload();
			toastr.success('Data Successfully Deleted');				 
		},
		error:function()
		{
			toastr.error('Unable to process please contact support');
		}
	});		
});
function countProgramMenu(param)
{
	var institutedata = {
		program_code: param
	};
	$.ajax({
		//url:"program_db.php?type=COUNT_MENU&program_code="+param+"&_s="+session,
		url:base_url+"ajax_controller/count_program_menu",
		type:"post",
		data : institutedata,
		success:function(response)
		{
			var count = '';
			count = " ( Total Menu : "+response+",";
			$('#spanProgramMenu').html("");
			$('#spanProgramMenu').html(count);
		},  
		error:function()
		{
			toastr.error('Unable to process please contact support');
		}
	}); 
	
}
function countActiveProgramMenu(param)
{
	var institutedata = {
		program_code: param
	};
	$.ajax({
		url:base_url+"ajax_controller/count_active_program_menu",
		type:"post",
		data : institutedata,
		success:function(response)
		{
			var count ="";
			count = " Active Menu : "+response+",";
			$('#spanActiveProgramMenu').html("");
			$('#spanActiveProgramMenu').html(count);
		},  
		error:function()
		{
			toastr.error('Unable to process please contact support');
		}
	}); 
	
}
function countShowProgramMenu(param)
{
	var institutedata = {
		program_code: param
	};
	$.ajax({
		url:base_url+"ajax_controller/count_show_menu",
		type:"post",
		data : institutedata,
		success:function(response)
		{
			var count ="";
			count = " Shown Menu : "+response+")";
			$('#spanShowProgramMenu').html("");
			$('#spanShowProgramMenu').html(count);
		},  
		error:function()
		{
			toastr.error('Unable to process please contact support');
		}
	}); 
	
}
function countZeroFeeCategory(param)
{
	var institutedata = {
		program_code: param
	};
	$.ajax({
		url:base_url+"ajax_controller/count_zero",
		type:"post",
		data : institutedata,
		success:function(response)
		{
			$('#spanLoadFee').hide();
			$('#spanProgramFee').show();
			//alert(response);
			var count ="";
			count = " ( Zero Fee Category : "+response+" )";
			$('#spanProgramFee').html("");
			$('#spanProgramFee').html(count);
		},  
		error:function()
		{
			toastr.error('Unable to process please contact support');
		}
	}); 
	
}
function countInactiveDocuments(param)
{
	var institutedata = {
		program_code: param
	};
	$.ajax({
		url:base_url+"ajax_controller/inactive_documents",
		type:"post",
		data : institutedata,
		success:function(response)
		{
			//alert(response);
			$('#spanLoadDocument').hide();
			$('#spanProgramDocuments').show();
			var count ="";
			count = " ( None Required Documents : "+response+" )";
			$('#spanProgramDocuments').html("");
			$('#spanProgramDocuments').html(count);
		},  
		error:function()
		{
			toastr.error('Unable to process please contact support');
		}
	}); 
	
}
function countChallan(param)
{
	var institutedata = {
		program_code: param
	};
	$.ajax({
		url:base_url+"ajax_controller/count_challan",
		type:"post",
		data : institutedata,
		success:function(response)
		{
			$('#spanLoadChallan').hide();
			$('#spanProgramChallan').show();
			var count ="";
			count = " ( Active Challan Details : "+response+" )";
			$('#spanProgramChallan').html("");
			$('#spanProgramChallan').html(count);
		},  
		error:function()
		{
			toastr.error('Unable to process please contact support');
		}
	}); 
	
}
function countExamCentre(param)
{
	var institutedata = {
		program_code: param
	};
	$.ajax({
		url:base_url+"ajax_controller/count_examcenter",
		type:"post",
		data : institutedata,
		success:function(response)
		{
			$('#spanLoadExamCentre').hide();
			$('#spanProgramExamCentre').show();
			var count ="";
			count = " ( Active Exam Centre : "+response+" )";
			$('#spanProgramExamCentre').html("");
			$('#spanProgramExamCentre').html(count);
		},  
		error:function()
		{
			toastr.error('Unable to process please contact support');
		}
	}); 
	
}
function countInActiveSmsType(param)
{
	var institutedata = {
		program_code: param
	};
	$.ajax({
		url:base_url+"ajax_controller/count_inactive_sms",
		type:"post",
		data : institutedata,
		success:function(response)
		{
			//alert(response);
			$('#spanLoadSms').hide();
			$('#spanProgramSms').show();
			var count ="";
			count = " ( Inactive SMS Type : "+response+" )";
			$('#spanProgramSms').html("");
			$('#spanProgramSms').html(count);
		},  
		error:function()
		{
			toastr.error('Unable to process please contact support');
		}
	}); 
	
}
function countInActiveCategory(param)
{
	var institutedata = {
		program_code: param
	};
	$.ajax({
		url:base_url+"ajax_controller/count_inactive_cat",
		type:"post",
		data : institutedata,
		success:function(response)
		{
			$('#spanLoadCategory').hide();
			$('#spanProgramCategory').show();
			//alert(response);
			var count ="";
			count = " ( Inactive Category : "+response+" )";
			$('#spanProgramCategory').html("");
			$('#spanProgramCategory').html(count);
		},  
		error:function()
		{
			toastr.error('Unable to process please contact support');
		}
	}); 
	
}
function select_program()
{
	var session = $('#hidSessionCode').val();
	$.ajax({
		"url": base_url+"/ajax_controller/get_copyform_data",
		type:"post",
		success:function(response){  
			var res1 = JSON.parse(response);
		    var options = "<option value=''>Select</option>";
		    $.each(res1.aaData,function(i,data)
		    {
		    	options = options + "<option value='"+data.program_code+"'>"+data.program_name+"</option>";
		    });
		    $('#cmbCopyFrom').html("");   
			$('#cmbCopyFrom').append(options);
			$('#cmbCopyFrom').html(options)
			
		},
		error:function(){
			alert("We are unable to Process.Please contact Support");
		}
	});
	
}
function select_program_group()
{
	var session = $('#hidSessionCode').val();
	$.ajax({
		"url": base_url+"/ajax_controller/get_program_group_data",
		type:"get",
		success:function(response){  
		    var res1 = JSON.parse(response);     
		    var options = "<option value=''>Select</option>";
		    $.each(res1.aaData,function(i,data)
		    {
		    	options = options + "<option value='"+data.program_group_code+"'>"+data.program_group_name+"</option>";
		    });
		    $('#cmbProgramGroupCopy').html("");   
			$('#cmbProgramGroupCopy').append(options);
			$('#cmbProgramGroupCopy').html(options)
		},
		error:function(){
			alert("We are unable to Process.Please contact Support");
		}
	});
}
function load_old_table()
{
	year = $('#cmbYear').val();
	var institutedata = {
		y :year
	};
	if(year == null || year == '')
	{
		$.ajax({
			"url": base_url+"/ajax_controller/SELECT_OLD",
			type:"POST",
			data : institutedata,
			success:function(response)
			{  				
				var res1 = JSON.parse(response);					
				var table = $('#tblProgramMasterOld').DataTable();
				table.clear().draw();
				table.rows.add(res1.aaData).draw();	
			},
			error:function()
			{
				toastr.error("We are unable to Process.Please contact Support");
			}
		});
	}
	else
	{
		$.ajax({
			"url": base_url+"/ajax_controller/SELECT_OLD",
			type:"POST",
			data : institutedata,
			success:function(response)
			{  				
				var res1 = JSON.parse(response);					
				var table = $('#tblProgramMasterOld').DataTable();
				table.clear().draw();
				table.rows.add(res1.aaData).draw();	
			},
			error:function()
			{
				toastr.error("We are unable to Process.Please contact Support");
			}
		});
	}
}
function load_additional_table()
{
	//alert("hello");
	$.ajax({
		"url": base_url+"/ajax_controller/get_program_additional_data",
		type:"POST",
		data : '',
		success:function(response)
		{  				
			var res1 = JSON.parse(response);					
			var table = $('#tblProgramAdditional').DataTable();
			table.clear().draw();
			table.rows.add(res1.aaData).draw();
			var options = "<option value=''>Select</option>";
		    $.each(res1.aaData,function(i,data)
		    {
		    	options = options + "<option value='"+data.program_code+"'>"+data.program_name+"</option>";
		    });
		    $('#cmbAdditionalProgram').html("");   
			$('#cmbAdditionalProgram').append(options);
			$('#cmbAdditionalProgram').html(options);	
		},
		error:function()
		{
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
	
	

}
function viewLatestInformation(event)
{
	var oTable = $('#tblProgramAdditional').dataTable();	
	$(oTable.fnSettings().aoData).each(function ()
	{
		$(this.nTr).removeClass('success');
	});		
	var row;
	if(event.target.tagName == "BUTTON")
		row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
		row = event.target.parentNode.parentNode.parentNode;
	$(row).addClass('success');
	var link_path = oTable.fnGetData( row )['link_path'];
	var link1 = oTable.fnGetData( row )['link'];
	//alert(link1);return;
	if(link_path != '#')
	{
		window.open(link1);
	}
	else
	{
		//alert(1);return;
		$('#viewModal').modal('show');
		$('#link_description').html(' ');
		$('#link_description').html(link1);
		
	}
	
}


