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
          <img src="<?= base_url('assets/img/user.svg'); ?>" class="img-circle elevation-2 p-auto" style="width: 8em;" alt="User Image">
        </div>
        <p class="text-center align-middle" id="nama"></p>
        <p class="text-center align-middle" id="nip"></p>
        <hr>
        <div class="d-flex">
          <pre>Unit Kerja     : </pre>
          <pre id="unit-kerja"></pre>
        </div>
        <div class="d-flex">
          <pre>Alamat         : </pre>
          <pre id="alamat"></pre>
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
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
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
      <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="modal-body">
          <!-- Form Edit -->
          <!-- Nama -->
          <div class="form-group">
            <label>Nama</label>
            <div class="input-group">
              <input type="text" class="form-control" id="nama" name="nama" value="">
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
              <input type="number" class="form-control" id="nip" name="nip" value="">
            </div>
            <!-- /.input group -->
          </div>
          <!-- /.form group -->

          <!-- Unit Kerja -->
          <div class="form-group">
            <label>Unit Kerja</label>
            <div class="input-group">
              <input type="text" class="form-control" id="unit-kerja" name="unit-kerja" value="">
            </div>
            <!-- /.input group -->
          </div>
          <!-- /.form group -->
          <!-- /.row -->

          <div class="form-group">
            <label>Tempat Lahir</label>
            <input type="text" class="form-control" id="tempat-lahir" name="tempat-lahir" value="">
          </div>
          <!-- /.form-group -->
          <!-- /.col -->
          <div class="form-group">
            <label>Tanggal Lahir</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
              </div>
              <input type="date" class="form-control" id="tanggal-lahir" name="tanggal-lahir" value="">
            </div>
          </div>
          <!-- /.form-group -->
          <!-- role -->
          <div class="form-group">
            <label>Level</label>
            <select class="form-control select2" style="width: 100%;" id="level" name="level">
              <option id="level-pegawai" value="2">Pegawai</option>
              <option id="level-pimpinan" value="1">Pimpinan</option>
              <option id="level-admin" value="0">Admin</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <input type="submit" class="btn btn-success" data-dismiss="modal" name="edit-akun" value="Simpan">
        </div>
      </form>
      <!-- /.col -->
    </div>
  </div>
  <!-- End Form Edit -->
</div>

<!-- Content Header (Page header) -->
<div class="content-header">
  <h1 class="text-dark mx-2">Daftar Pegawai</h1>
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
              <table id="manajemen-pegawai-table" class="table table-bordered table-hover">
                <thead>
                  <tr>
                  <th class="text-center align-middle">ID</th>
                  <th class="text-center align-middle">Nama</th>
                  <th class="text-center align-middle">Alamat</th>
                  <th class="text-center align-middle">Jenis Kelamin</th>
                  <th class="text-center align-middle">Unit Kerja</th>
                  <th class="text-center align-middle">Aksi</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                    if($data_table){
                      foreach($data_table as $data){
                        echo '
                        <tr>
                        <td class="text-center align-middle">'.$data['nip'].'</td>
                        <td class="text-center align-middle">'.$data['nama'].'</td>
                            <td class="text-center align-middle">'.$data['alamat'].'</td>
                            <td class="text-center align-middle">'.$data['jenis_kelamin'].'</td>
                            <td class="text-center align-middle">'.$data['nama_unit'].'</td>
                            <td class="text-center align-middle">
                            <button type="button" class="btn btn-outline-primary detail-btn m-2" data-id="'.$data['nip'].'">Detail</button>
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
