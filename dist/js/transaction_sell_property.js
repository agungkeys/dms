var trsp = {
	dataSelectMainTransaction: ko.observableArray(),
	buttonVisible: ko.observable(true),
	buttonUnVisible: ko.observable(false),
	loader: ko.observable(false),
	form: ko.observable(false),
	table: ko.observable(true),
	detail: ko.observable(false),
	titleNew: ko.observable(false),
	titleEdit: ko.observable(false),
	getDataIdEdit: ko.observable(),
	getDataEdit: ko.observableArray(),
	selectMainCategoryId: ko.observable(),
	selectProjectId: ko.observable(),
	modeSingle: ko.observable(true),
	modeMultiple: ko.observable(false),
	data: ko.observableArray([]),
	completed: ko.observable({BF: false, DP: false, KPR: false}),
};

trsp.prepare = function(){
	$('#payment_type.select2-no-search').select2({
		minimumResultsForSearch: Infinity,
		placeholder: 'Choose one'
	});
	$('#colorpicker').spectrum({
		color: '#17A2B8'
	});
	trsp.selectMainTransaction();
	$('#forminput').parsley();
	$("#maincategory").select2("val", "0");

	$('#date .fc-datepicker').datepicker({
		showOtherMonths: true,
		selectOtherMonths: true
    });

	trsp.prepareDatePicker();
	// $('#cheque').mask('aa-9999999999');

}

trsp.prepareDatePicker = function() {
    var tanggalsur = Date();
    var tanggalrepl = moment(tanggalsur).format('DD MMMM YYYY');

    var datepick = $("#date");
    datepick.datepicker({
        format: 'dd MM yyyy',
        autoclose: true,
        defaultDate: new Date()
    });
    datepick.datepicker('setDate', tanggalrepl);
};

trsp.changeMode = function(data){
	console.log("Mode ====>>>", data);
	if(data === 'single'){
		// $('#transaction-finance').addClass('col-xl-6');
		trsp.modeSingle(true)
		trsp.modeMultiple(false)

	}else{
		// $('#transaction-finance').removeClass('col-xl-6');
		trsp.modeSingle(false)
		trsp.modeMultiple(true)
	}
}

function compare(a, b) {
  return JSON.stringify(a) === JSON.stringify(b);
}

trsp.selectMainTransaction = function(){
    function formatState(state){
        if (!state.id) {
            return state.text;
        }
        // console.log(state);
        var icon = state.groups == 'Revenue' ? "<i class='fa fa-arrow-circle-down text-success'></i>" : "<i class='fa fa-arrow-circle-up text-danger'></i>";
        var $state = $(
            '<span>'+icon+'&nbsp;'+state.groups+'&nbsp;<i class="fa fa-circle" style="color:'+state.color+'"></i> ' + state.text +'&nbsp;</span>'
        );
        return $state;

    }

    function formatStateSelection(data){
        if (data.id === '') {
            return 'Select Data Main Transaction...';
        }else{
            var icon = data.groups == 'Revenue' ? "<i class='fa fa-arrow-circle-down text-success'></i>" : "<i class='fa fa-arrow-circle-up text-danger'></i>";
            var datas = $(
                '<span>'+icon+'&nbsp;'+data.groups+'&nbsp;<i class="fa fa-circle" style="color:'+data.color+'"></i> ' + data.text +'&nbsp;</span>'
            );
            return datas;
        }
    }

    $('#maincategory').select2({
        minimumResultsForSearch: -1,
        placeholder: 'Select Group...',
        templateResult: formatState,
        templateSelection: formatStateSelection,
        ajax: {
            url: './controller/transaction_sell_property/transaction_sell_property_select_main_category.php',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
            	console.log(data)
                return {
                    results: data
                };
            },
            cache: false
        }
    });

    $('#maincategory').on('select2:select', function (e) {
    	var dataIds = e.params.data.id;
        trsp.selectMainCategoryId = dataIds;

        $("#category").prop("disabled", false);
        $("#category").empty();

        function runCatSelect(){
            $('#category').select2({
                placeholder: 'Select Category...',
                minimumResultsForSearch: Infinity,
                ajax: {
                    url: './controller/transaction_finance_revenue/transaction_select_category.php',
                    dataType: 'json',
                    delay: 250,
                    data: {cat : trsp.selectMainCategoryId },
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                    cache: false
                }
            });
        };
        setTimeout(function(){
            runCatSelect();
        },150);
    })

    $('#account').select2({
        minimumResultsForSearch: Infinity,
        placeholder: 'Select Account...',
        ajax: {
            url: './controller/transaction_finance/transaction_select_account.php',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
            	// console.log(data)
                return {
                    results: data
                };
            },
            cache: false
        }
    });
    $('#project').select2({
        minimumResultsForSearch: Infinity,
        placeholder: 'Select Project...',
        ajax: {
            url: './controller/transaction_finance/transaction_select_project.php',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
            	// console.log(data)
                return {
                    results: data
                };
            },
            cache: false
        }
    });
    $('#project').on('select2:select', function (e) {
    	var dataIds = e.params.data.id;
        trsp.selectProjectId = dataIds;

        $("#cluster").prop("disabled", false);
        $("#cluster").empty();

        function runClusterSelect(){
            $('#cluster').select2({
                placeholder: 'Select Cluster...',
                minimumResultsForSearch: Infinity,
                ajax: {
                    url: './controller/transaction_sell_property/transaction_select_cluster.php',
                    dataType: 'json',
                    delay: 250,
                    data: {id : trsp.selectProjectId },
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                    cache: false
                }
            });
        };
        setTimeout(function(){
            runClusterSelect();
        },150);
    });
    $('#cluster').on('select2:select', function (e) {
    	var dataIdCluster = e.params.data.id;
        // console.log('get data customer', dataIdCust);
        $.ajax({
			dataType: 'json',
			type: 'post',
			url: './controller/transaction_sell_property/transaction_sell_property_controller_find_cluster.php',
			data: {id:dataIdCluster}
		}).done(function(data){
			console.log("Get detail cluster", data)
			$("#block").val(data[0].KAVBLOK);
			$("#kavno").val(data[0].KAVNO);
			$("#typelb").val(data[0].TYPELB);
			$("#typelt").val(data[0].TYPELT);
			$("#land_excess").val(data[0].EXCESSLAND);
			$("#cluster_description").val(data[0].DESCRIPTION);
		});
    })

    $('#customer').select2({
        minimumResultsForSearch: Infinity,
        placeholder: 'Select Customer...',
        ajax: {
            url: './controller/transaction_sell_property/transaction_select_customer.php',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
            	// console.log(data)
                return {
                    results: data
                };
            },
            cache: false
        }
    });
    $('#customer').on('select2:select', function (e) {
    	var dataIdCust = e.params.data.id;
        // console.log('get data customer', dataIdCust);
        $.ajax({
			dataType: 'json',
			type: 'post',
			url: './controller/transaction_sell_property/transaction_sell_property_controller_find_customer.php',
			data: {id:dataIdCust}
		}).done(function(data){
			console.log("Get detail transaction", data)

			$("#ktp").val(data[0].KTP);
			$("#npwp").val(data[0].NPWP);
			$("#handphone").val(data[0].TELPHP);
			$("#email").val(data[0].EMAIL);
			$("#address").val(data[0].ADDRESS);
			$("#zipcode").val(data[0].ZIPCODE);
			$("#kelurahan").val(data[0].NAMEKELURAHAN);
			$("#kecamatan").val(data[0].NAMEKECAMATAN);
			$("#kabupaten").val(data[0].NAMEKABUPATEN);
			$("#province").val(data[0].NAMEPROVINCE);
		});
    });
}

trsp.resetForm = function(){
	trsp.data([])
	document.getElementById("forminput").reset();
	$('#forminput').parsley().reset();
	$('#forminputdetails').parsley().reset();
	$("#project").select2("val", "0");
	$("#cluster").select2("val", "0");
	$("#maincategory").select2("val", "0");
	$("#customer").select2("val", "0");
	$("#category").empty();
	$('a:contains("Single")').click();
	$("#category").prop("disabled", true);
	$("#account").select2("val", "0");
}

trsp.addTransaction = function(){
	console.log("Add Category=====>")
	trsp.buttonVisible(false);
	trsp.buttonUnVisible(true);
	trsp.table(false);
	trsp.form(true);
	trsp.titleNew(true);
	trsp.titleEdit(false);
}

function viewModels(){ 
    self.rows = trsp.data;
    self.getTotal = ko.pureComputed(function () {
        var total = 0;
        ko.utils.arrayForEach(self.rows(), function (row) {
            total += row.amount;
            // console.log('Data View Models==>>>',row)
        });
        return formatNumber(JSON.stringify(total));
    });
} 

trsp.removeDetailItem = function(){
    trsp.data.remove(this);

    const cat = this.categoryname;
    if(cat === 'Booking Fee'){
		trsp.completed().BF = false;
    }else if(cat === 'DP'){
    	trsp.completed().DP = false;
    }else if(cat === 'KPR'){
    	trsp.completed().KPR = false;
    }
}

trsp.checkCompletedCategory = function(){
	trsp.data().map((item, idx)=>{
		if(item.categoryname==='Booking Fee'){
			trsp.completed().BF = true;
		}else if(item.categoryname==='DP'){
			trsp.completed().DP = true;
		}else if(item.categoryname==='KPR'){
			trsp.completed().KPR = true;
		}		
	})
}

trsp.doAddDetailItem = function(){
	var validate = $('#forminput').parsley().validate();
	if(validate){
		var validateDetails = $('#forminputdetails').parsley().validate();
		if(validateDetails){
			trsp.data()
			var datas = {
				projectid: $("#project").select2('data')[0].id,
				projectname: $("#project").select2('data')[0].text,
				date: $("#date").data('datepicker').getFormattedDate('yyyy-mm-dd'),
				accountid: $("#account").select2('data')[0].id,
				accountname: $("#account").select2('data')[0].accountname,
				accountbankname: $("#account").select2('data')[0].accountbankname,
				accountbankno: $("#account").select2('data')[0].accountbankno,
				clusterid: $("#cluster").select2('data')[0].id,
				kavblok: $("#block").val(),
				kavno: $("#kavno").val(),
				typelb: $("#typelb").val(),
				typelt: $("#typelt").val(),
				excessland: $("#land_excess").val(),
				customerid: $("#customer").select2('data')[0].id,
				fullname: $("#customer").select2('data')[0].text,
				ktp: $("#ktp").val(),
				npwp: $("#npwp").val(),
				address: $("#address").val(),
				zipcode: $("#zipcode").val(),
				province: $("#province").val(),
				kabupaten: $("#kabupaten").val(),
				kecamatan: $("#kecamatan").val(),
				kelurahan: $("#kelurahan").val(),
				handphone: $("#handphone").val(),
				email: $("#email").val(),
				cheque: $("#cheque").val(),
				maincategoryid: $("#maincategory").select2('data')[0].id,
				maincategoryname: $("#maincategory").select2('data')[0].text,
				maincategorycolor: $("#maincategory").select2('data')[0].color,
				maincategorygroups: $("#maincategory").select2('data')[0].groups,
				categoryid: $("#category").select2('data')[0].id,
				categoryname: $("#category").select2('data')[0].text,
				amount: toAngka($("#amount").val()),
				type: $("#payment_type").select2('data')[0].id,
				title: $("#title").val(),
				description: '',
				created: $('.usernameLabel').text(),
			}
			trsp.data.push(datas)
			document.getElementById("forminputdetails").reset();
			$('#payment_type.select2-no-search').select2({
				minimumResultsForSearch: Infinity,
				placeholder: 'Choose one'
			});
			$("#maincategory").select2("val", "0");
			$("#category").empty();
			$("#category").prop("disabled", true);
			$('#forminputdetails').parsley().reset();
			trsp.prepareDatePicker();
			trsp.checkCompletedCategory();
		}else{
			return
		}
	}else{
		return
	}
}

trsp.addDetailItem = function(){
	// trsp.doAddDetailItem();
	const BF = trsp.completed().BF;
	const DP = trsp.completed().DP;
	const KPR = trsp.completed().KPR;
	const _temp = $("#category").select2('data')[0].text

	if(_temp === 'Booking Fee' ){
		if(BF !== true){
			trsp.doAddDetailItem();
		}else{
			trsp.duplicateDetailItem();
		}
	}else if(_temp === 'DP'){
		if(DP !== true){
			trsp.doAddDetailItem();
		}else{
			trsp.duplicateDetailItem();
		}
	}else if(_temp === 'KPR'){
		if(KPR !== true){
			trsp.doAddDetailItem();
		}else{
			trsp.duplicateDetailItem();
		}
	}
}

trsp.duplicateDetailItem = function(){
	swal({
        title: "Tidak Diizinkan",
        text: "Data ganda, silahkan cek input detail pembayaran",
        type: "error",
        confirmButtonText: "Ya"
    },function (isConfirm) {
    	document.getElementById("forminputdetails").reset();
		$('#payment_type.select2-no-search').select2({
			minimumResultsForSearch: Infinity,
			placeholder: 'Choose one'
		});
		$("#maincategory").select2("val", "0");
		$("#category").empty();
		$("#category").prop("disabled", true);
		$('#forminputdetails').parsley().reset();
		trsp.prepareDatePicker();
		trsp.checkCompletedCategory();
    });
}

trsp.detailTransaction = function(dt){
	console.log("Detail Transaction=====>", dt);
	// trsp.buttonUnVisible(true);
	// $("#save").hide();
	// trsp.buttonVisible(false);
	// trsp.table(false);
	// trsp.form(false);
	// trsp.detail(true);

	// $.ajax({
	// 	dataType: 'json',
	// 	type: 'post',
	// 	url: './controller/transaction_finance/transaction_finance_controller_find.php',
	// 	data: {id:dt}
	// }).done(function(data){
		
	// 	$("#dtl_title").html(data[0].TRANSACTIONID);
	// 	$("#dtl_transactionid").html(data[0].TRANSACTIONID);
	// 	$("#dtl_project").html(data[0].PROJECTNAME);
	// 	$("#dtl_date").html(data[0].DATE);
	// 	$("#dtl_account").html(data[0].ACCOUNTNAME+' ( '+data[0].ACCOUNTBANKNO+' ) ');
	// 	$("#dtl_cheque").html(data[0].CHEQUE);
	// 	$("#dtl_maincategory").html(data[0].MAINCATEGORYNAME);
	// 	$("#dtl_category").html(data[0].CATEGORYNAME);
	// 	$("#dtl_amount").html(formatNumber(data[0].AMOUNT));
	// 	$("#dtl_transactiontitle").html(data[0].TRANSACTIONTITLE);
	// 	$("#dtl_description").html(data[0].DESCRIPTION);
	// })
}

trsp.editTransaction = function(dt) {
	console.log("Edit Transaction=====>", dt);
	trsp.buttonVisible(false);
	trsp.buttonUnVisible(true);
	trsp.table(false);
	trsp.form(true);
	trsp.titleNew(false);
	trsp.titleEdit(true);
	trsp.getDataIdEdit(dt);

	$.ajax({
		dataType: 'json',
		type: 'post',
		url: './controller/master_category/master_category_controller_find.php',
		data: {id:dt}
	}).done(function(data){
		// console.log("Get data edited", data)
		trsp.getDataEdit({
			maincategoryid: data.MAINCATEGORYID,
			categoryname: data.CATEGORYNAME,
			categoryinfo: data.DESCRIPTION
		});
		$("#categoryname").val(data.CATEGORYNAME);
		$("#categoryinformation").val(data.DESCRIPTION);

		var mainCategorySelected = $('#maincategory');
		$.ajax({
		    dataType: "json",
	        type: "post",
	        url: "./controller/master_category/master_category_select_main_category.php",
	        data:{
	            1: data.MAINCATEGORYID
	        }
		}).then(function (data) {
			dataInit = {
				id: data.MAINCATEGORYID,
				text: data.MAINCATEGORYNAME,
				color: data.COLOR,
				groups: data.GROUPS
			}
		    $("#maincategory").select2("trigger", "select", {
			    data: dataInit
			});
		});
	});
}

trsp.deleteTransaction = function(id) {
	// swal({
 //        title: "Your data will be delete ?",
 //        text: "Are you sure delete data '"+id+"' !?",
 //        type: "warning",
 //        showCancelButton: true,
 //        confirmButtonColor: "#DD6B55",
 //        confirmButtonText: "Yes",
 //        cancelButtonText: "No",
 //        closeOnConfirm: false,
 //        closeOnCancel: false
 //    },
 //    function (isConfirm) {
 //        if (isConfirm) {
 //            $.ajax({
 //                dataType: 'json',
 //                type:'post',
 //                url: './controller/transaction_finance/transaction_finance_controller_remove.php',
 //                data: { id: id }
 //            }).done(function(data){
 //                $("#DataTableTransaction").DataTable().ajax.reload();
 //                swal({
 //                    title: "Deleted",
 //                    text: "Your data has been deleted",
 //                    type: "success",
 //                    confirmButtonText: "Ya",
 //                })
 //            });
 //        } else {
 //            $("#DataTableTransaction").DataTable().ajax.reload();
 //            swal("Canceled", "Your data failed to delete", "error");
 //        }
 //    });
}

trsp.saveTransaction = function(dt){
	// console.log("Save Transaction=====>")
	const cat = trsp.completed();
	if(cat.BF === true && cat.DP === true && cat.KPR === true){
		var validate = $('#forminput').parsley().validate();

		if(validate){
			if(trsp.data().length !== 0){
				// Save Multiple Data
				
				trsp.loader(true);
				$.ajax({
					dataType: "json",
					type: "post",
					url: "./controller/transaction_sell_property/transaction_sell_property_controller_add_multiple.php",
					data: {data : trsp.data()},
				}).done(function(data){
					//Save Transaction Sell Property
					let dataTransactionSell = {
						bfTotal: 0,
						bfAccountID: 0,
						bfAccountName: '',
						bfDate: null,
						dpTotal: 0,
						dpAccountID: 0,
						dpAccountName: '',
						dpDate: null,
						payTotal: 0,
						payAccountID: 0,
						payAccountName: '',
						payDate: null
					}
					
					trsp.data().map((item, idx)=>{
						if(item.categoryname==='Booking Fee'){
							// categoryname: "Booking Fee"
							dataTransactionSell.bfTotal = item.amount;
							dataTransactionSell.bfAccountID = item.accountid;
							dataTransactionSell.bfAccountName = item.accountname;
							dataTransactionSell.bfDate = item.date;
						}else if(item.categoryname==='DP'){
							dataTransactionSell.dpTotal = item.amount;
							dataTransactionSell.dpAccountID = item.accountid;
							dataTransactionSell.dpAccountName = item.accountname;
							dataTransactionSell.dpDate = item.date;
						}else{
							dataTransactionSell.payTotal = item.amount;
							dataTransactionSell.payAccountID = item.accountid;
							dataTransactionSell.payAccountName = item.accountname;
							dataTransactionSell.payDate = item.date;
						}
					});

					$.ajax({
						dataType: "json",
						type: "post",
						url: "./controller/transaction_sell_property/transaction_sell_property_controller_add_sell.php",
						data: {...trsp.data()[2], ...dataTransactionSell },
					}).done(function(data){

						trsp.resetForm();
						trsp.form(false);
						trsp.buttonVisible(true);
						trsp.buttonUnVisible(false);
						
						setTimeout(function(){
							trsp.loader(false);
							trsp.table(true);
							$("#DataTableTransactionSellProperty").DataTable().ajax.reload();
							swal({
								title: "Successfully",
				                text: "Your data has been saved",
				                type: "success",
				                confirmButtonText: "Ya",
							})
						}, 1000)
					})
				})
			}else{
				//Save Single Data
				trsp.loader(true);
				var dataFormValue = {
					projectid: $("#project").select2('data')[0].id,
					projectname: $("#project").select2('data')[0].text,
					date: $("#date").data('datepicker').getFormattedDate('yyyy-mm-dd'),
					accountid: $("#account").select2('data')[0].id,
					accountname: $("#account").select2('data')[0].accountname,
					accountbankname: $("#account").select2('data')[0].accountbankname,
					accountbankno: $("#account").select2('data')[0].accountbankno,
					cheque: $("#cheque").val(),
					maincategoryid: $("#maincategory").select2('data')[0].id,
					maincategoryname: $("#maincategory").select2('data')[0].text,
					maincategorycolor: $("#maincategory").select2('data')[0].color,
					maincategorygroups: $("#maincategory").select2('data')[0].groups,
					categoryid: $("#category").select2('data')[0].id,
					categoryname: $("#category").select2('data')[0].text,
					amount: toAngka($("#amount").val()),
					type: $("#payment_type").select2('data')[0].id,
					title: $("#title").val(),
					description: $("#description").val(),
					created: $('.usernameLabel').text()
				}
				$.ajax({
					dataType: "json",
					type: "post",
					url: "./controller/transaction_sell_property/transaction_sell_property_controller_add.php",
					data: {...dataFormValue}
				}).done(function(data){
					trsp.resetForm();
					trsp.form(false);
					trsp.buttonVisible(true);
					trsp.buttonUnVisible(false);
					setTimeout(function(){
						trsp.loader(false);
						trsp.table(true);
						$("#DataTableTransactionSellProperty").DataTable().ajax.reload();
						swal({
							title: "Successfully",
			                text: "Your data has been saved",
			                type: "success",
			                confirmButtonText: "Ya",
						})
					}, 1000)
				})
			}
		}else{
			return validate;
		}
	}else{
		swal({
	        title: "Tidak Diizinkan",
	        text: "Data belum lengkap, sesuaikan input detail pembayaran",
	        type: "error",
	        confirmButtonText: "Ya"
	    },function (isConfirm) {
	    	document.getElementById("forminputdetails").reset();
			$('#payment_type.select2-no-search').select2({
				minimumResultsForSearch: Infinity,
				placeholder: 'Choose one'
			});
			$("#maincategory").select2("val", "0");
			$("#category").empty();
			$("#category").prop("disabled", true);
			$('#forminputdetails').parsley().reset();
			trsp.prepareDatePicker();
			trsp.checkCompletedCategory();
	    });
	}
}

trsp.saveUpdateTransaction = function(){
	var compareDataOriginal = trsp.getDataEdit();
	var compareDataFormEdit = {
		maincategoryid: $("#maincategory").select2('data')[0].id,
		categoryname: $("#categoryname").val(),
		categoryinfo: $("#categoryinformation").val()
	}
	var validate = $('#forminput').parsley().validate();
	if(validate){
		if(!compare(compareDataOriginal, compareDataFormEdit)){
			// console.log("Masukin data edit terbaru", compareDataFormEdit);
			this.trsp.loader(true);
			$.ajax({
				dataType: "json",
				type: "post",
				url: "./controller/master_category/master_category_controller_edit.php",
				data: { ...compareDataFormEdit, id: trsp.getDataIdEdit }
			}).done(function(data){
				trsp.resetForm();
				trsp.form(false);
				trsp.buttonVisible(true);
				trsp.buttonUnVisible(false);
				setTimeout(function(){
					trsp.loader(false);
					trsp.table(true);
					$("#DataTableCategory").DataTable().ajax.reload();
					swal({
						title: "Successfully",
		                text: "Your data has been updated",
		                type: "success",
		                confirmButtonText: "Ya",
					})
				}, 1000)
			})
		}else{
			console.log("Tidak ada yang perlu dirubah");
		}
	}else{
		return validate
	}
	
}

trsp.cancelTransaction = function(dt){
	trsp.resetForm();
	trsp.buttonVisible(true);
	trsp.buttonUnVisible(false);
	trsp.table(true);
	trsp.form(false);
	trsp.detail(false);
	trsp.loader(false);
}

trsp.ajaxGetDataTransaction = function() {
	$('#DataTableTransactionSellProperty').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "./controller/transaction_sell_property/transaction_sell_property.php",
        "columnDefs": [{
		    "targets": 1,
	    	"render": function ( datas, type, row ) {
	            if(datas.length >= 15){
            		return '<span data-toggle="tooltip-primary" data-placement="bottom" title data-original-title="'+datas+'" style="cursor: pointer;">'+datas.substr( 0, 15 )+'...</span>'
            	}else{
            		return datas
            	}
	        }
		},{
		    "targets": 7,
	    	"render": function ( datas, type, row ) {
	            if(datas.length >= 16){
            		return '<span data-toggle="tooltip-primary" data-placement="bottom" title data-original-title="'+datas+'" style="cursor: pointer;">'+datas.substr( 0, 16 )+'...</span>'
            	}else{
            		return datas
            	}
	        }
		},{
		    "targets": 8,
	    	"render": function ( datas, type, row ) {
	            if(datas.length >= 15){
            		return '<span data-toggle="tooltip-primary" data-placement="bottom" title data-original-title="'+datas+'" style="cursor: pointer;">'+datas.substr( 0, 15 )+'...</span>'
            	}else{
            		return datas
            	}
	        }
		},{
			"targets": 9,
		    "data": function (datas) {
		    	return formatNumber(datas[9]);
		    }
		},{
			"orderable": false,
		    "targets": 11,
		    "data": function (datas) {
		    	return '<div class="btn-group"><a href="#" style="color:grey" onclick=trsp.detailTransaction('+JSON.stringify(datas[0])+');><i class="fa fa-table"></i></a>&nbsp;&nbsp;<a href="#" style="color:red" onclick=trsp.deleteTransaction('+JSON.stringify(datas[0])+');><i class="fa fa-trash"></i></a></div>'
		    }
		}],
		"order": [[ 0, 'desc' ]],
		"fnDrawCallback": function( oSettings ) {
          $('[data-toggle="tooltip"]').tooltip();

          // colored tooltip
          $('[data-toggle="tooltip-primary"]').tooltip({
              template: '<div class="tooltip tooltip-primary" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
          });
        }
    });
    $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });
}

trsp.toAmountNumber = function() {
    var valueOriginal = $("#amount").val();
    var valueValidate = validate(valueOriginal);
    if(valueValidate != null){
        var value = formatNumber(valueValidate[0]);
        $("#amount").val(value);
    }else{
        swal({
            title: "Tidak Diizinkan",
            text: "Amount harus angka, tanpa titik & koma...! ",
            type: "error",
            confirmButtonText: "Ya"
        },function (isConfirm) {
            $("#amount").val("");
            $("#amount").focus();
        });
    }
}

function formatNumber(n) {
    return n.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
}

function validate(s) {
    var rgx = /^[0-9]*\.?[0-9]*$/;
    return s.match(rgx);
}

function toAngka(rp){return parseInt(rp.replace(/,.*|\D/g,''),10)}

$(document).ready(function(){
	trsp.prepare();
	trsp.ajaxGetDataTransaction();
	// ko.applyBindings();
	var trspdt = new viewModels();
	ko.applyBindings(trspdt);
});