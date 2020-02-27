<div class="az-header az-header-dashboard-nine">
  <div class="container-fluid">
    <div class="az-header-left">
      <a href="" id="azSidebarToggle" class="az-header-menu-icon"><span></span></a>
    </div><!-- az-header-left -->
    <div class="az-header-center">
      <!-- <input type="search" class="form-control" placeholder="Search for anything...">
      <button class="btn"><i class="fas fa-search"></i></button> -->
      <marquee><?php echo $arrLang[$defaultLanguage]['running_welcome_message']; ?></marquee>
    </div><!-- az-header-center -->
    <div class="az-header-right">
      <!-- <div class="az-header-message">
        <a href="app-chat.html"><i class="typcn typcn-messages"></i></a>
      </div> -->

      <!-- az-header-message -->
      <div class="az-profile-menu">
        <?php 
        if($defaultLanguage != "id")
          {
        ?>
          <a data-toggle="tooltip-primary" data-placement="bottom" title data-original-title="Translate Indonesia" style="cursor: pointer;" onclick="loadLang('id')" class="az-img-user"><img style="border: 1px solid #e1e1e1;" src="<?php echo $flagID ?>" alt=""></a>
        <?php
          }else{
        ?>
        <a data-toggle="tooltip-primary" data-placement="bottom" title data-original-title="Translate English" style="cursor: pointer;" onclick="loadLang('en')" class="az-img-user"><img style="border: 1px solid #e1e1e1;" src="<?php echo $flagEN ?>" alt=""></a>
        <?php
          }
        ?>
        
      </div>
      <div class="dropdown az-profile-menu">
        <a href="" class="az-img-user"><img src="assets/img/user.png" alt=""></a>
        <div class="dropdown-menu">
          <div class="az-dropdown-header d-sm-none">
            <a href="" class="az-header-arrow"><i class="icon ion-md-arrow-back"></i></a>
          </div>

          <div class="az-header-profile">
            <div class="az-img-user">
              <img src="assets/img/user.png" alt="">
            </div>
            <h6><?php echo $fullname_; ?></h6>
            <span><?php echo $userlevel_; ?></span>
            <span class="usernameLabel" hidden><?php echo $username_; ?></span>
          </div>

          <!-- <a href="" class="dropdown-item"><i class="typcn typcn-user-outline"></i> My Profile</a>
          <a href="" class="dropdown-item"><i class="typcn typcn-edit"></i> Edit Profile</a>
          <a href="" class="dropdown-item"><i class="typcn typcn-time"></i> Activity Logs</a>
          <a href="" class="dropdown-item"><i class="typcn typcn-cog-outline"></i> Account Settings</a> -->
          <a href="index.php?page=exit" class="dropdown-item"><i class="typcn typcn-power-outline"></i> <?php echo $arrLang[$defaultLanguage]['sign_out']; ?></a>
        </div><!-- dropdown-menu -->
      </div>
    </div><!-- az-header-right -->
  </div><!-- container -->
</div><!-- az-header -->