<div class="az-content-header">
  <div class="az-content-header-top">
    <div>
      <h2 class="az-content-title mg-b-5 mg-b-lg-8">
        <span>
            <?php
                echo $arrLang[$defaultLanguage]['hi'];
                echo $fullname_;
                echo $arrLang[$defaultLanguage]['welcome'];
            ?>
        </span>
      </h2>
      <p class="mg-b-0"><?php echo $arrLang[$defaultLanguage]['your_loggin_as']; ?> <?php echo $userlevel_; ?></p>
    </div>
    <div class="az-dashboard-date">
      <div class="date">
        <div><?php echo date("d") ?></div>
        <div>
          <span><?php echo $arrLang[$defaultLanguage][date("F")] ."&nbsp;". date("Y"); ?></span>
          <span><?php echo $arrLang[$defaultLanguage][date("l")] ?></span>
        </div>
      </div><!-- az-dashboard-date -->
      
    </div><!-- az-dashboard-date -->
  </div><!-- az-content-body-title -->
</div><!-- az-content-header -->


<div class="az-content-body">
  <div class="row row-sm">
    <div class="col-sm-6 col-xl-3">
      <div class="card card-dashboard-twentytwo">
        <div class="media">
          <div class="media-icon bg-success"><i class="typcn typcn-chart-line-outline"></i></div>
          <div class="media-body">
            <h6 id='revenue-cash'></h6>
            <span>Revenue Cash</span>
          </div>
        </div>
        <div class="chart-wrapper">
          <div id="flotChart1" class="flot-chart"></div>
        </div><!-- chart-wrapper -->
      </div><!-- card -->
    </div><!-- col -->
    <div class="col-sm-6 col-xl-3 mg-t-20 mg-sm-t-0">
      <div class="card card-dashboard-twentytwo">
        <div class="media">
          <div class="media-icon bg-teal"><i class="typcn typcn-chart-line-outline"></i></div>
          <div class="media-body">
            <h6 id='revenue-credit'></h6>
            <span>Revenue Credit</span>
          </div>
        </div>
        <div class="chart-wrapper">
          <div id="flotChart2" class="flot-chart"></div>
        </div><!-- chart-wrapper -->
      </div><!-- card -->
    </div><!-- col-3 -->
    <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
      <div class="card card-dashboard-twentytwo">
        <div class="media">
          <div class="media-icon bg-pink"><i class="typcn typcn-chart-line-outline"></i></div>
          <div class="media-body">
            <h6 id='credit-all'></h6>
            <span>All Cost</span>
          </div>
        </div>
        <div class="chart-wrapper">
          <div id="flotChart3" class="flot-chart"></div>
        </div><!-- chart-wrapper -->
      </div><!-- card -->
    </div><!-- col -->
    <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
      <div class="card card-dashboard-twentytwo">
        <div class="media">
          <div class="media-icon bg-primary"><i class="typcn typcn-home"></i></div>
          <div class="media-body">
            <h6 id='sold-cluster'></h6>
            <span>Total Sold</span>
          </div>
        </div>
        <div class="chart-wrapper">
          <div id="flotChart4" class="flot-chart"></div>
        </div><!-- chart-wrapper -->
      </div><!-- card -->
    </div><!-- col -->

    
  </div><!-- row -->
</div><!-- az-content-body -->