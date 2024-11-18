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
        header("Location: " . ROOT . "/index.php");
    }
    
    if (isset($_GET["deleteid"]))
    {
        $query = "SELECT * FROM transaksi_detail WHERE barang_id = {$_GET['deleteid']}";

        if (mysqli_num_rows(mysqli_query(DB, $query)) > 0) {
            echo "<script>alert('barang tidak dapat di hapus karena di gunakan di transaksi detail')
            window.location.href = '" . ROOT . "/DataMaster/Barang/barang.php'</script>";
        }
        deleteBarang();
        header("Location: " . ROOT . "/DataMaster/Barang/barang.php");
    }