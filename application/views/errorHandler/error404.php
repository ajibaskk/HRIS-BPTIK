<!DOCTYPE html>
<html>


<head>
    <meta charset="utf-8">
    <link href="<?= base_url("assets\img\logo.png"); ?>" rel="shortcut icon">
    <title>Error Handler | HRIS | BPTIK Jawa Tengah</title>
    <link href="<?= base_url("assets\img\logo.png"); ?>" rel="sortcut icon">
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
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url("plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css"); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url("dist/css/adminlte.min.css"); ?>">
    <!-- style -->
    <link rel="stylesheet" href="<?= base_url("assets/css/authentication/login.css"); ?>">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- jQuery -->
    <script src="<?= base_url("plugins/jquery/jquery.min.js"); ?>"></script>
    <!-- global JS -->
    <script src="<?= base_url("assets/js/global.js"); ?>"></script>

    <style>
        body {
            background-image: url('<?= base_url("assets/img/bptik.png"); ?>') !important;
            background-repeat: no-repeat !important;
            background-attachment: fixed !important;
            background-size: 100% 110% !important;
            background-color: rgba(0, 0, 0, 0.5) !important;
        }
    </style>

</head>


<body class="hold-transition text-center login-page">
    <div class="login pl-4">
        <div class="login-box">
            <div class="login-logo">
                <img src=<?= base_url("assets/img/logo.png"); ?> width="100px" alt="HRIS">
            </div>
            <!-- /.login-logo -->
            <div class="card">
                <div class="card-header mt-3">
                    <h1>ERROR</h1>
                </div>
                <div class="card-body login-card-body">
                    <h3 class="login-box-msg">ERROR 404</h3>
                    <h5 class="text-center">Halaman yang anda minta tidak ditemukan.</h5>
                    <a href="<?= base_url(); ?>" class="btn btn-primary btn-block">Kembali</a>
                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
        <!-- /.login-box -->
    </div>

    <!-- jQuery -->
    <script src="<?= base_url("plugins/jquery/jquery.min.js"); ?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url("plugins/bootstrap/js/bootstrap.bundle.min.js"); ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url("dist/js/adminlte.js"); ?>"></script>
</body>

</html>