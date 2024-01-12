<?php
// Mengatur header untuk download file Excel
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Ranking.xls");

// Tampilkan data dalam format tabel seperti di contoh Anda
?>

<table border="1">
    <thead>
        <tr>
            <th>Nomor</th>
            <th>Nama</th>
            <th>V<sub>i</sub></th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        <?php foreach ($rankings as $ranking): ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $ranking['name']; ?></td>
                <td><?php echo $ranking['nilai']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
