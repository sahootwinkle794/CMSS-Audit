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
	
	$("#forReservedQuota").hide();
	$("#divAcademicInfo").hide();
	$("#GRADUTION").hide();
	$("#radioNoGradCert").hide();
	$("#radioGradMarkSheet").hide();
	$("#onlineMode").hide();
	$("#offlineMode").hide();
	//$("#divAcademicInfoAppeared").hide();
	if($("input[name=mode]:checked").val()=="Offline")
	{
		$("#onlineMode").hide();
		$("#offlineMode").show();
	}
	if($("input[name=mode]:checked").val()=="Online")
	{
		$("#onlineMode").show();
		$("#offlineMode").hide();
		//$("#divAcademicInfoAppeared").show();
	}
	
	$("#modeOffline").click(function () {
        $("#onlineMode").hide();
		$("#offlineMode").show();
    });
	$("#modeOnline").click(function () {
        $("#onlineMode").show();
		$("#offlineMode").hide();
    });
	
	
	if($("input[name=radioMarkSheet]:checked").val()=="Yes")
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
		//alert(1);
		$("#divAcademicInfo").show();
		$("#GRADUTION").show();
		$("#radioNoGradCert").hide();
		$("#radioGradMarkSheet").hide();
		$( "#txtMS1" ).prop( "disabled", true);
		$( "#txtFM1" ).prop( "disabled", true);
		$("#txtMS1").val('')
		$("#txtFM1").val('')
		$("#txtPercent1").val('')
		
		
	}
	
	
	
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
    
    $("#radioYesMarks").click(function () {
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
			master_name: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            },
			center_name1: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            },
			center_name2: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            },
			center_name3: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            },
			cmbExamCenter: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            },
            radioJEE: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            },
            radioID: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            },
           NorthEast: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            },
            mode: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            },
            radioMarkSheet: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            },
            radioGradCert: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            },
            radioGradMarkSheet: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            },
			txtFirstName: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
					regexp: {
                        regexp: /^([A-Za-z.]+)$/,
                        message: "Special characters and Numbers are not allowed"
					}
                }
            },
			txtMiddleName: {
                validators: {
                    regexp: {
                        regexp: /^([A-Za-z.\s]+)$/,
                        message: "Special characters and Numbers are not allowed"
					}
                }
            },
			txtLastName: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
					regexp: {
                        regexp: /^([A-Za-z.]+)$/,
                        message: "Special characters and Numbers are not allowed"
					}
                }
            },
			radiogender: {
                validators: {
                    notEmpty: {
                        message: 'Please Select the Gender'
                    }
                }
            },
			cmbNationality: {
                validators: {
                    notEmpty: {
                        message: 'Required'
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
			radioSingleGirlChild: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            },
			radioHandicapped: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            },
			radiominority: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            },
			radioCourseType: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            },
			cmbHighestQualification: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            },
			txtTotalMarks: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            },
			
			
			radiomaritalstatus: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            },
			radioAllergies: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            },
			txtFatherName: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
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
            txtMotherName: {
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
			txtApplicantMobile:{
						validators: {
							/* notEmpty: {
								message: 'Pin is required and can\'t be empty'
							}, */
							digits: {
							message: 'The value can contain only digits'
						}, 
					stringLength: {
						max: 12,
						min:10,
						message: 'Phone/Mobile no must be 10-12 characters long'
					}
				}
			},
			
		   txtphtype: {
                validators: {
                    regexp: {
                        regexp: /^([a-zA-Z0-9-\n\r \/.,();]+)$/,
                        message: "Only Alphabet,Numbers and These . , - / ( ) ; Symbols are  allowed"
					}, 
					stringLength: {
						max: 30,
						message: 'Maximum 30 character`s are allowed'
					}
				}
			},
		   cand_name1: {
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
		   co_name1: {
                validators: {
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
		   phone_no1: {
                validators: { 
                	notEmpty: {
                        message: 'Required'
                    },
                    integer:{
						message: 'Only numbers are allowed'	
					},
					stringLength: {
						max: 12,
						min:10,
						message: 'Phone/Mobile no must be 10-12 characters long'
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
			txtQualification1:{
                validators: {
                    notEmpty: {
                        message: 'Required'
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
                            if(parseInt(todayyear) < parseInt(value))
							{
								return false;
							}else if( parseInt(value) < parseInt(birthyear))
							{
								return false;
							}else if(parseInt(document.getElementById("txtYear1").value) > parseInt(value))
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
                    integer: {
                        message: 'invalid year'
                    }, 
					stringLength: {
						max: 4,
						min: 4,
						message: 'Year must be 4 digit number'
					},
					callback: {
                        message: '<ul type="disc" style="list-style: outside;"><li> Year must be greater </br> than birth year and </br> less than current year. </li><li>Graduation Qualification </br>Year must  be  greater then </br> Secondary Qualification Year</li></ul>',
                        callback: function (value, validator, $field) {
                            // Determine the numbers which are generated in captchaOperation
                            if(parseInt(todayyear) < parseInt(value))
							{
								return false;
							}else if( parseInt(value) < parseInt(birthyear))
							{
								return false;
							}else if(parseInt(document.getElementById("txtYear2").value) > parseInt(value))
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
			txtMS1: {
                validators: {
					stringLength: {
						max: 5,
						message: 'Maximum 5 digit number`s are allowed'
					},
                    regexp: {
                        regexp: /^([0-9\.]+)$/,
                        message: "Only .  allowed"
					}
				}
			},
			txtMS2: {
                validators: {
					stringLength: {
						max: 5,
						message: 'Maximum 5 digit number`s are allowed'
					},
                    regexp: {
                        regexp: /^([0-9\.]+)$/,
                        message: "Only .  allowed"
					}
				}
			},
			txtMS3: {
                validators: {
					stringLength: {
						max: 5,
						message: 'Maximum 5 digit number`s are allowed'
					},
                    regexp: {
                        regexp: /^([0-9\.]+)$/,
                        message: "Only .  allowed"
					}
				}
			},
			txtFM1: {
                validators: {
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
			
			radioQuota: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
				}
			},
			radioHostel: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
				}
			},
			txtDistanceFrom: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
				}
			},
			txtQualifyingDegree: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
				}
			},
			cmbPassStatus: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
				}
			},
			taSubjects: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
				}
			},
			txtUnivName: {
                validators: {
                    notEmpty: {
                        message: 'Required'
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
			radiobelong: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
				}
			},
			cand_name: {
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
			co_name: {
                validators: {
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
			FathersProfession: {
                validators: {
                    regexp: {
                        regexp: /^([a-zA-Z. ]+)$/,
                        message: "only Alphabets are  allowed"
					}, 
					stringLength: {
						max: 80,
						message: 'Maximum 80 character`s are allowed'
					}
				}
			},
			FathersIncome: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
				}
			},

			MothersProfession: {
                validators: {
                   /* notEmpty: {
                        message: 'Required'
                    },*/
                    regexp: {
                        regexp: /^([a-zA-Z. ]+)$/,
                        message: "only Alphabets are  allowed"
					}, 
					stringLength: {
						max: 80,
						message: 'Maximum 80 character`s are allowed'
					}
				}
			},
			MothersIncome: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    },
                    stringLength: {
						max: 10,
						message: 'Maximum 10 number`s are allowed'
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
			/*Employer_to: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    },
                    callback: {
                        message: 'Maximum mark must be </br> greater than mark secured',
                        callback: function (value, validator, $field) {
								dateArray = value.split("-");
								emp_to =  dateArray[2]+"-"+dateArray[1]+"-"+dateArray[0];
								empfrmval = document.getElementById("Employer_from").value
								dateArray1 = empfrmval.split("-");
								emp_frm =  dateArray1[2]+"-"+dateArray1[1]+"-"+dateArray1[0];
								alert(emp_frm);
                            if(emp_frm > emp_to)
							{
								return false;
							}else{
								return false;
							}
                        }
                    }
				}
			},*/
			cmbNorthState: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
				}
			},
			phone_no: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    digit:{
						message: 'Only numbers are allowed'
					}
				}
			},
			txtfinalpercentage: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    regexp: {
                        regexp: /^([0-9.]+)$/,
                        message: "only Numbers and dot(.) is allowed"
					}, 
					stringLength: {
						max: 80,
						message: 'Maximum 80 character`s are allowed'
					}
				}
			},
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
	/* if($("#cmbPresentState").val()=="OD")
	{
		$('#cmbPresentState').attr('disabled', true);
	}
	if($("#cmbPermanentState").val()=="OD")
	{
		$('#cmbPermanentState').attr('disabled', true);
	} */
	//alert(prefernce1_drop);
	
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
						
			//alert(options);
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
	//alert(x);
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