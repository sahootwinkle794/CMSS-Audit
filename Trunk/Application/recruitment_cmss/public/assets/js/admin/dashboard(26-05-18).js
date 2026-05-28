$(document).ready(function(){
	var program_group = $('#cmbProgramGroup').val();
	
	var institutedata=
	{
		program_group : program_group
	};
	$.ajax({
	    url:base_url+"ajax_controller/admin_dashboard", 
	    type:"post",
	    data:institutedata,
	    success:function(response)
	    {  	
	    	var res1 = JSON.parse(response); 
	    	$("#secDashboard").html("");
			$("#secDashboard").html(res1.html); 
			
			var count = res1.count;
			var left = $('.row').width();
			left = left * 2;
	   		$('.row').scrollLeft(left);
			if(count > 0)
			{
				var institutedata=
				{
					program_group : program_group
				};
				$.getJSON({
				    url:base_url+"ajax_controller/db_get_json", 
				    type:"post",
				    data:institutedata,
				    success:function(responsedata)
				    {
						Morris.Bar({
					        element: 'divApplicantGraph',
					        resize: false,
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
		    }
			
	    },
	    error:function()
	    {
	     	toastr.error('We are unable to process please contact support'); 
	    }
    });
   $("#btnFilter").click(function () {
	   $("#divApplicantGraph").empty();
		var program_group = $('#cmbProgramGroup').val();
		var institutedata=
		{
			program_group : program_group
		};
		$.ajax({
		    url:base_url+"ajax_controller/admin_dashboard", 
		    type:"post",
		    data:institutedata,
		    success:function(response)
		    {  	
		    	var res1 = JSON.parse(response); 
				$("#secDashboard").html(res1.html); 
		    	//$('#secDashboard').html(response);
		    	var count = res1.count;
				var left = $('.row').width();
				left = left * 2;
		   		$('.row').scrollLeft(left);
		   		//alert(count);
				if(count > 0)
				{
					var institutedata=
					{
						program_group : program_group
					};
					$.getJSON({
					    url:base_url+"ajax_controller/db_get_json", 
					    type:"post",
					    data:institutedata,
					    success:function(responsedata)
					    {
							Morris.Bar({
						        element: 'divApplicantGraph',
						        resize: false,
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
			    	$('#divApplicantGraph').html("");
			    }
		    },
		    error:function()
		    {
		     	toastr.error('We are unable to process please contact support'); 
		    }
	   });
	});
});