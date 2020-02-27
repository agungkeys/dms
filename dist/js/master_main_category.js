var mmc = {
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

mmc.prepare = function(){
	// $('.select2-no-search').select2({
	// 	minimumResultsForSearch: Infinity,
	// 	placeholder: 'Choose one'
	// });
	$('#colorpicker').spectrum({
		color: '#17A2B8'
	});
	mmc.selectGroup();
	$('#forminput').parsley();
	$("#groups").select2("val", "0");
}

function compare(a, b) {
  return JSON.stringify(a) === JSON.stringify(b);
}

mmc.selectGroup = function(){

    var datasource =[
        {
            "id": 1,
            "text": "Revenue",
            "color": "#a9d86e",
            "groups": "Revenue"
        },
        {
            "id": 2,
            "text": "Cost",
            "color": "#ff6c60",
            "groups": "Cost"
        }
    ];

    function formatState(state){
        if (!state.id) {
            return state.text;
        }
        // var baseUrl = "/user/pages/images/flags";
        // var color = "green";
        var icon = state.groups === 'Revenue' ? "<i class='fa fa-arrow-circle-down text-success'></i>" : "<i class='fa fa-arrow-circle-up text-danger'></i>";
        // console.log("dropdown", state);
        var $state = $(
            '<span>'+icon+'&nbsp'+ state.text +'</span>'
        );
        return $state;
    }

    function formatStateSelection(data){
        if (data.id === '') { // adjust for custom placeholder values
            return 'Pilih Data  Group...';
        }else{
            var icon = data.groups === 'Revenue' ? "<i class='fa fa-arrow-circle-down text-success'></i>" : "<i class='fa fa-arrow-circle-up text-danger'></i>";
            // console.log("dropdown", state);
            var datas = $(
                '<span>'+icon+'&nbsp;'+ data.text +'</span>'
            );
            return datas;
        }
    }

    $('#groups').select2({
        minimumResultsForSearch: -1,
        placeholder: 'Select Group...',
        data: datasource,
        templateResult: formatState,
        templateSelection: formatStateSelection
    });
}

mmc.resetForm = function(){
	document.getElementById("forminput").reset();
	$('#forminput').parsley().reset();
	$("#groups").select2("val", "0");
}

mmc.addMainCategory = function(){
	console.log("Add Main Category=====>")
	mmc.buttonVisible(false);
	mmc.buttonUnVisible(true);
	mmc.table(false);
	mmc.form(true);
	mmc.titleNew(true);
	mmc.titleEdit(false);
}

mmc.editMainCategory = function(dt) {
	console.log("Edit Main Category=====>", dt);
	mmc.buttonVisible(false);
	mmc.buttonUnVisible(true);
	mmc.table(false);
	mmc.form(true);
	mmc.titleNew(false);
	mmc.titleEdit(true);
	mmc.getDataIdEdit(dt);

	$.ajax({
		dataType: 'json',
		type: 'post',
		url: './controller/master_main_category/master_main_category_controller_find.php',
		data: {id:dt}
	}).done(function(data){
		console.log("Get data edited", data)
		mmc.getDataEdit({
			group: data.GROUPS,
			color: data.COLOR,
			maincategoryname: data.MAINCATEGORYNAME,
			maincategoryinfo: data.DESCRIPTION
		});
		if(data.GROUPS != "Cost"){
        $('#groups').val('1').trigger('change.select2');
	        console.log("Revenue")
	    }else{
	        $('#groups').val('2').trigger('change.select2');
	        console.log("Cost")
	    }
		$("#colorpicker").spectrum("set", data.COLOR);
		$("#maincategoryname").val(data.MAINCATEGORYNAME);
		$("#maincategoryinformation").val(data.DESCRIPTION);	
	});
}

mmc.deleteMainCategory = function(id) {
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
                url: './controller/master_main_category/master_main_category_controller_remove.php',
                data: { id: id }
            }).done(function(data){
                $("#DataTableMainCategory").DataTable().ajax.reload();
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
            $("#DataTableMainCategory").DataTable().ajax.reload();
            swal("Canceled", "Your data failed to delete", "error");
        }
    });
}

mmc.saveMainCategory = function(dt){
	console.log("Save Account=====>")
	var validate = $('#forminput').parsley().validate()
	if(validate){
		this.mmc.loader(true);
		var dataFormValue = {
			group: $("#groups").select2('data')[0].groups,
			color: $("#colorpicker").spectrum("get").toHexString(),
			maincategoryname: $("#maincategoryname").val(),
			maincategoryinfo: $("#maincategoryinformation").val()
		}
		$.ajax({
			dataType: "json",
			type: "post",
			url: "./controller/master_main_category/master_main_category_controller_add.php",
			data: dataFormValue
		}).done(function(data){
			mmc.resetForm();
			mmc.form(false);
			mmc.buttonVisible(true);
			mmc.buttonUnVisible(false);
			setTimeout(function(){
				mmc.loader(false);
				mmc.table(true);
				$("#DataTableMainCategory").DataTable().ajax.reload();
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
	
	// this.mmc.table(false);
	// this.mmc.form(false);
}

mmc.saveUpdateMainCategory = function(){
	var compareDataOriginal = mmc.getDataEdit();
	var compareDataFormEdit = {
		group: $("#groups").select2('data')[0].groups,
		color: $("#colorpicker").spectrum("get").toHexString(),
		maincategoryname: $("#maincategoryname").val(),
		maincategoryinfo: $("#maincategoryinformation").val()
	}
	var validate = $('#forminput').parsley().validate();
	if(validate){
		if(!compare(compareDataOriginal, compareDataFormEdit)){
			console.log("Masukin data edit terbaru", compareDataFormEdit);
			this.mmc.loader(true);
			$.ajax({
				dataType: "json",
				type: "post",
				url: "./controller/master_main_category/master_main_category_controller_edit.php",
				data: { ...compareDataFormEdit, id: mmc.getDataIdEdit }
			}).done(function(data){
				mmc.resetForm();
				mmc.form(false);
				mmc.buttonVisible(true);
				mmc.buttonUnVisible(false);
				setTimeout(function(){
					mmc.loader(false);
					mmc.table(true);
					$("#DataTableMainCategory").DataTable().ajax.reload();
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

mmc.cancelMainCategory = function(dt){
	mmc.resetForm();
	mmc.buttonVisible(true);
	mmc.buttonUnVisible(false);
	mmc.table(true);
	mmc.form(false);
	mmc.loader(false);
}

mmc.ajaxGetDataMainCategory = function() {
	$('#DataTableMainCategory').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "./controller/master_main_category/master_main_category_controller.php",
        "columnDefs": [
        {
		    "targets": 4,
		    "data": function (datas) {
		    	return '<div style="color:'+datas[4]+'"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;'+datas[4]+'</div>'
		    }
		},{
			"orderable": false,
		    "targets": 6,
		    "data": function (datas) {
		    	return '<div class="btn-group"><a href="#"  style="margin-right:15px" onclick=mmc.editMainCategory('+JSON.stringify(datas[0])+');><i class="fa fa-pencil"></i></a><a href="#" style="color:red" onclick=mmc.deleteMainCategory('+JSON.stringify(datas[0])+');><i class="fa fa-trash"></i></a></div>'
		    }
		}]
    });
    $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });
}

$(document).ready(function(){
	mmc.prepare();
	mmc.ajaxGetDataMainCategory();
	ko.applyBindings()
});