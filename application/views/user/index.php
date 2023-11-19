<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>

        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <div class="col-xl-12 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xl font-weight-bold text-primary text-uppercase mb-1">

                            <?php date_default_timezone_set('Asia/Jakarta');

                            $Hour = date('G');

                            if ($Hour >= 01 && $Hour <= 11) {
                                echo "Selamat Pagi, " . $user['name'] . "!";
                            } else if ($Hour >= 12 && $Hour <= 15) {
                                echo "Selamat Siang, " . $user['name'] . "!";
                            } else if ($Hour >= 15 && $Hour <= 18) {
                                echo "Selamat Sore, " . $user['name'] . "!";
                            } else if ($Hour >= 19 || $Hour <= 01) {
                                echo "Selamat Malam, " . $user['name'] . "!";
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
    <div class="row">
        <div class="col-lg-8">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>
    <div class="card mb-3" style="max-width: 540px;">
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
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->