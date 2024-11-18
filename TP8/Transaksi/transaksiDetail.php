<?php
    include "../Components/header.php";

    if (isset($_GET['detailid'])) {
        $query_transaksi_detail = "SELECT td.transaksi_id, b.nama_barang, td.harga, td.qty FROM transaksi_detail AS td JOIN barang AS b ON td.barang_id = b.id WHERE td.transaksi_id = {$_GET["detailid"]}";
        $transaksi_detail = mysqli_query(DB, $query_transaksi_detail);
    }
?>

<?php if (isset($_GET['detailid'])): ?>
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

    <div class="table-container shadow m-6">
        <h2 class="bg-primary text-white">Detail Transaksi</h2>
        <div class="mb-3">
            <a href="<?= ROOT ?>/Transaksi/transaksi.php" class="btn btn-primary">Kembali</a>
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
<?php else: ?>
    <div>ERROR</div>
<?php endif; ?>

<?php include "../Components/footer.php" ?>