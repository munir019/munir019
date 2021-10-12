<header class="site-header pt-1">
    <div class="container-fluid">
        <a href="<?php echo $baseUrl ?>" class="site-logo">
            <img class="hidden-md-down" src="<?php echo $baseUrl ?>img/logo-2.png" alt="">
            <img class="hidden-lg-down" src="<?php echo $baseUrl ?>img/logo-2-mob.png" alt="">
        </a>

        <button id="show-hide-sidebar-toggle" class="show-hide-sidebar">
            <span>toggle menu</span>
        </button>

        <button class="hamburger hamburger--htla">
            <span>toggle menu</span>
        </button>
        <div class="site-header-content">
            <div class="site-header-content-in">
                <div class="dropdown user-menu float-right">
                    <button class="dropdown-toggle" id="dd-user-menu" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="pull-left mr-2 text-left user-info">
                            <span class="text-dark"><?php echo session()->get('user')['name'].', '.session()->get('user')['officeDesignation']; ?></span>
                            <span class="text-muted text-info p-0">
                                    <?php echo session()->get('user')['officeUnitName']; ?>
                                </span>
                        </div>
                        <img src="<?php echo $baseUrl ?>img/avatar.png" alt="">
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd-user-menu">
                        <!--<a class="dropdown-item" href="<?php echo $baseUrl ?>users/account"><span class="font-icon glyphicon glyphicon-cog"></span>Account Setting</a>-->
                        <?php if(isset(session()->get('user')['access_token'])) { ?>
                            <a class="dropdown-item" href="<?php echo $baseUrl ?>ssologout"><span class="font-icon glyphicon glyphicon-log-out"></span>লগআউট</a>
                        <?php } else { ?>
                            <a class="dropdown-item" href="<?php echo $baseUrl ?>logout"><span class="font-icon glyphicon glyphicon-log-out"></span>লগআউট</a>
                        <?php } ?>
                    </div>
                </div>
                <div class="dropdown user-menu float-right">
                    <div class="widget-icon">
                        <img src="<?php echo $baseUrl ?>img/widget-icon.png"/>
                        <div class="widget-apps">
                            <ul>
                                <li>
                                    <a href="<?php echo $baseUrl ?>sso?redirect_uri=http://dashboard.judiciary.org.bd/users/login" target="_blank">
                                        <img src="<?php echo $baseUrl ?>img/dashboard.png">
                                        <span>ড্যাশবোর্ড</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $baseUrl ?>sso?redirect_uri=http://causelistapp.judiciary.org.bd/login" target="_blank">
                                        <img src="<?php echo $baseUrl ?>img/causelist.png">
                                        <span>কার্যতালিকা</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mobile-menu-right-overlay"></div>
        </div>
    </div>
    </div>
</header>