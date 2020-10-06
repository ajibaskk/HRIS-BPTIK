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
          <img src="<?= base_url('assets/img/user.svg'); ?>" id="user-photo" class="img-circle elevation-2 p-auto" style="width: 8em;" alt="Foto Pegawai">
        </div>
        <p class="text-center align-middle" id="nama"></p>
        <p class="text-center align-middle" id="nip"></p>
        <hr>
        <div class="d-flex">
          <pre>Unit Kerja     : </pre>
          <pre id="unit-kerja"></pre>
        </div>
        <div class="d-flex">
          <pre>Jenjang        : </pre>
          <pre id="jenjang"></pre>
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
                <th class="text-center align-middle">Jenjang Pendidikan</th>
                <th class="text-center align-middle">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if($data_table){
                foreach ($data_table as $data) {
                  echo '
                            <tr>
                              <td class="text-center align-middle">' . $data['nip'] . '</td>
                              <td class="text-center align-middle">' . $data['nama'] . '</td>
                              <td class="text-center align-middle">' . $data['alamat'] . '</td>
                              <td class="text-center align-middle">' . $data['jenis_kelamin'] . '</td>
                              <td class="text-center align-middle">' . $data['nama_unit'] . '</td>
                              <td class="text-center align-middle">' . $data['jenjang'] . '</td>
                              <td class="text-center align-middle">
                                <button type="button" class="btn btn-outline-primary detail-btn m-2" data-id="' . $data['nip'] . '">Detail</button>
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