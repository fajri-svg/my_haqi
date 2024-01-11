<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->

    <div class="row">
        <div class="col-lg">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <!-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
        <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
            For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-2">
                <h6 class="m-0 font-weight-bold text-primary">Pilih User</h6>
            </div>
            <div class="card-body">
                <form action="<?= base_url('ranking/simpan'); ?>" method="POST">

                    <div class="table-responsive">

                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">



                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kriteria</th>
                                    <th>Bobot</th>
                                    <th>Poin 1</th>
                                    <th>Poin 2</th>
                                    <th>Poin 3</th>
                                    <th>Poin 4</th>
                                    <th>Poin 5</th>
                                    <th>Poin 6</th>
                                    <th>Poin 7</th>
                                    <th>Poin 8</th>
                                    <th>Poin 9</th>
                                    <th>Poin 10</th>
                                    <th>Sifat Kriteria</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kriteria</th>
                                    <th>Bobot</th>
                                    <th>Poin 1</th>
                                    <th>Poin 2</th>
                                    <th>Poin 3</th>
                                    <th>Poin 4</th>
                                    <th>Poin 5</th>
                                    <th>Poin 6</th>
                                    <th>Poin 7</th>
                                    <th>Poin 8</th>
                                    <th>Poin 9</th>
                                    <th>Poin 10</th>
                                    <th>Sifat Kriteria</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <!-- Isi tabel -->
                            <tbody>

                                <div class="form-group">
                                    <?php $i = 1; ?>
                                    <?php foreach ($kriteria as $dalt) : ?>
                                        <tr>
                                            <input type="hidden" name="id_user" value="<?= $id_user; ?>" />
                                            <td><?= $i ?></td>
                                            <td>
                                                <label><?= $dalt['nama_kriteria']; ?></label>
                                                <input type="hidden" name="id_krite<?= $i; ?>" value="<?= $dalt['id_kriteria']; ?>" />
                                            </td>

                                            <td><?= $dalt['bobot']; ?></td>
                                            <td><input type="radio" name="nilai<?= $i; ?>" id="nilai<?= $i; ?>1" value="<?= $dalt['poin1']; ?>" <?= $kriteria == $dalt['poin1'] ? 'checked' : ''; ?> />
                                                <label for="nilai<?= $i; ?>1"><?= $dalt['poin1']; ?></label>
                                            </td>
                                            <td><input type="radio" name="nilai<?= $i; ?>" id="nilai<?= $i; ?>1" value="<?= $dalt['poin2']; ?>" <?= $kriteria == $dalt['poin2'] ? 'checked' : ''; ?> />
                                                <label for="nilai<?= $i; ?>2"><?= $dalt['poin2']; ?></label>
                                            </td>
                                            <td><input type="radio" name="nilai<?= $i; ?>" id="nilai<?= $i; ?>1" value="<?= $dalt['poin3']; ?>" <?= $kriteria == $dalt['poin3'] ? 'checked' : ''; ?> />
                                                <label for="nilai<?= $i; ?>3"><?= $dalt['poin3']; ?></label>
                                            </td>
                                            <td><input type="radio" name="nilai<?= $i; ?>" id="nilai<?= $i; ?>1" value="<?= $dalt['poin4']; ?>" <?= $kriteria == $dalt['poin4'] ? 'checked' : ''; ?> />
                                                <label for="nilai<?= $i; ?>4"><?= $dalt['poin4']; ?></label>
                                            </td>
                                            <td><input type="radio" name="nilai<?= $i; ?>" id="nilai<?= $i; ?>1" value="<?= $dalt['poin5']; ?>" <?= $kriteria == $dalt['poin5'] ? 'checked' : ''; ?> />
                                                <label for="nilai<?= $i; ?>5"><?= $dalt['poin5']; ?></label>
                                            </td>
                                            <td><input type="radio" name="nilai<?= $i; ?>" id="nilai<?= $i; ?>1" value="<?= $dalt['poin6']; ?>" <?= $kriteria == $dalt['poin6'] ? 'checked' : ''; ?> />
                                                <label for="nilai<?= $i; ?>6"><?= $dalt['poin6']; ?></label>
                                            </td>
                                            <td><input type="radio" name="nilai<?= $i; ?>" id="nilai<?= $i; ?>1" value="<?= $dalt['poin7']; ?>" <?= $kriteria == $dalt['poin7'] ? 'checked' : ''; ?> />
                                                <label for="nilai<?= $i; ?>7"><?= $dalt['poin7']; ?></label>
                                            </td>
                                            <td><input type="radio" name="nilai<?= $i; ?>" id="nilai<?= $i; ?>1" value="<?= $dalt['poin8']; ?>" <?= $kriteria == $dalt['poin8'] ? 'checked' : ''; ?> />
                                                <label for="nilai<?= $i; ?>8"><?= $dalt['poin8']; ?></label>
                                            </td>
                                            <td><input type="radio" name="nilai<?= $i; ?>" id="nilai<?= $i; ?>1" value="<?= $dalt['poin9']; ?>" <?= $kriteria == $dalt['poin9'] ? 'checked' : ''; ?> />
                                                <label for="nilai<?= $i; ?>9"><?= $dalt['poin9']; ?></label>
                                            </td>
                                            <td><input type="radio" name="nilai<?= $i; ?>" id="nilai<?= $i; ?>1" value="<?= $dalt['poin10']; ?>" <?= $kriteria == $dalt['poin10'] ? 'checked' : ''; ?> />
                                                <label for="nilai<?= $i; ?>10"><?= $dalt['poin10']; ?></label>
                                            </td>

                                            <td><?= $dalt['sifat']; ?></td>
                                            <td>
                                                <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
                                                <!-- <a href="" class="badge badge-success">edit</a>
                                                        <a href="" class="badge badge-danger">delete</a> -->
                                            </td>
                                        </tr>

                                        <?php $i++; ?>
                                    <?php endforeach; ?>
                                </div>
                            </tbody>

                        </table>

                    </div>
                    <!-- <h3>Silahkan pilih alternatif</h3> -->

                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.container-fluid -->

</div>