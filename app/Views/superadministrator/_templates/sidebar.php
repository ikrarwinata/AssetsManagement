<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="assets/img/asset.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Assets Management</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column text-sm nav-flat nav-legacy nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="<?php echo (base_url('superadministrator/Dashboard/index')) ?>" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p><?php echo (lang('Sidebar.Dashboard', [], $Page->locale)) ?></p>
                    </a>
                </li>

                <li class="nav-header">Data Managent</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cube"></i>
                        <p>
                            <?php echo (lang('Sidebar.Assets', [], $Page->locale)) ?>
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo (base_url('superadministrator/Master/index')) ?>" class="nav-link">
                                <i class="fa fa-cubes nav-icon"></i>
                                <p><?php echo (lang('Sidebar.AllAssets', [], $Page->locale)) ?></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo (base_url('superadministrator/Master/sold')) ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?php echo (lang('Sidebar.AssetsSold', [], $Page->locale)) ?></p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-hand-holding-usd"></i>
                        <p>
                            <?php echo (lang('Sidebar.DataTransaction', [], $Page->locale)) ?>
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo (base_url('superadministrator/Purchases/index')) ?>" class="nav-link">
                                <i class="fa fa-people-carry nav-icon"></i>
                                <p><?php echo (lang('Sidebar.Purchases', [], $Page->locale)) ?></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo (base_url('superadministrator/Sales/index')) ?>" class="nav-link">
                                <i class="fa fa-dolly-flatbed nav-icon"></i>
                                <p><?php echo (lang('Sidebar.Sales', [], $Page->locale)) ?></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo (base_url('superadministrator/Master/history')) ?>" class="nav-link">
                                <i class="fa fa-list nav-icon"></i>
                                <p><?php echo (lang('Sidebar.AllHistory', [], $Page->locale)) ?></p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="<?php echo (base_url('superadministrator/Category/index')) ?>" class="nav-link">
                        <i class="nav-icon fas fa-wine-glass"></i>
                        <p><?php echo (lang('Sidebar.Categorys', [], $Page->locale)) ?></p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo (base_url('superadministrator/Dashboard/profit')) ?>" class="nav-link">
                        <i class="nav-icon fas fa-list-alt"></i>
                        <p><?php echo (lang('Sidebar.ProfitLoss', [], $Page->locale)) ?></p>
                    </a>
                </li>

                <li class="nav-header"><?php echo (lang('Sidebar.Transaction', [], $Page->locale)) ?></li>
                <li class="nav-item">
                    <a href="<?php echo (base_url('superadministrator/Purchases/create')) ?>" class="nav-link">
                        <i class="nav-icon fas fa-inbox"></i>
                        <p><?php echo (lang('Sidebar.PurchaseItem', [], $Page->locale)) ?></p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo (base_url('superadministrator/Sales/index')) ?>" class="nav-link">
                        <i class="nav-icon fas fa-cash-register"></i>
                        <p><?php echo (lang('Sidebar.SaleItem', [], $Page->locale)) ?></p>
                    </a>
                </li>

                <li class="nav-header"><?php echo (lang('Sidebar.Operation', [], $Page->locale)) ?></li>
                <li class="nav-item">
                    <a href="<?php echo (base_url('superadministrator/Dashboard/prices')) ?>" class="nav-link">
                        <i class="fa fa-tags nav-icon"></i>
                        <p>
                            <p><?php echo (lang('Sidebar.PriceAdjustment', [], $Page->locale)) ?></p>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo (base_url('superadministrator/Dashboard/truncate')) ?>" class="nav-link">
                        <i class="nav-icon fas fa-trash"></i>
                        <p>
                            <?php echo (lang('Sidebar.Truncate', [], $Page->locale)) ?>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo (base_url('superadministrator/Dashboard/simulation')) ?>" class="nav-link">
                        <i class="nav-icon fas fa-circle"></i>
                        <p>
                            <?php echo (lang('Sidebar.Simulation', [], $Page->locale)) ?>
                        </p>
                    </a>
                </li>

                <li class="nav-header">Account Managent</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            <?php echo (lang('Sidebar.UserAccount', [], $Page->locale)) ?>
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo (base_url('superadministrator/Users_account/index/superadministrator')) ?>" class="nav-link">
                                <i class="fa fa-user nav-icon"></i>
                                <p>Superadministrator</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo (base_url('superadministrator/Users_account/index/administrator')) ?>" class="nav-link">
                                <i class="fa fa-user nav-icon"></i>
                                <p>Administrator</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo (base_url('superadministrator/Users_account/index/user')) ?>" class="nav-link">
                                <i class="fa fa-user nav-icon"></i>
                                <p>User</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo (base_url('superadministrator/Users_account/index')) ?>" class="nav-link">
                                <i class="fa fa-circle nav-icon"></i>
                                <p><?php echo (lang('Sidebar.AllUser', [], 'locale')) ?></p>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>