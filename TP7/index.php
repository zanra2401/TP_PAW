<?php
    require "conn.php";

    $query_transaksi = "SELECT t.id, t.waktu_transaksi, t.keterangan, t.total, p.nama FROM transaksi as t LEFT JOIN pelanggan as p ON t.pelanggan_id = p.id";
    $transaksi = mysqli_query($conn, $query_transaksi);

    $query_transaksi_detail = "SELECT td.transaksi_id, b.nama_barang, td.harga, td.qty FROM transaksi_detail AS td JOIN barang AS b ON td.barang_id = b.id";
    $transaksi_detail = mysqli_query($conn, $query_transaksi_detail);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Master Transaksi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .table-container { 
            margin: 20px; 
            padding: 40px;
            position: relative;
            padding-top: 80px;
            height: fit;
        }
        .action-btns { display: flex; gap: 5px; }

        .table-container > h2 {
            width: 100%;
            background-color: red;
            position: absolute;
            top: 0;
            left: 0;
            padding: 10px;
        }
    </style>
</head>
<body>

<nav class="navbar bg-dark navbar-dark navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="#">Penjualan <span class="fw-normal">XYZ</span></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse fw-bold text-white" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link text-white fw-bold" href="#">Supplier</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white fw-bold" href="#">Barang</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white fw-bold" href="#">Transaksi</a>
            </li>
        </ul>
    </div>
  </div>
</nav>


<div class="table-container shadow m-6">
    <h2 class="bg-primary text-white">Data Master Transaksi</h2>
    <div class="mb-3">
        <a href="report_transaksi.php" class="btn btn-primary">Lihat Laporan Penjualan</a>
        <a href="tambah_transaksi.php" class="btn btn-success">Tambah Transaksi</a>
    </div>
    <table class="table table-bordered">
        <thead class="thead-light">
            <tr>
                <th>No</th>
                <th>ID Transaksi</th>
                <th>Waktu Transaksi</th>
                <th>Nama Pelanggan</th>
                <th>Keterangan</th>
                <th>Total</th>
                <th>Tindakan</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($transaksi as $row): ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $row["id"] ?></td>
                    <td><?= $row["waktu_transaksi"] ?></td>
                    <td><?= $row["nama"] ?></td>
                    <td><?= $row["keterangan"] ?></td>
                    <td>Rp. <?= $row["total"] ?></td>
                    <td class='action-btns'>
                        <a href="lihat_detail.php?id_transaksi=<?= $row['id'] ?>" class='btn btn-info'>Lihat Detail</a>
                        <a href="hapus_transaksi.php?id_transaksi=<?= $row['id'] ?>" class='btn btn-danger'>Hapus</a>
                    </td>
                </tr>
                <?php $no += 1 ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
