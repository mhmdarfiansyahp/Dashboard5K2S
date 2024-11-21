<!-- partial -->
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
    <!-- first row starts here -->
    <div class="row">
      <div class="col-xl-12 stretch-card grid-margin">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Penilaian Kompetisi 5K2S</h4>
          </div>
          <div class="card-body">
            <a class="btn btn-primary" href="<?php echo base_url('competition/pilih_kls'); ?>">Tambah Penilaian</a>
            <table id="tableCompetition" class="table table-bootstrap"> 
              <thead >
                <tr>
                  <th rowspan="2" class="text-center thStyle" >No</th>
                  <th rowspan="2" class="text-center thStyle" >Tanggal</th>
                  <th rowspan="2" class="text-center thStyle" >Kelas</th>
                  <th colspan="4" class="text-center thStyle">Poin</th>
                  <th rowspan="2" class="text-center thStyle" >Total</th>
                </tr>
                <tr>
                  <th class="text-center thStyle">Kerapihan</th>
                  <th class="text-center thStyle">Keamanan</th>
                  <th class="text-center thStyle">Ketertiban dan Kedisiplinan</th>
                  <th class="text-center thStyle">Kebersihan</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="text-center" style="font-size: 14px;">1</td>
                  <td class="text-center" style="font-size: 14px;">7 November 2024</td>
                  <td class="text-center" style="font-size: 14px;">1 A</td>
                  <td class="text-center" style="font-size: 14px;">5</td>
                  <td class="text-center" style="font-size: 14px;">1</td>
                  <td class="text-center" style="font-size: 14px;">4</td>
                  <td class="text-center" style="font-size: 14px;">10</td>
                  <td class="text-center" style="font-size: 14px;">20</td>
                </tr>
                <tr>
                  <td class="text-center" style="font-size: 14px;">2</td>
                  <td class="text-center" style="font-size: 14px;">3 November 2024</td>
                  <td class="text-center" style="font-size: 14px;">1 B</td>
                  <td class="text-center" style="font-size: 14px;">3</td>
                  <td class="text-center" style="font-size: 14px;">3</td>
                  <td class="text-center" style="font-size: 14px;">4</td>
                  <td class="text-center" style="font-size: 14px;">8</td>
                  <td class="text-center" style="font-size: 14px;">18</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
