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
                        <table id="tableCompetition" class="table table-bootstrap">
                            <thead>
                                <tr>
                                    <th rowspan="2" class="text-center thStyle">No</th>
                                    <th rowspan="2" class="text-center thStyle">Kelas</th>
                                    <th colspan="3" class="text-center thStyle">Poin</th>
                                    <th rowspan="2" class="text-center thStyle">aksi</th>
                                </tr>
                                <tr>
                                    <th class="text-center thStyle">Kerapihan</th>
                                    <th class="text-center thStyle">Ketertiban dan Kedisiplinan</th>
                                    <th class="text-center thStyle">Kebersihan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1; foreach ($kompetisi as $cpm) : ?>
                                    <tr>
                                        <td class="text-center" style="font-size: 14px;"><?php echo $no++; ?></td>
                                        <td class="text-center" style="font-size: 14px;"><?php echo $cpm->nama_kelas; ?></td>
                                        <td class="text-center" style="font-size: 14px;"></td>
                                        <td class="text-center" style="font-size: 14px;"></td>
                                        <td class="text-center" style="font-size: 14px;"></td>
                                        <td>
                                        <?php echo anchor(
                                            'Kompetisi/tambah/' . $cpm->id_kelas,
                                            '<div class="btn btn-primary btn-sm"><i class="fas fa-plus"></i></div>'
                                        ); ?>
                                        <?php echo anchor(
                                            'Kompetisi/edit/' . $cpm->id_kelas,
                                            '<div class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></div>'
                                        ); ?>

                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a class="btn btn-warning" href="<?php echo base_url('competition'); ?>">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
