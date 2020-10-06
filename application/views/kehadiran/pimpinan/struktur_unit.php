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

<!-- Modal Analisis Tabel -->
<div class="modal fade" id="modal-analisis-tabel" tabindex="-1" role="dialog" aria-labelledby="analisisKehadiran" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tabel Analisis Kehadiran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h5 class="periode">Tahun: 2020 | Bulan: 02</h5>
        <div class="table-responsive">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary back">Kembali</button>
      </div>
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
        <div class="row">
          <div class="col-6">
            <label class="" for="tahun-kehadiran">Tahun</label>
            <select class="custom-select mr-sm-2" id="tahun-kehadiran">
            </select>
          </div>
          <div class="col-6">
            <label class="" for="bulan-kehadiran">Bulan</label>
            <select class="custom-select mr-sm-2" id="bulan-kehadiran">
            </select>
          </div>
        </div>
        <div class="col-6 mt-2">
          <p id="jumlah-pegawai"></p>
        </div>
        <div class="data1">
        </div>
        <div class="data2">
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
  <h1 class="text-dark ml-2">Kehadiran Struktur Unit</h1>
</div>

<div id="strukturorganisasi">

  <div class="d-flex">
    <div id="kepala" class="card bg-light mb-3">
      <div class="card-header text-center align-middle">
        <h4><span class="badge badge-primary">Kepala BPTIK DIKBUD</span></h4>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-4">
            <div class="image">
              <img src="
                  <?php
                  if (strlen($kepala['foto']) == 0) {
                    echo base_url('assets/img/user.svg');
                  } else {
                    echo 'data:image/jpeg;base64,' . $kepala['foto'];
                  }
                  ?>
                  " class="img-circle elevation-2" alt="Image" style="height : 4em;">
            </div>
          </div>
          <div class="col-8">
            <h5 class="card-titxle" style="font-size : 1.2em;"><?= $kepala['nama']; ?></h5>
            <p class="card-text" style="font-size : 0.85em;">NIP. <?= $kepala['nip']; ?></p>
          </div>
        </div>
      </div>
      <div class="m-1 ml-auto">
        <button type="button" class="btn btn-primary analisis-kehadiran" data-unit="all" <?php if ($this->session->userdata('user')['unit'] == 2 || $this->session->userdata('user')['unit'] == 3) echo 'disabled' ?>>
          Analisis
        </button>
      </div>
    </div>
  </div>

  <div class="vl"></div>
  <div class="hl"></div>


  <div id="tu" class="card bg-light mb-3">
    <div class="card-header text-center align-middle">
      <h5><span class="badge badge-primary">Kepala Sub. Bagian Tata Usaha</span></h5>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-4">
          <div class="image">
            <img src="
                  <?php
                  if (strlen($tu['foto']) == 0) {
                    echo base_url('assets/img/user.svg');
                  } else {
                    echo 'data:image/jpeg;base64,' . $tu['foto'];
                  }
                  ?>
                  " class="img-circle elevation-2" alt="Image" style="height : 4em;">
          </div>
        </div>
        <div class="col-8">
          <h5 class="card-titxle" style="font-size : 1.2em;"><?= $tu['nama']; ?></h5>
          <p class="card-text" style="font-size : 0.85em;">NIP. <?= $tu['nip']; ?></p>
        </div>
      </div>
    </div>
    <div class="m-1 ml-auto">
      <button type="button" class="btn btn-primary analisis-kehadiran" data-unit="1" <?php if ($this->session->userdata('user')['unit'] == 2 || $this->session->userdata('user')['unit'] == 3) echo 'disabled' ?>>
        Analisis
      </button>
    </div>
  </div>

  <div class="lb2 lb"></div>

  <div class="d-flex mt-4">
    <div id="pemberdayaan" class="card bg-light mb-3">
      <div class="card-header text-center align-middle">
        <h5><span class="badge badge-primary">Kepala Seksi Pemberdayaan TIK</span></h5>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-4">
            <div class="image">
              <img src="
                  <?php
                  if (strlen($pemberdayaan['foto']) == 0) {
                    echo base_url('assets/img/user.svg');
                  } else {
                    echo 'data:image/jpeg;base64,' . $pemberdayaan['foto'];
                  }
                  ?>
                  " class="img-circle elevation-2" alt="Image" style="height : 4em;">
            </div>
          </div>
          <div class="col-8">
            <h5 class="card-titxle" style="font-size : 1.2em;"><?= $pemberdayaan['nama']; ?></h5>
            <p class="card-text" style="font-size : 0.85em;">NIP. <?= $pemberdayaan['nip']; ?></p>
          </div>
        </div>
      </div>
      <div class="m-1 ml-auto">
        <button type="button" class="btn btn-primary analisis-kehadiran" data-unit="3" <?php if ($this->session->userdata('user')['unit'] == 2) echo 'disabled' ?>>
          Analisis
        </button>
      </div>
    </div>

    <div id="pengembangan" class="card bg-light mb-3">
      <div class="card-header text-center align-middle">
        <h5><span class="badge badge-primary">Kepala Seksi Pengembangan TIK</span></h5>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-4">
            <div class="image">
              <img src="
                  <?php
                  if (strlen($pengembangan['foto']) == 0) {
                    echo base_url('assets/img/user.svg');
                  } else {
                    echo 'data:image/jpeg;base64,' . $pengembangan['foto'];
                  }
                  ?>
                  " class="img-circle elevation-2" alt="Image" style="height : 4em;">
            </div>
          </div>
          <div class="col-8">
            <h5 class="card-titxle" style="font-size : 1.2em;"><?= $pengembangan['nama']; ?></h5>
            <p class="card-text" style="font-size : 0.85em;">NIP. <?= $pengembangan['nip']; ?></p>
          </div>
        </div>
      </div>
      <div class="m-1 ml-auto">
        <button type="button" class="btn btn-primary analisis-kehadiran" data-unit="2" <?php if ($this->session->userdata('user')['unit'] == 3) echo 'disabled' ?>>
          Analisis
        </button>
      </div>
    </div>
  </div>

</div>