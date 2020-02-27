var pj = {
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

pj.prepare = function(){
	$('.select2-no-search').select2({
		minimumResultsForSearch: Infinity,
		placeholder: 'Choose one'
	});
	$('#forminput').parsley();
}

function compare(a, b) {
  return JSON.stringify(a) === JSON.stringify(b);
}

pj.resetForm = function(){
	document.getElementById("forminput").reset();
	$('#forminput').parsley().reset();
}

pj.addProject = function(){
	console.log("Add Project=====>")
	pj.buttonVisible(false);
	pj.buttonUnVisible(true);
	pj.table(false);
	pj.form(true);
	pj.titleNew(true);
	pj.titleEdit(false);
}

pj.editProject = function(dt) {
	console.log("Edit Project=====>", dt);
	pj.buttonVisible(false);
	pj.buttonUnVisible(true);
	pj.table(false);
	pj.form(true);
	pj.titleNew(false);
	pj.titleEdit(true);
	pj.getDataIdEdit(dt);

	$.ajax({
		dataType: 'json',
		type: 'post',
		url: './controller/master_project/master_project_controller_find.php',
		data: {id:dt}
	}).done(function(data){
		console.log("Get data edited", data)
		pj.getDataEdit({
			projectname: data[0].PROJECTNAME,
			projectdescription: data[0].PROJECTDESCRIPTION,
		});
		$("#projectname").val(data[0].PROJECTNAME);
		$("#projectdescription").val(data[0].PROJECTDESCRIPTION);
	})
}

pj.deleteProject = function(id) {
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
                url: './controller/master_project/master_project_controller_remove.php',
                data: { id: id }
            }).done(function(data){
                $("#DataTableProject").DataTable().ajax.reload();
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
            $("#DataTableProject").DataTable().ajax.reload();
            swal("Canceled", "Your data failed to delete", "error");
        }
    });
}

pj.saveProject = function(dt){
	console.log("Save Project=====>")
	var validate = $('#forminput').parsley().validate()
	if(validate){
		this.pj.loader(true);
		var dataFormValue = {
			projectname: $("#projectname").val(),
			projectdescription: $("#projectdescription").val(),
		}
		$.ajax({
			dataType: "json",
			type: "post",
			url: "./controller/master_project/master_project_controller_add.php",
			data: dataFormValue
		}).done(function(data){
			pj.resetForm();
			pj.form(false);
			pj.buttonVisible(true);
			pj.buttonUnVisible(false);
			setTimeout(function(){
				pj.loader(false);
				pj.table(true);
				$("#DataTableProject").DataTable().ajax.reload();
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
	
	// this.pj.table(false);
	// this.pj.form(false);
}

pj.saveUpdateProject = function(){
	var compareDataOriginal = pj.getDataEdit();
	var compareDataFormEdit = {
		projectname: $("#projectname").val(),
		projectdescription: $("#projectdescription").val()
	}
	var validate = $('#forminput').parsley().validate();
	if(validate){
		if(!compare(compareDataOriginal, compareDataFormEdit)){
			console.log("Masukin data edit terbaru", compareDataFormEdit);
			this.pj.loader(true);
			$.ajax({
				dataType: "json",
				type: "post",
				url: "./controller/master_project/master_project_controller_edit.php",
				data: { ...compareDataFormEdit, id: pj.getDataIdEdit }
			}).done(function(data){
				pj.resetForm();
				pj.form(false);
				pj.buttonVisible(true);
				pj.buttonUnVisible(false);
				setTimeout(function(){
					pj.loader(false);
					pj.table(true);
					$("#DataTableProject").DataTable().ajax.reload();
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

pj.cancelProject = function(dt){
	pj.resetForm();
	pj.buttonVisible(true);
	pj.buttonUnVisible(false);
	pj.table(true);
	pj.form(false);
	pj.loader(false);
}

pj.ajaxGetDataProject = function() {
	$('#DataTableProject').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "./controller/master_project/master_project_controller.php",
        "columnDefs": [{
        	"orderable": false,
		    "targets": 4,
		    "data": function (datas) {
		    	return '<div class="btn-group"><a href="#"  style="margin-right:15px" onclick=pj.editProject('+JSON.stringify(datas[0])+');><i class="fa fa-pencil"></i></a><a href="#" style="color:red" onclick=pj.deleteProject('+JSON.stringify(datas[0])+');><i class="fa fa-trash"></i></a></div>'
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
	pj.prepare();
	pj.ajaxGetDataProject();
	ko.applyBindings()
});