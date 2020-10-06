<!-- Content Header (Page header) -->
<div class="content-header">
    <h1 class="text-dark ml-2">Beranda</h1>
</div>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card card-default color-palette-box">
            <div class="card-header">
                <h3 class="card-title h3">
                    <i class="fa fa-sitemap mr-2"></i>Struktur Organisasi
                </h3>
            </div>
            <!-- Small boxes (Stat box) -->

            <div class="card-body">
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-md-9 col-sm-12 m-2">
                        <!-- small box -->
                        <div class="small-box h-100 bg-gradient-gray">
                            <div class="inner mb-5">
                                <h2>Struktur Organisasi BPTIK Jawa Tengah</h2>
                            </div>
                            <div class="icon">
                                <i class="fa fa-sitemap"></i>
                            </div>
                            <a href="<?= base_url('struktur'); ?>" class="small-box-footer">Pilih <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="card card-default color-palette-box">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="ion ion-ios-people mr-2"></i>Kepegawaian
                </h3>
            </div>
            <!-- Small boxes (Stat box) -->

            <div class="card-body">
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-md-9 col-sm-12 m-2">
                        <!-- small box -->
                        <div class="small-box h-100 bg-info">
                            <div class="inner mb-5">
                                <h2>Daftar Pegawai Non PNS</h2>
                            </div>
                            <div class="icon">
                                <i class="ion ion-ios-people"></i>
                            </div>
                            <a href="<?= base_url('kepegawaian/daftar_pegawai'); ?>" class="small-box-footer">Pilih <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-xl-3 col-lg-6 col-md-9 col-sm-12 m-2">
                        <!-- small box -->
                        <div class="small-box h-100 bg-gradient-blue">
                            <div class="inner mb-5">
                                <h2>Pengajuan Cuti</h2>
                            </div>
                            <div class="icon">
                                <i class="fa fa-file"></i>
                            </div>
                            <a href="<?= base_url('kepegawaian/menu_cuti_pegawai'); ?>" class="small-box-footer">Pilih
                                <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-xl-3 col-lg-6 col-md-9 col-sm-12 m-2">
                        <!-- small box -->
                        <div class="small-box h-100 bg-gradient-orange">
                            <div class="inner mb-5">
                                <h2>Riwayat Pengajuan Cuti</h2>
                            </div>
                            <div class="icon">
                                <i class="fa fa-list"></i>
                            </div>
                            <a href="<?= base_url('kepegawaian/riwayat_cuti_pegawai'); ?>" class="small-box-footer">Pilih
                                <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-xl-3 col-lg-6 col-md-9 col-sm-12 m-2">
                        <!-- small box -->
                        <div class="small-box h-100 bg-gradient-yellow">
                            <div class="inner mb-5">
                                <h2>Form Dinas Luar</h2>
                            </div>
                            <div class="icon">
                                <i class="fa fa-file"></i>
                            </div>
                            <a href="<?= base_url('kepegawaian/form_dinas_luar'); ?>" class="small-box-footer">Pilih <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-9 col-sm-12 m-2">
                        <!-- small box -->
                        <div class="small-box h-100 bg-gradient-orange">
                            <div class="inner mb-5">
                                <h2>Riwayat Dinas Luar</h2>
                            </div>
                            <div class="icon">
                                <i class="fa fa-list"></i>
                            </div>
                            <a href="<?= base_url('kepegawaian/riwayat_dinas_luar'); ?>" class="small-box-footer">Pilih <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="card card-default color-palette-box">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fa fa-fingerprint mr-2"></i>Kehadiran
                </h3>
            </div>
            <!-- Small boxes (Stat box) -->

            <div class="card-body">
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-md-9 col-sm-12 m-2">
                        <!-- small box -->
                        <div class="small-box h-100 bg-gradient-cyan">
                            <div class="inner mb-5">
                                <h2>Cek Kehadiran</h2>
                            </div>
                            <div class="icon">
                                <i class="fa fa-check"></i>
                            </div>
                            <a href="<?= base_url('kehadiran/cek_kehadiran'); ?>" class="small-box-footer">Pilih <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-9 col-sm-12 m-2">
                        <!-- small box -->
                        <div class="small-box h-100 bg-gradient-fuchsia">
                            <div class="inner mb-5">
                                <h2>Analisis Kehadiran</h2>
                            </div>
                            <div class="icon">
                                <i class="fa fa-chart-bar"></i>
                            </div>
                            <a href="<?= base_url('kehadiran/analisis_kehadiran'); ?>" class="small-box-footer">Pilih <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>