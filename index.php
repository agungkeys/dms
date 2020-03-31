<?php
  session_start();

  if(!isset($_SESSION['USERSESSION']))
  { header("Location: login.html"); }

  include_once "i18n.php";
  include_once 'engine/configdb.php';

  $stmt = $db_con->prepare("SELECT user.USERID, user.USERNAME, user.FULLNAME, user.USER_EMAIL, user.LEVEL FROM user WHERE USERID=:uid");
  $stmt->execute(array(":uid"=>$_SESSION['USERSESSION']));
  $row=$stmt->fetch(PDO::FETCH_ASSOC);

  $username_= $row['USERNAME'];
  $fullname_= $row['FULLNAME'];
  $userlevel_= $row['LEVEL'];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <!-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-130582519-1"></script> -->
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-130582519-1');
    </script>

    
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta -->
    <meta name="description" content="Responsive Bootstrap 4 Dashboard Template">
    <meta name="author" content="ThemePixels">
    
    <title>Developer Management System</title>

    <!-- vendor css -->
    <link href="assets/lib/fontawesome-free/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="assets/lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="assets/lib/typicons.font/typicons.css" rel="stylesheet">
    <link href="assets/lib/jqvmap/jqvmap.min.css" rel="stylesheet">
    <link href="assets/lib/spectrum-colorpicker/spectrum.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/bootstrap-datepicker/css/datepicker.css">

    <!-- DataTable -->
    <link href="assets/lib/datatables.net-dt/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="assets/lib/datatables.net-responsive-dt/css/responsive.dataTables.min.css" rel="stylesheet">
    <link href="assets/lib/select2/css/select2.min.css" rel="stylesheet">
    <link href="assets/lib/jquery-daterange/daterangepicker.min.css" rel="stylesheet">
    <link href="plugin/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>

    <!-- azia CSS -->
    <link rel="stylesheet" href="assets/css/azia.css">    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/knockout/3.5.0/knockout-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.16.0/moment.min.js" type="text/javascript"></script>
    <script src="assets/lib/jquery/jquery.min.js"></script>
    <script src="assets/lib/jquery-daterange/jquery.daterangepicker.js"></script>
    <!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js" type="text/javascript"></script> -->
    <!-- <script src="//https://longbill.github.io/jquery-date-range-picker/demo.js" type="text/javascript"></script> -->

    

    <!-- already download asset -->
    
  </head>
  <body class="az-body az-body-sidebar az-body-dashboard-nine">
    <div class="az-sidebar az-sidebar-sticky az-sidebar-indigo-dark">
      <div class="az-sidebar-header">
        <img src="dms.svg" alt="" width="50px">
        <span style="color: #e1e1e1; padding-left: 5px;">VPP Group</span>
      </div>
      <div class="az-sidebar-body">
        <?php
          if($userlevel_ != "Super Admin"){
            include 'menu_staff_sidebar.php';
          }else{
            include 'menu_super_admin_sidebar.php';
          }
        ?>
      </div><!-- az-sidebar-body -->
    </div><!-- az-sidebar -->
    <div class="az-content az-content-dashboard-nine">
      <?php 
        if($userlevel_ != "Super Admin"){
          include 'menu_super_admin_header.php';
        }else{
          include 'menu_super_admin_header.php';
        }
      ?>

      <!-- Page Router Start -->
      <?php
        $page = (isset($_GET['page']))? $_GET['page'] : "main";
        switch ($page) {
          case 'master_main_category': include "page/master/master_main_category.php"; break;
          case 'master_category': include "page/master/master_category.php"; break;
          case 'master_project': include "page/master/master_project.php"; break;
          case 'master_account': include "page/master/master_account.php"; break;
          case 'master_user': include "page/master/master_user.php"; break;
          case 'master_customer': include "page/master/master_customer.php"; break;
          case 'master_cluster': include "page/master/master_cluster.php"; break;
          case 'transaction_finance_cost': include "page/transaction/transaction_finance_cost.php"; break;
          case 'transaction_finance_revenue': include "page/transaction/transaction_finance_revenue.php"; break;
          case 'transaction_sell_property': include "page/transaction/transaction_sell_property.php"; break;
          case 'report_cost': include "page/report/report_cost.php"; break;
          case 'report_revenue': include "page/report/report_revenue.php"; break;
          case 'report_sell_property': include "page/report/report_sell_property.php"; break;
          case 'exit': include "controller/logout.php"; break;
          default : include 'home.php'; 
        }
      ?>
      <!-- Page Router End -->

      <div class="az-footer">
        <div class="container-fluid">
          <span>&copy; 2019 Developer Management System</span>
          <span>Designed by: AKWEBSITE</span>
        </div><!-- container -->
      </div><!-- az-footer -->
    </div><!-- az-content -->


    

    <script src="assets/js/helpers.js"></script>
    <script src="assets/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.16.0/moment.min.js" type="text/javascript"></script>
    <script src="assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <!-- <script src="assets/lib/ionicons/ionicons.js"></script> -->
    <script src="assets/lib/jquery.flot/jquery.flot.js"></script>
    <script src="assets/lib/jquery.flot/jquery.flot.resize.js"></script>
    <script src="assets/lib/jqvmap/jquery.vmap.min.js"></script>
    <script src="assets/lib/jqvmap/maps/jquery.vmap.world.js"></script>
    <script src="assets/lib/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/lib/spectrum-colorpicker/spectrum.js"></script>

    <script src="assets/js/moment.min.js" type="text/javascript"></script>
    <script src="assets/js/dashboard.sampledata.js"></script>

    <script src="assets/lib/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="assets/lib/datatables.net-dt/js/dataTables.dataTables.min.js"></script>
    <script src="assets/lib/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/lib/datatables.net-responsive-dt/js/responsive.dataTables.min.js"></script>
    <script src="assets/lib/select2/js/select2.min.js"></script>
    <script src="assets/lib/parsleyjs/parsley.min.js"></script>
    <script src="plugin/sweetalert/sweetalert.min.js" type="text/javascript"></script>
    <!-- <script src="assets/lib/jquery-ui/ui/widgets/datepicker.js"></script> -->
    <script src="assets/lib/jquery.maskedinput/jquery.maskedinput.js"></script>
    
    <script src="assets/lib/pdf-object/pdfobject.min.js"></script>
    <script src="assets/js/azia.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>

    
  
    <script>
      function formatNumber(n) {
        return n.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
      }

      function getSelectRevenueCash(){
        $.ajax({
          dataType: 'json',
          type: 'post',
          url: './controller/dashboard/select_revenue_cash.php',
        }).done(function(data){
          $("#revenue-cash").html(data.TOTAL ? formatNumber(data.TOTAL) : 0);
        });
      }

      function getSelectRevenueCredit(){
        $.ajax({
          dataType: 'json',
          type: 'post',
          url: './controller/dashboard/select_revenue_credit.php',
        }).done(function(data){
          $("#revenue-credit").html(data.TOTAL ? formatNumber(data.TOTAL) : 0);
        });
      }

      function getSelectCredit(){
        $.ajax({
          dataType: 'json',
          type: 'post',
          url: './controller/dashboard/select_credit_all.php',
        }).done(function(data){
          $("#credit-all").html(data.TOTAL ? formatNumber(data.TOTAL) : 0);
        });
      }

      function getSelectCountSold(){
        $.ajax({
          dataType: 'json',
          type: 'post',
          url: './controller/dashboard/select_sold_cluster.php',
        }).done(function(data){
          $("#sold-cluster").html(data.TOTAL ? data.TOTAL : 0);
        });
      }

      $(document).ready(function(){
        getSelectRevenueCash();
        getSelectRevenueCredit();
        getSelectCredit();
        getSelectCountSold();
        //TRUE FUNCTION OF SELECTED SIDEBAR
        var pageTemp = "index.php"
        var pathTemp = pageTemp+window.location.search
        $("ul li.nav-item a[href='" + pathTemp + "']").parent().parent().addClass('show');
        $("ul li.nav-item a[href='" + pathTemp + "']").addClass('active')

        // var path = window.location.search.substring(6);
        // console.log(path)
        // var a = $('ul.nav > li > a[href="master_customer"]')
      


        // $("ul li.nav-item a[href='index.php?page=master_customer']").parent().parent().addClass('show')



        // var a = $('.nav > li > a[href="' + path + '"]').parent().addClass('show');
        // $('#datatable2').DataTable({
        //   responsive: true,
        //   language: {
        //     searchPlaceholder: 'Search...',
        //     sSearch: '',
        //     lengthMenu: '_MENU_ items/page',
        //   }
        // });

        // $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });
      });

      $(function(){
        'use strict'

        $('.az-sidebar .with-sub').on('click', function(e){
          e.preventDefault();
          $(this).parent().toggleClass('show');
          $(this).parent().siblings().removeClass('show');
        })

        $(document).on('click touchstart', function(e){
          e.stopPropagation();

          // closing of sidebar menu when clicking outside of it
          if(!$(e.target).closest('.az-header-menu-icon').length) {
            var sidebarTarg = $(e.target).closest('.az-sidebar').length;
            if(!sidebarTarg) {
              $('body').removeClass('az-sidebar-show');
            }
          }
        });


        $('#azSidebarToggle').on('click', function(e){
          e.preventDefault();

          if(window.matchMedia('(min-width: 992px)').matches) {
            $('body').toggleClass('az-sidebar-hide');
          } else {
            $('body').toggleClass('az-sidebar-show');
          }
        });

        new PerfectScrollbar('.az-sidebar-body', {
          suppressScrollX: true
        });

        /* ----------------------------------- */
        /* Dashboard content */
        $(function(){
          'use strict'

          $('[data-toggle="tooltip"]').tooltip();

          // colored tooltip
          $('[data-toggle="tooltip-primary"]').tooltip({
              template: '<div class="tooltip tooltip-primary" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
          });

          $('[data-toggle="tooltip-secondary"]').tooltip({
              template: '<div class="tooltip tooltip-secondary" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
          });

        });
      });
    </script>
  </body>
</html>
