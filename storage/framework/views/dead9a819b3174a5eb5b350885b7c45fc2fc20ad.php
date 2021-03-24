
<nav id="mainnav-container">
    <div id="mainnav">
        <!--Menu-->
        <!--================================-->
        <div id="mainnav-menu-wrap">
            <div class="nano">
                <div class="nano-content">
                    <!--Profile Widget-->
                    <!--================================-->
                    <div id="mainnav-profile" class="mainnav-profile">
                        <div class="profile-wrap text-center">
                            <div class="pad-btm">
                                <img class="img-circle img-md" src="<?php echo e(asset(env('FPATH').'v2.9/img/profile-photos/1.png')); ?>" alt="Profile Picture">
                            </div>
                            <a href="#profile-nav" class="box-block" data-toggle="collapse" aria-expanded="false">
                                <span class="pull-right dropdown-toggle">
                                <i class="dropdown-caret"></i>
                                </span>
                                <p class="mnp-name"><?php echo e(Auth::user()->name); ?></p>
                                <span class="mnp-desc"><?php echo e(Auth::user()->email); ?></span>
                            </a>
                        </div>
                        <div id="profile-nav" class="collapse list-group bg-trans">
                            <a href="javascript:;" class="list-group-item">
                            <i class="demo-pli-male icon-lg icon-fw"></i> View Profile
                            </a>
                            <a href="javascript:;" class="list-group-item">
                            <i class="demo-pli-gear icon-lg icon-fw"></i> Settings
                            </a>
                            <a href="javascript:;" class="list-group-item">
                            <i class="demo-pli-information icon-lg icon-fw"></i> Help
                            </a>
                            <a href="<?php echo e(route('logout')); ?>" class="list-group-item">
                            <i class="demo-pli-unlock icon-lg icon-fw"></i> Logout
                            </a>
                        </div>
                    </div>
                    <!--Shortcut buttons-->
                    <!--================================-->
                    <div id="mainnav-shortcut" class="hidden">
                        <ul class="list-unstyled shortcut-wrap">
                            <li class="col-xs-3" data-content="My Profile">
                                <a class="shortcut-grid" href="javascript:;">
                                    <div class="icon-wrap icon-wrap-sm icon-circle bg-mint">
                                        <i class="demo-pli-male"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="col-xs-3" data-content="Messages">
                                <a class="shortcut-grid" href="javascript:;">
                                    <div class="icon-wrap icon-wrap-sm icon-circle bg-warning">
                                        <i class="demo-pli-speech-bubble-3"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="col-xs-3" data-content="Activity">
                                <a class="shortcut-grid" href="javascript:;">
                                    <div class="icon-wrap icon-wrap-sm icon-circle bg-success">
                                        <i class="demo-pli-thunder"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="col-xs-3" data-content="Lock Screen">
                                <a class="shortcut-grid" href="javascript:;">
                                    <div class="icon-wrap icon-wrap-sm icon-circle bg-purple">
                                        <i class="demo-pli-lock-2"></i>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <ul id="mainnav-menu" class="list-group">
                        <li class="list-header">Navigation</li>
                        <li class="active-sub">
                            <a href="<?php echo e(route('dashboard')); ?>">
                            <i class="demo-pli-home"></i>
                            <span class="menu-title">Dashboard</span>
                            </a>
                        </li>
                        
                          <li>
                                <a href="<?php echo e(route('packages.add')); ?>">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span class="menu-title">Add Packages</span>
                                </a>
                            </li>   

                         <li class="list-divider"></li>
                         <li class="list-header">Agency</li>
                          <li>
                            <a href="<?php echo e(route('add-agency')); ?>">
                                    <i class="fa fa-user-plus"></i>
                                    <span class="menu-title">Add Agency</span>
                                </a>
                            </li>
                         <li>
                            <a href="<?php echo e(route('admin.agency.list')); ?>">
                                    <i class="fa fa-list"></i>
                                    <span class="menu-title">Agency List</span>
                                </a>
                         </li>
                         <li>
                            <a href="<?php echo e(route('admin.agency.markup')); ?>">
                                    <i class="fa fa-tags"></i>
                                    <span class="menu-title">Agency Markup</span>
                                </a>
                         </li>

                        <li class="list-divider"></li>

                        <li class="list-header">Booking</li>
                        <?php if(Permissions::havePermission('book-flight')): ?>
                            <li>
                                <a href=" <?php echo e(route('book.flight')); ?> ">
                                    <i class="ion-plane"></i>
                                    <span class="menu-title">Book Flight</span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if(Permissions::havePermission('book-bus')): ?>
                            <li>
                                <a href=" <?php echo e(route('book.bus')); ?> ">
                                    <i class="fa fa-bus"></i>
                                    <span class="menu-title">Book Bus</span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <li class="list-header">Booking Status</li>
                        <?php if(Permissions::havePermission('flight-status')): ?>
                            <li>
                                <a href=" <?php echo e(route('booked.flights.list')); ?> ">
                                    <i class="ion-plane"></i>
                                    <span class="menu-title">Booked Flights</span>
                                </a>
                            </li>
                        <?php endif; ?>

                        <?php if(Permissions::havePermission('bus-status')): ?>
                            <li>
                                <a href=" <?php echo e(route('booked.flights.list')); ?> ">
                                    <i class="fa fa-bus"></i>
                                    <span class="menu-title">Booked Busses</span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if(Auth::user()->role_id == 4): ?>
                            <li class="list-divider"></li>
                            <li class="list-header">API Settings</li>
                            <li>
                                <a href=" <?php echo e(route('search.flight')); ?> ">
                                    <i class="ion-plane"></i>
                                    <span class="menu-title">Flight Markups</span>
                                </a>
                            </li>
                            <li>
                                <a href=" <?php echo e(route('bus.markups')); ?> ">
                                    <i class="fa fa-bus"></i>
                                    <span class="menu-title">Buses Markups</span>
                                </a>
                            </li>
                            <li>
                                <a href=" <?php echo e(route('hotel.markups')); ?> ">
                                    <i class="fa fa-hotel"></i>
                                    <span class="menu-title">Hotels Markups</span>
                                </a>
                            </li>
                            <li class="list-divider"></li>
                            <li class="list-header">Accounts</li>
                            <li>
                                <a href="#">
                                    <i class="demo-pli-boot-2"></i>
                                    <span class="menu-title">Sub-Admins</span>
                                    <i class="arrow"></i>
                                </a>
                                <!--Submenu-->
                                <ul class="collapse">
                                    <li><a href="<?php echo e(route('subadmin.list')); ?>">List Admin</a></li>
                                    <li><a href="<?php echo e(route('subadmin.create')); ?>">Add New Admin</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="demo-pli-boot-2"></i>
                                    <span class="menu-title">Employee</span>
                                    <i class="arrow"></i>
                                </a>
                                <!--Submenu-->
                                <ul class="collapse">
                                    <li><a href="<?php echo e(route('employee.list')); ?>">List Employee</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="demo-pli-boot-2"></i>
                                    <span class="menu-title">Roles</span>
                                    <i class="arrow"></i>
                                </a>
                                <!--Submenu-->
                                <ul class="collapse">
                                    <li><a href="<?php echo e(route('roles.list')); ?>">List Roles</a></li>
                                    <li><a href="<?php echo e(route('create.role')); ?>">Add New Role</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="demo-pli-boot-2"></i>
                                    <span class="menu-title">Permissions</span>
                                    <i class="arrow"></i>
                                </a>
                                <!--Submenu-->
                                <ul class="collapse">
                                    <li><a href="<?php echo e(route('permissions.list')); ?>">List Permissions</a></li>
                                </ul>
                            </li>
                        <?php endif; ?>
                        
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>