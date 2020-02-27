<div class="az-content-body">
  	<div class="row row-sm row-md">
  		<div class="col-sm-6 col-xl-6 col-md-6">
  			<div class="az-content-breadcrumb">
				<span><?php echo $arrLang[$defaultLanguage]['report']; ?></span>
				<span><?php echo $arrLang[$defaultLanguage]['report_cost']; ?></span>
			</div>
			<h2 class="az-content-title"><?php echo $arrLang[$defaultLanguage]['report_cost']; ?></h2>
		</div>
		<div class="col-sm-6 col-xl-6 col-md-6">
			<div style="text-align: right; float: right; display: flex;">
				<!-- <button id="cancel" class="btn btn-primary"><i class="fa fa-times"></i> Search</button>&nbsp; -->
				<button data-bind="visible: rc.isShowReport, click: rc.reset" id="cancel" class="btn btn-danger"><i class="fa fa-times"></i> <?php echo $arrLang[$defaultLanguage]['reset']; ?></button>
			</div>
		</div>
	</div>
	<!-- <div class="row row-sm">
		<div class="col-sm-12">
			<div class="card">
				<div class="row">
					<div class="col-md-4"></div>
					<div class="col-md-4"></div>
					<div class="col-md-4"></div>
				</div>
			</div>
		</div>
	</div> -->
	<div data-bind="visible: rc.isShowSearch" class="pd-30 pd-sm-30 bg-gray-200">
		<div class="row">
			<div class="col-md-2 col-sm-12">
				<select id="type" class="form-control select2-no-search" data-parsley-class-handler="#slWrapper" data-parsley-errors-container="#slErrorContainer"  data-parsley-required-message="Group Type required!" required>
					<option label="Choose type..."></option>
					<option value="GROUP"><?php echo $arrLang[$defaultLanguage]['group']; ?></option>
	                <option value="DETAIL"><?php echo $arrLang[$defaultLanguage]['detail']; ?></option>
	                <option value="PROJECT"><?php echo $arrLang[$defaultLanguage]['project']; ?></option>
	                <option value="ACCOUNT"><?php echo $arrLang[$defaultLanguage]['account']; ?></option>
                </select>
			</div>
			<div class="col-md-3 col-sm-12">
				<select id="maincategory" class="form-control select2-no-search" data-parsley-class-handler="#slWrapper" data-parsley-errors-container="#slErrorContainer1"  data-parsley-required-message="Main Category required!" required>
				</select>
			</div>
			<div data-bind="visible: rc.isShowCategory" class="col-md-3 col-sm-12">
				<select id="category" class="form-control select2-no-search" data-parsley-class-handler="#slWrapper" data-parsley-errors-container="#slErrorContainer2"  data-parsley-required-message="Category required!" required>
				</select>
			</div>
			<div class="col-md-4 col-sm-12">
				<input class="form-control" id="date-range0" value="" placeholder="DD-MMM-YYYY to DD-MMM-YYYY">
			</div>
			<div class="col-md-12 col-sm-12 pd-t-20">
				<div class="row">
					<div class="col-md-9">
						<button data-bind="click: rc.generatePDF" class="btn btn-primary btn-block"><i class="fa fa-print"></i>&nbsp;Generate Report</button>
					</div>
					<div class="col-md-3">
						<button data-bind="click: rc.reset" class="btn btn-danger btn-block"><i class="fa fa-times"></i>&nbsp;Reset</button>
					</div>
				</div>
			</div>
		</div><!-- row -->
	</div>
	<div data-bind="visible: rc.isShowReport" class="row">
		<div class="col-md-12">
			<div id="pdfRender"></div>
		</div>
	</div>
</div>
<style type="text/css">
	#pdfRender{
		height:700px;
		background-image: url("./spinner.svg");
		background-repeat: no-repeat;
		background-position: center top;
	}
</style>
<script src="dist/js/report_cost.js" type="text/javascript"></script>