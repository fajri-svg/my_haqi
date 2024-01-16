<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
        <!-- <a href="<?= base_url('ranking/cetak/'); ?>" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
    </div>

    <div class="row">
        <div class="col-lg-8">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <div class="col-xl-12 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xl font-weight-bold text-primary text-uppercase mb-1">

                            <?php $Hour = date('G');

                            if ($Hour >= 00 && $Hour <= 11) {
                                echo "Selamat Pagi, " . $user['name'] . "!";
                            } else if ($Hour >= 12 && $Hour <= 15) {
                                echo "Selamat Siang, " . $user['name'] . "!";
                            } else if ($Hour >= 15 && $Hour <= 18) {
                                echo "Selamat Sore, " . $user['name'] . "!";
                            } else if ($Hour >= 19 || $Hour <= 01) {
                                echo "Selamat Malam, " . $user['name'] . "!";
                            }
                            ?>
                            <br> <span id="time"><?php echo $current_time; ?></span>
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


    <div class="row">
        <!-- <div class="card mb-5" style="max-width: 540px;">
            <div class="row no-gutters">
                <div class="col-md-4">
                    <img src="<?= base_url('assets/img/profile/') . $user['image'] ?>" class="card-img">
                </div>

                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title"><?= $user['name'] ?>
                        </h5>
                        <p class="card-text"><?= $user['email'] ?>
                        </p>
                        <p class="card-text"><small class="text-muted">Member since <?= date('d F Y', $user['date_created']) ?>
                            </small></p>
                    </div>
                </div>
            </div>
        </div> -->

        <div class="col-lg-6 mb-4">
            <!-- Illustrations -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Profile</h6>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 10.5rem;" src="<?= base_url('assets/img/profile/') . $user['image'] ?>" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?= $user['name'] ?>
                            </h5>
                            <p class="card-text"><?= $user['email'] ?>
                            </p>
                            <p class="card-text"><small class="text-muted">Member since <?= date('d F Y', $user['date_created']) ?>
                                </small></p>
                        </div>
                    </div>
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

        <div class="col-lg-12 mb-4">
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
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->