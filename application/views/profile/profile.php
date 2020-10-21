<div id="message-modal" class="modal" tabindex="-1" role="dialog">
  <dv class="modal-dialog modal-dialog-centered" role="document">
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
  <h1 class="text-dark ml-2">Profil</h1>
</div>

<section class="content">
  <div class="container-fluid">
    <!-- Profil Pegawai -->
    <div class="card card-default">
      <div class="card-header">
        <h3 class="card-title">Profil Akun</h3>
      </div>
      <!-- /.card-header -->
      <div id="profile" class="card-body profile">
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
              <div class="container col-lg-6 col-md-9 col-sm-12 text-center align-middle">
                <div class="input-group mb-3">
                  <div class="custom-file text-left">
                    <input type="file" name="photo" class="custom-file-input" id="photo" accept="image/png, image/jpeg">
                    <label class="custom-file-label photo-label" for="photo" aria-describedby="photo">Pilih file gambar</label>
                  </div>
                  <div class="input-group-append">
                    <input type="submit" class="btn btn-primary input-group-text" id="submit-photo" name="submit-photo" value="Ubah Foto">
                  </div>
                </div>
                <?= '<p class="text-danger">' . $this->session->flashdata('message-photo') . '</p>'; ?>
              </div>
            </form>

            <br>
            <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
              <!-- Nama -->
              <div class="form-group">
                <label>Nama</label>
                <div class="input-group">
                  <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama" disabled value="<?= $data['nama']; ?>">
                </div>
                <?= form_error('nama', '<small class="text-danger pl-2">', '</small>'); ?>
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
                  <input type="number" id="nip" name="nip" class="form-control" placeholder="123" disabled value="<?= $data['nip']; ?>">
                </div>
                <?= form_error('nip', '<small class="text-danger pl-2">', '</small>'); ?>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

              <!-- Alamat -->
              <div class="form-group">
                <label>Alamat</label>
                <div class="input-group">
                  <input type="text" id="alamat" name="alamat" class="form-control" placeholder="Alamat" disabled value="<?= $data['alamat']; ?>">
                </div>
                <?= form_error('alamat', '<small class="text-danger pl-2">', '</small>'); ?>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

              <!-- Jenis Kelamin -->
              <div class="form-group">
                <label>Jenis Kelamin</label>
                <div class="input-group">
                  <select id="jenis_kelamin" name="jenis_kelamin" class="form-control select2 jenis_kelamin" style="width: 100%;" disabled>
                    <option <?php if ($data['jenis_kelamin'] == 0) echo 'selected'; ?> value="0">Laki-Laki</option>
                    <option <?php if ($data['jenis_kelamin'] == 1) echo 'selected'; ?> value="1">Perempuan</option>
                  </select>
                </div>
                <?= form_error('jenis_kelamin', '<small class="text-danger pl-2">', '</small>'); ?>
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
                <?= form_error('unit_kerja', '<small class="text-danger pl-2">', '</small>'); ?>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

              <!-- Jenis Kelamin -->
              <div class="form-group">
                <label>Jenjang</label>
                <div class="input-group">
                  <select id="jenjang" name="jenjang" class="form-control select2" style="width: 100%;" disabled>
                    <option <?php if ($data['jenjang'] == 0) echo 'selected'; ?> value="0">SMA/SMK</option>
                    <option <?php if ($data['jenjang'] == 1) echo 'selected'; ?> value="1">D3</option>
                    <option <?php if ($data['jenjang'] == 2) echo 'selected'; ?> value="2">S1</option>
                    <option <?php if ($data['jenjang'] == 3) echo 'selected'; ?> value="3">S2</option>
                    <option <?php if ($data['jenjang'] == 4) echo 'selected'; ?> value="4">S3</option>
                  </select>
                </div>
                <?= form_error('jenjang', '<small class="text-danger pl-2">', '</small>'); ?>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

          </div>
        </div>
        <!-- /.row -->

        <div class="row">
          <div class="col-12 col-sm-6 px-5">
            <div class="form-group">
              <label>Tempat Lahir</label>
              <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control" placeholder="Kota" value="<?= $data['tempat_lahir']; ?>" disabled>
            </div>
            <?= form_error('tempat_lahir', '<small class="text-danger pl-2">', '</small>'); ?>
            <!-- /.form-group -->
          </div>
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
              <?= form_error('tanggal_lahir', '<small class="text-danger pl-2">', '</small>'); ?>
            </div>
            <!-- /.form-group -->
          </div>
          <!-- /.col -->
          <br>
        </div>
        <div class="text-right px-5">
          <input type="submit" class="btn btn-primary" id="submit-profile" name="submit-profile" data-btn="edit" value="Ubah Profil"></input>
        </div>
        </form>
      </div>
    </div>
    <!-- /.card -->
  </div>
</section>

<section class="content">
  <div class="container-fluid">
    <!-- Profil Pegawai -->
    <div class="card card-default">
      <div class="card-header">
        <h3 class="card-title">Keamanan</h3>
      </div>
      <!-- /.card-header -->
      <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="card-body">
          <div class="row">
            <div id="password" class="col-md-12 px-5">

              <!-- Password Lama -->
              <div class="form-group">
                <label>Password Lama</label>
                <div class="input-group">
                  <input type="password" disabled="disabled" class="form-control" name="old-password" id="old-password">
                </div>
                <?= form_error('old-password', '<small class="text-danger pl-2">', '</small>'); ?>
                <?= '<small class="text-danger pl-2">' . $this->session->flashdata('message-password') . '</small>'; ?>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

              <!-- Password Baru -->
              <div class="form-group">
                <label>Password Baru</label>
                <div class="input-group">
                  <input type="password" disabled="disabled" class="form-control" name="new-password" id="new-password">
                </div>
                <?= form_error('new-password', '<small class="text-danger pl-2">', '</small>'); ?>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

              <!-- Ulang Password Baru -->
              <div class="form-group">
                <label>Ulang Password Baru</label>
                <div class="input-group">
                  <input type="password" disabled="disabled" class="form-control" name="repeat-new-password" id="repeat-new-password">
                </div>
                <?= form_error('repeat-new-password', '<small class="text-danger pl-2">', '</small>'); ?>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
              <br>
              <div class="text-right">
                <input type="submit" class="btn btn-primary" id="submit-password" name="submit-password" data-btn="edit" value="Ubah Password">
              </div>

            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>