<!-- <?php
        @session_start();
        include("konfig/koneksi.php");

        /*
echo "<i>cek sessionn dplus</i>";    
echo "<pre>";    
print_r($_SESSION['dplus']);    
echo "</pre>";  

echo "<i>cek sessionn dmin</i>";    
echo "<pre>";    
print_r($_SESSION['dmin']);    
echo "</pre>";  
*/

        ?> -->

<title>Laporan Data</title>

<body onLoad="javascript:window:print()">
    <!-- <?php include "config/database.php"; ?> -->
    <style type="text/css"></style>

    <div style="width:80%;">

        <h2 align="center">Laporan Hasil Perhitungan <br>
            SPK TOPSIS</h2>

        <hr style="border-top:2px solid #333;" width="80%">
    </div>

    <table id='theList' border=1 width='80%' align="center">
        <thead>
            <tr>
                <th width="3%" bgcolor="#CCCCCC">Nomor</th>
                <th width="10%" bgcolor="#CCCCCC">Nama</th>
                <th width="12%" bgcolor="#CCCCCC">V<sub>i</sub></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            $a = $this->db->get("user")->result_array();
            echo "<tr>";
            $sortir = array();
            foreach ($a as $da) {
                $idalt = $da['id_user'];

                //ambil nilai
                $n = $this->db->query("SELECT * FROM nilai_matrik WHERE id_user='$idalt' ORDER BY id_matrik ASC")->result_array();

                $c = 0;
                $ymax = array();
                foreach ($n as $dn) {
                    $idk = $dn['id_kriteria'];

                    //nilai kuadrat
                    $nilai_kuadrat = 0;
                    $k = $this->db->query("SELECT * FROM nilai_matrik WHERE id_kriteria='$idk' ORDER BY id_matrik ASC ")->result_array();
                    foreach ($k as $dkuadrat) {
                        $nilai_kuadrat += ($dkuadrat['nilai'] * $dkuadrat['nilai']);
                    }

                    //hitung jml alternatif
                    $jml_alternatif = $this->db->get("user")->num_rows();
                    //nilai bobot kriteria (rata)
                    $bobot = 0;
                    $tnilai = 0;

                    $k2 = $this->db->query("SELECT * FROM nilai_matrik WHERE id_kriteria='$idk' ORDER BY id_matrik ASC ")->result_array();
                    foreach ($k2 as $dbobot) {
                        $tnilai += $dbobot['nilai'];
                    }
                    $bobot = $tnilai / $jml_alternatif;

                    //nilai bobot input
                    $b2 = $this->db->get_where("kriteria", array('id_kriteria' => $idk))->row_array();
                    $bot = $b2['bobot'];

                    $v = round(($dn['nilai'] / sqrt($nilai_kuadrat)) * $bot, 4);

                    $ymax[$c] = $v;
                    $c++;
                    $mak = max($ymax);
                    $min = min($ymax);
                }

                $i++;
            }

            foreach (@$_SESSION['dplus'] as $key => $dxmin) {
                #ubah ke nol hasil akhir
                $nilaid = 0;
                $nilaiPre = 0;
                $nilai = 0;

                $jarakm = $_SESSION['dmin'][$key];
                $id_alt = $_SESSION['id_alt'][$key];

                //nama alternatif
                $nama = $this->db->query("SELECT * FROM user WHERE id_user='$id_alt'")->row_array();
                $nm = $nama['name'];

                $nilaiPre = $dxmin + $jarakm;
                $nilaid = $jarakm / $nilaiPre;
                $nilai = round($nilaid, 4);

                //simpan ke tabel nilai preferensi
                $this->db->insert("nilai_preferensi", array('name' => $nm, 'nilai' => $nilai));
            }

            //ambil data sesuai dengan nilai tertinggi
            $i = 1;
            $sql3 = $this->db->query("SELECT * FROM nilai_preferensi  ORDER BY nilai DESC")->result_array();
            foreach ($sql3 as $data3) {
                echo "<tr>
		<td>" . $i . "</td>
		<td>{$data3['name']}</td>
		<td>{$data3['nilai']}</td>
		</tr>";

                $i++;
            }

            //kosongkan tabel nilai preferensi
            $this->db->truncate("nilai_preferensi");

            echo "</tr>";
            ?>

        </tbody>
    </table>

    <br>
    <br>
    <br>
    <table border="0" width='80%' align="center">
        <tr>
            <td colspan="3" align="right">Bandung, <?php echo date('d-M-Y'); ?></td>
        </tr>
        <tr>
            <td colspan="3" align="right">-- Jabatan --</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3" align="right">-- Nama & TTD --</td>
        </tr>
    </table>

    <br>
    <br>
    <br>
    <br>
    <br>
</body>