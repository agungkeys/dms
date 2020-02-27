var trf = {
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

trf.prepare = function(){
	// $('.select2-no-search').select2({
	// 	minimumResultsForSearch: Infinity,
	// 	placeholder: 'Choose one'
	// });
	$('#colorpicker').spectrum({
		color: '#17A2B8'
	});
	trf.selectMainTransaction();
	$('#forminput').parsley();
	$("#maincategory").select2("val", "0");

	$('#date .fc-datepicker').datepicker({
		showOtherMonths: true,
		selectOtherMonths: true
    });

	trf.prepareDatePicker();
	// $('#cheque').mask('aa-9999999999');

}

trf.prepareDatePicker = function() {
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

trf.changeMode = function(data){
	console.log("Mode ====>>>", data);
	if(data === 'single'){
		// $('#transaction-finance').addClass('col-xl-6');
		trf.modeSingle(true)
		trf.modeMultiple(false)

	}else{
		// $('#transaction-finance').removeClass('col-xl-6');
		trf.modeSingle(false)
		trf.modeMultiple(true)
	}
}

function compare(a, b) {
  return JSON.stringify(a) === JSON.stringify(b);
}

trf.selectMainTransaction = function(){
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
            url: './controller/transaction_finance/transaction_select_main_category.php',
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

    $('#maincategory').on('select2:select', function (e) {
    	var dataIds = e.params.data.id;
        trf.selectMainCategoryId = dataIds;

        $("#category").prop("disabled", false);
        $("#category").empty();

        function runCatSelect(){
            $('#category').select2({
                placeholder: 'Select Category...',
                minimumResultsForSearch: Infinity,
                ajax: {
                    url: './controller/transaction_finance/transaction_select_category.php',
                    dataType: 'json',
                    delay: 250,
                    data: {cat : trf.selectMainCategoryId },
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
            url: './controller/transaction_finance/transaction_select_project.php',
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

trf.resetForm = function(){
	trf.data([])
	document.getElementById("forminput").reset();
	$('#forminput').parsley().reset();
	$('#forminputdetails').parsley().reset();
	$("#maincategory").select2("val", "0");
	$("#category").empty();
	$('a:contains("Single")').click();
	$("#category").prop("disabled", true);
	$("#account").select2("val", "0");
}

trf.addTransaction = function(){
	console.log("Add Category=====>")
	trf.buttonVisible(false);
	trf.buttonUnVisible(true);
	trf.table(false);
	trf.form(true);
	trf.titleNew(true);
	trf.titleEdit(false);
}

function viewModels(){ 
    self.rows = trf.data;
    self.getTotal = ko.pureComputed(function () {
        var total = 0;
        ko.utils.arrayForEach(self.rows(), function (row) {
            total += row.amount;
            // console.log('Data View Models==>>>',row)
        });
        return formatNumber(JSON.stringify(total));
    });
} 

trf.removeDetailItem = function(){
    trf.data.remove(this);
}

trf.addDetailItem = function(){
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
				title: $("#title").val(),
				description: $("#description").val(),
				created: $('.usernameLabel').text(),
			}
			trf.data.push(datas)
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

trf.detailTransaction = function(dt){
	// console.log("Detail Transaction=====>", dt);
	trf.buttonUnVisible(true);
	$("#save").hide();
	trf.buttonVisible(false);
	trf.table(false);
	trf.form(false);
	trf.detail(true);

	$.ajax({
		dataType: 'json',
		type: 'post',
		url: './controller/transaction_finance/transaction_finance_controller_find.php',
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

trf.editTransaction = function(dt) {
	console.log("Edit Transaction=====>", dt);
	trf.buttonVisible(false);
	trf.buttonUnVisible(true);
	trf.table(false);
	trf.form(true);
	trf.titleNew(false);
	trf.titleEdit(true);
	trf.getDataIdEdit(dt);

	$.ajax({
		dataType: 'json',
		type: 'post',
		url: './controller/master_category/master_category_controller_find.php',
		data: {id:dt}
	}).done(function(data){
		// console.log("Get data edited", data)
		trf.getDataEdit({
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

trf.deleteTransaction = function(id) {
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
                url: './controller/transaction_finance/transaction_finance_controller_remove.php',
                data: { id: id }
            }).done(function(data){
                $("#DataTableTransaction").DataTable().ajax.reload();
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

trf.saveTransaction = function(dt){
	console.log("Save Transaction=====>")
	var validate = $('#forminput').parsley().validate();
	if(validate){
		if(trf.data().length !== 0){
			//Save Multiple Data
			trf.loader(true);
			$.ajax({
				dataType: "json",
				type: "post",
				url: "./controller/transaction_finance/transaction_finance_controller_add_multiple.php",
				data: {data : trf.data()},
			}).done(function(data){
				trf.resetForm();
				trf.form(false);
				trf.buttonVisible(true);
				trf.buttonUnVisible(false);
				setTimeout(function(){
					trf.loader(false);
					trf.table(true);
					$("#DataTableTransaction").DataTable().ajax.reload();
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
			trf.loader(true);
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
				title: $("#title").val(),
				description: $("#description").val(),
				created: $('.usernameLabel').text()
			}
			$.ajax({
				dataType: "json",
				type: "post",
				url: "./controller/transaction_finance/transaction_finance_controller_add.php",
				data: {...dataFormValue}
			}).done(function(data){
				trf.resetForm();
				trf.form(false);
				trf.buttonVisible(true);
				trf.buttonUnVisible(false);
				setTimeout(function(){
					trf.loader(false);
					trf.table(true);
					$("#DataTableTransaction").DataTable().ajax.reload();
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

trf.saveUpdateTransaction = function(){
	var compareDataOriginal = trf.getDataEdit();
	var compareDataFormEdit = {
		maincategoryid: $("#maincategory").select2('data')[0].id,
		categoryname: $("#categoryname").val(),
		categoryinfo: $("#categoryinformation").val()
	}
	var validate = $('#forminput').parsley().validate();
	if(validate){
		if(!compare(compareDataOriginal, compareDataFormEdit)){
			console.log("Masukin data edit terbaru", compareDataFormEdit);
			this.trf.loader(true);
			$.ajax({
				dataType: "json",
				type: "post",
				url: "./controller/master_category/master_category_controller_edit.php",
				data: { ...compareDataFormEdit, id: trf.getDataIdEdit }
			}).done(function(data){
				trf.resetForm();
				trf.form(false);
				trf.buttonVisible(true);
				trf.buttonUnVisible(false);
				setTimeout(function(){
					trf.loader(false);
					trf.table(true);
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

trf.cancelTransaction = function(dt){
	trf.resetForm();
	trf.buttonVisible(true);
	trf.buttonUnVisible(false);
	trf.table(true);
	trf.form(false);
	trf.detail(false);
	trf.loader(false);
}

trf.ajaxGetDataTransaction = function() {
	$('#DataTableTransaction').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "./controller/transaction_finance/transaction_finance_controller.php",
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
		    "targets": 6,
	    	"render": function ( datas, type, row ) {
	            if(datas.length >= 10){
            		return '<span data-toggle="tooltip-primary" data-placement="bottom" title data-original-title="'+datas+'" style="cursor: pointer;">'+datas.substr( 0, 10 )+'...</span>'
            	}else{
            		return datas
            	}
	        }
		},{
		    "targets": 7,
		    "data": function (datas) {
		    	return formatNumber(datas[7]);
		    }
		},{
		    "targets": 8,
	    	"render": function ( datas, type, row ) {
	            if(datas.length >= 8){
            		return '<span data-toggle="tooltip-primary" data-placement="bottom" title data-original-title="'+datas+'" style="cursor: pointer;">'+datas.substr( 0, 8 )+'...</span>'
            	}else{
            		return datas
            	}
	        }
		},{ "visible": false, "targets": 9 },

		{
			"orderable": false,
		    "targets": 11,
		    "data": function (datas) {
		    	return '<div class="btn-group"><a href="#" style="color:grey" onclick=trf.detailTransaction('+JSON.stringify(datas[0])+');><i class="fa fa-table"></i></a>&nbsp;&nbsp;<a href="#" style="color:red" onclick=trf.deleteTransaction('+JSON.stringify(datas[0])+');><i class="fa fa-trash"></i></a></div>'
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

trf.toAmountNumber = function() {
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
	trf.prepare();
	trf.ajaxGetDataTransaction();
	// ko.applyBindings();
	var trfdt = new viewModels();
	ko.applyBindings(trfdt);
});