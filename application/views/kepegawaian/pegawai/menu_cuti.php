<!-- Content Header (Page header) -->
<div class="content-header">
    <h1 class="text-dark ml-2">Menu Cuti</h1>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card card-default color-palette-box">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="ion ion-ios-people mr-2"></i>Pilihan Cuti
                </h3>
            </div>
            <!-- Small boxes (Stat box) -->

            <div class="card-body">
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-md-9 col-sm-12 m-2">
                        <!-- small box -->
                        <div class="small-box h-100 bg-info">
                            <div class="inner mb-5">
                                <h2>Cuti Sakit</h2>
                            </div>
                            <div class="icon">
                                <i class="fab fa-accessible-icon"></i>
                            </div>
                            <a href="<?= base_url('kepegawaian/cuti_pegawai/sakit'); ?>" class="small-box-footer">Pilih <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-xl-3 col-lg-6 col-md-9 col-sm-12 m-2">
                        <!-- small box -->
                        <div class="small-box h-100 bg-gradient-blue">
                            <div class="inner mb-5">
                                <h2>Cuti Bersalin</h2>
                            </div>
                            <div class="icon">
                                <i class="fa fa-baby"></i>
                            </div>
                            <a href="<?= base_url('kepegawaian/cuti_pegawai/bersalin'); ?>" class="small-box-footer">Pilih <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-9 col-sm-12 m-2">
                        <!-- small box -->
                        <div class="small-box h-100 bg-gradient-orange">
                            <div class="inner mb-5">
                                <h2>Cuti Alasan Penting</h2>
                            </div>
                            <div class="icon">
                                <i class="fa fa-exclamation-triangle"></i>
                            </div>
                            <a href="<?= base_url('kepegawaian/cuti_pegawai/kepentingan'); ?>" class="small-box-footer">Pilih <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- /.row -->
            </div>
        </div>
    </div>