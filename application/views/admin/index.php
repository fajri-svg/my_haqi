<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
        <!-- <a href="<?= base_url('ranking/cetak/'); ?>" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
    </div>

    <!-- Content Row -->
    <div class="row">


        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-12 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xl font-weight-bold text-primary text-uppercase mb-1">
                                <!---waktu indonesia-->
                                <?php date_default_timezone_set('Asia/Jakarta');
                                //pake format 24 jam
                                $Hour = date('G');

                                if ($Hour >= 00 && $Hour <= 11) {
                                    echo "Selamat Pagi, " . $user['name'] . "!" . "<br> $current_time";
                                } else if ($Hour >= 12 && $Hour <= 15) {
                                    echo "Selamat Siang, " . $user['name'] . "!" . "<br> $current_time";
                                } else if ($Hour >= 15 && $Hour <= 18) {
                                    echo "Selamat Sore, " . $user['name'] . "!" . "<br> $current_time";
                                } else if ($Hour >= 19 || $Hour <= 01) {
                                    echo "Selamat Malam, " . $user['name'] . "!" . "<br> $current_time";
                                }
                                ?>
                            </div>
                            <div class="mb-0 font-weight-bold text-gray-800">
                                You Enter <b>Start to Lead</b> Area, Prepare yourself to <b>Leading Self, Leading Team, & Leading Business</b>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <a href="<?= base_url('data/datauser'); ?>" class="font-weight-bold text-primary text-uppercase mb-1">
                                Jumlah User</a>
                            <h3 class="mb-0 font-weight-bold text-gray-800">
                                <?= count($alternatif); ?></h3>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-fw fa-user fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <a href="<?= base_url('data'); ?>" class="font-weight-bold text-info text-uppercase mb-1">
                                Jumlah kriteria</a>
                            <h3 class="mb-0 font-weight-bold text-gray-800">
                                <?= count($kriteria); ?></h3>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-fw fa-table fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Row -->
        <!-- <div class="row"> -->
        <div class="col-lg-12 mb-4">

            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
                </div>
                <div class="card-body">
                    <h4 class="small font-weight-bold">HTML <span class="float-right">
                            HTML Usage: <?= $language_percentages['html']; ?>%
                    </h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-info" role="progressbar" style="width: <?= $language_percentages['html']; ?>%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">PHP <span class="float-right">
                            PHP Usage: <?= $language_percentages['php']; ?>%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar" role="progressbar" style="width: <?= $language_percentages['php']; ?>%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">javascript <span class="float-right">
                            JavaScript Usage: <?= $language_percentages['js']; ?>%
                        </span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: <?= $language_percentages['js']; ?>%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <!-- Batas -->
                    <!-- <h4 class="small font-weight-bold">Payout Details <span class="float-right">80%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">Account Setup <span class="float-right">Complete!</span></h4>
                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                    </div> -->
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <!-- Illustrations -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Motto</h6>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 15rem;" src="assets/img/luffy.png" alt="...">
                    </div>
                    <p>"Jika jalannya terlihat terlalu mudah, mungkin kamu berada di jalan yang salah."
                    <p class="mb-0"><b>-Luffy, One Piece</b></p>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Information</h6>
                </div>
                <div class="card-body">
                    <p>Website ini masih dalam tahap pengembangan.
                        Jika menemukan kendala atau bug, </p>
                    <p class="mb-0">silahkan rekan-rekan bisa menghubungi developernya
                        <a href="whatsapp://send?text=Hello&phone=+6288221084363"> disini.</a>
                    </p>
                </div>
            </div>
        </div>
        <!-- </div> -->
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->