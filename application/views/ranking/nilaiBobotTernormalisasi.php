<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-4 text-gray-800"><?= $title ?>
    </h1> -->
    <!-- Begin Page Content -->
    <!-- <div class="container-fluid"> -->

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
                            <th rowspan="2">No</th>
                            <th rowspan="2">Nama</th>
                            <th colspan="<?= count($kriteria); ?>">
                                <center>Kriteria</center>
                            </th>
                        </tr>
                        <tr>
                            <?php
                            foreach ($kriteria as $k) {
                                echo "<th>{$k['nama_kriteria']}</th>";
                            }
                            ?>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th rowspan="2">No</th>
                            <th rowspan="2">Nama</th>
                        </tr>
                        <tr>
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
                        $query_alternatif = $this->db->get('user')->result();

                        foreach ($query_alternatif as $da) {
                            echo "<tr>
                                <td>" . (++$i) . "</td>
                                <td>{$da->name}</td>";
                            $idalt = $da->id_user;

                            //ambil nilai
                            $query_nilai = $this->db->get_where('nilai_matrik', ['id_user' => $idalt])->result();

                            foreach ($query_nilai as $dn) {
                                $idk = $dn->id_kriteria;

                                //nilai kuadrat
                                $nilai_kuadrat = 0;
                                $query_kuadrat = $this->db->get_where('nilai_matrik', ['id_kriteria' => $idk])->result();

                                foreach ($query_kuadrat as $dkuadrat) {
                                    $nilai_kuadrat += ($dkuadrat->nilai * $dkuadrat->nilai);
                                }

                                //hitung jml alternatif
                                $jml_alternatif = $this->db->count_all('user');
                                //nilai bobot kriteria (rata")
                                $bobot = 0;
                                $tnilai = 0;

                                $query_bobot = $this->db->get_where('nilai_matrik', ['id_kriteria' => $idk])->result();

                                foreach ($query_bobot as $dbobot) {
                                    $tnilai += $dbobot->nilai;
                                }
                                $bobot = $tnilai / $jml_alternatif;

                                //nilai bobot input
                                $query_kriteria = $this->db->get_where('kriteria', ['id_kriteria' => $idk])->row();
                                $bot = $query_kriteria->bobot;

                                echo "<td align='center'>" . round(($dn->nilai / sqrt($nilai_kuadrat)) * $bot, 3) . "</td>";
                            }
                            echo "</tr>";
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- </div> -->
    <!-- /.container-fluid -->
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->