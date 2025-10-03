    <?php require_once 'header.php'; ?>
    <?php require_once 'left.php'; ?>
    <?php require_once 'header-bottom.php'; ?>

    <!-- Page content -->
    <div class="container-fluid mt-2">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <?php 
                $title = "Footer Top Menu";
                $heading = "Enter menu information";
                $menu = [
                    'About us',
                    'Tenders',
                    'Contact us',
                    'Organization',
                    'Chart',
                    'Feedback',
                    'Visitor',
                    'Summary',
                    'Help',
                    'Terms and Condition',
                    'Privacy Policy',
                    'Copyright Policy',
                    'Disclaimer',
                    'Sitemap',
                ];
                require_once 'menu.php'; ?>
            </div>
        </div>
    </div>
    </section>
    <!-- Content -->

    <?php require_once 'footer.php'; ?>