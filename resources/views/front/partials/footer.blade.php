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
	<!-- <section id="calltoaction" class="calltoaction-padding section-padding bg-theme">
		<div class="auto-container">
			<div class="row">
				<div class="col-12 mx-auto text-center">
					<div class="calltoaction-two-wrap mb-4">
						<h3>
							<span class="lang-en">{{ $yellowTitleEn }}</span>
						    <span class="lang-hi" style="display:none;">{{ $yellowTitleHi }}</span>
						</h3>
						<p style="color:#000;">
							<span class="lang-en">{{ $yellowHeadingEn }}</span>
						    <span class="lang-hi" style="display:none;">{{ $yellowHeadingHi }}</span>
						</p>
					</div>
					@if(CustomPageData::get('yellow_button') == 1)
					<a href="<?php echo CustomPageData::get('yellow_button_link') ?>" class="wow fadeInDown btn-style btn-border btn-border-3">
							<span class="lang-en">{{ $yellowButtonTextEn }}</span>
						    <span class="lang-hi" style="display:none;">{{ $yellowButtonTextHi }}</span>
					    <i class="icofont icofont-hand-right"></i></a>
					@endif
				</div>
			</div>
		</div>
	</section> -->
	@endif
    <!-- END CALLTOACTION SECTION -->

<!-- START FOOTER -->
    <!-- <footer>
        <div class="footer-top overlay section-back-image-2">
            <div class="auto-container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-12 col-12 mb-lg-0 mb-md-5 mb-5 footer-widget">
                        <div class="footer-logo col-12 p-0">
                            <a href="#">
								<div class="footer-logo-text lang-en">
                                    <h3>Trainings</h3>
                                    <p>National Institute of Solar Energy</p>
                                </div>
                                <div class="footer-logo-text lang-hi" style="display:none;">
                                    <h3>प्रशिक्षण</h3>
                                    <p>राष्ट्रीय सौर ऊर्जा संस्थान</p>
                                </div>
							</a>
                        </div>
						<div class="about mb-2 lang-en">
                            <p>NISE offers specialized trainings on solar energy technologies, focusing on solar PV, solar thermal systems, and emerging renewable solutions. These programs are designed to build capacity, enhance technical skills, and promote innovation in the renewable energy sector. By partnering with industry experts and government initiatives, NISE empowers professionals and students to contribute to India’s sustainable energy future.
							<br/><br/>
							<small>Contents published and managed by NISE.</small><br/>
							<small><i>Last Updated: <span style="color: #f7921a;"><b>{{ _d($lastUpdate) }}</b></span></i><br/>Unique Visitors: <span style="color: #f7921a;"><b>{{$totalUnique}}</b></span></small>
							</p>
                        </div>
                        <div class="about mb-2 lang-hi" style="display:none;">
                            <p>एनआईएसई सौर ऊर्जा प्रौद्योगिकियों पर विशेष प्रशिक्षण प्रदान करता है, जिसमें सौर पीवी, सौर तापीय प्रणालियाँ और उभरते नवीकरणीय समाधान शामिल हैं। ये कार्यक्रम क्षमता निर्माण, तकनीकी कौशल विकास और नवीकरणीय ऊर्जा क्षेत्र में नवाचार को बढ़ावा देने के लिए तैयार किए गए हैं। उद्योग विशेषज्ञों और सरकारी पहलों के सहयोग से, एनआईएसई पेशेवरों और छात्रों को भारत के सतत ऊर्जा भविष्य में योगदान करने के लिए सशक्त बनाता है।
							<br/><br/>
							<small>सामग्री एनआईएसई द्वारा प्रकाशित और प्रबंधित। </small><br/>
							<small><i>अंतिम अद्यतन: <span style="color: #f7921a;"><b>{{ _d($lastUpdate) }}</b></span></i><br/>विशिष्ट आगंतुक: <span style="color: #f7921a;"><b>{{$totalUnique}}</b></span></small>
							</p>
                        </div>
                        
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 col-12 mb-lg-0 mb-md-5 mb-5 footer-widget">
                        <div class="footer-section-title col-12 no-padding">
                            <h3>Quick Links</h3>
                        </div>
						<div class="col-12 footer-widget-inner">
							<?php
								$footerQuickLinkEn = Menu::where('slug', 'footer')
				                    ->get();

				                $footerQuickLinkHi = MenuHindi::where('slug', 'footer')
				                    ->get();
							?>
							<ul class="quick-link-list lang-en">
							    @foreach($footerQuickLinkEn as $linkEn)
							        <li>
							            <a href="{{ $linkEn->value }}">
							                <span class="lang-en">{{ $linkEn->key }}</span>
							            </a>
							        </li>
							    @endforeach
							</ul>

							<ul class="quick-link-list lang-hi" style="display:none;">
							    @foreach($footerQuickLinkHi as $linkHi)
							        <li>
							            <a href="{{ $linkHi->value }}">
							                <span class="lang-hi" style="display:none;">{{ $linkHi->key }}</span>
							            </a>
							        </li>
							    @endforeach
							</ul>
						</div>	
                    </div>
                    <?php
                    	$footerCourseLinkEn = Menu::where('slug', 'courses')
				                    ->get();

				        $footerCourseLinkHi = MenuHindi::where('slug', 'courses')
				                    ->get(); 
                    ?>
                    <div class="col-lg-3 col-md-6 col-sm-12 col-12 mb-lg-0 mb-md-0 mb-5 footer-widget">
                        <div class="footer-section-title col-12 no-padding">
                            <h3>Gallery & Events</h3>
                        </div>
						<div class="col-12 footer-widget-inner recentPost">
							@foreach($footerCourseLinkEn as $courseLinkEn)
								<div class="singleRecpost lang-en">
									<h6 class="recTitle">
										<a href="{{ $courseLinkEn->value }}">{{ $courseLinkEn->key }}</a>
									</h6>
								</div>
							@endforeach

							@foreach($footerCourseLinkHi as $courseLinkHi)
								<div class="singleRecpost lang-hi" style="display:none;">
									<h6 class="recTitle">
										<a href="{{ $courseLinkHi->value }}">{{ $courseLinkHi->key }}</a>
									</h6>
								</div>
							@endforeach
						</div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 col-12 mb-0 footer-widget">
                        <div class="footer-section-title col-12 no-padding">
                            <h3>Contact Us</h3>
                        </div>
						<div class="col-12 footer-widget-inner">
							<div class="single-fcontact mb-2">
								<div class="single-fcontact-icon">
									<i class="icofont icofont-pin"></i>
								</div>
								<div class="single-fcontact-des">
									<h6>National Institute of Solar Energy</h6>
									<p>Gwal Pahari,Faridabad Gurugram Road<br/>Gurugram 122003, Haryana.</p>
								</div>
							</div>
							<div class="single-fcontact mb-2">
								<div class="single-fcontact-icon">
									<i class="icofont icofont-mobile-phone"></i>
								</div>
								<div class="single-fcontact-des">
									<h6>Phone Number:</h6>
									<p>0124-2853039</p>
								</div>
							</div>
							<div class="single-fcontact">
								<div class="single-fcontact-icon">
									<i class="icofont icofont-email"></i>
								</div>
								<div class="single-fcontact-des">
									<h6>Email:</h6>
									<p>suryamitra@nise.res.in</p>
								</div>
							</div>
						</div>
						<div class="col-12 mt-4 footer-social-war">
							<div class="footer-social">
								<ul>
									<li><a href="#"><i class="icofont icofont-social-facebook"></i></a></li>
									<li><a href="#"><i class="icofont icofont-social-twitter"></i></a></li>
									<li><a href="#"><i class="icofont icofont-social-youtube"></i></a></li>
									
								</ul>
							</div>
						</div>
                    </div>
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
                            @if(isset($privacyPolicyStatus->status) && $privacyPolicyStatus->status == 1)
                            <li>
                            	<a href="{{route('screenReaderDetail',['slug' => 'privacy-policy'])}}">Copyright & Privacy Policy</a> 
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
                        <p>Copyright &copy; 2024 <a href="#"> National Institute of Solar Energy </a> | All Rights Reserved</p>
                    </div>
                </div>
            </div>
        </div>
		
    </footer> -->

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
								<li><a href="#"><i class="fa fa-chevron-circle-right"></i> About NISE</a></li>
								<li><a href="#"><i class="fa fa-chevron-circle-right"></i> Directors General’s message</a></li>
								<li><a href="#"><i class="fa fa-chevron-circle-right"></i> Organisation chart</a></li>
								<li><a href="#"><i class="fa fa-chevron-circle-right"></i> Staff profile</a></li>
							</ul>
						</div>	
                    </div>
                    <!-- End Widget -->
                    <div class="col-lg-3 col-md-6 col-sm-12 col-12 mb-lg-0 mb-md-5 mb-5 footer-widget">
                        <div class="footer-section-title col-12 no-padding">
                            <h3>Departments</h3>
                        </div>
                        <!-- END SECTION TITLE -->
						<div class="col-12 footer-widget-inner">
							<ul class="quick-link-list">
								<li><a href="#"><i class="fa fa-chevron-circle-right"></i> Solar Photovoltaic Division</a></li>
								<li><a href="#"><i class="fa fa-chevron-circle-right"></i> PV module, systems & BOS Testing</a></li>
								<li><a href="#"><i class="fa fa-chevron-circle-right"></i> Solar Thermal Division</a></li>
								<li><a href="#"><i class="fa fa-chevron-circle-right"></i> Skill Development & Consultancy</a></li>
								<li><a href="#"><i class="fa fa-chevron-circle-right"></i> Solar Resource Assessment Division</a></li>
								<li><a href="#"><i class="fa fa-chevron-circle-right"></i> Research & Development Cell</a></li>
								
							</ul>
						</div>	
                    </div>
					
					<div class="col-lg-3 col-md-6 col-sm-12 col-12 mb-lg-0 mb-md-5 mb-5 footer-widget">
                        <div class="footer-section-title col-12 no-padding">
                            <h3>Information</h3>
                        </div>
                        <!-- END SECTION TITLE -->
						<div class="col-12 footer-widget-inner">
							<ul class="quick-link-list">
								<li><a href="#"><i class="fa fa-chevron-circle-right"></i> MNRE Guidelines for Testing</a></li>
								<li><a href="#"><i class="fa fa-chevron-circle-right"></i> List of State Nodal Agencies</a></li>
								<li><a href="#"><i class="fa fa-chevron-circle-right"></i> Technical Reports & Resources</a></li>
							</ul>
						</div>	
                    </div>
                     
                    <div class="col-lg-3 col-md-6 col-sm-12 col-12 mb-lg-0 mb-md-5 mb-5 footer-widget">
                        <div class="footer-section-title col-12 no-padding">
                            <h3>Other Links</h3>
                        </div>
                        <!-- END SECTION TITLE -->
						<div class="col-12 footer-widget-inner">
							<ul class="quick-link-list">
								<li><a href="#"><i class="fa fa-chevron-circle-right"></i> Testing Services Portal</a></li>
								<li><a href="#"><i class="fa fa-chevron-circle-right"></i> Tenders</a></li>
								<li><a href="#"><i class="fa fa-chevron-circle-right"></i> User manual </a></li>
								<li><a href="#"><i class="fa fa-chevron-circle-right"></i> RTI</a></li>
								<li><a href="#"><i class="fa fa-chevron-circle-right"></i> Careers</a></li>
								<li><a href="#"><i class="fa fa-chevron-circle-right"></i> Privacy Policy</a></li>
								<li><a href="#"><i class="fa fa-chevron-circle-right"></i> Terms of use</a></li>
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
                            <li><a href="#">Disclaimer</a> </li>
                            <li><a href="#">Site Map</a> </li>
                        </ul>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-12 col-12 copyright-text text-center text-lg-right text-md-right">
                        <p>Copyright &copy; 2024 <a href="#"> National Institute of Solar Energy </a> | All Rights Reserved</p>
                    </div>
                </div>
            </div>
        </div>
		
    </footer>