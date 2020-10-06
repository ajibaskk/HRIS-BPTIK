<!DOCTYPE html>
<html>


<head>
    <meta charset="utf-8">
    <link href="<?= base_url("assets\img\logo.png"); ?>" rel="shortcut icon">
    <title><?= $title; ?></title>
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
<div id="loading" style="width: 100%; height: 100%; top: 0; left: 0; position: fixed; display: block; opacity: 0.7; background-color: #fff; z-index: 99; text-align: center;"><img id="loading-image" src="<?= base_url("assets/img/loading.svg"); ?>" alt="Loading..." style="position: absolute; top: 0; left: 0; bottom: 0; right: 0; margin: auto; z-index: 100;"/></div>
    <div class="login pl-4">
        <div class="login-box">
            <div class="login-logo">
                <img src=<?= base_url("assets/img/logo.png"); ?> width="100px" alt="HRIS">
            </div>
            <!-- /.login-logo -->
            <div class="card">
                <div class="card-header mt-3">
                    <a>LOGIN</a>
                </div>
                <div class="card-body login-card-body">
                    <p class="login-box-msg">HUMAN RESOURCE INFORMATION SYSTEM NON PNS BPTIK PROVINSI JAWA TENGAH</p>

                    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                        <?= $this->session->flashdata('message'); ?>
                        <div class="mb-3">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Username" name="username" value="<?= set_value('username'); ?>">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fa fa-user"></span>
                                    </div>
                                </div>
                            </div>
                            <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="mb-3">
                            <div class="input-group">
                                <input type="password" class="form-control" placeholder="Password" name="password">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                            <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div>
                            <div>
                                <input type="submit" class="btn btn-primary btn-block" value="Login"></input>
                            </div>
                        </div>
                    </form>
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