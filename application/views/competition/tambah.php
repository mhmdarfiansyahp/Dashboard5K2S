<style>
  .card-body {
    max-height: 600px;
    /* Batasi tinggi maksimal */
    overflow-y: auto;
    /* Tambahkan scrollbar vertikal */
    overflow-x: hidden;

  }
</style>

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
      <div class="col-xl-12 grid-margin">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Penilaian Kompetisi 5K2S</h4>
          </div>
          <div class="card-body">
            <h4 class="card-title">Aspek Kerapihan Lab</h4>
            <br>
            <h6>Kerapihan letak properti Lab</h6>
            <br>
            <label style="font-size: 16px;">
              <input type="radio" name="kerapihan_lab" value="5">
              [5 Point] Semua properti diletakkan pada tempat yang seharusnya dan Rapi
            </label>
            <br>
            <br>
            <label style="font-size: 16px;">
              <input type="radio" name="kerapihan_lab" value="4">
              [4 Point] Sebagian besar properti diletakkan pada tempat yang seharusnya dan Rapi
            </label>
            <br>
            <br>
            <label style="font-size: 16px;">
              <input type="radio" name="kerapihan_lab" value="3">
              [3 Point] Sebagian besar properti diletakkan pada tempat yang seharusnya dan Tidak Rapi
            </label>
            <br>
            <br>
            <label style="font-size: 16px;">
              <input type="radio" name="kerapihan_lab" value="2">
              [2 Point] Beberapa properti diletakkan pada tempat yang seharusnya dan Rapi
            </label>
            <br>
            <br>
            <label style="font-size: 16px;">
              <input type="radio" name="kerapihan_lab" value="1">
              [1 Point] Beberapa properti diletakkan pada tempat yang seharusnya dan Tidak Rapi
            </label>
            <br>
            <br>
            <label style="font-size: 16px;">
              <input type="radio" name="kerapihan_lab" value="0">
              [0 Point] Properti diletakkan tidak pada tempat yang seharusnya dan tidak Rapi
            </label>

            <br>
            <br>
            <br>
            <h6>Kerapihan atribut yang digunakan pengguna Lab</h6>
            <br>
            <label style="font-size: 16px;">
              <input type="radio" name="kerapihan_lab" value="5">
              [5 Point] Semua properti diletakkan pada tempat yang seharusnya dan Rapi
            </label>
            <br>
            <br>
            <label style="font-size: 16px;">
              <input type="radio" name="kerapihan_lab" value="4">
              [4 Point] Sebagian besar properti diletakkan pada tempat yang seharusnya dan Rapi
            </label>
            <br>
            <br>
            <label style="font-size: 16px;">
              <input type="radio" name="kerapihan_lab" value="3">
              [3 Point] Sebagian besar properti diletakkan pada tempat yang seharusnya dan Tidak Rapi
            </label>
            <br>
            <br>
            <label style="font-size: 16px;">
              <input type="radio" name="kerapihan_lab" value="2">
              [2 Point] Beberapa properti diletakkan pada tempat yang seharusnya dan Rapi
            </label>
            <br>
            <br>
            <label style="font-size: 16px;">
              <input type="radio" name="kerapihan_lab" value="1">
              [1 Point] Beberapa properti diletakkan pada tempat yang seharusnya dan Tidak Rapi
            </label>
            <br>
            <br>
            <label style="font-size: 16px;">
              <input type="radio" name="kerapihan_lab" value="0">
              [0 Point] Properti diletakkan tidak pada tempat yang seharusnya dan tidak Rapi
            </label>

            <br>
            <br>
            <br>
            <h6>Kerapihan Rambut dan Seragam pengguna Lab</h6>
            <br>
            <label style="font-size: 16px;">
              <input type="radio" name="kerapihan_lab" value="5">
              [5 Point] Semua properti diletakkan pada tempat yang seharusnya dan Rapi
            </label>
            <br>
            <br>
            <label style="font-size: 16px;">
              <input type="radio" name="kerapihan_lab" value="4">
              [4 Point] Sebagian besar properti diletakkan pada tempat yang seharusnya dan Rapi
            </label>
            <br>
            <br>
            <label style="font-size: 16px;">
              <input type="radio" name="kerapihan_lab" value="3">
              [3 Point] Sebagian besar properti diletakkan pada tempat yang seharusnya dan Tidak Rapi
            </label>
            <br>
            <br>
            <label style="font-size: 16px;">
              <input type="radio" name="kerapihan_lab" value="2">
              [2 Point] Beberapa properti diletakkan pada tempat yang seharusnya dan Rapi
            </label>
            <br>
            <br>
            <label style="font-size: 16px;">
              <input type="radio" name="kerapihan_lab" value="1">
              [1 Point] Beberapa properti diletakkan pada tempat yang seharusnya dan Tidak Rapi
            </label>
            <br>
            <br>
            <label style="font-size: 16px;">
              <input type="radio" name="kerapihan_lab" value="0">
              [0 Point] Properti diletakkan tidak pada tempat yang seharusnya dan tidak Rapi
            </label>
          </div>
          <div class="card-footer d-flex justify-content-between">
            <a class="btn btn-warning" href="<?php echo base_url('competition/pilih_kls'); ?>">Kembali</a>
            <button class="btn btn-primary ms-auto">Selanjutnya</button>
          </div>
        </div>
      </div>
    </div>
  </div>