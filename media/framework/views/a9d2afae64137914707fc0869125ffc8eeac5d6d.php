<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $__env->yieldContent('title'); ?> || Dancezone</title>

    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo e(asset('frontend/images/favicons/apple-touch-icon.png')); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(asset('frontend/images/favicons/favicon-32x32.png')); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(asset('frontend/images/favicons/favicon-16x16.png')); ?>">
    <link rel="manifest" href="<?php echo e(asset('frontend/images/favicons/site.webmanifest')); ?>">

    <!-- Fonts-->
   
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Asap:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

    <!-- Css-->
    <link rel="stylesheet" href="<?php echo e(asset('frontend/css/animate.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontend/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontend/css/owl.carousel.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontend/css/owl.theme.default.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontend/css/magnific-popup.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontend/css/fontawesome-all.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontend/css/swiper.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontend/css/bootstrap-select.min.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('frontend/css/jquery.mCustomScrollbar.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontend/css/bootstrap-datepicker.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontend/css/vegas.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontend/css/nouislider.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontend/css/nouislider.pips.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontend/css/jitsin_iconl.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontend/css/floating-wpp.min.css')); ?>">  
    <link rel="stylesheet" href="<?php echo e(asset('frontend/css/dncalendar-skin.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontend/css/sweetalert2.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontend/css/toastr.min.css')); ?>">

    <!-- Template styles -->
    <link rel="stylesheet" href="<?php echo e(asset('frontend/css/unused.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontend/css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontend/css/responsive.css')); ?>">

   <!-- end: JavaScript-->
    <?php echo $__env->yieldPushContent('style'); ?>

    <?php ($style = getOptions('custom_style')->long_text); ?>
    <?php if(!empty($style)): ?>
        <style><?php echo $style??''; ?></style>
    <?php endif; ?> 
</head>

<body class="<?php echo e(Route::currentRouteName()); ?>">
    <div class="preloader">
        <img src="<?php echo e(asset('frontend/images/loader.png')); ?>" class="preloader__image" alt="">
    </div><!-- /.preloader -->

    <div class="page-wrapper"> 
        <div class="site-header__header-one-wrap clearfix"> 
            <div class="container">
                <div class="site-header__header-one-wrap-left"> 
                    <?php ($logo = getOptions('logo')->value); ?>
                    <a href="<?php echo e(url('/')); ?>" class="main-nav__logo">
                        <img src="<?php echo e(!empty($logo) ? $logo : asset('frontend/images/resources/logo.png')); ?>" class="main-logo" alt="Dancezone">
                    </a>
                </div> 
                <header class="main-nav__header-one"> 
                    <div class="main-nav__header-one-top clearfix"> 
                        <div class="main-nav__header-one-top-right">
                            <ul class="one__links">
                                <li><a href="#"><i class="fab fa-twitter"></i> Facebook</a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i> info@dancezone.ch</a></li>
                                <li><a href="#"><i class="fa fa-phone"></i> 079 243 03 03</a></li>
                                <li class="dropdown">
                                    <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php if(auth()->check()): ?><?php echo e(Auth::user()->name); ?> <?php else: ?> Mein Konto <?php endif; ?><i class="fa fa-angle-down"></i></a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                       <?php if(auth()->check()): ?>  
                                       <ul class="profile-nav"> 
                                          <li><a href="<?php echo e(route('customers.dashboard')); ?>"> My Profile </a></li>  
                                          <li>
                                           <a href="javascript:void(0);" class=""  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                           <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;"> <?php echo e(csrf_field()); ?></form>
                                         </li>
                                       </ul> 
                                       <?php else: ?>
                                             <form action="<?php echo e(route('login')); ?>" name="loginform" method="post" class="loginform">
                                                <?php echo csrf_field(); ?>
                                               <div class="form-row">
                                                   <input type="text" name="email" id="email" value="" placeholder="Benutzername" class="form-controll">
                                               </div>
                                               <div class="form-row">
                                                  <input type="password" name="password" id="password" value="" placeholder="Passwort"  class="form-controll">
                                               </div>
                                               <div class="form-row">
                                                   <div class="remember-checkbox"> 
                                                       <label for="remember"><input name="remember" type="checkbox" id="remember" value="1"> Angemeldet bleiben</label> 
                                                   </div>
                                               </div> 
                                               <div class="form-row">
                                                   <input type="submit" name="log-submit" id="log-submit" class=" btn btn-primary submit-btn" value="Anmelden">
                                               </div>
                                          </form>
                                          <a class="login-box-register" href="<?php echo e(route('customers-register')); ?>" title="Register">Registrieren</a>
                                       <?php endif; ?> 
                                    </div>
                                </li> 
                            </ul>
                        </div> 
                    </div>
                    <div class="news-carousel">
                        <h2 class="news-ctitle">News</h2>
                        <div id="carouselNews" class="carousel slide" data-ride="carousel">
                             <a class="carousel-control-prev" href="#carouselNews" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselNews" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>

                            <div class="carousel-inner">
                                <?php ($newses = getNews()); ?>
                                <?php if(!empty($newses)): ?>
                                    <?php $__currentLoopData = $newses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="carousel-item  <?php echo e($key==0?'active':''); ?>">
                                        <a href="#" class="news-item" data-id="<?php echo e($news->id); ?>" data-slug="<?php echo e($news->slug??''); ?>">
                                          <h3><?php echo e($news->title??''); ?></h3>
                                          <p><?php echo e($news->excerpt??''); ?></p>
                                        </a>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?> 
                            </div> 
                        </div>
                    </div> 
                </header>
            </div>
            <header class="main-nav_custom">
                <div class="container">
                    <nav class="header-navigation one stricky">
                        <div class="container-box clearfix">
                            <!-- Brand and toggle get grouped for better mobile display -->
                            <div class="main-nav__left">
                                <a href="index.html" class="main-nav__logo">
                                    <img src="<?php echo e(!empty($logo) ? $logo : asset('frontend/images/resources/logo.png')); ?>" class="main-logo" alt="Awesome Image">
                                </a>
                                <a href="#" class="side-menu__toggler">
                                    <i class="fa fa-bars"></i>
                                </a>
                            </div>
                            <div class="main-nav__main-navigation">
                                <?php echo ome_nav(); ?>


                                
                            </div><!-- /.navbar-collapse -->  
                        </div>
                    </nav>
                </div>
            </header>
        </div>  

        <main role="main">
            <?php echo $__env->yieldContent('content'); ?>
        </main>
 
        <!--Site Footer Start-->
        <footer class="site-footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="footer-widget__column footer-widget__about wow fadeInUp animated"
                            data-wow-delay="100ms"
                            style="visibility: visible; animation-delay: 100ms; animation-name: fadeInUp;">
                            <div class="footer-widget__title">
                                <img src="<?php echo e(asset('frontend/images/resources/footer-logo.png')); ?>" alt="">
                            </div>
                            <div class="footer-widget_about_text">
                                <ul class="locaion-list">
                                <li><i class="fa fa-map-marker-alt"></i> <?php echo e(strtoupper( getOptions('title')->value)??''); ?> <br>
                                   <?php echo getOptions('address')->value??''; ?></li>
                                <li><i class="fa fa-phone"></i>  <?php echo getOptions('phone')->value??''; ?></li>
                                <li><i class="fa fa-envelope"></i> <?php echo getOptions('email')->value??''; ?></li>
                            </ul>
                            </div> 
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="footer-widget__column footer-widget__company wow fadeInUp animated"
                            data-wow-delay="200ms"
                            style="visibility: visible; animation-delay: 200ms; animation-name: fadeInUp;">
                             <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d5388.923978592219!2d8.543367000000002!3d47.519868!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x479075d4050275fb%3A0x2ad29f033cc09d7d!2sDancezone%20%2F%20Tanzschule!5e0!3m2!1sde!2sch!4v1581351428267!5m2!1sde!2sch" width="90%" height="330px" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="footer-widget__column footer-widget__explore wow fadeInUp animated"
                            data-wow-delay="300ms"
                            style="visibility: visible; animation-delay: 300ms; animation-name: fadeInUp;"> 
                            <?php echo OmeLabHelper::displayWidgets('footer1', 'footer'); ?>  
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="footer-widget__column footer-widget__links wow fadeInUp animated"
                            data-wow-delay="400ms"
                            style="visibility: visible; animation-delay: 400ms; animation-name: fadeInUp;">

                            <?php echo OmeLabHelper::displayWidgets('footer2', 'footer'); ?> 
                        </div>
                    </div> 
                </div>
            </div>
        </footer>

        <!--Site Footer Bottom Start-->
        <div class="site-footer_bottom">
            <div class="container">
                <div class="row"> 
                    <div class="col-md-12"> <h5  class="bottom-title">DANCEZONE ist Mitglied bei:</h5></div>
                </div> 
                  
                <div class="footer-branding">
                    <a href="https://swissdance.ch/de" target="_blank"><img src="<?php echo e(asset('frontend/images/resources/logo-swissdance.jpeg')); ?>" class="logo-swissdance"></a>
                    <a href="https://www.tanzvereinigung-schweiz.ch/" target="_blank"><img src="<?php echo e(asset('frontend/images/resources/TVS_Logo_spezial_de.png')); ?>" class="logo-tanzvch"></a>
                    <a href="https://salsa.ch/" target="_blank"><img src="<?php echo e(asset('frontend/images/resources/logo-salsach.png')); ?>" class="logo-salsach"></a>
                </div> 
                <div class="copyright-dancezone">© <script>document.write(new Date().getFullYear());</script>2020 DANCEZONE - Tanzschule - SalsaSchule - Bülach ZH</div>

                <div class="agb"><a href="/agb">AGB</a> - <a href="/datenschutz">Datenschutz</a> - <a href="/impressum">Impressum</a></div>
            </div>
        </div>

    </div><!-- /.page-wrapper -->
    
    <div id="WAButton"></div>  
    <a href="#" data-target="html" class="scroll-to-target scroll-to-top"><i class="fa fa-angle-up"></i></a>

    <div class="side-menu__block">
        <div class="side-menu__block-overlay custom-cursor__overlay">
            <div class="cursor"></div>
            <div class="cursor-follower"></div>
        </div>
        <div class="side-menu__block-inner ">
            <div class="side-menu__top justify-content-end">
                <a href="#" class="side-menu__toggler side-menu__close-btn">
                    <img src="<?php echo e(asset('frontend/images/shapes/close-1-1.png')); ?>" alt="">
                </a>
            </div>  
            <nav class="mobile-nav__container"> 
            </nav> 
            <div class="side-menu__sep"></div>  
            <div class="side-menu__content">
                <p><a href="mailto:needhelp@tripo.com">needhelp@jitsin.com</a> <br> <a href="tel:888-999-0000">888 999 0000</a></p>
                <div class="side-menu__social">
                    <a href="#"><i class="fab fa-facebook-square"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-pinterest-p"></i></a>
                </div>
            </div>
        </div>
    </div> 

    <div class="search-popup">
        <div class="search-popup__overlay custom-cursor__overlay">
            <div class="cursor"></div>
            <div class="cursor-follower"></div>
        </div>
        <div class="search-popup__inner">
            <form action="#" class="search-popup__form">
                <input type="text" name="search" placeholder="Type here to Search....">
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div>
    </div> 

    <div class="modal fade" id="newsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document"> 
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="news_pop_title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body" id="newsPopData"> 
              </div> 
            </div> 
        </div>
    </div>

    <script src="<?php echo e(asset('frontend/js/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/js/owl.carousel.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/js/waypoints.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/js/jquery.counterup.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/js/TweenMax.min.j')); ?>s"></script>
    <script src="<?php echo e(asset('frontend/js/wow.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/js/jquery.magnific-popup.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/js/jquery.ajaxchimp.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/js/swiper.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/js/typed-2.0.11.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/js/vegas.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/js/jquery.validate.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/js/bootstrap-select.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/js/countdown.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/js/jquery.mCustomScrollbar.concat.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/js/bootstrap-datepicker.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/js/nouislider.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/js/isotope.pkgd.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/js/toastr.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/js/appear.js')); ?>"></script> 
    <script src="<?php echo e(asset('frontend/js/sweetalert2.min.js')); ?>"></script>  
    <script src="<?php echo e(asset('frontend/js/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/js/dataTables.bootstrap4.js')); ?>"></script> 
    <script src="<?php echo e(asset('frontend/js/validator.min.js')); ?>"></script> 

    <!-- template scripts -->
    <script src="<?php echo e(asset('frontend/js/theme.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/js/floating-wpp.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/js/dncalendar.min.js')); ?>"></script>
    <script type="text/javascript">  
       $(function () {
           $('#WAButton').floatingWhatsApp({
               phone: '01758083458', //WhatsApp Business phone number
               headerTitle: 'Chat with us on WhatsApp!', //Popup Title
               popupMessage: 'Hello, how can we help you?', //Popup Message
               showPopup: true, //Enables popup display
               buttonImage: '<img src="<?php echo e(asset('frontend/images/resources/whatsapp.svg')); ?>" />',  
               position: "left", //Position: left | right
               size:"39px" 
           });
        });

        /*--------------------------------
         #Isotope
        ------------------------------------*/
        var $grid = $('.gridwrap').isotope({
          itemSelector: '.element-item',
          layoutMode: 'fitRows',
        }); 

        // bind filter button click
        $('.gallery-filters').on( 'click', 'button', function() {
          var filterValue = $( this ).attr('data-filter'); 
          $grid.isotope({ filter: filterValue });
        });

        // change is-checked class on buttons
        $('.gallery-filters').each( function( i, buttonGroup ) {
            var $buttonGroup = $( buttonGroup );
            $buttonGroup.on( 'click', 'button', function() {
            $buttonGroup.find('.is-checked').removeClass('is-checked');
            $( this ).addClass('is-checked');
          });
        }); 

    </script> 

    <script> 
        toastr.options = {
          "closeButton": true,  
          "positionClass": "toast-top-right",
          "preventDuplicates": false,
          "onclick": null,
          "showDuration": "300",
          "hideDuration": "1000",
          "timeOut": "50000",
          "extendedTimeOut": "5500",
        } 
     
        <?php if(session()->has('success')): ?> 
            toastr.success(" <?php echo session()->get('success'); ?>"); 
        <?php endif; ?>

        <?php if(session()->has('info')): ?>
            toastr.info("<?php echo session()->get('info'); ?>");
        <?php endif; ?>

        <?php if(session()->has('warning')): ?>
            toastr.warning("<?php echo session()->get('warning'); ?>");
        <?php endif; ?>

        <?php if(session()->has('error')): ?>
            toastr.error("<?php echo session()->get('error'); ?>");
        <?php endif; ?>  
    </script>
    
    
    <?php if(!session()->has('lenguage')): ?>
      <?php echo e(setLanguage()); ?>

      <script> location.reload(); </script> 
    <?php endif; ?>  

    <script> 
    /* FUNCTIONS FOR DYNAMIC ENGINE
    ------------------------------------------------*/
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function makeAjaxText(url, load=null) {
            return $.ajax({
                url: url,
                type: 'get',
                cache: false,
                beforeSend: function(){
                    if(typeof(load) != "undefined" && load !== null){
                        load.ladda('start');
                    }
                }
            }).always(function() {
                if(typeof(load) != "undefined" && load !== null){
                    load.ladda('stop');
                }
            }).fail(function() {
                swalError();
            });
        }

        function makeAjaxPostText(data, url, load=null) {
            return $.ajax({
                url: url,
                type: 'post',
                data: data,
                cache: false,
                beforeSend: function(){
                    if(typeof(load) != "undefined" && load !== null){
                        load.ladda('start');
                    }
                }
            }).always(function() {
                if(typeof(load) != "undefined" && load !== null){
                    load.ladda('stop');
                }
            }).fail(function() {
                swalError();
            });
        }

        function makeAjax(url, load=null) {
            return $.ajax({
                url: url,
                type: 'get',
                dataType: 'json',
                cache: false,
                beforeSend: function(){
                    if(typeof(load) != "undefined" && load !== null){
                        load.ladda('start');
                    }
                }
            }).always(function() {
                if(typeof(load) != "undefined" && load !== null){
                    load.ladda('stop');
                }
            }).fail(function() {
                swalError();
            });
        }

        function makeAjaxPost(data, url, load=null) {
            return $.ajax({
                url: url,
                type: 'post',
                dataType: 'json',
                data: data,
                cache: false,
                beforeSend: function(){
                    if(typeof(load) != "undefined" && load !== null){
                        load.ladda('start');
                    }
                }
            }).always(function() {
                if(typeof(load) != "undefined" && load !== null){
                    load.ladda('stop');
                }
            }).fail(function() {
                swalError();
            });
        }

        function swalError(msg) {
            var message = typeof(msg) != "undefined" && msg !== null ? msg : "Something went wrong";
            Swal.fire({
                icon: 'error',
                title: "Sorry !!",
                html: message,
                showConfirmButton: false,
                timer: 3000
            }); 
        }

        function swalWarning(msg) {
            var message = typeof(msg) != "undefined" && msg !== null ? msg : "Something went wrong";
            Swal.fire({
                title: "Warning !!",
                html: message,
                icon: "warning",
                showConfirmButton: false,
                // timer: 1000
            });
        }

        function swalSuccess(msg) {
            var message = typeof(msg) != "undefined" && msg !== null ? msg : "Action has been Completed Successfully";
            Swal.fire({
                title: 'Successful !!',
                html: message,
                icon: 'success',
                showConfirmButton: false,
                // timer: 1500
            });
        }

        function swalRedirect(url, msg, mode) {
            var message = typeof(msg) != "undefined" && msg !== null ? msg : "Action has been Completed Successfully";
            var title = 'Successful !!';
            var icon = 'info';
            if(typeof(mode) != "undefined" && mode !== null){
                if(mode == 'success'){
                    var title = 'Successful !!';
                    var icon = 'success';
                } else if(mode == 'error'){
                    var title = 'Failed !!';
                    var icon = 'error';
                }else if(mode == 'warning'){
                    var title = 'Warning !!';
                    var icon = 'warning';
                }else if(mode == 'question'){
                    var title = 'Warning !!';
                    var icon = 'question';
                }else{
                    var title = 'Successful !!';
                    var icon = 'info';
                }
            }
            return Swal.fire({
                title: title,
                html: message,
                icon: icon,
                reverseButtons : true,
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Thank You',
            }).then(function (s) {
                if(s.value){
                    if(typeof(url) != "undefined" && url !== null){
                        window.location.replace(url);
                    }else{
                        location.reload();
                    }
                }
            });

            setTimeout(function(){  window.location.replace(url); }, 100);
        }

        function swalConfirm(msg) {
            var message = typeof(msg) != "undefined" && msg !== null ? msg : "You won't be able to revert this!";
            return Swal.fire({
                title: 'Are you sure?',
                html: message,
                icon: 'warning',
                reverseButtons : true,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Confirm!',
                cancelButtonText: 'Cancel'
            });
        }

    </script>

    <script>
        (function($) { 

            $('.news-item').click(function(e) {
                e.preventDefault(); 
                var $news_id = $(this).data('id');  
                var data = {"news_id": $news_id}; 
                var url ="<?php echo e(route('newspop')); ?>"; 
                makeAjaxPost(data, url, load=null).then(response =>{
                    $('#newsPopData').html(response.data); 
                    $('#news_pop_title').html(response.title);                    
                }).then($('#newsModal').modal('show'));  
            })

            $('.ajax-popup-link').magnificPopup({
                type: 'ajax'
            });

        })(jQuery);
    </script>
    <!-- end: JavaScript-->

    <?php echo $__env->yieldPushContent('scripts'); ?> 
</body> 
</html> <?php /**PATH D:\XAMPP\htdocs\bdrentz\resources\views/layouts/app.blade.php ENDPATH**/ ?>