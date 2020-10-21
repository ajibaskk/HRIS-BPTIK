<!-- Content Header (Page header) -->
<div class="content-header">
  <h1 class="text-dark ml-2">Struktur Organisasi</h1>
</div>

<div id="strukturorganisasi" class="strukturorganisasi">

  <div class="d-flex">
    <div id="kepala" class="card bg-light mb-3 kepala">
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
    </div>
  </div>

  <div class="vl"></div>
  <div class="hl"></div>


  <div id="tu" class="card bg-light mb-3 tu">
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
  </div>

  <div class="lb"></div>

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
    </div>

    <div id="pengembangan" class="card bg-light mb-3 pengembangan">
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
    </div>
  </div>

</div>