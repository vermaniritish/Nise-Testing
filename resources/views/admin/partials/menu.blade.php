<div class="collapse navbar-collapse" id="sidenav-collapse-main">
    <ul class="navbar-nav">
        <li class="nav-item">
            <?php $active = strpos(request()->route()->getAction()['as'], 'admin.dashboard') > -1; ?>
            <a class="nav-link<?php echo $active ? ' active' : ''; ?>" href="<?php echo route('admin.dashboard'); ?>">
                <i class="ni ni-tv-2 text-primary"></i>
                <span class="nav-link-text">Dashboard</span>
            </a>
        </li>
        <?php if(Permissions::hasPermission('contact_us', 'listing')): ?>
        <?php $active = strpos(request()->route()->getAction()['as'], 'admin.contactUs') > -1; ?>
        <!-- <li class="nav-item">
            <a class="nav-link<?php echo $active ? ' active' : ''; ?>" href="<?php echo route('admin.contactUs'); ?>">
                <i class="fas fa-id-badge text-primary"></i>
                <span class="nav-link-text">Contact Requests</span>
            </a>
        </li> -->
        <?php endif; ?>

        <!-- <?php if(Permissions::hasPermission('users', 'listing')): ?>
        <?php $active = strpos(request()->route()->getAction()['as'], 'admin.users') > -1; ?>
        <li class="nav-item">
            <a class="nav-link<?php echo $active ? ' active' : ''; ?>" href="<?php echo route('admin.users'); ?>">
                <i class="fa fa-university text-primary"></i>
                <span class="nav-link-text">Institute Management</span>
            </a>
        </li>
        <?php endif; ?> -->
        <!-- <?php if(Permissions::hasPermission('centers', 'listing')): ?>
        <?php $active = strpos(request()->route()->getAction()['as'], 'admin.manageCenter') > -1; ?>
        <li class="nav-item">
            <a class="nav-link<?php echo request()->route()->getAction()['as'] == 'admin.manageCenter' ? ' active' : ''; ?>" href="<?php echo route('admin.manageCenter'); ?>">
                <i class="fa fa-university text-primary"></i>
                <span class="status">Center Management</span>
            </a>
        </li>
        <?php endif; ?> -->
        <!-- <?php if(Permissions::hasPermission('batches', 'listing')): ?>
        <?php $active = strpos(request()->route()->getAction()['as'], 'admin.manageBatche') > -1; ?>
            <li class="nav-item">
                <a class="nav-link<?php echo $active ? ' active' : ''; ?>" href="#submenu_batch" data-toggle="collapse">
                    <i class="fas fa-laptop-code text-primary"></i>
                    <span class="nav-link-text">Batch Management</span>
                </a>
                <ul class="list-unstyled submenu collapse<?php echo $active ? ' show' : ''; ?>" id="submenu_batch">
                    <li class="nav-item">
                        <a class="nav-link<?php echo request()->route()->getAction()['as'] == 'admin.manageBatche' ? ' active' : ''; ?>" href="<?php echo route('admin.manageBatche'); ?>">
                            <span class="badge badge-dot mr-4">
                                <i class="bg-gray"></i>
                                <span class="status">Batch Details</span>
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?php echo request()->route()->getAction()['as'] == 'admin.batche.allocation' ? ' active' : ''; ?>" href="<?php echo route('admin.batche.allocation'); ?>">
                            <span class="badge badge-dot mr-4">
                                <i class="bg-gray"></i>
                                <span class="status">Batche Allocation</span>
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
        <?php endif; ?> -->
        <!-- <?php if(Permissions::hasPermission('participants', 'listing')): ?>
        <?php $active = strpos(request()->route()->getAction()['as'], 'admin.participant') > -1; ?>
        <li class="nav-item">
            <a class="nav-link<?php echo $active ? ' active' : ''; ?>" href="<?php echo route('admin.participant'); ?>">
                <i class="fa fa-building text-primary"></i>
                <span class="nav-link-text">Manage Participants</span>
            </a>
        </li>
        <?php endif; ?> -->
        <?php if(Permissions::hasPermission('batches', 'listing')): ?>
        <?php $active = strpos(request()->route()->getAction()['as'], 'admin.userManagement.partnerTraining') > -1 || strpos(request()->route()->getAction()['as'], 'admin.userManagement.approveCenter') > -1 || strpos(request()->route()->getAction()['as'], 'admin.userManagement.pendingCenter') > -1 || strpos(request()->route()->getAction()['as'], 'admin.userManagement.stateWiseCenter') > -1 || strpos(request()->route()->getAction()['as'], 'admin.userManagement.SuryaInstPasStuDetails') > -1 || strpos(request()->route()->getAction()['as'], 'admin.userManagement.centerWiseBatchDetails') > -1; ?>
            <li class="nav-item">
                <a class="nav-link<?php echo $active ? ' active' : ''; ?>" href="#submenu_user_management" data-toggle="collapse">
                    <i class="fas fa-laptop-code text-primary"></i>
                    <span class="nav-link-text">Reports</span>
                </a>
                <ul class="list-unstyled submenu collapse<?php echo $active ? ' show' : ''; ?>" id="submenu_user_management">
                    <li class="nav-item">
                        <a class="nav-link<?php echo request()->route()->getAction()['as'] == 'admin.userManagement.partnerTraining' ? ' active' : ''; ?>" href="<?php echo route('admin.userManagement.partnerTraining'); ?>">
                            <span class="badge badge-dot mr-4">
                                <i class="bg-gray"></i>
                                <span class="status">Training Partner</span>
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?php echo request()->route()->getAction()['as'] == 'admin.userManagement.approveCenter' ? ' active' : ''; ?>" href="<?php echo route('admin.userManagement.approveCenter'); ?>">
                            <span class="badge badge-dot mr-4">
                                <i class="bg-gray"></i>
                                <span class="status">Approved Center</span>
                            </span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link<?php echo request()->route()->getAction()['as'] == 'admin.userManagement.pendingCenter' ? ' active' : ''; ?>" href="<?php echo route('admin.userManagement.pendingCenter'); ?>">
                            <span class="badge badge-dot mr-4">
                                <i class="bg-gray"></i>
                                <span class="status">Pending Center</span>
                            </span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link<?php echo request()->route()->getAction()['as'] == 'admin.userManagement.stateWiseCenter' ? ' active' : ''; ?>" href="<?php echo route('admin.userManagement.stateWiseCenter'); ?>">
                            <span class="badge badge-dot mr-4">
                                <i class="bg-gray"></i>
                                <span class="status">State Wise Center</span>
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?php echo request()->route()->getAction()['as'] == 'admin.userManagement.SuryaInstPasStuDetails' ? ' active' : ''; ?>" href="<?php echo route('admin.userManagement.SuryaInstPasStuDetails'); ?>">
                            <span class="badge badge-dot mr-4">
                                <i class="bg-gray"></i>
                                <span class="status">Total Passed Students</span>
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?php echo request()->route()->getAction()['as'] == 'admin.userManagement.centerWiseBatchDetails' ? ' active' : ''; ?>" href="<?php echo route('admin.userManagement.centerWiseBatchDetails'); ?>">
                            <span class="badge badge-dot mr-4">
                                <i class="bg-gray"></i>
                                <span class="status">Center Wise Batch Details</span>
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
        <?php endif; ?>
    </ul>

    <hr class="my-3">
    <h6 class="navbar-heading p-0 text-muted">
        <span class="docs-normal">Pages & Content</span>
    </h6>
    <ul class="navbar-nav mb-md-3">
        <?php if(Permissions::hasPermission('states', 'listing') || Permissions::hasPermission('district', 'listing')): ?>
        <?php $active = strpos(request()->route()->getAction()['as'], 'admin.states') > -1 || strpos(request()->route()->getAction()['as'], 'admin.district') > -1; ?>
            <li class="nav-item">
                <a class="nav-link<?php echo $active ? ' active' : ''; ?>" href="#submenu_location" data-toggle="collapse">
                    <i class="fas fa-laptop-code text-primary"></i>
                    <span class="nav-link-text">Manage State/District</span>
                </a>
                <ul class="list-unstyled submenu collapse<?php echo $active ? ' show' : ''; ?>" id="submenu_location">
                    <li class="nav-item">
                        <a class="nav-link<?php echo request()->route()->getAction()['as'] == 'admin.states' ? ' active' : ''; ?>" href="<?php echo route('admin.states'); ?>">
                            <span class="badge badge-dot mr-4">
                                <i class="bg-gray"></i>
                                <span class="status">States</span>
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?php echo request()->route()->getAction()['as'] == 'admin.district' ? ' active' : ''; ?>" href="<?php echo route('admin.district'); ?>">
                            <span class="badge badge-dot mr-4">
                                <i class="bg-gray"></i>
                                <span class="status">District</span>
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
        <?php endif; ?>
        <?php if(Permissions::hasPermission('menu', 'listing')): ?>
        <?php $active = strpos(request()->route()->getAction()['as'], 'admin.menu.add') > -1 || strpos(request()->route()->getAction()['as'], 'admin.menuHindi.add') > -1 || strpos(request()->route()->getAction()['as'], 'admin.editHomePage') > -1 || strpos(request()->route()->getAction()['as'], 'admin.editAaboutUs') > -1 || strpos(request()->route()->getAction()['as'], 'admin.pages') > -1 || strpos(request()->route()->getAction()['as'], 'admin.videoGallery') > -1 || strpos(request()->route()->getAction()['as'], 'admin.gallery') > -1 || strpos(request()->route()->getAction()['as'], 'admin.sliderMenu') > -1 || strpos(request()->route()->getAction()['as'], 'admin.notices') > -1 || strpos(request()->route()->getAction()['as'], 'admin.newsEvents') > -1 || strpos(request()->route()->getAction()['as'], 'admin.states') > -1 || strpos(request()->route()->getAction()['as'], 'admin.district') > -1; ?>
            <li class="nav-item">
                <a class="nav-link<?php echo $active ? ' active' : ''; ?>" href="#submenu_website_cms" data-toggle="collapse">
                    <i class="fas fa-laptop-code text-primary"></i>
                    <span class="nav-link-text">Website CMS</span>
                </a>
                <ul class="list-unstyled submenu collapse<?php echo $active ? ' show' : ''; ?>" id="submenu_website_cms">
                    <li class="nav-item">
                        <a class="nav-link<?php echo $active ? ' active' : ''; ?>" href="<?php echo route('admin.editHomePage'); ?>">
                            <span class="badge badge-dot mr-4">
                                <i class="bg-gray"></i>
                                <span class="status">Home page</span>
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?php echo $active ? ' active' : ''; ?>" href="<?php echo route('admin.editAaboutUs'); ?>">
                            <span class="badge badge-dot mr-4">
                                <i class="bg-gray"></i>
                                <span class="status">About Us</span>
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?php echo $active ? ' active' : ''; ?>" href="<?php echo route('admin.states'); ?>">
                            <span class="badge badge-dot mr-4">
                                <i class="bg-gray"></i>
                                <span class="status">State</span>
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?php echo $active ? ' active' : ''; ?>" href="<?php echo route('admin.district'); ?>">
                            <span class="badge badge-dot mr-4">
                                <i class="bg-gray"></i>
                                <span class="status">District</span>
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?php echo $active ? ' active' : ''; ?>" href="<?php echo route('admin.pages'); ?>">
                            <span class="badge badge-dot mr-4">
                                <i class="bg-gray"></i>
                                <span class="status">Pages</span>
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?php echo $active ? ' active' : ''; ?>" href="<?php echo route('admin.videoGallery'); ?>">
                            <span class="badge badge-dot mr-4">
                                <i class="bg-gray"></i>
                                <span class="status">Video Gallery</span>
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?php echo $active ? ' active' : ''; ?>" href="<?php echo route('admin.gallery'); ?>">
                            <span class="badge badge-dot mr-4">
                                <i class="bg-gray"></i>
                                <span class="status">Image Gallery</span>
                            </span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link<?php echo $active ? ' active' : ''; ?>" href="<?php echo route('admin.sliderMenu'); ?>">
                            <span class="badge badge-dot mr-4">
                                <i class="bg-gray"></i>
                                <span class="status">Slider</span>
                            </span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link<?php echo $active ? ' active' : ''; ?>" href="<?php echo route('admin.notices'); ?>">
                            <span class="badge badge-dot mr-4">
                                <i class="bg-gray"></i>
                                <span class="status">Notices</span>
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?php echo $active ? ' active' : ''; ?>" href="<?php echo route('admin.newsEvents'); ?>">
                            <span class="badge badge-dot mr-4">
                                <i class="bg-gray"></i>
                                <span class="status">News & Events</span>
                            </span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link<?php echo $active ? ' active' : ''; ?>" href="<?php echo route('admin.menu.add'); ?>">
                            <span class="badge badge-dot mr-4">
                                <i class="bg-gray"></i>
                                <span class="status">Menu English</span>
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?php echo $active ? ' active' : ''; ?>" href="<?php echo route('admin.menuHindi.add'); ?>">
                            <span class="badge badge-dot mr-4">
                                <i class="bg-gray"></i>
                                <span class="status">Menu Hindi</span>
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
        <?php endif; ?>
    </ul>
    <!-- Divider -->
    <hr class="my-3">
    <?php if(AdminAuth::isAdmin()): ?>
    <!-- Heading -->
    <h6 class="navbar-heading p-0 text-muted">
        <span class="docs-normal">Others</span>
    </h6>
    <?php endif; ?>
    <!-- Navigation -->
    <ul class="navbar-nav mb-md-3">
        <?php if(AdminAuth::isAdmin()): ?>
        <?php $active = strpos(request()->route()->getAction()['as'], 'admin.settings.home') > -1 || strpos(request()->route()->getAction()['as'], 'admin.searchSugessions') > -1; ?>

        <?php $active = strpos(request()->route()->getAction()['as'], 'admin.emailTemplates') > -1; ?>
        <li class="nav-item">
            <a class="nav-link<?php echo $active ? ' active' : ''; ?>" href="<?php echo route('admin.emailTemplates'); ?>">
                <i class="ni ni-email-83"></i>
                <span class="nav-link-text">Email Templates</span>
            </a>
        </li>
        <?php $active = strpos(request()->route()->getAction()['as'], 'admin.admins') > -1; ?>
        <li class="nav-item">
            <a class="nav-link<?php echo $active ? ' active' : ''; ?>" href="<?php echo route('admin.admins'); ?>">
                <i class="fas fa-users"></i>
                <span class="nav-link-text">Manage Admins</span>
            </a>
        </li>
        <?php $active = strpos(request()->route()->getAction()['as'], 'admin.activities') > -1; ?>
            <li class="nav-item">
                <a class="nav-link<?php echo $active ? ' active' : ''; ?>" href="#submenu_activites" data-toggle="collapse">
                    <i class="ni ni-bullet-list-67"></i>
                    <span class="nav-link-text">Activities</span>
                </a>
                <ul class="list-unstyled submenu collapse<?php echo $active ? ' show' : ''; ?>" id="submenu_activites">
                    <li class="nav-item">
                        <a class="nav-link<?php echo request()->route()->getAction()['as'] == 'admin.activities.emails' ? ' active' : ''; ?>" href="<?php echo route('admin.activities.emails'); ?>">
                            <span class="badge badge-dot mr-4">
                                <i class="bg-gray"></i>
                                <span class="status">Email Logs</span>
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?php echo request()->route()->getAction()['as'] == 'admin.activities.userLogs' ? ' active' : ''; ?>" href="<?php echo route('admin.activities.userLogs'); ?>">
                            <span class="badge badge-dot mr-4">
                                <i class="bg-gray"></i>
                                <span class="status">User Logs</span>
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link<?php echo $active ? ' active' : ''; ?>" href="<?php echo route('admin.settings'); ?>">
                    <i class="fas fa-cog"></i>
                    <span class="nav-link-text">Settings</span>
                </a>
            </li>
        <?php endif; ?>
    </ul>
</div>
