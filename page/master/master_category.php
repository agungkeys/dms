<div class="az-content-body">
  	<div class="row row-sm">
  		<div class="col-sm-6 col-xl-6 col-md-6">
  			<div class="az-content-breadcrumb">
				<span><?php echo $arrLang[$defaultLanguage]['master']; ?></span>
				<span><?php echo $arrLang[$defaultLanguage]['master_category']; ?></span>
			</div>
			<h2 class="az-content-title"><?php echo $arrLang[$defaultLanguage]['master_category']; ?></h2>
      		<!-- <div class="card card-dashboard-twentytwo">
				<h1>Master User</h1>
			</div> -->
		</div>
		<div class="col-sm-6 col-xl-6 col-md-6">
			<div style="text-align: right; float: right; display: flex;">
				<button data-bind="visible: mc.buttonVisible, click: mc.addCategory" id="add" class="btn btn-primary"><i class="fa fa-plus"></i> <?php echo $arrLang[$defaultLanguage]['add_category']; ?></button>&nbsp;
				<button data-bind="visible: mc.buttonUnVisible, click: mc.titleNew() ? mc.saveCategory : mc.saveUpdateCategory" id="save" class="btn btn-success"><i class="fa fa-floppy-o"></i> 
					<span data-bind="visible: mc.titleNew"><?php echo $arrLang[$defaultLanguage]['save']; ?></span>
					<span data-bind="visible: mc.titleEdit"><?php echo $arrLang[$defaultLanguage]['update']; ?></span>
				</button>&nbsp;
				<button data-bind="visible: mc.buttonUnVisible, click: mc.cancelCategory" id="cancel" class="btn btn-danger"><i class="fa fa-times"></i> <?php echo $arrLang[$defaultLanguage]['cancel']; ?></button>
			</div>
		</div>
	</div>
	<div class="row row-sm">
		<div data-bind="visible: mc.loader" class="col-sm-12 col-xl-12">
			<div class="text-center">
				<img style="width: 10em" src="spinner.svg"/>
				<div class="blink-loader" style="margin-top: -1.5em; color: #6610f2"><b><i>Still Loading...</i></b></div>
			</div>
		</div>
		<div data-bind="visible: mc.form" class="col-sm-12 col-xl-6">
			<div class="card card-body pd-30 pd-sm-40">
				<h5 class="card-title mg-b-20">
					<span data-bind="visible: mc.titleNew">
						<?php echo $arrLang[$defaultLanguage]['input_new_data_category']; ?>
					</span>
					<span data-bind="visible: mc.titleEdit">
						<?php echo $arrLang[$defaultLanguage]['input_edit_data_category']; ?>
					</span>	
				</h5>
				<form id="forminput">
					<div class="row">
						<div class="col-xl-12">
							<div class="form-group">
								<div id="slWrapper" class="parsley-select">
									<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['main_category_name']; ?></label>
									<select id="maincategory" class="form-control select2-no-search" data-parsley-class-handler="#slWrapper" data-parsley-errors-container="#slErrorContainer2"  data-parsley-required-message="Main Category required!" required>
						                
					              	</select>
					              	<div id="slErrorContainer2"></div>
								</div>
							</div>
						</div>
						<div class="col-xl-12">
							<div class="form-group">
								<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['category_name']; ?></label>
								<input id="categoryname" type="text" class="form-control" placeholder="Enter your category name" data-parsley-required-message="Category name required!" required>
							</div>
						</div>
						<div class="col-xl-12">
							<div class="form-group">
								<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['category_information']; ?></label>
								<input id="categoryinformation" type="text" class="form-control" placeholder="Enter your category information" data-parsley-required-message="Main category information required!" required>
							</div>
						</div>
					</div>	
				</form>
			</div>
		</div>
		<div data-bind="visible: mc.table" class="col-sm-12 col-xl-12">
			<table id="DataTableCategory" class="display responsive nowrap">
		        <thead style="background-color: #bec1c5;">
		          <tr>
		            <th class="wd-15p"><?php echo $arrLang[$defaultLanguage]['id']; ?></th>
		            <th class="wd-25p"><?php echo $arrLang[$defaultLanguage]['group']; ?></th>
		            <th class="wd-15p"><?php echo $arrLang[$defaultLanguage]['main_category_name']; ?></th>
		            <th class="wd-15p"><?php echo $arrLang[$defaultLanguage]['category_name']; ?></th>
		            <th class="wd-15p"><?php echo $arrLang[$defaultLanguage]['category_information']; ?></th>
		            <th class="wd-25p"><?php echo $arrLang[$defaultLanguage]['date_create']; ?>&nbsp;<sup style="font-weight: normal">mm-dd-yyyy</sup></th>
		            <th class="wd-25p"><?php echo $arrLang[$defaultLanguage]['action']; ?></th>
		          </tr>
		        </thead>
			</table>
		</div>
	</div>
</div>
<script src="dist/js/master_category.js" type="text/javascript"></script>