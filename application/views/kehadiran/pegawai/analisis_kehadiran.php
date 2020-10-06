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

<!-- Content Header (Page header) -->
<div class="content-header">
  <h1 class="text-dark ml-2">Analisis Kehadiran</h1>
  <h1 class="text-dark m-2">Data Kehadiran Terekam: <?= $first_update . ' - ' . $last_update; ?></h1>
</div>

<!-- Main content -->
<section class="content">
  <input id="nip" type="hidden" value="<?= $this->session->userdata('user')['nip']; ?>">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-12">
        <!-- DONUT CHART -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Analisis Kehadiran</h3>

          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-6">
                <label class="" for="tahun-kehadiran">Tahun</label>
                <select class="custom-select mr-sm-2" id="tahun-kehadiran">
                  <?php
                  foreach ($list_year as $year) {
                    if ($year == $list_year[count($list_year) - 1]) {
                      echo '<option value="' . $year . '" selected>' . $year . '</option>';
                    } else {
                      echo '<option value="' . $year . '">' . $year . '</option>';
                    }
                  }
                  ?>
                </select>
              </div>
              <div class="col-6">
                <label class="" for="bulan-kehadiran">Bulan</label>
                <select class="custom-select mr-sm-2" id="bulan-kehadiran">
                  <?php
                  foreach ($list_month as $month) {
                    if ($month == $list_month[count($list_month) - 1]) {
                      echo '<option value="' . $month . '" selected>' . $month . '</option>';
                    } else {
                      echo '<option value="' . $month . '">' . $month . '</option>';
                    }
                  }
                  ?>
                </select>
              </div>
            </div>
            <div id="data1">
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <div class="col-lg-6 col-md-6 col-sm-12">
        <!-- DONUT CHART -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Analisis Keterlambatan</h3>

          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-6">
                <label class="" for="tahun-kehadiran">Tahun</label>
                <select class="custom-select mr-sm-2" id="tahun-keterlambatan">
                  <?php
                  foreach ($list_year as $year) {
                    if ($year == $list_year[count($list_year) - 1]) {
                      echo '<option value="' . $year . '" selected>' . $year . '</option>';
                    } else {
                      echo '<option value="' . $year . '">' . $year . '</option>';
                    }
                  }
                  ?>
                </select>
              </div>
              <div class="col-6">
                <label class="" for="bulan-kehadiran">Bulan</label>
                <select class="custom-select mr-sm-2" id="bulan-keterlambatan">
                  <?php
                  foreach ($list_month as $month) {
                    if ($month == $list_month[count($list_month) - 1]) {
                      echo '<option value="' . $month . '" selected>' . $month . '</option>';
                    } else {
                      echo '<option value="' . $month . '">' . $month . '</option>';
                    }
                  }
                  ?>
                </select>
              </div>
            </div>
            <div id="data2">
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

      </div>
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>
<!-- /.content -->