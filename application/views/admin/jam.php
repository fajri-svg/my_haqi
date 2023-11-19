<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $karyawan = $_POST["karyawan"];
    $weight = $_POST["weight"];

    $kriteriaCount = count($weight);
    $karyawanCount = count($karyawan);

    // Validasi jumlah kriteria dan karyawan
    if ($kriteriaCount > 1 && $karyawanCount > 1) {
        // Fungsi untuk menghitung nilai benefit
        function calculateBenefit($data, $weight, $max, $min)
        {
            return array_map(function ($value) use ($weight, $max, $min) {
                return $weight * ($max - $value) / ($max - $min);
            }, $data);
        }

        // Fungsi untuk menghitung nilai cost
        function calculateCost($data, $weight, $max, $min)
        {
            return array_map(function ($value) use ($weight, $max, $min) {
                return $weight * ($value - $min) / ($max - $min);
            }, $data);
        }

        // Menghitung nilai max dan min untuk setiap kriteria
        $maxValues = [];
        $minValues = [];

        foreach ($karyawan as $key => $data) {
            if ($key === 0) {
                $maxValues = $data;
                $minValues = $data;
            } else {
                foreach ($data as $k => $v) {
                    $maxValues[$k] = max($maxValues[$k], $v);
                    $minValues[$k] = min($minValues[$k], $v);
                }
            }
        }

        // Menghitung nilai benefit dan cost
        $benefitMatrix = [];
        $costMatrix = [];

        foreach ($karyawan as $data) {
            $benefitMatrix[] = calculateBenefit($data, $weight, $maxValues, $minValues);
            $costMatrix[] = calculateCost($data, $weight, $maxValues, $minValues);
        }

        // Menghitung nilai jarak dari solusi ideal positif dan negatif
        $positiveIdealSolution = [];
        $negativeIdealSolution = [];

        foreach ($karyawan as $key => $data) {
            if ($key === 0) {
                $positiveIdealSolution = $benefitMatrix[$key];
                $negativeIdealSolution = $costMatrix[$key];
            } else {
                $positiveIdealSolution = array_map(function ($x, $y) {
                    return $x + $y;
                }, $positiveIdealSolution, $benefitMatrix[$key]);

                $negativeIdealSolution = array_map(function ($x, $y) {
                    return $x + $y;
                }, $negativeIdealSolution, $costMatrix[$key]);
            }
        }

        // Menghitung nilai preferensi
        $preferensi = [];

        foreach ($karyawan as $key => $data) {
            $positifJarak = 0;
            $negatifJarak = 0;

            foreach ($data as $k => $v) {
                $positifJarak += pow($benefitMatrix[$key][$k] - $positiveIdealSolution[$k], 2);
                $negatifJarak += pow($costMatrix[$key][$k] - $negativeIdealSolution[$k], 2);
            }

            $preferensi[] = sqrt($positifJarak) / (sqrt($positifJarak) + sqrt($negatifJarak));
        }

        // Menentukan peringkat karyawan berdasarkan preferensi
        $ranking = array_map('intval', array_keys(array_diff($preferensi, array_unique($preferensi))) + 1);
        array_multisort($preferensi, SORT_DESC, $ranking, $karyawan);

        // Menampilkan hasil peringkat
        echo "Peringkat Karyawan berdasarkan metode TOPSIS:\n";
        foreach ($karyawan as $key => $data) {
            echo $ranking[$key] . ". " . implode(' - ', $data) . " - Preferensi: " . $preferensi[$key] . "\n";
        }
    } else {
        echo "Harap masukkan setidaknya 2 kriteria dan 2 karyawan.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>TOPSIS Karyawan Terbaik</title>
</head>

<body>
    <h1>TOPSIS Karyawan Terbaik</h1>
    <form method="post">
        <label for="kriteria">Masukkan Kriteria:</label>
        <input type="text" name="kriteria" id="kriteria" placeholder="K1, K2, K3, ...">
        <br>
        <label for="karyawan">Masukkan Data Karyawan:</label>
        <textarea name="karyawan" id="karyawan" rows="5" placeholder="Nama, Nilai K1, Nilai K2, Nilai K3, ..."></textarea>
        <br>
        <label for="weight">Masukkan Bobot Kriteria (1-100%):</label>
        <input type="text" name="weight" id="weight" placeholder="Weight K1, Weight K2, Weight K3, ...">
        <br>
        <input type="submit" value="Hitung">
    </form>
</body>

</html>