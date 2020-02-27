<div class="az-content-body">
	<div class="row row-sm">
		<div class="col-sm-6 col-xl-6 col-md-6">
  			<div class="az-content-breadcrumb">
				<span><?php echo $arrLang[$defaultLanguage]['transaction']; ?></span>
				<span><?php echo $arrLang[$defaultLanguage]['transaction_sell_property']; ?></span>
			</div>
			<h2 class="az-content-title"><?php echo $arrLang[$defaultLanguage]['transaction_sell_property']; ?></h2>
      		<!-- <div class="card card-dashboard-twentytwo">
				<h1>Master User</h1>
			</div> -->
		</div>
		<div class="col-sm-6 col-xl-6 col-md-6">
			<div style="text-align: right; float: right; display: flex;">
				<button data-bind="visible: trsp.buttonVisible, click: trsp.addTransaction" id="add" class="btn btn-primary"><i class="fa fa-plus"></i> <?php echo $arrLang[$defaultLanguage]['add_transaction']; ?></button>&nbsp;
				<button data-bind="visible: trsp.buttonUnVisible, click: trsp.titleNew() ? trsp.saveTransaction : trsp.saveUpdateTransaction" id="save" class="btn btn-success"><i class="fa fa-floppy-o"></i> 
					<span data-bind="visible: trsp.titleNew"><?php echo $arrLang[$defaultLanguage]['save']; ?></span>
					<span data-bind="visible: trsp.titleEdit"><?php echo $arrLang[$defaultLanguage]['update']; ?></span>
				</button>&nbsp;
				<button data-bind="visible: trsp.buttonUnVisible, click: trsp.cancelTransaction" id="cancel" class="btn btn-danger"><i class="fa fa-times"></i> <?php echo $arrLang[$defaultLanguage]['cancel']; ?></button>
			</div>
		</div>
	</div>
	<div class="row row-sm">
		<div data-bind="visible: trsp.loader" class="col-sm-12 col-xl-12">
			<div class="text-center">
				<img style="width: 10em" src="spinner.svg"/>
				<div class="blink-loader" style="margin-top: -1.5em; color: #6610f2"><b><i>Still Loading...</i></b></div>
			</div>
		</div>
		<div id="transaction-sell-property" data-bind="visible: trsp.form" class="col-sm-12">
			<div class="card">
				<!-- <div class="card card-header">
					<nav class="nav nav-pills">
						<a class="nav-link active show" data-toggle="tab" href="#" onclick="trsp.changeMode('single')">
							<?php echo $arrLang[$defaultLanguage]['single']; ?>
						</a>
						<a class="nav-link" data-toggle="tab" href="#" onclick="trsp.changeMode('multiple')">
							<?php echo $arrLang[$defaultLanguage]['multiple']; ?>
						</a>
					</nav>
	            </div> -->
				<div class="card card-body pd-30 pd-sm-40">
					<h5 class="card-title mg-b-20">
						<span data-bind="visible: trsp.titleNew">
							<?php echo $arrLang[$defaultLanguage]['input_new_data_transaction_sell']; ?>
						</span>
						<span data-bind="visible: trsp.titleEdit">
							<?php echo $arrLang[$defaultLanguage]['input_edit_data_transaction_sell']; ?>
						</span>	
					</h5>
					<div data-bind="visible: trsp.modeSingle">
						<form id="forminput" class="row">
							<div class="col-lg-4 col-xs-12">
								<div class="form-group">
									<div id="slWrapperProject" class="parsley-select">
										<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['project']; ?></label>
										<select id="project" class="form-control select2-no-search" data-parsley-class-handler="#slWrapperProject" data-parsley-errors-container="#slErrorContainerProject"  data-parsley-required-message="Project required!" required>
						              	</select>
						              	<div id="slErrorContainerProject"></div>
									</div>
								</div>
							</div>
							
							<div class="col-lg-4 col-xs-12">
								<div class="form-group">
									<div id="slWrapper4" class="parsley-select">
										<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['account']; ?></label>
										<select id="account" class="form-control select2-no-search" data-parsley-class-handler="#slWrapper4" data-parsley-errors-container="#slErrorContainer4"  data-parsley-required-message="Account required!" required>
						              	</select>
						              	<div id="slErrorContainer4"></div>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-xs-12">
								<div class="form-group">
									<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['cek_number']; ?></label>
									<input id="cheque" type="text" class="form-control" placeholder="Enter your cheque number" onkeyup='formatUppersize(this)'>
								</div>
							</div>

							<div class="col-lg-3 col-xs-12">
								<div class="form-group">
									<div id="slWrapperCluster" class="parsley-select">
										<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['cluster']; ?></label>
										<select id="cluster" class="form-control select2-no-search" data-parsley-class-handler="#slWrapperCluster" data-parsley-errors-container="#slErrorContainerCluster"  data-parsley-required-message="Cluster required!" required>
						              	</select>
						              	<div id="slErrorContainerCluster"></div>
									</div>
								</div>
							</div>
							<div class="col-lg-1 col-xs-12">
								<div class="form-group">
									<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['block']; ?></label>
									<input readonly id="block" type="text" class="form-control">
								</div>
							</div>
							<div class="col-lg-1 col-xs-12">
								<div class="form-group">
									<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['kavno']; ?></label>
									<input readonly id="kavno" type="text" class="form-control">
								</div>
							</div>
							<div class="col-lg-1 col-xs-12">
								<div class="form-group">
									<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['typelb']; ?></label>
									<input readonly id="typelb" type="text" class="form-control">
								</div>
							</div>
							<div class="col-lg-1 col-xs-12">
								<div class="form-group">
									<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['typelt']; ?></label>
									<input readonly id="typelt" type="text" class="form-control">
								</div>
							</div>
							<div class="col-lg-2 col-xs-12">
								<div class="form-group">
									<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['land_excess']; ?></label>
									<input readonly id="land_excess" type="text" class="form-control">
								</div>
							</div>
							<div class="col-lg-3 col-xs-12">
								<div class="form-group">
									<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['description']; ?></label>
									<input readonly id="cluster_description" type="text" class="form-control">
								</div>
							</div>

							<div class="col-lg-6 col-xs-12">
								<div class="form-group">
									<div id="slWrapperProject" class="parsley-select">
										<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['customer']; ?></label>
										<select id="customer" class="form-control select2-no-search" data-parsley-class-handler="#slWrapperProject" data-parsley-errors-container="#slErrorContainerCustomer"  data-parsley-required-message="Customer required!" required>
						              	</select>
						              	<div id="slErrorContainerCustomer"></div>
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-xs-12">
								<div class="form-group">
									<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['ktp']; ?></label>
									<input readonly id="ktp" type="text" class="form-control">
								</div>
							</div>
							<div class="col-lg-3 col-xs-12">
								<div class="form-group">
									<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['npwp']; ?></label>
									<input readonly id="npwp" type="text" class="form-control">
								</div>
							</div>
							<div class="col-lg-3 col-xs-12">
								<div class="form-group">
									<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['telp_hp']; ?></label>
									<input readonly id="handphone" type="text" class="form-control">
								</div>
							</div>
							<div class="col-lg-3 col-xs-12">
								<div class="form-group">
									<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['email']; ?></label>
									<input readonly id="email" type="text" class="form-control">
								</div>
							</div>
							<div class="col-lg-6 col-xs-12">
								<div class="form-group">
									<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['address']; ?></label>
									<input readonly id="address" type="text" class="form-control">
								</div>
							</div>
							<div class="col-lg-2 col-xs-12">
								<div class="form-group">
									<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['zip_code']; ?></label>
									<input readonly id="zipcode" type="text" class="form-control">
								</div>
							</div>
							<div class="col-lg-2 col-xs-12">
								<div class="form-group">
									<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['kelurahan']; ?></label>
									<input readonly id="kelurahan" type="text" class="form-control">
								</div>
							</div>
							<div class="col-lg-2 col-xs-12">
								<div class="form-group">
									<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['kecamatan']; ?></label>
									<input readonly id="kecamatan" type="text" class="form-control">
								</div>
							</div>
							<div class="col-lg-3 col-xs-12">
								<div class="form-group">
									<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['kabupaten']; ?></label>
									<input readonly id="kabupaten" type="text" class="form-control">
								</div>
							</div>
							<div class="col-lg-3 col-xs-12">
								<div class="form-group">
									<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['province']; ?></label>
									<input readonly id="province" type="text" class="form-control">
								</div>
							</div>

						</form>
						<form id="forminputdetails" class="row">
							<div class="col-12">
								<h5 class="card-title mg-b-20">
									<span>
										<?php echo $arrLang[$defaultLanguage]['input_detail_payment']; ?>
									</span>
								</h5>
							</div>
							<div class="col-lg-4 col-xs-12">
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
							<div class="col-lg-4 col-xs-12">
								<div class="form-group">
									<div id="slWrapper2" class="parsley-select">
										<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['main_category_name']; ?></label>
										<select id="maincategory" class="form-control select2-no-search" data-parsley-class-handler="#slWrapper2" data-parsley-errors-container="#slErrorContainer2"  data-parsley-required-message="Main Category required!" required>
						              	</select>
						              	<div id="slErrorContainer2"></div>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-xs-12">
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
									<div id="slWrapper2" class="parsley-select">
										<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['payment_type']; ?></label>
										<select id="payment_type" class="form-control select2-no-search" data-parsley-class-handler="#slWrapper" data-parsley-errors-container="#slErrorContainer4"  data-parsley-required-message="Payment Type required!" required>
						                <option label="Choose one"></option>
						                <option value="CASH"><?php echo $arrLang[$defaultLanguage]['cash']; ?></option>
						                <option value="CREDIT"><?php echo $arrLang[$defaultLanguage]['credit']; ?></option>
					              	</select>
						              	<div id="slErrorContainer4"></div>
									</div>
								</div>
							</div>

							<div class="col-lg-4 col-xs-12">
								<div class="form-group">
									<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['amount']; ?></label>
									<input onfocusout="trsp.toAmountNumber();" id="amount" type="text" class="form-control" placeholder="Enter your amount" data-parsley-required-message="Amount required!" required>
								</div>
							</div>
							<div class="col-lg-4 col-xs-12">
								<div class="form-group">
									<label class="form-label mg-b-0"><?php echo $arrLang[$defaultLanguage]['transaction_title']; ?></label>
									<input id="title" type="text" class="form-control" placeholder="Enter your title" data-parsley-required-message="Title transaction required!" required>
								</div>
							</div>
						</form>
						<div class="row">
							<div class="col-12">
								<button class="btn btn-az-secondary btn-block" onclick="trsp.addDetailItem()"><?php echo $arrLang[$defaultLanguage]['add_detail_item']; ?></button>
							</div>
							<div class="col-12">
								<div class="table-responsive mg-t-10">
						            <table class="table table-bordered">
						              <thead>
						                <tr>
						                  <th>ID</th>
						                  <th>Date</th>
						                  <th>Group</th>
						                  <th>Main Category</th>
						                  <th>Category</th>
						                  <th>Type</th>
						                  <th>Amount</th>
						                  <th style="text-align: center"></th>
						                </tr>
						              </thead>
						              <tbody data-bind="foreach: trsp.data">
						                <tr>
						                  <th scope="row" data-bind="text: ($index()+1), attr:{name:($index()+1)}"></th>
						                  <td data-bind="text: moment(date).format('DD MMMM YYYY');"></td>

						                  <td data-bind="text: maincategorygroups"></td>
						                  <td data-bind="text: maincategoryname"></td>
						                  <td data-bind="text: categoryname"></td>
						                  <td data-bind="text: type"></td>
						                  <td style="text-align: right" data-bind="text: formatNumber(JSON.stringify(amount))"></td>
						                  <td style="text-align: center">
						                  	<a style="color: red;" href="#" data-bind="click: trsp.removeDetailItem"><i class="fa fa-trash" aria-hidden="true"></i></a>
						                  </td>
						                </tr>
						              </tbody>
						              <tfoot>
						              	<tr>
						              		<th colspan=6>Total</th>
						              		<th style="text-align: right">Rp <span data-bind="text: getTotal"></span></th>
						              		<th></th>
						              	</tr>
						              </tfoot>
						            </table>
					            </div><!-- bd -->
							</div>
						</div>
					</div>

					
				</div>
			</div>
		</div>
		<div data-bind="visible: trsp.table" class="col-sm-12 col-xl-12">
			<table id="DataTableTransactionSellProperty" class="display responsive nowrap">
		        <thead style="background-color: #bec1c5;">
		          <tr>
		            <th class="wd-5p"><?php echo $arrLang[$defaultLanguage]['id']; ?></th>
		            <th class="wd-15p"><?php echo $arrLang[$defaultLanguage]['project_name']; ?></th>
		            <th class="wd-4p"><?php echo $arrLang[$defaultLanguage]['kavblok']; ?></th>
		            <th class="wd-4p"><?php echo $arrLang[$defaultLanguage]['kavno']; ?></th>
		            <th class="wd-4p"><?php echo $arrLang[$defaultLanguage]['typelb']; ?></th>
		            <th class="wd-4p"><?php echo $arrLang[$defaultLanguage]['typelt']; ?></th>
		            <th class="wd-10p"><?php echo $arrLang[$defaultLanguage]['land_excess']; ?></th>

		            <th class="wd-15p"><?php echo $arrLang[$defaultLanguage]['customer']; ?></th>
		            <th class="wd-10p"><?php echo $arrLang[$defaultLanguage]['address']; ?></th>
		            <th class="wd-10p"><?php echo $arrLang[$defaultLanguage]['kpr']; ?></th>


    		        
		            <th class="wd-10p"><?php echo $arrLang[$defaultLanguage]['date_create']; ?>&nbsp;<sup style="font-weight: normal">mm-dd-yyyy</sup></th>
		            <th class="wd-10p"><?php echo $arrLang[$defaultLanguage]['action']; ?></th>
		          </tr>
		        </thead>
			</table>
		</div>
	</div>
</div>
<script src="dist/js/transaction_sell_property.js" type="text/javascript"></script>