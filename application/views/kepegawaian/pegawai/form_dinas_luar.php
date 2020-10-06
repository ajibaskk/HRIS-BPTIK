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
        <a href="<?= base_url('kepegawaian/riwayat_dinas_luar') ?>" class="btn btn-success">Riwayat Dinas Luar</a>
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

<!-- Content Header (Page header) -->
<div class="content-header">
  <h1 class="text-dark ml-2">Dinas Luar</h1>
</div>

<section class="content">
  <div class="container-fluid">
    <!-- Profil Pegawai -->
    <div class="card card-default">
      <div class="card-header">
        <h3 class="card-title">Form Dinas Luar</h3>
      </div>
      <!-- /.card-header -->
      <div id="cuti-bersalin" class="card-body">
        <div class="row">
          <div class="col-md-12 px-5">
            <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
              <!-- photo -->
              <div class="container mb-4">
                <div class="text-center align-middle">
                  <div class="text-center align-middle">
                    <img src="
                    <?php
                    if (strlen($data['foto']) == 0) {
                      echo base_url('assets/img/user.svg');
                    } else {
                      echo 'data:image/jpeg;base64,' . $data['foto'];
                    }
                    ?>
                      " alt="Avatar" class="img-circle elevation-2" style="width: 14rem; height: 12rem;">
                  </div>
                </div>
              </div>
            </form>

            <br>

            <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
              <!-- Nama -->
              <div class="form-group">
                <label>Nama</label>
                <div class="input-group">
                  <input type="text" id="nama" name="nama" disabled class="form-control" placeholder="Nama" value="<?= $data['nama']; ?>">
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
                  <input type="number" id="nip" name="nip" class="form-control" placeholder="123" disabled value="<?= $data['nip']; ?>">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

              <!-- Unit Kerja -->
              <div class="form-group">
                <label>Unit Kerja</label>
                <div class="input-group">
                  <select id="unit_kerja" name="unit_kerja" class="form-control select2" style="width: 100%;" disabled>
                    <option <?php if ($data['nama_unit'] == "Tata Usaha") echo 'selected'; ?> value="1">Tata Usaha</option>
                    <option <?php if ($data['nama_unit'] == "Pengembangan TIK") echo 'selected'; ?> value="2">Pengembangan TIK</option>
                    <option <?php if ($data['nama_unit'] == "Pemberdayaan TIK") echo 'selected'; ?> value="3">Pemberdayaan TIK</option>
                  </select>
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
              <!-- /.row -->


              <!-- Lama DL -->
              <div class="form-group">
                <label>Awal Dinas Luar</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                  </div>
                  <input type="date" id="awal-cuti" name="awal-cuti" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" value="<?= set_value('awal-cuti'); ?>">
                </div>
                <!-- /.input group -->
                <?= form_error('awal-cuti', '<small class="text-danger pl-2">', '</small>'); ?>
              </div>
              <!-- /.form group -->

              <div class="form-group">
                <label>Akhir Dinas Luar</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                  </div>
                  <input type="date" id="akhir-cuti" name="akhir-cuti" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" value="<?= set_value('akhir-cuti'); ?>">
                </div>
                <!-- /.input group -->
                <?= form_error('akhir-cuti', '<small class="text-danger pl-2">', '</small>'); ?>
              </div>
              <!-- /.form group -->
              <div class="form-group">
                <label>Upload File Dinas Luar</label>
                <div class="input-group mb-3">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="file-cuti" name="file-cuti" accept="application/pdf, image/png, image/jpeg" value="<?= set_value('file-cuti'); ?>">
                    <label id="file-label" class="custom-file-label" for="file" aria-describedbyx="file">Pilih dokumen/gambar (pdf, png, jpeg)</label>
                  </div>
                </div>
              </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12 col-sm-6  px-5">
            <div class="form-group">
              <label>Tempat Lahir</label>
              <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control" placeholder="Kota" value="<?= $data['tempat_lahir']; ?>" disabled>
            </div>
          </div>
          <!-- /.form-group -->
          <!-- /.col -->
          <div class="col-12 col-sm-6 px-5">
            <div class="form-group">
              <label>Tanggal Lahir</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                </div>
                <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control" value="<?= $data['tanggal_lahir']; ?>" disabled>
              </div>
            </div>
            <!-- /.form-group -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <br>
        <div class="text-right px-5">
          <input type="submit" class="btn btn-primary" id="submit-cuti" name="submit-cuti" data-btn="edit" value="Ajukan Dinas Luar">
        </div>
        </form>
      </div>
    </div>
    <!-- /.card -->
</section>