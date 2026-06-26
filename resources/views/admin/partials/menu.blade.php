<?php use App\Models\Admin\TestingService; ?>
<?php
    $testServices = TestingService::orderBy('id', 'ASC')->get();
?>
<div class="collapse navbar-collapse" id="sidenav-collapse-main">
    <ul class="navbar-nav">
        <li class="nav-item">
            <?php $active = strpos(request()->route()->getAction()['as'], 'admin.dashboard') > -1; ?>
            <a class="nav-link<?php echo $active ? ' active' : ''; ?>" href="<?php echo route('admin.dashboard'); ?>">
                <i class="ni ni-tv-2 text-primary"></i>
                <span class="nav-link-text">Dashboard</span>
            </a>
        </li>
        <?php if(Permissions::hasPermission('order_tests', 'listing')): ?>
        <?php $active = strpos(request()->route()->getAction()['as'], 'admin.testManagements') > -1; ?>
        <li class="nav-item">
            <a class="nav-link<?php echo $active ? ' active' : ''; ?>" href="<?php echo route('admin.testManagements'); ?>">
                <i class="fa fa-cart-arrow-down text-primary"></i>
                <span class="nav-link-text">Test Request</span>
            </a>
        </li>
        <?php endif; ?>
        <?php if(Permissions::hasPermission('admins', 'listing')): ?>
        <?php $active = strpos(request()->route()->getAction()['as'], 'admin.admins') > -1; ?>
        <li class="nav-item">
            <a class="nav-link<?php echo $active ? ' active' : ''; ?>" href="<?php echo route('admin.admins'); ?>">
                <i class="fas fa-flask text-primary"></i>
                <span class="nav-link-text">Lab Management</span>
            </a>
        </li>
        <?php endif; ?>
        <?php if(Permissions::hasPermission('users', 'listing')): ?>
        <?php $active = strpos(request()->route()->getAction()['as'], 'admin.users') > -1; ?>
        <li class="nav-item">
            <a class="nav-link<?php echo $active ? ' active' : ''; ?>" href="<?php echo route('admin.users'); ?>">
                <i class="fas fa-users text-primary"></i>
                <span class="nav-link-text">Registered Users</span>
            </a>
        </li>
        <?php endif; ?>
    </ul>
    <?php if(Permissions::hasPermission('testing_services', 'listing') || Permissions::hasPermission('testing_service_contents', 'listing') || Permissions::hasPermission('testing_service_categories', 'listing') || Permissions::hasPermission('service_category_wise_tests', 'listing')): ?>
    <hr class="my-3">
    <h6 class="navbar-heading p-0 text-muted">
        <span class="docs-normal">Tests Content</span>
    </h6>
    <?php endif; ?>
    <ul class="navbar-nav">
        <?php if(Permissions::hasPermission('testing_services', 'listing')): ?>
        <?php $active = strpos(request()->route()->getAction()['as'], 'admin.testingService') > -1; ?>
        <li class="nav-item">
            <a class="nav-link<?php echo $active ? ' active' : ''; ?>" href="<?php echo route('admin.testingService'); ?>">
                <i class="ni ni-bullet-list-67 text-primary"></i>
                <span class="nav-link-text">Test Services</span>
            </a>
        </li>
        <?php endif; ?>
        <?php if(Permissions::hasPermission('testing_service_contents', 'listing')): ?>
            <?php $active = strpos(request()->route()->getAction()['as'], 'admin.testingServiceContent.edit') > -1; ?>
        <li class="nav-item">
            <a class="nav-link<?php echo $active ? ' active' : ''; ?>" href="#submenu_test_content" data-toggle="collapse">
                <i class="fas fa-laptop-code text-primary"></i>
                <span class="nav-link-text">Test Services Content</span>
            </a>
            <ul class="list-unstyled submenu collapse<?php echo $active ? ' show' : ''; ?>" id="submenu_test_content">
                @if(isset($testServices) && $testServices)
                    @foreach($testServices as $k => $testService)
                        <li class="nav-item">
                            <a class="nav-link{{ request()->route()->getAction()['as'] == 'admin.testingServiceContent.edit' ? ' active' : '' }}"
                               href="{{ route('admin.testingServiceContent.edit', ['slug' => $testService->slug]) }}">
                                <span class="badge badge-dot mr-4">
                                    <i class="bg-gray"></i>
                                    <span class="status">{{ $testService->title }}</span>
                                </span>
                            </a>
                        </li>
                    @endforeach
                @endif
            </ul>
        </li>
        <?php endif; ?>
        <?php if(Permissions::hasPermission('testing_service_categories', 'listing')): ?>
        <?php $active = strpos(request()->route()->getAction()['as'], 'admin.testServiceCategories') > -1; ?>
        <li class="nav-item">
            <a class="nav-link<?php echo $active ? ' active' : ''; ?>" href="<?php echo route('admin.testServiceCategories'); ?>">
                <i class="ni ni-bullet-list-67 text-primary"></i>
                <span class="nav-link-text">Test Service Categories</span>
            </a>
        </li>
        <?php endif; ?>
        <?php if(Permissions::hasPermission('service_category_wise_tests', 'listing')): ?>
        <?php $active = strpos(request()->route()->getAction()['as'], 'admin.serviceCategoryWiseTests') > -1; ?>
        <li class="nav-item">
            <a class="nav-link<?php echo $active ? ' active' : ''; ?>" href="<?php echo route('admin.serviceCategoryWiseTests'); ?>">
                <i class="ni ni-bullet-list-67 text-primary"></i>
                <span class="nav-link-text">Service Category Wise Tests</span>
            </a>
        </li>
        <?php endif; ?>
    </ul>
    <?php if(Permissions::hasPermission('states', 'listing') || Permissions::hasPermission('district', 'listing')): ?>
    <hr class="my-3">
    <h6 class="navbar-heading p-0 text-muted">
        <span class="docs-normal">Pages & Content</span>
    </h6>
    <?php endif; ?>
    <ul class="navbar-nav mb-md-3">
        <?php if(Permissions::hasPermission('states', 'listing') || Permissions::hasPermission('district', 'listing')): ?>
        <?php $active = strpos(request()->route()->getAction()['as'], 'admin.states') > -1 || strpos(request()->route()->getAction()['as'], 'admin.district') > -1; ?>
            <li class="nav-item">
                <a class="nav-link<?php echo $active ? ' active' : ''; ?>" href="#submenu_location" data-toggle="collapse">
                    <i class="fas fa-laptop-code text-primary"></i>
                    <span class="nav-link-text">Manage State/District</span>
                </a>
                <ul class="list-unstyled submenu collapse<?php echo $active ? ' show' : ''; ?>" id="submenu_location">
                    <?php if(Permissions::hasPermission('states', 'listing')): ?>
                    <li class="nav-item">
                        <a class="nav-link<?php echo request()->route()->getAction()['as'] == 'admin.states' ? ' active' : ''; ?>" href="<?php echo route('admin.states'); ?>">
                            <span class="badge badge-dot mr-4">
                                <i class="bg-gray"></i>
                                <span class="status">States</span>
                            </span>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if(Permissions::hasPermission('district', 'listing')): ?>
                    <li class="nav-item">
                        <a class="nav-link<?php echo request()->route()->getAction()['as'] == 'admin.district' ? ' active' : ''; ?>" href="<?php echo route('admin.district'); ?>">
                            <span class="badge badge-dot mr-4">
                                <i class="bg-gray"></i>
                                <span class="status">District</span>
                            </span>
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </li>
        <?php endif; ?>
        <?php if(Permissions::hasPermission('home_page', 'update')): ?>
        <?php $active = strpos(request()->route()->getAction()['as'], 'admin.menu.add') > -1 || strpos(request()->route()->getAction()['as'], 'admin.menuHindi.add') > -1 || strpos(request()->route()->getAction()['as'], 'admin.editHomePage') > -1 || strpos(request()->route()->getAction()['as'], 'admin.editAaboutUs') > -1 || strpos(request()->route()->getAction()['as'], 'admin.pages') > -1 || strpos(request()->route()->getAction()['as'], 'admin.sliderMenu') > -1; ?>
            <li class="nav-item">
                <a class="nav-link<?php echo $active ? ' active' : ''; ?>" href="#submenu_website_cms" data-toggle="collapse">
                    <i class="fas fa-laptop-code text-primary"></i>
                    <span class="nav-link-text">Website CMS</span>
                </a>
                <ul class="list-unstyled submenu collapse<?php echo $active ? ' show' : ''; ?>" id="submenu_website_cms">
                    @if(Permissions::hasPermission('menu', 'update'))
                    <li class="nav-item">
                        <a class="nav-link<?php echo $active ? ' active' : ''; ?>" href="<?php echo route('admin.menu.add'); ?>">
                            <span class="badge badge-dot mr-4">
                                <i class="bg-gray"></i>
                                <span class="status">Header Menu</span>
                            </span>
                        </a>
                    </li>
                    @endif
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
                    @if(Permissions::hasPermission('pages', 'listing'))
                    <li class="nav-item">
                        <a class="nav-link<?php echo $active ? ' active' : ''; ?>" href="<?php echo route('admin.pages'); ?>">
                            <span class="badge badge-dot mr-4">
                                <i class="bg-gray"></i>
                                <span class="status">Pages</span>
                            </span>
                        </a>
                    </li>
                    @endif
                    @if(Permissions::hasPermission('slider_menu', 'listing'))
                    <li class="nav-item">
                        <a class="nav-link<?php echo $active ? ' active' : ''; ?>" href="<?php echo route('admin.sliderMenu'); ?>">
                            <span class="badge badge-dot mr-4">
                                <i class="bg-gray"></i>
                                <span class="status">Slider</span>
                            </span>
                        </a>
                    </li>
                    @endif
                    @if(Permissions::hasPermission('notices', 'listing'))
                    <li class="nav-item">
                        <a class="nav-link<?php echo $active ? ' active' : ''; ?>" href="<?php echo route('admin.notices'); ?>">
                            <span class="badge badge-dot mr-4">
                                <i class="bg-gray"></i>
                                <span class="status">Notices</span>
                            </span>
                        </a>
                    </li>
                    @endif
                    
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
