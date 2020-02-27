<div class="az-content-body">
  	<div class="row row-sm">
  		<div class="col-sm-6 col-xl-6 col-md-6">
  			<div class="az-content-breadcrumb">
				<span><?php echo $arrLang[$defaultLanguage]['transaction']; ?></span>
				<span><?php echo $arrLang[$defaultLanguage]['transaction_finance_cost']; ?></span>
			</div>
			<h2 class="az-content-title"><?php echo $arrLang[$defaultLanguage]['transaction_finance_cost']; ?></h2>
      		<!-- <div class="card card-dashboard-twentytwo">
				<h1>Master User</h1>
			</div> -->
		</div>
		<div class="col-sm-6 col-xl-6 col-md-6">
			<div style="text-align: right; float: right; display: flex;">
				<button data-bind="visible: trf.buttonVisible, click: trf.addTransaction" id="add" class="btn btn-primary"><i class="fa fa-plus"></i> <?php echo $arrLang[$defaultLanguage]['add_transaction']; ?></button>&nbsp;
				<button data-bind="visible: trf.buttonUnVisible, click: trf.titleNew() ? trf.saveTransaction : trf.saveUpdateTransaction" id="save" class="btn btn-success"><i class="fa fa-floppy-o"></i> 
					<span data-bind="visible: trf.titleNew"><?php echo $arrLang[$defaultLanguage]['save']; ?></span>
					<span data-bind="visible: trf.titleEdit"><?php echo $arrLang[$defaultLanguage]['update']; ?></span>
				</button>&nbsp;
				<button data-bind="visible: trf.buttonUnVisible, click: trf.cancelTransaction" id="cancel" class="btn btn-danger"><i class="fa fa-times"></i> <?php echo $arrLang[$defaultLanguage]['cancel']; ?></button>
			</div>
		</div>
	</div>
	<div class="row row-sm">
		<div data-bind="visible: trf.loader" class="col-sm-12 col-xl-12">
			<div class="text-center">
				<img style="width: 10em" src="spinner.svg"/>
				<div class="blink-loader" style="margin-top: -1.5em; color: #6610f2"><b><i>Still Loading...</i></b></div>
			</div>
		</div>
		<div id="transaction-finance" data-bind="visible: trf.form" class="col-sm-12">
			<div class="card">
				<!-- <div class="card card-header">
					<nav class="nav nav-pills">
						<a class="nav-link active show" data-toggle="tab" href="#" onclick="trf.changeMode('single')">
							<?php echo $arrLang[$defaultLanguage]['single']; ?>
						</a>
						<a class="nav-link" data-toggle="tab" href="#" onclick="trf.changeMode('multiple')">
							<?php echo $arrLang[$defaultLanguage]['multiple']; ?>
						</a>
					</nav>
	            </div> -->
				<div class="card card-body pd-30 pd-sm-40">
					<h5 class="card-title mg-b-20">
						<span data-bind="visible: trf.titleNew">
							<?php echo $arrLang[$defaultLanguage]['input_new_data_transaction']; ?>
						</span>
						<span data-bind="visible: trf.titleEdit">
							<?php echo $arrLang[$defaultLanguage]['input_edit_data_transaction']; ?>
						</span>	
					</h5>
					<div data-bind="visible: trf.modeSingle">
						<form id="forminput" class="row">
							<div class="col-lg-3 col-xs-12">
								<div class="form-group">
									<div id="slWrapperProject" class="parsley-select">
										<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['project']; ?></label>
										<select id="project" class="form-control select2-no-search" data-parsley-class-handler="#slWrapperProject" data-parsley-errors-container="#slErrorContainerProject"  data-parsley-required-message="Project required!" required>
						              	</select>
						              	<div id="slErrorContainerProject"></div>
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-xs-12">
								<div class="form-group">
									<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['date']; ?></label>
									<div class="input-group">
										<div class="input-group-prepend">
											<div class="input-group-text">
												<i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
											</div>
										</div>
										<input id="date" type="text" class="form-control fc-datepicker hasDatepicker" placeholder="DD/MMMM/YYYY" id="dp1565750324053">
										
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-xs-12">
								<div class="form-group">
									<div id="slWrapper4" class="parsley-select">
										<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['account']; ?></label>
										<select id="account" class="form-control select2-no-search" data-parsley-class-handler="#slWrapper4" data-parsley-errors-container="#slErrorContainer4"  data-parsley-required-message="Account required!" required>
						              	</select>
						              	<div id="slErrorContainer4"></div>
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-xs-12">
								<div class="form-group">
									<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['cek_number']; ?></label>
									<input id="cheque" type="text" class="form-control" placeholder="Enter your cheque number" onkeyup='formatUppersize(this)'>
								</div>
							</div>
						</form>
						<form id="forminputdetails" class="row">
							<div class="col-12">
								<h5 class="card-title mg-b-20">
									<span>
										<?php echo $arrLang[$defaultLanguage]['input_detail_item']; ?>
									</span>
								</h5>
							</div>
							<div class="col-lg-6 col-xs-12">
								<div class="form-group">
									<div id="slWrapper2" class="parsley-select">
										<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['main_category_name']; ?></label>
										<select id="maincategory" class="form-control select2-no-search" data-parsley-class-handler="#slWrapper2" data-parsley-errors-container="#slErrorContainer2"  data-parsley-required-message="Main Category required!" required>
						              	</select>
						              	<div id="slErrorContainer2"></div>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-xs-12">
								<div class="form-group">
									<div id="slWrapper3" class="parsley-select">
										<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['category_name']; ?></label>
										<select id="category" class="form-control select2-no-search" data-parsley-class-handler="#slWrapper3" data-parsley-errors-container="#slErrorContainer3"  data-parsley-required-message="Category required!" required>
						              	</select>
						              	<div id="slErrorContainer3"></div>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-xs-12">
								<div class="form-group">
									<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['amount']; ?></label>
									<input onfocusout="trf.toAmountNumber();" id="amount" type="text" class="form-control" placeholder="Enter your amount" data-parsley-required-message="Amount required!" required>
								</div>
							</div>
							<div class="col-lg-4 col-xs-12">
								<div class="form-group">
									<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['transaction_title']; ?></label>
									<input id="title" type="text" class="form-control" placeholder="Enter your title" data-parsley-required-message="Title transaction required!" required>
								</div>
							</div>
							<div class="col-lg-4 col-xs-12">
								<div class="form-group">
									<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['description']; ?></label>
									<textarea id="description" rows="2" class="form-control" placeholder="Enter your description"></textarea>
								</div>
							</div>
						</form>
						<div class="row">
							<div class="col-12">
								<button class="btn btn-az-secondary btn-block" onclick="trf.addDetailItem()"><?php echo $arrLang[$defaultLanguage]['add_detail_item']; ?></button>
							</div>
							<div class="col-12">
								<div class="table-responsive mg-t-10">
						            <table class="table table-bordered">
						              <thead>
						                <tr>
						                  <th>ID</th>
						                  <th>Group</th>
						                  <th>Main Category</th>
						                  <th>Category</th>
						                  <th>Title</th>
						                  <th>Amount</th>
						                  <th style="text-align: center"></th>
						                </tr>
						              </thead>
						              <tbody data-bind="foreach: trf.data">
						                <tr>
						                  <th scope="row" data-bind="text: ($index()+1), attr:{name:($index()+1)}"></th>
						                  <td data-bind="text: maincategorygroups"></td>
						                  <td data-bind="text: maincategoryname"></td>
						                  <td data-bind="text: categoryname"></td>
						                  <td data-bind="text: title"></td>
						                  <td style="text-align: right" data-bind="text: formatNumber(JSON.stringify(amount))"></td>
						                  <td style="text-align: center">
						                  	<a style="color: red;" href="#" data-bind="click: trf.removeDetailItem"><i class="fa fa-trash" aria-hidden="true"></i></a>
						                  </td>
						                </tr>
						              </tbody>
						              <tfoot>
						              	<tr>
						              		<th colspan=5>Total</th>
						              		<th style="text-align: right">Rp <span data-bind="text: getTotal"></span></th>
						              		<th></th>
						              	</tr>
						              </tfoot>
						            </table>
					            </div><!-- bd -->
							</div>
						</div>
					</div>

					<form id="forminputmultiple">	
						<div data-bind="visible: trf.modeMultiple" class="row row-sm">
							<div class="col-12">
								<h2>Soon</h2>
								<span>PAGE MAINTENANCE</span>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div data-bind="visible: trf.table" class="col-sm-12 col-xl-12">
			<table id="DataTableTransaction" class="display responsive nowrap">
		        <thead style="background-color: #bec1c5;">
		          <tr>
		            <th class="wd-15p"><?php echo $arrLang[$defaultLanguage]['id']; ?></th>
		            <th class="wd-25p"><?php echo $arrLang[$defaultLanguage]['group']; ?></th>
		            <th class="wd-15p"><?php echo $arrLang[$defaultLanguage]['main_category_name']; ?></th>
		            <th class="wd-15p"><?php echo $arrLang[$defaultLanguage]['category_name']; ?></th>
		            <th class="wd-15p"><?php echo $arrLang[$defaultLanguage]['transaction_title']; ?></th>
		            <th class="wd-15p"><?php echo $arrLang[$defaultLanguage]['cheque']; ?></th>
		            <th class="wd-15p"><?php echo $arrLang[$defaultLanguage]['project_name']; ?></th>
    		        <th class="wd-15p"><?php echo $arrLang[$defaultLanguage]['amount']; ?></th>
		            <th class="wd-15p"><?php echo $arrLang[$defaultLanguage]['account']; ?></th>
		            <th class="wd-15p"><?php echo $arrLang[$defaultLanguage]['created']; ?></th>
		            <th class="wd-25p"><?php echo $arrLang[$defaultLanguage]['date_create']; ?>&nbsp;<sup style="font-weight: normal">mm-dd-yyyy</sup></th>
		            <th class="wd-25p"><?php echo $arrLang[$defaultLanguage]['action']; ?></th>
		          </tr>
		        </thead>
			</table>
		</div>
		<div data-bind="visible: trf.detail" class="col-xl-6">
			<h5>Detail Transaction of: <span id="dtl_title"></span></h5>
			<div class="card">
				<div class="table-responsive">
					<table class="table">
						<thead>
					        <tr style="height:30px; background: #494c57;">
					            <th class="wd-30p" style="color: #fff;">Item</th>
					            <th class="wd-70p" style="color: #fff;">Description</th>
					        </tr>
					    </thead>
					    <tbody>
					    	<tr>
					    		<td>Transaction ID</td>
					    		<td><span id="dtl_transactionid"></span></td>
					    	</tr>
					    	<tr>
					    		<td>Project</td>
					    		<td><span id="dtl_project"></span></td>
					    	</tr>
					    	<tr>
					    		<td>Date</td>
					    		<td><span id="dtl_date"></span></td>
					    	</tr>
					    	<tr>
					    		<td>Account</td>
					    		<td><span id="dtl_account"></span></td>
					    	</tr>
					    	<tr>
					    		<td>Cheque Number</td>
					    		<td><span id="dtl_cheque"></span></td>
					    	</tr>
					    	<tr>
					    		<td>Main Category</td>
					    		<td><span id="dtl_maincategory"></span></td>
					    	</tr>
					    	<tr>
					    		<td>Category Name</td>
					    		<td><span id="dtl_category"></span></td>
					    	</tr>
					    	<tr>
					    		<td>Amount</td>
					    		<td><span id="dtl_amount"></span></td>
					    	</tr>
					    	<tr>
					    		<td>Transaction Title</td>
					    		<td><span id="dtl_transactiontitle"></span></td>
					    	</tr>
					    	<tr>
					    		<td>Description</td>
					    		<td><span id="dtl_description"></span></td>
					    	</tr>
					    </tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="dist/js/transaction_finance.js" type="text/javascript"></script>