<div id="loading-modal" class="modal" tabindex="-1" role="dialog">
  <dv class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Mohon Tunggu</h5>
      </div>
      <div class="modal-body text-center  align-middle">
        <p></p>
        <img src="<?= base_url('assets/img/loading.svg'); ?>" alt="loading">
      </div>
    </div>
</div>

<div id="reload-modal" class="modal" tabindex="-1" role="dialog">
  <dv class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Reload</h5>
      </div>
      <div class="modal-body text-center  align-middle">
        <p><?= $this->session->flashdata('reload-message') ?></p>
      </div>
      <div class="modal-footer">
        <a href="<?= base_url('kehadiran/daftar_kehadiran'); ?>" class="btn btn-success">Reload</a>
      </div>
    </div>
</div>

<div id="message-modal" class="modal" tabindex="-1" role="dialog">
  <dv class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Pesan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p><?= $this->session->flashdata('message') ?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
</div>

<div id="error-message-modal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Pesan Error</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="text-danger"><?= $this->session->flashdata('error-message') ?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<?php if ($this->session->flashdata('message')) { ?>
  <script>
    $(window).on('load', function() {
      $('#message-modal').modal('show');
    });
  </script>
<?php unset($_SESSION['message']);
} ?>

<?php if ($this->session->flashdata('error-message')) { ?>
  <script>
    $(window).on('load', function() {
      $('#error-message-modal').modal('show');
    });
  </script>
<?php unset($_SESSION['error-message']);
} ?>

<?php if ($this->session->flashdata('reload-message')) { ?>
  <script>
    $(window).on('load', function() {
      $('#reload-modal').modal('show');
    });
  </script>
<?php unset($_SESSION['reload-message']);
} ?>

<!-- Modal Upload File Absen -->
<div class="modal fade" id="upload-file-modal" tabindex="-1" role="dialog" aria-labelledby="upload-file-modal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Upload File Absen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
            <label>File Absen</label>
            <div class="input-group">
              <div class="custom-file">
                <input name="kehadiran" type="file" class="custom-file-input" id="kehadiran" accept=".txt" required>
                <label class="custom-file-label" for="kehadiran" id="kehadiran-label">Pilih file kehadiran...</label>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary" name="submit-kehadiran" value="active">Upload</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Analisis -->
<div class="modal fade" id="modal-analisis" tabindex="-1" role="dialog" aria-labelledby="analisisKehadiran" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Analisis Kehadiran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="text-center  align-middle">
          <img src="<?= base_url('/assets/img/user.svg'); ?>" id="user-photo" class="img-circle elevation-2 p-auto" style="width: 8em;" alt="Foto Pegawai">
        </div>
        <p class="text-center  align-middle" id="nama"></p>
        <p class="text-center  align-middle" id="nip"></p>
        <hr>
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Analisis Kehadiran</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div id="data1"></div>
          </div>
        </div>
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Analisis Keterlambatan</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div id="data2"></div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<!-- Content Header (Page header) -->
<div class="content-header">
  <h1 class="text-dark m-2">Kehadiran Pegawai</h1>
  <button type="button" class="btn btn-primary m-2" data-toggle="modal" data-target="#upload-file-modal">
    Upload File Absen
  </button>
  <h1 class="text-dark m-2">Data Kehadiran Terekam: <?= $first_update . ' - ' . $last_update; ?></h1>
</div>
<div class="content-header">
  <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
    <div class="d-flex">
      <div class="form-group col-lg-3 col-md-5 col-sm-6 row">
        <label class="col-form-label col-lg-3 col-md-4 col-sm-12" for="tahun-kehadiran">Tahun</label>
        <select class="custom-select col-lg-9 col-md-8 col-sm-12" name="tahun-kehadiran" id="tahun-kehadiran">
          <?php
          foreach ($list_year as $year) {
            if ($year == $select_year) {
              echo '<option value="' . $year . '" selected>' . $year . '</option>';
            } else {
              echo '<option value="' . $year . '">' . $year . '</option>';
            }
          }
          ?>
        </select>
      </div>
      <div class="form-group col-lg-2 col-md-5 col-sm-3 row">
        <label class="col-form-label col-lg-4 col-md-4 col-sm-12" for="bulan-kehadiran">Bulan</label>
        <select class="custom-select col-lg-8 col-md-8 col-sm-12" name="bulan-kehadiran" id="bulan-kehadiran">
          <?php
          foreach ($list_month as $month) {
            if ($month == $select_month) {
              echo '<option value="' . $month . '" selected>' . $month . '</option>';
            } else {
              echo '<option value="' . $month . '">' . $month . '</option>';
            }
          }
          ?>
        </select>
      </div>
      <div class="form-group col-lg-1 col-md-1 col-sm-1">
        <button class="btn btn-primary" type="submit" name="select-kehadiran" value="active">Tampilkan</button>
      </div>
    </div>
  </form>
</div>

<section class="content">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Daftar Pegawai Non-PNS | Periode: <?= $select_month . '/' . $select_year; ?></h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="table-responsive">
            <table id="daftar-kehadiran-table" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th class="text-center align-middle">ID</th>
                  <th class="text-center align-middle">Nama</th>
                  <th class="text-center align-middle">Unit Kerja</th>
                  <th class="text-center align-middle">Terlambat</th>
                  <th class="text-center align-middle">Tidak Hadir</th>
                  <th class="text-center align-middle">Total Hadir</th>
                  <th class="text-center align-middle">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if ($data_table) {
                  foreach ($data_table as $data) {
                    echo '
                            <tr>
                              <td class="text-center align-middle">' . $data['nip'] . '</td>
                              <td class="text-center align-middle">' . $data['nama'] . '</td>
                              <td class="text-center align-middle">' . $data['nama_unit'] . '</td>
                              <td class="text-center align-middle"><h5><span class="badge badge-warning">' . $data['telat'] . '</span></td>
                              <td class="text-center align-middle"><h5><span class="badge badge-danger">' . $data['tidak_hadir'] . '</span></td>
                              <td class="text-center align-middle"><h5><span class="badge badge-success">' . $data['hadir'] . '</span></td>';
                    echo '
                              <td class="text-center align-middle">
                                <button type="button" class="btn btn-outline-primary analisis-kehadiran" data-id="' . $data['nip'] . '">Analisis</button>
                              </td>
                            </tr>
                          ';
                  }
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>