<?php
    require "conn.php";
    $query = "SELECT b.id, b.kode_barang, b.nama_barang, b.harga, b.stok, s.nama FROM barang AS b JOIN supplier AS s ON b.supplier_id = s.id";

    $barang = mysqli_query($conn, $query);

    $query_transaksi = "SELECT t.id, t.waktu_transaksi, t.keterangan, t.total, p.nama FROM transaksi as t LEFT JOIN pelanggan as p ON t.pelanggan_id = p.id";
    $transaksi = mysqli_query($conn, $query_transaksi);

    $query_transaksi_detail = "SELECT td.transaksi_id, b.nama_barang, td.harga, td.qty, td.subtotal FROM transaksi_detail AS td JOIN barang AS b ON td.barang_id = b.id";
    $transaksi_detail = mysqli_query($conn, $query_transaksi_detail);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .btn {
            padding: 10px;
            background: blue;
            margin-top: 50px;
            color: white;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <h1>Data Barang</h1>
    <table border=1>
        <tr>
            <th>ID</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Nama Supplier</th>
            <th>Action</th>
        </tr>
        <?php foreach ($barang as $row): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['kode_barang'] ?></td>
                <td><?= $row['nama_barang'] ?></td>
                <td><?= $row['harga'] ?></td>
                <td><?= $row['stok'] ?></td>
                <td><?= $row['nama'] ?></td>
                <td><a href="hapusBarang.php?id=<?= $row['id'] ?>" onclick="confirmDelete(event)">Delete</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <h1>Transaksi</h1>
    <table border=1>
        <tr>
            <th>ID</th>
            <th>Waktu Transaksi</th>
            <th>Keterangan</th>
            <th>Total</th>
            <th>Nama Pelanggan</th>
        </tr>
        <?php foreach ($transaksi as $row): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['waktu_transaksi'] ?></td>
                <td><?= $row['keterangan'] ?></td>
                <td><?= $row['total'] ?></td>
                <td><?= $row["nama"] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <h1>Transaksi Detail</h1>
    <table style="margin-bottom: 40px;" border=1>
        <tr>
            <th>Transaksi ID</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Qty</th>
            <th>Subtotal</th>
        </tr>
        <?php foreach ($transaksi_detail as $row): ?>
                <tr>
                    <td><?= $row["transaksi_id"] ?></td>
                    <td><?= $row["nama_barang"] ?></td>
                    <td><?= $row["harga"] ?></td>
                    <td><?= $row["qty"] ?></td>
                    <td><?= $row["subtotal"] ?></td>

                </tr>
        <?php endforeach; ?>
    </table>
    <a class="btn" href="tambahDataTransaksi.php">Tambah Transaksi</a>
    <a class="btn" href="tambahDetailTransaksi.php">Tambah Transaksi Detail</a>
    <script>
        function confirmDelete(event) {
            if (!confirm("Apakah anda yakin ingin menghapus data ini")) {
                event.preventDefault(); 
            }
        }
    </script>
</body>
</html>