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
          <!-- Tanggal -->
          <div class="form-group">
            <label>Tanggal Libur</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
              </div>
              <input type="date" class="form-control" id="tanggal" name="tanggal" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm" data-mask>
            </div>
          </div>
          <!-- Nama -->
          <div class="form-group">
            <label>Jenis Libur</label>
            <div class="input-group">
              <input type="text" class="form-control" id="nama-hari-libur" name="nama-hari-libur" placeholder="Nama Hari Libur">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" name="add-hari-libur" value="active">Tambah</button>
        </div>
      </form>
      <!-- /.col -->
    </div>
  </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="modal-ubah" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ubah</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="modal-body">
          <!-- Tanggal -->
          <div class="form-group">
            <label>Tanggal Libur</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
              </div>
              <input type="date" class="form-control" id="tanggal" name="tanggal" data-mask val="">
            </div>
          </div>
          <!-- Nama -->
          <div class="form-group">
            <label>Jenis Libur</label>
            <div class="input-group">
              <input type="text" class="form-control" id="nama-hari-libur" name="nama-hari-libur" placeholder="" val="">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" id="edit-hari-libur" name="edit-hari-libur" value="">Simpan</button>
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
          <button type="submit" class="btn btn-danger" value="" name="hapus-hari-libur" id="hapus-hari-libur">Hapus</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Content Header (Page header) -->
<div class="content-header d-flex">
  <h1 class="text-dark ml-2">Manajemen Hari Libur</h1>
  <button type="button" class="btn btn-primary ml-2" data-toggle="modal" data-target="#modal-tambah">
    Tambah Hari Libur
</div>


<section class="content">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Daftar Hari Libur</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="table-responsive">
            <table id="manajemen-libur-table" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th class="text-center align-middle">No</th>
                  <th class="text-center align-middle">Jenis Libur</th>
                  <th class="text-center align-middle">Tanggal</th>
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
                              <td class="text-center align-middle nama">' . $data['nama_hari_libur'] . '</td>
                              <td class="text-center align-middle">' . $data['tanggal'] . '</td>
                              <td class="text-center align-middle">
                                <button type="button" class="btn btn-outline-success ubah-btn m-2" data-id="' . $data['id'] . '">Ubah</button>
                                <button type="button" class="btn btn-outline-danger hapus-btn m-2" data-id="' . $data['id'] . '">Hapus</button>
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

</div>
</div>
</div>