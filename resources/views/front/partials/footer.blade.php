<?php 
	use App\Models\Admin\CustomPageData;
	use App\Models\Admin\Menu;
	use App\Models\Admin\MenuHindi;
	use App\Models\Admin\Users;
	use App\Models\Admin\Admins;
	use App\Models\Admin\Pages;
?>
<?php 
	$logos = CustomPageData::get('logos');
	$logos = $logos ? json_decode($logos, true) : null;
	$totalUnique = \App\Models\Admin\Visitor::distinct('ip_address')->count('ip_address');
	$lastUpdate = Admins::select(['last_login'])->orderBy('last_login', 'desc')->limit(1)->pluck('last_login')->first();
	$disclaimerStatus = Pages::where('slug','disclaimer')->first();
	$privacyPolicyStatus = Pages::where('slug','privacy-policy')->first();
	$siteMapStatus = Pages::where('slug','site-map')->first();

?>
<style>
	.recTitle a {
	    color: #fff;
	    font-weight: bold;
	    text-decoration: none;  /* remove default underline */
	    display: block;
	    padding: 8px 0;
	    /*border-bottom: 1px solid #6c6c6c; /* underline effect */
	}

	.recTitle a:hover {
	    color: #d4b32c;  /* hover color */
	    border-bottom-color: #d4b32c; /* underline changes color */
	}
</style>
@if($logos)
	<!-- START CLIENT SECTION -->
    <div id="client" class="client-section-padding">
        <div class="container">
			<div class="row">
				<div class="col-lg-12 text-center">
					<div class="client-slider owl-carousel owl-theme">
						@foreach($logos as $l)
						<div class="single-client">
                            <a href="#"><img class="img-fluid" src="{{ url($l) }}" alt=""></a>
                        </div>
						@endforeach
					</div>
				</div>
			</div>
        </div>
        <!--- END CONTAINER -->
    </div>
    <!-- END CLIENT SECTION -->
@endif
	<!-- START CALLTOACTION SECTION -->
	<?php
		$yellowTitleEn  = CustomPageData::get('yellow_title');
		$yellowTitleHi  = CustomPageData::get('yellow_title_hi');

		$yellowHeadingEn  = CustomPageData::get('yellow_heading');
		$yellowHeadingHi  = CustomPageData::get('yellow_heading_hi');

		$yellowButtonTextEn  = CustomPageData::get('yellow_button_text');
		$yellowButtonTextHi  = CustomPageData::get('yellow_button_text_hi');
	?>
	@if(CustomPageData::get('yellow_button') == 1)
	<section id="calltoaction" class="calltoaction-padding section-padding bg-theme">
		<div class="auto-container">
			<div class="row">
				<div class="col-lg-8 col-md-8 col-sm-12 col-12 mb-lg-0 mb-md-4 mb-sm-4 mb-4">
					<div class="calltoaction-two-wrap">
						<h4>
							<span class="lang-en">{{ $yellowTitleEn }}</span>
						    <span class="lang-hi" style="display:none;">{{ $yellowTitleHi }}</span>
						</h4>
						<p style="color:#fff;">
							<span class="lang-en">{{ $yellowHeadingEn }}</span>
						    <span class="lang-hi" style="display:none;">{{ $yellowHeadingHi }}</span>
						</p>
					</div>
				</div>
				<!-- end col -->
				@if(CustomPageData::get('yellow_button') == 1)
				<div class="col-lg-4 col-md-4 col-sm-12 col-12 mt-lg-4 mt-md-4 text-lg-right text-md-right text-sm-left text-left">
					<a href="<?php echo CustomPageData::get('yellow_button_link') ?>" class="btn-style btn-border btn-border-3"><span class="lang-en">{{ $yellowButtonTextEn }}</span>
						<span class="lang-hi" style="display:none;">{{ $yellowButtonTextHi }}</span>
					</a>
				</div>
				@endif
				<!-- end col -->
			</div>
			<!-- end row-->
		</div>
	</section>
	@endif
    <?php
		$footerAboutLink = Menu::where('slug', 'footer')
            ->get();
	?>
    <footer>
        <div class="footer-top overlay section-back-image-2">
            <div class="auto-container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-12 col-12 mb-lg-0 mb-md-5 mb-5 footer-widget">
                        <div class="footer-section-title col-12 no-padding">
                            <h3>About Us</h3>
                        </div>
                        <!-- END SECTION TITLE -->
						<div class="col-12 footer-widget-inner">
							<ul class="quick-link-list">
								@foreach($footerAboutLink as $linkEn)
							        <li><a href="{{ $linkEn->value }}"><i class="fa fa-chevron-circle-right"></i> {{ $linkEn->key }}</a></li>
							    @endforeach
							</ul>
						</div>	
                    </div>
                    <?php
						$footerDepartmentLink = Menu::where('slug', 'courses')
				            ->get();
					?>
                    <!-- End Widget -->
                    <div class="col-lg-3 col-md-6 col-sm-12 col-12 mb-lg-0 mb-md-5 mb-5 footer-widget">
                        <div class="footer-section-title col-12 no-padding">
                            <h3>Departments</h3>
                        </div>
                        <!-- END SECTION TITLE -->
						<div class="col-12 footer-widget-inner">
							<ul class="quick-link-list">
								@foreach($footerDepartmentLink as $Deplink)
							        <li><a href="{{ $Deplink->value }}"><i class="fa fa-chevron-circle-right"></i> {{ $Deplink->key }}</a></li>
							    @endforeach
							</ul>
						</div>	
                    </div>
					<?php
						$footerInformationLink = Menu::where('slug', 'information')
				            ->get();
					?>
					<div class="col-lg-3 col-md-6 col-sm-12 col-12 mb-lg-0 mb-md-5 mb-5 footer-widget">
                        <div class="footer-section-title col-12 no-padding">
                            <h3>Information</h3>
                        </div>
                        <!-- END SECTION TITLE -->
						<div class="col-12 footer-widget-inner">
							<ul class="quick-link-list">
								@foreach($footerInformationLink as $Inforlink)
							        <li><a href="{{ $Inforlink->value }}"><i class="fa fa-chevron-circle-right"></i> {{ $Inforlink->key }}</a></li>
							    @endforeach
							</ul>
						</div>	
                    </div>
                    <?php
						$footerOtherLinksLink = Menu::where('slug', 'other_links')
				            ->get();
					?>
                    <div class="col-lg-3 col-md-6 col-sm-12 col-12 mb-lg-0 mb-md-5 mb-5 footer-widget">
                        <div class="footer-section-title col-12 no-padding">
                            <h3>Other Links</h3>
                        </div>
                        <!-- END SECTION TITLE -->
						<div class="col-12 footer-widget-inner">
							<ul class="quick-link-list">
								@foreach($footerOtherLinksLink as $Otherlink)
							        <li><a href="{{ $Otherlink->value }}"><i class="fa fa-chevron-circle-right"></i> {{ $Otherlink->key }}</a></li>
							    @endforeach
							</ul>
						</div>	
                    </div>
                    <!-- End Widget -->
                </div>
            </div>
        </div>
        
        <div class="copyright">
            <div class="auto-container">
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-sm-12 col-12 mb-lg-0 mb-md-0 mb-4 footer-menu text-center text-lg-left text-md-left">
                        <ul>
                            @if(isset($disclaimerStatus->status) && $disclaimerStatus->status == 1)
                            <li>
                            	<a href="{{route('screenReaderDetail',['slug' => 'disclaimer'])}}">Disclaimer</a> 
                            </li>
                            @endif
                            @if(isset($siteMapStatus->status) && $siteMapStatus->status == 1)
                            <li>
                            	<a href="{{route('screenReaderDetail',['slug' => 'site-map'])}}">Site Map</a> 
                            </li>
                            @endif
                        </ul>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-12 col-12 copyright-text text-center text-lg-right text-md-right">
                        <p>Copyright &copy; {{ date('Y') }} <a href="#"> National Institute of Solar Energy </a> | All Rights Reserved</p>
                    </div>
                </div>
            </div>
        </div>
		
    </footer>