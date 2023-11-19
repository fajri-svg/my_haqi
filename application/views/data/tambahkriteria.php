<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <!-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
        <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
            For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><?= $title ?></h6>
            </div>
            <div class="card-body">
                <form action="<?= base_url('data/simpanKriteria'); ?>" method="POST">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Id Kriteria</th>
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
                            <!-- Isi tabel -->
                            <tbody>

                                    <tr>
                                        <td><input type="text" name="id_kriteria" class="form-control" value="<?= $IDbaru; ?>" readonly></td>
                                        <td><input type="text" name="nama_kriteria" class="form-control" placeholder="Nama Kriteria"></td>
                                        <td><input type="number" step="any" name="bobot" class="form-control" placeholder="Bobot"></td>
                                        <td><input type="number" step="any" name="poin1" class="form-control" placeholder="Poin 1"></td>
                                        <td><input type="number" step="any" name="poin2" class="form-control" placeholder="Poin 2"></td>
                                        <td><input type="number" step="any" name="poin3" class="form-control" placeholder="Poin 3"></td>
                                        <td><input type="number" step="any" name="poin4" class="form-control" placeholder="Poin 4"></td>
                                        <td><input type="number" step="any" name="poin5" class="form-control" placeholder="Poin 5"></td>
                                        <td><input type="number" step="any" name="poin6" class="form-control" placeholder="Poin 6"></td>
                                        <td><input type="number" step="any" name="poin7" class="form-control" placeholder="Poin 7"></td>
                                        <td><input type="number" step="any" name="poin8" class="form-control" placeholder="Poin 8"></td>
                                        <td><input type="number" step="any" name="poin9" class="form-control" placeholder="Poin 9"></td>
                                        <td><input type="number" step="any" name="poin10" class="form-control" placeholder="Poin 10"></td>
                                        <td> <select name="sifat" class="form-control">
                                                <option value="benefit">Benefit</option>
                                                <option value="cost">Cost</option>
                                            </select></td>
                                        <td>
                                            <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
                                            <!-- <a href="" class="badge badge-success">edit</a>
                                        <a href="" class="badge badge-danger">delete</a> -->
                                        </td>
                                    </tr>

                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->