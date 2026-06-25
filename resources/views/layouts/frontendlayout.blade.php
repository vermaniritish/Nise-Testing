<?php
use App\Models\Admin\Settings;;
$favicon = Settings::get('favicon');
$logo = Settings::get('logo');
$companyName = Settings::get('company_name');
$googleKey = Settings::get('google_api_key');
$version = 1.0;
?>
<!DOCTYPE html>
<html lang="hi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('/frontend/assets/img/favicon.png') }}" />
    <title>NISE - Testing</title>
    <!-- Bootstrap core CSS -->
    <link href="{{ url('/frontend/assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Google Font  -->
     <link href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,500,500i,600,600i,700,700i|Roboto:400,400i,500,500i,700,700i" rel="stylesheet"> 
    <!-- icofont icon -->
    <link rel="stylesheet" href="{{ url('/frontend/assets/css/icofont.css') }}">   
    <!-- font awesome icon -->
    <link rel="stylesheet" href="{{ url('/frontend/assets/css/fontawesome-all.min.css') }}">   
    <!-- animate CSS -->
    <link rel="stylesheet" href="{{ url('/frontend/assets/css/animate.css') }}">
    <!--- meanmenu Css-->
    <link rel="stylesheet" href="{{ url('/frontend/assets/css/meanmenu.min.css') }}" media="all" />    
    <!--- owl carousel Css-->
    <link rel="stylesheet" href="{{ url('/frontend/assets/owlcarousel/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ url('/frontend/assets/owlcarousel/css/owl.theme.default.min.css') }}">
    <!-- venobox -->
    <link rel="stylesheet" href="{{ url('/frontend/assets/venobox/css/venobox.css') }}" /> 
    <!-- Style CSS --> 
    <link rel="stylesheet" href="{{ url('/frontend/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('/frontend/assets/css/custom.css') }}">
    <!-- Responsive  CSS -->
    <link rel="stylesheet" href="{{ url('/frontend/assets/css/responsive.css') }}">
    

  <script>
  window.console = window.console || function(t) {};
</script>
</head>

<body translate="no">
    <script>
        var app = document.getElementsByTagName("BODY")[0];
        if (localStorage.lightMode == "dark") {
            app.setAttribute("light-mode", "dark");
        }
    </script>
    <!-- START PRELOADER -->
	<div id="page-preloader">
        <div class="theme-loader">NISE - Testing</div>
    </div>
	@include('front.partials.header')

	@yield('content')
    
	@include('front.partials.footer')
    <script>
        var site_url = "<?php echo url("/") ?>";
        var admin_url = "<?php echo url("/admin/") ?>";
        var current_url = "<?php echo url()->current(); ?>";
        var current_full_url = "<?php echo url()->full(); ?>";
        var previous_url = "<?php echo url()->previous(); ?>";
        var csrf_token = function(){
            return "<?php echo csrf_token() ?>";
        }
    </script>
    <script>
        // Apply selected language
        function langChange(lang) {
            localStorage.setItem('lang', lang);
            document.body.classList.remove('lang-en-active', 'lang-hi-active');
            document.body.classList.add(lang === 'hi' ? 'lang-hi-active' : 'lang-en-active');
            updateButton(lang);
        }

        // Toggle Hindi/English on button click
        function toggleLang() {
            const currentLang = localStorage.getItem('lang') || 'en';
            const newLang = (currentLang === 'en') ? 'hi' : 'en';
            langChange(newLang);
        }

        // Update button label
        function updateButton(lang) {
            const btn = document.getElementById('langBtn');
            if (btn) btn.textContent = (lang === 'en') ? 'हिंदी' : 'English';
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function () {
            const lang = localStorage.getItem('lang') || 'en';
            document.body.classList.add(lang === 'hi' ? 'lang-hi-active' : 'lang-en-active');
            updateButton(lang);
        });
        langChange('{{request()->session()->get('locale')}}');
    </script>
        <!-- Latest jQuery -->
    <script>
    function toggle_light_mode() {
    var app = document.getElementsByTagName("BODY")[0];
    if (localStorage.lightMode == "dark") {
        localStorage.lightMode = "light";
        app.setAttribute("light-mode", "light");
    } else {
        localStorage.lightMode = "dark";
        app.setAttribute("light-mode", "dark");
    }
    }

    window.addEventListener(
    "storage",
    function () {
    if (localStorage.lightMode == "dark") {
        app.setAttribute("light-mode", "dark");
    } else {
        app.setAttribute("light-mode", "light");
    }
    },
    false);
    //# sourceURL=pen.js
    </script>

    <script src="{{ url('/frontend/assets/js/jquery-2.2.4.min.js')}}"></script>
    <!-- popper js -->
    <script src="{{ url('/frontend/assets/bootstrap/js/popper.min.js')}}"></script>
    <!-- Latest compiled and minified Bootstrap -->
    <script src="{{ url('/frontend/assets/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- meanmenu min js  -->
    <script src="{{ url('/frontend/assets/js/jquery.meanmenu.min.js')}}"></script>
    <!-- Sticky JS -->
    <script src="{{ url('/frontend/assets/js/jquery.sticky.js')}}"></script>
    <!-- owl-carousel min js  -->
    <script src="{{ url('/frontend/assets/owlcarousel/js/owl.carousel.min.js')}}"></script>   
    <!-- jquery appear js  -->
    <script src="{{ url('/frontend/assets/js/jquery.appear.js')}}"></script>
    <!-- countTo js -->
    <script src="{{ url('/frontend/assets/js/jquery.inview.min.js')}}"></script>
    <!-- venobox js -->
    <script src="{{ url('/frontend/assets/venobox/js/venobox.min.js')}}"></script>
    <script src="{{ url('/frontend/assets/js/masonry.pkgd.min.js')}}"></script>
    <!-- scroll to top js -->
    <script src="{{ url('/frontend/assets/js/scrolltopcontrol.js')}}"></script>
    <!-- WOW - Reveal Animations When You Scroll -->
    <script src="{{ url('/frontend/assets/js/wow.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <!-- scripts js -->
    <script src="{{ url('/frontend/assets/js/scripts.js')}}"></script>
    
    <!-- chart js -->
    <!-- <script src="{{ url('/frontend/assets/js/canvasjs.min.js')}}"></script> -->
    <!-- <script src="{{ url('/frontend/assets/js/canvasjs.activeone.js')}}"></script> -->
    @stack('scripts')
</body>

</html>