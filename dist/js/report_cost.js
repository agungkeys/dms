var rc = {
	buttonSearch: ko.observable(true),
	buttonCancel: ko.observable(false),
	dataSelectMainTransaction: ko.observable(),
	loader: ko.observable(true),
	isShowReport: ko.observable(false),
	isShowSearch: ko.observable(true),
	isShowCategory: ko.observable(false),
};

rc.prepare = function(){
	$('#type.select2-no-search').select2({
		minimumResultsForSearch: Infinity,
		placeholder: 'Choose Type'
	});
	rc.selectMainCategory();
	
}

rc.selectDaterange = function(){
	$('#date-range0').dateRangePicker({
		format: 'DD-MMM-YYYY',
		language: 'id',

	}).on('datepicker-first-date-selected', function(event, obj){
		/* This event will be triggered when first date is selected */
		console.log('first-date-selected',obj);
		// obj will be something like this:
		// {
		// 		date1: (Date object of the earlier date)
		// }
	}).on('datepicker-change',function(event,obj){
		/* This event will be triggered when second date is selected */
		console.log('change',obj);
		console.log('DATE FROM SELECTED', moment(obj.date1).format('YYYY-MM-DD'));
		console.log('DATE TO SELECTED', moment(obj.date2).format('YYYY-MM-DD'));
		var dateselection = {
			datefrom: moment(obj.date1).format('YYYY-MM-DD'),
			dateto: moment(obj.date2).format('YYYY-MM-DD')
		};
		rc.dataSelectMainTransaction(dateselection)
		// obj will be something like this:
		// {
		// 		date1: (Date object of the earlier date),
		// 		date2: (Date object of the later date),
		//	 	value: "2013-06-05 to 2013-06-07"
		// }
	}).on('datepicker-apply',function(event,obj){
		/* This event will be triggered when user clicks on the apply button */
		console.log('apply',obj);
	}).on('datepicker-close',function(){
		/* This event will be triggered before date range picker close animation */
		console.log('before close');
	}).on('datepicker-closed',function(){
		/* This event will be triggered after date range picker close animation */
		console.log('after close');
	}).on('datepicker-open',function(){
		/* This event will be triggered before date range picker open animation */
		console.log('before open');
	}).on('datepicker-opened',function(){
		/* This event will be triggered after date range picker open animation */
		console.log('after open');
	});
}

rc.initMainCategory = function(){
	$('#maincategory').select2({
        minimumResultsForSearch: Infinity,
        placeholder: 'Select Main Category...',
        ajax: {
            url: './controller/report_cost/report_cost_select_main_category.php',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
            	console.log(data)
                return {
                    results: [{id: 0, text: 'All'},...data]
                };
            },
            cache: false
        }
    });
}

rc.replaceComponentMainCategory = function(){
	$('#maincategory').empty().append("<select id='maincategory' class='form-control select2-no-search' data-parsley-class-handler='#slWrapper' data-parsley-errors-container='#slErrorContainer1'  data-parsley-required-message='Main Category required!' required></select>");
}

rc.replaceComponentCategory = function(){
	$('#category').empty().append("<select id='category' class='form-control select2-no-search' data-parsley-class-handler='#slWrapper' data-parsley-errors-container='#slErrorContainer2'  data-parsley-required-message='Category required!' required></select>");
}

rc.selectMainCategory = function(){
	rc.initMainCategory();
    $('#type').on('select2:select', function (e) {
    	// console.log(e.params.data.id)
    	var data = e.params.data.id;
    	if(data === 'PROJECT'){
    		rc.isShowCategory(false);
    		rc.replaceComponentMainCategory();
    		setTimeout(function(){
    			$('#maincategory').select2({
			        minimumResultsForSearch: Infinity,
			        placeholder: 'Select Project...',
			        ajax: {
			            url: './controller/transaction_finance/transaction_select_project.php',
			            dataType: 'json',
			            delay: 250,
			            processResults: function (data) {
			            	console.log(data)
			                return {
			                    results: [{id: 0, text: 'All'},...data]
			                };
			            },
			            cache: false
			        }
			    });
			    $("#maincategory").select2('val', 0);
    		})
		    
    	}else if(data ==='ACCOUNT'){
    		rc.isShowCategory(false);
    		rc.replaceComponentMainCategory();
    		setTimeout(function(){
    			$('#maincategory').select2({
			        minimumResultsForSearch: Infinity,
			        placeholder: 'Select Account Bank...',
			        ajax: {
			            url: './controller/transaction_finance/transaction_select_account.php',
			            dataType: 'json',
			            delay: 250,
			            processResults: function (data) {
			            	// console.log(data)
			                return {
			                    results: [{id: 0, text: 'All'},...data]
			                };
			            },
			            cache: false
			        }
			    });
			    $("#maincategory").select2('val', 0);
    		})
    	}else if(data ==='DETAIL'){
    		rc.replaceComponentMainCategory();
			rc.initMainCategory();
			$("#maincategory").select2('val', 0);
			$('#maincategory').on('select2:select', function (e) {
    			// console.log(e.params.data.id)
    			if(e.params.data.id !== 0){
    				rc.isShowCategory(true);
    				rc.replaceComponentCategory();
    				$('#category').select2({
				        minimumResultsForSearch: Infinity,
				        placeholder: 'Select Category...',
				        ajax: {
				            url: './controller/transaction_finance/transaction_select_category.php',
				            dataType: 'json',
				            delay: 250,
				            data: {cat : e.params.data.id },
				            processResults: function (data) {
				            	// console.log(data)
				                return {
				                    results: [{id: 0, text: 'All'},...data]
				                };
				            },
				            cache: false
				        }
				    });
				    $("#category").select2('val', 0);
    			}else{
    				rc.isShowCategory(false)
    			}
    		});

    	}else{
    		rc.isShowCategory(false);
    		rc.replaceComponentMainCategory();
			rc.initMainCategory();
			$("#maincategory").select2('val', 0);
    	}
    })
}

rc.reset = function(){
	rc.isShowReport(false);
	rc.isShowCategory(false);
	rc.isShowSearch(true);

	$("#type").select2('val', 0);
	rc.initMainCategory();
	$("#maincategory").select2('val', 0);
	// $("#date-range0").val('');
	rc.dataSelectMainTransaction({datefrom: '', dateto:''})
	$('#date-range0').data('dateRangePicker').clear();
}

rc.generatePDF = function(){
	var type = $("#type").select2('val');
	var maincategory = $("#maincategory").select2('val');
	var category = maincategory === '0' || type==='GROUP' || type==='PROJECT' || type==='ACCOUNT'  ? '' : $("#category").select2('val');
	var datefrom = (rc.dataSelectMainTransaction() === undefined ? '' : rc.dataSelectMainTransaction().datefrom);
	var dateto = (rc.dataSelectMainTransaction() === undefined ? '' : rc.dataSelectMainTransaction().dateto);
	var $container = $("#pdfRender");
	if(type==='' || maincategory===''){
		swal({
            title: "Tidak Diizinkan",
            text: "Filter Wajib Diisi...",
            type: "error",
            confirmButtonText: "Ya"
        });
	}else{
		rc.isShowReport(true);
		rc.isShowSearch(false);
		PDFObject.embed("page/report/pdf/pdf_cost.php?type="+type+"&maincategory="+maincategory+"&category="+category+"&datefrom="+datefrom+"&dateto="+dateto, $container);
	}
}

$(document).ready(function(){
	rc.prepare();
	rc.selectDaterange();

	ko.applyBindings();
})