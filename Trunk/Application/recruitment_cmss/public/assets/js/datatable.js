	$(document).ready(function(){
		var urls =base_url+"/ajax_controller/get_datatable_data/get_datatabledata";
		var dtblgroupmaster = $('#dtbldatatable').dataTable({
			"processing": true, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			"destroy": true,
			"paging":   true,
			"info":     true,
			"autoWidth": false,
			"scrollX":true,
			"responsive":false,
			"searching":true,
			// Load data for the table's content from an ajax source
			"ajax":
			{
				"url": urls,
				"type": "POST"
			},
			//Set column definition initialisation properties.
			"columns": [
				{"sName": "sl_no","sWidth": "5%","sClass":"alignCenter"},
				{"sName": "id","bVisible":false,"sClass":"alignCenter"},
				{"sName": "name","sWidth": "35%","sClass":"alignCenter"},
				{"sName": "country","sWidth": "35%","sClass":"alignCenter"},
				{"sName": "department","bVisible":false,"sWidth": "35%","sClass":"alignCenter"},
				{"sName": "qualification","sWidth": "35%","sClass":"alignCenter"},
			],
			"columnDefs": [{"bVisible": [ 1 ]}], 
			
		});
	})