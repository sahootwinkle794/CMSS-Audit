$(document).ready(function(){
	$.ajax({
		url:base_url+"/ajax_controller/get_program_table_data",
		type:"post",
		data:'',
		success:function(response)
		{  
			var options = "<option value ='0'>Search by Post</option>";					
			var res1 = JSON.parse(response);					
			$.each(res1.aaData,function(i,data)
			{
				options = options + "<option value="+data.program_code+">"+data.program_name+"</option>";
			});
			$('#cmbPostFilter').html("");  
			$('#cmbPostFilter').append(options); 
			
		},
		error:function()
		{
			alert("We are unable to Process.Please contact Support");
		}
	});
	
	//appl_barchart();
	
	
	$("#divApplicantGraph").empty();
	
});

admin_dashboard(0);

function admin_dashboard(post_val)
{ 
	$.ajax({
	    url:base_url+"ajax_controller/admin_dashboard", 
	    type:"post",
	    data:{post_val:post_val},
	    success:function(response)
	    {  	
	    	var res1 = JSON.parse(response); 
	    	$("#secDashboard").html("");
			$("#secDashboard").html(res1.html); 
			/*$("#spnRegF").html(res1.female);
			$("#spnRegM").html(res1.male);*/
			if(res1.male == null)
			{
				$("#spnRegM").html('0');
			}
			else
			{
				$("#spnRegM").html(res1.male);
			}
			if(res1.female == null)
			{
				$("#spnRegF").html('0');
			}
			else
			{
				$("#spnRegF").html(res1.female);
			}
			if(res1.transgender == null)
			{
				$("#spnRegT").html('0');
			}
			else
			{
				$("#spnRegT").html(res1.transgender);
			}
			/*var count = res1.count;
			var left = $('.row').width();
			left = left * 2;
	   		$('.row').scrollLeft(left);
			if(count > 0)
			{
				$.getJSON({
				    url:base_url+"ajax_controller/db_get_json", 
				    type:"post",
				    success:function(responsedata)
				    {
						Morris.Bar({
					        element: 'divApplicantGraph',
					        resize: true,
					        axes : true,
					        barGap:4,
		  					barSizeRatio:0.4,
					        data: responsedata,
					        barColors: ['#5367f7', '#f8be54', '#038b06'],
					        xkey: 'x',
					        ykeys: ['a','b','c'],
					        labels: ['Profile Submitted','Document Uploaded', 'Paid'],
					        hideHover: 'false'
					    });
					},
				    error:function()
				    {
				     	toastr.error('We are unable to process please contact support'); 
				    }
				});
			}
			else
		    {
		    	$('#divApplicantGraph').html();
		    }*/
			
	    },
	    error:function()
	    {
	     	toastr.error('We are unable to process please contact support'); 
	    }
    });
}

function appl_barchart()
{
	var options = {
       chart: {
            renderTo: 'divApplicantGraph',
            type: 'column'
        },
       title: {
            text: 'Bar Chart',
            x: -20 //center
        },
       subtitle: {
            text: 'Represents application statistics',
            x: -20
        },
       xAxis: {
       		
       		title: {
                text: 'Program Type'
            },
           categories: [],
        crosshair: true
       },
       /*crosshair: true,*/
        yAxis: {
            //minRange: 5,
            min: 0,
            /*max: 20,
            tickInterval: 0.5,*/
 
            title: {
                text: 'Registered'
            },
            labels: {
                overflow: 'justify'
            }
        },
       tooltip: {
           /* formatter: function() {
                    return '&lt;b&gt;'+ this.series.name +'&lt;/b&gt;&lt;br/&gt;'+
                    this.x +': '+ this.y;
            }*/
        },
        plotOptions: {
		    column: {
		      pointPadding: 0.2,
		      borderWidth: 0
		    }
		  },
      credits: { enabled: false },
       legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -10,
            y: 100,
            borderWidth: 0
        },
		 
       series: [{  
        			name: "Total Application",
                   	color: '#2f98d0',
                   	 //colorByPoint: true,
                    data: ['Profile','document upload']  
                }]
    }
    $.getJSON(base_url+"/ajax_controller/db_get_json", function(json) {
    	options.series[0].data = json;
    	for(i=0;i<json.length;i++){ //console.log( json[i][1]);
			/*options.series[i].data = json[i][1];
			options.series[i].name = json[i][0];*/
			//options.series.push( json[i]);
			options.xAxis.categories.push( json[i][2]);
			
		}
        
       // options.series[0].name = json;
        console.log(options.series);
    	chart = new Highcharts.Chart(options);
    });
}
appl_piechart(0);
function appl_piechart(gender)
{
	var options = {
       chart: {
            renderTo: 'divPieGraph',
            type: 'pie',
            plotBackgroundColor: null,
	        plotBorderWidth: null,
	        plotShadow: false,
        },
      
    title: {
        text: 'Category wise Data'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
        	colors: [
				    '#26c6da', 
				    '#745af2', 
				    '#f62d51', 
				    '#ff9c24',
			   ],
            allowPointSelect: true,
            cursor: 'pointer',
            /*dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }*/
        }
    },
		 
       series: [{
       		name: 'Total percentage',
	        colorByPoint: true,
	        data: [{
	            name: 'Chrome',
	            minPointSize: 10,
        		innerSize: '20%',
	            y: 61.41,
	            sliced: true,
	            selected: true
	        }]
       }]
    }
    $.getJSON(base_url+"/ajax_controller/get_pie_category/"+gender, function(json) {
    	options.series[0].data = json;
    	//for(i=0;i<json.length;i++){ //console.log( json[i][1]);
			/*options.series[i].data = json[i][1];
			options.series[i].name = json[i][0];*/
			//options.series.push( json[i]);
		//	options.xAxis.categories.push( json[i][2]);
			
		//}
        
       // options.series[0].name = json;
        console.log(options.series);
    	chart = new Highcharts.Chart(options);
    });
}

drawMap();

function drawMap(){
	FusionCharts.ready(function() {
		var mapOfIndia = new FusionCharts({
			type: "maps/india",
			renderAt: "divMap",
			height: "450",
			width: "100%",
			dataFormat: "json",
			dataSource: {
				"chart": {
					"animation": "1",
					"showbevel": "1",
					"usehovercolor": "1",
					"canvasbordercolor": "FFFFFF",
					"numberSuffix": "%",
					"bordercolor": "FFFFFF",
					"showlegend": "1",
					"showshadow": "1",
					"legendposition": "BOTTOM",
					"legendborderalpha": "0",
					"legendbordercolor": "ffffff",
					"legendallowdrag": "0",
					"legendshadow": "0",
					"connectorcolor": "000000",
					"fillcolor": "D7D7D7",
					"fillalpha": "80",
					"hovercolor": "B29B3D",
					"showBorder": "1",
					"bordercolor":"757575",
					"showLabels": "0",
					"showTooltip": "1",
					/*"labelSepChar": ": ",
        			"includeValueInLabels": "1",*/
				},
				"data": [
							{
				                id: "OR",
				                value: "515"
			            	}
			            ],
			},

			/*"events": {
				"entityRollover": function(evt, data) {
					var newData=data.label.toUpperCase();
					if(userDetails.districtName==undefined){
						
						$('#container_chart_area').show();
						$('#container_chart_area_2').hide();
						$('#textArea').show();
						$('#textArea2').show();
						$('#textArea').html("District Name  : " + data.label);
						$('#textArea2').html("Average Score  : " + data.value.toFixed(0)+"%");
						$('#container_chart_area').css("background-color", "aquamarine");
					}
				},
				"entityRollout": function(evt, data) {
					var newData=data.label.toUpperCase();
					if(userDetails.districtName==undefined){
						
						$('#textArea').hide();
						$('#textArea2').hide();
						$("#textArea3").show();
						$("#textArea4").show();
						$("#textArea4").html("Average Score: "+data.value+"%");
						$('#container_chart_area_2').show();
						$('#container_chart_area').hide();
						
					}
				},
				"entityClick": function(evt, data) {
					var category=$("#survey_category").val();
					var newData=data.label.toUpperCase();
					score=data.value.toFixed(0);
					if(newData=='KENDUJHAR (KEONJHAR)'){
						newData='KEONJHAR';
					}if (newData=='SUNDARGARH') {
						newData='SUNDERGARH';
					}if (newData=='JAGATSINGHAPUR') {
						newData='JAGATSINGHPUR';
					}
					distNameNew=newData;
					console.log(";==============map clicked==============");
					console.log(data);
					console.log(";==============map clicked==============");
				},
			}*/
		}).render("divMap"); 
	});
}
function report_sc_st_detail(reporturl)
{
	var w;
	w = window.open("report_sc_st_detail/"+reporturl, "winreport","status=0, menubar=0, scrollbars=1, resizable=1, width=980, height=600");
	w.focus();
}
function report_onlinepayment(reporturl)
{
	var w;
	w = window.open("report_onlinepayment/"+reporturl, "winreport","status=0, menubar=0, scrollbars=1, resizable=1, width=980, height=600");
	w.focus();
}

function post_filter()
{
	post_val = $("#cmbPostFilter").val();
	admin_dashboard(post_val);
}
function load_details(program, filter_data)
{
	var tblProfile = $('#tblProfile').dataTable({
		
		"ajax":{
				"url":base_url+"/ajax_controller/get_profile",
				"type":"post",
				"data":{
					program:program,
					filter_data:filter_data
				},
			},
		"bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth": false,
        "bDestroy": true,
		//"sDom":"<'row'<'col-xs-4'B><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-9' <'row'<'col-xs-5' i>>><'col-xs-3'p>>",
		"sDom":"<'row'<'col-xs-4'B><'col-xs-4'i><'col-xs-4'f>>rtp",
        "buttons": [
            	{
	            	extend: 'excel',
	                text: '<i class="fa fa-file-excel-o">&nbsp;Export to Excel</i>',
	                tag: 'button',
	                className: 'btn btn-success excelClass',
	                filename:'Applicant List',
	                title:'Applicant List'
                }
       ],
		"aoColumns": [
	                   { "sName": "sl_no","sWidth": "1%" },
                       { "sName": "name","sWidth": "15%" },
                       { "sName": "mobile","sClass": "alignRight","sWidth": "10%"},
				       { "sName": "email_id","sWidth": "10%"},
				       { "sName": "dob","sWidth": "20%"},
				       { "sName": "Program","sWidth": "20%"},
					   
        ],
        "fnDrawCallback": function(oSettings, json) {
     		$('.tooltipTable').tooltipster( {
	         	theme: 'tooltipster-punk',
	      		animation: 'grow',
	        	delay: 200, 
	         	touchDevices: false,
	         	trigger: 'hover'
      		});          
  		}   
	});
}
function show_profile_detail()
{
	program = $("#cmbPostFilter").val();
	filter_data = '';
	load_details(program, filter_data);
	$("#myModalLabel").html('Profile');
	$("#profileModal").modal('show');
}

function show_doc_detail()
{
	program = $("#cmbPostFilter").val();
	filter_data = 'document';
	load_details(program, filter_data);
	$("#myModalLabel").html('Document Uploaded');
	$("#profileModal").modal('show');
}

function show_pay_detail()
{
	program = $("#cmbPostFilter").val();
	filter_data = 'payment';
	load_details(program, filter_data);
	$("#myModalLabel").html('Payment Dtails');
	$("#profileModal").modal('show');
}