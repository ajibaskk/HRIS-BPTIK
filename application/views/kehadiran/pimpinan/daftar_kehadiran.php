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
        <div class="text-center align-middle">
          <img src="<?= base_url('/assets/img/user.svg'); ?>" id="user-photo" class="img-circle elevation-2 p-auto" style="width: 8em;" alt="Foto Pegawai">
        </div>
        <p class="text-center align-middle" id="nama"></p>
        <p class="text-center align-middle" id="nip"></p>
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
          <h3 class="card-title">Daftar Pegawai Non-PNS</h3>
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