<?php 
    session_start();
    require $_SERVER["DOCUMENT_ROOT"] . "/PAW/TP8-COPY/config.php";
    if (!isset($_SESSION["user"]) && $page != "login") {
      header("Location: " . ROOT . "/login.php");
    }
    
    if ($page != "login" && $_SESSION["role"] != "Owner" && $page == "Data Master") {
        header("Location: " . ROOT . "/login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= (isset($title) ? $title : "Sistem Penjualan") ?></title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
      .no-outline:focus {
        outline: none; !important
      }
      body {
        overflow-x: hidden;
      }
    
      .dropdown-menu {
        transform: translate(-80px, 0); /* Geser posisi jika perlu */
      }

      @media print {
        .noprint {
            display: none;
        }

        #judul {
            background-color: #0d6efd;
            color: white;
        }

        #mychart {
          max-width: 100%;
          height: auto;
        }
      }
    </style>
</head>
<body>

<?php if ($page != "login"): ?>
<nav class="navbar navbar-expand-lg  bg-primary noprint" data-bs-theme="dark">
  <div class="container-fluid">
    <i class="fas fa-box-open" style="font-size: 2em; color: white;"></i>
    <a class="navbar-brand" href="<?= ROOT ?>/index.php">Sistem Penjualan</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?= ROOT ?>/index.php">Home</a>
        </li>
        <?php if ($_SESSION["role"] == "Owner"): ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Data Master
          </a>
          <ul class="dropdown-menu bg-primary">
            <li><a class="dropdown-item" href="<?= ROOT ?>/DataMaster/Barang/barang.php">Data Barang</a></li>
            <li><a class="dropdown-item" href="<?= ROOT ?>/DataMaster/Supplier/supplier.php ">Data Supplier</a></li>
            <li><a class="dropdown-item" href="<?= ROOT ?>/DataMaster/Pelanggan/pelanggan.php">Data Pelanggan</a></li>
            <li><a class="dropdown-item" href="<?= ROOT ?>/DataMaster/User/user.php">Data User </a></li>
          </ul>
        </li>
        <?php endif; ?>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?= ROOT ?>/Transaksi/transaksi.php">Transaksi</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?= ROOT ?>/Transaksi/reportTransaksi.php">Laporan</a>
        </li>
      </ul>
    </div>

    <div class="dropdown">
      <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
        <?= $_SESSION["user"] ?>
      </button>
      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <li><a class="dropdown-item" href="<?= ROOT ?>/logout.php">Logout</a></li>
      </ul>
    </div>

  </div>
</nav>
<?php endif; ?>