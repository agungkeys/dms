<div class="az-content-body">
  	<div class="row row-sm row-md">
  		<div class="col-sm-6 col-xl-6 col-md-6">
  			<div class="az-content-breadcrumb">
				<span><?php echo $arrLang[$defaultLanguage]['master']; ?></span>
				<span><?php echo $arrLang[$defaultLanguage]['master_user']; ?></span>
			</div>
			<h2 class="az-content-title"><?php echo $arrLang[$defaultLanguage]['master_user']; ?></h2>
		</div>
		<div class="col-sm-6 col-xl-6 col-md-6">
			<div style="text-align: right; float: right; display: flex;">
				<button data-bind="visible: us.buttonVisible, click: us.addUser" id="add" class="btn btn-primary"><i class="fa fa-plus"></i> <?php echo $arrLang[$defaultLanguage]['add_user']; ?></button>&nbsp;
				<button data-bind="visible: us.buttonUnVisible, click: us.titleNew() ? us.saveUser : us.saveUpdateUser" id="save" class="btn btn-success"><i class="fa fa-floppy-o"></i> 
					<span data-bind="visible: us.titleNew"><?php echo $arrLang[$defaultLanguage]['save']; ?></span>
					<span data-bind="visible: us.titleEdit"><?php echo $arrLang[$defaultLanguage]['update']; ?></span>
				</button>&nbsp;
				<button data-bind="visible: us.buttonUnVisible, click: us.cancelUser" id="cancel" class="btn btn-danger"><i class="fa fa-times"></i> <?php echo $arrLang[$defaultLanguage]['cancel']; ?></button>
			</div>
		</div>
	</div>
	<div class="row row-sm">
		<div data-bind="visible: us.loader" class="col-sm-12 col-xl-12">
			<div class="text-center">
				<img style="width: 10em" src="spinner.svg"/>
				<div class="blink-loader" style="margin-top: -1.5em; color: #6610f2"><b><i>Still Loading...</i></b></div>
			</div>
		</div>
		<div data-bind="visible: us.form" class="col-sm-12 col-xl-8">
			<div class="card card-body pd-30 pd-sm-40">
				<h5 class="card-title mg-b-20">
					<span data-bind="visible: us.titleNew">
						<?php echo $arrLang[$defaultLanguage]['input_new_data_user']; ?>
					</span>
					<span data-bind="visible: us.titleEdit">
						<?php echo $arrLang[$defaultLanguage]['input_edit_data_user']; ?>
					</span>	
				</h5>
				<form id="forminput">
					<div class="row">
						<div class="col-xl-6">
							<div class="form-group">
								<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['username']; ?></label>
								<input id="username" type="text" class="form-control" placeholder="Enter your username" data-parsley-required-message="Username required!" required>
							</div>
						</div>
						<div class="col-xl-6">
							<div class="form-group">
								<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['full_name']; ?></label>
								<input id="fullname" type="text" class="form-control" placeholder="Enter your fullname" data-parsley-required-message="Fullname required!" required>
							</div>
						</div>
						<div class="col-xl-6">
							<div class="form-group">
								<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['password']; ?></label>
								<input id="password" type="password" class="form-control" placeholder="Enter your password" required>
							</div>
						</div>
						<div class="col-xl-6">
							<div class="form-group">
								<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['re-password']; ?></label>
								<input id="re-password" type="password" class="form-control" placeholder="Enter your re-password" data-parsley-equalto="#password" required>
							</div>
						</div>
						<div class="col-xl-6">
							<div class="form-group">
								<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['user_email']; ?></label>
								<input id="email" type="email" class="form-control" placeholder="Enter your email" data-parsley-required-message="Email required!" required>
							</div>
						</div>
						<div class="col-xl-6">
							<div class="form-group">
								<div id="slWrapper" class="parsley-select">
									<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['level']; ?></label>
									<select id="level" class="form-control select2-no-search" data-parsley-class-handler="#slWrapper" data-parsley-errors-container="#slErrorContainer2"  data-parsley-required-message="Level required!" required>
						                <option label="Choose one"></option>
						                <option value="Super Admin">Super Admin</option>
						                <option value="Admin">Admin</option>
						                <option value="Staff">Staff</option>
						                <option value="Owner">Owner</option>
						                <option value="Member">Member</option>
					              	</select>
					              	<div id="slErrorContainer2"></div>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div data-bind="visible: us.table" class="col-sm-12 col-xl-12">
			<table id="DataTableUser" class="display responsive nowrap">
		        <thead style="background-color: #bec1c5;">
		          <tr>
		            <th class="wd-15p"><?php echo $arrLang[$defaultLanguage]['id']; ?></th>
		            <th class="wd-15p"><?php echo $arrLang[$defaultLanguage]['username']; ?></th>
		            <th class="wd-20p"><?php echo $arrLang[$defaultLanguage]['full_name']; ?></th>
		            <th class="wd-15p"><?php echo $arrLang[$defaultLanguage]['user_email']; ?></th>
		            <th class="wd-10p"><?php echo $arrLang[$defaultLanguage]['level']; ?></th>
		            <th class="wd-25p"><?php echo $arrLang[$defaultLanguage]['date_create']; ?>&nbsp;<sup style="font-weight: normal">mm-dd-yyyy</sup></th>
		            <th class="wd-25p"><?php echo $arrLang[$defaultLanguage]['action']; ?></th>
		          </tr>
		        </thead>
			</table>
		</div>
	</div>
</div>
<script src="dist/js/master_user.js" type="text/javascript"></script>