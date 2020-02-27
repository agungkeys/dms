<div class="az-content-body">
  	<div class="row row-sm row-md">
  		<div class="col-sm-6 col-xl-6 col-md-6">
  			<div class="az-content-breadcrumb">
				<span><?php echo $arrLang[$defaultLanguage]['master']; ?></span>
				<span><?php echo $arrLang[$defaultLanguage]['master_project']; ?></span>
			</div>
			<h2 class="az-content-title"><?php echo $arrLang[$defaultLanguage]['master_project']; ?></h2>
		</div>
		<div class="col-sm-6 col-xl-6 col-md-6">
			<div style="text-align: right; float: right; display: flex;">
				<button data-bind="visible: pj.buttonVisible, click: pj.addProject" id="add" class="btn btn-primary"><i class="fa fa-plus"></i> <?php echo $arrLang[$defaultLanguage]['add_project']; ?></button>&nbsp;
				<button data-bind="visible: pj.buttonUnVisible, click: pj.titleNew() ? pj.saveProject : pj.saveUpdateProject" id="save" class="btn btn-success"><i class="fa fa-floppy-o"></i> 
					<span data-bind="visible: pj.titleNew"><?php echo $arrLang[$defaultLanguage]['save']; ?></span>
					<span data-bind="visible: pj.titleEdit"><?php echo $arrLang[$defaultLanguage]['update']; ?></span>
				</button>&nbsp;
				<button data-bind="visible: pj.buttonUnVisible, click: pj.cancelProject" id="cancel" class="btn btn-danger"><i class="fa fa-times"></i> <?php echo $arrLang[$defaultLanguage]['cancel']; ?></button>
			</div>
		</div>
	</div>
	<div class="row row-sm">
		<div data-bind="visible: pj.loader" class="col-sm-12 col-xl-12">
			<div class="text-center">
				<img style="width: 10em" src="spinner.svg"/>
				<div class="blink-loader" style="margin-top: -1.5em; color: #6610f2"><b><i>Still Loading...</i></b></div>
			</div>
		</div>
		<div data-bind="visible: pj.form" class="col-sm-12 col-xl-6">
			<div class="card card-body pd-30 pd-sm-40">
				<h5 class="card-title mg-b-20">
					<span data-bind="visible: pj.titleNew">
						<?php echo $arrLang[$defaultLanguage]['input_new_data_project']; ?>
					</span>
					<span data-bind="visible: pj.titleEdit">
						<?php echo $arrLang[$defaultLanguage]['input_edit_data_project']; ?>
					</span>	
				</h5>
				<form id="forminput">
					<div class="row">
						<div class="col-xl-12">
							<div class="form-group">
								<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['project_name']; ?></label>
								<input id="projectname" type="text" class="form-control" placeholder="Enter your project" data-parsley-required-message="Project required!" required>
							</div>
						</div>
						<div class="col-xl-12">
							<div class="form-group">
								<div id="slWrapper" class="parsley-select">
									<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['project']; ?></label>
									<select id="project" class="form-control select2-no-search" data-parsley-class-handler="#slWrapper" data-parsley-errors-container="#slErrorContainer2"  data-parsley-required-message="Project required!" required>
						                <option label="Choose one"></option>
						                <option value="Cluster">Cluster</option>
						                <option value="Project">Project</option>
					              	</select>
					              	<div id="slErrorContainer2"></div>
								</div>
							</div>
						</div>
						<div class="col-xl-12">
							<div class="form-group">
								<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['project_description']; ?></label>
								<textarea id="projectdescription" rows='3' class="form-control" placeholder="Enter your project description" data-parsley-required-message="Project description required!" required></textarea>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div data-bind="visible: pj.table" class="col-sm-12 col-xl-12">
			<table id="DataTableProject" class="display responsive nowrap">
		        <thead style="background-color: #bec1c5;">
		          <tr>
		            <th class="wd-15p"><?php echo $arrLang[$defaultLanguage]['id']; ?></th>
		            <th class="wd-15p"><?php echo $arrLang[$defaultLanguage]['project_name']; ?></th>
		            <th class="wd-20p"><?php echo $arrLang[$defaultLanguage]['project_description']; ?></th>
		            <th class="wd-25p"><?php echo $arrLang[$defaultLanguage]['date_create']; ?>&nbsp;<sup style="font-weight: normal">mm-dd-yyyy</sup></th>
		            <th class="wd-25p"><?php echo $arrLang[$defaultLanguage]['action']; ?></th>
		          </tr>
		        </thead>
			</table>
		</div>
	</div>
</div>
<script src="dist/js/master_project.js" type="text/javascript"></script>