<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-4 text-gray-800"><?= $title ?>
    </h1> -->
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
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <?php
                                foreach ($kriteria as $k) {
                                    echo "<th>{$k['nama_kriteria']}</th>";
                                }
                                ?>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <?php
                                foreach ($kriteria as $k) {
                                    echo "<th>{$k['nama_kriteria']}</th>";
                                }
                                ?>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            $i = 0;
                            foreach ($alternatif as $da) {
                                echo "<tr>
                                <td>" . (++$i) . "</td>
                                <td>" . $da['name'] . "</td>";

                                $idalt = $da['id_user'];
                                $nilai_matrik = $this->NilaiMatrik_model->getNilaiMatriks($idalt);

                                foreach ($nilai_matrik as $dn) {
                                    if ($dn ) {
                                        # code...
                                    }
                                    echo "<td align='center'>{$dn['nilai']}</td>";
                                }
                                echo "</tr>";
                            }
                            ?>
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