<?php
    require "../config.php";
    header("Content-Type: application/vnd.ms-excel; charset=utf-8");
    header("Content-Disposition: attachment; filename= laporan.xls");
        $query = "SELECT * FROM transaksi WHERE waktu_transaksi BETWEEN '{$_GET['mulai']}' AND '{$_GET['akhir']}'";
        $transaksi = mysqli_query(DB, $query);
        $penjualan = [];
        $penjualan2 = [];
        $total_pelanggan = 0;
        $pelanggan = [];
        $jumlah_pendapatan = 0;

        foreach ($transaksi as $row) {
            $jumlah_pendapatan += $row["total"];

            if (!in_array($row["pelanggan_id"], $pelanggan)) {
                $total_pelanggan += 1;
            } else {
                array_push($pelanggan, $row["pelanggan_id"]);
            }

            if (array_key_exists($row["waktu_transaksi"], $penjualan)) {
                $penjualan[$row['waktu_transaksi']] += $row["total"];
            } else {
                $penjualan[$row['waktu_transaksi']] = $row["total"];
            }

            $date_key = new DateTime($row["waktu_transaksi"]);
            $date_key = $date_key->format("j F Y");
            if (array_key_exists($date_key, $penjualan2)) {
                $penjualan2[$date_key] += $row["total"];
            } else {
                $penjualan2[$date_key] = $row["total"];
            }
        }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Master Transaksi</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
        <p><b>Rekap Laporan Penjualan dari</b> <?= $_GET['mulai'] ?> sampai <?= $_GET["akhir"] ?></p>
        <table border=1>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Total</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($penjualan2 as $tanggal => $total): ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td><?= $tanggal ?></td>
                        <td>Rp. <?= $total ?></td>
                        <?php $no += 1; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <br>
        <br>
        <table border=1>
            <thead>
                <tr>
                    <th>Jumlah Pelanggan</th>
                    <th>Jumlah Pendapatan</th>
                </tr>
            </thead>
            <tbody>
                <td><?= $total_pelanggan ?> Orang</td>
                <td>Rp. <?= $jumlah_pendapatan ?></td>
            </tbody>
        </table>
    </div>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</body>
</html>
