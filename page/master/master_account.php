<div class="az-content-body">
  	<div class="row row-sm">
  		<div class="col-sm-6 col-xl-6 col-md-6">
  			<div class="az-content-breadcrumb">
				<span><?php echo $arrLang[$defaultLanguage]['master']; ?></span>
				<span><?php echo $arrLang[$defaultLanguage]['master_account']; ?></span>
			</div>
			<h2 class="az-content-title"><?php echo $arrLang[$defaultLanguage]['master_account']; ?></h2>
      		<!-- <div class="card card-dashboard-twentytwo">
				<h1>Master User</h1>
			</div> -->
		</div>
		<div class="col-sm-6 col-xl-6 col-md-6">
			<div style="text-align: right; float: right; display: flex;">
				<button data-bind="visible: ac.buttonVisible, click: ac.addAccount" id="add" class="btn btn-primary"><i class="fa fa-plus"></i> <?php echo $arrLang[$defaultLanguage]['add_account']; ?></button>&nbsp;
				<button data-bind="visible: ac.buttonUnVisible, click: ac.titleNew() ? ac.saveAccount : ac.saveUpdateAccount" id="save" class="btn btn-success"><i class="fa fa-floppy-o"></i> 
					<span data-bind="visible: ac.titleNew"><?php echo $arrLang[$defaultLanguage]['save']; ?></span>
					<span data-bind="visible: ac.titleEdit"><?php echo $arrLang[$defaultLanguage]['update']; ?></span>
				</button>&nbsp;
				<button data-bind="visible: ac.buttonUnVisible, click: ac.cancelAccount" id="cancel" class="btn btn-danger"><i class="fa fa-times"></i> <?php echo $arrLang[$defaultLanguage]['cancel']; ?></button>
			</div>
		</div>
	</div>
	<div class="row row-sm">
		<div data-bind="visible: ac.loader" class="col-sm-12 col-xl-12">
			<div class="text-center">
				<img style="width: 10em" src="spinner.svg"/>
				<div class="blink-loader" style="margin-top: -1.5em; color: #6610f2"><b><i>Still Loading...</i></b></div>
			</div>
		</div>
		<div data-bind="visible: ac.form" class="col-sm-12 col-xl-6">
			<div class="card card-body pd-30 pd-sm-40">
				<h5 class="card-title mg-b-20">
					<span data-bind="visible: ac.titleNew">
						<?php echo $arrLang[$defaultLanguage]['input_new_data_account']; ?>
					</span>
					<span data-bind="visible: ac.titleEdit">
						<?php echo $arrLang[$defaultLanguage]['input_edit_data_account']; ?>
					</span>	
				</h5>
				<form id="forminput">
					<div class="row">
						<div class="col-xl-12">
							<div class="form-group">
								<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['account_name']; ?></label>
								<input id="accountname" type="text" class="form-control" placeholder="Enter your account name" data-parsley-required-message="Account name required!" required>
							</div>
						</div>
						<div class="col-xl-12">
							<div class="form-group">
								<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['account_bank_no']; ?></label>
								<input id="accountbankno" type="text" class="form-control" placeholder="Enter your account bank no." data-parsley-required-message="Account bank no. required!" required>
							</div>
						</div>
						<div class="col-xl-12">
							<div class="form-group">
								<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['account_bank_name']; ?></label>
								<input id="accountbankname" type="text" class="form-control" placeholder="Enter your account bank name" data-parsley-required-message="Account bank name required!" required>
							</div>
						</div>
					</div>	
				</form>
			</div>
		</div>
		<div data-bind="visible: ac.table" class="col-sm-12 col-xl-12">
			<table id="DataTableAccount" class="display responsive nowrap">
		        <thead style="background-color: #bec1c5;">
		          <tr>
		            <th class="wd-15p"><?php echo $arrLang[$defaultLanguage]['id']; ?></th>
		            <th class="wd-15p"><?php echo $arrLang[$defaultLanguage]['account_name']; ?></th>
		            <th class="wd-20p"><?php echo $arrLang[$defaultLanguage]['account_bank_no']; ?></th>
		            <th class="wd-20p"><?php echo $arrLang[$defaultLanguage]['account_bank_name']; ?></th>
		            <th class="wd-25p"><?php echo $arrLang[$defaultLanguage]['date_create']; ?>&nbsp;<sup style="font-weight: normal">mm-dd-yyyy</sup></th>
		            <th class="wd-25p"><?php echo $arrLang[$defaultLanguage]['action']; ?></th>
		          </tr>
		        </thead>
			</table>
		</div>
	</div>
</div>
<script src="dist/js/master_account.js" type="text/javascript"></script>