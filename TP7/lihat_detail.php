<?php
    require "conn.php";

    if (isset($_GET['id_transaksi'])) {
        $query_transaksi_detail = "SELECT td.transaksi_id, b.nama_barang, td.harga, td.qty FROM transaksi_detail AS td JOIN barang AS b ON td.barang_id = b.id WHERE td.barang_id = {$_GET["id_transaksi"]}";
        $transaksi_detail = mysqli_query($conn, $query_transaksi_detail);
    }
?>

<?php if (isset($_GET['id_transaksi'])): ?>
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

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
        <h2 class="bg-primary text-white">Detail Transaksi</h2>
        <div class="mb-3">
            <a href="index.php" class="btn btn-primary">Kembali</a>
        </div>

        <table class="table table-bordered" style="margin-bottom: 40px;" border=1>
            <tr class="thead-light">
                <th>Transaksi ID</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Qty</th>
            </tr>
            <?php foreach ($transaksi_detail as $row): ?>
                    <tr>
                        <td><?= $row["transaksi_id"] ?></td>
                        <td><?= $row["nama_barang"] ?></td>
                        <td><?= $row["harga"] ?></td>
                        <td><?= $row["qty"] ?></td>
                    </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <script>
        function confirmDelete(event) {
            if (!confirm("Apakah anda yakin ingin menghapus data ini")) {
                event.preventDefault(); 
            }
        }
    </script>
</body>
</html>
<?php else: ?>
    <div>ERROR</div>
<?php endif; ?>
