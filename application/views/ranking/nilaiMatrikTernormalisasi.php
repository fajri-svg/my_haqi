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
                                <th rowspan="2">No</th>
                                <th rowspan="2">Nama</th>
                                <th colspan="<?= count($kriteria); ?>">Kriteria</th>
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
                            $this->db->order_by('id_user', 'asc');
                            $a = $this->db->get('user')->result_array();

                            foreach ($a as $da) {
                                echo "<tr>
                                <td>" . (++$i) . "</td>
                                <td>{$da['name']}</td>";
                                $idalt = $da['id_user'];

                                // ambil nilai
                                $this->db->order_by('id_matrik', 'asc');
                                $n = $this->db->get_where('nilai_matrik', array('id_user' => $idalt))->result_array();

                                foreach ($n as $dn) {
                                    $idk = $dn['id_kriteria'];

                                    // nilai kuadrat
                                    $nilai_kuadrat = 0;
                                    $this->db->select('nilai');
                                    $k = $this->db->get_where('nilai_matrik', array('id_kriteria' => $idk))->result_array();
                                    foreach ($k as $dkuadrat) {
                                        $nilai_kuadrat = $nilai_kuadrat + ($dkuadrat['nilai'] * $dkuadrat['nilai']);
                                    }

                                    echo "<td align='center'>" . round(($dn['nilai'] / sqrt($nilai_kuadrat)), 3) . "</td>";
                                }
                                echo "</tr>\n";
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Nilai Bobot Ternormalisasi -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><?= $title5 ?></h6>
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

        <?php
        $query = $this->db->get('kriteria');
        $h = $query->num_rows();
        ?>
        <!-- tabel matrik ideal-positif -->
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

        <!-- tabel matrik idealnegatif -->
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

        <!-- tabel jarak-solusi-positif -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><?= $title3 ?></h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>D<sup>+</sup></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>D<sup>+</sup></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            // Load database in CI3
                            $ci = &get_instance();
                            $ci->load->database();

                            $i2 = 1;
                            $i3 = 0;
                            $maxarray = array();
                            $a2 = $ci->db->query("SELECT * FROM kriteria ORDER BY id_kriteria ASC");
                            // echo "<tr>";
                            foreach ($a2->result_array() as $da2) {

                                $idalt2 = $da2['id_kriteria'];

                                $n2 = $ci->db->query("SELECT * FROM nilai_matrik WHERE id_kriteria='$idalt2' ORDER BY id_matrik ASC");
                                $jarakp2 = 0;
                                $c2 = 0;
                                $ymax2 = array();

                                foreach ($n2->result_array() as $dn2) {
                                    $idk2 = $dn2['id_kriteria'];

                                    $nilai_kuadrat2 = 0;
                                    $k2 = $ci->db->query("SELECT * FROM nilai_matrik WHERE id_kriteria='$idk2' ORDER BY id_matrik ASC ");
                                    foreach ($k2->result_array() as $dkuadrat2) {
                                        $nilai_kuadrat2 = $nilai_kuadrat2 + ($dkuadrat2['nilai'] * $dkuadrat2['nilai']);
                                    }

                                    $jml_alternatif2 = $ci->db->query("SELECT * FROM user");

                                    $jml_a2 = $jml_alternatif2->num_rows();
                                    $bobot2 = 0;
                                    $tnilai2 = 0;

                                    $k22 = $ci->db->query("SELECT * FROM nilai_matrik WHERE id_kriteria='$idk2' ORDER BY id_matrik ASC ");
                                    foreach ($k22->result_array() as $dbobot2) {
                                        $tnilai2 = $tnilai2 + $dbobot2['nilai'];
                                    }
                                    $bobot2 = $tnilai2 / $jml_a2;

                                    $b2 = $ci->db->query("SELECT * FROM kriteria WHERE id_kriteria='$idk2'");
                                    $nbot2 = $b2->row_array();
                                    $bot2 = $nbot2['bobot'];

                                    $v2 = round(($dn2['nilai'] / sqrt($nilai_kuadrat2)) * $bot2, 4);

                                    $ymax2[$c2] = $v2;
                                    $c2++;

                                    if ($nbot2['sifat'] == 'benefit') {
                                        $mak2 = max($ymax2);
                                    } else {
                                        $mak2 = min($ymax2);
                                    }
                                }

                                foreach ($ymax2 as $nymax2) {
                                    $jarakp2 = $jarakp2 + pow($nymax2 - $mak2, 2);
                                }

                                $maxarray[$i3] = $mak2;

                                $i2++;
                                $i3++;
                            }

                            $_SESSION['ymax'] = $maxarray;

                            $i = 1;
                            $ii = 0;
                            $dpreferensi = array();

                            $a = $ci->db->query("SELECT * FROM user ORDER BY id_user ASC;");
                            // echo "<tr>";
                            foreach ($a->result_array() as $da) {

                                $idalt = $da['id_user'];

                                $n = $ci->db->query("SELECT * FROM nilai_matrik WHERE id_user='$idalt' ORDER BY id_matrik ASC");
                                $jarakp = 0;
                                $c = 0;
                                $ymax = array();

                                foreach ($n->result_array() as $dn) {
                                    $idk = $dn['id_kriteria'];

                                    $nilai_kuadrat = 0;
                                    $k = $ci->db->query("SELECT * FROM nilai_matrik WHERE id_kriteria='$idk' ORDER BY id_matrik ASC ");
                                    foreach ($k->result_array() as $dkuadrat) {
                                        $nilai_kuadrat = $nilai_kuadrat + ($dkuadrat['nilai'] * $dkuadrat['nilai']);
                                    }

                                    $jml_alternatif = $ci->db->query("SELECT * FROM user ORDER BY id_user ASC;");

                                    $jml_a = $jml_alternatif->num_rows();
                                    $bobot = 0;
                                    $tnilai = 0;

                                    $k2 = $ci->db->query("SELECT * FROM nilai_matrik WHERE id_kriteria='$idk' ORDER BY id_matrik ASC ");
                                    foreach ($k2->result_array() as $dbobot) {
                                        $tnilai = $tnilai + $dbobot['nilai'];
                                    }
                                    $bobot = $tnilai / $jml_a;

                                    $b2 = $ci->db->query("SELECT * FROM kriteria WHERE id_kriteria='$idk'");
                                    $nbot = $b2->row_array();
                                    $bot = $nbot['bobot'];

                                    $v = round(($dn['nilai'] / sqrt($nilai_kuadrat)) * $bot, 4);

                                    $ymax[$c] = $v;
                                    $c++;
                                    $mak = max($ymax);
                                }

                                foreach ($ymax as $nymax => $value) {
                                    $maks = $_SESSION['ymax'][$nymax];
                                    $final = sqrt($jarakp = $jarakp + pow($value - $maks, 2));
                                }

                                echo "<tr>
                                    <td>$i</td>
                                    <td>$da[name]</td>
                                    <td>" . round($final, 4) . "</td>
                                    </tr>";
                                //session plus
                                $dpreferensi[$ii] = round($final, 4);
                                $_SESSION['dplus'] = $dpreferensi;

                                $i++;
                                $ii++;
                            }

                            echo "</tr>";

                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- tabel jarak-solusi-negatif -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><?= $title4 ?></h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>D<sup>-</sup></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>D<sup>-</sup></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            //buat array kolom

                            $i2 = 1;
                            $i3 = 0;
                            $minarray = array();
                            $a2 = $this->db->query("select * from kriteria order by id_kriteria asc;")->result_array();
                            // echo "<tr>";
                            foreach ($a2 as $da2) {

                                $idalt2 = $da2['id_kriteria'];

                                //ambil nilai

                                $n2 = $this->db->query("select * from nilai_matrik where id_kriteria='$idalt2' order by id_matrik ASC")->result_array();
                                $jarakp2 = 0;
                                $c2 = 0;
                                $ymin2 = array();

                                foreach ($n2 as $dn2) {
                                    $idk2 = $dn2['id_kriteria'];

                                    //nilai kuadrat

                                    $nilai_kuadrat2 = 0;
                                    $k2 = $this->db->query("select * from nilai_matrik where id_kriteria='$idk2' order by id_matrik ASC ")->result_array();
                                    foreach ($k2 as $dkuadrat2) {
                                        $nilai_kuadrat2 = $nilai_kuadrat2 + ($dkuadrat2['nilai'] * $dkuadrat2['nilai']);
                                    }

                                    //hitung jml user
                                    $jml_alternatif2 = $this->db->query("select * from user order by id_user asc;")->result_array();

                                    $jml_a2 = count($jml_alternatif2);
                                    //nilai bobot kriteria (rata")
                                    $bobot2 = 0;
                                    $tnilai2 = 0;

                                    $k22 = $this->db->query("select * from nilai_matrik where id_kriteria='$idk2' order by id_matrik ASC ")->result_array();
                                    foreach ($k22 as $dbobot2) {
                                        $tnilai2 = $tnilai2 + $dbobot2['nilai'];
                                    }
                                    $bobot2 = $tnilai2 / $jml_a2;

                                    //nilai bobot input
                                    $b2 = $this->db->query("select * from kriteria where id_kriteria='$idk2'")->row_array();
                                    $bot2 = $b2['bobot'];

                                    $v2 = round(($dn2['nilai'] / sqrt($nilai_kuadrat2)) * $bot2, 4);

                                    $ymin2[$c2] = $v2;
                                    $c2++;

                                    #cek benefit atau cost
                                    if ($b2['sifat'] == 'cost') {
                                        $min2 = max($ymin2);
                                    } else {
                                        $min2 = min($ymin2);
                                    } #cek benefit atau cost

                                    //$min2=min($ymin2);

                                }

                                //hitung D+

                                foreach ($ymin2 as $nymin2) {

                                    $jarakp2 = $jarakp2 + pow($nymin2 - $min2, 2);
                                    //echo "--".$mak."---";
                                }

                                //array max
                                $minarray[$i3] = $min2;

                                //print_r($maxarray);
                                //print_r(max($ymax2));

                                $i2++;
                                $i3++;
                            }
                            //session array ymax
                            $this->session->set_userdata('ymin', $minarray);

                            //array baris//////////////////////////////////////////////////
                            $i = 1;
                            $ii = 0;
                            $id_alt = array();
                            $a = $this->db->query("select * from user order by id_user asc;")->result_array();
                            // echo "<tr>";
                            foreach ($a as $da) {

                                $idalt = $da['id_user'];

                                //ambil nilai

                                $n = $this->db->query("select * from nilai_matrik where id_user='$idalt' order by id_matrik ASC")->result_array();
                                $jarakp = 0;
                                $c = 0;
                                $ymax = array();
                                $arraymin = array();
                                foreach ($n as $dn) {
                                    $idk = $dn['id_kriteria'];


                                    //nilai kuadrat

                                    $nilai_kuadrat = 0;
                                    $k = $this->db->query("select * from nilai_matrik where id_kriteria='$idk' order by id_matrik ASC ")->result_array();
                                    foreach ($k as $dkuadrat) {
                                        $nilai_kuadrat = $nilai_kuadrat + ($dkuadrat['nilai'] * $dkuadrat['nilai']);
                                    }

                                    //hitung jml alternatif
                                    $jml_alternatif = $this->db->query("select * from user order by id_user asc;")->result_array();

                                    $jml_a = count($jml_alternatif);
                                    //nilai bobot kriteria (rata")
                                    $bobot = 0;
                                    $tnilai = 0;

                                    $k2 = $this->db->query("select * from nilai_matrik where id_kriteria='$idk' order by id_matrik ASC ")->result_array();
                                    foreach ($k2 as $dbobot) {
                                        $tnilai = $tnilai + $dbobot['nilai'];
                                    }
                                    $bobot = $tnilai / $jml_a;

                                    //nilai bobot input
                                    $b2 = $this->db->query("select * from kriteria where id_kriteria='$idk'")->row_array();
                                    $nbot = $b2['bobot'];
                                    $bot = $nbot;

                                    $v = round(($dn['nilai'] / sqrt($nilai_kuadrat)) * $bot, 4);

                                    $ymin[$c] = $v;
                                    $c++;
                                    $min = max($ymin);
                                }
                                //hitung D+
                                foreach ($ymin as $nymin => $value) {
                                    $mins = $this->session->userdata('ymin')[$nymin];
                                    //	echo $mins." - ";
                                    $final = sqrt($jarakp = $jarakp + pow($value - $mins, 2));
                                    //	echo $jarakp." || ";
                                }

                                echo "<tr>
                                    <td>$i</td>
                                    <td>$da[name]</td>
                                    <td>" . round($final, 4) . "</td>
                                    </tr>";
                                //session min
                                $dpreferensi[$ii] = round($final, 4);
                                $this->session->set_userdata('dmin', $dpreferensi);
                                // print_r($ymin);

                                //ambil id alternatif
                                $id_alt[$ii] = $da['id_user'];
                                $this->session->set_userdata('id_alt', $id_alt);

                                $i++;
                                $ii++;
                            }

                            echo "</tr>";
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