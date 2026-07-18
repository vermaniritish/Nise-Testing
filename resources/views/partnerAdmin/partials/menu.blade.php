<div class="collapse navbar-collapse" id="sidenav-collapse-main">
    <ul class="navbar-nav">
        <li class="nav-item">
            <?php $active = strpos(request()->route()->getAction()['as'], 'partner.dashboard') > -1; ?>
            <a class="nav-link<?php echo $active ? ' active' : ''; ?>" href="<?php echo route('partner.dashboard'); ?>">
                <i class="ni ni-tv-2 text-primary"></i>
                <span class="nav-link-text">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <?php $active = strpos(request()->route()->getAction()['as'], 'partnerAdmin.testManagements') > -1; ?>
            <a class="nav-link <?php echo $active ? ' active' : ''; ?>" href="{{route('partnerAdmin.testManagements')}}">
                <i class="fa fa-building text-primary"></i>
                <span class="nav-link-text">Test Managements</span>
            </a>
        </li>
    </ul>
</div>
