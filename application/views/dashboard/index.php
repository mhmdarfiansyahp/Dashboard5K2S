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
    <div class="row" style="height: 100%;">
      <div class="col-xl-9 stretch-card grid-margin">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Real Time Score 5K2S MI <?= date("F Y") ?></h4>
            <canvas id="myChart"></canvas>
          </div>
        </div>
      </div>
      <div class="col-xl-3  grid-margin" style="height: 100%;">
        <div class="card " style="background-image: linear-gradient( 93.2deg,  rgba(24,95,246,1) 14.4%, rgba(27,69,166,1) 90.8% );height: 50%;">
          <div class="card-header">
            <div class="text-white">
              <center>
                <h1 class="font-20 font-weight-semibold mb-0 bungee-regular"> Current Standing</h1>
              </center>
            </div>
          </div>
          <div class="card-body d-flex justify-content-center align-items-center" style="height:100%">
            <label class="bungee-regular" style="color:white;font-size:65px;vertical-align: middle;text-align: center;">#1</label>
          </div>
        </div>
        <div class="card" style="background-color: #0093E9;background-image: linear-gradient(160deg, #0093E9 0%, #80D0C7 100%);bottom: 0;height: 50%;">
          <div class="card-header">
            <div class="text-white">
              <center>
                <h1 class="font-20 font-weight-semibold mb-0 bungee-regular"> Last Standing </h1>
              </center>
            </div>
          </div>
          <div class="card-body d-flex justify-content-center align-items-center" style="height:100%">
            <label class="bungee-regular" style="color:white;font-size:65px;vertical-align: middle;text-align: center;">#7</label>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Include Chart.js and the Annotation plugin -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-annotation"></script>

  <script>
    const chartData = <?= json_encode($chartData) ?>;

    // Labels (Nama Kelas) dan Data
    const labels = chartData.map(item => item.nama_kelas); // Nama kelas sebagai label
    const dataValues = chartData.map(item => item.total_score);

    // Hitung rata-rata
    const averageValue = dataValues.reduce((a, b) => a + b, 0) / dataValues.length;

    // Warna batang
    const barColors = dataValues.map(value => value >= averageValue ? 'rgba(54, 162, 235, 0.7)' : 'rgba(255, 99, 132, 0.7)');

    // Inisialisasi Chart.js
    const ctx = document.getElementById('myChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Total Score',
                data: dataValues,
                backgroundColor: barColors,
                borderColor: barColors.map(color => color.replace('0.7', '1')),
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
</script>