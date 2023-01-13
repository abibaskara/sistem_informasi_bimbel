<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google.">
    <meta name="keywords" content="materialize, admin template, dashboard template, flat admin template, responsive admin template, eCommerce dashboard, analytic dashboard">
    <meta name="author" content="ThemeSelect">
    <title>Dashboard eCommerce | Materialize - Material Design Admin Template</title>
    <link rel="apple-touch-icon" href="<?= base_url() ?>app-assets/images/favicon/apple-touch-icon-152x152.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url() ?>app-assets/images/favicon/favicon-32x32.png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- BEGIN: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>app-assets/vendors/vendors.min.css">
    <!-- END: VENDOR CSS-->
    <link rel="stylesheet" href="<?= base_url() ?>app-assets/vendors/select2/select2.min.css" type="text/css">
    <link rel="stylesheet" href="<?= base_url() ?>app-assets/vendors/select2/select2-materialize.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>app-assets/css/pages/form-select2.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>app-assets/vendors/flag-icon/css/flag-icon.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>app-assets/vendors/noUiSlider/nouislider.min.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>app-assets/css/pages/app-invoice.css">
    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>app-assets/css/themes/vertical-gradient-menu-template/materialize.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>app-assets/css/themes/vertical-gradient-menu-template/style.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>app-assets/css/pages/dashboard.css">


    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>app-assets/vendors/data-tables/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>app-assets/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>app-assets/vendors/data-tables/css/select.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>app-assets/vendors/dropify/css/dropify.min.css">
    
    <!-- END: Page Level CSS-->
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>app-assets/css/custom/custom.css">
    <!-- END: Custom CSS-->
</head>
<!-- END: Head-->

<body class="vertical-layout page-header-light vertical-menu-collapsible vertical-gradient-menu preload-transitions 2-columns   " data-open="click" data-menu="vertical-gradient-menu" data-col="2-columns">

    <!-- BEGIN: Header-->
    <header class="page-topbar" id="header">
        <div class="navbar navbar-fixed">
            <nav class="navbar-main navbar-color nav-collapsible sideNav-lock navbar-light">
                <div class="nav-wrapper">
                    <ul class="navbar-list right">
                        <!-- <li class="dropdown-language"><a class="waves-effect waves-block waves-light translation-button" href="#" data-target="translation-dropdown"><span class="flag-icon flag-icon-gb"></span></a></li> -->
                        <li class="hide-on-med-and-down"><a class="waves-effect waves-block waves-light toggle-fullscreen" href="javascript:void(0);"><i class="material-icons">settings_overscan</i></a></li>
                        <!-- <li class="hide-on-large-only search-input-wrapper"><a class="waves-effect waves-block waves-light search-button" href="javascript:void(0);"><i class="material-icons">search</i></a></li> -->
                        <!-- <li><a class="waves-effect waves-block waves-light notification-button" href="javascript:void(0);" data-target="notifications-dropdown"><i class="material-icons">notifications_none<small class="notification-badge">5</small></i></a></li> -->
                        <li><a class="waves-effect waves-block waves-light profile-button" href="javascript:void(0);" data-target="profile-dropdown"><span class="avatar-status avatar-online"><img src="<?= base_url() ?>foto/<?= $this->session->name ?>" alt="avatar"><i></i></span></a></li>
                    </ul>
                    <!-- profile-dropdown-->
                    <ul class="dropdown-content" id="profile-dropdown">
                        <li><a class="grey-text text-darken-1" href="user-profile-page.html"><i class="material-icons">person_outline</i> Profile</a></li>
                        <li class="divider"></li>
                        <li><a class="grey-text text-darken-1" href="<?= base_url('Auth/logout') ?>"><i class="material-icons">keyboard_tab</i> Logout</a></li>
                    </ul>
                </div>
                <nav class="display-none search-sm">
                    <div class="nav-wrapper">
                        <form id="navbarForm">
                            <div class="input-field search-input-sm">
                                <input class="search-box-sm mb-0" type="search" required="" id="search" placeholder="Explore Materialize" data-search="template-list">
                                <label class="label-icon" for="search"><i class="material-icons search-sm-icon">search</i></label><i class="material-icons search-sm-close">close</i>
                                <ul class="search-list collection search-list-sm display-none"></ul>
                            </div>
                        </form>
                    </div>
                </nav>
            </nav>
        </div>
    </header>
    <!-- END: Header-->



    <!-- BEGIN: SideNav-->
    <aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-dark gradient-45deg-deep-purple-blue sidenav-gradient sidenav-active-rounded">
        <div class="brand-sidebar">
            <h1 class="logo-wrapper"><a class="brand-logo darken-1" href="index.html"><img class="hide-on-med-and-down " src="<?= base_url() ?>app-assets/images/logo/materialize-logo.png" alt="materialize logo" /><img class="show-on-medium-and-down hide-on-med-and-up" src="<?= base_url() ?>app-assets/images/logo/materialize-logo-color.png" alt="materialize logo" /><span class="logo-text hide-on-med-and-down">Materialize</span></a><a class="navbar-toggler" href="#"><i class="material-icons">radio_button_checked</i></a></h1>
        </div>
        
        <?php if($this->session->role == '1') { ?> 
            <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out" data-menu="menu-navigation" data-collapsible="menu-accordion">
                <li class="bold"><a class="waves-effect waves-cyan " href="#"><i class="material-icons">settings_input_svideo</i><span class="menu-title" data-i18n="Dashboard">Dashboard</span></a>
                </li>    
                <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)"><i class="material-icons">settings_input_svideo</i><span class="menu-title" data-i18n="DataMaster">Data Master</span></a>
                    <div class="collapsible-body">
                        <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                            <li><a href="<?= base_url('staff/kelas') ?>"><i class="material-icons">radio_button_unchecked</i><span data-i18n="DataKelas">Data Kelas</span></a>
                            </li>
                            <li><a href="<?= base_url('staff/matpel') ?>"><i class="material-icons">radio_button_unchecked</i><span data-i18n="MataPelajaran">Mata Pelajaran</span></a>
                            </li>
                            <!-- <li><a href="#"><i class="material-icons">radio_button_unchecked</i><span data-i18n="User">User</span></a>
                            </li> -->
                            <li><a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)"><i class="material-icons">settings_input_svideo</i><span class="menu-title" data-i18n="User">User</span></a>
                                <div class="collapsible-body">
                                    <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                                        <li><a href="<?= base_url('staff/user/siswa') ?>"><i class="material-icons">radio_button_unchecked</i><span data-i18n="TarifSPP">Siswa</span></a>
                                        </li>
                                        <li><a href="<?= base_url('staff/user/guru') ?>"><i class="material-icons">radio_button_unchecked</i><span data-i18n="MataPelajaran">Guru</span></a>
                                        </li>
                                        <li><a href="<?= base_url('staff/user/kepala_bimba') ?>"><i class="material-icons">radio_button_unchecked</i><span data-i18n="MataPelajaran">Kepala Bimba</span></a>
                                        </li>
                                        <li><a href="<?= base_url('staff/user/wali_kelas') ?>"><i class="material-icons">radio_button_unchecked</i><span data-i18n="MataPelajaran">Wali Kelas</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="navigation-header"><a class="navigation-header-text">Data</a><i class="navigation-header-icon material-icons">more_horiz</i>
                </li>
                <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)"><i class="material-icons">settings_input_svideo</i><span class="menu-title" data-i18n="DataMaster">Pembayaran SPP</span></a>
                    <div class="collapsible-body">
                        <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                            <li><a href="<?= base_url('staff/tarif_spp') ?>"><i class="material-icons">radio_button_unchecked</i><span data-i18n="TarifSPP">Tarif SPP</span></a>
                            </li>
                            <li><a href="<?= base_url('staff/riwayat_pembayaran_spp') ?>"><i class="material-icons">radio_button_unchecked</i><span data-i18n="MataPelajaran">Riwayat Pembayaran</span></a>
                            </li>
                            <!-- <li><a href="#"><i class="material-icons">radio_button_unchecked</i><span data-i18n="User">User</span></a>
                            </li> -->
                            
                        </ul>
                    </div>
                </li>
                
            </ul>
        <?php } elseif($this->session->role == '2') { 
            if($this->session->status == '1') {
            ?> 
            <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out" data-menu="menu-navigation" data-collapsible="menu-accordion">
                <li class="bold"><a class="waves-effect waves-cyan " href="#"><i class="material-icons">settings_input_svideo</i><span class="menu-title" data-i18n="Dashboard">Dashboard</span></a>
                </li>    
                <li class="bold"><a class="waves-effect waves-cyan " href="<?= base_url('siswa/jenjang_sekolah_formal') ?>"><i class="material-icons">settings_input_svideo</i><span class="menu-title" data-i18n="Dashboard">Jenjang Sekolah Formal</span></a>
                </li>                
            </ul> 
            <?php } else { ?>
                <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out" data-menu="menu-navigation" data-collapsible="menu-accordion">
                    <li class="bold"><a class="waves-effect waves-cyan " href="#"><i class="material-icons">settings_input_svideo</i><span class="menu-title" data-i18n="Dashboard">Dashboard</span></a>
                    </li>    
                    <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)"><i class="material-icons">settings_input_svideo</i><span class="menu-title" data-i18n="DataMaster">Pembayaran SPP</span></a>
                        <div class="collapsible-body">
                            <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                                <li><a href="<?= base_url('siswa/riwayat_pembayaran_spp') ?>"><i class="material-icons">radio_button_unchecked</i><span data-i18n="DataKelas">Riwayat Pembayaran</span></a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="bold"><a class="waves-effect waves-cyan " href="<?= base_url('siswa/nilai') ?>"><i class="material-icons">settings_input_svideo</i><span class="menu-title" data-i18n="Dashboard">Daftar Nilai Pribadi</span></a>
                    </li>                
                </ul> 

        <?php } } elseif($this->session->role == '3') { ?> 
            <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out" data-menu="menu-navigation" data-collapsible="menu-accordion">
                <li class="bold"><a class="waves-effect waves-cyan " href="#"><i class="material-icons">settings_input_svideo</i><span class="menu-title" data-i18n="Dashboard">Dashboard</span></a>
                </li>    
                <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)"><i class="material-icons">settings_input_svideo</i><span class="menu-title" data-i18n="DataMaster">Penilaian Belajar</span></a>
                    <div class="collapsible-body">
                        <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                            <?php foreach ($kelas as $val) { ?> 
                                <li><a href="<?= base_url("guru/penilaian/$val->id_kelas") ?>"><i class="material-icons">radio_button_unchecked</i><span data-i18n="DataKelas"><?= $val->kelas ?></span></a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </li>  
                <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)"><i class="material-icons">settings_input_svideo</i><span class="menu-title" data-i18n="DataMaster">Prestasi</span></a>
                    <div class="collapsible-body">
                        <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                            <?php foreach ($kelas as $val) { ?> 
                                <li><a href="<?= base_url("guru/prestasi/$val->id_kelas") ?>"><i class="material-icons">radio_button_unchecked</i><span data-i18n="DataKelas"><?= $val->kelas ?></span></a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </li>
            </ul>
        <?php } elseif($this->session->role == '5') { ?> 
        <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out" data-menu="menu-navigation" data-collapsible="menu-accordion">
            <li class="bold"><a class="waves-effect waves-cyan " href="#"><i class="material-icons">settings_input_svideo</i><span class="menu-title" data-i18n="Dashboard">Dashboard</span></a>
            </li>    
            <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)"><i class="material-icons">settings_input_svideo</i><span class="menu-title" data-i18n="DataMaster">Data Master</span></a>
                <div class="collapsible-body">
                    <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                        <li><a href="<?= base_url('wali_kelas/kelas') ?>"><i class="material-icons">radio_button_unchecked</i><span data-i18n="DataKelas">Data Kelas</span></a>
                        </li>
                        <li><a href="<?= base_url('wali_kelas/matpel') ?>"><i class="material-icons">radio_button_unchecked</i><span data-i18n="MataPelajaran">Mata Pelajaran</span></a>
                        </li>
                        <!-- <li><a href="#"><i class="material-icons">radio_button_unchecked</i><span data-i18n="User">User</span></a>
                        </li> -->
                        <li><a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)"><i class="material-icons">settings_input_svideo</i><span class="menu-title" data-i18n="User">User</span></a>
                            <div class="collapsible-body">
                                <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                                    <li><a href="<?= base_url('wali_kelas/user/siswa') ?>"><i class="material-icons">radio_button_unchecked</i><span data-i18n="TarifSPP">Siswa</span></a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)"><i class="material-icons">settings_input_svideo</i><span class="menu-title" data-i18n="DataMaster">Nilai Matpel</span></a>
                <div class="collapsible-body">
                    <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                        <?php foreach($matpel as $val) { ?> 
                            <li><a href="<?= base_url("wali_kelas/nilai/$val->id_matpel") ?>"><i class="material-icons">radio_button_unchecked</i><span data-i18n="DataKelas"><?= $val->matpel ?></span></a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </li>
            <li class="bold"><a class="waves-effect waves-cyan " href="<?= base_url('wali_kelas/prestasi') ?>"><i class="material-icons">settings_input_svideo</i><span class="menu-title" data-i18n="Dashboard">Prestasi</span></a>
            </li>    
        </ul>
        <?php } ?>
        <div class="navigation-background"></div><a class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only" href="#" data-target="slide-out"><i class="material-icons">menu</i></a>
    </aside>
    <!-- END: SideNav-->

    <!-- BEGIN: Page Main-->
    <div id="main">
        <div class="row">
            <div class="col s12">
                <?= $contents ?>
                <div class="content-overlay"></div>
            </div>
        </div>
    </div>
    <!-- END: Page Main-->

    <!-- BEGIN: Footer-->

    <footer class="page-footer footer footer-static footer-light navbar-border navbar-shadow">
        <div class="footer-copyright">
            <div class="container"><span>&copy; 2020 <a href="http://themeforest.net/user/pixinvent/portfolio?ref=pixinvent" target="_blank">PIXINVENT</a> All rights reserved.</span><span class="right hide-on-small-only">Design and Developed by <a href="https://pixinvent.com/">PIXINVENT</a></span></div>
        </div>
    </footer>

    <!-- END: Footer-->
    <!-- BEGIN VENDOR JS-->
    <!-- <script src="<?= base_url() ?>app-assets/js/vendors.min.js"></script> -->
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->

    <!-- BEGIN PAGE VENDOR JS-->
    <script src="<?= base_url() ?>app-assets/vendors/data-tables/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>app-assets/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url() ?>app-assets/vendors/data-tables/js/dataTables.select.min.js"></script>

    <script src="<?= base_url() ?>app-assets/js/scripts/data-tables.js"></script>

    <script src="<?= base_url() ?>app-assets/js/scripts/advance-ui-modals.js"></script>

    <script src="<?= base_url() ?>app-assets/vendors/chartjs/chart.min.js"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN THEME  JS-->
    <script src="<?= base_url() ?>app-assets/js/plugins.js"></script>
    <script src="<?= base_url() ?>app-assets/js/search.js"></script>
    <script src="<?= base_url() ?>app-assets/js/custom/custom-script.js"></script>
    <!-- END THEME  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="<?= base_url() ?>app-assets/js/scripts/dashboard-ecommerce.js"></script>
    <!-- END PAGE LEVEL JS-->
    <!-- ALERT -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?= base_url() ?>assets/alert.js"></script>
</body>

</html>