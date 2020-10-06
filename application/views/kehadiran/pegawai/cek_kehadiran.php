<div id="loading-modal" class="modal" tabindex="-1" role="dialog">
    <dv class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Mohon Tunggu</h5>
            </div>
            <div class="modal-body text-center align-middle">
                <p></p>
                <img src="<?= base_url('assets/img/loading.svg'); ?>" alt="loading">
            </div>
        </div>
</div>


<!-- Content Header (Page header) -->
<div class="content-header">
    <h1 class="text-dark ml-2">Cek Kehadiran Pegawai</h1>
    <h1 class="text-dark m-2">Data Kehadiran Terekam: <?= $first_update . ' - ' . $last_update; ?></h1>
</div>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="mb-3">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Status</h4>
                        </div>
                        <div class="card-body">
                            <!-- the events -->
                            <div id="external-events">
                                <div class="external-event bg-success">Tepat Waktu</div>
                                <div class="external-event bg-warning">Terlambat</div>
                                <div class="external-event bg-danger">Tidak Masuk</div>
                                <div class="external-event bg-primary">Cuti</div>
                                <div class="external-event bg-info">Dinas Luar</div>
                                <div class="external-event bg-secondary">Libur</div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card card-primary">
                    <div class="card-body p-0">
                        <!-- THE CALENDAR -->
                        <div id="calendar" data-id="<?= $nip; ?>"></div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>