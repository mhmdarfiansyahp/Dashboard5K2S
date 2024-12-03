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
                    <div class="card-header bg-primary text-white">
                        <h4>Penilaian Kompetisi 5K2S</h4>
                    </div>
                    <div class="card-body">
                        <form id="formPenilaian" action="<?= base_url('competition/ketertiban_lab') ?>" method="post">
                            <h4 class="card-title">Aspek Ketertiban dan Kedisiplinan Lab </h4>
                            <br>
                            <h6 class="mt-3">Jumlah kehadiran pengguna Lab </h6>
                            <div class="d-flex flex-column">
                                <?php
                                // Opsi untuk jumlah kehadiran pengguna Lab
                                $options1 = [
                                    5 => "90-100% tingkat absensi pengguna Lab",
                                    4 => "80-89% tingkat absensi pengguna Lab",
                                    3 => "70-79% tingkat absensi pengguna Lab",
                                    2 => "60-69% tingkat absensi pengguna Lab",
                                    1 => "50-59% tingkat absensi pengguna Lab",
                                    0 => "<50% tingkat absensi pengguna Lab"
                                ];
                                foreach ($options1 as $value => $label) {
                                    echo "<label class='d-flex align-items-center mb-3'>
                                            <input type='radio' name='ketertiban_lab_1' value='$value' class='me-2' style='margin-right: 10px;'>
                                            [$value Point] $label
                                          </label>";
                                }
                                ?>

                            </div>

                            <!-- Kerapihan Atribut -->
                            <h6 class="mt-4">Jumlah Jam Minus Pengguna Lab</h6>
                            <div class="d-flex flex-column">
                                <?php
                                $options2 = [
                                    5 => "&lt; 60 Jam Minus",
                                    4 => "&lt; 70 Jam Minus",
                                    3 => "&lt; 80 Jam Minus",
                                    2 => "&lt; 90 Jam Minus",
                                    1 => "&lt; 100 Jam Minus",
                                    0 => "&gt; 100 Jam Minus"
                                ];
                                foreach ($options2 as $value => $label) {
                                    echo "<label class='d-flex align-items-center mb-3'>
                                        <input type='radio' name='ketertiban_lab_2' value='$value' class='me-2' style='margin-right: 10px;'>
                                        [$value Point] $label
                                        </label>";
                                }
                                ?>
                            </div>


                            <!-- Kerapihan Atribut -->
                            <h6 class="mt-4">Kepatuhan terhadap tata tertib Lab </h6>
                            <div class="d-flex flex-column">
                                <?php
                                // Opsi untuk kepatuhan terhadap tata tertib Lab
                                $options3 = [
                                    5 => "0 Kasus tata tertib Lab",
                                    4 => "1 Kasus tata tertib Lab",
                                    3 => "2 Kasus tata tertib Lab",
                                    2 => "3 Kasus tata tertib Lab",
                                    1 => "4 Kasus tata tertib Lab",
                                    0 => "&gt; 4 Kasus tata tertib Lab"
                                ];
                                foreach ($options3 as $value => $label) {
                                    echo "<label class='d-flex align-items-center mb-3'>
                                            <input type='radio' name='ketertiban_lab_3' value='$value' class='me-2' style='margin-right: 10px;'>
                                            [$value Point] $label
                                          </label>";
                                }
                                ?>

                            </div>

                            <div class="card-footer d-flex justify-content-between">
                                <button id="btnSubmit" class="btn btn-primary ms-auto">Selanjutnya</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.getElementById('btnSubmit').addEventListener('click', function(event) {
                // Mencegah form submit default
                event.preventDefault();

                // Array of all radio button groups (name attributes)
                const radioGroups = ['ketertiban_lab_1', 'ketertiban_lab_2', 'ketertiban_lab_3'];

                let allSelected = true;
                for (const group of radioGroups) {
                    const radios = document.getElementsByName(group);
                    const isSelected = Array.from(radios).some(radio => radio.checked);
                    if (!isSelected) {
                        allSelected = false;
                        break;
                    }
                }

                // Show SweetAlert or submit the form
                if (allSelected) {
                    document.getElementById('formPenilaian').submit();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Semua pertanyaan harus diisi sebelum melanjutkan!',
                    });
                }
            });
        </script>