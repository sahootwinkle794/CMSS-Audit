$(document).ready(function() {
	$('[data-toggle="tooltip"]').tooltip(); 
	$('#txtFirstName').on('keydown', function(e) {
		//console.log(e.which);
		if(e.which != 37 &&  e.which != 39 && e.which != 8 )
		{
			var str = document.getElementById("txtFirstName").value;
		    var res = str.toUpperCase();
		    document.getElementById("txtFirstName").value = res;
		}
 	});
 	$("#txtDOJ").change(function(){
 		$('#frmApply').data('bootstrapValidator').updateStatus('txtDOJ', 'VALID', null);
 	});
 	$("#txtDateOfDebar").change(function(){
 		$('#frmApply').data('bootstrapValidator').updateStatus('txtDateOfDebar', 'VALID', null);
 	});
 	$("#cmbCommunity").change(function () {
		var institutedata={
			category:$("#cmbCommunity").val()
		};
		$.ajax({
			url:base_url+"ajax_controller/select_category_eligibility_details",
			type:"post",
			data:institutedata,
			success:function(response){  
				var res1 = JSON.parse(response);
				document.getElementById("hidCatElig").value = res1;
				if(res1 == '0')
				{
					$("#cmbCommunity").val('');
					swal({
						title: "Sorry",
						text: "You are not eligible to apply this program under the selected category",
						type: "error"
					},
					function(isConfirm) {
					  if (isConfirm) {
					  	//window.location.href = ("<?php echo base_url() ?>index/institute_login/ins/<?php echo $ins; ?>");
					  }
					});
				}
				/*$.each(res1.aaData,function(i,data){
					options = options + "<option value="+data.district_code+">"+data.district_name+"</option>";
					
				});
				swal({
					title: "Registration",
					text: "Congratulation!!! Your registration successfully completed. Please check your mail for details.",
					//type: "success"
				},
				function(isConfirm) {
				  if (isConfirm) {
				  	//window.location.href = ("<?php echo base_url() ?>index/institute_login/ins/<?php echo $ins; ?>");
				  }
				});	*/	
				//alert(options);
				/*$('#cmbPresentDist').html("");   //campusid from academicPeriod
				$('#cmbPresentDist').append(options);
				$("#spanState").hide();*/
			},
			error:function(){
				toastr.error("We are unable to Process.Please contact Support");
			}
		});
    });
 	$("#cmbCommunity").change(function () {
 		if($("#cmbCommunity").val() == 'PH')
 		{
			$("#radioPhysicallYY"). prop("checked", true);
			$("input[name=radioPhysicallY]").attr('disabled', true);
			$("#divPH").show();	
		}
		else
		{
			$("#radioPhysicallYY"). prop("checked", false);
			$("input[name=radioPhysicallY]").attr('disabled', false);
			$("#divPH").hide();	
		}
 	});
 	$("#txtgrading1").change(function () {
 		$("#txtPercent1").val('');
 		$('#frmApply').data('bootstrapValidator').updateStatus('txtPercent1', 'VALID', null);
 	});
 	$("#txtgrading2").change(function () {
 		$("#txtPercent2").val('');
 		$('#frmApply').data('bootstrapValidator').updateStatus('txtPercent2', 'VALID', null);
 	});
 	$("#txtgrading3").change(function () {
 		$("#txtPercent3").val('');
 		$('#frmApply').data('bootstrapValidator').updateStatus('txtPercent3', 'VALID', null);
 	});
 	$("#txtgrading4").change(function () {
 		$("#txtPercent4").val('');
 		$('#frmApply').data('bootstrapValidator').updateStatus('txtPercent4', 'VALID', null);
 	});
 	$("#txtgrading5").change(function () {
 		$("#txtPercent5").val('');
 		$('#frmApply').data('bootstrapValidator').updateStatus('txtPercent5', 'VALID', null);
 	});
 	$("#txtgrading6").change(function () {
 		$("#txtPercent6").val('');
 		$('#frmApply').data('bootstrapValidator').updateStatus('txtPercent6', 'VALID', null);
 	});
 	$("#txtgrading7").change(function () {
 		$("#txtPercent7").val('');
 		$('#frmApply').data('bootstrapValidator').updateStatus('txtPercent7', 'VALID', null);
 	});
 	$("#txtgrading8").change(function () {
 		$("#txtPercent8").val('');
 		$('#frmApply').data('bootstrapValidator').updateStatus('txtPercent8', 'VALID', null);
 	});
 	$("#txtGradingOth1").change(function () {
 		$("#txtCGPA1").val('');
 		$('#frmApply').data('bootstrapValidator').updateStatus('txtCGPA1', 'VALID', null);
 	});
 	$("#txtGradingOth2").change(function () {
 		$("#txtCGPA2").val('');
 		$('#frmApply').data('bootstrapValidator').updateStatus('txtCGPA2', 'VALID', null);
 	});
 	/*var state = $("#hidState").val();
		
	if(state != '')
	{
		$("#spanState").show();
		var institutedata={
			state:state
		};
		$.ajax({
			url:base_url+"ajax_controller/select_district_details",
			type:"post",
			data:institutedata,
			success:function(response){  
				var options = "<option value =''>Select District</option>";
				var res1 = JSON.parse(response);
				//alert(res1);
				$.each(res1.aaData,function(i,data){
					options = options + "<option value="+data.district_code+">"+data.district_name+"</option>";
					
				});
							
				//alert(options);
				$('#cmbHomeDist').html("");   //campusid from academicPeriod
				$('#cmbHomeDist').append(options);
				$("#spanState").hide();
			},
			error:function(){
				toastr.error("We are unable to Process.Please contact Support");
			}
		});
	}*/
	$('.btnNext').click(function(){
		$('.nav-tabs > .active').next('li').find('a').trigger('click');
	});

	$('.btnPrevious').click(function(){
		$('.nav-tabs > .active').prev('li').find('a').trigger('click');
	});
	
	$("#forReservedQuota").hide();
	$("#onlineMode").hide();
	$("#offlineMode").hide();
	//$("#divAcademicInfoAppeared").hide();
	if($("input[name=mode]:checked").val()=="Offline")
	{
		$("#onlineMode").hide();
		$("#offlineMode").show();
		$("#forReservedQuota").show();
		
	}
	if($("input[name=mode]:checked").val()=="Online")
	{
		$("#onlineMode").show();
		//$("#forReservedQuota").show();
		$("#offlineMode").hide();
		//$("#divAcademicInfoAppeared").show();
	}
	$("#modeOffline").click(function () {
        $("#onlineMode").hide();
		$("#offlineMode").show();
		$("#forReservedQuota").show();
    });
	$("#modeOnline").click(function () {
        $("#onlineMode").show();
        $("#forReservedQuota").show();
		$("#offlineMode").hide();
    });
	
	
	/*if($("input[name=radioMarkSheet]:checked").val()=="Yes")
	{
		$("#divAcademicInfo").show();
		$("#GRADUTION").show();
		$("#radioNoGradCert").show();
		$("#radioGradMarkSheet").show();
		$( "#txtMS1" ).prop( "disabled", false);
		$( "#txtFM1" ).prop( "disabled", false);
		
		
	}
	if($("input[name=radioMarkSheet]:checked").val()=="No")
	{
		$("#divAcademicInfo").show();
		$("#GRADUTION").show();
		$("#radioNoGradCert").hide();
		$("#radioGradMarkSheet").hide();
		$( "#txtMS1" ).prop( "disabled", true);
		$( "#txtFM1" ).prop( "disabled", true);
		$("#txtMS1").val('')
		$("#txtFM1").val('')
		$("#txtPercent1").val('')
		
		
	}*/
	
	
	
	if($("input[name=radioQuota]:checked").val()=="Yes")
	{
		$("#forReservedQuota").show();
	}
	if($("input[name=radioQuota]:checked").val()=="No")
	{
		$("#forReservedQuota").hide();
	}
	$("#radioyes").click(function () {
        $("#forReservedQuota").show();	
    });
	$("#radiono").click(function () {
        $("#forReservedQuota").hide();	
    });
    
   /* $("#radioYesMarks").click(function () {
        $("#divAcademicInfo").show();	
        $("#GRADUTION").show();	
        $("#radioNoGradCert").show();
		$("#radioGradMarkSheet").show();
		$("#txtMS1").prop( "disabled", false);
		$("#txtFM1").prop( "disabled", false);
        //$("#divAcademicInfoAppeared").hide();	
    });
    
	$("#radioNoMarks").click(function () {
        $("#divAcademicInfo").show();	
        $("#GRADUTION").show();	
        $("#radioNoGradCert").hide();
		$("#radioGradMarkSheet").hide();
		
		$("#txtMS1").prop( "disabled", true);
		$("#txtFM1").prop( "disabled", true);
		$("#txtMS1").val('')
		$("#txtFM1").val('')
		$("#txtPercent1").val('')
		
        //$("#divAcademicInfoAppeared").show();	
    });*/
    $("#divPH").hide();
	if($("input[name=radioPhysicallY]:checked").val()=="YES")
	{
		$("#divPH").show();	
	}
	else
	{
		$("#divPH").hide();
	}
	$("#radioPhysicallYY").click(function () {
        $("#divPH").show();	
    });
    $("#radioPhysicallYN").click(function () {
        $("#divPH").hide();
    });
    
    $("#divEmpSuspendedInfo").hide();
	if($("input[name=empGovt]:checked").val()=="YES")
	{
		$("#divEmpSuspendedInfo").show();	
	}
	else
	{
		$("#divEmpSuspendedInfo").hide();
		$("#txtNameOfOffice").val("");
        $("#txtDOJ").val("");
        $("#txtNameOfPost").val("");
        
	}
	$("#empGovtyes").click(function () {
        $("#divEmpSuspendedInfo").show();	
    });
    $("#empGovtno").click(function () {
        $("#divEmpSuspendedInfo").hide();
        $("#txtNameOfOffice").val("");
        $("#txtDOJ").val("");
        $("#txtNameOfPost").val("");
      
    });
    
    $("#divEmpDisciplinaryInfo").hide();
	if($("input[name=empDisciplinary]:checked").val()=="YES")
	{
		$("#divEmpDisciplinaryInfo").show();	
	}
	else
	{
		$("#divEmpDisciplinaryInfo").hide();
		$("#txtDateOfDebar").val("");
        $("#txtPeriodOfDebar").val("");
        
	}
	$("#empDisciplinaryyes").click(function () {
        $("#divEmpDisciplinaryInfo").show();	
    });
    $("#empDisciplinaryno").click(function () {
        $("#divEmpDisciplinaryInfo").hide();
        $("#txtDateOfDebar").val("");
        $("#txtPeriodOfDebar").val("");
        
    });
    
	if($("input[name=radioCourseType]:checked").val()=="Honours")
	{
		$("#tablePass").show();	
        $("#tableHonours").show();
	}
	if($("input[name=radioCourseType]:checked").val()=="Pass")
	{
		$("#tablePass").show();	
        $("#tableHonours").hide();
	}
	
    $("#radioHonours").click(function () {
        $("#tablePass").show();	
        $("#tableHonours").show();	
    });
    $("#radioPass").click(function () {
        $("#tablePass").show();	
        $("#tableHonours").hide();	
    });
	$('#txtFirstName').on('keyup', function(e) {
		//console.log(e.which);
		if(e.which != 37 && e.which != 39 && e.which != 8 )
		{
			var str = document.getElementById("txtFirstName").value;
		    var res = str.toUpperCase();
		    document.getElementById("txtFirstName").value = res;
		}
 	});
	$('#txtMiddleName').on('keydown', function(e) {
		//console.log(e.which);
		if(e.which != 37 && e.which != 39 )
		{
			var str = document.getElementById("txtMiddleName").value;
		    var res = str.toUpperCase();
		    document.getElementById("txtMiddleName").value = res;
		}
 	});
	$('#txtMiddleName').on('keyup', function(e) {
		//console.log(e.which);
		if(e.which != 37 && e.which != 39 )
		{
			var str = document.getElementById("txtMiddleName").value;
		    var res = str.toUpperCase();
		    document.getElementById("txtMiddleName").value = res;
		}
 	});
	$('#txtMiddleName').on('keydown', function(e) {
		console.log(e.which);
		if(e.which != 37 && e.which != 39 )
		{
			var str = document.getElementById("txtMiddleName").value;
		    var res = str.toUpperCase();
		    document.getElementById("txtMiddleName").value = res;
		}
 	});
	$('#txtMiddleName').on('keyup', function(e) {
		console.log(e.which);
		if(e.which != 37 && e.which != 39 )
		{
			var str = document.getElementById("txtMiddleName").value;
		    var res = str.toUpperCase();
		    document.getElementById("txtMiddleName").value = res;
		}
 	});
	$('#txtLastName').on('keydown', function(e) {
		console.log(e.which);
		if(e.which != 37 && e.which != 39 )
		{
			var str = document.getElementById("txtLastName").value;
		    var res = str.toUpperCase();
		    document.getElementById("txtLastName").value = res;
		}
 	});
	$('#txtLastName').on('keyup', function(e) {
		console.log(e.which);
		if(e.which != 37 && e.which != 39 )
		{
			var str = document.getElementById("txtLastName").value;
		    var res = str.toUpperCase();
		    document.getElementById("txtLastName").value = res;
		}
 	});
	$('#txtFirstName').on('change', function(e) {
		//console.log(e.which);
		var str = document.getElementById("txtFirstName").value;
		var res = str.toUpperCase();
		document.getElementById("txtFirstName").value = res;
		
 	});
	
  	$('#txtMiddleName').on('change', function(e)  {
	 	var str = document.getElementById("txtMiddleName").value;
	    var res = str.toUpperCase();
	    document.getElementById("txtMiddleName").value = res;
	});
	$('#txtLastName').on('change', function(e) {
	 	var str = document.getElementById("txtLastName").value;
	    var res = str.toUpperCase();
	    document.getElementById("txtLastName").value = res;
	});
	
	$('#frmApply').bootstrapValidator({
		excluded: [':disabled',':hidden', ':not(:visible)'],
        message: 'This value is not valid',
        fields: {
			radiogender: {
                validators: {
                    notEmpty: {
                        message: 'Please Select the Gender'
                    }
                }
            },
            cmbExamCenter: {
                validators: {
                    notEmpty: {
                        message: 'Please Select the Exam Center'
                    }
                }
            },
			cmbCategory: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            }, 
			txtFatherName: {
                validators: {
                    regexp: {
                        regexp: /^([a-zA-Z. ]+)$/,
                        message: "only Alphabet are  allowed"
					}, 
					stringLength: {
						max: 80,
						message: 'Maximum 80 character`s are allowed'
					}
                }
            },
            
			txtPresentAddress:{
				validators: {
					notEmpty: {
						message: 'Required'
					},
                    regexp: {
                        regexp: /^([a-zA-Z0-9-\n\r \/.,();]+)$/,
                        message: "only Alphabet,Numbers and These . , - / ( ) ; Symbols are  allowed"
					}, 
					stringLength: {
						max: 80,
						message: 'Maximum 80 character`s are allowed'
					}
				}
			},
			txtPresentLocality:{
				validators: {
					notEmpty: {
						message: 'Required'
					},
                    regexp: {
                        regexp: /^([a-zA-Z0-9-\n\r \/.,();]+)$/,
                        message: "only Alphabet,Numbers and These . , - / ( ) ; Symbols are  allowed"
					}, 
					stringLength: {
						max: 80,
						message: 'Maximum 80 character`s are allowed'
					}
				}
			},
			txtPresentPost:{
				validators: {
					notEmpty: {
						message: 'Required'
					},
                    regexp: {
                        regexp: /^([a-zA-Z0-9-\n\r \/.,();]+)$/,
                        message: "only Alphabet,Numbers and These . , - / ( ) ; Symbols are  allowed"
					}, 
					stringLength: {
						max: 80,
						message: 'Maximum 80 character`s are allowed'
					}
				}
			},
			cmbPresentState:{
						validators: {
							notEmpty: {
								message: 'Required'
							}
						}
			},
			cmbPresentDist:{
						validators: {
							notEmpty: {
								message: 'Required'
							}
						}
			},
			txtPresentPin:{
				validators: {
					notEmpty: {
						message: 'Required'
					},
							
					digits: {
							message: 'The value can contain only digits'
						}, 
					stringLength: {
						max: 6,
						min:6,
						message: 'Pin no must be 6 characters long'
					}
				}
			},
			txtPermanentPin:{
						validators: {
							notEmpty: {
							message: 'Required'
						},
							digits: {
							message: 'The value can contain only digits'
						}, 
					stringLength: {
						max: 6,
						min:6,
						message: 'Pin no must be 6 characters long'
					}
				}
			},
		   
		   txtPermenentLocality: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    regexp: {
                        regexp: /^([a-zA-Z0-9-\n\r \/.,();]+)$/,
                        message: "Only Alphabet,Numbers and These . , - / ( ) ; Symbols are  allowed"
					}, 
					stringLength: {
						max: 80,
						message: 'Maximum 80 character`s are allowed'
					}
				}
			},
		   txtPermanentPost: {
                validators: {
                	notEmpty: {
						message: 'Required'
					},
                    regexp: {
                        regexp: /^([a-zA-Z0-9-\n\r \/.,();]+)$/,
                        message: "Only Alphabet,Numbers and These . , - / ( ) ; Symbols are  allowed"
					}, 
					stringLength: {
						max: 80,
						message: 'Maximum 80 character`s are allowed'
					}
				}
			},
		   city_name1: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    regexp: {
                        regexp: /^([a-zA-Z0-9-\n\r \/.,();]+)$/,
                        message: "Only Alphabet,Numbers and These . , - / ( ) ; Symbols are  allowed"
					}, 
					stringLength: {
						max: 80,
						message: 'Maximum 80 character`s are allowed'
					}
				}
			},
		   cmbPermanentState: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
				}
			},
		   cmbPermanentDist: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
				}
			},
		   chkUndertaking1: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
				}
			},
			txtYearQual1: {
                validators: {
                    integer: {
                        message: 'invalid year'
                    }, 
					stringLength: {
						max: 4,
						min: 4,
						message: 'Year must be 4 digit number'
					},
					callback: {
                        message: 'Year must be greater </br> than birth year and </br> less than current year',
                        callback: function (value, validator, $field) {
                            // Determine the numbers which are generated in captchaOperation
                            if(parseInt(todayyear) < parseInt(value))
							{
								return false;
							}else if( parseInt(value) < parseInt(birthyear))
							{
								return false;
							}else{
								return true;
							}
                        }
                    }
				}
			},
			txtYearQual2: {
                validators: {
                    integer: {
                        message: 'invalid year'
                    }, 
					stringLength: {
						max: 4,
						min: 4,
						message: 'Year must be 4 digit number'
					},
					callback: {
                        message: 'Year must be greater </br> than birth year and </br> less than current year',
                        callback: function (value, validator, $field) {
                            // Determine the numbers which are generated in captchaOperation
                            if(parseInt(todayyear) < parseInt(value))
							{
								return false;
							}else if( parseInt(value) < parseInt(birthyear))
							{
								return false;
							}else{
								return true;
							}
                        }
                    }
				}
			},
			txtYear1: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    },
                    integer: {
                        message: 'invalid year'
                    }, 
					stringLength: {
						max: 4,
						min: 4,
						message: 'Year must be 4 digit number'
					},
					callback: {
                        message: 'Year must be greater </br> than birth year and </br> less than current year',
                        callback: function (value, validator, $field) {
                            // Determine the numbers which are generated in captchaOperation
                            if(parseInt(todayyear) < parseInt(value))
							{
								return false;
							}else if( parseInt(value) < parseInt(birthyear))
							{
								return false;
							}else{
								return true;
							}
                        }
                    }
				}
			},
			txtYear2: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    },
                    integer: {
                        message: 'invalid year'
                    }, 
					stringLength: {
						max: 4,
						min: 4,
						message: 'Year must be 4 digit number'
					},
					callback: {
                        message: '<ul type="disc" style="list-style: outside;"><li> Year must be greater </br> than birth year and </br> less than current year. </li><li>Senior Secondary Qualification </br>Year must be greater then </br>Secondary Qualification Year</li></ul>',
                        callback: function (value, validator, $field) {
                        	var previous_year = parseInt(document.getElementById("txtYear1").value);
                            //previous_year = previous_year + 1;
                            /*alert(previous_year);
                            alert(parseInt(value));*/
                            if(parseInt(todayyear) < parseInt(value))
							{
								return false;
							}else if( parseInt(value) < parseInt(birthyear))
							{
								return false;
							}else if((previous_year) >= parseInt(value))
							{
								return false;
							}else{
								return true;
							}
                        }
                    }
				}
			},
			txtYear3: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    },
                    integer: {
                        message: 'invalid year'
                    }, 
					stringLength: {
						max: 4,
						min: 4,
						message: 'Year must be 4 digit number'
					},
					callback: {
                        message: '<ul type="disc" style="list-style: outside;"><li> Year must be greater </br> than birth year and </br> less than current year. </li><li>Diploma Qualification </br>Year must  be  greater then </br> Secondary Qualification Year</li></ul>',
                        callback: function (value, validator, $field) {
                            // Determine the numbers which are generated in captchaOperation
                            var previous_year = parseInt(document.getElementById("txtYear2").value);
                            //previous_year = previous_year + 1;
                            if(parseInt(todayyear) < parseInt(value))
							{
								return false;
							}else if( parseInt(value) < parseInt(birthyear))
							{
								return false;
							}/*else if((previous_year) >= parseInt(value))
							{
								return false;
							}*/else{
								return true;
							}
                        }
                    }
				}
			},
			txtYear4: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    },
                    integer: {
                        message: 'invalid year'
                    }, 
					stringLength: {
						max: 4,
						min: 4,
						message: 'Year must be 4 digit number'
					},
					callback: {
                        message: '<ul type="disc" style="list-style: outside;"><li> Year must be greater </br> than birth year and </br> less than current year. </li><li>Graduation Qualification </br>Year must  be  greater then </br> Diploma Qualification Year</li></ul>',
                        callback: function (value, validator, $field) {
                            // Determine the numbers which are generated in captchaOperation
                            var previous_year = parseInt(document.getElementById("txtYear3").value);
                            //previous_year = previous_year + 1;
                            if(parseInt(todayyear) < parseInt(value))
							{
								return false;
							}else if( parseInt(value) < parseInt(birthyear))
							{
								return false;
							}else if((previous_year) >= parseInt(value))
							{
								return false;
							}else{
								return true;
							}
                        }
                    }
				}
			},
			txtYear5: {
                validators: {
                    integer: {
                        message: 'invalid year'
                    }, 
					stringLength: {
						max: 4,
						min: 4,
						message: 'Year must be 4 digit number'
					},
					callback: {
                        message: '<ul type="disc" style="list-style: outside;"><li> Year must be greater </br> than birth year and </br> less than current year. </li><li>Graduation Qualification </br>Year must  be  greater then </br> Diploma Qualification Year</li></ul>',
                        callback: function (value, validator, $field) {
                            // Determine the numbers which are generated in captchaOperation
                            var previous_year = parseInt(document.getElementById("txtYear4").value);
                            //previous_year = previous_year;
                            if(parseInt(todayyear) < parseInt(value))
							{
								return false;
							}else if( parseInt(value) < parseInt(birthyear))
							{
								return false;
							}else if(previous_year >= parseInt(value))
							{
								return false;
							}else{
								return true;
							}
                        }
                    }
				}
			},
			txtYear6: {
                validators: {
                    integer: {
                        message: 'invalid year'
                    }, 
					stringLength: {
						max: 4,
						min: 4,
						message: 'Year must be 4 digit number'
					},
					callback: {
                        message: '<ul type="disc" style="list-style: outside;"><li> Year must be greater </br> than birth year and </br> less than current year. </li><li>Graduation Qualification </br>Year must  be  greater then </br> Diploma Qualification Year</li></ul>',
                        callback: function (value, validator, $field) {
                            // Determine the numbers which are generated in captchaOperation
                            var previous_year = parseInt(document.getElementById("txtYear5").value);
                            //previous_year = previous_year;
                            if(parseInt(todayyear) < parseInt(value))
							{
								return false;
							}else if( parseInt(value) < parseInt(birthyear))
							{
								return false;
							}else if(previous_year >= parseInt(value))
							{
								return false;
							}else{
								return true;
							}
                        }
                    }
				}
			},
			txtYear8: {
                validators: {
                    integer: {
                        message: 'invalid year'
                    }, 
					stringLength: {
						max: 4,
						min: 4,
						message: 'Year must be 4 digit number'
					},
					callback: {
                        message: '<ul type="disc" style="list-style: outside;"><li> Year must be greater </br> than birth year and </br> less than current year. </li><li>Graduation Qualification </br>Year must  be  greater then </br> Diploma Qualification Year</li></ul>',
                        callback: function (value, validator, $field) {
                            // Determine the numbers which are generated in captchaOperation
                            var previous_year = parseInt(document.getElementById("txtYear7").value);
                            //previous_year = previous_year;
                            if(parseInt(todayyear) < parseInt(value))
							{
								return false;
							}else if( parseInt(value) < parseInt(birthyear))
							{
								return false;
							}else if(previous_year >= parseInt(value))
							{
								return false;
							}else{
								return true;
							}
                        }
                    }
				}
			},
			txtYear7: {
                validators: {
                    integer: {
                        message: 'invalid year'
                    }, 
					stringLength: {
						max: 4,
						min: 4,
						message: 'Year must be 4 digit number'
					},
					callback: {
                        message: '<ul type="disc" style="list-style: outside;"><li> Year must be greater </br> than birth year and </br> less than current year. </li><li>Graduation Qualification </br>Year must  be  greater then </br> Diploma Qualification Year</li></ul>',
                        callback: function (value, validator, $field) {
                            // Determine the numbers which are generated in captchaOperation
                            var previous_year = parseInt(document.getElementById("txtYear6").value);
                            previous_year = previous_year;
                            if(parseInt(todayyear) < parseInt(value))
							{
								return false;
							}else if( parseInt(value) < parseInt(birthyear))
							{
								return false;
							}else if(previous_year > parseInt(value))
							{
								return false;
							}else{
								return true;
							}
                        }
                    }
				}
			},
			txtTechnical_5_2: {
                validators: {
                    integer: {
                        message: 'invalid year'
                    }, 
					stringLength: {
						max: 4,
						min: 4,
						message: 'Year must be 4 digit number'
					},
					callback: {
                        message: '<ul type="disc" style="list-style: outside;"><li> Year must be greater </br> than birth year and </br> less than current year. </li><li>Graduation Qualification </br>Year must  be  greater then </br> Diploma Qualification Year</li></ul>',
                        callback: function (value, validator, $field) {
                            // Determine the numbers which are generated in captchaOperation
                            if(parseInt(todayyear) < parseInt(value))
							{
								return false;
							}else if( parseInt(value) < parseInt(birthyear))
							{
								return false;
							}else{
								return true;
							}
                        }
                    }
				}
			},
			txtTechnical_6_2: {
                validators: {
                    integer: {
                        message: 'invalid year'
                    }, 
					stringLength: {
						max: 4,
						min: 4,
						message: 'Year must be 4 digit number'
					},
					callback: {
                        message: '<ul type="disc" style="list-style: outside;"><li> Year must be greater </br> than birth year and </br> less than current year. </li><li>PhD Qualification </br>Year must  be  greater then </br> Diploma Qualification Year</li></ul>',
                        callback: function (value, validator, $field) {
                            // Determine the numbers which are generated in captchaOperation
                            if(parseInt(todayyear) < parseInt(value))
							{
								return false;
							}else if( parseInt(value) < parseInt(birthyear))
							{
								return false;
							}else if(parseInt(document.getElementById("txtTechnical_5_2").value) > parseInt(value))
							{
								return false;
							}else{
								return true;
							}
                        }
                    }
				}
			},
			txtBoard1: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    },
					stringLength: {
						max: 50,
						message: 'Maximum 50 character`s are allowed'
					},
                    regexp: {
                        regexp: /^([a-zA-Z-\n\r \/.,();]+)$/,
                        message: "Only Alphabet,Numbers and </br> These . , - / ( ) ; Symbols are  allowed"
					}
				}
			},
			txtBoard2: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    },
					stringLength: {
						max: 50,
						message: 'Maximum 50 character`s are allowed'
					},
                    regexp: {
                        regexp: /^([a-zA-Z-\n\r \/.,();]+)$/,
                        message: "Only Alphabet,Numbers and </br> These . , - / ( ) ; Symbols are  allowed"
					}
				}
			},
			txtBoard3: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    },
					stringLength: {
						max: 50,
						message: 'Maximum 50 character`s are allowed'
					},
                    regexp: {
                        regexp: /^([a-zA-Z-\n\r \/.,();]+)$/,
                        message: "Only Alphabet,Numbers and </br> These . , - / ( ) ; Symbols are  allowed"
					}
				}
			},
			txtBoard4: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    },
					stringLength: {
						max: 50,
						message: 'Maximum 50 character`s are allowed'
					},
                    regexp: {
                        regexp: /^([a-zA-Z-\n\r \/.,();]+)$/,
                        message: "Only Alphabet,Numbers and </br> These . , - / ( ) ; Symbols are  allowed"
					}
				}
			},
			txtFM1: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    },
					stringLength: {
						max: 4,
						message: 'Maximum 4 digit number`s are allowed'
					},
					integer: {
                        message: 'Invalid Number'
                    },
					callback: {
                        message: 'Maximum mark must be </br> greater than mark secured',
                        callback: function (value, validator, $field) {
                            if(parseInt(document.getElementById("txtMS1").value) > parseInt(value) )
							{
								return false;
							}else{
								return true;
							}
                        }
                    }
				}
			},
			txtFM2: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    },
					stringLength: {
						max: 4,
						message: 'Maximum 4 digit number`s are allowed'
					},
					integer: {
                        message: 'Invalid Number'
                    },
					callback: {
                        message: 'Maximum mark must be </br> greater than mark secured',
                        callback: function (value, validator, $field) {
                            if(parseInt(document.getElementById("txtMS2").value) > parseInt(value) )
							{
								return false;
							}else{
								return true;
							}
                        }
                    }
				}
			},
			txtFM3: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    },
					stringLength: {
						max: 4,
						message: 'Maximum 4 digit number`s are allowed'
					},
					integer: {
                        message: 'Invalid Number'
                    },
					callback: {
                        message: 'Maximum mark must be </br> greater than mark secured',
                        callback: function (value, validator, $field) {
                            if(parseInt(document.getElementById("txtMS3").value) > parseInt(value) )
							{
								return false;
							}else{
								return true;
							}
                        }
                    }
				}
			},
			txtFM4: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    },
					stringLength: {
						max: 4,
						message: 'Maximum 4 digit number`s are allowed'
					},
					integer: {
                        message: 'Invalid Number'
                    },
					callback: {
                        message: 'Maximum mark must be </br> greater than mark secured',
                        callback: function (value, validator, $field) {
                            if(parseInt(document.getElementById("txtMS3").value) > parseInt(value) )
							{
								return false;
							}else{
								return true;
							}
                        }
                    }
				}
			},
			txtqual22: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    }
				}
			},
			txtqual23: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    }
				}
			},
			txtqual24: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    }
				}
			},
			txtgrading1: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    }
				}
			},
			txtgrading2: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    }
				}
			},
			txtgrading3: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    }
				}
			},
			txtgrading4: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    }
				}
			},
			txtdistinct1: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    }
				}
			},
			txtdistinct2: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    }
				}
			},
			txtdistinct4: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    }
				}
			},
			txtPercent1: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    },
                    lessThan: {
                        value: 101,
                        message: 'must be less than or equal to 100'
                    },
					callback: {
                        message: 'Should be less than 10.<br>',
                        callback: function (value, validator, $field) {
                            if(document.getElementById("txtgrading1").value  == 'YES' )
							{
								var totalMarkX = value;
								var numX = parseFloat(totalMarkX);
								if(numX > 10.00)
								{
	                                return false;
								}
								else{
									return true;
								}
								
							}
							else{
								return true;
							}
                        }
                    }
				}
			},
			txtPercent3: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    },
                    lessThan: {
                        value: 101,
                        message: 'must be less than or equal to 100'
                    },
					callback: {
                        message: 'Should be less than 10.<br>',
                        callback: function (value, validator, $field) {
                            if(document.getElementById("txtgrading3").value  == 'YES' )
							{
								var totalMarkX = value;
								var numX = parseFloat(totalMarkX);
								if(numX > 10.00)
								{
	                                return false;
								}
								else{
									return true;
								}
								
							}
							else{
								return true;
							}
                        }
                    }
				}
			},
			txtPercent2: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    },
                    lessThan: {
                        value: 101,
                        message: 'must be less than or equal to 100'
                    },
					callback: {
                        message: 'Should be less than 10.<br>',
                        callback: function (value, validator, $field) {
                            if(document.getElementById("txtgrading2").value  == 'YES' )
							{
								var totalMarkX = value;
								var numX = parseFloat(totalMarkX);
								if(numX > 10.00)
								{
	                                return false;
								}
								else{
									return true;
								}
								
							}
							else{
								return true;
							}
                        }
                    }
				}
			},
			txtPercent4: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    },
                    lessThan: {
                        value: 101,
                        message: 'must be less than or equal to 100'
                    },
					callback: {
                        message: 'Should be less than 10.<br>',
                        callback: function (value, validator, $field) {
                            if(document.getElementById("txtgrading4").value  == 'YES' )
							{
								var totalMarkX = value;
								var numX = parseFloat(totalMarkX);
								if(numX > 10.00)
								{
	                                return false;
								}
								else{
									return true;
								}
								
							}
							else{
								return true;
							}
                        }
                    }
				}
			},
			txtCGPA1: {
                validators: {
                    lessThan: {
                        value: 101,
                        message: 'must be less than or equal to 100'
                    },
					callback: {
                        message: 'Should be less than 10.<br>',
                        callback: function (value, validator, $field) {
                            if(document.getElementById("txtGradingOth1").value  == 'YES' )
							{
								var totalMarkX = value;
								var numX = parseFloat(totalMarkX);
								if(numX > 10.00)
								{
	                                return false;
								}
								else{
									return true;
								}
								
							}
							else{
								return true;
							}
                        }
                    }
				}
			},
			txtCGPA2: {
                validators: {
                    lessThan: {
                        value: 101,
                        message: 'must be less than or equal to 100'
                    },
					callback: {
                        message: 'Should be less than 10.<br>',
                        callback: function (value, validator, $field) {
                            if(document.getElementById("txtGradingOth2").value  == 'YES' )
							{
								var totalMarkX = value;
								var numX = parseFloat(totalMarkX);
								if(numX > 10.00)
								{
	                                return false;
								}
								else{
									return true;
								}
								
							}
							else{
								return true;
							}
                        }
                    }
				}
			},
			txtPercent5: {
                validators: {
                    lessThan: {
                        value: 101,
                        message: 'must be less than or equal to 100'
                    },
					callback: {
                        message: 'Should be less than 10.<br>',
                        callback: function (value, validator, $field) {
                            if(document.getElementById("txtgrading5").value  == 'YES' )
							{
								var totalMarkX = value;
								var numX = parseFloat(totalMarkX);
								if(numX > 10.00)
								{
	                                return false;
								}
								else{
									return true;
								}
								
							}
							else{
								return true;
							}
                        }
                    }
				}
			},
			txtPercent6: {
                validators: {
                    lessThan: {
                        value: 101,
                        message: 'must be less than or equal to 100'
                    },
					callback: {
                        message: 'Should be less than 10.<br>',
                        callback: function (value, validator, $field) {
                            if(document.getElementById("txtgrading6").value  == 'YES' )
							{
								var totalMarkX = value;
								var numX = parseFloat(totalMarkX);
								if(numX > 10.00)
								{
	                                return false;
								}
								else{
									return true;
								}
								
							}
							else{
								return true;
							}
                        }
                    }
				}
			},
			txtPercent7: {
                validators: {
                    lessThan: {
                        value: 101,
                        message: 'must be less than or equal to 100'
                    },
					callback: {
                        message: 'Should be less than 10.<br>',
                        callback: function (value, validator, $field) {
                            if(document.getElementById("txtgrading7").value  == 'YES' )
							{
								var totalMarkX = value;
								var numX = parseFloat(totalMarkX);
								if(numX > 10.00)
								{
	                                return false;
								}
								else{
									return true;
								}
								
							}
							else{
								return true;
							}
                        }
                    }
				}
			},
			txtPercent8: {
                validators: {
                    lessThan: {
                        value: 101,
                        message: 'must be less than or equal to 100'
                    },
					callback: {
                        message: 'Should be less than 10.<br>',
                        callback: function (value, validator, $field) {
                            if(document.getElementById("txtgrading8").value  == 'YES' )
							{
								var totalMarkX = value;
								var numX = parseFloat(totalMarkX);
								if(numX > 10.00)
								{
	                                return false;
								}
								else{
									return true;
								}
								
							}
							else{
								return true;
							}
                        }
                    }
				}
			},
			radioPhysicallY: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
				}
			},
			cmbCommunity: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
				}
			},
			city_name: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    regexp: {
                        regexp: /^([a-zA-Z0-9-\n\r \/.,();]+)$/,
                        message: "only Alphabet,Numbers and These . , - / ( ) ; Symbols are  allowed"
					}, 
					stringLength: {
						max: 80,
						message: 'Maximum 80 character`s are allowed'
					}
				}
			},
			Employer_address: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    regexp: {
                        regexp: /^([a-zA-Z0-9-\n\r \/.,();]+)$/,
                        message: "only Alphabet,Numbers and These . , - / ( ) ; Symbols are  allowed"
					}, 
					stringLength: {
						max: 80,
						message: 'Maximum 80 character`s are allowed'
					}
				}
			},
			Employer_from: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
				}
			},
			cmbHomeDist: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
				}
			},
			refname0: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    regexp: {
                        regexp: /^([a-zA-Z0-9-\n\r \/.,();]+)$/,
                        message: "only Alphabet,Numbers and These . , - / ( ) ; Symbols are  allowed"
					}, 
					stringLength: {
						max: 80,
						message: 'Maximum 80 character`s are allowed'
					}
				}
			},
			refname1: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    regexp: {
                        regexp: /^([a-zA-Z0-9-\n\r \/.,();]+)$/,
                        message: "only Alphabet,Numbers and These . , - / ( ) ; Symbols are  allowed"
					}, 
					stringLength: {
						max: 80,
						message: 'Maximum 80 character`s are allowed'
					}
				}
			},
			refaddress1: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    regexp: {
                        regexp: /^([a-zA-Z0-9-\n\r \/.,();]+)$/,
                        message: "only Alphabet,Numbers and These . , - / ( ) ; Symbols are  allowed"
					}, 
					stringLength: {
						max: 80,
						message: 'Maximum 80 character`s are allowed'
					}
				}
			},
			refaddress0: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    regexp: {
                        regexp: /^([a-zA-Z0-9-\n\r \/.,();]+)$/,
                        message: "only Alphabet,Numbers and These . , - / ( ) ; Symbols are  allowed"
					}, 
					stringLength: {
						max: 80,
						message: 'Maximum 80 character`s are allowed'
					}
				}
			},
			txtidproof: {
                validators: {
                    
					stringLength: {
						max: 12,
						min: 12,
						message: 'Should be 12 characters'
					}
				}
			},
			refemail1: {
                 validators: {
                    notEmpty: {
                        message: 'The email address is required and cannot be empty'
                    },
                    emailAddress: {
                        message: 'The email address is not valid'
                    }
                }
			},
			refemail0: {
                 validators: {
                    notEmpty: {
                        message: 'The email address is required and cannot be empty'
                    },
                    emailAddress: {
                        message: 'The email address is not valid'
                    }
                }
			},
			refmobile0: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    regexp: {
                        regexp: /^([0-9]+)$/,
                        message: "Numbers allowed"
					}, 
					stringLength: {
						max: 10,
						min: 10,
						message: 'Maximum 10 character`s are allowed'
					}
				}
			},
			refmobile1: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    regexp: {
                        regexp: /^([0-9]+)$/,
                        message: "Numbers allowed"
					}, 
					stringLength: {
						max: 10,
						min: 10,
						message: 'Maximum 10 character`s are allowed'
					}
				}
			},
			
			
			
			empGovt:{
				validators: {
                    notEmpty: {
                        message: 'Required'
                    }
				}
			},
			txtNameOfOffice:{
				validators: {
                    notEmpty: {
                        message: 'Required'
                    }
				}
			},
			txtDOJ:{
				validators: {
                    notEmpty: {
                        message: 'Required'
                    }
				}
			},
			txtNameOfPost:{
				validators: {
                    notEmpty: {
                        message: 'Required'
                    }
				}
			},
			radiogender:{
				validators: {
                    notEmpty: {
                        message: 'Required'
                    }
				}
			},
			txtPeriodOfDebar:{
				validators: {
                    notEmpty: {
                        message: 'Required'
                    }
				}
			},
			txtDateOfDebar:{
				validators: {
                    notEmpty: {
                        message: 'Required'
                    }
				}
			},
			empDisciplinary:{
				validators: {
                    notEmpty: {
                        message: 'Required'
                    }
				}
			}
			
			
        }
      });
	$('.alert').hide();
	$("#forminority").hide();
	if($("input[name=radiominority]:checked").val()=="Yes")
	{
		$("#forminority").show();
	}
    $("#radioyes").click(function () {
        $("#forminority").show();	
    });
    $("#radiono").click(function () {
        $("#forminority").hide();
		$("#cmbMinority").val("");
    });
	$("#forillness").hide();
	if($("input[name=radioIllness]:checked").val()=="Yes")
	{
		$("#forillness").show();
	}
    $("#radioYesIllness").click(function () {
        $("#forillness").show();	
    });
    $("#radioNoIllness").click(function () {
        $("#forillness").hide();
		$("#txtChronicIllness").val("");
    });
	$("#forAllergies").hide();
	if($("input[name=radioAllergies]:checked").val()=="Yes")
	{
		$("#forAllergies").show();
	}
    $("#radioYesAllergies").click(function () {
        $("#forAllergies").show();	
    });
    $("#radioNoAllergies").click(function () {
        $("#forAllergies").hide();
		$("#txtAllergies").val("");
    });
	
	if($("input[name=chksameasresidential]:checked").val()=="Y")
	{
		$('#txtPermenentAddress').attr('disabled', true);
		$('#txtPermenentLocality').attr('disabled', true);
		$('#txtPermanentPost').attr('disabled', true);
		$('#cmbPermanentDist').attr('disabled', true);
		$('#cmbPermanentState').attr('disabled', true);
		$('#txtPermanentPin').attr('disabled', true);
		$('#txtOtherPermanentState').attr('disabled', true);
		$('#txtOtherPermanentDist').attr('disabled', true);
		$('#cand_name1').attr('disabled', true);
		$('#co_name1').attr('disabled', true);
		$('#city_name1').attr('disabled', true);
		$('#phone_no1').attr('disabled', true);
	}
	$("#txtUnivName").change(function () {
		if($("#txtUnivName").val()=="OTH")
		{
			$("#forOtherUniv").show();
		}
		else
		{
			$("#forOtherUniv").hide();
			$("#txtOtherUniversity").val("");
		}
    });
	$("#txtHonoursSubject").change(function () {
		if($("#txtHonoursSubject").val()=="OTH")
		{
			$("#forOtherSubject").show();
		}
		else
		{
			$("#forOtherSubject").hide();
			$("#txtOtherSubject").val("");
		}
    });
	if($("#txtHonoursSubject").val()=="OTH")
	{
		$("#forOtherSubject").show();
	}
	if($("#txtUnivName").val()=="OTH")
	{
		$("#forOtherUniv").show();
	}
	$("#cmbNationality").change(function () {
		if($("#cmbNationality").val()=="OTH")
		{
			$("#cmbCommunity").val("GEN");
			//$("input[name=radiobelong]").val("NO");
			$("input[name=radiobelong]").attr('disabled', true);
			$("#cmbCommunity").prop("disabled", true);
		}
		else
		{
			$("#forNationality").hide();
			$("#txtOtherNationality").val("");
			$("#cmbCommunity").prop("disabled", false);
			$("input[name=radiobelong]").attr('disabled', false);
		}
    });
	if($("#cmbNationality").val()=="OTH")
	{
		$("#forNationality").show();
		$("#cmbCommunity").val("GEN");
		//$("input[name=radiobelong]").val("NO");
		$("input[name=radiobelong]").attr('disabled', true);
		$("#cmbCommunity").prop("disabled", true);
	}


	$("#cmbrelationship").change(function () {
		if($("#cmbrelationship").val()=="OTH")
		{
			$("#forRelationship").show();
		}
		else
		{
			$("#forRelationship").hide();
			$("#txtOtherRelations").val("");
		}
    });
	if($("#cmbrelationship").val()=="OTH")
	{
		$("#forRelationship").show();
	}

	
	$("#cmbBoardName").change(function () {
		if($("#cmbBoardName").val()=="OTH")
		{
			$("#forBoard").show();
		}
		else
		{
			$("#forBoard").hide();
			$("#txtOtherBoard").val("");
		}
    });
	if($("#cmbBoardName").val()=="OTH")
	{
		$("#forBoard").show();
	}
	
	$("#cmbExamTypeX").change(function () {
        var examType=$("#cmbExamTypeX").val();
		if(examType == "SA-I")
		{
			$("#cmbMarkTypeX").val("CGPA");
		}
		else if(examType == "Half_Yearly_Examination")
		{
			$("#cmbMarkTypeX").val("Percentage");
		}
		else
		{
			$("#cmbMarkTypeX").val("");
		}
    });
	$("#cmbExamTypeIX").change(function () {
        var examType=$("#cmbExamTypeIX").val();
		if(examType == "SA-II")
		{
			$("#cmbMarkTypeIX").val("CGPA");
		}
		else if(examType == "Annual_Examination")
		{
			$("#cmbMarkTypeIX").val("Percentage");
		}
		else
		{
			$("#cmbMarkTypeIX").val("");
		}
    });
	$("#txtPermenentAddress").change(function () {
		
		if($("#txtPermenentAddress").val() !='')
		{
			$("#hidPermenentAddress").val($('#txtPermenentAddress').val());
			//alert($("#hidPermenentAddress").val());
		}
    });
	$("#txtPermenentLocality").change(function () {
		if($("#txtPermenentLocality").val() !='')
		{
			$("#hidPermenentLocality").val($('#txtPermenentLocality').val());
			//alert($("#hidPermenentLocality").val());
		}
    });
	$("#txtPermanentPost").change(function () {
		
		if($("#txtPermanentPost").val() !='')
		{
			$("#hidPermanentPost").val($("#txtPermanentPost").val());
			//alert($("#hidPermanentPost").val());
		}
    });
	
	$("#txtOtherPermanentDist").change(function () {
		
		if($("#txtOtherPermanentDist").val() !='')
		{
			$("#hidOtherPermanentDist").val($('#txtOtherPermanentDist').val());
			//alert($("#hidOtherPermanentDist").val());
		}
    });
	$("#txtOtherPermanentState").change(function () {
		
		if($("#txtOtherPermanentState").val() !='')
		{
			$("#hidOtherPermanentState").val($('#txtOtherPermanentState').val());
			//alert($("#hidOtherPermanentState").val());
		}
    });
	$("#txtPermanentPin").change(function () {
		
		if($("#txtPermanentPin").val() !='')
		{
			$("#hidPermanentPin").val($('#txtPermanentPin').val());
			//alert($("#hidPermanentPin").val());
		}
    });
	$("#cmbPermanentDist").change(function () {
		
		if($("#cmbPermanentDist").val() !='')
		{
			$("#hidPermanentDist").val($('#cmbPermanentDist').val());
			//alert($("#hidPermanentPin").val());
		}
    });
	$('#cmbPermanentState').change(function(){
		//alert("hello");
		permanentStateChange();
	});
	
	
	$('#cmbPresentState').change(function(){
		//alert("hello");
		var state = $("#cmbPresentState").val();
		
		if(state != '')
		{
			$("#spanState").show();
			var institutedata={
				state:state
			};
			$.ajax({
				url:base_url+"ajax_controller/select_district_details",
				type:"post",
				data:institutedata,
				success:function(response){  
					var options = "<option value =''>Select District</option>";
					var res1 = JSON.parse(response);
					//alert(res1);
					$.each(res1.aaData,function(i,data){
						options = options + "<option value="+data.district_code+">"+data.district_name+"</option>";
						
					});
								
					//alert(options);
					$('#cmbPresentDist').html("");   //campusid from academicPeriod
					$('#cmbPresentDist').append(options);
					$("#spanState").hide();
				},
				error:function(){
					toastr.error("We are unable to Process.Please contact Support");
				}
			});
		}
	});

	$('#center_name1COMMON').val("");
 	$('#center_name2COMMON').val("");
 	$('#center_name3COMMON').val("");
 	
	$.ajax({
		url:base_url+"ajax_controller/select_center_preference_common",
		type:"post",
		//data:institutedata,
		success:function(response){  
			var options = "<option value =''>Select Preference</option>";
			var res1 = JSON.parse(response);
			//alert(res1); 
		   	for(var i=0;i<res1.length;i++){
		    	options = options + "<option value='"+res1[i].centre_code+"' >"+res1[i].centre_name+"</option>";
		   	} 
			$('#center_name1COMMON').html("");   //campusid from academicPeriod
			$('#center_name1COMMON').append(options);
			if(prefernce1_drop !=''){
				$('#center_name1COMMON').val(prefernce1_drop);
				$('#center_name1COMMON').trigger('change');
			}
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
	$('#center_name1COMMON').change(function(){
		preference1 = $('#center_name1COMMON').val();
		$('#center_name3COMMON').html("");
		$('#center_name3COMMON').append("<option value =''>Select Preference</option>");
		$.ajax({
			url:base_url+"ajax_controller/select_center_preference_common",
			type:"post",
			data:{preference1:preference1},
			success:function(response){  
				var options = "<option value =''>Select Preference</option>";
				var res1 = JSON.parse(response);
				//alert(res1); 
			   	for(var i=0;i<res1.length;i++){
			    	options = options + "<option value='"+res1[i].centre_code+"' >"+res1[i].centre_name+"</option>";
			   	} 
							
				//alert(options);
				$('#center_name2COMMON').html("");   //campusid from academicPeriod
				$('#center_name2COMMON').append(options);
				if(prefernce2_drop !=''){
					$('#center_name2COMMON').val(prefernce2_drop);
					$('#center_name2COMMON').trigger('change');
				}
			},
			error:function(){
				toastr.error("We are unable to Process.Please contact Support");
			}
		});
	});
	$('#center_name2COMMON').change(function(){
		preference1 = $('#center_name1COMMON').val();
		preference2 = $('#center_name2COMMON').val();
		$.ajax({
			url:base_url+"ajax_controller/select_center_preference_common",
			type:"post",
			data:{preference1:preference1,preference2:preference2},
			success:function(response){  
				var options = "<option value =''>Select Preference</option>";
				var res1 = JSON.parse(response);
				//alert(res1); 
			   	for(var i=0;i<res1.length;i++){
			    	options = options + "<option value='"+res1[i].centre_code+"' >"+res1[i].centre_name+"</option>";
			   	} 
							
				//alert(options);
				$('#center_name3COMMON').html("");   //campusid from academicPeriod
				$('#center_name3COMMON').append(options);
				if(prefernce3_drop !=''){
					$('#center_name3COMMON').val(prefernce3_drop);
				}
			},
			error:function(){
				toastr.error("We are unable to Process.Please contact Support");
			}
		});
	});
});

function permanentStateChange(x=''){
		var state = $("#cmbPermanentState").val();
		if(state != '')
		{
			$("#hidPermanentState").val($('#cmbPermanentState').val());
			$("#spanState1").show();
			var institutedata={
				state:state
			};
			$.ajax({
				url:base_url+"ajax_controller/select_district_details",
				type:"post",
				data:institutedata,
				success:function(response){  
					var options = "<option value =''>Select District</option>";
					var res1 = JSON.parse(response);
					
					$.each(res1.aaData,function(i,data){
						if(data.district_code == x){
							selected='selected';
						}else{
							selected='';
						}
						options = options + "<option value="+data.district_code+" "+selected+">"+data.district_name+"</option>";
						
					});
								
					
					$('#cmbPermanentDist').html("");   //campusid from academicPeriod
					$('#cmbPermanentDist').append(options);
					$("#spanState1").hide();
				},
				error:function(){
					toastr.error("We are unable to Process.Please contact Support");
				}
			});
		}
	}
	/*$('#master_name').change(function(){
  		coursedetail();
  	});*/
  	coursedetail();
  	
  	function coursedetail(){
		var selecting_value = $("#txtQualification1").val();
  		$.ajax({
			url:base_url+"ajax_controller/select_graduation_course",
			type:"post",
			data:{course_name:$('#master_name').val()},
			success:function(response){  
				//alert(response);
				var options = "<option value =''>Select Course</option>";
				var res1 = JSON.parse(response);
				if(res1.status =='validationerror'){
					toastr.error(res1.msg);
				}else{
					for(var i=0;i<res1.length;i++){
						if(res1[i].graduation_code == selecting_value){
							selected='selected';
						}else{
							selected='';
						}
						options = options + "<option value="+res1[i].graduation_code+" "+selected+">"+res1[i].graduation_name+"</option>";
					}
				}	
				$('#txtQualification1').html("");   //campusid from academicPeriod
				$('#txtQualification1').append(options);
			},
			error:function(){
				toastr.error("We are unable to Process.Please contact Support");
			}
		});
	}
	$("#txtDOJ").datepicker({
	    format: "dd-mm-yyyy",
		todayHighlight:true,
		autoclose:true,
    });
    $('#txtDOJ').datepicker('setEndDate', new Date());
    $("#txtDateOfDebar").datepicker({
		format: "dd-mm-yyyy",
		todayHighlight:true,
		autoclose:true,
	});
    $('#txtDateOfDebar').datepicker('setEndDate', new Date());