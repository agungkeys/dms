<div class="az-content-body">
  	<div class="row row-sm row-md">
  		<div class="col-sm-6 col-xl-6 col-md-6">
  			<div class="az-content-breadcrumb">
				<span><?php echo $arrLang[$defaultLanguage]['master']; ?></span>
				<span><?php echo $arrLang[$defaultLanguage]['customer']; ?></span>
			</div>
			<h2 class="az-content-title"><?php echo $arrLang[$defaultLanguage]['customer']; ?></h2>
		</div>
		<div class="col-sm-6 col-xl-6 col-md-6">
			<div style="text-align: right; float: right; display: flex;">
				<button data-bind="visible: cs.buttonVisible, click: cs.addCustomer" id="add" class="btn btn-primary"><i class="fa fa-plus"></i> <?php echo $arrLang[$defaultLanguage]['add_customer']; ?></button>&nbsp;
				<button data-bind="visible: cs.buttonUnVisible, click: cs.titleNew() ? cs.saveCustomer : cs.saveUpdateCustomer" id="save" class="btn btn-success"><i class="fa fa-floppy-o"></i> 
					<span data-bind="visible: cs.titleNew"><?php echo $arrLang[$defaultLanguage]['save']; ?></span>
					<span data-bind="visible: cs.titleEdit"><?php echo $arrLang[$defaultLanguage]['update']; ?></span>
				</button>&nbsp;
				<button data-bind="visible: cs.buttonUnVisible, click: cs.cancelCustomer" id="cancel" class="btn btn-danger"><i class="fa fa-times"></i> <?php echo $arrLang[$defaultLanguage]['cancel']; ?></button>
			</div>
		</div>
	</div>
	<div class="row row-sm">
		<div data-bind="visible: cs.loader" class="col-sm-12 col-xl-12">
			<div class="text-center">
				<img style="width: 10em" src="spinner.svg"/>
				<div class="blink-loader" style="margin-top: -1.5em; color: #6610f2"><b><i>Still Loading...</i></b></div>
			</div>
		</div>
		<div data-bind="visible: cs.form" class="col-sm-12 col-xl-8">
			<div class="card card-body pd-30 pd-sm-40">
				<h5 class="card-title mg-b-20">
					<span data-bind="visible: cs.titleNew">
						<?php echo $arrLang[$defaultLanguage]['input_new_data_customer']; ?>
					</span>
					<span data-bind="visible: cs.titleEdit">
						<?php echo $arrLang[$defaultLanguage]['input_edit_data_customer']; ?>
					</span>	
				</h5>
				<form id="forminput">
					<div class="row">
						<div class="col-xl-4">
							<div class="form-group">
								<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['full_name']; ?></label>
								<input id="fullname" type="text" class="form-control" placeholder="Enter your fullname" data-parsley-required-message="Fullname required!" required onkeyup="formatUpEveryWord(this)">
							</div>
						</div>
						<div class="col-xl-4">
							<div class="form-group">
								<label class="form-label mg-b-0">
									<?php echo 'No. ', $arrLang[$defaultLanguage]['ktp'],' / '; ?>
									<?php echo $arrLang[$defaultLanguage]['other_id']; ?>
								</label>
								<input id="ktp" type="number" class="form-control" placeholder="Enter your KTP" data-parsley-required-message="KTP required!" required>
							</div>
						</div>
						<div class="col-xl-4">
							<div class="form-group">
								<label class="form-label mg-b-0">
									<?php echo 'No. ', $arrLang[$defaultLanguage]['npwp']; ?>
								</label>
								<input id="npwp" type="text" class="form-control" placeholder="Enter your NPWP" data-parsley-required-message="NPWP required!" required>
							</div>
						</div>
						<div class="col-xl-4">
							<div class="form-group">
								<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['email']; ?></label>
								<input id="email" type="email" class="form-control" placeholder="Enter your email" data-parsley-required-message="Email required!" required>
							</div>
						</div>
						<div class="col-xl-8">
							<div class="form-group">
								<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['address']; ?></label>
								<input id="address" type="text" class="form-control" placeholder="Enter your Adress" data-parsley-required-message="Adress required!" required onkeyup="formatUppersize(this)">
							</div>
						</div>

						<div class="col-xl-4">
							<div class="form-group">
								<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['kelurahan']; ?></label>
								<input id="kelurahan" type="text" class="form-control" placeholder="Enter your province" onkeyup="formatUpEveryWord(this)">
							</div>
						</div>
						<div class="col-xl-4">
							<div class="form-group">
								<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['kecamatan']; ?></label>
								<input id="kecamatan" type="text" class="form-control" placeholder="Enter your kecamatan" onkeyup="formatUpEveryWord(this)">
							</div>
						</div>
						<div class="col-xl-4">
							<div class="form-group">
								<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['kabupaten']; ?></label>
								<input id="kabupaten" type="text" class="form-control" placeholder="Enter your kabupaten" onkeyup="formatUpEveryWord(this)">
							</div>
						</div>
						<div class="col-xl-4">
							<div class="form-group">
								<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['province']; ?></label>
								<input id="province" type="text" class="form-control" placeholder="Enter your province" onkeyup="formatUpEveryWord(this)">
							</div>
						</div>
						<div class="col-xl-4">
							<div class="form-group">
								<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['zip_code']; ?></label>
								<input id="zip_code" type="number" class="form-control" placeholder="Enter your zip code" onkeyup="formatUpEveryWord(this)">
							</div>
						</div>
						
						<div class="col-xl-4"></div>

						<div class="col-xl-4">
							<div class="form-group">
								<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['telp_home']; ?></label>
								<input id="telphome" type="number" class="form-control" placeholder="Enter your home telp." >
							</div>
						</div>
						<div class="col-xl-4">
							<div class="form-group">
								<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['telp_office']; ?></label>
								<input id="telpoffice" type="number" class="form-control" placeholder="Enter your office telp" >
							</div>
						</div>
						<div class="col-xl-4">
							<div class="form-group">
								<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['telp_hp']; ?></label>
								<input id="telphp" type="number" class="form-control" placeholder="Enter your phone number" data-parsley-required-message="Phone number required!" required>
							</div>
						</div>
						<div class="col-xl-12">
							<div class="form-group">
								<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['note']; ?></label>
								<textarea id="note" rows="2" class="form-control" placeholder="Enter your notes"></textarea>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div data-bind="visible: cs.table" class="col-sm-12 col-xl-12">
			<table id="DataTableCustomer" class="display responsive nowrap">
		        <thead style="background-color: #bec1c5;">
		          <tr>
		            <th class="wd-5p"><?php echo $arrLang[$defaultLanguage]['id']; ?></th>
		            <th class="wd-20p"><?php echo $arrLang[$defaultLanguage]['full_name']; ?></th>
		            <th class="wd-15p"><?php echo $arrLang[$defaultLanguage]['ktp']; ?></th>
		            <th class="wd-10p"><?php echo $arrLang[$defaultLanguage]['npwp']; ?></th>
		            <th class="wd-10p"><?php echo $arrLang[$defaultLanguage]['address']; ?></th>
		            <th class="wd-10p"><?php echo $arrLang[$defaultLanguage]['telp_hp']; ?></th>
		            <th class="wd-10p"><?php echo $arrLang[$defaultLanguage]['email']; ?></th>
		            <th class="wd-25p"><?php echo $arrLang[$defaultLanguage]['date_create']; ?>&nbsp;<sup style="font-weight: normal">mm-dd-yyyy</sup></th>
		            <th class="wd-25p"><?php echo $arrLang[$defaultLanguage]['action']; ?></th>
		          </tr>
		        </thead>
			</table>
		</div>
	</div>
</div>
<script src="dist/js/master_customer.js" type="text/javascript"></script>