<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Sistem Informasi Bimbel.">
    <meta name="keywords" content="Sistem Informasi Bimbel">
    <meta name="author" content="ThemeSelect">
    <title>Daftar Siswa | Sistem Informasi Bimbel</title>
    <link rel="apple-touch-icon" href="<?= base_url() ?>app-assets/images/favicon/apple-touch-icon-152x152.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url() ?>app-assets/images/favicon/favicon-32x32.png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- BEGIN: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>app-assets/vendors/vendors.min.css">
    <!-- END: VENDOR CSS-->
    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>app-assets/css/themes/vertical-gradient-menu-template/materialize.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>app-assets/css/themes/vertical-gradient-menu-template/style.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>app-assets/css/pages/register.css">
    <!-- END: Page Level CSS-->
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>app-assets/css/custom/custom.css">
    <!-- END: Custom CSS-->
</head>
<!-- END: Head-->


<div class="flash-data-success" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>
<div class="flash-data-info" data-flashdata="<?= $this->session->flashdata('info'); ?>"></div>
<div class="flash-data-error" data-flashdata="<?= $this->session->flashdata('error'); ?>"></div>
<body class="vertical-layout page-header-light vertical-menu-collapsible vertical-gradient-menu preload-transitions 1-column register-bg   blank-page blank-page" data-open="click" data-menu="vertical-gradient-menu" data-col="1-column">
    <div class="row">
        <div class="col s12">
            <div class="container">
                <div id="register-page" class="row" style="height:100%">
                    <div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 register-card bg-opacity-8" style="width: 80%">
                        <form class="login-form" action="<?= base_url('auth/daftar_siswa') ?>" method="POST">                           
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <div id="basic-tabs" class="card card card-default scrollspy">
                                        <div class="card-content">
                                            <div class="card-title">
                                                <div class="row">
                                                    <div class="col s12 m6 l10">
                                                        <h4 class="card-title">Daftar Siswa</h4>
                                                        <!-- <p>
                                                            When you click on each tab, only the container with the corresponding tab id will become visible.
                                                        </p> -->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col s12">
                                                    <div class="row" id="main-view">
                                                        <div class="col s12">
                                                            <div id="test1" class="col s12 tab-pane">
                                                                <div class="row margin validasi">
                                                                    <div class="input-field col s12">
                                                                        <input id="email" type="text" name="email" required>
                                                                        <label for="email" class="center-align">EMAIL</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="test2" class="col s12 tab-pane">
                                                                <div class="row margin validasi">
                                                                    <div class="input-field col s12">
                                                                        <input id="username" type="text" name="username" required>
                                                                        <label for="username" class="center-align">Nama Lengkap</label>
                                                                    </div>
                                                                </div>
                                                                <div class="row margin validasi">
                                                                    <div class="input-field col s12">
                                                                        <select name="jenis_kelamin" id="jenis_kelamin" required>
                                                                            <option value="">--Pilih Jenis Kelamin--</option>
                                                                            <option value="Laki-Laki">Laki-Laki</option>
                                                                            <option value="Perempuan">Perempuan</option>
                                                                        </select>
                                                                        <label for="jenis_kelamin" class="center-align">Jenis Kelamin</label>
                                                                    </div>
                                                                </div>
                                                                <div class="row margin validasi">
                                                                    <div class="input-field col s12">
                                                                        <input id="tgl_lahir" type="date" name="tgl_lahir" required>
                                                                        <label for="tgl_lahir" class="center-align">Tanggal Lahir</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="test3" class="col s12 tab-pane">
                                                                <div class="row margin validasi">
                                                                    <div class="input-field col s12">
                                                                        <input id="password" type="password" name="password" required>
                                                                        <label for="password" class="center-align">Password</label>
                                                                    </div>
                                                                </div>
                                                                <div class="row margin validasi">
                                                                    <div class="input-field col s12">
                                                                        <input id="confirm_password" type="password" name="confirm_password" required>
                                                                        <label for="confirm_password" class="center-align">Confirm Password</label>
                                                                        <span id="message"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="row margin validasi">
                                                                    <div class="col s6">
                                                                        <div id="captcha_img"></div>
                                                                    </div>
                                                                    <div class="col s6">
                                                                        <button class="btn btn-primary btn-sm" type="button" id="refresh"><small>refresh</small></button><br />
                                                                    </div>
                                                                </div>
                                                                <div class="row margin validasi">
                                                                    <div class="input-field col s12">
                                                                        <input id="captcha" type="text" name="captcha" required>
                                                                        <label for="captcha" class="center-align">Masukan Kode Captcha</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" id="simpan" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="content-overlay"></div>
        </div>
    </div>

    <!-- BEGIN VENDOR JS-->
    <script src="<?= base_url() ?>app-assets/js/vendors.min.js"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN THEME  JS-->
    <script src="<?= base_url() ?>app-assets/js/plugins.js"></script>
    <script src="<?= base_url() ?>app-assets/js/search.js"></script>
    <script src="<?= base_url() ?>app-assets/js/custom/custom-script.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?= base_url() ?>assets/alert.js"></script>
    <!-- END THEME  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <!-- END PAGE LEVEL JS-->
    <script>
        $(function() {
            get_captcha();
            
            $('#refresh').click(function() {
                get_captcha();
            })
        })
        function get_captcha() {
            $.ajax({
                url: '<?= base_url('auth/get_captcha') ?>',
                method: 'POST',
                dataType: 'JSON',
                success: function(result) {
                    var html = result.captcha;
                    $('#captcha_img').html(html)
                } 
            })
        }

        $('#confirm_password').keyup(function() {
            var val = $(this).val();
            var val2 = $('#password').val()
            if(val == val2) {
                $('#message').html('Matching')
                $('#simpan').prop('disabled', false)
            } else {
                $('#message').html('(*) Not Matching').css({'color': "red"})
                $('#simpan').prop('disabled', true)
            }
        })
    </script>
</body>

</html>