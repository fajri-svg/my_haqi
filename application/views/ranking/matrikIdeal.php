<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?>
    </h1>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <!-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
        <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
            For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

        <?php
        $query = $this->db->get('kriteria');
        $h = $query->num_rows();
        ?>
        <!-- tabel negatif-positif -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><?= $title1 ?></h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th colspan="<?= $h; ?>">
                                    <center>Kriteria</center>
                                </th>
                            </tr>
                            <tr>
                                <?php
                                $hk = $this->db->query("select nama_kriteria from kriteria order by id_kriteria asc;")->result_array();
                                foreach ($hk as $dhk) {
                                    echo "<th>" . $dhk['nama_kriteria'] . "</th>";
                                }
                                ?>
                            </tr>
                            <tr>
                                <?php
                                for ($n = 1; $n <= $h; $n++) {
                                    echo "<th>y<sub>$n</sub><sup>+</sup></th>";
                                }
                                ?>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <?php
                                $hk = $this->db->query("select nama_kriteria from kriteria order by id_kriteria asc;")->result_array();
                                foreach ($hk as $dhk) {
                                    echo "<th>" . $dhk['nama_kriteria'] . "</th>";
                                }
                                ?>
                            </tr>

                        </tfoot>
                        <tbody>
                            <?php
                            $i = 0;
                            $a = $this->db->query("select * from kriteria order by id_kriteria asc;")->result_array();
                            echo "<tr>";
                            foreach ($a as $da) {
                                $idalt = $da['id_kriteria'];

                                // ambil nilai
                                $n = $this->db->query("select * from nilai_matrik where id_kriteria='$idalt'  order by id_matrik ASC")->result_array();

                                $c = 0;
                                $ymax = array();
                                foreach ($n as $dn) {
                                    $idk = $dn['id_kriteria'];

                                    // nilai kuadrat
                                    $nilai_kuadrat = 0;
                                    $k = $this->db->query("select * from nilai_matrik where id_kriteria='$idk'  order by id_matrik ASC ")->result_array();
                                    foreach ($k as $dkuadrat) {
                                        $nilai_kuadrat = $nilai_kuadrat + ($dkuadrat['nilai'] * $dkuadrat['nilai']);
                                    }

                                    // hitung jumlah user
                                    $jml_alternatif = $this->db->query("select * from user");
                                    $jml_a = $jml_alternatif->num_rows();

                                    // nilai bobot kriteria (rata-rata)
                                    $bobot = 0;
                                    $tnilai = 0;
                                    $k2 = $this->db->query("select * from nilai_matrik where id_kriteria='$idk'  order by id_matrik ASC ")->result_array();
                                    foreach ($k2 as $dbobot) {
                                        $tnilai = $tnilai + $dbobot['nilai'];
                                    }
                                    $bobot = $tnilai / $jml_a;

                                    // nilai bobot input
                                    $b2 = $this->db->query("select * from kriteria where id_kriteria='$idk'");
                                    $nbot = $b2->row_array();
                                    $bot = $nbot['bobot'];

                                    $v = round(($dn['nilai'] / sqrt($nilai_kuadrat)) * $bot, 4);
                                    $ymax[$c] = $v;
                                    $c++;
                                }

                                if ($nbot['sifat'] == 'benefit') {
                                    echo "<td>" . max($ymax) . "</td>";
                                } else {
                                    echo "<td>" . min($ymax) . "</td>";
                                }
                            }
                            echo "</tr>";
                            ?>



                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- tabel positif-negatif -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><?= $title2 ?></h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th colspan="<?= $h; ?>">
                                    <center>Kriteria</center>
                                </th>
                            </tr>
                            <tr>
                                <?php
                                $hk = $this->db->query("select nama_kriteria from kriteria order by id_kriteria asc;")->result_array();
                                foreach ($hk as $dhk) {
                                    echo "<th>" . $dhk['nama_kriteria'] . "</th>";
                                }
                                ?>
                            </tr>
                            <tr>
                                <?php
                                for ($n = 1; $n <= $h; $n++) {
                                    echo "<th>y<sub>{$n}</sub><sup>-</sup></th>";
                                }
                                ?>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <?php
                                $hk = $this->db->query("select nama_kriteria from kriteria order by id_kriteria asc;")->result_array();
                                foreach ($hk as $dhk) {
                                    echo "<th>" . $dhk['nama_kriteria'] . "</th>";
                                }
                                ?>
                            </tr>

                        </tfoot>
                        <tbody>
                            <tr>
                                <?php
                                $i = 0;
                                $a = $this->db->order_by('id_kriteria', 'asc')->get('kriteria')->result_array();
                                foreach ($a as $da) {
                                    $idalt = $da['id_kriteria'];
                                    $n = $this->db->where('id_kriteria', $idalt)->order_by('id_matrik', 'asc')->get('nilai_matrik')->result_array();
                                    $c = 0;
                                    $ymax = array();
                                    foreach ($n as $dn) {
                                        $idk = $dn['id_kriteria'];
                                        $nilai_kuadrat = 0;
                                        $k = $this->db->where('id_kriteria', $idk)->order_by('id_matrik', 'asc')->get('nilai_matrik')->result_array();
                                        foreach ($k as $dkuadrat) {
                                            $nilai_kuadrat += $dkuadrat['nilai'] * $dkuadrat['nilai'];
                                        }
                                        $jml_alternatif = $this->db->get('user')->num_rows();
                                        $bobot = 0;
                                        $tnilai = 0;
                                        $k2 = $this->db->where('id_kriteria', $idk)->order_by('id_matrik', 'asc')->get('nilai_matrik')->result_array();
                                        foreach ($k2 as $dbobot) {
                                            $tnilai += $dbobot['nilai'];
                                        }
                                        $bobot = $tnilai / $jml_alternatif;
                                        $b2 = $this->db->where('id_kriteria', $idk)->get('kriteria')->row_array();
                                        $bot = $b2['bobot'];
                                        $v = round(($dn['nilai'] / sqrt($nilai_kuadrat)) * $bot, 4);
                                        $ymax[$c] = $v;
                                        $c++;
                                    }
                                    if ($b2['sifat'] == 'cost') {
                                        echo "<td>" . max($ymax) . "</td>";
                                    } else {
                                        echo "<td>" . min($ymax) . "</td>";
                                    }
                                }
                                ?>
                            </tr>
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