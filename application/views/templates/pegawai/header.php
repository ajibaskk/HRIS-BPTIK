<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link href="<?= base_url("assets\img\logo.png"); ?>" rel="shortcut icon">
    <title><?= $title; ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="theme-color" content="#FFFFFF"/>
    <!-- Manifest -->
    <link rel="manifest" href="<?= base_url("manifest.json"); ?>">
    <link rel="apple-touch-icon" sizes="72x72" href="<?= base_url("assets/icon/icon-72x72.png"); ?>">
    <link rel="apple-touch-icon" sizes="96x96" href="<?= base_url("assets/icon/icon-96x96.png"); ?>">
    <link rel="apple-touch-icon" sizes="128x128" href="<?= base_url("assets/icon/icon-128x128.png"); ?>">
    <link rel="apple-touch-icon" sizes="144x144" href="<?= base_url("assets/icon/icon-144x144.png"); ?>">
    <link rel="apple-touch-icon" sizes="152x152" href="<?= base_url("assets/icon/icon-152x152.png"); ?>">
    <link rel="apple-touch-icon" sizes="192x192" href="<?= base_url("assets/icon/icon-192x192.png"); ?>">
    <link rel="apple-touch-icon" sizes="384x384" href="<?= base_url("assets/icon/icon-384x384.png"); ?>">
    <link rel="apple-touch-icon" sizes="512x512" href="<?= base_url("assets/icon/icon-512x512.png"); ?>">

    <noscript>
        <meta http-equiv="refresh" content="0; url=<?= base_url('ErrorHandler/noJs'); ?>" />
    </noscript>

    <?= '<script>const base_url = "' . base_url() . '";</script>' ?>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url("plugins/fontawesome-free/css/all.min.css"); ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?= base_url("dist/css/ionicons.min.css"); ?>">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="<?= base_url("plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css"); ?>">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?= base_url("plugins/icheck-bootstrap/icheck-bootstrap.min.css"); ?>">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?= base_url("plugins/jqvmap/jqvmap.min.css"); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url("dist/css/adminlte.min.css"); ?>">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= base_url("plugins/overlayScrollbars/css/OverlayScrollbars.min.css"); ?>">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?= base_url("plugins/daterangepicker/daterangepicker.css"); ?>">
    <!-- summernote -->
    <link rel="stylesheet" href="<?= base_url("plugins/summernote/summernote-bs4.css"); ?>">
    <!-- global -->
    <link rel="stylesheet" href="<?= base_url("assets/css/global.css"); ?>">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- jQuery -->
    <script src="<?= base_url("plugins/jquery/jquery.min.js"); ?>"></script>
    <!-- jQuery UI -->
    <script src="<?= base_url("plugins/jquery-ui/jquery-ui.min.js"); ?>"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url("plugins/bootstrap/js/bootstrap.bundle.min.js"); ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url("dist/js/adminlte.min.js"); ?>"></script>
    <!-- global JS -->
    <script src="<?= base_url("assets/js/global.js"); ?>"></script>

    <?php
    if (isset($css)) {
        foreach ($css as $c) {
            echo '<link rel="stylesheet" href="' . $c . '">';
        }
    }
    if (isset($js_header)) {
        foreach ($js_header as $jsh) {
            echo '<script src="' . $jsh . '"></script>';
        }
    }
    ?>

</head>

<body class="sidebar-mini layout-navbar-fixed layout-fixed">
<div id="loading" style="width: 100%; height: 100%; top: 0; left: 0; position: fixed; display: block; opacity: 0.7; background-color: #fff; z-index: 99; text-align: center;"><img id="loading-image" src="<?= base_url("assets/img/loading.svg"); ?>" alt="Loading..." style="position: absolute; top: 0; left: 0; bottom: 0; right: 0; margin: auto; z-index: 100;"/></div>
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-primary navbar-dark">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-ite">
                    <a href="<?= base_url('authentication/logout'); ?>" class="btn btn-danger">Log Out</a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-primary elevation-4">
            <!-- Brand Logo -->
            <a href="<?= base_url(); ?>" class="brand-link">
                <div class="login-logo brand-image">
                    <img src="<?= base_url("assets/img/logo.png"); ?>" alt="HRIS">
                    <span class="brand-text">HRIS BPTIK Jawa Tengah</span>
                </div>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 d-flex">
                    <div class="image">
                        <img src="
                        <?php
                        $user = $this->user->getUserSidebar($this->session->userdata('user')['nip']);
                        if (strlen($user['foto']) == 0) {
                            echo base_url('assets/img/user.svg');
                        } else {
                            echo 'data:image/jpeg;base64,' . $user['foto'];
                        }
                        ?>
                        " class="img-circle elevation-2" alt="User Image" style="width: 2.5rem; height: 2rem;">
                    </div>
                    <div class="info">
                        <a href="<?= base_url('profile'); ?>" class="d-block"><?= $user['nama']; ?></a>
                        <small><?= $user['nip']; ?></small>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="<?= base_url(); ?>" class="nav-link <?php if (isset($beranda)) echo 'active'; ?>">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Beranda
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('struktur'); ?>" class="nav-link <?php if (isset($struktur)) echo 'active'; ?>">
                                <i class="nav-icon fas fa-sitemap"></i>
                                <p style="font-size: 16px;">
                                    Struktur Organisasi
                                </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview <?php if (isset($daftar_pegawai) || isset($cuti_pegawai) || isset($riwayat_cuti_pegawai) || isset($form_dinas_luar) || isset($riwayat_dinas_luar)) echo 'menu-open'; ?>">
                            <a href="#" class="nav-link <?php if (isset($daftar_pegawai) || isset($cuti_pegawai)  || isset($riwayat_cuti_pegawai) || isset($form_dinas_luar) || isset($riwayat_dinas_luar)) echo 'active'; ?>">
                                <i class="nav-icon fas fa-user"></i>
                                <p style="font-size: 18px;">
                                    Kepegawaian
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= base_url('kepegawaian/daftar_pegawai'); ?>" class="nav-link pl-4 <?php if (isset($daftar_pegawai)) echo 'active'; ?>">
                                        <i class="nav-icon fas fa-users"></i>
                                        <p style="font-size: 12px;">Daftar Pegawai Non PNS</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('kepegawaian/menu_cuti_pegawai'); ?>" class="nav-link pl-4 <?php if (isset($cuti_pegawai)) echo 'active'; ?>">
                                        <i class="nav-icon fas fa-file"></i>
                                        <p>Pengajuan Cuti</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('kepegawaian/riwayat_cuti_pegawai'); ?>" class="nav-link pl-4 <?php if (isset($riwayat_cuti_pegawai)) echo 'active'; ?>">
                                        <i class="nav-icon fas fa-list"></i>
                                        <p style="font-size: 14px;">Riwayat Pengajuan Cuti</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('kepegawaian/form_dinas_luar'); ?>" class="nav-link pl-4 <?php if (isset($form_dinas_luar)) echo 'active'; ?>">
                                        <i class="nav-icon fas fa-file"></i>
                                        <p style="font-size: 14px;">Form Dinas Luar</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('kepegawaian/riwayat_dinas_luar'); ?>" class="nav-link pl-4 <?php if (isset($riwayat_dinas_luar)) echo 'active'; ?>">
                                        <i class="nav-icon fas fa-list"></i>
                                        <p style="font-size: 14px;">Riwayat Dinas Luar</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview <?php if (isset($cek_kehadiran) || isset($analisis_kehadiran)) echo 'menu-open'; ?>">
                            <a href="#" class="nav-link <?php if (isset($cek_kehadiran) || isset($analisis_kehadiran)) echo 'active'; ?>">
                                <i class="nav-icon fas fa-fingerprint"></i>
                                <p style="font-size: 18px;">
                                    Kehadiran
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= base_url('kehadiran/cek_kehadiran'); ?>" class="nav-link pl-4 <?php if (isset($cek_kehadiran)) echo 'active'; ?>">
                                        <i class="nav-icon fas fa-check"></i>
                                        <p style="font-size: 16px;">
                                            Cek Kehadiran
                                        </p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= base_url('kehadiran/analisis_kehadiran'); ?>" class="nav-link pl-4 <?php if (isset($analisis_kehadiran)) echo 'active'; ?>">
                                        <i class="nav-icon fas fa-chart-bar"></i>
                                        <p style="font-size: 16px;">
                                            Analisis Kehadiran
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">