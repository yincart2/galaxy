<?php

use cms\assets\AppAsset;

AppAsset::register($this);
list($path, $link) = $this->getAssetManager()->publish('@theme/cms/assets');
?>
<!DOCTYPE html>
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en"  >
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>
    <title>Yincart2 CMS - 内容管理系统</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->

    <script type="javascript">
        var url = <?= $link ?>;
    </script>

<!--    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&amp;subset=devanagari,latin-ext" rel="stylesheet">-->
    <link href="<?= $link ?>/plugins/socicon/socicon.css" rel="stylesheet" type="text/css"/>
    <link href="<?= $link ?>/plugins/bootstrap-social/bootstrap-social.css" rel="stylesheet" type="text/css"/>
    <link href="<?= $link ?>/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?= $link ?>/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?= $link ?>/plugins/animate/animate.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?= $link ?>/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN: BASE PLUGINS  -->
    <link href="<?= $link ?>/plugins/revo-slider/css/settings.css" rel="stylesheet" type="text/css"/>
    <link href="<?= $link ?>/plugins/revo-slider/css/layers.css" rel="stylesheet" type="text/css"/>
    <link href="<?= $link ?>/plugins/revo-slider/css/navigation.css" rel="stylesheet" type="text/css"/>
    <link href="<?= $link ?>/plugins/cubeportfolio/css/cubeportfolio.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?= $link ?>/plugins/owl-carousel/assets/owl.carousel.css" rel="stylesheet" type="text/css"/>
    <link href="<?= $link ?>/plugins/fancybox/jquery.fancybox.css" rel="stylesheet" type="text/css"/>
    <link href="<?= $link ?>/plugins/slider-for-bootstrap/css/slider.css" rel="stylesheet" type="text/css"/>
    <!-- END: BASE PLUGINS -->

    <!-- BEGIN: PAGE STYLES -->
    <link href="<?= $link ?>/plugins/ilightbox/css/ilightbox.css" rel="stylesheet" type="text/css"/>
    <!-- END: PAGE STYLES -->

    <!-- BEGIN THEME STYLES -->
    <link href="<?= $link ?>/agency/css/plugins.css" rel="stylesheet" type="text/css"/>
    <link href="<?= $link ?>/agency/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
    <link href="<?= $link ?>/agency/css/themes/default.css" rel="stylesheet" id="style_theme" type="text/css"/>
    <link href="<?= $link ?>/agency/css/custom.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME STYLES -->

    <link rel="shortcut icon" href="favicon.ico"/>
</head>
<body class="c-layout-header-fixed c-layout-header-mobile-fixed c-layout-header-fullscreen">

<!-- BEGIN: LAYOUT/HEADERS/HEADER-ONEPAGE-1 -->
<!-- BEGIN: HEADER -->
<header id="header-onepage-1" class="c-layout-header c-layout-header-onepage c-layout-header-7 c-layout-header-dark-mobile c-header-transparent-dark" id="home" data-minimize-offset="0">
    <div class="c-navbar">
        <div class="container">
            <!-- BEGIN: BRAND -->
            <div class="c-navbar-wrapper clearfix">
                <div class="c-brand c-pull-left">
                    <a href="../corporate_1/index.html" class="c-logo">
                        <img src="<?= $link ?>/base/img/layout/logos/logo-1.png" alt="JANGO" class="c-desktop-logo">
                        <img src="<?= $link ?>/base/img/layout/logos/logo-1.png" alt="JANGO" class="c-desktop-logo-inverse">
                        <img src="<?= $link ?>/base/img/layout/logos/logo-1.png" alt="JANGO" class="c-mobile-logo">
                    </a>
                    <button class="c-hor-nav-toggler" type="button" data-target=".c-mega-menu">
                        <span class="c-line"></span>
                        <span class="c-line"></span>
                        <span class="c-line"></span>
                    </button>
                    <button class="c-search-toggler" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
                <!-- END: BRAND -->
                <!-- BEGIN: QUICK SEARCH -->
                <form class="c-quick-search" action="#">
                    <input type="text" name="query" placeholder="Type to search..." value="" class="form-control" autocomplete="off">
                    <span class="c-theme-link">&times;</span>
                </form>
                <!-- END: QUICK SEARCH -->
                <!-- BEGIN: HOR NAV -->
                <!-- BEGIN: LAYOUT/HEADERS/MEGA-MENU-ONEPAGE -->
                <!-- BEGIN: MEGA MENU -->
                <nav class="c-mega-menu c-mega-menu-onepage c-mega-menu-dark c-mega-menu-dark-mobile c-fonts-uppercase" data-onepage-animation-speed="700">
                    <ul class="nav navbar-nav c-theme-nav">
                        <li class="c-onepage-link c-active active">
                            <a href="#home" class="c-link">Home</a>
                        </li>
                        <li class="c-onepage-link ">
                            <a href="#about-us" class="c-link">About Us</a>
                        </li>
                        <li class="c-onepage-link ">
                            <a href="#services" class="c-link">Services</a>
                        </li>
                        <li class="c-onepage-link ">
                            <a href="#client" class="c-link">Clients</a>
                        </li>
                        <li class="c-onepage-link ">
                            <a href="#contact" class="c-link">Contact</a>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav c-theme-nav-right">

                        <li class="c-search-toggler-wrapper">
                            <a  href="#" class="c-btn-icon c-search-toggler"><i class="fa fa-search"></i></a>
                        </li>



                        <li class="c-quick-sidebar-toggler-wrapper">
                            <a href="#" class="c-quick-sidebar-toggler">
                                <span class="c-line"></span>
                                <span class="c-line"></span>
                                <span class="c-line"></span>
                            </a>
                        </li>


                    </ul>
                </nav>

                <!-- END: MEGA MENU --><!-- END: LAYOUT/HEADERS/MEGA-MENU-ONEPAGE -->
                <!-- END: HOR NAV -->
            </div>
        </div>
    </div>
</header>
<!-- END: HEADER --><!-- END: LAYOUT/HEADERS/HEADER-ONEPAGE-1 -->

<!-- BEGIN: CONTENT/USER/FORGET-PASSWORD-FORM -->
<div class="modal fade c-content-login-form" id="forget-password-form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content c-square">
            <div class="modal-header c-no-border">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <h3 class="c-font-24 c-font-sbold">Password Recovery</h3>
                <p>To recover your password please fill in your email address</p>
                <form>
                    <div class="form-group">
                        <label for="forget-email" class="hide">Email</label>
                        <input type="email" class="form-control input-lg c-square" id="forget-email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn c-theme-btn btn-md c-btn-uppercase c-btn-bold c-btn-square c-btn-login">Submit</button>
                        <a href="javascript:;" class="c-btn-forgot" data-toggle="modal" data-target="#login-form" data-dismiss="modal">Back To Login</a>
                    </div>
                </form>
            </div>
            <div class="modal-footer c-no-border">
                <span class="c-text-account">Don't Have An Account Yet ?</span>
                <a href="javascript:;" data-toggle="modal" data-target="#signup-form" data-dismiss="modal" class="btn c-btn-dark-1 btn c-btn-uppercase c-btn-bold c-btn-slim c-btn-border-2x c-btn-square c-btn-signup">Signup!</a>
            </div>
        </div>
    </div>
</div><!-- END: CONTENT/USER/FORGET-PASSWORD-FORM -->
<!-- BEGIN: CONTENT/USER/SIGNUP-FORM -->
<div class="modal fade c-content-login-form" id="signup-form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content c-square">
            <div class="modal-header c-no-border">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <h3 class="c-font-24 c-font-sbold">Create An Account</h3>
                <p>Please fill in below form to create an account with us</p>
                <form>
                    <div class="form-group">
                        <label for="signup-email" class="hide">Email</label>
                        <input type="email" class="form-control input-lg c-square" id="signup-email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="signup-username" class="hide">Username</label>
                        <input type="email" class="form-control input-lg c-square" id="signup-username" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label for="signup-fullname" class="hide">Fullname</label>
                        <input type="email" class="form-control input-lg c-square" id="signup-fullname" placeholder="Fullname">
                    </div>
                    <div class="form-group">
                        <label for="signup-country" class="hide">Country</label>
                        <select class="form-control input-lg c-square" id="signup-country">
                            <option value="1">Country</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn c-theme-btn btn-md c-btn-uppercase c-btn-bold c-btn-square c-btn-login">Signup</button>
                        <a href="javascript:;" class="c-btn-forgot" data-toggle="modal" data-target="#login-form" data-dismiss="modal">Back To Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div><!-- END: CONTENT/USER/SIGNUP-FORM -->
<!-- BEGIN: CONTENT/USER/LOGIN-FORM -->
<div class="modal fade c-content-login-form" id="login-form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content c-square">
            <div class="modal-header c-no-border">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <h3 class="c-font-24 c-font-sbold">Good Afternoon!</h3>
                <p>Let's make today a great day!</p>
                <form>
                    <div class="form-group">
                        <label for="login-email" class="hide">Email</label>
                        <input type="email" class="form-control input-lg c-square" id="login-email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="login-password" class="hide">Password</label>
                        <input type="password" class="form-control input-lg c-square" id="login-password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <div class="c-checkbox">
                            <input type="checkbox" id="login-rememberme" class="c-check">
                            <label for="login-rememberme" class="c-font-thin c-font-17">
                                <span></span>
                                <span class="check"></span>
                                <span class="box"></span>
                                Remember Me
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn c-theme-btn btn-md c-btn-uppercase c-btn-bold c-btn-square c-btn-login">Login</button>
                        <a href="javascript:;" data-toggle="modal" data-target="#forget-password-form" data-dismiss="modal" class="c-btn-forgot">Forgot Your Password ?</a>
                    </div>
                    <div class="clearfix">
                        <div class="c-content-divider c-divider-sm c-icon-bg c-bg-grey c-margin-b-20">
                            <span>or signup with</span>
                        </div>
                        <ul class="c-content-list-adjusted">
                            <li>
                                <a class="btn btn-block c-btn-square btn-social btn-twitter">
                                    <i class="fa fa-twitter"></i>
                                    Twitter
                                </a>
                            </li>
                            <li>
                                <a class="btn btn-block c-btn-square btn-social btn-facebook">
                                    <i class="fa fa-facebook"></i>
                                    Facebook
                                </a>
                            </li>
                            <li>
                                <a class="btn btn-block c-btn-square btn-social btn-google">
                                    <i class="fa fa-google"></i>
                                    Google
                                </a>
                            </li>
                        </ul>
                    </div>
                </form>
            </div>
            <div class="modal-footer c-no-border">
                <span class="c-text-account">Don't Have An Account Yet ?</span>
                <a href="javascript:;" data-toggle="modal" data-target="#signup-form" data-dismiss="modal" class="btn c-btn-dark-1 btn c-btn-uppercase c-btn-bold c-btn-slim c-btn-border-2x c-btn-square c-btn-signup">Signup!</a>
            </div>
        </div>
    </div>
</div><!-- END: CONTENT/USER/LOGIN-FORM -->

<!--<!-- BEGIN: LAYOUT/SIDEBARS/QUICK-SIDEBAR -->
<!--<nav class="c-layout-quick-sidebar">-->
<!--    <div class="c-header">-->
<!--        <button type="button" class="c-link c-close">-->
<!--            <i class="icon-login"></i>-->
<!--        </button>-->
<!--    </div>-->
<!--    <div class="c-content">-->
<!--        <div class="c-section">-->
<!--            <h3>JANGO DEMOS</h3>-->
<!--            <div class="c-settings c-demos c-bs-grid-reset-space">-->
<!--                <div class="row">-->
<!--                    <div class="col-md-12">-->
<!--                        <a href="../default/index.html" class="c-demo-container c-demo-img-lg">-->
<!--                            <div class="c-demo-thumb ">-->
<!--                                <img src="--><?//= $link ?><!--/base/img/content/quick-sidebar/default.jpg" class="c-demo-thumb-img"/>-->
<!--                            </div>-->
<!--                        </a>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="row">-->
<!--                    <div class="col-md-6">-->
<!--                        <a href="../corporate_1/index.html" class="c-demo-container">-->
<!--                            <div class="c-demo-thumb  c-thumb-left">-->
<!--                                <img src="--><?//= $link ?><!--/base/img/content/quick-sidebar/corporate_1.jpg" class="c-demo-thumb-img"/>-->
<!--                            </div>-->
<!--                        </a>-->
<!--                    </div>-->
<!--                    <div class="col-md-6">-->
<!--                        <a href="../agency_1/index.html" class="c-demo-container">-->
<!--                            <div class="c-demo-thumb active c-thumb-right">-->
<!--                                <img src="--><?//= $link ?><!--/base/img/content/quick-sidebar/corporate_1-onepage.jpg" class="c-demo-thumb-img"/>-->
<!--                            </div>-->
<!--                        </a>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="c-section">-->
<!--            <h3>Theme Colors</h3>-->
<!--            <div class="c-settings">-->
<!---->
<!--                <span class="c-color c-default c-active" data-color="default"></span>-->
<!---->
<!--                <span class="c-color c-green1" data-color="green1"></span>-->
<!--                <span class="c-color c-green2" data-color="green2"></span>-->
<!--                <span class="c-color c-green3" data-color="green3"></span>-->
<!---->
<!--                <span class="c-color c-yellow1" data-color="yellow1"></span>-->
<!--                <span class="c-color c-yellow2" data-color="yellow2"></span>-->
<!--                <span class="c-color c-yellow3" data-color="yellow3"></span>-->
<!---->
<!--                <span class="c-color c-red1" data-color="red1"></span>-->
<!--                <span class="c-color c-red2" data-color="red2"></span>-->
<!--                <span class="c-color c-red3" data-color="red3"></span>-->
<!---->
<!--                <span class="c-color c-purple1" data-color="purple1"></span>-->
<!--                <span class="c-color c-purple2" data-color="purple2"></span>-->
<!--                <span class="c-color c-purple3" data-color="purple3"></span>-->
<!---->
<!--                <span class="c-color c-blue1" data-color="blue1"></span>-->
<!--                <span class="c-color c-blue2" data-color="blue2"></span>-->
<!--                <span class="c-color c-blue3" data-color="blue3"></span>-->
<!---->
<!--                <span class="c-color c-brown1" data-color="brown1"></span>-->
<!--                <span class="c-color c-brown2" data-color="brown2"></span>-->
<!--                <span class="c-color c-brown3" data-color="brown3"></span>-->
<!---->
<!--                <span class="c-color c-dark1" data-color="dark1"></span>-->
<!--                <span class="c-color c-dark2" data-color="dark2"></span>-->
<!--                <span class="c-color c-dark3" data-color="dark3"></span>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="c-section">-->
<!--            <h3>Header Type</h3>-->
<!--            <div class="c-settings">-->
<!--                <input type="button" class="c-setting_header-type btn btn-sm c-btn-square c-btn-border-1x c-btn-white c-btn-sbold c-btn-uppercase active" data-value="boxed" value="boxed"/>-->
<!--                <input type="button" class="c-setting_header-type btn btn-sm c-btn-square c-btn-border-1x c-btn-white c-btn-sbold c-btn-uppercase" data-value="fluid" value="fluid"/>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="c-section">-->
<!--            <h3>Header Mode</h3>-->
<!--            <div class="c-settings">-->
<!--                <input type="button" class="c-setting_header-mode btn btn-sm c-btn-square c-btn-border-1x c-btn-white c-btn-sbold c-btn-uppercase active" data-value="fixed" value="fixed"/>-->
<!--                <input type="button" class="c-setting_header-mode btn btn-sm c-btn-square c-btn-border-1x c-btn-white c-btn-sbold c-btn-uppercase" data-value="static" value="static"/>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="c-section">-->
<!--            <h3>Mega Menu Style</h3>-->
<!--            <div class="c-settings">-->
<!--                <input type="button" class="c-setting_megamenu-style btn btn-sm c-btn-square c-btn-border-1x c-btn-white c-btn-sbold c-btn-uppercase active" data-value="dark" value="dark"/>-->
<!--                <input type="button" class="c-setting_megamenu-style btn btn-sm c-btn-square c-btn-border-1x c-btn-white c-btn-sbold c-btn-uppercase" data-value="light" value="light"/>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="c-section">-->
<!--            <h3>Font Style</h3>-->
<!--            <div class="c-settings">-->
<!--                <input type="button" class="c-setting_font-style btn btn-sm c-btn-square c-btn-border-1x c-btn-white c-btn-sbold c-btn-uppercase active" data-value="default" value="default"/>-->
<!--                <input type="button" class="c-setting_font-style btn btn-sm c-btn-square c-btn-border-1x c-btn-white c-btn-sbold c-btn-uppercase" data-value="light" value="light"/>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="c-section">-->
<!--            <h3>Reading Style</h3>-->
<!--            <div class="c-settings">-->
<!--                <a href="http://www.themehats.com/themes/jango/" class="c-setting_font-style btn btn-sm c-btn-square c-btn-border-1x c-btn-white c-btn-sbold c-btn-uppercase active">LTR</a>-->
<!--                <a href="http://www.themehats.com/themes/jango/rtl/" class="c-setting_font-style btn btn-sm c-btn-square c-btn-border-1x c-btn-white c-btn-sbold c-btn-uppercase ">RTL</a>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</nav><!-- END: LAYOUT/SIDEBARS/QUICK-SIDEBAR -->

<!-- BEGIN: PAGE CONTAINER -->
<?= $content ?>
<!-- END: PAGE CONTAINER -->

<!-- BEGIN: LAYOUT/FOOTERS/FOOTER-10 -->
<a name="footer"></a>
<footer class="c-layout-footer c-layout-footer-10 c-bg-white">
    <div class="c-footer">
        <div class="c-layout-footer-10-content container">
            <div class="row">
                <div class="col-md-5">
                    <div class="c-layout-footer-10-title-container">
                        <h3 class="c-layout-footer-10-title">Company Overview</h3>
                        <div class="c-layout-footer-10-title-line"><span class="c-theme-bg"></span></div>
                    </div>
                    <p class="c-layout-footer-10-desc">
                        Lorem ipsum dolor amet adipicing noummy eit seat dias estudiat elit dolore et isum siady et dolor amet adipicing noummy set dias set estudat eliat dolore isum siad set dias noummy
                    </p>
                </div>
                <div class="col-md-7">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="c-layout-footer-10-title-container">
                                <h3 class="c-layout-footer-10-title">About Us</h3>
                                <div class="c-layout-footer-10-title-line"><span class="c-theme-bg"> </span></div>
                            </div>
                            <ul class="c-layout-footer-10-list">
                                <li class="c-layout-footer-10-list-item"><a href="#">Contact Us</a></li>
                                <li class="c-layout-footer-10-list-item"><a href="#">Branches</a></li>
                                <li class="c-layout-footer-10-list-item"><a href="#">Our Blog</a></li>
                                <li class="c-layout-footer-10-list-item"><a href="#">Careers</a></li>
                            </ul>
                        </div>
                        <div class="col-md-3">
                            <div class="c-layout-footer-10-title-container">
                                <h3 class="c-layout-footer-10-title">Services</h3>
                                <div class="c-layout-footer-10-title-line"><span class="c-theme-bg"> </span></div>
                            </div>
                            <ul class="c-layout-footer-10-list">
                                <li class="c-layout-footer-10-list-item"><a href="#">Advisory</a></li>
                                <li class="c-layout-footer-10-list-item"><a href="#">Institute</a></li>
                                <li class="c-layout-footer-10-list-item"><a href="#">Strategy</a></li>
                                <li class="c-layout-footer-10-list-item"><a href="#">Alliances</a></li>
                            </ul>
                        </div>
                        <div class="col-md-3">
                            <div class="c-layout-footer-10-title-container">
                                <h3 class="c-layout-footer-10-title">Partners</h3>
                                <div class="c-layout-footer-10-title-line"><span class="c-theme-bg"></span></div>
                            </div>
                            <ul class="c-layout-footer-10-list">
                                <li class="c-layout-footer-10-list-item"><a href="#">Clients</a></li>
                                <li class="c-layout-footer-10-list-item"><a href="#">Suppliers</a></li>
                                <li class="c-layout-footer-10-list-item"><a href="#">Investors</a></li>
                                <li class="c-layout-footer-10-list-item"><a href="#">Groups</a></li>
                            </ul>
                        </div>
                        <div class="col-md-3">
                            <div class="c-layout-footer-10-title-container">
                                <h3 class="c-layout-footer-10-title">Achievements</h3>
                                <div class="c-layout-footer-10-title-line"><span class="c-theme-bg"></span></div>
                            </div>
                            <ul class="c-layout-footer-10-list">
                                <li class="c-layout-footer-10-list-item"><a href="#">Awards</a></li>
                                <li class="c-layout-footer-10-list-item"><a href="#">Trophies</a></li>
                                <li class="c-layout-footer-10-list-item"><a href="#">Our Patents</a></li>
                                <li class="c-layout-footer-10-list-item"><a href="#">Key People</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="c-layout-footer-10-subfooter-container c-bg-grey">
            <div class="c-layout-footer-10-subfooter container">
                <div class="c-layout-footer-10-subfooter-content">
                    Copyright © 2017 JANGO Theme. All Rights Reserved.
                </div>
                <div class="c-layout-footer-10-subfooter-social">
                    <ul>
                        <li><a href="#" class="socicon-btn socicon-twitter tooltips" data-original-title="Twitter"></a></li>
                        <li><a href="#" class="socicon-btn socicon-facebook tooltips" data-original-title="Facebook"></a></li>
                        <li><a href="#" class="socicon-btn socicon-google tooltips" data-original-title="Google"></a></li>
                        <li><a href="#" class="socicon-btn socicon-yahoo tooltips" data-original-title="Yahoo"></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer><!-- END: LAYOUT/FOOTERS/FOOTER-10 -->

<!-- BEGIN: LAYOUT/FOOTERS/GO2TOP -->
<div class="c-layout-go2top">
    <i class="icon-arrow-up"></i>
</div><!-- END: LAYOUT/FOOTERS/GO2TOP -->

<!-- BEGIN: LAYOUT/BASE/BOTTOM -->
<!-- BEGIN: CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?= $link ?>/global/plugins/excanvas.min.js"></script>
<![endif]-->
<script src="<?= $link ?>/plugins/jquery.min.js" type="text/javascript" ></script>
<script src="<?= $link ?>/plugins/jquery-migrate.min.js" type="text/javascript" ></script>
<script src="<?= $link ?>/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript" ></script>
<script src="<?= $link ?>/plugins/jquery.easing.min.js" type="text/javascript" ></script>
<script src="<?= $link ?>/plugins/reveal-animate/wow.js" type="text/javascript" ></script>
<script src="<?= $link ?>/agency/js/scripts/reveal-animate/reveal-animate.js" type="text/javascript" ></script>

<!-- END: CORE PLUGINS -->

<!-- BEGIN: LAYOUT PLUGINS -->
<script src="<?= $link ?>/plugins/revo-slider/js/jquery.themepunch.tools.min.js" type="text/javascript"></script>
<script src="<?= $link ?>/plugins/revo-slider/js/jquery.themepunch.revolution.min.js" type="text/javascript"></script>
<script src="<?= $link ?>/plugins/revo-slider/js/extensions/revolution.extension.slideanims.min.js" type="text/javascript"></script>
<script src="<?= $link ?>/plugins/revo-slider/js/extensions/revolution.extension.layeranimation.min.js" type="text/javascript"></script>
<script src="<?= $link ?>/plugins/revo-slider/js/extensions/revolution.extension.navigation.min.js" type="text/javascript"></script>
<script src="<?= $link ?>/plugins/revo-slider/js/extensions/revolution.extension.video.min.js" type="text/javascript"></script>
<script src="<?= $link ?>/plugins/revo-slider/js/extensions/revolution.extension.parallax.min.js" type="text/javascript"></script>
<script src="<?= $link ?>/plugins/cubeportfolio/js/jquery.cubeportfolio.min.js" type="text/javascript"></script>
<script src="<?= $link ?>/plugins/owl-carousel/owl.carousel.min.js" type="text/javascript"></script>
<script src="<?= $link ?>/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
<script src="<?= $link ?>/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
<script src="<?= $link ?>/plugins/fancybox/jquery.fancybox.pack.js" type="text/javascript"></script>
<script src="<?= $link ?>/plugins/smooth-scroll/jquery.smooth-scroll.js" type="text/javascript"></script>
<script src="<?= $link ?>/plugins/typed/typed.min.js" type="text/javascript"></script>
<script src="<?= $link ?>/plugins/slider-for-bootstrap/js/bootstrap-slider.js" type="text/javascript"></script>
<script src="<?= $link ?>/plugins/js-cookie/js.cookie.js" type="text/javascript"></script>
<!-- END: LAYOUT PLUGINS -->

<!-- BEGIN: THEME SCRIPTS -->
<script src="<?= $link ?>/base/js/components.js" type="text/javascript"></script>
<script src="<?= $link ?>/base/js/components-shop.js" type="text/javascript"></script>
<script src="<?= $link ?>/base/js/app.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        App.init(); // init core
    });
</script>
<!-- END: THEME SCRIPTS -->

<!-- BEGIN: PAGE SCRIPTS -->
<script src="<?= $link ?>/corporate/js/scripts/revo-slider/slider-13.js" type="text/javascript"></script>
<script src="<?= $link ?>/plugins/isotope/isotope.pkgd.min.js" type="text/javascript"></script>
<script src="<?= $link ?>/plugins/isotope/imagesloaded.pkgd.min.js" type="text/javascript"></script>
<script src="<?= $link ?>/plugins/isotope/packery-mode.pkgd.min.js" type="text/javascript"></script>
<script src="<?= $link ?>/plugins/ilightbox/js/jquery.requestAnimationFrame.js" type="text/javascript"></script>
<script src="<?= $link ?>/plugins/ilightbox/js/jquery.mousewheel.js" type="text/javascript"></script>
<script src="<?= $link ?>/plugins/ilightbox/js/ilightbox.packed.js" type="text/javascript"></script>
<script src="<?= $link ?>/default/js/scripts/pages/isotope-gallery.js" type="text/javascript"></script>
<script src="<?= $link ?>/plugins/revo-slider/js/extensions/revolution.extension.parallax.min.js" type="text/javascript"></script>
<script src="<?= $link ?>/plugins/revo-slider/js/extensions/revolution.extension.kenburn.min.js" type="text/javascript"></script>
<!-- END: PAGE SCRIPTS -->
<!-- END: LAYOUT/BASE/BOTTOM -->
</body>
</html>