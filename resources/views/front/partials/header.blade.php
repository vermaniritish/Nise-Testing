<?php 
use App\Models\Admin\Menu;
use App\Models\Admin\MenuHindi;
use App\Models\Admin\Settings;
use App\Models\Admin\Notices;
use App\Models\Admin\Pages;
$menu = Menu::where('slug', 'header')->orderBy('id', 'asc')->get();
$menuHi = MenuHindi::where('slug', 'header')->orderBy('id', 'asc')->get();
// $headerAds = HeaderAds::where('status',1)->orderBy('id', 'desc')->get();
$headerAds = Notices::where('status',1)->orderBy('id', 'desc')->take(6)->get();
$pageSRAData = Pages::where('slug','sra')->get();
?>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<style>

	.ticker-container {
	  width: 100%;
	  overflow: hidden;
	  white-space: nowrap;
	  background:#1272b9;
	  /*padding:10px;*/
	  color:#fff;
	  margin-top: 45px;
	  
	}

	.ticker-wrapper {
	  display: inline-block;
	  animation: ticker 30s linear infinite;
	  padding:3px 0 0 0;
	  line-height:11px;
	  animation-name: ticker;
	  -webkit-animation-duration: 180s;
	  animation-duration: 180s;
	  
	}

	.ticker-wrapper {
	    background: #0074c2;
	    overflow: hidden;
	    white-space: nowrap;
	    padding: 5px 0;
	}

	.ticker {
	    display: inline-block;
	    /*animation: tickerScroll 20s linear infinite;*/
	}

	/*.ticker-wrapper:hover {
	  animation-play-state: paused;
	}

	.ticker {
	  display: inline-block;
	  color:#fff;
	  
	}*/

	.ticker a {
	    color: white;
	    margin: 0 14px;
	    text-decoration: none;
	    display: inline-flex; /* ये important है */
	    align-items: center;
	}

	.ticker img {
	    margin-right: 5px;
	    height: 16px;
	}

	@keyframes tickerScroll {
	    0% { transform: translateX(100%); }
	    100% { transform: translateX(-100%); }
	}
	/*.ticker a {color:#fff;font-size: 14px;}*/

	.ticker-text {
	  font-weight: bold;
	  color: #720000;
	}

	.blink {
	  animation: blinker 1s linear infinite;
	}

	@keyframes blinker {
	  50% {
	    opacity: 0;
	  }
	}

	@keyframes ticker {
	  0% {
	    transform: translateX(40%);
	  }
	  100% {
	    transform: translateX(-100%);
	  }
	}

	.ui-autocomplete {
	    max-height: 250px;
	    overflow-y: auto;
	    background: #fff;
	    border: 1px solid #ccc;
	    z-index: 99999 !important;
	}
	.ui-menu-item {
	    list-style: none;
	}
</style>
<!-- START HEADER SECTION -->
	<header class="main-header header-1">
		<!-- START TOP AREA -->
		<div class="top-area">
			<div class="auto-container">
				<div class="row">
					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12" style="padding-right:0px;padding-left:0px;">			
						<div>
							<img src="{{ url('frontend/assets/img/emblem.png') }}" alt="" style="height: 39px; padding-right: 5px; display: inline-block; padding-bottom: 14px;filter: brightness(0) invert(1)" /> 
							<div class="navbar-brand header-text" href="#">
								<div class="mb-0 hindiLabel">
									भारत सरकार
								</div>
								<a class="mb-0 hindiLabel text-white" href="#" onclick="fnAlertRedirection('https://www.india.gov.in/');">GOVERNMENT
									OF INDIA</a>
							</div>
							<div class="navbar-brand">
								<span style="color: #aeaeb1;">|</span>
							</div>
							<img src="{{ url('frontend/assets/img/emblem.png') }}" alt="" style="height: 39px; padding-right: 5px; display: inline-block; padding-bottom: 14px;filter: brightness(0) invert(1)" /> 
							<div class="navbar-brand header-text" href="#">
								<div class="mb-0 hindiLabel">
									 नवीन और नवीकरणीय ऊर्जा मंत्रालय            
								</div>
								<a class="mb-0 hindiLabel text-white" href="#" onclick="fnAlertRedirection('https://mnre.gov.in/');">MINISTRY OF NEW AND RENEWABLE ENERGY</a>
							</div>
						</div>
					</div>
					<!-- end col -->
					<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12" style="padding-right:0px;padding-left:0px;">
						<div class="info-menu">
							<ul>
								<li>
									<a href="#" class="topbarft">Skip to Main Content</a>
								</li>
								<li>
									<span class="topbartxtgap">|</span>
								</li>
								<li>
									<span class="topbarft">Contrast </span>
									<button class="light-mode-button" aria-label="Toggle Light Mode" onclick="toggle_light_mode()">
										<span></span><span></span></button>
								</li>
								<li><span class="topbartxtgap">|</span></li>
								<li><button id="btn-decrease" class="topbarfontsiz">A-</button></li>
								<li><button id="btn-orig" class="topbarfontsiz">A</button></li>
								<li><button id="btn-increase" class="topbarfontsiz">A+</button></li>
								<li><span class="topbartxtgap">|</span></li>
								<li>
									@php
									    $currentLang = app()->getLocale();
									    $toggleLang = $currentLang === 'en' ? 'hi' : 'en';
									    $toggleLabel = $currentLang === 'en' ? 'हिंदी' : 'English';
									@endphp

									<form action="{{ route('change.language', $toggleLang) }}" method="get" style="display:inline;">
									    <button type="submit"
									        class="btn btn-sm"
									        style="font-size:12px; padding:3px 10px; background-color:#f6f6f6; border:1px solid #1272b9; color:#1272b9; border-radius:5px;">
									        {{ $toggleLabel }}
									    </button>
									</form>
								    <!-- <button id="langBtn"
								            class="btn btn-secondary"
								            style="font-size:12px;padding:3px;background-color:#f6f6f6;border-color:#f6f6f6;color:#1272b9;"
								            onclick="toggleLang()">
								        हिंदी
								    </button> -->
								</li>
								<li><span class="topbartxtgap">|</span></li>
								<li><span class="topbarft">Customer Support: 0124-2853060 | </li>
								<li><a class="topbarft" href="mailto:information.nise@nise.res.in">information.nise@nise.res.in</a></span></li>
								<li><span class="topbartxtgap">|</span></li>
								<li><a href="#"><i class="icofont icofont-social-facebook"></i></a></li>
								<li><a href="#"><i class="icofont icofont-social-twitter"></i></a></li>
								
							</ul>
						</div>
					</div> 
					<!-- end col -->
				</div>
			</div>
		</div>
		<!-- END TOP AREA -->

		<!-- START LOGO AREA -->
		<div class="logo-area">
			<div class="auto-container">
				<div class="row">
					<div class="col-lg-8 col-md-3 col-sm-6 col-12 mx-auto pl-0 mb-lg-0">
						<div class="logo">
							<a href="https://firstsite.in/development/testing/public" style="float: left;">
							   <img class="img-fluid logoimg" src="{{ Settings::get('logo') ? url(Settings::get('logo')) : '' }}" alt="">
							   <span class="logoTxt">
									<small>National Institute of Solar Energy</small>
                                    Testing Services<!--<small>Autonomous Institute under Ministry of New and Renewable Energy Government of India.</small>-->
                                </span>
							</a>
						</div>
					</div>
					<!-- end col -->
					<div class="col-lg-4 col-md-12 col-sm-12 col-12">
						<div class="header-info-box">
                            <!-- <a href="https://swachhbharat.mygov.in/" target="_blank"><img src="{{ url('frontend/assets/img/swach-bharat_1.jpg') }}" alt="G20" /></a> -->
                            <a href="https://swachhbharat.mygov.in/" target="_blank"><img src="{{ url('frontend/assets/img/swach-bharat_1.jpg') }}" style="border-radius:8px !Important;" alt="Swach Bharat" /></a>&nbsp;&nbsp;<a href="https://dopttrg.nic.in/igotmk/" target="_blank"><img src="{{ url('frontend/assets/img/karmayogilogo.jpg') }}" style="border-radius:8px !Important;" alt="G20" /></a>
                        </div>
					</div>
					<!-- end col -->
				</div>
			</div>
		</div>
		<!-- END LOGO AREA -->

		<!-- START NAVIGATION AREA -->
		<div class="sticky-menu">
			<div class="mainmenu-area">
				<div class="auto-container">
					<div class="row">
						<div class="col-lg-10 d-none d-lg-block d-md-none">
							<nav class="navbar navbar-expand-lg justify-content-left">
								<ul class="navbar-nav">
									<li><a href="{{ url('/') }}" class="nav-link"><i class="fa fa-home"></i></a></li>
								   	<?php foreach($menu as $m): ?>
										@if(isset($m['mega_menu']) && $m['mega_menu'] && $m['mega_menu'] != '[]')
											<?php $mega = json_decode($m['mega_menu'], true); ?>
											<li class="dropdown"><a href="#" class="nav-link">{{ $m->key }}</a>
												<ul class="dropdown-menu">
													@foreach($mega as $mg)
														<li>
															<a href="{{ $mg['link'] }}">
																{{ $mg['title'] }}
															</a>
														</li>
													@endforeach
												</ul>
											</li>
										@else
											@php
											    $isLoginItem = strtolower(trim($m->key)) === 'login';
											@endphp

											{{-- Hide "Login" if user already logged in --}}
											@if(Auth::check() && $isLoginItem)
											    @continue
											@endif
											<li>
												<a href="{{ (strpos($m->value, 'http://') >= 0 || strpos($m->value, 'https://') >= 0 ? $m->value : url($m->value)) }}" class="nav-link">{{$m->key}}</a>
											</li>
											
										@endif
									<?php endforeach; ?>
								    @if(Auth::check())
								        <li class="nav-item dropdown">
										    <a class="dropdown-toggle nav-link" href="#" role="button" data-bs-toggle="dropdown">
										        Profile
										    </a>
										    <ul class="dropdown-menu">
										        <li>
										            <a class="dropdown-item" href="{{ route('partner.dashboard') }}">My Profile</a>
										        </li>
										        <li><hr class="dropdown-divider"></li>
										        <li>
										            <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
										        </li>
										    </ul>
										</li>
								    @endif
								</ul>
							</nav>
						</div>
						<div class="col-lg-2 d-none d-lg-block d-md-none text-right pr-0">
						    <form class="navbar-form">
						        <div class="form-group" style="position: relative;">
						            <input id="searchBox" class="form-control" name="search" placeholder="Search here..." type="text" autocomplete="off">
						            <button type="submit" class="btn"><i class="fa fa-search"></i></button>
						        </div>
						    </form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- END NAVIGATION AREA -->	
	</header>
	<div class="ticker-container">
		<div class="ticker-wrapper">
		    <div class="ticker">
		        @if(isset($headerAds) && $headerAds->count() > 0)
				    @foreach($headerAds as $hA)
				        @php
						    $fileUrl = '#';
						    if ($hA->file_type == 'pdf' && !empty($hA->pdf_file)) {
						        $fileUrl = asset($hA->pdf_file);
						    } elseif ($hA->file_type == 'url' && !empty($hA->url)) {
						        $fileUrl = $hA->url;
						    } elseif ($hA->file_type == 'content') {
						        $fileUrl = route('newsEventDetails', ['id' => $hA->id]);
						    }
						@endphp

				        <a target="_blank" href="{{ $fileUrl }}">
				            @if($hA->is_new) 
			                    <img src="{{ asset('frontend/assets/img/new.gif') }}">
			                @endif
				            <span style="display:inline;">
				                {{ $hA->title ?? '' }}
				            </span>
				        </a>
				    @endforeach
				@endif
		    </div>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
	<script>
    var searchUrl = "{{ route('search') }}";

    $("#searchBox").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: searchUrl,
                dataType: "json",
                data: { term: request.term },
                success: function(data) {
                    response(data);
                }
            });
        },
        minLength: 2,
        focus: function(event, ui) {
            if (ui && ui.item) {
                $("#searchBox").val(ui.item.label);
            }
            return false;
        },
        select: function(event, ui) {
            if (ui && ui.item) {
                if (ui.item.url) {
                    window.location.href = ui.item.url; // ✅ Redirect
                }
            }
            return false;
        }
    })
    .autocomplete("instance")._renderMenu = function(ul, items) {
        var that = this;
        var currentCategory = "";
        $.each(items, function(index, item) {
            if (item.type !== currentCategory) {
                currentCategory = item.type;
                ul.append("<li class='ui-autocomplete-category' style='font-weight:bold;padding:5px;color:#333;'>" +
                    (currentCategory === "event" ? "📅 Events" : "📢 Notices") + "</li>");
            }
            that._renderItemData(ul, item);
        });
    };

    $.ui.autocomplete.prototype._renderItem = function(ul, item) {
        // ✅ Extra icon based on file type
        let extraIcon = '';
        if (item.url && item.url.includes('.pdf')) {
            extraIcon = '📄'; // PDF icon
        } else if (item.url && item.url.startsWith('http')) {
            extraIcon = '🔗'; // External link
        } else {
            extraIcon = '📝'; // Normal content
        }

        // ✅ Complete clickable link
        let html = `
            <a href="${item.url ? item.url : '#'}" style="text-decoration:none;display:block;padding:8px;color:#333;">
                <strong style="color:${item.type === 'event' ? 'blue' : 'green'};">
                    ${item.type === 'event' ? '📅 Event:' : '📢 Notice:'}
                </strong> ${extraIcon} ${item.title}
                <div style="font-size:12px;color:#666;">Date: ${item.date}</div>
            </a>
        `;

        return $("<li>")
            .attr("aria-label", item.label)
            .html(html) // ✅ Make the whole <a> clickable
            .appendTo(ul);
    };
</script>

	<!-- END HEADER SECTION -->