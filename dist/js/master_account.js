var ac = {
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

ac.prepare = function(){
	$('.select2-no-search').select2({
		minimumResultsForSearch: Infinity,
		placeholder: 'Choose one'
	});
	$('#forminput').parsley();
}

function compare(a, b) {
  return JSON.stringify(a) === JSON.stringify(b);
}

ac.resetForm = function(){
	document.getElementById("forminput").reset();
	$('#forminput').parsley().reset();
}

ac.addAccount = function(){
	console.log("Add Account=====>")
	ac.buttonVisible(false);
	ac.buttonUnVisible(true);
	ac.table(false);
	ac.form(true);
	ac.titleNew(true);
	ac.titleEdit(false);
	$("#username").attr('readonly', false)
}

ac.editAccount = function(dt) {
	console.log("Edit Account=====>", dt);
	ac.buttonVisible(false);
	ac.buttonUnVisible(true);
	ac.table(false);
	ac.form(true);
	ac.titleNew(false);
	ac.titleEdit(true);
	ac.getDataIdEdit(dt);

	$.ajax({
		dataType: 'json',
		type: 'post',
		url: './controller/master_account/master_account_controller_find.php',
		data: {id:dt}
	}).done(function(data){
		console.log("Get data edited", data)
		ac.getDataEdit({
			accountname: data.ACCOUNTNAME,
			accountbankno: data.ACCOUNTBANKNO,
			accountbankname: data.ACCOUNTBANKNAME
		});
		$("#accountname").val(data.ACCOUNTNAME);
		$("#accountbankno").val(data.ACCOUNTBANKNO);
		$("#accountbankname").val(data.ACCOUNTBANKNAME);	
	});
}

ac.deleteAccount = function(id) {
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
                url: './controller/master_account/master_account_controller_remove.php',
                data: { id: id }
            }).done(function(data){
                $("#DataTableAccount").DataTable().ajax.reload();
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
            $("#DataTableAccount").DataTable().ajax.reload();
            swal("Canceled", "Your data failed to delete", "error");
        }
    });
}

ac.saveAccount = function(dt){
	console.log("Save Account=====>")
	var validate = $('#forminput').parsley().validate()
	if(validate){
		this.ac.loader(true);
		var dataFormValue = {
			accountname: $("#accountname").val(),
			accountbankno: $("#accountbankno").val(),
			accountbankname: $("#accountbankname").val()
		}
		$.ajax({
			dataType: "json",
			type: "post",
			url: "./controller/master_account/master_account_controller_add.php",
			data: dataFormValue
		}).done(function(data){
			ac.resetForm();
			ac.form(false);
			ac.buttonVisible(true);
			ac.buttonUnVisible(false);
			setTimeout(function(){
				ac.loader(false);
				ac.table(true);
				$("#DataTableAccount").DataTable().ajax.reload();
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
	
	// this.ac.table(false);
	// this.ac.form(false);
}

ac.saveUpdateAccount = function(){
	var compareDataOriginal = ac.getDataEdit();
	var compareDataFormEdit = {
		accountname: $("#accountname").val(),
		accountbankno: $("#accountbankno").val(),
		accountbankname: $("#accountbankname").val()
	}
	var validate = $('#forminput').parsley().validate();
	if(validate){
		if(!compare(compareDataOriginal, compareDataFormEdit)){
			console.log("Masukin data edit terbaru", compareDataFormEdit);
			this.ac.loader(true);
			$.ajax({
				dataType: "json",
				type: "post",
				url: "./controller/master_account/master_account_controller_edit.php",
				data: { ...compareDataFormEdit, id: ac.getDataIdEdit }
			}).done(function(data){
				ac.resetForm();
				ac.form(false);
				ac.buttonVisible(true);
				ac.buttonUnVisible(false);
				setTimeout(function(){
					ac.loader(false);
					ac.table(true);
					$("#DataTableAccount").DataTable().ajax.reload();
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

ac.cancelAccount = function(dt){
	ac.resetForm();
	ac.buttonVisible(true);
	ac.buttonUnVisible(false);
	ac.table(true);
	ac.form(false);
	ac.loader(false);
}

ac.ajaxGetDataAccount = function() {
	$('#DataTableAccount').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "./controller/master_account/master_account_controller.php",
        "columnDefs": [{
        	"orderable": false,
		    "targets": 5,
		    "data": function (datas) {
		    	return '<div class="btn-group"><a href="#"  style="margin-right:15px" onclick=ac.editAccount('+JSON.stringify(datas[0])+');><i class="fa fa-pencil"></i></a><a href="#" style="color:red" onclick=ac.deleteAccount('+JSON.stringify(datas[0])+');><i class="fa fa-trash"></i></a></div>'
		    }
		}]
    });
    $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });
}

$(document).ready(function(){
	ac.prepare();
	ac.ajaxGetDataAccount();
	ko.applyBindings()
});