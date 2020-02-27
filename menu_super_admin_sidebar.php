<ul class="nav">
  <li class="nav-label"><?php echo $arrLang[$defaultLanguage]['main_menu']; ?></li>
  <li class="nav-item">
    <a href="index.php?page=home" class="nav-link without-sub"><i class="fa fa-desktop"></i> <?php echo $arrLang[$defaultLanguage]['dashboard']; ?></a>
  </li>
  <li class="nav-item">
    <a href="#" class="nav-link with-sub"><i class="fa fa-cube"></i><?php echo $arrLang[$defaultLanguage]['master']; ?></a>
    <nav class="nav-sub">
      <a href="index.php?page=master_main_category" class="nav-sub-link"><?php echo $arrLang[$defaultLanguage]['master_main_category']; ?></a>
      <a href="index.php?page=master_category" class="nav-sub-link"><?php echo $arrLang[$defaultLanguage]['master_category']; ?></a>
      <a href="index.php?page=master_project" class="nav-sub-link"><?php echo $arrLang[$defaultLanguage]['master_project']; ?></a>
      <a href="index.php?page=master_account" class="nav-sub-link"><?php echo $arrLang[$defaultLanguage]['master_account']; ?></a>
      <a href="index.php?page=master_user" class="nav-sub-link"><?php echo $arrLang[$defaultLanguage]['master_user']; ?></a>
      <a href="index.php?page=master_customer" class="nav-sub-link"><?php echo $arrLang[$defaultLanguage]['customer']; ?></a>
      <a href="index.php?page=master_cluster" class="nav-sub-link"><?php echo $arrLang[$defaultLanguage]['housing_cluster']; ?></a>
    </nav>
  </li>
  <li class="nav-item">
    <a href="#" class="nav-link with-sub"><i class="fa fa-plus-square"></i><?php echo $arrLang[$defaultLanguage]['transaction']; ?></a>
    <nav class="nav-sub">
      <a href="index.php?page=transaction_finance_cost" class="nav-sub-link"><?php echo $arrLang[$defaultLanguage]['transaction_finance_cost']; ?></a>
      <a href="index.php?page=transaction_finance_revenue" class="nav-sub-link"><?php echo $arrLang[$defaultLanguage]['transaction_finance_revenue']; ?></a>
      <a href="index.php?page=transaction_sell_property" class="nav-sub-link"><?php echo $arrLang[$defaultLanguage]['transaction_sell_property']; ?></a>
    </nav>
  </li>
  <li class="nav-item">
    <a href="#" class="nav-link with-sub"><i class="fa fa-file-text"></i><?php echo $arrLang[$defaultLanguage]['report']; ?></a>
    <nav class="nav-sub">
      <a href="index.php?page=report_cost" class="nav-sub-link"><?php echo $arrLang[$defaultLanguage]['report_cost']; ?></a>
      <a href="index.php?page=report_revenue" class="nav-sub-link"><?php echo $arrLang[$defaultLanguage]['report_revenue']; ?></a>
      <a href="index.php?page=report_sell_property" class="nav-sub-link"><?php echo $arrLang[$defaultLanguage]['report_sell_property']; ?></a>
    </nav>
  </li>
</ul>
<!-- nav -->