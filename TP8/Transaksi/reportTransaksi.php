<?php
    include "../Components/header.php";
    
    if (isset($_POST["submit"]) && isset($_POST["mulai"]) && isset($_POST['akhir'])) {
        $query = "SELECT * FROM transaksi WHERE waktu_transaksi BETWEEN '{$_POST['mulai']}' AND '{$_POST['akhir']}' ORDER BY waktu_transaksi";

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
    }

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



    .mychart {
        max-width: 100%;
        width: 100%;
    }   

    .container {
        overflow: hidden;
    }

    #table-a {
        width: 400px;
    }
</style>


<?php if (isset($_POST['submit']) && isset($_POST["mulai"]) && isset($_POST['akhir'])): ?>

<div class="px-5 mt-4 pb-4 full" style="width: 100vw; position: abosolute;">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white fw-bold" id="judul">
            <b>Rekap Laporan Penjualan dari</b> <?= $_POST['mulai'] ?> sampai <?= $_POST["akhir"] ?>
        </div>
        <div class="card-body">
        <a href="reportTransaksi.php" class="noprint btn btn-primary mb-3"> Kembali</a>
        <br>
        <button class="btn-warning btn noprint" onclick="window.print()">Cetak</button>
        <button class="btn-warning btn noprint" onclick="window.location.href = 'excel.php?mulai=<?= $_POST['mulai'] ?>&akhir=<?= $_POST['akhir'] ?>'">Excel</button>
        <canvas id="mychart" class="mb-4"></canvas>
        <table class="table mb-4 table-bordered">
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
                        <td>Rp. <?= number_format($total, 2, ",", ".") ?></td>
                        <td><?= $tanggal ?></td>
                        <?php $no += 1; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <table class="table table-bordered mb-4" id="table-a">
            <thead>
                <tr>
                    <th>Jumlah Pelanggan</th>
                    <th>Jumlah Pendapatan</th>
                </tr>
            </thead>
            <tbody>
                <td><?= $total_pelanggan ?> Orang</td>
                <td>Rp. <?= number_format($jumlah_pendapatan, 2, ",", ".") ?></td>
            </tbody>
        </table>
    </div>
</div>

<?php else: ?>
    <div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white fw-bold">
            Rekap Laporan Penjualan
        </div>
        <div class="card-body">
            <a href="index.php" class="noprint btn btn-primary mb-3"> Kembali</a>
            <form method="post" action="" class="d-flex align-items-center">
                <div class="form-group mb-0 me-2">
                    <input name="mulai" type="date" class="form-control" placeholder="Tanggal Mulai">
                </div>
                <div class="form-group mb-0 me-2">
                    <input name="akhir" type="date" class="form-control" placeholder="Tanggal Akhir">
                </div>
                <button type="submit" name="submit" class="btn btn-success">Tampilkan</button>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

<?php if (isset($_POST["submit"])): ?>
    <script>
        const ctx = document.getElementById("mychart").getContext("2d");

        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
            labels: <?= json_encode(array_keys($penjualan)); ?>,
            datasets: [{
                label: 'My First Dataset',
                data: <?= json_encode(array_values($penjualan)) ?>,
                backgroundColor: "rgba(128, 128, 128, 0.2)",
                borderColor: "rgba(128, 128, 128, 0.5)",
                borderWidth: 1
            }]},
        });
    </script>
<?php endif; ?>

<?php include "../Components/footer.php" ?>