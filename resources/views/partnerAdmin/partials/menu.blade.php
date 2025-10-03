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
            <?php $active = strpos(request()->route()->getAction()['as'], 'partnerAdmin.manageCenter') > -1; ?>
            <a class="nav-link <?php echo $active ? ' active' : ''; ?>" href="{{route('partnerAdmin.manageCenter')}}">
                <i class="fa fa-building text-primary"></i>
                <span class="nav-link-text">Manage Center</span>
            </a>
        </li>
        <li class="nav-item">
            <?php $active = strpos(request()->route()->getAction()['as'], 'partnerAdmin.manageBatche') > -1; ?>
            <a class="nav-link <?php echo $active ? ' active' : ''; ?>" href="{{route('partnerAdmin.manageBatche')}}">
                <i class="fas fa-users-class text-primary"></i>
                <span class="nav-link-text">Batch Management</span>
            </a>
        </li>
        <li class="nav-item">
            <?php $active = strpos(request()->route()->getAction()['as'], 'partnerAdmin.participant') > -1; ?>
            <a class="nav-link <?php echo $active ? ' active' : ''; ?>" href="{{route('partnerAdmin.participant')}}">
                <i class="fas fa-users text-primary"></i>
                <span class="nav-link-text">Participant Management</span>
            </a>
        </li>
    </ul>
</div>
