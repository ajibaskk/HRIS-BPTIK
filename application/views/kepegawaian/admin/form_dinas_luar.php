<div id="view-modal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tampilan Dokumen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <iframe class="frame modal-body text-center align-middle" src="" type="application/pdf" style="height: 45em; width: 50em; overflow: auto;">
      </iframe>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="back-btn">Kembali</button>
      </div>
    </div>
  </div>
</div>

<div id="loading-modal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
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
      <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <!-- Form Tambah -->
          <!-- Nama -->
          <div class="form-group">
            <label>Nama</label>
            <div class="input-group">
              <select name="nama" id="nama-pegawai" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                <option value="">--Pilih Nama Pegawai--</option>
                <?php
                foreach ($pegawai as $p) {
                  echo '<option value="' . $p['nip'] . '">' . $p['nama'] . '</option>';
                }
                ?>
              </select>
            </div>
            <!-- /.input group -->
          </div>
          <!-- /.form group -->

          <!-- NIP -->
          <div class="form-group">
            <label>NIP</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-sort-numeric-down"></i></span>
              </div>
              <input type="number" class="form-control" id="nip" name="nip" value="" disabled>
            </div>
            <!-- /.input group -->
          </div>
          <!-- /.form group -->

          <!-- Unit Kerja -->
          <div class="form-group">
            <label>Unit Kerja</label>
            <div class="input-group">
              <select class="form-control select2" style="width: 100%;" name="unit-kerja" disabled>
                <option value="" id="unit-kerja"></option>
              </select>
            </div>
            <!-- /.input group -->
          </div>
          <!-- /.form group -->

          <!-- /.form group -->
          <div class="form-group">
            <label>Upload File Pendukung</label>
            <div class="input-group mb-3">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="file-cuti" name="file-cuti" accept="application/pdf">
                <label id="file-label" class="custom-file-label" for="file" aria-describedby="file">Pilih Dokumen (pdf)</label>
              </div>
            </div>
          </div>


          <div class="form-group">
            <label>Awal Dinas Luar</label>
            <div class="input-group">
              <input type="date" id="tanggal-awal" name="tanggal-awal" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy">
            </div>
            <!-- /.input group -->
          </div>
          <!-- /.form group -->

          <div class="form-group">
            <label>Akhir Dinas Luar</label>
            <div class="input-group">
              <input type="date" id="tanggal-akhir" name="tanggal-akhir" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy">
            </div>
            <!-- /.input group -->
          </div>
          <!-- /.row -->

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-success" name="tambah" name="tambah" value="active">Tambahkan</button>
        </div>
      </form>
      <!-- /.col -->
    </div>
  </div>
  <!-- End Form Edit -->
</div>

<!-- Modal Ubah -->
<div class="modal fade" id="modal-ubah" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ubah</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <!-- Form Edit -->
          <!-- Nama -->
          <div class="form-group">
            <label>Nama</label>
            <div class="input-group">
              <select name="nama" id="nama-pegawai" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                <?php
                foreach ($pegawai as $p) {
                  echo '<option value="' . $p['nip'] . '">' . $p['nama'] . '</option>';
                }
                ?>
              </select>
            </div>
            <!-- /.input group -->
          </div>
          <!-- /.form group -->

          <!-- NIP -->
          <div class="form-group">
            <label>NIP</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-sort-numeric-down"></i></span>
              </div>
              <input type="number" class="form-control" id="nip" name="nip" value="" disabled>
            </div>
            <!-- /.input group -->
          </div>
          <!-- /.form group -->

          <!-- Unit Kerja -->
          <div class="form-group">
            <label>Unit Kerja</label>
            <div class="input-group">
              <select class="form-control select2" style="width: 100%;" name="unit-kerja" disabled>
                <option value="" id="unit-kerja"></option>
              </select>
            </div>
            <!-- /.input group -->
          </div>
          <!-- /.form group -->

          <div class="form-group">
            <label>File Sebelumnya</label>
            <button type="button" class="btn btn-primary" id="view-file">Tampilkan File</button>
          </div>

          <!-- /.form group -->
          <div class="form-group">
            <label>Upload File Pendukung</label>
            <div class="input-group mb-3">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="file-cuti" name="file-cuti" accept="application/pdf">
                <label id="file-label" class="custom-file-label" for="file" aria-describedby="file">Pilih dokumen (pdf)</label>
              </div>
            </div>
          </div>


          <div class="form-group">
            <label>Awal Dinas Luar</label>
            <div class="input-group">
              <input type="date" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" id="tanggal-awal" name="tanggal-awal" value="">
            </div>
            <!-- /.input group -->
          </div>
          <!-- /.form group -->

          <div class="form-group">
            <label>Akhir Dinas Luar</label>
            <div class="input-group">
              <input type="date" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" id="tanggal-akhir" name="tanggal-akhir" value="">
            </div>
            <!-- /.input group -->
          </div>
          <!-- /.row -->

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <input type="hidden" value="" name="id" id="id">
          <button type="submit" class="btn btn-success" name="ubah" id="ubah" value="active">Ubah</button>
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
          <button type="submit" class="btn btn-danger" value="" name="hapus-dl" id="hapus-dl">Hapus</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Content Header (Page header) -->
<div class="content-header">
  <h1 class="text-dark mx-2">Form Dinas Luar</h1>
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah">
    Tambah Dinas Luar
</div>


<section class="content">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Daftar Dinas Luar</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
        <div class="table-responsive">
          <table id="dinas-luar-table" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th class="text-center align-middle">No</th>
                <th class="text-center align-middle">ID</th>
                <th class="text-center align-middle">Nama</th>
                <th class="text-center align-middle">Unit Kerja</th>
                <th class="text-center align-middle">Tanggal Awal Dinas Luar</th>
                <th class="text-center align-middle">Tanggal Akhir Dinas Luar</th>
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
                            <td class="text-center align-middle">' . $data['nama_unit'] . '</td>
                            <td class="text-center align-middle">' . date("d/m/Y", strtotime($data['tanggal_cuti_mulai'])) . '</td>
                            <td class="text-center align-middle">' . date("d/m/Y", strtotime($data['tanggal_cuti_akhir'])) . '</td>
                            <td class="text-center align-middle">
                              <button type="button" class="btn btn-outline-success ubah-btn m-2" data-id="' . $data['id_cuti_pegawai'] . '">Ubah</button>
                              <button type="button" class="btn btn-outline-danger hapus-btn m-2" data-id="' . $data['id_cuti_pegawai'] . '">Hapus</button>
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