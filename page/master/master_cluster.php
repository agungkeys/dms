<div class="az-content-body">
  	<div class="row row-sm row-md">
  		<div class="col-sm-6 col-xl-6 col-md-6">
  			<div class="az-content-breadcrumb">
				<span><?php echo $arrLang[$defaultLanguage]['master']; ?></span>
				<span><?php echo $arrLang[$defaultLanguage]['housing_cluster']; ?></span>
			</div>
			<h2 class="az-content-title"><?php echo $arrLang[$defaultLanguage]['housing_cluster']; ?></h2>
		</div>
		<div class="col-sm-6 col-xl-6 col-md-6">
			<div style="text-align: right; float: right; display: flex;">
				<button data-bind="visible: cl.buttonVisible, click: cl.addCluster" id="add" class="btn btn-primary"><i class="fa fa-plus"></i> <?php echo $arrLang[$defaultLanguage]['add_cluster']; ?></button>&nbsp;
				<button data-bind="visible: cl.buttonUnVisible, click: cl.titleNew() ? cl.saveCluster : cl.saveUpdateCluster" id="save" class="btn btn-success"><i class="fa fa-floppy-o"></i> 
					<span data-bind="visible: cl.titleNew"><?php echo $arrLang[$defaultLanguage]['save']; ?></span>
					<span data-bind="visible: cl.titleEdit"><?php echo $arrLang[$defaultLanguage]['update']; ?></span>
				</button>&nbsp;
				<button data-bind="visible: cl.buttonUnVisible, click: cl.cancelCluster" id="cancel" class="btn btn-danger"><i class="fa fa-times"></i> <?php echo $arrLang[$defaultLanguage]['cancel']; ?></button>
			</div>
		</div>
	</div>
	<div class="row row-sm">
		<div data-bind="visible: cl.loader" class="col-sm-12 col-xl-12">
			<div class="text-center">
				<img style="width: 10em" src="spinner.svg"/>
				<div class="blink-loader" style="margin-top: -1.5em; color: #6610f2"><b><i>Still Loading...</i></b></div>
			</div>
		</div>
		<div data-bind="visible: cl.form" class="col-sm-12 col-xl-8">
			<div class="card card-body pd-30 pd-sm-40">
				<h5 class="card-title mg-b-20">
					<span data-bind="visible: cl.titleNew">
						<?php echo $arrLang[$defaultLanguage]['input_new_data_cluster']; ?>
					</span>
					<span data-bind="visible: cl.titleEdit">
						<?php echo $arrLang[$defaultLanguage]['input_edit_data_cluster']; ?>
					</span>	
				</h5>
				<form id="forminput">
					<div class="row">
						<div class="col-xl-6">
							<div class="form-group">
								<div id="slWrapper" class="parsley-select">
									<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['project_name']; ?></label>
									<select id="project" class="form-control select2-no-search" data-parsley-class-handler="#slWrapper" data-parsley-errors-container="#slErrorContainer2"  data-parsley-required-message="Project required!" required>
					              	</select>
					              	<div id="slErrorContainer2"></div>
								</div>
							</div>
						</div>
						<div class="col-xl-3">
							<div class="form-group">
								<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['kavblok']; ?></label>
								<input id="kavblok" type="text" class="form-control" placeholder="Enter your Kav. Blok" data-parsley-required-message="Kav. Blok required!" required onkeyup="formatUppersize(this)">
							</div>
						</div>
						<div class="col-xl-3">
							<div class="form-group">
								<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['kavno']; ?></label>
								<input id="kavno" type="number" class="form-control" placeholder="Enter your Kav. Blok" data-parsley-required-message="Kav. No required!" required onkeyup="formatUppersize(this)">
							</div>
						</div>
						<div class="col-xl-3">
							<div class="form-group">
								<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['typelb']; ?></label>
								<input id="typelb" type="number" class="form-control" placeholder="Enter your Type LB." data-parsley-required-message="Type LB. required!" required onkeyup="formatUppersize(this)">
							</div>
						</div>
						<div class="col-xl-3">
							<div class="form-group">
								<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['typelt']; ?></label>
								<input id="typelt" type="number" class="form-control" placeholder="Enter your Type LT." data-parsley-required-message="Type LT. required!" required onkeyup="formatUppersize(this)">
							</div>
						</div>
						<div class="col-xl-6">
							<div class="form-group">
								<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['land_excess']; ?></label>
								<input id="landexcess" type="number" class="form-control" placeholder="Enter your Land Excess" data-parsley-required-message="Land Excess required!" required onkeyup="formatUppersize(this)">
							</div>
						</div>
						
						<div class="col-xl-12">
							<div class="form-group">
								<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['description']; ?></label>
								<textarea id="description" rows="2" class="form-control" placeholder="Enter your description"></textarea>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div data-bind="visible: cl.table" class="col-sm-12 col-xl-12">
			<table id="DataTableCluster" class="display responsive nowrap">
		        <thead style="background-color: #bec1c5;">
		          <tr>
		            <th class="wd-5p"><?php echo $arrLang[$defaultLanguage]['id']; ?></th>
		            <th class="wd-20p"><?php echo $arrLang[$defaultLanguage]['project_name']; ?></th>
		            <th class="wd-5p"><?php echo $arrLang[$defaultLanguage]['kavblok']; ?></th>
		            <th class="wd-5p"><?php echo $arrLang[$defaultLanguage]['kavno']; ?></th>
		            <th class="wd-10p"><?php echo $arrLang[$defaultLanguage]['typelb']; ?></th>
		            <th class="wd-10p"><?php echo $arrLang[$defaultLanguage]['typelt']; ?></th>
		            <th class="wd-5p"><?php echo $arrLang[$defaultLanguage]['land_excess']; ?></th>
		            <th class="wd-10p"><?php echo $arrLang[$defaultLanguage]['status']; ?></th>
		            <th class="wd-15p"><?php echo $arrLang[$defaultLanguage]['date_create']; ?>&nbsp;<sup style="font-weight: normal">mm-dd-yyyy</sup></th>
		            <th class="wd-10p"><?php echo $arrLang[$defaultLanguage]['action']; ?></th>
		          </tr>
		        </thead>
			</table>
		</div>
	</div>
</div>
<script src="dist/js/master_cluster.js" type="text/javascript"></script>