<?php
    $page = "Tranasksi";
    include "../Components/header.php";

    $query_transaksi = "SELECT t.id, t.waktu_transaksi, t.keterangan, t.total, p.nama FROM transaksi as t LEFT JOIN pelanggan as p ON t.pelanggan_id = p.id";
    $transaksi = mysqli_query(DB, $query_transaksi);

    $query_transaksi_detail = "SELECT td.transaksi_id, b.nama_barang, td.harga, td.qty FROM transaksi_detail AS td JOIN barang AS b ON td.barang_id = b.id";
    $transaksi_detail = mysqli_query(DB, $query_transaksi_detail);

?>
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

<div class="table-container shadow m-6">
    <h2 class="bg-primary text-white">Data Master Transaksi</h2>
    <div class="mb-3">
        <a href="tambahTransaksi.php" class="btn btn-success">Tambah Transaksi</a>
        <a href="tambahDetailTransaksi.php" class="btn btn-primary">Tambah Transaksi Detail</a>
        <a href="reportTransaksi.php" class="btn btn-primary">Lihat Laporan</a>
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
                    <td>Rp. <?= number_format($row["total"], 2, ",", ".") ?></td>
                    <td class='action-btns'>
                        <a href="<?= ROOT ?>/Transaksi/transaksiDetail.php?detailid=<?= $row['id'] ?>" class='btn btn-info'>Lihat Detail</a>
                        <a href="<?= ROOT ?>/Transaksi/deleteTransaksi.php?deleteid=<?= $row['id'] ?>" onclick="deleteConfirm(event)" class='btn btn-danger'>Hapus</a>
                    </td>
                </tr>
                <?php $no += 1 ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
  function deleteConfirm(event) {
    let confirmation = confirm("Yakin anda ingin menghapus Transaksi?");

    if (!confirmation) {
      event.preventDefault();
    }
  }
</script>

<?php include "../Components/footer.php" ?>