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

<div id="view-modal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tampilan Dokumen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <object class="modal-body align-middle" data="" type="application/pdf" style="height: 45em; width: 50em; overflow: auto;">
          <p>Perangkat anda tidak mendukung PDF</p>
          <a class="btn btn-success download" href="" download="">Download</a>
        </object>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="back-btn">Kembali</button>
      </div>
    </div>
  </div>
</div>

<div id="view-modal-pict" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tampilan Dokumen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center align-middle">
        <img src="" alt="Dokumen" style="height: 45em; width: 50em; overflow: auto;">
      </div>
      <div class="modal-footer">
        <a class="btn btn-success download" href="" download="">Download</a>
        <button type="button" class="btn btn-secondary" id="back-btn">Kembali</button>
      </div>
    </div>
  </div>
</div>

<div id="loading-modal" class="modal" tabindex="-1" role="dialog">
  <dv class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
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
  <h1 class="text-dark ml-2">Riwayat Cuti</h1>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-detail" tabindex="-1" role="dialog" aria-labelledby="Cuti" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cuti">Form Cuti</h5>
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
        <div class="d-flex">
          <pre>Jenis Cuti     : </pre>
          <pre id="jenis-cuti"></pre>
        </div>
        <div class="d-flex">
          <pre>Tanggal Mulai  : </pre>
          <pre id="tanggal-cuti-mulai"></pre>
        </div>
        <div class="d-flex">
          <pre>Tanggal Akhir  : </pre>
          <pre id="tanggal-cuti-akhir"></pre>
        </div>
        <div class="d-flex">
          <pre>Alasan Cuti    : </pre>
          <pre id="alasan-cuti"></pre>
        </div>
        <div class="d-flex">
          <pre>File           : </pre>
            <button type="button" class="btn btn-primary" id="view-file">Tampilkan File</button>
        </div>
      </div>
      <div class="modal-footer">
        <div class="d-flex">
          <pre>Persetujuan    : </pre>
          <pre id="persetujuan"></pre>
        </div>
      </div>
    </div>
  </div>
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
          <button type="submit" class="btn btn-danger" value="" name="hapus-cuti" id="hapus-cuti">Hapus</button>
        </div>
      </form>
    </div>
  </div>
</div>

<section class="content">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Daftar Pengajuan Cuti Pegawai Non-PNS</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
        <div class="table-responsive">
          <table id="riwayat-cuti-pegawai-table" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th class="text-center align-middle">NIP</th>
                <th class="text-center align-middle">Nama</th>
                <th class="text-center align-middle">Unit Kerja</th>
                <th class="text-center align-middle">Jenis Cuti</th>
                <th class="text-center align-middle">Tanggal Cuti Mulai</th>
                <th class="text-center align-middle">Tanggal Cuti Akhir</th>
                <th class="text-center align-middle">Status</th>
                <th class="text-center align-middle"></th>
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
                              <td class="text-center align-middle">' . $data['nama_unit'] . '</td>
                              <td class="text-center align-middle">' . $data['jenis'] . '</td>
                              <td class="text-center align-middle">' . date("d/m/Y", strtotime($data['tanggal_cuti_mulai'])) . '</td>
                              <td class="text-center align-middle">' . date("d/m/Y", strtotime($data['tanggal_cuti_akhir'])) . '</td>';
                  if ($data['persetujuan'] == 0) {
                    echo '<td class="text-center align-middle"><h5><span class="badge badge-warning">Belum Disetujui</span></td>';
                  } else if ($data['persetujuan'] == 1) {
                    echo '<td class="text-center align-middle"><h5><span class="badge badge-success">Disetujui</span></td>';
                  } else {
                    echo '<td class="text-center align-middle"><h5><span class="badge badge-danger">Ditolak</span></td>';
                  }
                  echo '
                              <td class="text-center align-middle">
                              <button type="button" class="btn btn-outline-primary detail-btn m-2" data-id="' . $data['id_cuti_pegawai'] . '">Detail</button>
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