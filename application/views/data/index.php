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
            <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
                <h6 class="m-0 font-weight-bold text-primary"><?= $title ?></h6>
                <a href="<?= base_url('data/tambahKriteria/'); ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Tambah Kriteria</a>
            </div>
            <div class="card-body">
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
                            <?php $i = 1; ?>
                            <?php foreach ($kriteria as $d) : ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $d['nama_kriteria']; ?></td>
                                    <td><?= $d['bobot']; ?></td>
                                    <td><?= $d['poin1']; ?></td>
                                    <td><?= $d['poin2']; ?></td>
                                    <td><?= $d['poin3']; ?></td>
                                    <td><?= $d['poin4']; ?></td>
                                    <td><?= $d['poin5']; ?></td>
                                    <td><?= $d['poin6']; ?></td>
                                    <td><?= $d['poin7']; ?></td>
                                    <td><?= $d['poin8']; ?></td>
                                    <td><?= $d['poin9']; ?></td>
                                    <td><?= $d['poin10']; ?></td>
                                    <td><?= $d['sifat']; ?></td>
                                    <td>
                                        <a href="<?= base_url('data/ubahKriteria/' . $d['id_kriteria']); ?>" class="badge badge-success">Ubah</a>
                                        <a href="<?= base_url('data/deleteKriteria/' . $d['id_kriteria']); ?>" class="badge badge-danger">Hapus</a>
                                        <!-- <a href="" class="badge badge-success">edit</a>
                                        <a href="" class="badge badge-danger">delete</a> -->
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->