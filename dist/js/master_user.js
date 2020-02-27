var us = {
	buttonVisible: ko.observable(true),
	buttonUnVisible: ko.observable(false),
	loader: ko.observable(false),
	form: ko.observable(false),
	table: ko.observable(true),
	titleNew: ko.observable(false),
	titleEdit: ko.observable(false),
	getDataEdit: ko.observableArray()
};

us.prepare = function(){
	$('.select2-no-search').select2({
		minimumResultsForSearch: Infinity,
		placeholder: 'Choose one'
	});
	$('#forminput').parsley();
}

function compare(a, b) {
  return JSON.stringify(a) === JSON.stringify(b);
}

us.resetForm = function(){
	document.getElementById("forminput").reset();
	$("#level").val('').trigger('change');
	$('#forminput').parsley().reset();
}

us.addUser = function(){
	console.log("Add User=====>")
	us.buttonVisible(false);
	us.buttonUnVisible(true);
	us.table(false);
	us.form(true);
	us.titleNew(true);
	us.titleEdit(false);
	$("#username").attr('readonly', false)
}

us.editUser = function(dt) {
	console.log("Edit User=====>", dt);
	us.buttonVisible(false);
	us.buttonUnVisible(true);
	us.table(false);
	us.form(true);
	us.titleNew(false);
	us.titleEdit(true);
	$("#username").attr('readonly', true)

	$.ajax({
		dataType: 'json',
		type: 'post',
		url: './controller/master_user/master_user_controller_find.php',
		data: {username:dt}
	}).done(function(data){
		// console.log("Get data edited", data)
		us.getDataEdit({
			username: data[0].USERNAME,
			fullname: data[0].FULLNAME,
			password: data[0].USER_PASSWORD,
			email: data[0].USER_EMAIL,
			level: data[0].LEVEL
		});
		$("#username").val(data[0].USERNAME);
		$("#fullname").val(data[0].FULLNAME);
		$("#password").val(data[0].USER_PASSWORD);
		$("#re-password").val(data[0].USER_PASSWORD);
		$("#email").val(data[0].USER_EMAIL);
		$('#level').val(data[0].LEVEL).trigger('change');
	})
}

us.deleteUser = function(id) {
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
                url: './controller/master_user/master_user_controller_remove.php',
                data: { username: id }
            }).done(function(data){
                $("#DataTableUser").DataTable().ajax.reload();
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
            $("#DataTableUser").DataTable().ajax.reload();
            swal("Canceled", "Your data failed to delete", "error");
        }
    });
}

us.saveUser = function(dt){
	console.log("Save User=====>")
	var validate = $('#forminput').parsley().validate()
	if(validate){
		this.us.loader(true);
		var dataFormValue = {
			username: $("#username").val(),
			fullname: $("#fullname").val(),
			password: $("#password").val(),
			email: $("#email").val(),
			level: $("#level").val()
		}
		$.ajax({
			dataType: "json",
			type: "post",
			url: "./controller/master_user/master_user_controller_add.php",
			data: dataFormValue
		}).done(function(data){
			us.resetForm();
			us.form(false);
			us.buttonVisible(true);
			us.buttonUnVisible(false);
			setTimeout(function(){
				us.loader(false);
				us.table(true);
				$("#DataTableUser").DataTable().ajax.reload();
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
	
	// this.us.table(false);
	// this.us.form(false);
}
us.saveUpdateUser = function(){
	var compareDataOriginal = us.getDataEdit();
	var compareDataFormEdit = {
		username: $("#username").val(),
		fullname: $("#fullname").val(),
		password: $("#password").val(),
		email: $("#email").val(),
		level: $("#level").val()
	}
	var validate = $('#forminput').parsley().validate();
	if(validate){
		if(!compare(compareDataOriginal, compareDataFormEdit)){
			console.log("Masukin data edit terbaru", compareDataFormEdit);
			this.us.loader(true);
			$.ajax({
				dataType: "json",
				type: "post",
				url: "./controller/master_user/master_user_controller_edit.php",
				data: compareDataFormEdit
			}).done(function(data){
				us.resetForm();
				us.form(false);
				us.buttonVisible(true);
				us.buttonUnVisible(false);
				setTimeout(function(){
					us.loader(false);
					us.table(true);
					$("#DataTableUser").DataTable().ajax.reload();
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

us.cancelUser = function(dt){
	us.resetForm();
	us.buttonVisible(true);
	us.buttonUnVisible(false);
	us.table(true);
	us.form(false);
	us.loader(false);
}

us.ajaxGetDataUser = function() {
	$('#DataTableUser').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "./controller/master_user/master_user_controller.php",
        "columnDefs": [{
        	"orderable": false,
		    "targets": 6,
		    "data": function (datas) {
		    	return '<div class="btn-group"><a href="#"  style="margin-right:15px" onclick=us.editUser('+JSON.stringify(datas[1])+');><i class="fa fa-pencil"></i></a><a href="#" style="color:red" onclick=us.deleteUser('+JSON.stringify(datas[1])+');><i class="fa fa-trash"></i></a></div>'
		    }
		}]
    });
    $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });


	// $("#DataTableUser").DataTable({
	// 	responsive: true,
 //        processing: true,
 //        serverSide: true,
 //        ajax:{
 //            url: "./controller/master_user/master_user_controller.php",
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
	us.prepare();
	us.ajaxGetDataUser();
	ko.applyBindings()
});