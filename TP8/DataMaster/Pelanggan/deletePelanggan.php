<?php
    session_start();
    require "../../config.php";
    require "../../fungsi.php";
    if (!isset($_SESSION["user"]) || !isset($_SESSION["role"]))
    {
        header("Location: " . ROOT . "/login.php");
    }

    if ($_SESSION["role"] != "Owner")
    {
        header("Location:" . ROOT . "/index.php");
    }
    
    if (isset($_GET["deleteid"]))
    {
        $query = "SELECT * FROM transaksi WHERE pelanggan_id = {$_GET['deleteid']}";

        if (mysqli_num_rows(mysqli_query(DB, $query)) > 0) {
            echo "<script>alert('barang tidak dapat di hapus karena di gunakan di table transaksi')
            window.location.href = '" . ROOT . "/DataMaster/Pelanggan/pelanggan.php'</script>";
        }

        deletePelanggan();
        header("Location: " . ROOT . "/DataMaster/Pelanggan/pelanggan.php");
    }