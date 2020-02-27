var cs = {
	buttonVisible: ko.observable(true),
	buttonUnVisible: ko.observable(false),
	loader: ko.observable(false),
	form: ko.observable(false),
	table: ko.observable(true),
	titleNew: ko.observable(false),
	titleEdit: ko.observable(false),
	getDataIdEdit: ko.observable(),
	getDataEdit: ko.observableArray()
};

cs.prepare = function(){
	// $('.select2-no-search').select2({
	// 	minimumResultsForSearch: Infinity,
	// 	placeholder: 'Choose one'
	// });
	$('#forminput').parsley();
	$("#npwp").mask("99-999-999-9-999-999");
}

function compare(a, b) {
  return JSON.stringify(a) === JSON.stringify(b);
}

cs.resetForm = function(){
	document.getElementById("forminput").reset();
	$("#level").val('').trigger('change');
	$('#forminput').parsley().reset();
}

cs.addCustomer = function(){
	console.log("Add Customer=====>")
	cs.buttonVisible(false);
	cs.buttonUnVisible(true);
	cs.table(false);
	cs.form(true);
	cs.titleNew(true);
	cs.titleEdit(false);
}

cs.editCustomer = function(dt) {
	console.log("Edit Customer=====>", dt);
	cs.buttonVisible(false);
	cs.buttonUnVisible(true);
	cs.table(false);
	cs.form(true);
	cs.titleNew(false);
	cs.titleEdit(true);
	cs.getDataIdEdit(dt);

	$.ajax({
		dataType: 'json',
		type: 'post',
		url: './controller/master_customer/master_customer_controller_find.php',
		data: {id:dt}
	}).done(function(data){
		// console.log("Get data edited", data)
		cs.getDataEdit({
			customerid: data[0].CUSTOMERID, 
			fullname: data[0].FULLNAME,
			ktp: data[0].KTP,
			npwp: data[0].NPWP,
			email: data[0].EMAIL,
			address: data[0].ADDRESS,
			zipcode: data[0].ZIPCODE,
			idkelurahan: data[0].IDKELURAHAN,
			kelurahan: data[0].NAMEKELURAHAN,
			idkecamatan: data[0].IDKECAMATAN,
			kecamatan: data[0].NAMEKECAMATAN,
			idkabupaten: data[0].IDKABUPATEN,
			kabupaten: data[0].NAMEKABUPATEN,
			idprovince: data[0].IDPROVINCE,
			province: data[0].NAMEPROVINCE,
			telphome: data[0].TELPHOME,
			telpoffice: data[0].TELPOFFICE,
			telphp: data[0].TELPHP,
			note: data[0].NOTE,
		});

		$("#fullname").val(data[0].FULLNAME);
		$("#ktp").val(data[0].KTP);
		$("#npwp").val(data[0].NPWP);
		$("#email").val(data[0].EMAIL);
		$("#address").val(data[0].ADDRESS);
		$("#zip_code").val(data[0].ZIPCODE);
		$("#kelurahan").val(data[0].NAMEKELURAHAN);
		$("#kecamatan").val(data[0].NAMEKECAMATAN);
		$("#kabupaten").val(data[0].NAMEKABUPATEN);
		$("#province").val(data[0].NAMEPROVINCE);
		$("#telphome").val(data[0].TELPHOME);
		$("#telpoffice").val(data[0].TELPOFFICE);
		$("#telphp").val(data[0].TELPHP);
		$("#note").val(data[0].NOTE);
	})
}

cs.deleteCustomer = function(id) {
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
                url: './controller/master_customer/master_customer_controller_remove.php',
                data: { id: id }
            }).done(function(data){
                $("#DataTableCustomer").DataTable().ajax.reload();
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
            $("#DataTableCustomer").DataTable().ajax.reload();
            swal("Canceled", "Your data failed to delete", "error");
        }
    });
}

cs.saveCustomer = function(dt){
	console.log("Save Customer=====>")
	var validate = $('#forminput').parsley().validate()
	if(validate){
		this.cs.loader(true);
		var dataFormValue = {
			fullname: $("#fullname").val(),
			ktp: $("#ktp").val(),
			npwp: $("#npwp").val(),
			email: $("#email").val(),
			address: $("#address").val(),
			zipcode: $("#zip_code").val(),
			idkelurahan: 0,
			kelurahan: $("#kelurahan").val(),
			idkecamatan: 0,
			kecamatan: $("#kecamatan").val(),
			idkabupaten: 0,
			kabupaten: $("#kabupaten").val(),
			idprovince: 0,
			province: $("#province").val(),
			telphome: $("#telphome").val(),
			telpoffice: $("#telpoffice").val(),
			telphp: $("#telphp").val(),
			note: $("#note").val(),
		}
		$.ajax({
			dataType: "json",
			type: "post",
			url: "./controller/master_customer/master_customer_controller_add.php",
			data: dataFormValue
		}).done(function(data){
			cs.resetForm();
			cs.form(false);
			cs.buttonVisible(true);
			cs.buttonUnVisible(false);
			setTimeout(function(){
				cs.loader(false);
				cs.table(true);
				$("#DataTableCustomer").DataTable().ajax.reload();
				swal({
					title: "Successfully",
	                text: "Your data has been saved",
	                type: "success",
	                confirmButtonText: "Ya",
				})
			}, 1000)
		})
	}else{
		return validate;
	}
	
	// this.cs.table(false);
	// this.cs.form(false);
}
cs.saveUpdateCustomer = function(){
	var compareDataOriginal = cs.getDataEdit();
	var compareDataFormEdit = {
		fullname: $("#fullname").val(),
		ktp: $("#ktp").val(),
		npwp: $("#npwp").val(),
		email: $("#email").val(),
		address: $("#address").val(),
		zipcode: $("#zip_code").val(),
		kelurahan: $("#kelurahan").val(),
		kecamatan: $("#kecamatan").val(),
		kabupaten: $("#kabupaten").val(),
		province: $("#province").val(),
		telphome: $("#telphome").val(),
		telpoffice: $("#telpoffice").val(),
		telphp: $("#telphp").val(),
		note: $("#note").val(),
	}
	var validate = $('#forminput').parsley().validate();
	if(validate){
		if(!compare(compareDataOriginal, compareDataFormEdit)){
			console.log("Masukin data edit terbaru", compareDataFormEdit);
			this.cs.loader(true);
			$.ajax({
				dataType: "json",
				type: "post",
				url: "./controller/master_customer/master_customer_controller_edit.php",
				data: {...compareDataFormEdit, id: cs.getDataIdEdit}
			}).done(function(data){
				cs.resetForm();
				cs.form(false);
				cs.buttonVisible(true);
				cs.buttonUnVisible(false);
				setTimeout(function(){
					cs.loader(false);
					cs.table(true);
					$("#DataTableCustomer").DataTable().ajax.reload();
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

cs.cancelCustomer = function(dt){
	cs.resetForm();
	cs.buttonVisible(true);
	cs.buttonUnVisible(false);
	cs.table(true);
	cs.form(false);
	cs.loader(false);
}

cs.ajaxGetDataCustomer = function() {
	$('#DataTableCustomer').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "./controller/master_customer/master_customer_controller.php",
        "columnDefs": [{
        	"orderable": false,
		    "targets": 8,
		    "data": function (datas) {
		    	return '<div class="btn-group"><a href="#" style="margin-right:15px" onclick=cs.editCustomer('+JSON.stringify(datas[0])+');><i class="fa fa-pencil"></i></a><a href="#" style="color:red" onclick=cs.deleteCustomer('+JSON.stringify(datas[0])+');><i class="fa fa-trash"></i></a></div>'
		    }
		}]
    });

    $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });


	// $("#DataTableUser").DataTable({
	// 	responsive: true,
 //        processing: true,
 //        serverSide: true,
 //        ajax:{
 //            url: "./controller/master_customer/master_customer_controller.php",
 //            type: "post",
 //            error: function(){
 //                $(".DataTableUser-error").html("");
 //                $("#DataTableUser").append('<tbody class="DataTableBarang-grid-error"><tr><th colspan="6">Data Tidak Ditemukan...</th></tr></tbody>');
 //                $("#DataTableUser_processing").css("display","none");
 //            },
 //            complete: function(){}
 //        },
 //        order: [[ 0, 'desc' ],[ 1, 'desc' ],[ 3, 'desc' ]],
 //        columnDefs: [ { orderable: false, targets: [5] }]
 //    });
}

$(document).ready(function(){
	cs.prepare();
	cs.ajaxGetDataCustomer();
	ko.applyBindings()
});