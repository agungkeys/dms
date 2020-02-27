var trfrev = {
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
	modeSingle: ko.observable(true),
	modeMultiple: ko.observable(false),
	data: ko.observableArray([]),
};

trfrev.prepare = function(){
	$('#payment_type.select2-no-search').select2({
		minimumResultsForSearch: Infinity,
		placeholder: 'Choose one'
	});
	$('#colorpicker').spectrum({
		color: '#17A2B8'
	});
	trfrev.selectMainTransaction();
	$('#forminput').parsley();
	$("#maincategory").select2("val", "0");
	trfrev.prepareDatePicker();
	// $('#cheque').mask('aa-9999999999');
}

trfrev.prepareDatePicker = function() {
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

trfrev.changeMode = function(data){
	console.log("Mode ====>>>", data);
	if(data === 'single'){
		// $('#transaction-finance').addClass('col-xl-6');
		trfrev.modeSingle(true)
		trfrev.modeMultiple(false)

	}else{
		// $('#transaction-finance').removeClass('col-xl-6');
		trfrev.modeSingle(false)
		trfrev.modeMultiple(true)
	}
}

function compare(a, b) {
  return JSON.stringify(a) === JSON.stringify(b);
}

trfrev.selectMainTransaction = function(){
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
            url: './controller/transaction_finance_revenue/transaction_select_main_category.php',
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
        trfrev.selectMainCategoryId = dataIds;

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
                    data: {cat : trfrev.selectMainCategoryId },
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
            url: './controller/transaction_finance_revenue/transaction_select_account.php',
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
    $('#project').select2({
        minimumResultsForSearch: Infinity,
        placeholder: 'Select Project...',
        ajax: {
            url: './controller/transaction_finance_revenue/transaction_select_project.php',
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
}

trfrev.resetForm = function(){
	trfrev.data([])
	document.getElementById("forminput").reset();
	$('#forminput').parsley().reset();
	$('#forminputdetails').parsley().reset();
	$("#maincategory").select2("val", "0");
	$("#category").empty();
	$('a:contains("Single")').click();
	$("#category").prop("disabled", true);
	$("#account").select2("val", "0");
	$("#payment_type").val('').trigger('change');
}

trfrev.addTransaction = function(){
	console.log("Add Category=====>")
	trfrev.buttonVisible(false);
	trfrev.buttonUnVisible(true);
	trfrev.table(false);
	trfrev.form(true);
	trfrev.titleNew(true);
	trfrev.titleEdit(false);
}

function viewModels(){ 
    self.rows = trfrev.data;
    self.getTotal = ko.pureComputed(function () {
        var total = 0;
        ko.utils.arrayForEach(self.rows(), function (row) {
            total += row.amount;
            // console.log('Data View Models==>>>',row)
        });
        return formatNumber(JSON.stringify(total));
    });
} 

trfrev.removeDetailItem = function(){
    trfrev.data.remove(this);
}

trfrev.addDetailItem = function(){
	var validate = $('#forminput').parsley().validate();
	if(validate){
		var validateDetails = $('#forminputdetails').parsley().validate();
		if(validateDetails){
			var datas = {
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
				type: $("#payment_type").val(),
				title: $("#title").val(),
				description: $("#description").val(),
				created: $('.usernameLabel').text(),
			}
			trfrev.data.push(datas)
			document.getElementById("forminputdetails").reset();
			$("#maincategory").select2("val", "0");
			$("#category").empty();
			$("#category").prop("disabled", true);
			$('#forminputdetails').parsley().reset();
		}else{
			return
		}
	}else{
		return
	}
}

trfrev.detailTransaction = function(dt){
	// console.log("Detail Transaction=====>", dt);
	trfrev.buttonUnVisible(true);
	$("#save").hide();
	trfrev.buttonVisible(false);
	trfrev.table(false);
	trfrev.form(false);
	trfrev.detail(true);

	$.ajax({
		dataType: 'json',
		type: 'post',
		url: './controller/transaction_finance_revenue/transaction_finance_controller_find.php',
		data: {id:dt}
	}).done(function(data){
		// console.log("Get detail transaction", data)
		$("#dtl_title").html(data[0].TRANSACTIONID);
		$("#dtl_transactionid").html(data[0].TRANSACTIONID);
		$("#dtl_project").html(data[0].PROJECTNAME);
		$("#dtl_date").html(data[0].DATE);
		$("#dtl_account").html(data[0].ACCOUNTNAME+' ( '+data[0].ACCOUNTBANKNO+' ) ');
		$("#dtl_cheque").html(data[0].CHEQUE);
		$("#dtl_maincategory").html(data[0].MAINCATEGORYNAME);
		$("#dtl_category").html(data[0].CATEGORYNAME);
		$("#dtl_amount").html(formatNumber(data[0].AMOUNT));
		$("#dtl_transactiontitle").html(data[0].TRANSACTIONTITLE);
		$("#dtl_description").html(data[0].DESCRIPTION);
	})
}

trfrev.editTransaction = function(dt) {
	console.log("Edit Category=====>", dt);
	trfrev.buttonVisible(false);
	trfrev.buttonUnVisible(true);
	trfrev.table(false);
	trfrev.form(true);
	trfrev.titleNew(false);
	trfrev.titleEdit(true);
	trfrev.getDataIdEdit(dt);

	$.ajax({
		dataType: 'json',
		type: 'post',
		url: './controller/master_category/master_category_controller_find.php',
		data: {id:dt}
	}).done(function(data){
		// console.log("Get data edited", data)
		trfrev.getDataEdit({
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

trfrev.deleteTransaction = function(id) {
	swal({
        title: "Your data will be delete ?",
        text: "Are you sure delete data '"+id+"' !?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: false
    },
    function (isConfirm) {
        if (isConfirm) {
            $.ajax({
                dataType: 'json',
                type:'post',
                url: './controller/transaction_finance_revenue/transaction_finance_controller_remove.php',
                data: { id: id }
            }).done(function(data){
                $("#DataTableTransactionRevenue").DataTable().ajax.reload();
                // swal("Berhasil Dihapus!", "Data Berhasil Dihapus", "success");
                swal({
                    title: "Deleted",
                    text: "Your data has been deleted",
                    type: "success",
                    confirmButtonText: "Ya",
                })
                // toastr.success('Item Deleted Successfully.', 'Success Alert', {timeOut: 5000});
            });
        } else {
            $("#DataTableTransaction").DataTable().ajax.reload();
            swal("Canceled", "Your data failed to delete", "error");
        }
    });
}

trfrev.saveTransaction = function(dt){
	console.log("Save Category=====>")
	var validate = $('#forminput').parsley().validate();
	if(validate){
		if(trfrev.data().length !== 0){
			//Save Multiple Data
			trfrev.loader(true);
			$.ajax({
				dataType: "json",
				type: "post",
				url: "./controller/transaction_finance_revenue/transaction_finance_controller_add_multiple.php",
				data: {data : trfrev.data()},
			}).done(function(data){
				trfrev.resetForm();
				trfrev.form(false);
				trfrev.buttonVisible(true);
				trfrev.buttonUnVisible(false);
				setTimeout(function(){
					trfrev.loader(false);
					trfrev.table(true);
					$("#DataTableTransactionRevenue").DataTable().ajax.reload();
					swal({
						title: "Successfully",
		                text: "Your data has been saved",
		                type: "success",
		                confirmButtonText: "Ya",
					})
				}, 1000)
			})
		}else{
			//Save Single Data
			trfrev.loader(true);
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
				type: $("#payment_type").val(),
				title: $("#title").val(),
				description: $("#description").val(),
				created: $('.usernameLabel').text()
			}
			$.ajax({
				dataType: "json",
				type: "post",
				url: "./controller/transaction_finance_revenue/transaction_finance_controller_add.php",
				data: {...dataFormValue}
			}).done(function(data){
				trfrev.resetForm();
				trfrev.form(false);
				trfrev.buttonVisible(true);
				trfrev.buttonUnVisible(false);
				setTimeout(function(){
					trfrev.loader(false);
					trfrev.table(true);
					$("#DataTableTransactionRevenue").DataTable().ajax.reload();
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
}

trfrev.saveUpdateTransaction = function(){
	var compareDataOriginal = trfrev.getDataEdit();
	var compareDataFormEdit = {
		maincategoryid: $("#maincategory").select2('data')[0].id,
		categoryname: $("#categoryname").val(),
		categoryinfo: $("#categoryinformation").val()
	}
	var validate = $('#forminput').parsley().validate();
	if(validate){
		if(!compare(compareDataOriginal, compareDataFormEdit)){
			console.log("Masukin data edit terbaru", compareDataFormEdit);
			this.trfrev.loader(true);
			$.ajax({
				dataType: "json",
				type: "post",
				url: "./controller/master_category/master_category_controller_edit.php",
				data: { ...compareDataFormEdit, id: trfrev.getDataIdEdit }
			}).done(function(data){
				trfrev.resetForm();
				trfrev.form(false);
				trfrev.buttonVisible(true);
				trfrev.buttonUnVisible(false);
				setTimeout(function(){
					trfrev.loader(false);
					trfrev.table(true);
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

trfrev.cancelTransaction = function(dt){
	trfrev.resetForm();
	trfrev.buttonVisible(true);
	trfrev.buttonUnVisible(false);
	trfrev.table(true);
	trfrev.form(false);
	trfrev.detail(false);
	trfrev.loader(false);
}

trfrev.ajaxGetDataTransactionRevenue = function() {
	$('#DataTableTransactionRevenue').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "./controller/transaction_finance_revenue/transaction_finance_controller.php",
        "columnDefs": [
     	{
		    "targets": 1,
		    "data": function (datas) {
		    	if(datas[1] === "Revenue"){
		    		return '<span><i class="fa fa-arrow-circle-down text-success"></i> Revenue</span>'
		    	}else{
		    		return '<span><i class="fa fa-arrow-circle-up text-danger"></i> Cost</span>'
		    	}
		    }
		},{
		    "targets": 2,
		    "data": function (datas) {
		    	return '<span class="label" style="padding: 0.3em; background-color: '+datas[7]+'">'+datas[2]+'</span>'
		    }
		},{
		    "targets": 3,
	    	"render": function ( datas, type, row ) {
            	if(datas.length >= 10){
            		return '<span data-toggle="tooltip-primary" data-placement="bottom" title data-original-title="'+datas+'" style="cursor: pointer;">'+datas.substr( 0, 10 )+'...</span>'
            	}else{
            		return datas
            	}
	        }
		},{
		    "targets": 4,
	    	"render": function ( datas, type, row ) {
	            if(datas.length >= 15){
            		return '<span data-toggle="tooltip-primary" data-placement="bottom" title data-original-title="'+datas+'" style="cursor: pointer;">'+datas.substr( 0, 15 )+'...</span>'
            	}else{
            		return datas
            	}
	        }
		},{
		    "targets": 5,
	    	"render": function ( datas, type, row ) {
	            if(datas.length >= 10){
            		return '<span data-toggle="tooltip-primary" data-placement="bottom" title data-original-title="'+datas+'" style="cursor: pointer;">'+datas.substr( 0, 10 )+'...</span>'
            	}else{
            		return datas
            	}
	        }
		},{
		    "targets": 6,
		    "data": function (datas) {
		    	return formatNumber(datas[6]);
		    }
		},{
		    "targets": 8,
	    	"render": function ( datas, type, row ) {
	            if(datas.length >= 10){
            		return '<span data-toggle="tooltip-primary" data-placement="bottom" title data-original-title="'+datas+'" style="cursor: pointer;">'+datas.substr( 0, 10 )+'...</span>'
            	}else{
            		return datas
            	}
	        }
		},{
			"orderable": false,
		    "targets": 11,
		    "data": function (datas) {
		    	return '<div class="btn-group"><a href="#" style="color:grey" onclick=trfrev.detailTransaction('+JSON.stringify(datas[0])+');><i class="fa fa-table"></i></a>&nbsp;&nbsp;<a href="#" style="color:red" onclick=trfrev.deleteTransaction('+JSON.stringify(datas[0])+');><i class="fa fa-trash"></i></a></div>'
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

trfrev.toAmountNumber = function() {
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
	trfrev.prepare();
	trfrev.ajaxGetDataTransactionRevenue();
	// ko.applyBindings();
	var trfdt = new viewModels();
	ko.applyBindings(trfdt);
	
});