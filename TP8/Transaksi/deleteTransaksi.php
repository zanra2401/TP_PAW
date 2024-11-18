<?php
    require "../config.php";
    require "../fungsi.php";
    
    if (isset($_GET["deleteid"]))
    {
        $query = "SELECT * FROM transaksi_detail WHERE transaksi_id = {$_GET['deleteid']}";

        if (mysqli_num_rows(mysqli_query(DB, $query)) > 0) {
            echo "<script>alert('barang tidak dapat di hapus karena di gunakan di table transaksi detail')
            window.location.href = '" . ROOT . "/Transaksi/transaksi.php'</script>";
        }

        deleteTransaksi();
        header("Location:" . ROOT . "/Transaksi/transaksi.php");
    }