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

<div id="message-modal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
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
</div>

<div id="error-message-modal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
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

<!-- Modal Tambah -->
<div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="Tambah" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="modal-body">
          <!-- Form Edit -->
          <!-- Nama -->
          <div class="form-group">
            <label>Nama</label>
            <div class="input-group">
              <input type="text" class="form-control" name="nama" value="">
            </div>
            <!-- /.input group -->
          </div>
          <!-- /.form group -->

          <!-- NIP -->
          <div class="form-group">
            <label>NIP/ID</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-sort-numeric-down"></i></span>
              </div>
              <input type="number" class="form-control" name="nip" value="">
            </div>
            <!-- /.input group -->
          </div>
          <!-- /.form group -->

          <!-- Unit Kerja -->
          <div class="form-group">
            <label>Unit Kerja</label>
            <div class="input-group">
              <select class="form-control select2" style="width: 100%;" name="unit-kerja">
                <?php
                foreach ($unit_kerja as $unit) {
                  echo '<option value="' . $unit['id_unit_kerja'] . '">' . $unit['nama_unit'] . '</option>';
                }
                ?>
              </select>
            </div>
            <!-- /.input group -->
          </div>
          <!-- /.form group -->
          <!-- /.row -->

          <!-- Jenjang -->
          <div class="form-group">
            <label>Jenjang</label>
            <div class="input-group">
              <select class="form-control select2" style="width: 100%;" name="jenjang">
                <option value="0">SMA/SMK</option>
                <option value="1">D3</option>
                <option value="2">S1</option>
                <option value="3">S2</option>
                <option value="4">S3</option>
              </select>
            </div>
            <!-- /.input group -->
          </div>

          <div class="form-group">
            <label>Tempat Lahir</label>
            <input type="text" class="form-control" name="tempat-lahir" value="">
          </div>
          <!-- /.form-group -->
          <!-- /.col -->
          <div class="form-group">
            <label>Tanggal Lahir</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
              </div>
              <input type="date" class="form-control" name="tanggal-lahir" data-date-format="DD MMMM YYYY" value="">
            </div>
          </div>

          <!-- Jenis Kelamin -->
          <div class="form-group">
            <label>Jenis Kelamin</label>
            <div class="input-group">
              <select class="form-control select2" style="width: 100%;" name="jenis-kelamin">
                <option value="0">Laki-Laki</option>
                <option value="1">Perempuan</option>
              </select>
            </div>
            <!-- /.input group -->
          </div>

          <!-- Nama -->
          <div class="form-group">
            <label>Alamat</label>
            <div class="input-group">
              <input type="text" class="form-control" name="alamat" value="">
            </div>
            <!-- /.input group -->
          </div>
          <!-- /.form group -->

          <!-- role -->
          <div class="form-group">
            <label>Level</label>
            <select class="form-control select2" style="width: 100%;" name="level">
              <option value="2">Pegawai</option>
              <option value="1">Pimpinan</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <input type="submit" class="btn btn-success" name="add-akun" value="Tambah Akun">
        </div>
      </form>
      <!-- /.col -->
    </div>
  </div>
  <!-- End Form Edit -->
</div>

<!-- Modal Detail -->
<div class="modal fade" id="modal-detail" tabindex="-1" role="dialog" aria-labelledby="Detail" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="text-center align-middle">
          <img id="user-photo" src="<?= base_url('assets/img/user.svg'); ?>" class="img-circle elevation-2 p-auto" style="width: 8em;" alt="User Image">
        </div>
        <p class="text-center align-middle" id="nama"></p>
        <p class="text-center align-middle" id="nip"></p>
        <hr>
        <div class="d-flex">
          <pre>Unit Kerja     : </pre>
          <pre id="unit-kerja"></pre>
        </div>
        <div class="d-flex">
          <pre>jenjang        : </pre>
          <pre id="jenjang"></pre>
        </div>
        <div class="d-flex">
          <pre>Tempat Lahir   : </pre>
          <pre id="tempat-lahir"></pre>
        </div>
        <div class="d-flex">
          <pre>Tanggal Lahir  : </pre>
          <pre id="tanggal-lahir"></pre>
        </div>
        <div class="d-flex">
          <pre>Jenis Kelamin  : </pre>
          <pre id="jenis-kelamin"></pre>
        </div>
        <div class="d-flex">
          <pre>Alamat         : </pre>
          <pre id="alamat"></pre>
        </div>
        <div class="d-flex">
          <pre>Level          : </pre>
          <pre id="level"></pre>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Ubah -->
<div class="modal fade" id="modal-ubah" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ubah</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="modal-body">
          <!-- Form Edit -->
          <!-- Nama -->
          <div class="form-group">
            <label>Nama</label>
            <div class="input-group">
              <input type="text" class="form-control" name="nama" id="nama" value="">
            </div>
            <!-- /.input group -->
          </div>
          <!-- /.form group -->

          <!-- NIP -->
          <div class="form-group">
            <label>NIP/ID</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-sort-numeric-down"></i></span>
              </div>
              <input type="number" class="form-control" name="nip" id="nip" value="">
            </div>
            <!-- /.input group -->
          </div>
          <!-- /.form group -->

          <!-- Unit Kerja -->
          <div class="form-group">
            <label>Unit Kerja</label>
            <div class="input-group">
              <select class="form-control select2" style="width: 100%;" name="unit-kerja" id="unit-kerja">
                <?php
                foreach ($unit_kerja as $unit) {
                  echo '<option id="unit-kerja-' . $unit['id_unit_kerja'] . '" value="' . $unit['id_unit_kerja'] . '">' . $unit['nama_unit'] . '</option>';
                }
                ?>
              </select>
            </div>
            <!-- /.input group -->
          </div>
          <!-- /.form group -->
          <!-- /.row -->

          <!-- Jenis Kelamin -->
          <div class="form-group">
            <label>Jejang</label>
            <div class="input-group">
              <select class="form-control select2" style="width: 100%;" name="jenjang" id="jenjang">
                <option id="jenjang-0" value="0">SMA/SMK</option>
                <option id="jenjang-1" value="1">D3</option>
                <option id="jenjang-2" value="2">S1</option>
                <option id="jenjang-3" value="3">S2</option>
                <option id="jenjang-4" value="4">S3</option>
              </select>
            </div>
            <!-- /.input group -->
          </div>

          <div class="form-group">
            <label>Tempat Lahir</label>
            <input type="text" class="form-control" name="tempat-lahir" id="tempat-lahir" value="">
          </div>
          <!-- /.form-group -->
          <!-- /.col -->
          <div class="form-group">
            <label>Tanggal Lahir</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
              </div>
              <input type="date" class="form-control" name="tanggal-lahir" id="tanggal-lahir" value="" data-date-format="DD MMMM YYYY">
            </div>
          </div>

          <!-- Jenis Kelamin -->
          <div class="form-group">
            <label>Jenis Kelamin</label>
            <div class="input-group">
              <select class="form-control select2" style="width: 100%;" name="jenis-kelamin" id="jenis-kelamin">
                <option id="jenis-kelamin-0" value="0">Laki-Laki</option>
                <option id="jenis-kelamin-1" value="1">Perempuan</option>
              </select>
            </div>
            <!-- /.input group -->
          </div>

          <!-- Nama -->
          <div class="form-group">
            <label>Alamat</label>
            <div class="input-group">
              <input type="text" class="form-control" name="alamat" id="alamat">
            </div>
            <!-- /.input group -->
          </div>
          <!-- /.form group -->

          <!-- role -->
          <div class="form-group">
            <label>Level</label>
            <select class="form-control select2" style="width: 100%;" name="level" id="level">
              <option id="level-2" value="2">Pegawai</option>
              <option id="level-1" value="1">Pimpinan</option>
              <option id="level-0" value="0">Admin</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning mr-auto" id="reset-password-btn" data-id="" data-name="">Reset Password</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-success" name="edit-akun" id="edit-akun" value="">Simpan</button>
        </div>
      </form>
      <!-- /.col -->
    </div>
  </div>
  <!-- End Form Edit -->
</div>

<!-- Modal Hapus -->
<div class="modal fade" id="modal-hapus" tabindex="-1" role="dialog" aria-labelledby="Hapus" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hapus</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="text-center align-middle"></p>
      </div>
      <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-danger" value="" name="hapus-akun" id="hapus-akun">Hapus</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Reset Password -->
<div class="modal fade" id="modal-reset-password" tabindex="-1" role="dialog" aria-labelledby="Reset Password" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Reset Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="text-center align-middle"></p>
      </div>
      <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-warning" value="" name="reset-password-akun" id="reset-password-akun">Reset Password</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Content Header (Page header) -->
<div class="content-header d-flex">
  <h1 class="text-dark ml-2 mr-2">Manajemen Akun</h1>
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah">
    Tambah Akun
</div>


<section class="content">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Daftar Akun</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="table-responsive">
            <table id="manajemen-akun-table" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th class="text-center align-middle">No</th>
                  <th class="text-center align-middle">NIP/ID</th>
                  <th class="text-center align-middle">Nama</th>
                  <th class="text-center align-middle">Jenis Kelamin</th>
                  <th class="text-center align-middle">Level</th>
                  <th class="text-center align-middle">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if ($data_table) {
                  foreach ($data_table as $data) {
                    echo '
                            <tr>
                              <td class="text-center align-middle">' . $data['no'] . '</td>
                              <td class="text-center align-middle">' . $data['nip'] . '</td>
                              <td class="text-center align-middle nama">' . $data['nama'] . '</td>
                              <td class="text-center align-middle">' . $data['jenis_kelamin'] . '</td>
                              <td class="text-center align-middle">' . $data['level'] . '</td>
                              <td class="text-center align-middle">
                                <button type="button" class="btn btn-outline-primary detail-btn m-2" data-id="' . $data['nip'] . '">Detail</button>
                                <button type="button" class="btn btn-outline-success ubah-btn m-2" data-id="' . $data['nip'] . '">Ubah</button>
                                <button type="button" class="btn btn-outline-danger hapus-btn m-2" data-id="' . $data['nip'] . '">Hapus</button>
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