<?php
    require "conn.php";
    
    if (isset($_POST["submit"])) {
        $totalM = (int)$_POST["mulai"];
        $totalA = (int)$_POST["akhir"];
        $query = "SELECT * FROM transaksi WHERE total BETWEEN {$totalM} AND {$totalA} ORDER BY total";

        $transaksi = mysqli_query($conn, $query);
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Master Transaksi</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
        

        @media print {
            .noprint {
                display: none;
            }

            #mychart {
                max-width: 100%;
            }   

            #judul {
                background-color: #0d6efd;
                color: white;
            }
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

<?php if (isset($_POST['submit'])): ?>

<div class="container mt-4 pb-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white fw-bold" id="judul">
            <b>Rekap Laporan Penjualan dari</b> <?= $_POST['mulai'] ?> sampai <?= $_POST["akhir"] ?>
        </div>
        <div class="card-body">
        <a href="index.php" class="noprint btn btn-primary mb-3"> Kembali</a>
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
                        <td>Rp. <?= $total ?></td>
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
                <td>Rp. <?= $jumlah_pendapatan ?></td>
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
            <form class="form-inline" method="post" action="">
                <div class="form-group mr-3">
                    <input  name="mulai" type="text" class="form-control" placeholder="Pendapatan Mulai">
                </div>
                <div class="form-group mr-3">
                    <input name="akhir" type="text" class="form-control" placeholder="Pendapatan Akhir">
                </div>
                <button type="submit" name="submit" class="btn btn-success">Tampilkan</button>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<?php if (isset($_POST["submit"])): ?>
    <script>
        const ctx = document.getElementById("mychart").getContext("2d");

        const myChart = new Chart(ctx, {
            type: 'line',
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
</body>
</html>