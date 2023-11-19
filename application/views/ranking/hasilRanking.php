<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
        <a href="<?= base_url('ranking/cetak/'); ?>" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
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
                                <th>Nomor</th>
                                <th>Nama</th>
                                <th>V<sub>i</sub></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Nomor</th>
                                <th>Nama</th>
                                <th>V<sub>i</sub></th>
                            </tr>
                        </tfoot>
                        <tbody>

                            <?php
                            $i = 1;
                            $a = $this->db->query("SELECT * FROM user ORDER BY id_user ASC");

                            $sortir = array();
                            foreach ($a->result_array() as $da) {
                                $idalt = $da['id_user'];

                                //ambil nilai
                                $n = $this->db->query("SELECT * FROM nilai_matrik WHERE id_user='$idalt' ORDER BY id_matrik ASC");

                                $c = 0;
                                $ymax = array();
                                foreach ($n->result_array() as $dn) {
                                    $idk = $dn['id_kriteria'];

                                    //nilai kuadrat
                                    $nilai_kuadrat = 0;
                                    $k = $this->db->query("SELECT * FROM nilai_matrik WHERE id_kriteria='$idk' ORDER BY id_matrik ASC");
                                    foreach ($k->result_array() as $dkuadrat) {
                                        $nilai_kuadrat = $nilai_kuadrat + ($dkuadrat['nilai'] * $dkuadrat['nilai']);
                                    }

                                    //hitung jml alternatif
                                    $jml_alternatif = $this->db->query("SELECT * FROM user ORDER BY id_user ASC");
                                    $jml_a = $jml_alternatif->num_rows();
                                    //nilai bobot kriteria (rata)
                                    $bobot = 0;
                                    $tnilai = 0;

                                    $k2 = $this->db->query("SELECT * FROM nilai_matrik WHERE id_kriteria='$idk' ORDER BY id_matrik ASC");
                                    foreach ($k2->result_array() as $dbobot) {
                                        $tnilai = $tnilai + $dbobot['nilai'];
                                    }
                                    $bobot = $tnilai / $jml_a;

                                    //nilai bobot input
                                    $b2 = $this->db->query("SELECT * FROM kriteria WHERE id_kriteria='$idk'");
                                    $nbot = $b2->row_array();
                                    $bot = $nbot['bobot'];

                                    $v = round(($dn['nilai'] / sqrt($nilai_kuadrat)) * $bot);

                                    $ymax[$c] = $v;
                                    $c++;
                                    $mak = max($ymax);
                                    $min = min($ymax);
                                }

                                $i++;
                            }

                            foreach ($_SESSION['dplus'] as $key => $dxmin) {
                                //ubah ke nol hasil akhir
                                $nilaid = 0;
                                $nilaiPre = 0;
                                $nilai = 0;

                                $jarakm = $_SESSION['dmin'][$key];
                                $id_alt = $_SESSION['id_alt'][$key];

                                //nama user
                                $nama = $this->db->query("SELECT * FROM user WHERE id_user='$id_alt'");
                                $nm = $nama->row_array();

                                /*
                                echo $jarakm . " / <br> ";
                                echo $dxmin . " + ";
                                echo $jarakm . "<br><br>";
                                */

                                $nilaiPre = $dxmin + $jarakm;

                                $nilaid = $jarakm / $nilaiPre;

                                $nilai = round($nilaid, 4);

                                //simpan ke tabel nilai preferensi
                                $nm_alternatif = $nm['name'];

                                $sql2 = $this->db->query("INSERT INTO nilai_preferensi (name, nilai) VALUES ('$nm_alternatif', '$nilai')");

                                /*
                                echo "INSERT INTO nilai_preferensi (name, nilai) VALUES ('$nm_alternatif', '$nilai')";
                                */
                            }
                            // Ambil data sesuai dengan nilai tertinggi
                            $i = 1;
                            $sql3 = $this->db->query("SELECT * FROM nilai_preferensi ORDER BY nilai DESC");
                            foreach ($sql3->result_array() as $data3) {
                                echo "<tr>
                                <td>" . $i . "</td>
                                <td>{$data3['name']}</td>
                                <td>{$data3['nilai']}</td>
                            </tr>";

                                $i++;
                            }

                            // Kosongkan tabel nilai preferensi
                            $this->db->query("DELETE FROM nilai_preferensi");
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