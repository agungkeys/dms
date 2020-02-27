var cl = {
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

cl.prepare = function(){
	// $('.select2-no-search').select2({
	// 	minimumResultsForSearch: Infinity,
	// 	placeholder: 'Choose one'
	// });
	$('#forminput').parsley();
	cl.selectProject();
}

function compare(a, b) {
  return JSON.stringify(a) === JSON.stringify(b);
}

cl.selectProject = function(){
	$('#project').select2({
        minimumResultsForSearch: Infinity,
        placeholder: 'Select Project...',
        ajax: {
            url: './controller/master_cluster/master_cluster_select_project.php',
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

cl.resetForm = function(){
	document.getElementById("forminput").reset();
	$("#level").val('').trigger('change');
	$('#forminput').parsley().reset();
}

cl.addCluster = function(){
	console.log("Add Cluster=====>");
	cl.buttonVisible(false);
	cl.buttonUnVisible(true);
	cl.table(false);
	cl.form(true);
	cl.titleNew(true);
	cl.titleEdit(false);
}

cl.editCluster = function(dt) {
	// console.log("Edit Cluster=====>", dt);
	cl.buttonVisible(false);
	cl.buttonUnVisible(true);
	cl.table(false);
	cl.form(true);
	cl.titleNew(false);
	cl.titleEdit(true);
	cl.getDataIdEdit(dt);

	$.ajax({
		dataType: 'json',
		type: 'post',
		url: './controller/master_cluster/master_cluster_controller_find.php',
		data: {id:dt}
	}).done(function(data){
		console.log("Get data edited", data)
		cl.getDataEdit({
			projectid: data[0].PROJECTID,
			projectname:data[0].PROJECTNAME,
			kavblok:data[0].KAVBLOK,
			kavno:data[0].KAVNO,
			typelb:data[0].TYPELB,
			typelt:data[0].TYPELT,
			excessland:data[0].EXCESSLAND,
			description:data[0].DESCRIPTION,
		});

		$.ajax({
		    dataType: "json",
	        type: "post",
	        url: "./controller/master_cluster/master_cluster_select_project.php",
	        data:{
	            id: data[0].PROJECTID
	        }
		}).then(function (data) {
			dataInit = {
				id: data.PROJECTID,
				text: data.PROJECTNAME,
			}
		    $("#project").select2("trigger", "select", {
			    data: dataInit
			});
		});

		$("#kavblok").val(data[0].KAVBLOK);
		$("#kavno").val(data[0].KAVNO);
		$("#typelb").val(data[0].TYPELB);
		$("#typelt").val(data[0].TYPELT);
		$("#landexcess").val(data[0].EXCESSLAND);
		$("#description").val(data[0].DESCRIPTION);
	})
}

cl.deleteCluster = function(id) {
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
                url: './controller/master_cluster/master_cluster_controller_remove.php',
                data: { id: id }
            }).done(function(data){
                $("#DataTableCluster").DataTable().ajax.reload();
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
            $("#DataTableCluster").DataTable().ajax.reload();
            swal("Canceled", "Your data failed to delete", "error");
        }
    });
}

cl.saveCluster = function(dt){
	console.log("Save Cluster=====>")
	var validate = $('#forminput').parsley().validate()
	if(validate){
		this.cl.loader(true);
		var dataFormValue = {
			projectid: $("#project").select2('data')[0].id,
			projectname: $("#project").select2('data')[0].text,
			kavblok: $("#kavblok").val(),
			kavno: $("#kavno").val(),
			typelb: $("#typelb").val(),
			typelt: $("#typelt").val(),
			landexcess: $("#landexcess").val(),
			description: $("#description").val(),
		}
		// console.log(dataFormValue)
		$.ajax({
			dataType: "json",
			type: "post",
			url: "./controller/master_cluster/master_cluster_controller_add.php",
			data: dataFormValue
		}).done(function(data){
			cl.resetForm();
			cl.form(false);
			cl.buttonVisible(true);
			cl.buttonUnVisible(false);
			setTimeout(function(){
				cl.loader(false);
				cl.table(true);
				$("#DataTableCluster").DataTable().ajax.reload();
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
	
	// this.cl.table(false);
	// this.cl.form(false);
}

cl.saveUpdateCluster = function(){
	var compareDataOriginal = cl.getDataEdit();
	var compareDataFormEdit = {
		projectid: $("#project").select2('data')[0].id,
		projectname: $("#project").select2('data')[0].text,
		kavblok: $("#kavblok").val(),
		kavno: $("#kavno").val(),
		typelb: $("#typelb").val(),
		typelt: $("#typelt").val(),
		excessland: $("#landexcess").val(),
		description: $("#description").val(),
	}
	var validate = $('#forminput').parsley().validate();
	if(validate){
		if(!compare(compareDataOriginal, compareDataFormEdit)){
			console.log("Masukin data edit terbaru", compareDataFormEdit);
			this.cl.loader(true);
			$.ajax({
				dataType: "json",
				type: "post",
				url: "./controller/master_cluster/master_cluster_controller_edit.php",
				data: {...compareDataFormEdit, id: cl.getDataIdEdit}
			}).done(function(data){
				cl.resetForm();
				cl.form(false);
				cl.buttonVisible(true);
				cl.buttonUnVisible(false);
				setTimeout(function(){
					cl.loader(false);
					cl.table(true);
					$("#DataTableCluster").DataTable().ajax.reload();
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

cl.cancelCluster = function(dt){
	cl.resetForm();
	cl.buttonVisible(true);
	cl.buttonUnVisible(false);
	cl.table(true);
	cl.form(false);
	cl.loader(false);
}

cl.ajaxGetDataCluster = function() {
	$('#DataTableCluster').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "./controller/master_cluster/master_cluster_controller.php",
        "columnDefs": [{
        	"orderable": false,
		    "targets": 9,
		    "data": function (datas) {
		    	return '<div class="btn-group"><a href="#" style="margin-right:15px" onclick=cl.editCluster('+JSON.stringify(datas[0])+');><i class="fa fa-pencil"></i></a><a href="#" style="color:red" onclick=cl.deleteCluster('+JSON.stringify(datas[0])+');><i class="fa fa-trash"></i></a></div>'
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
	cl.prepare();
	cl.ajaxGetDataCluster();
	ko.applyBindings()
});