<nav class="navbar top-navbar col-lg-12 col-12 p-0">
  <div class="container">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
      <a class="navbar-brand brand-logo" href="<?php echo $baseUrl ?>"><img src="<?php echo $baseUrl ?>img/logo.png" alt="logo"/><h3 class="text-white pl-3"></h3></a>
      <a class="navbar-brand brand-logo-mini" href="index.html"><img src="https://www.bootstrapdash.com/demo/skydash/template/images/logo-mini.svg" alt="logo"/></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
      <ul class="navbar-nav mr-lg-2">
        <li class="nav-item nav-search d-none d-lg-block">
          <div class="input-group">
            <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
              <span class="input-group-text" id="search">
                <i class="icon-search"></i>
              </span>
            </div>
            <input type="text" class="form-control" id="navbar-search-input" placeholder="Search now" aria-label="search" aria-describedby="search">
            <h3 class="font-weight-bold pt-2">Welcome Superadmin</h3>
          </div>
        </li>
      </ul>
      <ul class="navbar-nav navbar-nav-right">
      
        <li class="nav-item nav-profile dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
            <!-- <img src="img/face28.jpg" alt="profile"/>  -->
          </a>
          <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
            <a class="dropdown-item">
              <i class="ti-settings text-primary"></i>
              Settings
            </a>
            <a class="dropdown-item" href="<?php echo $baseUrl?>logout">
              <i class="ti-power-off text-primary"></i>
              Logout
            </a>
          </div>
        </li>
        <!-- <li class="nav-item nav-settings d-none d-lg-flex">
          <a class="nav-link" href="#">
            <i class="icon-ellipsis"></i>
          </a>
        </li> -->
      </ul>
      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="horizontal-menu-toggle">
        <span class="ti-menu"></span>
      </button>
    </div>
  </div>
</nav>
