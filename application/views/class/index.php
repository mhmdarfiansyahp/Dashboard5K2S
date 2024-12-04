<div class="main-panel">
  <div class="content-wrapper pb-0">
    <div class="page-header flex-wrap">
      <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
        <div class="d-flex align-items-center">
          <a href="#">
            <p class="m-0 pr-3">Kelas Saya</p>
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
              <table class="table table-bootstrap">
                <thead>
                  <tr>
                    <th class="text-center thStyle">No</th>
                    <th class="text-center thStyle">Bulan</th>
                    <th class="text-center thStyle">Tahun</th>
                    <th class="text-center thStyle">Kerapihan</th>
                    <th class="text-center thStyle">Keamanan</th>
                    <th class="text-center thStyle">Ketertiban dan Kedisiplinan</th>
                    <th class="text-center thStyle">Kebersihan</th>
                    <th class="text-center thStyle">Total</th>
                    <th class="text-center thStyle">Peringkat</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  foreach ($item['aspek'] as $cpm):
                    $tanggal_update = strtotime($cpm['create_at']);
                    $bulan = date('F', $tanggal_update);
                    $tahun = date('Y', $tanggal_update);
                    $total = array_sum(explode(',', $cpm['kerapihan_lab'])) +
                      array_sum(explode(',', $cpm['keamanan_lab'])) +
                      array_sum(explode(',', $cpm['ketertiban_lab'])) +
                      $cpm['kebersihan_lab'];
                  ?>
                    <tr>
                      <td class="text-center"><?php echo $no++; ?></td>
                      <td class="text-center"><?php echo $bulan; ?></td>
                      <td class="text-center"><?php echo $tahun; ?></td>
                      <td class="text-center"><?php echo array_sum(explode(',', $cpm['kerapihan_lab'])); ?></td>
                      <td class="text-center"><?php echo array_sum(explode(',', $cpm['keamanan_lab'])); ?></td>
                      <td class="text-center"><?php echo array_sum(explode(',', $cpm['ketertiban_lab'])); ?></td>
                      <td class="text-center"><?php echo $cpm['kebersihan_lab']; ?></td>
                      <td class="text-center"><?php echo $total; ?></td>
                      <td>
                         
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