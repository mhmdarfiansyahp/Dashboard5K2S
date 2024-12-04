<div class="main-panel">
  <div class="content-wrapper pb-0">
    <div class="page-header flex-wrap">
      <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
        <div class="d-flex align-items-center">
          <a href="#">
            <p class="m-0 pr-3">Dashboard</p>
          </a>
          <a class="pl-3 mr-4" href="#">
            <p class="m-0">ADE-00234</p>
          </a>
        </div>
      </div>
    </div>

    <!-- Loop untuk setiap kelas -->
    <div class="row">
      <?php foreach ($kelas_with_aspek as $item): ?>
      <div class="col-xl-12 stretch-card grid-margin">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">History Penilaian Kelas <?php echo $item['kelas']->nama_kelas; ?></h4>
          </div>
          <div class="card-body">
            <!-- Tabel Penilaian -->
            <table class="table table-striped table-bordered">
               <thead>
                <tr>
                  <th rowspan="2" class="text-center thStyle">No</th>
                  <th rowspan="2" class="text-center thStyle">Tanggal</th>
                  <th rowspan="2" class="text-center thStyle">Kelas</th>
                  <th colspan="4" class="text-center thStyle">Poin</th>
                  <th rowspan="2" class="text-center thStyle">Total</th>
                  <th rowspan="2" class="text-center thStyle">Aksi</th>
                </tr>
                <tr>
                  <th class="text-center thStyle">Kerapihan</th>
                  <th class="text-center thStyle">Keamanan</th>
                  <th class="text-center thStyle">Ketertiban dan Kedisiplinan</th>
                  <th class="text-center thStyle">Kebersihan</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($kelas_with_aspek as $cpm):
                  // Tanggal input data
                  $tanggal_input = strtotime($cpm->create_at);

                  // Tentukan minggu ke berapa tanggal input
                  $minggu_ke = date('W', $tanggal_input) - date('W', strtotime('first day of ' . date('F Y', $tanggal_input))) + 1;

                  // Batas waktu edit
                  if ($minggu_ke == 1) {
                    // Jika data diinput minggu pertama bulan ini
                    $batas_waktu_edit = strtotime('first sunday of ' . date('F Y', $tanggal_input));
                  } else {
                    // Jika data diinput minggu kedua atau setelahnya
                    $batas_waktu_edit = strtotime('first sunday of next month', $tanggal_input);
                  }

                  // Tanggal sekarang
                  $tanggal_sekarang = time();

                  // Logika validasi
                  $allow_edit = $tanggal_sekarang <= $batas_waktu_edit;
                ?>
                  <tr>
                    <td><?php echo $no++; ?></td>
                    <td class="text-center">
                      <?php echo date('d F Y', $tanggal_input); ?>
                    </td>
                    <td class="text-center">
                      <?php
                      foreach ($competisi as $kelas) {
                        if ($cpm->id_kelas == $kelas->id_kelas) {
                          echo $kelas->nama_kelas;
                          break;
                        }
                      }
                      ?>
                    </td>
                    <td class="text-center">
                      <?php echo array_sum(explode(',', $cpm->kerapihan_lab)); ?>
                    </td>
                    <td class="text-center">
                      <?php echo array_sum(explode(',', $cpm->keamanan_lab)); ?>
                    </td>
                    <td class="text-center">
                      <?php echo array_sum(explode(',', $cpm->ketertiban_lab)); ?>
                    </td>
                    <td class="text-center">
                      <?php echo $cpm->kebersihan_lab; ?>
                    </td>
                    <td class="text-center">
                      <?php
                      $total = array_sum(explode(',', $cpm->kerapihan_lab)) + array_sum(explode(',', $cpm->keamanan_lab)) + array_sum(explode(',', $cpm->ketertiban_lab)) + $cpm->kebersihan_lab;
                      echo $total;
                      ?>
                    </td>
                    <td>
                      <?php if ($allow_edit): ?>
                        <?php echo anchor(
                          'competition/kerapihan_lab_edit/edit/' . $cpm->id_aspek,
                          '<div class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></div>'
                        ); ?>
                      <?php else: ?>
                        <div class="btn btn-secondary btn-sm disabled"><i class="fas fa-edit"></i></div>
                      <?php endif; ?>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
