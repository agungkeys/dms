var mc = {
	dataSelectMainCategory: ko.observableArray(),
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

mc.prepare = function(){
	// $('.select2-no-search').select2({
	// 	minimumResultsForSearch: Infinity,
	// 	placeholder: 'Choose one'
	// });
	$('#colorpicker').spectrum({
		color: '#17A2B8'
	});
	mc.selectMainCategory();
	$('#forminput').parsley();
	$("#maincategory").select2("val", "0");
}

function compare(a, b) {
  return JSON.stringify(a) === JSON.stringify(b);
}

mc.selectMainCategory = function(){
    function formatState(state){
        if (!state.id) {
            return state.text;
        }
        // console.log(state);
        var icon = state.groups === 'Revenue' ? "<i class='fa fa-arrow-circle-down text-success'></i>" : "<i class='fa fa-arrow-circle-up text-danger'></i>";
        var $state = $(
            '<span>'+icon+'&nbsp;'+state.groups+'&nbsp;<i class="fa fa-circle" style="color:'+state.color+'"></i> ' + state.text +'&nbsp;</span>'
        );
        return $state;

    }

    function formatStateSelection(data){
        if (data.id === '') {
            return 'Select Data Main Category...';
        }else{
            var icon = data.groups === 'Revenue' ? "<i class='fa fa-arrow-circle-down text-success'></i>" : "<i class='fa fa-arrow-circle-up text-danger'></i>";
            var datas = $(
                '<span>'+icon+'&nbsp;'+data.groups+'&nbsp;<i class="fa fa-circle" style="color:'+data.color+'"></i> ' + data.text +'&nbsp;</span>'
            );
            return datas;
        }
    }

    $('#maincategory').select2({
        placeholder: 'Select Group...',
        templateResult: formatState,
        templateSelection: formatStateSelection,
        ajax: {
            url: './controller/master_category/master_category_select_main_category.php',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: false
        }
    });
}

mc.resetForm = function(){
	document.getElementById("forminput").reset();
	$('#forminput').parsley().reset();
	$("#maincategory").select2("val", "0");
}

mc.addCategory = function(){
	console.log("Add Category=====>")
	mc.buttonVisible(false);
	mc.buttonUnVisible(true);
	mc.table(false);
	mc.form(true);
	mc.titleNew(true);
	mc.titleEdit(false);
}

mc.editCategory = function(dt) {
	console.log("Edit Category=====>", dt);
	mc.buttonVisible(false);
	mc.buttonUnVisible(true);
	mc.table(false);
	mc.form(true);
	mc.titleNew(false);
	mc.titleEdit(true);
	mc.getDataIdEdit(dt);

	$.ajax({
		dataType: 'json',
		type: 'post',
		url: './controller/master_category/master_category_controller_find.php',
		data: {id:dt}
	}).done(function(data){
		// console.log("Get data edited", data)
		mc.getDataEdit({
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

mc.deleteCategory = function(id) {
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
                url: './controller/master_category/master_category_controller_remove.php',
                data: { id: id }
            }).done(function(data){
                $("#DataTableCategory").DataTable().ajax.reload();
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
            $("#DataTableCategory").DataTable().ajax.reload();
            swal("Canceled", "Your data failed to delete", "error");
        }
    });
}

mc.saveCategory = function(dt){
	console.log("Save Category=====>")
	var validate = $('#forminput').parsley().validate()
	if(validate){
		this.mc.loader(true);
		var dataFormValue = {
			maincategoryid: $("#maincategory").select2('data')[0].id,
			categoryname: $("#categoryname").val(),
			categoryinfo: $("#categoryinformation").val()
		}
		$.ajax({
			dataType: "json",
			type: "post",
			url: "./controller/master_category/master_category_controller_add.php",
			data: dataFormValue
		}).done(function(data){
			mc.resetForm();
			mc.form(false);
			mc.buttonVisible(true);
			mc.buttonUnVisible(false);
			setTimeout(function(){
				mc.loader(false);
				mc.table(true);
				$("#DataTableCategory").DataTable().ajax.reload();
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
	
	// this.mc.table(false);
	// this.mc.form(false);
}

mc.saveUpdateCategory = function(){
	var compareDataOriginal = mc.getDataEdit();
	var compareDataFormEdit = {
		maincategoryid: $("#maincategory").select2('data')[0].id,
		categoryname: $("#categoryname").val(),
		categoryinfo: $("#categoryinformation").val()
	}
	var validate = $('#forminput').parsley().validate();
	if(validate){
		if(!compare(compareDataOriginal, compareDataFormEdit)){
			console.log("Masukin data edit terbaru", compareDataFormEdit);
			this.mc.loader(true);
			$.ajax({
				dataType: "json",
				type: "post",
				url: "./controller/master_category/master_category_controller_edit.php",
				data: { ...compareDataFormEdit, id: mc.getDataIdEdit }
			}).done(function(data){
				mc.resetForm();
				mc.form(false);
				mc.buttonVisible(true);
				mc.buttonUnVisible(false);
				setTimeout(function(){
					mc.loader(false);
					mc.table(true);
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

mc.cancelCategory = function(dt){
	mc.resetForm();
	mc.buttonVisible(true);
	mc.buttonUnVisible(false);
	mc.table(true);
	mc.form(false);
	mc.loader(false);
}

mc.ajaxGetDataCategory = function() {
	$('#DataTableCategory').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "./controller/master_category/master_category_controller.php",
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
			"orderable": false,
		    "targets": 6,
		    "data": function (datas) {
		    	return '<div class="btn-group"><a href="#"  style="margin-right:15px" onclick=mc.editCategory('+JSON.stringify(datas[0])+');><i class="fa fa-pencil"></i></a><a href="#" style="color:red" onclick=mc.deleteCategory('+JSON.stringify(datas[0])+');><i class="fa fa-trash"></i></a></div>'
		    }
		}]
    });
    $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });
}

$(document).ready(function(){
	mc.prepare();
	mc.ajaxGetDataCategory();
	ko.applyBindings()
});